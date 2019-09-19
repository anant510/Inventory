


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
        <div id="id="show_result"></div>
    <table class="table table-bordered" id="dynamicTable">
        <tr>
            <th>Name</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <tr>

            <td>
            @foreach($test_row1 as $test_row)
                <input type="text" class="form-control" value="{{ $test_row->name }}">

            @endforeach

            </td>
{{--            <td><input type="text" id="isearch" name="addmore[0][name]" placeholder="Enter your Name" class="form-control" /></td>--}}
            <td><input type="number" name="addmore[0][qty]" placeholder="Enter your Qty" class="form-control" value="1" /></td>
            <td><input type="number" name="addmore[0][price]" placeholder="Enter your Price" class="form-control" /></td>
            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
        </tr>
    </table>

    <button id="sbtn" type="submit" class="btn btn-success">Save</button>
    </div>
</form>




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
