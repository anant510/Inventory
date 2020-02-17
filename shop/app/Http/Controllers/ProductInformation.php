<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductInfo;
use App\ProductCat;

class ProductInformation extends Controller
{
    public function index(){

        $product_category = ProductCat::all();
        return view('product_info.index', compact('product_category'));
    }


}
