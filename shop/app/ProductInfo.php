<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StockIN;

class ProductInfo extends Model
{
    protected $fillable = [
        'name_information','note','cat_id'
    ];

    public function stock_out()
    {
        return $this->belongsTo('App\StockIN', 'product_information_id' , 'id');
    }
}
