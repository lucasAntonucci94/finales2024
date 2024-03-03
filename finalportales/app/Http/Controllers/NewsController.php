<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Http\Services\NewsService;


class NewsController extends Controller
{
    public function getAll(){
        $news = $this->getNewsService()->getAll();
        // dd($news);
        return view('news/index',[
            'news'=> $news,
        ]);
    }

    public function showNew($id){
        $new = $this->getNewsService()->getById($id);
        return view('news.show',[
            'new'=>$new,
        ]);
    }

    public function createNew(Request $request){
        try{
            $new = $this->getNewsService()->createNew($request);
            if($new != null){
                return $this->toRoute('admin.news.index')->with('message.success','La noticia <b>'.e($new->title).'</b> se agrego con exito.');;
            }
        }catch(Exception $e){
            return $this->toRoute('create.form.new',[
                'error' => 'La noticia no se pudo crear por un error en la base de datos.'
            ])->withInput();
        }
    }

    public function editNew(Request $request, int $id){
        try{
            $new = $this->getNewsService()->editNew($request,$id);
            if($new != null){
                return $this->toRoute('admin.news.index')->with('message.success','La noticia <b>'.e($new->title).'</b> se edito con exito.');;
            }
        }catch(Exception $e){
            return $this->toRoute('create.form.new',[
                'error' => 'La noticia no se pudo editar por un error en la base de datos.'
            ])->withInput();
        }
    }

    public function deleteNew(int $id){
        return  $this->getNewsService()->delete($id);
    }

    public function getNewsService(){
        return new NewsService;
    }

    protected function toRoute(string $route, array $messages = []){
        $redirect = redirect()->route($route);
        foreach($messages as $type => $message){
            $redirect->with('message.'.$type, $message);
        }
        return $redirect;
    }
}
