<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    ///////////////////////////////////finding existing patient///////////////////////////////
    public function search(Request $request)
    {
        $national_id=$request->input('national_id');
       $users=User::all();
       foreach ($users as $user)
       {
           if($user->national_id == $national_id)
           {
               return $user;
               break;
           }
           else $user='Not found';
       }
       return view('\employee views\Patient',compact('user'));

    }
/////////////////////////////////////////////////////////////////////////////////




//////////////////////////////////////////////////redirecting /////////////////
    public function index()
    {
        return view('\adminp\patientmaster');
    }
    public function indexemployee()
    {
        return view('\adminp\master');
    }


    public function indexphatologsts()
    {
        return view('\adminp\resultmaster');
    }

    public function indexadmin()
    {
        return view('\adminp\adminmaster');
    }
}
