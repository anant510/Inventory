<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockIN;
use DataTables;
use DB;


class StockINAjaxController extends Controller
{
    public function index(Request $request)
    {

//        dd($request);
//        $test = StockIN::all();
//        dd($test);

        if ($request->ajax()) {
            $data = DB::select('SELECT stock_i_n_s.*, product_infos.name_information, product_cats.category_name, vendors.name FROM stock_i_n_s JOIN product_infos JOIN product_cats JOIN vendors WHERE product_infos.id = stock_i_n_s.product_information_id AND product_cats.id = stock_i_n_s.category_id');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-quantity="'.$row->quantity.'" data-id="'.$row->id.'" data-original-title="add_delete_quantity" class="btn btn-primary btn-sm add_delete_quantity">Quantity</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('stock_in.index',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        StockIN::updateOrCreate(['id' => $request->product_id],
            ['category_id' => $request->category_id, 'product_information_id' => $request->product_information_id, 'vendor_id' => $request->vendor_id, 'quantity' => $request->quantity, 'buying_price' => $request->buying_price, 'selling_price' => $request->selling_price, 'date' => $request->date, 'stock_note' => $request->stock_note]);

        return response()->json(['success'=>'Product saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = StockIN::find($id);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StockIN::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }


}
