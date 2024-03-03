<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class NewsService
{
    public function getAll(){
        $queryNews = News::with(['user','genres']);

        return $queryNews->get();
    }
    public function getPaginated(Request $request){
        $queryNews = News::with(['user','genres']);
        $q = $request->has('q') ? $request->query('q') : null;
        if($q)
            $queryNews->where('title', 'like', '%'.$q.'%');

        return $queryNews->paginate(8)->withQueryString();
    }

    public function formCreate(){
        return view('admin/news/new',[
            'genres'=> Genre::all(),
        ]);
    }
    
    public function createNew(Request $request): News
    {
        try {
            $request->validate(News::$rules, News::$rulesMessage);
            $data = $request->all();
            $data['image'] = $this->uploadImage($request);

            $response = DB::transaction(function () use ($data) {
                $new = News::create($data);
                $new->genres()->attach($data['id_genre'] ?? []);
                return $new;
            });
            return $response;
        } catch (Exception $e) {
            throw new Exception('Error al crear la noticia: ' . $e->getMessage());
        }   
    }

    public function getById($id){
        return News::findOrFail($id);
    }

    public function formEdit(int $id){
        $new = News::findOrFail($id);
        $genres = Genre::all();

        return view('admin/news/edit', [
            'new'=> $new,
            'genres'=> $genres,
        ]);
    }

    public function editNew(Request $request, int $id){
        try{
            $new = News::findOrFail($id);

            $request->validate(News::$rules, News::$rulesMessage);

            $data = $request->all();
            $data['image'] = $this->uploadImage($request) ?? $new->image;

            $response = DB::transaction(function () use ($new, $data) {
                $new->update($data);

                $new->genres()->sync($data['id_genre'] ?? []);
                return $new;
            });
            return $response;
        }catch(Exception $e){
            return $this->toRoute('create.form.new',[
                'error' => 'La noticia no se pudo crear por un error en la base de datos.'
            ])->withInput();
        }
    }


    public function delete(int $id){
        $new = News::findOrFail($id);
        try{
            // TRANSACTION: En caso success de las querys emitira un commit, caso de error hara un rollback
            //use ($data)  me permite especificar los parametros que se le pasan a dicha funcion, caso contrario no va a poder leer el $data del create
            DB::transaction(function () use ($new) {
                $new->genres()->detach();
                $new->delete();
            });
        }catch(Exception $e){
            return $this->toRoute('news.index',[
                'error' => 'La noticia no se pudo eliminar por un error en la base de datos.'
            ])->withInput();
        }

        return $this->toRoute('admin.news.index')->with('message.success','La noticia <b>'.e($new->detail).'</b> fue eliminado exitosamente.');    }


    protected function uploadImage(Request $request, string $field='image') : string|null {
        if($request->hasFile($field) && $request->file($field)->isValid()){

            // dd($request);
            $filename = date('YmdHis_').".".$request->file($field)->extension();

            Image::make($request->file($field))
                ->resize(500,500, function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('images/'.$filename));

            return $filename;
        }
        return null;
    }

    protected function toRoute(string $route, array $messages = []){
        $redirect = redirect()->route($route);
        foreach($messages as $type => $message){
            $redirect->with('message.'.$type, $message);
        }
        return $redirect;
    }
}
