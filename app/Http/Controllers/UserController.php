<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view('login.create');
    }

    public function create(CreateUserRequest $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);
        Auth::login($user);

        return redirect()->route('personal');
    }

    public function find(Request $request)
    {
        $searchTerms = $parts = preg_split('/\s+/', $request->get('name'));
        $users = User::where(function ($query) use ($searchTerms) {
            foreach ($searchTerms as $searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('surname', 'LIKE', "%{$searchTerm}%");
            }
        })->get();
        return $users->toJson(JSON_PRETTY_PRINT);
    }

    public function showProfile($userID)
    {
        $user = User::find($userID);
        if ($user == Auth::user()) {
            return redirect()->route('personal');
        }
        if ($user) {
            return view('personal.other', compact('user'));
        } else {
            return view('personal.not_found');
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

    public function showFriends(Request $request){
        $data = User::getFriends($request->get('id'));
        $friends = [];
        foreach($data as $friend){
            if($friend->sender_id == $request->get('id')){
                $friends[] = User::find($friend->receiver_id);
                continue;
            }elseif($friend->receiver_id == $request->get('id')){
                $friends[] = User::find($friend->sender_id);
                continue;
            }
        }
        return json_encode($friends);
    }

}
