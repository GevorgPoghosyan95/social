<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Managers\UserManager;
use App\Post;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public $userManager;
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function index()
    {
        return view('login.index');
    }

    public function login(LoginRequest $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('personal');

        } else {
            return redirect()->back()->withErrors('Email or Password incorrect');
        }
    }

    public function personal()
    {
        $friends = $this->userManager->showFriends(Auth::id());
        $posts = Auth::user()->posts;
        return view('personal.index',compact('friends','posts'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}
