<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $primaryKey = "id";

    protected $fillable =['id_user','status','enabled'];

    public static $rules = [
        'id_user'=>'required|exists:users,id',
        // 'id_product'=>'required|exists:products',
    ];

    public static $rulesMessage = [
        // 'status.required'=>'El status de la orden es obligatorio.',
        // 'status.min'=>'El status de la orden debe tener al menos :min caracteres.',
        'id_user.required'=>'El usuario es obligatorio.',
        'id_user.exists'=>'El usuario no existe en al base de datos.',
        // 'id_product.required'=>'El producto es obligatorio.',
        // 'id_product.exists'=>'El producto no existe en la base de datos',
    ];

    public function user(){
        // return $this->belongsTo(ModelReferenciado::class,'NOMBRE DEL CAMPO QUE REFERENCIO','NOMBRE FK');
        return $this->belongsTo(User::class,'id_user','id');
    }
    
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    // public function product(){
    //     return $this->belongsTo(Product::class,'id_product','id_product');
    // }

}
