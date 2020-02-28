<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chat extends Model
{
    //
    protected $fillable = [
        'from', 'to', 'message','image','typing'
    ];

    public function chatuser1(){
        return $this->belongsTo('\App\User','from','id');
    }

    public function chatuser2(){
        return $this->belongsTo('\App\User','to','id');
    }

}
