<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductBill;

class ProductController extends Controller
{
    public function index(){

        return view('test');
    }

    public function test1(Request $request){

        $data = $request->asearch;
//      dd($data);
        $test_row1 = ProductBill::where('name', 'like', "%$data%")->get();

        return view('test1', compact('test_row1'));
    }
}
