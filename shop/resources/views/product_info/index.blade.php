@extends('admin.index')

@section('content')

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <section class="content">
        <div class="container-fluid">
            <div class="content-header">
                <h3>Product Information</h3>

            </div>

            <div class="card">

                <div class="container">
                    <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Create New Product</a>
                    <table class="table table-bordered data-table table-hover">
                        <thead style="background-color: #0e5b44; color: white;">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Note</th>
                            <th>category</th>
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
                                        <label class="col-sm-3 control-label">Category</label>
                                        <select name="cat_id" id="cat_id" class="form-control">
                                            @foreach($product_category as $product_cat)
                                                <option value="{{ $product_cat->id }}">{{ $product_cat->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                        <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="name_information" name="name_information" placeholder="Enter Name" value="" maxlength="50" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Note</label>
                                        <div class="col-sm-12">
                                            <textarea id="note" name="note" required="" placeholder="Enter Note" class="form-control"></textarea>
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


            </div>
        </div>
    </section>
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
                ajax: "{{ route('ajaxinformation.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name_information', name: 'name_information'},
                    {data: 'note', name: 'note'},
                    {data: 'category_name', name: 'category_name' },
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
                $.get("{{ route('ajaxinformation.index') }}" +'/' + product_id +'/edit', function (data) {
                    $('#modelHeading').html("Edit Product");
                    $('#saveBtn').val("edit-user");
                    $('#ajaxModel').modal('show');
                    $('#product_id').val(data.id);
                    $('#name_information').val(data.name_information);
                    $('#note').val(data.note);
                    $('#category_name').val(data.category_name);


                })
            });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#productForm').serialize(),
                    url: "{{ route('ajaxinformation.store') }}",
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

            {{--$('body').on('click', '.deleteProduct', function () {--}}

            {{--    var product_id = $(this).data("id");--}}
            {{--    confirm("Are You sure want to delete !");--}}

            {{--    $.ajax({--}}
            {{--        type: "DELETE",--}}
            {{--        url: "{{ route('ajaxinformation.store') }}"+'/'+product_id,--}}
            {{--        success: function (data) {--}}
            {{--            table.draw();--}}
            {{--        },--}}
            {{--        error: function (data) {--}}
            {{--            console.log('Error:', data);--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}



            $('body').on('click', '.deleteProduct', function () {

                var product_id = $(this).data("id");
                var check =  confirm("Are You sure want to delete !")
                // debugger;
                if (check == true) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('ajaxinformation.store') }}"+'/'+product_id,
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

        });
    </script>





    @endsection