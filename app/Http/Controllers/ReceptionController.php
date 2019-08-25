<?php

namespace App\Http\Controllers;

use App\Reception;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    public function createreception(Request $request)
    {
        $reception=new Reception();
        $reception->reception_date=$request->input('reception_date');
        $reception->answer_date=$request->input('answer_date');
        $reception->user_id=$request->input('user_id');
        $reception->status=$request->input('status');
        $reception->payment=$request->input('payment');
        $reception->save();
    }
}
