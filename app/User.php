<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name','bio','phone_number', 'skills', 'email', 'password', 'recive_text_updates', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'admin',
    ];

    public function projectComment(){
        return $this->hasMany('\App\Project_comment', 'user_id');
    }

    public function news(){
        return $this->hasMany('\App\News', 'user_id');
    }

    public function newsComment(){
        return $this->hasMany('\App\News_comment', 'user_id');
    }

    public function archive(){
        return $this->hasMany('\App\Archive', 'user_id');
    }

    public function archiveComment(){
        return $this->hasMany('\App\Archive_comment', 'user_id');
    }


}


