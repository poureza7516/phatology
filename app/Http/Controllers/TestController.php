<?php

namespace App\Http\Controllers;
use App\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function createTest(Request $request)
    {
        $test=new Test();
        $test->name=$request->input('name');
        $test->reception_id=$request->input('reception_id');
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
