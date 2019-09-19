@extends('layouts.app')

@section('content')

<div class="container">
    <div id="show_result"></div>

<h2 align="center">User Billing system</h2>
    <div class="row">

        <form action="" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Session::has('success'))
                <div class="alert alert-success text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif

            <div class="row">
                <table class="table table-bordered" id="dynamicTable">
                    <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    <tr>

                        <td><input type="text" id="isearch" name="addmore[0][name]" placeholder="Enter your Name" class="form-control" /></td>
                        <td><input type="text" name="addmore[0][qty]" placeholder="Enter your Qty" class="form-control" /></td>
                        <td><input type="text" name="addmore[0][price]" placeholder="Enter your Price" class="form-control" /></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                    </tr>
                </table>

                <button id="sbtn" type="submit" class="btn btn-success">Save</button>
            </div>
        </form>

    </div>


</div>




<script type="text/javascript">

    // var i = 0;
    //
    // $("#add").click(function(){
    //
    //     ++i;
    //
    //     $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addmore['+i+'][qty]" placeholder="Enter your Qty" class="form-control" /></td><td><input type="text" name="addmore['+i+'][price]" placeholder="Enter your Price" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    // });
    //
    // $(document).on('click', '.remove-tr', function(){
    //     $(this).parents('tr').remove();
    // });

    var i = 0;

    $('#add').click(function(){
        ++i;

        $('#dynamicTable').append('<tr><td><input type="text" id="isearch" name="addmore['+i+'][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="number" name="addmore['+i+'][qty]" placeholder="Enter your qty" class="form-control"></td><td><input type="number" name="addmore['+i+'][price]" placeholder="Enter your Price" class="form-control"></td><td><button type="submit" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });

    $(document).on('click', '.remove-tr', function(){
        $(this).parents('tr').remove();
    });

</script>

<script type="text/javascript">

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $("#isearch").keyup(function(){
            var asearch = $("#isearch").val();
            var url = "{{URL::to('/')}}";

            // alert(asearch);

            $.ajax({
                type:"POST",
                url:  url+"/test1",
                url: "{{ route('test1') }}",
                data:{
                    asearch: asearch,
                },
                success:function(response){
                    // debugger;
                    $('#dynamicTable').hide();
                    $('#sbtn').hide();
                    $("#show_result").html(response);
                }
            });
        });


    });

    {{--$("#isearch").click(function(){--}}
    {{--    $.ajax({url: "{{ route('test1') }}", success: function(result){--}}
    {{--            $("#show_result").html(result);--}}
    {{--        }});--}}
    {{--});--}}
</script>


    @endsection
