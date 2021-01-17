<?php


function userHasFriendRequest($user)
{
    return Auth::user()->friendRequests()->where('receiver_id', $user->id)->where('status', 'pending')->count();
}

function userHasRejectedRequest($user)
{
    if (Auth::user()->friendRequests()
            ->where('receiver_id', $user->id)
            ->where('status', 'rejected')->count() || Auth::user()->receivedRequests()->where('id', $user->id)->count()) {
        return true;
    }
}


function usersAreFriends($user)
{
    return DB::table('relations')
        ->where(function ($query) use ($user) {
        $query->where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->where('status', 'approved');
    })->orWhere(function ($query) use ($user) {
        $query->where('sender_id', Auth::id())
            ->where('receiver_id', $user->id)
            ->where('status', 'approved');
    })->exists();
}
