<?php


function userHasFriendRequest($user){
    return Auth::user()->friendRequests()->where('receiver_id',$user->id)->where(function ($query){
        $query->where('status','pending')
            ->orWhere('status','approved');
    })->count();
}

function userHasRejectedRequest($user){
    if(Auth::user()->friendRequests()
            ->where('receiver_id',$user->id)
            ->where('status','rejected')->count() || Auth::user()->receivedRequests()->where('id',$user->id)->count()){
        return true;
    }
}
