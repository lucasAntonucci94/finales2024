<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Genre
 *
 * @property int $id_genre
 * @property string $name
 * @property string $detail
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre query()
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereIdGenre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Genre whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Genre extends Model
{
    // use HasFactory;

    protected $table = "genres";

    protected $primaryKey = "id_genre";

    // protected $fillable =['name','detail'];

    // public static $rules = [
    //     'name'=>'required|min:5',
    //     'detail'=>'required|numeric',
    // ];

    // public static $rulesMessage = [
    //     'name.required'=>'El nombre del producto es obligatorio.',
    //     'name.min'=>'El nombre del producto debe tener al menos :min caracteres.',
    //     'detail.required'=>'El nombre del producto es obligatorio.',
    //     'detail.min'=>'El nombre del producto debe tener al menos :min caracteres.',
    // ];
}
