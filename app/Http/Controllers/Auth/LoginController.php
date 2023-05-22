<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Services\ApiRepositoryInterface as api;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Api $api)
    {
        
        $this->apiService = $api;
    }


    public function login(Request $request)
    {
        $username = $request->loginEmail;
        $password = $request->loginPwd;
        
        // try {          
           
        //     $login = $this->apiService->appAuth($username, $password);


        //     if (isset($login['status']) && $login['status']) {
        //         return redirect()->intended(route('home'));
        //     } else if (isset($login['error'])) {
        //         return redirect('login')->withErrors(['field' => $login['error']]);
        //     } else {
        //         return redirect('login')->withErrors(['field' => 'Invalid user credentials.']);
        //     }
        // } catch (\Throwable $th) {
        //     return redirect('login')->withErrors(['field' => 'Invalid user credentials.']);
        // }

        // return view('auth.login');
    }

    public function showLoginForm(Request $request)
    {
        // return view('auth.login');
       
    }


    public function logout(Request $request)
    {
        // Session::forget('auth');        
        // return view('auth.login');
    }



    public function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL)
            && preg_match('/@.+\./', $email);
    }
}
