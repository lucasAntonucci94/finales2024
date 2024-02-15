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
        return  $this->getNewsService()->createNew($request);
    }

    public function editNew(Request $request, int $id){
        return  $this->getNewsService()->editNew($request,$id);
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
