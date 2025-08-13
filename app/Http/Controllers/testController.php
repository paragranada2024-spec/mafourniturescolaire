<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class testController extends Controller
{
     public function test(Request $request){
          $name = strtolower('youssef');
        return view('test',compact('name'));
     }
}
