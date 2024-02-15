<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class OrdersService
{
    public function getAll(Request $request){
        $queryOrders = Order::with(['user','product']);
        return $queryOrders->get();
    }
    public function getPaginated(Request $request){
        $queryProducts = Order::with(['user','product']);
        $input = $request->has('q') ? $request->query('q') : null;
        if($input)
            $queryProducts
                ->whereHas('user', function ($q) use ($input) {
                        $q->where('name', 'like', '%'.$input.'%');
                    });
        return $queryProducts->paginate(8)->withQueryString();
    }

    public function createOrder(Request $request){
        $request->validate(Order::$rules, Order::$rulesMessage);
        $data = $request->all();
        $data['status'] = 'creada';
        try{
           DB::transaction(function () use ($data) {
                $order = Order::create($data);
            });
        }catch(Exception $e){
            return $this->toRoute('products.index',[
                'error' => 'La orden no se pudo crear por un error, vuelva a intentarlo.'
            ])->withInput();
        }
        return $this->toRoute('products.index')->with('message.success','La orden se agregó con éxito.');;
    }

    public function getByUserId($id){
        return  Order::with(['user','product'])
                ->whereHas('user', function ($q) use ($id) {
                     $q->where('id', $id);
        })->get();
    }

    public function getById($id){
        return Order::findOrFail($id);
    }

    public function formEdit(int $id){
        $order = Order::findOrFail($id);
        // $roles = Role::all();
        return view('admin/orders/edit', [
            'order'=> $order,
            // 'roles'=> $roles,
        ]);
    }

    public function editOrder(Request $request, int $id){

        $order = Order::findOrFail($id);

        $request->validate(Order::$rules, Order::$rulesMessage);

        $data = $request->all();

        try{
            DB::transaction(function () use ($order, $data) {
                $order->update(['status' => $data['status']]);
            });
        }catch(Exception $e){
            return $this->toRoute('edit.form.order',[
                'error' => 'El estado del pedido no se pudo actualizar por un error en la base de datos.'
            ])->withInput();
        }

         return $this->toRoute('admin.orders.index')->with('message.success','El pedido <b>ID: '.e($order->id).'</b> fue editado exitosamente.');
    }


    public function delete(int $id, string $backurl){
        $order = Order::findOrFail($id);
        try{
            // TRANSACTION: En caso success de las querys emitira un commit, caso de error hara un rollback
            //use ($data)  me permite especificar los parametros que se le pasan a dicha funcion, caso contrario no va a poder leer el $data del create
            DB::transaction(function () use ($order) {
                $order->delete();
            });
        }catch(Exception $e){
            return $this->toRoute('admin.orders.index',[
                'error' => 'El pedido no se pudo eliminar por un error en la base de datos.'
            ])->withInput();
        }
        return $this->toRoute($backurl)->with('message.success','El pedido <b>ID: '.e($order->id).'</b> fue eliminado exitosamente.');
    }


    // protected function uploadImage(Request $request, string $field='image') : string|null {
    //     if($request->hasFile($field) && $request->file($field)->isValid()){

    //         // dd($request);
    //         $filename = date('YmdHis_').".".$request->file($field)->extension();

    //         Image::make($request->file($field))
    //             ->resize(500,500, function($constraint) {
    //                 $constraint->aspectRatio();
    //                 $constraint->upsize();
    //             })->save(public_path('images/'.$filename));

    //         return $filename;
    //     }
    //     return null;
    // }

    protected function toRoute(string $route, array $messages = []){
        $redirect = redirect()->route($route);
        foreach($messages as $type => $message){
            $redirect->with('message.'.$type, $message);
        }
        return $redirect;
    }
}
