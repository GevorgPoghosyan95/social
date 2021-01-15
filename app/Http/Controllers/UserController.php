<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('login.create');
    }

    public function create(Request $request){
        dd($request->all());
    }
}
