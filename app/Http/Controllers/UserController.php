<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('login.create');
    }

    public function create(CreateUserRequest $request){
       $user = User::create([
            'name'=>$request->get('name'),
            'surname'=>$request->get('surname'),
            'email'=>$request->get('email'),
            'password'=>bcrypt($request->get('password'))
        ]);
        Auth::login($user);

        return redirect()->route('personal');
    }
}
