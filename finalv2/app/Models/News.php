<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\News
 *
 * @property int $id_new
 * @property int $id_user
 * @property string $title
 * @property string $detail
 * @property string $description
 * @property string|null $image
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genre[] $genres
 * @property-read int|null $genres_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereIdNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class News extends Model
{
    protected $table = "news";

    protected $primaryKey = "id_new";

    protected $fillable =['title','detail','description','date','id_user','image'];

    protected $casts = [
        'date'=>'date',
    ];

    public static $rules = [
        'title'=>'required|min:5',
        'detail'=>'required|min:10',
        'description'=>'required|min:15',
        'date'=>'required|date',
        // 'id_user'=>'required|exists:users',
    ];

    public static $rulesMessage = [
        'title.required'=>'El nombre del producto es obligatorio.',
        'title.min'=>'El nombre del producto debe tener al menos :min caracteres.',
        'detail.required'=>'El detalle del producto es obligatorio.',
        'detail.min'=>'El detalle del producto debe tener al menos :min caracteres.',
        'description.required'=>'La descripción es obligatoria.',
        'description.min'=>'La descripción del producto debe tener al menos :min caracteres.',
        'date.required'=>'La fecha es obligatoria.',
        // 'id_user.required'=>'El usuario es obligatorio.',
        // 'id_user.exists'=>'El usuario no existe en al base de datos.',
    ];

    public function user(){
        return $this->belongsTo(User::class,'id_user','id');
    }

    public function genres(){
        return $this->belongsToMany(
            Genre::class,
            'news_has_genres', //tabla pivot de mi relacion
            'id_new', //id_fk para noticias
            'id_genre', //id_fk para generos
            'id_new', //parent key
            'id_genre', //parent key
        );
    }

}
