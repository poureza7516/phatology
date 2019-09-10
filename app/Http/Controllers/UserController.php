<?php

namespace App\Http\Controllers;
use App\Reception;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request,Reception $reception)
    {
        $reception=Reception::find($request->input('reception_id'));
        $user=User::find($reception->user_id);

        return json_encode(array(1=>$user,2=>$reception));
    }

    public function drop(Request $request,User $user)
    {

       $users=User::all();
       foreach ($users as $user)
       if ($user->national_id==$request->input('national_id'))
       {
           $user->delete();
           return 'shod';
       }
       return 'nshod';
    }
}
