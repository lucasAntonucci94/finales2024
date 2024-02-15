<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\OrdersService;
use App\Http\Services\UsersService;
use App\Http\Services\MercadoPagoService;
use Illuminate\Support\Facades\Auth;

use MercadoPago\Resources\Preference;
use MercadoPago\MercadoPagoConfig;
// use MercadoPago\Client\Preference\PreferenceClient;
// use MercadoPago\Exceptions\MPApiException;
use MercadoPago\Client\Preference\PreferenceClient;
class OrdersController extends Controller
{
    public function createOrder(Request $request){
        return  $this->getOrdersService()->createOrder($request);
    }

    public function editOrder(Request $request, int $id){
        // dd($request);
        return  $this->getOrdersService()->editOrder($request,$id);
    }

    public function deleteOrder(int $id, string $backurl){
        return  $this->getOrdersService()->delete($id, $backurl);
    }

    public function checkout(){
        $items = [];
        $total = 0;
        $orders = $this->getOrdersService()->getByUserId(Auth::id());
        foreach($orders as $order){
            $items[] = [
                'id' =>  $order->product->id_product, 
                'title' =>  $order->product->detail, 
                'description' =>  $order->product->description, 
                'quantity' =>  1, 
                'unit_price' =>  $order->product->price, 
                'currency_id' =>  'ARS', 
            ];
            $total += $order->product->price;
        }

        if (!empty($items)) {
            // dd($items);
            $preference = $this->getMercadoPagoService()->createPreference($items);
        } 

        return view('orders.checkout',[
            'orders'=> $orders,
            'preference'=> $preference,
            'total'=> $total,
            'publicKey'=> config(key: 'mercadopago.public_key'),
        ]);
    }

    public function showOrderProfile($id){
        $orders = $this->getOrdersService()->getByUserId($id);
        $user = $this->getUsersService()->getById($id);
        return view('profile.orders.show',[
            'orders'=>$orders,
            'user'=>$user,
        ]);
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
