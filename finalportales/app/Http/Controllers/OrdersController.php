<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\OrdersService;
use App\Http\Services\UsersService;
use App\Http\Services\MercadoPagoService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class OrdersController extends Controller
{
    public function createOrder(Request $request){
        try{
            $order = $this->getOrdersService()->createOrder($request);
            if($order){
                return redirect()->route('products.index')->with('message.success', 'El producto seleccionado se agregó con éxito.');
            }
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('error', 'El producto no se pudo crear por un error, vuelva a intentarlo.')->withInput();
        }
    }

    public function editOrder(Request $request, int $id){
        try{
            $order = $this->getOrdersService()->editOrder($request,$id);
            if($order){
                return $this->toRoute('admin.orders.index')->with('message.success','El pedido <b>ID: '.e($order->id).'</b> fue editado exitosamente.');
            }
        } catch (Exception $e) {
            return $this->toRoute('edit.form.order',[
                'error' => 'El estado del pedido no se pudo actualizar por un error en la base de datos.'
            ])->withInput();
        }
    }

    public function deleteOrder(int $id, string $backurl){
        return  $this->getOrdersService()->delete($id, $backurl);
    }

    public function deleteOrderItem(int $id, string $backurl){
        return  $this->getOrdersService()->deleteItem($id, $backurl);
    }

    public function checkout(){
        $total = 0;
        $items = [];
        $preference = null;
        $preferenceItems = [];
        $order = $this->getOrdersService()->getByUserId(Auth::id());
        if($order !== null && $order->items !== null){
            foreach ($order->items as $item) {
                $items[] = $item; //Order items, este tiene la caracteristicas del producto y la cantidad ingresada.
                $preferenceItems[] = [
                    'id' =>  $item->product->id_product, 
                    'title' =>  $item->product->detail, 
                    'description' =>  $item->product->description, 
                    'quantity' =>  $item->quantity, 
                    'unit_price' =>  $item->product->price, 
                    'currency_id' =>  'ARS', 
                    // 'picture_url' =>  asset('images/'.$item->product->image), 
                ];
                $total += $item->product->price * $item->quantity;
            }
            $preference = $this->getMercadoPagoService()->createPreference($preferenceItems, $order->id);
        }
        return view('orders.checkout',[
            'orderId'=> optional($order)->id,
            'items'=> $items,
            'preference'=> $preference,
            'total'=> $total,
            'publicKey'=> config(key: 'mercadopago.public_key'),
        ]);
    }
    
    public function showOrderProfile($id){
        $ordersToShow = [];
        $user = $this->getUsersService()->getById($id);
        $orders = $this->getOrdersService()->getAllByUserId($id);
        
        if($orders !== null){
            foreach ($orders as $order) {
                $total=0;
                $items = [];
                if($order !== null && $order->items !== null){
                    foreach ($order->items as $item) {
                        $items[] = $item; //Order items, este tiene la caracteristicas del producto y la cantidad ingresada.
                        $total += $item->product->price * $item->quantity;
                    }
                }
                if ($order && $order->items) {
                    $ordersToShow[] = [
                      'order_id' => $order->id,
                      'items' => $order->items,
                      'status' => $order->status,
                      'created_at' => Carbon::parse($order->created_at)->format('d/m/Y H:i:s'),
                      'total' => $total,
                    ];
                }
            }
        }
        return view('profile.orders.show',[
            'orders'=>$ordersToShow,
            'user'=>$user,
        ]);
    }
   
    public function updateMercadoPago(Request $request)
    {
        $response = $request->all();
        return $this->getMercadoPagoService()->update($response);
    }

    public function successMercadoPago($id)
    {
        return $this->getMercadoPagoService()->success($id);
    }

    public function pendingMercadoPago($id)
    {
        return  $this->getMercadoPagoService()->pending($id);
    }

    public function failedMercadoPago($id)
    {
        return $this->getMercadoPagoService()->success($id);
        // return  $this->getMercadoPagoService()->failed($id);
    }

    public function updateQuantity(Request $request)
    {
        try{
            $orderItem = $this->getOrdersService()->updateQuantity($request);
            if($orderItem){
                return redirect()->route('order.checkout')->with('message.success', 'Cantidad actualizada satisfactoriamente.');
            }
        } catch (Exception $e) {
            return redirect()->route('order.checkout')->with('error', 'Ocurrio un error al intentar actualizar el item.')->withInput();
        }
        // return  $this->getOrdersService()->updateQuantity($request);
    }

    public function getUsersService(){
        return new UsersService;
    }

    public function getOrdersService(){
        return new OrdersService;
    }

    public function getMercadoPagoService(){
        return new MercadoPagoService;
    }
    
    protected function toRoute(string $route, array $messages = []){
        $redirect = redirect()->route($route);
        foreach($messages as $type => $message){
            $redirect->with('message.'.$type, $message);
        }
        return $redirect;
    }
}
