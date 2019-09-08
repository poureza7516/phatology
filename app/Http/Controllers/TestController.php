<?php

namespace App\Http\Controllers;
use App\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{


    public function search(Request $request,Test $test)
    {
        $reception_id=$request->input('reception_id');
        $tests=Test::all();
        foreach ($tests as $test)
        {
            if($test->reception_id == $reception_id)
            {
                $record[]=$test;
            }
             else
                 return 'Not found';
        }
        return $record;
    }




    public function createTest(Request $request)
    {
        $test=new Test();
        $test->name=$request->input('name');
        $test->reception_id=$request->input('reception_id');
        $test->save();
        return $test;
    }

///////////////////////////seyed nvis/////////////////////////////
    public function updatetest(Request $request)
    {
        $test = Test::find($request->input('id'));
        $test->result = $request->input('result');
        $test->description = $request->input('description');
        $test->save();
        return $test;
    }
    ////////////////////////////////////////////////////////////
}
