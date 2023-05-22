<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckAuth
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
        $authcheck="1";
        if(Session::get('auth')){
            $auth = Session::get('auth');
            if ($auth && isset($auth['created-at'])) {
                $expire = $auth['expire']; ///60;
                if (time() - $auth['created-at'] > $expire) {
                    Session::forget('auth');
                    $authcheck="0";                   
                }
            } else {
                $authcheck="0";                
            }
        } else {
            $authcheck="0";  
        }

       
        if(Session::get('mySecret')){
            $secret= Session::get('mySecret');
            if ($secret==1) {           
            } else {
                $authcheck="0"; 
            }            
        } else {
            $authcheck="0"; 
        }
        


        if($authcheck=="0"){
            return redirect()->route('login')->withErrors(['field' => 'Session Timeout! Please login again.']);
        }
        
        return $next($request);
    }
    

}
