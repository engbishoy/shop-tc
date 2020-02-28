<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class requests extends Model
{
    //

    protected $fillable = [
        'user_id1','user_id2','accept'
    ];

    public function userid1(){
      return  $this->belongsTo('\App\User','user_id1','id');
    }
    
    public function userid2(){
      return  $this->belongsTo('\App\User','user_id2','id');
    }


    
}
