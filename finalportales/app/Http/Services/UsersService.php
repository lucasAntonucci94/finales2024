<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Hash;
class UsersService
{
    public function getPaginated(Request $request){
        $queryUsers = User::with(['roles']);
        $q = $request->has('q') ? $request->query('q') : null;
        if($q)
            $queryUsers->where('email', 'like', '%'.$q.'%');

        return $queryUsers->paginate(8)->withQueryString();
    }

    public function formCreate(){
        return view('admin/users/new',[
            'roles'=> Role::all(),
        ]);
    }

    public function createUser(Request $request){
        try{
            $request->validate(User::$rules, User::$rulesMessage);
            $data = $request->all();
            $data['image'] = $this->uploadImage($request);
            $data['password'] = Hash::make($data['password']);
            
            $dbUser = User::where('email', $data["email"])->first();
            if($dbUser != null){
                return $this->toRoute('auth.register.form',[
                    'error' => 'El email ingresado ya pertenece a otro usuario.'
                ])->withInput();
            }
           DB::transaction(function () use ($data) {
                $user = User::create($data);
            });
        }catch(Exception $e){
            return $this->toRoute('create.form.user',[
                'error' => 'La noticia no se pudo crear por un error en la base de datos.'
            ])->withInput();
        }
        return $this->toRoute('admin.users.index')->with('message.success','La noticia <b>'.e($data['email']).'</b> se agrego con exito.');
    }

    public function getById($id){
        return User::findOrFail($id);
    }

    public function formEdit(int $id){
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin/users/edit', [
            'user'=> $user,
            'roles'=> $roles,
        ]);
    }

    public function formEditProfile(int $id){
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('profile/edit', [
            'user'=> $user,
            'roles'=> $roles,
        ]);
    }

    public function editUser(Request $request, int $id){

        try{
            $user = User::findOrFail($id);

            $request->validate(User::$rules, User::$rulesMessage);

            $data = $request->all();

            $data['image'] = $this->uploadImage($request) ?? $user->image;

            if($data['password'] == null) $data['password'] = $user->password;

            if($data['password'] != $user->password){
                if (!Hash::check($data['password'], $user->password)) {
                    $data['password'] = Hash::make($data['password']);
                }else{
                    $data['password'] = $user->password;
                }
            }

            DB::transaction(function () use ($user, $data) {
                $user->update($data);
            });
        }catch(Exception $e){
            return $this->toRoute('create.form.user',[
                'error' => 'El usuario no se pudo crear por un error en la base de datos.'
            ])->withInput();
        }

         return $this->toRoute('admin.users.index')->with('message.success','El usuario <b>'.e($user->name).'</b> fue editado exitosamente.');
    }

    public function editProfile(Request $request, int $id){

        try{
            $user = User::findOrFail($id);

            $request->validate(User::$rules, User::$rulesMessage);

            $data = $request->all();

            $data['image'] = $this->uploadImage($request) ?? $user->image;

            if($data['password'] == null) $data['password'] = $user->password;

            if($data['password'] != $user->password){
                if (!Hash::check($data['password'], $user->password)) {
                    $data['password'] = Hash::make($data['password']);
                }else{
                    $data['password'] = $user->password;
                }
            }

            DB::transaction(function () use ($user, $data) {
                $user->update($data);
            });
        }catch(Exception $e){
            return $this->toRoute('edit.form.profile',[
                'error' => 'El usuario no se pudo crear por un error en la base de datos.'
            ])->withInput();
        }

         return $this->toRoute('profile.index')->with('message.success','El usuario <b>'.e($user->name).'</b> fue editado exitosamente.');
    }


    public function delete(int $id){
        try{
            $user = User::findOrFail($id);
            // TRANSACTION: En caso success de las querys emitira un commit, caso de error hara un rollback
            //use ($data)  me permite especificar los parametros que se le pasan a dicha funcion, caso contrario no va a poder leer el $data del create
            DB::transaction(function () use ($user) {
                $user->delete();
            });
        }catch(Exception $e){
            return $this->toRoute('users.index',[
                'error' => 'El usuario no se pudo eliminar por un error en la base de datos.'
            ])->withInput();
        }

        return $this->toRoute('admin.users.index')->with('message.success','El usuario <b>'.e($user->name).'</b> fue eliminado exitosamente.');
    }


    protected function uploadImage(Request $request, string $field='image') : string|null {
        if($request->hasFile($field) && $request->file($field)->isValid()){
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
