<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
// use Intervention\Image\Facades\Image;

class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = [
            'email' => $request->input('email'), //equivale a $request->email
            'password' => $request->input('password'),
        ];

        if(!Auth::attempt($credentials))
            return redirect()
                        ->route('auth.login.form')
                        ->withInput()
                        ->with('message.error','Las credenciales no son correctas, verifique los campos.');

        return redirect()
            ->route('home.index')
            ->withInput()
            ->with('message.success','Sesión iniciada exitosamente.');
    }

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('auth.login.form')
            ->with('message.success','Sesión cerrada exitosamente.');
    }

    public function registerForm(){
        return view('auth.register');
    }

    public function register(Request $request){
        try{
            $request->validate(User::$rules, User::$rulesMessage);
            $data = $request->all();
            $dbUser = User::where('email', $data["email"])->first();
            if($dbUser != null){
                return $this->toRoute('auth.register.form',[
                    'error' => 'El email ingresado ya pertenece a otro usuario.'
                ])->withInput();
            }
            DB::transaction(function () use ($data) {
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'id_role' => 2,
                ]);
            });
        }catch(Exception $e){
            return $this->toRoute('auth.register.form',[
                'error' => 'Verifique los campos del formulario, y vuelva a intentarlo.'
            ])->withInput();
        }

        return $this->toRoute('auth.login.form',[
            'success' => 'El usuario fue creado exitosamente.'
        ]);
    }

    public function getProfile()
    {
        $user = Auth::user();
        return view('profile.index',[
            'user' => $user,
        ]);
    }

    protected function toRoute(string $route, array $messages = []){
        $redirect = redirect()->route($route);
        foreach($messages as $type => $message){
            $redirect->with('message.'.$type, $message);
        }
        return $redirect;
    }

}
