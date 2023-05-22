<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class ChangePassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $pwdFlag="";
        if(Session::get('auth')){
            $auth= Session::get('auth');
           // print_r($auth); exit;
            $pwdFlag=$auth['pwd_flag'];
        }
        
        if($pwdFlag=="1"){
            return redirect()->route('changepwd');
        }
        
        return $next($request);
    }
    

}
