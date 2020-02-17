<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductCat;
use App\ProductInfo;

class StockIN extends Model
{
    protected $fillable = [
        'category_id','product_information_id','vendor_id','quantity','buying_price','selling_price','date','stock_note'
    ];

    public function productcat()
    {
        return $this->belongsTo('App\ProductCat', 'category_id' , 'id');
    }

    public function productinfo()
    {
        return $this->belongsTo('App\ProductInfo', 'product_information_id' , 'id');
    }
}
