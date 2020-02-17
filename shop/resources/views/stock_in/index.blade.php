@extends('admin.index')

@section('content')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">



    <div class="container">
        <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Create Stock</a>
        <table class="table table-bordered data-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Category</th>
                <th>Product</th>
                <th>Vendor</th>
                <th>Quantity</th>
                <th>Buying Price</th>
                <th>Selling Price</th>
                <th>Date</th>
                <th>Note</th>
                <th width="280px">Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Select Category</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($product_category_datas as $product_category_data)
                                <option value="{{ $product_category_data->id }}">{{ $product_category_data->category_name }}</option>
                                @endforeach

                            </select>



                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Selling Product</label>


                            <select name="product_information_id" id="product_information_id" class="form-control">
                                @foreach($product_information_datas as $product_information_data)
                                <option value="{{ $product_information_data->id }}">{{ $product_information_data->name_information }}</option>
                                @endforeach

                            </select>


                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Select Vendor</label>

                            <select name="vendor_id" id="vendor_id" class="form-control">
                                @foreach($vendor_datas as $vendor_data)
                                <option value="{{ $vendor_data->id }}">{{ $vendor_data->name }}</option>
                                @endforeach

                            </select>


                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Quantity</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Buying Price</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="buying_price" name="buying_price" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Selling Price</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="selling_price" name="selling_price" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Today's Date</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="data" name="date" placeholder="Enter Name" value="{{ date('m/d/Y') }}" maxlength="50" required="" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Note</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="stock_note" name="stock_note" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('ajax_stock_in.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'category_name', name: 'category_name    '},
                    {data: 'name_information', name: 'name_information'},
                    {data: 'name', name: 'name'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'buying_price', name: 'buying_price'},
                    {data: 'selling_price', name: 'selling_price'},
                    {data: 'date', name: 'date'},
                    {data: 'stock_note', name: 'stock_note'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#createNewProduct').click(function () {
                $('#saveBtn').val("create-product");
                $('#product_id').val('');
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Product");
                $('#ajaxModel').modal('show');
            });

            $('body').on('click', '.editProduct', function () {
                var product_id = $(this).data('id');
                $.get("{{ route('ajax_stock_in.index') }}" +'/' + product_id +'/edit', function (data) {
                    $('#modelHeading').html("Edit Product");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    $('#category_name').val(data.category_name);
                    $('#name_information').val(data.name_information);
                    $('#name').val(data.name);
                    $('#quantity').val(data.quantity);
                    $('#buying_price').val(data.buying_price);
                    $('#selling_price').val(data.selling_price);
                    $('#date').val(data.date);
                    $('#stock_note').val(data.stock_note);
                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('ajax_stock_in.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#productForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            });

            $('body').on('click', '.deleteProduct', function () {

                var product_id = $(this).data("id");
                var check =  confirm("Are You sure want to delete !");
                // debugger;
                if (check == true) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('ajax_stock_in.store') }}"+'/'+product_id,
                        success: function (data) {
                            table.draw();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });

                } else {
                    txt = "You pressed Cancel!";
                    // debugger;
                }
                console.log(txt);


            });

            $('body').on('click', '.add_delete_quantity', function () {


                var product_id = $(this).data("id");

                var quantity = $(this).data("quantity");

                    var check =confirm("Do you want to ADD Quantity(Press ok)/ SUBTRACT Quantity (Press Cancel) ");
                    if (check == true) {
                        var result = prompt("ADD value");

                        var add  = +quantity + +result;

                        var url = "{{URL::to('/')}}";
                        {{--$.get("{{ route('ajax_stock_in.index') }}" +'/' + product_id +'/edit', function (data)--}}

                        $.ajax({
                                type:"POST",
                                url:  url+"/stock_in/stockin_quantity_update"+'/' + product_id,

                                data:{
                                    'add': add,
                                    // 'product_id' : product_id,
                                },
                                success:function(response){
                                    // debugger;
                                    // swal("Done!");
                                    // $("#getmul").html(response).show();
                                }
                            });




                        // alert(add);

                    } else {
                        var result = prompt("Subtract value");

                        var add  = quantity - result;

                        var url = "{{URL::to('/')}}";
                        {{--$.get("{{ route('ajax_stock_in.index') }}" +'/' + product_id +'/edit', function (data)--}}

                        $.ajax({
                            type:"POST",
                            url:  url+"/stock_in/stockin_quantity_subtract"+'/' + product_id,

                            data:{
                                'add': add,
                                // 'product_id' : product_id,
                            },
                            success:function(response){
                                // debugger;
                                // swal("Done!");
                                // $("#getmul").html(response).show();
                            }
                        });


                        var sub = quantity - result;
                        // alert(sub);

                    }

            });



        });
    </script>


    @endsection