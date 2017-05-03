<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsComment extends Model
{
    public function user(){
        return $this->belongsTo('\App\User');
    }

    public function news(){
        return $this->belongsTo('\App\News');
    }
    protected $table = "news_comments";
}
