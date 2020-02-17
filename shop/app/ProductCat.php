<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Stock_out;

class ProductCat extends Model
{
    protected $fillable = [
        'category_name',
    ];

    public function stock_out()
    {
        return $this->belongsTo('App\Stock_out', 'category_id' , 'id');
    }
}
