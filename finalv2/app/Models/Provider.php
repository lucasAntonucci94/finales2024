<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Provider
 *
 * @property int $id_provider
 * @property string $name
 * @property string $location
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereIdProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provider whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Provider extends Model
{

    protected $table = "providers";

    protected $primaryKey = "id_provider";

    // protected $fillable =['name','location','phone'];

    // public static $rules = [
    //     'name'=>'required|min:5',
    //     'location'=>'required|min:5',
    //     'phone'=>'required|min:10',
    // ];

    // public static $rulesMessage = [
    //     'name.required'=>'El nombre del producto es obligatorio.',
    //     'name.min'=>'El nombre del producto debe tener al menos :min caracteres.',
    //     'location.required'=>'El nombre del producto es obligatorio.',
    //     'location.min'=>'El nombre del producto debe tener al menos :min caracteres.',
    //     'phone.required'=>'El nombre del producto es obligatorio.',
    //     'phone.min'=>'El nombre del producto debe tener al menos :min caracteres.',
    // ];
}
