<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;
use DataTables;

class VendorController extends Controller
{
    public function index(Request $request){

//        dd($request);
//        $vendor_datas = Vendor::all();


//
//        if ($request->ajax()) {
//            $data = Vendor::all();
////            dd($data);
//            return Datatables::of($data)
//                ->addIndexColumn()
//                ->addColumn('action', function($row){
//
//                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
//
//                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
//
////                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
//
//                    return $btn;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
//        }

        return view('vendor.index');
    }

    public function store(Request $request){

//        dd($request);


//        $request->validate([
//            'name' => 'required|unique:vendors|max:255',
//            'email' => 'required',
//            'phone' => 'required',
//            'address' => 'required',
//        ]);


        $vendor_data = new Vendor();

        $vendor_data->name = $request->vendor_name;
        $vendor_data->email = $request->vendor_email;
        $vendor_data->phone =$request->vendor_phone;
        $vendor_data->address = $request->vendor_address;

//        dd($vendor_data);

        $vendor_data->save();

        return view('vendor.index');
    }
}
