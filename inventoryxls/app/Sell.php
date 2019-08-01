<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $fillable = [
        'pcode', 'pname', 'pdetail', 'pprice', 'pquantity', 'pimage'
    ];

    public function sellprice(){
	return $this->belongsTo('App\Sell', 'sid', 'id');
	}
}
