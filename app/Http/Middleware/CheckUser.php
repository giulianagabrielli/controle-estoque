<?php // essa classe precisa ser registrada para o Laravel saber da existência dele. Pasta http/Kernel.php. A validação pode ser global ou pode escolher qual rota o middleware vai trabalhar.

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) // essa classe tem sempre um único método handle. Closure vai ver se deixa passar
    {
        $user = Auth::user(); //A classe Auth é o laravel usando SESSION

        if($user){
            return $next($request); // validou a solicitação, o usuário pode continuar o fluxo
        } else {
            return redirect('/login'); // rota login é padrão do laravel
        }
    }
}
