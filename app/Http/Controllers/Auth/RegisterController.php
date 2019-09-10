<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/employeehome';

    /////////////////////////////////////////////////////////////////
    protected function  redirectTo()
    {

        $user = Auth::user();
        switch(true) {
            case $user->type =='admin':
                return '/adminhome';
            case $user->type =='dev':
                return '/adminhome';
            default:
                return '/employeehome';
        }
    }

//
////        return 'nashod';
//    }
    /// ////////////////////////////////////////////

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
        //    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'national_id' => ['required', 'string', 'max:10', 'unique:users'],
            'password'    => ['required', 'string', 'min:8', 'confirmed'],
            'gender'      => ['required','string'],
            'phone'       => ['string'],
            'type'        => ['required','string'],
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
        return User::create([
            'name' => $data['name'],
            'national_id' => $data['national_id'],
            'password' => Hash::make($data['password']),
            'gender'   => $data['gender'],
            'phone'    => $data['phone'],
            'type'     => $data['type'],
        ]);

    }
}
