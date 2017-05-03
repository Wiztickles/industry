<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchiveComment extends Model
{
    public function archive(){
        return $this->belongsTo('\App\Archive');
    }

    public function user(){
        return $this->belongsTo('\App\User');
    }
}
