<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Http\Services\UsersService;

class UsersController extends Controller
{
    public function createUser(Request $request){
        return  $this->getUsersService()->createUser($request);
    }

    public function editUser(Request $request, int $id){
        return  $this->getUsersService()->editUser($request,$id);
    }
    public function editProfile(Request $request, int $id){
        return  $this->getUsersService()->editProfile($request,$id);
    }
    public function deleteUser(int $id){
        return  $this->getUsersService()->delete($id);
    }

    public function formEditProfile(int $id){
        return  $this->getUsersService()->formEditProfile($id);
    }

    public function getUsersService(){
        return new UsersService;
    }

    protected function toRoute(string $route, array $messages = []){
        $redirect = redirect()->route($route);
        foreach($messages as $type => $message){
            $redirect->with('message.'.$type, $message);
        }
        return $redirect;
    }
}
