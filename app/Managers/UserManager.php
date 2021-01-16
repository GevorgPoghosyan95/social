<?php
namespace App\Managers;

use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Auth;

class UserManager {

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
}
