<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCat;

class ProductCategory extends Controller
{
    public function index(){

        return view('product_cat.index');
    }
}
