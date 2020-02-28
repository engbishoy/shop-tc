<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    //
    public function user(){
         return $this->belongsTo('App\User','user_id','id'); 
        }
     public function categories(){
          return $this->belongsTo('App\categories','cat_id','id'); 
        }
}
