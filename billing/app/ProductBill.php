<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBill extends Model
{
    protected $fillable = [
        'name', 'quantity', 'price',
    ];

}
