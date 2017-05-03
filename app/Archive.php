<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    public function user(){
        return $this->belongsTo('\App\User');
    }

    public function comments(){
        return $this->hasMany('\App\ArchiveComments', 'archive_id');
    }

    protected $table = "archive";
}
