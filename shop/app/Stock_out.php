<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductCat;
use App\ProductInfo;
use App\StockIN;

class Stock_out extends Model
{
    protected $fillable = [
        'stock_out_invoice_number', 'stock_out_date','category','product','quantity','quantity', 'price','discount', 'total',
    ];

    public function productcat()
    {
        return $this->belongsTo('App\ProductCat');
    }

    public function productinfo()
    {
        return $this->belongsTo('App\ProductInfo');
    }

    public function stockin()
    {
        return $this->belongsTo('App\StockIN');
    }


}
