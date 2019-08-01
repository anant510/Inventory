<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
   protected $fillable = [
        'pcode', 'pname', 'pdetail', 'pprice', 'pquantity', 'pimage'
    ];

     public function user(){
    	return $this->belongsTo('App\User', 'id', 'buy_id');
    }
}
