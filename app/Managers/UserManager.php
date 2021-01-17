<?php
namespace App\Managers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class UserManager {

    /**
     * @param Request $request
     * Create user and authenticate
     */
    public function create(CreateUserRequest $request){
        $user = User::create($request->validated());
        Auth::login($user);
    }

    /**
     * Show user friends by id
     */

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

    /**
     * Find friends
     */
    public function findFriends(Request $request){
        $friendList = json_decode($this->showFriends($request->get('id')));
        $searchTerms = $parts = preg_split('/\s+/', $request->get('name'));
        $founded = [];
        foreach ($friendList as $friend) {
            foreach ($searchTerms as $searchTerm) {
                if (str_contains(strtolower($friend->name),strtolower($searchTerm)) || str_contains(strtolower($friend->surname),strtolower($searchTerm))) {
                    $founded[] = $friend;
                }
            }
        }
        return json_encode($founded);
    }

    /**
     * Find users
     */

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

    /**
     * Send friend request
     */

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

    /**
     * Update relation statuses between users
     */

    public function updateRelationStatus($request, $status)
    {
        DB::table('relations')
            ->where('sender_id', $request->get('sender_id'))
            ->where('receiver_id', $request->get('receiver_id'))
            ->where('status', 'pending')->update(['status' => $status]);
        return true;
    }
}
