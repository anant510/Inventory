<?php

namespace App\Http\Controllers;

use App\StockIN;
use Illuminate\Http\Request;
use App\Stock_out;
use App\ProductInfo;
use App\ProductCat;
use DB;

class StockoutController extends Controller
{
    public function index(){
        $product_category_datas = ProductCat::all();
        $product_information_datas = ProductInfo::all();
        $stock_out_datas = Stock_out::all();
        $stock_in_datas = StockIN::all();

        return view('stock_out.index', compact('product_category_datas', 'product_information_datas', 'stock_out_datas', 'stock_in_datas'));
    }

    public function store(Request $request){
//    dd($request);

        $stock_out_data = Stock_out::all()->first();

//        $request->validate([
//            'stock_out_invoice_number' => 'required',
//            'stock_out_date' => 'required',
//
//            'addmore.*.category' => 'required',
//            'addmore.*.product' => 'required',
//            'addmore.*.actual_quantity' => 'required',
//            'addmore.*.quantity' => 'required',
//            'addmore.*.price' => 'required',
//            'addmore.*.discount' => 'required',
//            'addmore.*.discount_type' => 'required',
//            'addmore.*.total' => 'required',
//
//        ]);



        foreach ($request->addmore as $key => $value) {
//                dd($value);

            $category = $value['category'];

            $stock_out_data->category = $category;
            $stock_out_data->save();

            dd($stock_out_data);


//            $stock_out_data->stock_out_invoice_number = $request->stock_out_invoice_number;
//            $stock_out_data->stock_out_date = $request->stock_out_date;
//            $stock_out_data->category = $value['category'];
//            $stock_out_data->product = $value['product'];
//            $stock_out_data->actual_quantity = $value['actual_quantity'];
//            $stock_out_data->quantity = $value['quantity'];
//            $stock_out_data->price = $value['price'];
//            $stock_out_data->discount = $value['discount'];
//            $stock_out_data->discount_type = $value['discount_type'];
//            $stock_out_data->total = $value['total'];

            $stock_out_data->save();

            dd($stock_out_data);


        }

//        $rows = [];
//        foreach($leads as $key => $input) {
//            array_push($rows, [
//                'Subject_id' => isset($leads[$key]) ? $leads[$key] : '', //add a default value here
//                'Lead_id' => isset($subject_ids[$key]) ? $subject_ids[$key] : '' //add a default value here
//            ]);
//        }
//        Score::insert($rows);


        return back()->with('success', 'Record Created Successfully.');
    }


    public function price(Request $request){
        dd($request->total_value);
    }

    public function category_data(Request $request){

//        $stock_in_id = StockIN::FindOrFail($id);
//        dd($stock_in_id);
        $data = $request->category_id;
//        dd($data);

        $matched_category_id = StockIN::where('category_id', '=' , $data);

//            dd($data);


//        $original_stock_in_id = DB::query ('SELECT * FROM stock_i_n_s WHERE category_id = $data');

//        dd($stock_in_id);

//        return view('stock_out.index', compact('matched_category_id'));

        return response()->json($matched_category_id);

    }


}
