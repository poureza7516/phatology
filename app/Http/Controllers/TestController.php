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
                return $test;
                break;
            }
            else $test='Not found';
        }
        return view('\employee views\Patient',compact('test'));
    }


    public function createTest(Request $request)
    {
        $test=new Test();
        $test->name=$request->input('name');
        $test->reception_id=1;//$request->input('reception_id');
        $test->save();
    }

    public function updatetests(Request $request,Test $test)
    {
        $tests=Test::all();
        foreach ($tests as $test)
        {
            if ($test->reception_id == $request->input('reception_id'))
            {
                $test->result=$request->input("result");
                $test->result=$request->input("description");
                $test->update();
            }
        }
    }
}
