<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class MercadoPagoService
{
    public function createPreference($items){        
        MercadoPagoConfig::setAccessToken(config(key:"mercadopago.access_token"));
        $client = new PreferenceClient();
        return $client->create(["items" => $items]);
    }
}
