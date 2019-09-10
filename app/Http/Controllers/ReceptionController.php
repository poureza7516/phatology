<?php

namespace App\Http\Controllers;

use App\Reception;
use App\User;
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
        $temp= $reception;
        return $temp;
    }

    public function showReceptions(Request $request)
    {
        $receptions=Reception::all();
        $user=auth()->user();

        foreach ($receptions as $reception)
        {
            if ($reception->user_id == $user->id)
            {
                $records[]=$reception;
            }
        }
        return $records;
    }


    public function payment(Request $request)
    {
        $total_payment=0;
        $receptions=Reception::all();
        foreach ($receptions as $reception)
        {
            if($reception->reception_date >=$request->input('start') && $reception->reception_date <=$request->input('end') )
            {
                $total_payment+=$reception->payment;
            }
        }
        return $total_payment;
    }


    public function receptioncount(Request $request)
    {
        $total_count=0;
        $receptions=Reception::all();
        foreach ($receptions as $reception) {
            if ($reception->reception_date >= $request->input('start') && $reception->reception_date <= $request->input('end'))
            {
                $total_count++;
            }
        }
        return $total_count;
    }


    public function update(Request $request)
    {
        $reception=Reception::find($request->input('id'));
        $reception->status='ready';
        $reception->save();
        return 1;
    }

}
