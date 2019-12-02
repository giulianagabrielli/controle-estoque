<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        /* salvando a imagem: php artisan storage:link - associação entre pasta privada de imagens e a pasta public para que o usuário possa acessar. Criar uma pasta profile dentro de storage/app/public */
        $nomeArquivo = $data['img']->getClientOriginalName();
        $date = date('y-m-a');
        $nomeArquivo = $date.$nomeArquivo;
        $caminhoImg = "storage/profile/$nomeArquivo"; /* não precisa falar app nem public */

        $resultado = $data['img']->storeAs('public/profile', $nomeArquivo); /* onde vc quer salvar e o nome do arquivo. Aqui o caminho precisa de public/profile, diferentemente de $caminhoImg */

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'img_profile' => $caminhoImg, /* aqui coloca o caminho da imagem */
            'active' => 1
        ]);
    }
}
