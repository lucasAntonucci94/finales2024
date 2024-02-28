<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = "order_items";

    protected $primaryKey = "id";

    protected $fillable =['order_id','id_product','quantity'];

    public static $rules = [
        'order_id'=>'required|exists:orders,id',
        'id_product'=>'required|exists:products',
    ];

    public static $rulesMessage = [
        'order_id.required'=>'El pedido es obligatorio.',
        'order_id.exists'=>'El pedido no existe en al base de datos.',
        'id_product.required'=>'El producto es obligatorio.',
        'id_product.exists'=>'El producto no existe en la base de datos',
    ];

    public function order(){
        return $this->belongsTo(Order::class,'order_id','order_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'id_product','id_product');
    }

}
