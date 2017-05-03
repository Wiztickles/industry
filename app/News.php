<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function user(){
        return $this->belongsTo('\App\User');
    }

    public function comments(){
        return $this->hasMany('\App\NewsComment', 'news_id');
    }

    protected $table = "news";
}
