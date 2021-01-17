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
        switch ($request->get('status')) {
            case 'pending':
                DB::table('relations')->insert([
                    'sender_id'=>$request->get('sender_id'),
                    'receiver_id'=>$request->get('receiver_id'),
                    'status' => $request->get('status'),
                    "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                ]);
                break;
            case 'cancel':
                DB::table('relations')
                    ->where(function ($query) use ($request) {
                        $query->where('sender_id', $request->get('sender_id'))
                            ->where('receiver_id', $request->get('receiver_id'));
                    })->orwhere(function ($query) use ($request) {
                        $query->where('receiver_id', $request->get('sender_id'))
                            ->where('sender_id', $request->get('receiver_id'));
                            })
                    ->delete();
                break;
            case 'approved':
                $this->updateRelationStatus($request, $request->get('status'));
                break;
            case 'rejected':
                $this->updateRelationStatus($request, $request->get('status'));

        }
//
        return response()->json(['status' => 'ok']);
    }

    public function updateRelationStatus($request, $status)
    {

        DB::table('relations')
            ->where('sender_id', $request->get('sender_id'))
            ->where('receiver_id', $request->get('receiver_id'))
            ->where('status', 'pending')->update(['status' => $status]);
    }


}
