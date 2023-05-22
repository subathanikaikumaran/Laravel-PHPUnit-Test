<?php

namespace App\Http\Middleware;

use Closure;

class PreventBackHistory
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
        $response = $next($request);
        $headers = [
            'Cache-Control' => 'nocache, no-store, max-age=0, must-revalidate',
            'Pragma','no-cache',
            'Expires','Fri, 01 Jan 1990 00:00:00 GMT',
        ];
        
        foreach($headers as $key => $value) {
            $response->headers->set($key, $value);
        }        
        return $response;    
    }

    // public function handle($request, Closure $next)
    // {

    //     $response = $next($request);
    // $response->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
    // $response->headers->set('Pragma','no-cache');
    // $response->headers->set('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
    // return $response;

    //     // $response = $next($request);
    //     // return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
    //     //     ->header('Pragma','no-cache')
    //     //     ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
    // }
}
