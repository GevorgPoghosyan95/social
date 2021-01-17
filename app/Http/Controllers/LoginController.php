<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Managers\UserManager;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    public $userManager;
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * Show login page
     */

    public function index()
    {
        return view('login.index');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * Authenticate users
     */

    public function login(LoginRequest $request)
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('personal');

        } else {
            return redirect()->back()->withErrors('Email or Password incorrect');
        }
    }

    /**
     * Show user profile page
     */

    public function personal()
    {
        $friends = $this->userManager->showFriends(Auth::id());
        $posts = Auth::user()->posts;
        return view('personal.index',compact('friends','posts'));
    }

    /**
     * Logout user
     */

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
