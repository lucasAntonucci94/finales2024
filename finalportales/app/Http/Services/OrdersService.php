<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\ProductsService;

class OrdersService
{
    public function getAll(Request $request){
        $queryOrders = Order::with(['user','items.product'])->where('enabled', true);
        return $queryOrders->get();
    }
   
    public function getSales(){
        $queryOrders = Order::with(['user','items.product'])->where('enabled', false);
        return $queryOrders->get();
    }
   
    public function getPaginated(Request $request){
        $queryProducts = Order::with(['user','items']);
        $input = $request->has('q') ? $request->query('q') : null;
        if($input)
            $queryProducts
                ->whereHas('user', function ($q) use ($input) {
                        $q->where('name', 'like', '%'.$input.'%');
                    });
        return $queryProducts->paginate(8)->withQueryString();
    }

    public function createOrder(Request $request)
    {
        // Validate the request data
        // $validator = Validator::make($request->all(), Order::$rules, Order::$rulesMessage);
        
        // // If validation fails, redirect back with error messages
        // if ($validator->fails()) {
        //     return redirect()->route('products.index')->withErrors($validator)->withInput();
        // }
    
        // Begin a database transaction
        DB::beginTransaction();
    
        try {
            $hasProduct = false;
            $data = $request->all();
            $oldOrder = $this->getByUserId($data['id_user']);

            if ($oldOrder === null) {
                $order = Order::create([
                    'id_user' => $data['id_user'],
                    'status' => 'Pendiente',
                    'enabled' => true,
                ]);
            } else {
                $order = $oldOrder;

                $orderItem = OrderItem::where('order_id', $order->id)
                    ->where('id_product', $data['id_product'])
                    ->first();

                if ($orderItem) {
                    $orderItem->quantity = (int)($data['quantity'] + $orderItem->quantity);
                    $orderItem->save();
                    $hasProduct = true;
                }
            }

            if (!$hasProduct) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'id_product' => $data['id_product'],
                    'quantity' => (int)$data['quantity'],
                ]);
            }
        
            DB::commit();
            return redirect()->route('products.index')->with('message.success', 'La orden se agregó con éxito.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('products.index')->with('error', 'La orden no se pudo crear por un error, vuelva a intentarlo.')->withInput();
        }
    }
    public function updateQuantity(Request $request)
    {
        $itemId = $request->input('item_id');
        $newQuantity = $request->input('new_quantity');
        // Validate data
        $request->validate([
            'item_id' => 'required|integer|exists:order_items,id',
            'new_quantity' => 'required|integer|min:1|max:' . 100,
        ]);
        // dd([
        //     'item_id' => $itemId,
        //     'new_quantity' => $newQuantity,
        // ]);

        // Update the item quantity in the database
        // OrderItem::where('id', $itemId)->update(['quantity' => $newQuantity]);

        // Validate the request data
        // $validator = Validator::make($request->all(), Order::$rules, Order::$rulesMessage);
        
        // // If validation fails, redirect back with error messages
        // if ($validator->fails()) {
        //     return redirect()->route('order.checkout')->withErrors($validator)->withInput();
        // }
    
        DB::beginTransaction();

        try {
            $orderItem = OrderItem::where('id', $itemId)
                ->first();
            if ($orderItem) {
                $orderItem->quantity = (int)$newQuantity;
                $orderItem->save();
            }
        
            DB::commit();
            return redirect()->route('order.checkout')->with('message.success', 'Cantidad actualizada satisfactoriamente.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('order.checkout')->with('error', 'Ocurrio un error al intentar actualizar el item.')->withInput();
        }
    }
    public function getByUserId($id){
        return  Order::with(['user'])
                ->whereHas('user', function ($q) use ($id) {
                     $q->where('id', $id);
        })->where('enabled', true)
        ->first();
    }
    
    public function getAllByUserId($id){
        return  Order::with(['user'])
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
        try{
            $order = Order::findOrFail($id);

            $request->validate(Order::$rules, Order::$rulesMessage);

            $data = $request->all();
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

    public function deleteItem(int $id, string $backurl){
        $orderItem = OrderItem::findOrFail($id);
        try{
            // TRANSACTION: En caso success de las querys emitira un commit, caso de error hara un rollback
            //use ($data)  me permite especificar los parametros que se le pasan a dicha funcion, caso contrario no va a poder leer el $data del create
            DB::transaction(function () use ($orderItem) {
                $orderItem->delete();
            });
        }catch(Exception $e){
            return $this->toRoute('order.checkout',[
                'error' => 'El producto no se pudo eliminar por un error en la base de datos.'
            ])->withInput();
        }
        return $this->toRoute($backurl)->with('message.success','El producto <b>ID: '.e($orderItem->id).'</b> fue eliminado exitosamente.');
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
    public function getProductsService(){
        return new ProductsService;
    }

    protected function toRoute(string $route, array $messages = []){
        $redirect = redirect()->route($route);
        foreach($messages as $type => $message){
            $redirect->with('message.'.$type, $message);
        }
        return $redirect;
    }
}
