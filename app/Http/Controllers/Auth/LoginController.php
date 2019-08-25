<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

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
    //////////redirect method added by me in laravel docs/////////////////////////////////////////////
    protected function  redirectTo()
    {

        $user = Auth::user();
        switch(true) {
            case $user->type =='patient':
                return '/home';
            case $user->type =='employee':
                return '/employeehome';
            case $user->type =='admin':
                return '/adminhome';
            case $user->type =='dev':
                return '/adminhome';
            default:
                return '404';
        }


//        return 'nashod';
    }
    /// //////////////////////////////////////////////////////

  //  protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    ///////////adde by me ////////////////////
    ///
    public function username()
    {
        return 'national_id';
    }

}
