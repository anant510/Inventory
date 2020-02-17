@extends('admin.index')

@section('content')

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

{{--<div class="container padding">--}}

{{--    <!-- Large modal -->--}}
{{--    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>--}}

{{--    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-lg">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputEmail1">Invoice Number</label>--}}
{{--                                <input type="text" class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputEmail1">Invoice Date</label>--}}
{{--                                <input type="text" class="form-control">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}

{{--                <div class="modal-body">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}

{{--                            <form action="{{ route('stock_out.add_more_post') }}" method="POST">--}}
{{--                                @csrf--}}

{{--                                @if ($errors->any())--}}
{{--                                    <div class="alert alert-danger">--}}
{{--                                        <ul>--}}
{{--                                            @foreach ($errors->all() as $error)--}}
{{--                                                <li>{{ $error }}</li>--}}
{{--                                            @endforeach--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                                @if (Session::has('success'))--}}
{{--                                    <div class="alert alert-success text-center">--}}
{{--                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>--}}
{{--                                        <p>{{ Session::get('success') }}</p>--}}
{{--                                    </div>--}}
{{--                                @endif--}}

{{--                                <table class="table table-bordered" id="dynamicTable">--}}
{{--                                    <tr>--}}
{{--                                        <th>Category</th>--}}
{{--                                        <th>Product</th>--}}
{{--                                        <th>Actual Quantity</th>--}}
{{--                                        <th>Quantity</th>--}}
{{--                                        <th>Price</th>--}}
{{--                                        <th>Discount</th>--}}
{{--                                        <th>Discount Type</th>--}}
{{--                                        <th>Total</th>--}}
{{--                                        <th>Action</th>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td><input type="text" name="addmore[0][category]" placeholder="Enter your Name" class="form-control" /></td>--}}
{{--                                        <td><input type="text" name="addmore[0][product]" placeholder="Enter your Qty" class="form-control" /></td>--}}
{{--                                        <td><input type="text" name="addmore[0][actual_quantity]" placeholder="Enter your Price" class="form-control" /></td>--}}
{{--                                        <td><input type="text" name="addmore[0][quantity]" placeholder="Enter your Price" class="form-control" /></td>--}}
{{--                                        <td><input type="text" name="addmore[0][price]" placeholder="Enter your Price" class="form-control" /></td>--}}
{{--                                        <td><input type="text" name="addmore[0][discount]" placeholder="Enter your Price" class="form-control" /></td>--}}
{{--                                        <td><input type="text" name="addmore[0][discount_type]" placeholder="Enter your Price" class="form-control" /></td>--}}
{{--                                        <td><input type="text" name="addmore[0][total]" placeholder="Enter your Price" class="form-control" /></td>--}}
{{--                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>--}}
{{--                                    </tr>--}}
{{--                                </table>--}}

{{--                                <button type="submit" class="btn btn-success">Save</button>--}}
{{--                            </form>--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="container padding">



    <div class="card-body">


        <form action="{{ route('stock_out.store') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_methid" type="post">

           @include('error')

            @if (Session::has('success'))
                <div class="alert alert-success text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Invoice Number</label>
{{--                        <input type="text" id="invoice_increment" name="stock_out_invoice_number" class="form-control"  value="1" readonly>--}}

                        @foreach($stock_out_datas as $stock_out_data)
                            {{--                    <h1>{{ $stock_out_data->count() }}</h1>--}}
                            {{--                <h1>{{ $stock_out_data }}</h1>--}}
                            @if($stock_out_data == null)
                                <input type="text" id="invoice_increment" name="stock_out_invoice_number" class="form-control"  value="1" readonly>

                            @else
                                <input type="text" id="invoice_increment" name="stock_out_invoice_number" class="form-control"  value="{{ $stock_out_data->stock_out_invoice_number+1  }} " readonly>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1" >Invoice Date</label>
                        <input type="text" id="datepicker" name="stock_out_date" class="form-control">
                    </div>
                </div>
            </div>

            <table class="table-responsive table-bordered" id="dynamicTable">
                <tr style="background: green; color: white;">
                    <th>Category</th>
                    <th>Product</th>
                    <th>Actual Quantity</th>
                    <th>Quantity</th>
                    <th>Selling Price &nbsp;</th>
                    <th>Discount</th>
                    <th>Discount Type</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>
{{--                        <select name="addmore[0][category]" id="stock_out_category" class="form-control">--}}
{{--                            <option value=""></option>--}}
{{--                        </select>--}}
{{--                        <select name="addmore[0][category]" id="stock_out_category" class="form-control stock_out_category">--}}
{{--                            @foreach($product_category_datas as $product_category_data)--}}
{{--                            <option value="{{ $product_category_data->id }}">{{ $product_category_data->category_name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}

                        <select name="addmore[0][category]" id="stock_out_category" class="form-control ">
                            @foreach($stock_in_datas as $stock_in_data)
                                <option value="{{ $stock_in_data->category_id }}">{{ $stock_in_data->ProductCat->category_name }}</option>

                            @endforeach
                        </select>
{{--                        <input type="text" name="addmore[0][category]" placeholder="Enter your Name" class="form-control" />--}}
                    </td>


                    <td>
                        <select name="addmore[0][product]" id="stock_out_product" class="form-control stock_out_product">

                            <option value=""></option>

                        </select>

{{--                        <select name="addmore[0][product]" id="stock_out_product" class="form-control">--}}
{{--                            @foreach($product_information_datas as $product_information_data)--}}
{{--                            <option value="{{ $product_information_data->id }}">{{ $product_information_data->name_information }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}

{{--                        <select name="addmore[0][product]" id="stock_out_product" class="form-control">--}}
{{--                            @foreach($stock_in_datas as $stock_in_data)--}}
{{--                                <option value="{{ $stock_in_data->product_information_id }}">{{ $stock_in_data->ProductInfo->name_information }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}

{{--                        <input type="text" name="addmore[0][product]" placeholder="Enter your Qty" class="form-control" />--}}
                    </td>


                    <td>
                        <select name="" id="actual_quantity" class="form-control" readonly="">
                        @foreach($stock_in_datas as $stock_in_data)
                                <option value="">{{ $stock_in_data->quantity }}</option>
{{--                        <input type="text" name="addmore[0][actual_quantity]" placeholder="" class="form-control" value="{{ $stock_in_data->quantity }}"/>--}}
                        @endforeach
                        </select>

                    </td>

                    <td><input type="text" name="addmore[0][quantity]" id="quantity" placeholder="Quantity" class="form-control" /></td>
                    <td>
                        <select id="price" name="addmore[0][price]"  class="form-control " readonly="">
                            @foreach($stock_in_datas as $stock_in_data)
                            <option value="" data-quantity="{{ $stock_in_data->selling_price }}">{{ $stock_in_data->selling_price }}</option>
                            @endforeach
                        </select>
{{--                        <input type="text" name="addmore[0][price]" placeholder="Price" class="form-control" />--}}
                    </td>
                    <td><input type="text" name="addmore[0][discount]" placeholder="%" class="form-control" /></td>
                    <td><input type="text" name="addmore[0][discount_type]" placeholder="" class="form-control" /></td>
                    <td><input type="text" name="addmore[0][total]" placeholder="Total" class="form-control" /></td>
                    <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                </tr>
            </table>

            <button type="submit" class="btn btn-success">Save</button>
        </form>

    </div>

    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-2"><b>Total Price: Rs</b></div>
                <div class="col-md-2"><b>Total Discount: RS</b></div>
                <div class="col-md-2"><b>Net Payable Amount: RS</b></div>
                <div class="col-md-2"><b>Net Pay Now: RS</b>
                    <input type="text" name="stock_out_pay" class="form-control">
                </div>
                <div class="col-md-2"><b>Due Amount: RS</b></div>
                <div class="col-md-2"><button type="submit" class="btn btn-primary">Submit</button></div>

            </div>
        </div>
    </div>

</div>






<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>

    <script>
        $('#datepicker').datepicker();
    </script>


{{--    <script>--}}
{{--        var invoice_add = 1;--}}
{{--        $('#invoice_increment').click(function(){--}}

{{--            invoice_add++;--}}
{{--debugger;--}}
{{--console.log(invoice_add);--}}
{{--            $("#test");--}}
{{--        });--}}
{{--    </script>--}}



<script type="text/javascript">

    var i = 0;

    $("#add").click(function(){
// debugger;
        ++i;

        $("#dynamicTable").append('<tr><td><select name="addmore['+i+'][category]" id="stock_out_category" class="form-control">@foreach($product_category_datas as $product_category_data)<option value="{{ $product_category_data->id }}">{{ $product_category_data->category_name }}</option>@endforeach</select></td><td><select name="addmore['+i+'][product]" id="stock_out_product" class="form-control">@foreach($product_information_datas as $product_information_data)<option value="{{ $product_information_data->id }}">{{ $product_information_data->name_information }}</option>@endforeach</select></td><td><input type="text" name="addmore['+i+'][actual_quantity]" placeholder="" class="form-control" /></td><td><input type="text" name="addmore['+i+'][quantity]" placeholder="Quantity" class="form-control" /></td><td><input type="text" name="addmore['+i+'][price]" placeholder="Price" class="form-control" /></td><td><input type="text" name="addmore['+i+'][discount]" placeholder="%" class="form-control" /></td><td><input type="text" name="addmore['+i+'][discount_type]" placeholder="" class="form-control" /></td><td><input type="text" name="addmore['+i+'][total]" placeholder="Total" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });

    $(document).on('click', '.remove-tr', function(){
        $(this).parents('tr').remove();
    });

</script>



    <script type="text/javascript">
        $(document).ready(function () {
           $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
           });

           $("#stock_out_category").on('change' ,function (e) {
               // var category_id = $("#stock_out_category").val();
                var category_id = e.target.value;

            $.get('category_data', + category_id, function(data){
               $('#stock_out_product').empty();
               $('#stock_out_product').append('<option value="">Select Product</option>');

               $.each(data, function(matched_category_id, stock_out_product_obj ){
                   // console.log(index, stock_out_product_obj);
                   $('#stock_out_product').append('<option value="' + stock_out_product_obj.id +'">+ stock_out_product_obj.product_information_id +</option>');

               });

            });
               // var value   = e.target.value;

               // alert(category_id);
               {{--var url =  "{{ URL::to('/') }}";--}}
               {{--// alert(url);--}}
               {{--// console.log(url, category_id);--}}
               {{--$.ajax({--}}
               {{--    type:"POST",--}}
               {{--    url: url+"/stock_out/category_data",--}}
               {{--    data:{--}}
               {{--         'category_id': category_id,--}}
               {{--    },--}}
               {{--    success:function (response) {--}}
               {{--        $("#stock_out_product").html(response).show();--}}
               {{--        $(".stock_out_product").html(response).show();--}}
               {{--    }--}}
               {{--});--}}
           });
        });
    </script>



    <script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#quantity").keyup(function(){
            var quantity = $("#quantity").val();
            console.log(quantity);
            var el = document.querySelector('#price');
            var price = el.dataset.quantity;
            var product = price*quantity;
            console.log(product);
            alert(product);
            $("#sell_price").attr("value", product);


            var url = "{{ URL::to('/') }}";

            $.ajax({
                type:"POST",
                url: url+"/stock_out/total_value",
                data:{
                  'product': product,
                },
                success:function(response){

                }
            });
        });

    });
    </script>


    @endsection