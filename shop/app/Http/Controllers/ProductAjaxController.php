<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use DataTables;

class ProductAjaxController extends Controller
{
    public function index(Request $request){

        if ($request->ajax()) {
            $data = Vendor::all();
//            dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

//                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vendor.index',compact('products'));
    }



    public function store(Request $request)
    {
        Vendor::updateOrCreate(['id' => $request->product_id],
            ['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'address' => $request->address]);

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
        $product = Vendor::find($id);
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
        Vendor::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }




}
