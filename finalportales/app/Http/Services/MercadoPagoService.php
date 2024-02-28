<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Resources\Payment\Payer;
use MercadoPago\Exceptions\MPApiException;

class MercadoPagoService
{
    public function createPreference($items,$order_id){  
        if (!empty($items)) {
            $backUrls = array(
                'success' => route('mercadopago.success', ['id' => $order_id]),
                'pending' => route('mercadopago.pending', ['id' => $order_id]),
                'failure' => route('mercadopago.failed', ['id' => $order_id])
            );
            MercadoPagoConfig::setAccessToken(config(key:"mercadopago.access_token"));
            $client = new PreferenceClient();
            $preference = $client->create([
                "items" => $items,
                "back_urls" => $backUrls,
                // "payer" => ["email"=>Auth::user()->email],
                "external_reference" => $order_id,
                // "notification_url" => route('mercadopago.update'),
            ]); 
            // dd($preference);
            return $preference;
        }else{
            return null;
        }    
    }
    public function update($response){
        dd($response);
        // if ($response['status'] === 'approved') {
        //     $order->update(['status' => 'Pago','enabled' =>  boolval(false)]);
        // }
        if($response && Order::where('order_id', $response['external_reference'])){
            $order = Order::findOrFail($response['data']['external_reference']);
            try{
                DB::transaction(function () use ($order) {
                    $order->update(['status' => 'WEEEA','enabled' =>  boolval(false)]);
                });
            }catch(Exception $e){
                return false;
            }
            return true;
        }
        return false;
    }
    public function updateByOrderId($id){    
        if($id && Order::where('order_id', $id)){
            $order = Order::findOrFail($id);
            try{
                DB::transaction(function () use ($order) {
                    $order->update(['status' => 'Pago','enabled' =>  boolval(false)]);
                });
            }catch(Exception $e){
                return false;
            }
            return true;
        }
        return false;
    }
    public function success($id){    
        return $this->updateByOrderId($id) ? view('home') : view('home');
    }
    public function pending($id){    
        return $this->updateByOrderId($id) ? view('home') : view('home');
    }
    public function failed($id){    
        return $this->updateByOrderId($id) ? view('home') : view('home');
    }
}
