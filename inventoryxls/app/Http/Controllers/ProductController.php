<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sell;
use App\Buy;
use App\SellPrice;
use DB;
use Excel;

class ProductController extends Controller
{
    

     public function index()
    {
        $var_sell1 = Sell::paginate(5);
        $codes = Buy::paginate(5);
        $table_price_datas = SellPrice::paginate(5);
        return view('admin.index', compact('var_sell1', 'codes', 'table_price_datas'));
    }


     public function downloadExcel($type)
    {
        $data = Sell::where('pquantity','<',5)->get()->toArray();
            
        return Excel::create('Less_Stock_Report', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
                // dd($data);
            });
        })->download($type);
    }

     public function Excel($type)
    {
        $data = Sell::get()->toArray();
            
        return Excel::create('Sell_Report', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
                // dd($data);
            });
        })->download($type);
    }


     public function importExcel(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);
 
        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
 
        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = ['pcode' => $value->pcode, 'pname' => $value->pname, 'pdetail' => $value->pdetail, 'pprice' => $value->pprice, 'pquantity' => $value->pquantity ];
            }
             
 
            if(!empty($arr)){
                Buy::insert($arr);
            }else{

            }
        }
 
        return back()->with('success', 'Insert Record successfully.');
    }


     public function sell_edit($id){

        $row_sell_edit = Sell::findOrFail($id);
        
        return view('admin.sell_edit', compact('row_sell_edit'));    
    }


       public function sell_delete(Request $request, $id){

        $row_data = Sell::findOrFail($id);
        // dd($row_data);

        $row_data->delete();

        return redirect('admin/index');
    }

      public function sell_edit1(Request $request, $id){

        $row_sell_data = Sell::findOrFail($id);
        // dd($row_sell_data);


        $row_sell_data->pname = $request->pname;
        $row_sell_data->pdetail = $request->pdetail;
        $row_sell_data->pprice = $request->pprice;
        $row_sell_data->pquantity = $request->pquantity;

        // dd($row_sell_data);
        $row_sell_data->save();

        return redirect('admin/index');
    }

    public function add_product(){

        return view('admin.add_product');
    }


     public function store_product(Request $request){

        $tests = new Buy();
        $values = new Sell();

       //  if($values !== $request->pcode)
       //  {
            
       //  }else{
       //      dd('false');
       //  }
       //  // $val = Sell::where('pcode')->get();
       // dd($values);



        // $row1 = Sell::where('pquantity')->get();
        // $data1 = $request->pcode;
        //  $data2 = $values->pcode;
        // print_r($data2); die();

        // if($request->pcode == $values->pcode){
        //     dd('true');
        // }else{
        //     dd('false');
        // }


        $validatedData = $request->validate([
        'pcode' => 'required|unique:sells',
        'pname' => 'required',
        'pdetail' => 'required',
        'pprice' => 'required',
        'pquantity' => 'required', 
        ]);

        if($validatedData){

        // if($request->pcode !== $values->sell()->pcode )    

        $tests->pcode = $request->pcode;
        $tests->pname = $request->pname;
        $tests->pdetail = $request->pdetail;
        $tests->pprice = $request->pprice;
        $tests->pquantity = $request->pquantity;
        if($request->pimage){
        $tests->pimage = $request->pimage;
        }

        $values->pcode = $request->pcode;
        $values->pname = $request->pname;
        $values->pdetail = $request->pdetail;
        $values->pprice = $request->pprice;
        $values->pquantity = $request->pquantity;
        if($request->pimage){
        $values->pimage = $request->pimage;
        }




        // dd($values);
        $tests->save();
        $values->save();

        }

        return redirect('admin/index');
    }

    public function add_same_product(){

        return view('admin.add_same_product');
        
    }

     public function add_same_product_query(Request $request){

         $get_value1 = $request->asearch;
         // dd($get_value1);
        $test_row1 = Sell::where('pcode', 'like', "%$get_value1%")->get();

        return view('admin.add_same_product_query', compact('test_row1'));
        
    }


     public function add_same_product1(Request $request, $id){

            $value = $request->add_quantity1;
            // dd($value);


            $row_add_sell = Sell::find($id);
            $row_add_buy = Buy::find($id);


            // $value = $request->add_quantity1;
            // dd($value);

            $sell_qty = $row_add_sell->pquantity;
            $buy_qty = $row_add_buy->pquantity;


            // echo  $buy_qty, $sell_qty; die();

            $add_value_sell = $sell_qty + $value;
            $add_value_buy = $buy_qty + $value;


            $row_add_sell->pquantity = $add_value_sell;
            $row_add_buy->pquantity = $add_value_buy;
            // dd( $add_value_buy); die();

            $row_add_sell->save();
            $row_add_buy->save();

            return redirect('admin/index');
            
    }

    public function sell_product(){
        return view('admin.sell_product');
    }

    public function query_sell(Request $request){

     $term = $request->isearch;
     // dd($term);

        
        $tests = Sell::where('pcode', 'like', "%$term%")->get();

        // $table = '<table id="" class="table table-hover"><thead><tr><th>pcode</th><th>pname</th><th>pquantity</th></tr></thead><tbody>';
        //    foreach($tests as $test) {
        //         $table .= '<tr><td>';
        //         $table .= $test->pcode ;
        //         $table .= '</td><td>';
        //         $table .= $test->pname;
        //         $table .= '</td><td>';
        //         $table .= $test->pquantity;
        //         $table .= '</td><td>';
        //         $table .= '<form action="'.route("admin.sell_product1") .'" method="post"> <meta name="csrf-token" content="'. csrf_token() .'  " /><input type="text" name="sell_pro" class="form-control">';
                
        //         $table .= '<button type="submit" name="submit" class="btn btn-primary">Sell</button>';
        //         $table .= '</form></td></tr>';
        //     }
        //     $table .= '</tbody></table>';


        //     return response()->json($table);

        return view('admin.query_sell', compact('tests'));


    }

     public function sell_product1(Request $request, $id){
        // dd('succes');


        $sell_product_data = $request->sell_pro;

        $mul_product_data = $request->sell_price;

        $data_sell_price = SellPrice::find($id);

        if($data_sell_price) {
            // dd("true");
         $var1 = $data_sell_price->pquantity;
         $var2 = $data_sell_price->pprice;

        // dd($var1);
         $data_sell_price->sid = $id;
         $data_sell_price->pquantity =  $sell_product_data + $var1;
         $data_sell_price->pprice =  $mul_product_data + $var2;

         $data_sell_price->save();
        } else {
            // dd("false");

             // $data_sell_price_new = new SellPrice($id);
            $price_create_new = new SellPrice();

            if($id){
                // dd($id);
            

             $price_create_new->sid = $id;
            
            $price_create_new->pquantity = $request->sell_pro;
            $price_create_new->pprice = $request->sell_price;
            // dd($cart);

            $price_create_new->save();

            }
           
          

    
   

        }

         
        $data = Sell::findOrfail($id);

        $variable1 =$data->pquantity;
        $variable2 = $request->sell_pro;


        $var= $variable1 - $variable2;

        // if($var <=10 ){
        //     echo "exampleModal1"; 
            
            
        //     // echo "<script>";
        //     // echo "alert('hello');";
        //     // echo "</script>";
            
            
        // }


        $data->pquantity = $var;
        
        $data->save(); 



        // return redirect('admin/index')->back()->with('alert','hello');
        return redirect('admin/sell_product');

    }








}
