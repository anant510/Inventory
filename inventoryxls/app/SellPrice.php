<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellPrice extends Model
{
       protected $fillable = [
        'pquantity', 'pprice'
    ];


public function sell(){
	return $this->belongsTo('App\Sell', 'sid', 'id');
}
}
