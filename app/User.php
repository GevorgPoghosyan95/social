<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function friendRequests(){
        return $this->belongsToMany(User::class, 'relations','sender_id','receiver_id');
    }

    public function receivedRequests(){
        return $this->belongsToMany(User::class, 'relations','receiver_id','sender_id')->where('status','pending');
    }

    static function getFriends($id){
        $data = DB::table('relations')
            ->where(function ($query) use($id) {
                $query->where('sender_id',$id)
                    ->orWhere('receiver_id',$id);
            })->where('status','approved')->get();
        return $data;
    }

    public function posts(){
        return $this->hasMany(Post::class)->orderBy('id','desc');
    }
}
