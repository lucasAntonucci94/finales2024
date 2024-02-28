<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id_product
 * @property string $detail
 * @property string $description
 * @property int $price
 * @property \Illuminate\Support\Carbon $date
 * @property int $id_provider
 * @property int $id_country
 * @property-read \App\Models\Country $country
 * @property-read \App\Models\Provider $provider
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genre[] $genres
 * @property-read int|null $genres_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereIdProduct($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereIdProvider($value)
 * @property string|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 */
class Product extends Model
{
    protected $table = "products";

    protected $primaryKey = "id_product";

    protected $fillable =['detail','description','date','price','id_provider','id_country','image'];

    protected $casts = [
        'date'=>'date',
    ];

    public static $rules = [
        'detail'=>'required|min:5',
        'price'=>'required|numeric',
        'date'=>'required|date',
        'description'=>'required|min:10',
        'id_country'=>'required|exists:countrys',
        'id_provider'=>'required|exists:providers',
    ];

    public static $rulesMessage = [
        'detail.required'=>'El nombre del producto es obligatorio.',
        'detail.min'=>'El nombre del producto debe tener al menos :min caracteres.',
        'description.required'=>'La descripción es obligatoria.',
        'description.min'=>'El detalle del producto debe tener al menos :min caracteres.',
        'price.required'=>'El precio del producto es obligatorio.',
        'price.numeric'=>'El precio de ser númerico.',
        'date.required'=>'La fecha es obligatoria.',
        'id_country.required'=>'El pais es obligatorio.',
        'id_country.exists'=>'El pais no existe en al base de datos.',
        'id_provider.required'=>'El proveedor es obligatorio.',
        'id_provider.exists'=>'El proveedor no existe en la base de datos',
    ];

    public function country(){
        // return $this->belongsTo(ModelReferenciado::class,'NOMBRE DEL CAMPO QUE REFERENCIO','NOMBRE FK');
        return $this->belongsTo(Country::class,'id_country','id_country');
    }
    public function provider(){
        return $this->belongsTo(Provider::class,'id_provider','id_provider');
    }

    public function genres(){
        return $this->belongsToMany(
            Genre::class,
            'products_has_genres', //tabla pivot de mi relacion
            'id_product', //id_fk para productos
            'id_genre', //id_fk para generos
            'id_product', //parent key
            'id_genre', //parent key
        );
    }

    protected function price(): Attribute{
        return Attribute::make(
            get: fn($value) => ($value),
            set: fn($value) => ($value),
        );
    }


}
