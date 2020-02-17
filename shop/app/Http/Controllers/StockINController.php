<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use App\ProductCat;
use App\ProductInfo;
use App\StockIN;
use DataTables;

class StockINController extends Controller
{
    public function index(){

        $vendor_datas = Vendor::all();
        $product_category_datas = ProductCat::all();
        $product_information_datas = ProductInfo::all();

        return view('stock_in.index', compact('vendor_datas', 'product_category_datas','product_information_datas'));
    }


    public function quantity_update(Request $request, $id){
//        dd($id);
//        dd($request->add);

        $values = StockIN::Find($id);
//        $data = $request->add;

        $values->quantity = $request->add;

        $values->save();

//        dd($data);

        return redirect('stock_in/index');

    }


    public function quantity_subtract(Request $request, $id){
//        dd($id);
//        dd($request->add);

        $values = StockIN::Find($id);
//        $data = $request->add;

        $values->quantity = $request->add;

        $values->save();

//        dd($data);

        return redirect('stock_in/index');

    }
}
