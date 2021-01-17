<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Managers\UserManager;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $userManager;
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * show register users page
     */

    public function index()
    {
        return view('login.create');
    }


    public function create(CreateUserRequest $request)
    {
        $this->userManager->create($request);
        return redirect()->route('personal');
    }

    public function find(Request $request)
    {
        return $this->userManager->find($request);
    }

    public function showProfile($userID)
    {
        $user = User::find($userID);
        $friends = $this->userManager->showFriends($userID);
        if ($user == Auth::user()) {
            return redirect()->route('personal');
        }
        if ($user) {
            return view('personal.other', compact('user','friends'));
        } else {
            return abort('404');
        }
    }

    public function friendRequest(Request $request)
    {
        return $this->userManager->friendRequest($request);
    }

    public function updateRelationStatus($request, $status)
    {
        return $this->userManager->updateRelationStatus($request,$status);
    }


}
