<?php
namespace App\Managers;

use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Auth;

class UserManager {

    /**
     * @param Request $request
     * Create user and authenticate
     */
    public function create(Request $request){
        $user = User::create([
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);
        Auth::login($user);
    }

    public function showFriends($id){
        $data = User::getFriends($id);
        $friends = [];
        foreach($data as $friend){
            if($friend->sender_id == $id){
                $friends[] = User::find($friend->receiver_id);
                continue;
            }elseif($friend->receiver_id == $id){
                $friends[] = User::find($friend->sender_id);
                continue;
            }
        }
        return json_encode($friends);
    }

    public function find(Request $request){
        $searchTerms = $parts = preg_split('/\s+/', $request->get('name'));
        $users = User::where(function ($query) use ($searchTerms) {
            foreach ($searchTerms as $searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('surname', 'LIKE', "%{$searchTerm}%");
            }
        })->get();
        return $users->toJson(JSON_PRETTY_PRINT);
    }
}
