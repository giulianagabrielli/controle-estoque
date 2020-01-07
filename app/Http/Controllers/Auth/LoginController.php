<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite; // usar a classe instalada Socialite: composer require laravel/socialite
use App\User; 
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect(); // tem que instalar o Socialite 
    }

    public function receiveDataGoogle(){
        $userGoogle = Socialite::driver('google')->user();
        $userDb = $this->findOrCreateUser($userGoogle); // vai retornar um usuário que está dentro do banco

        Auth::login($userDb, true); // método login do usuário do google que já está no banco

        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($userGoogle){ // Find é sempre para id. Qualquer outra busca é where 
        $user = User::where('email', $userGoogle->email)->first(); //email é do Google, depois onde vai procurar na tabela. First para a primeira ocorrência de email do banco
        if($user){
            return $user;
        } 

        // caso o user não exista, cadastra o novo usuário do google no banco
        $newUser = new User();
        $newUser->name = $userGoogle->name; 
        $newUser->email = $userGoogle->email;
        $newUser->img_profile = $userGoogle->avatar;
        $newUser->provider_id = $userGoogle->id; 
        $newUser->active = 1; 

        $newUser->save(); // para salvar no banco

        return $newUser;
    }

}
