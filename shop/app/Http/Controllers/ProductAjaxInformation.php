<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductInfo;
use App\ProductCat;
use DataTables;
use DB;

class ProductAjaxInformation extends Controller
{
    public function index(Request $request)
    {

//        $data = DB::select('SELECT product_infos.*,product_cats.name FROM product_infos JOIN product_cats WHERE product_infos.cat_id = product_cats.id');
//        dd($data);

        if ($request->ajax()) {
            $data = DB::select('SELECT product_infos.*,product_cats.category_name FROM product_infos JOIN product_cats WHERE product_infos.cat_id = product_cats.id');
//            $data = ProductInfo::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('product_info.index',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ProductInfo::updateOrCreate(['id' => $request->product_id],
            ['name_information' => $request->name_information, 'note' => $request->note, 'cat_id' => $request->cat_id]);

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
        $product = ProductInfo::find($id);
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
        ProductInfo::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }


}
