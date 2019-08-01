@extends('layouts.admin')

@section('content')
<!-- <div class="row">
    <div class="container">
        <div class="col-md-8">
        <div class="panel panel-title">
            Buy table:
        </div>
        <div class="panel panel-default">
          
          <div class="panel-body">
 
            <a href="{{ url('downloadExcel/xls') }}"><button class="btn btn-success">Download Sorting Data Excel xls</button></a>
             <a href="{{ url('Excel/xls') }}"><button class="btn btn-success">Download  Excel xls</button></a>
            <a href="{{ url('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
            <a href="{{ url('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>
 
            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ url('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                @csrf
 
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
 
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
 
                <input type="file" name="import_file" />
                <button class="btn btn-primary">Import File</button>
            </form>
 
          </div>
        </div>
    </div>
    </div>
</div> -->

<h3>Dashboard</h3>

<div class=" table-responsive box box-danger">
     <h3 class="box-title">Less Stock Table:</h3>
     <a href="{{ url('downloadExcel/xls') }}"><button class="btn btn-success">Download Less Stock Report Excel </button></a>
<table  class="table table-hover">
    <thead style="color: red; font-size: 18px;">
        <th>pcode</th>
        <th>pname</th>
        <th>pdetail</th>
        <th>pprice</th>
        <th>pquantity</th>
        
    </thead>
    <tbody>
        @foreach($var_sell1 as $var_sell)
        <tr>
            @if($var_sell->pquantity <= 5)
            <td><b style="color: blue;">{{ $var_sell->pcode }}</b></td>
            <td><b style="color: blue;">{{ $var_sell->pname }}</b></td>
            <td><b style="color: blue;">{{ $var_sell->pdetail }}</b></td>
            <td><b style="color: blue;">{{ $var_sell->pprice }}</b></td>
            <td>
            <b style="color: blue;">{{  $var_sell->pquantity }}</b>
            </td>
           
            @endif
          
        </tr>
        @endforeach
    </tbody>
</table>
    <div class="text-center">
        {!! $var_sell1->links() !!}
    </div>
</div> <br><br>


<div class="box box-primary table-responsive">
     <h3 class="box-title">Stock Table:</h3>
     <a href="{{ url('Excel/xls') }}"><button class="btn btn-success">Download Stock Repot Excel xls</button></a>
<table class="table table-hover">
    <thead style="color: red; font-size: 18px;">
        <th>pcode</th>
        <th>pname</th>
        <th>pdetail</th>
        <th>pprice</th>
        <th>pquantity</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach($var_sell1 as $var_sell)
        <tr>
            <td><b style="color: blue;">{{ $var_sell->pcode }}</b></td>
            <td><b style="color: blue;">{{ $var_sell->pname }}</b></td>
            <td><b style="color: blue;">{{ $var_sell->pdetail }}</b></td>
            <td><b style="color: blue;">{{ $var_sell->pprice }}</b></td>
            <td><b style="color: blue;">{{ $var_sell->pquantity }}</b></td>
            <td>
                <div class="row">
                    <div class="col-md-3">
                    <a href="{{ route('admin.sell_edit',$var_sell->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" name="delete" class="btn btn-danger" data-toggle="modal" data-target="#del_sell_data">Delete</button>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="text-center">
    {!! $var_sell1->links() !!}
</div>
</div>




<!-- Modal -->
<div class="modal fade" id="del_sell_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Are You Sure Want to Delete?</b>
      </div>
      <form action="" method="POST">
            {{ csrf_field() }}
         <input type="hidden" name="_method" method="post">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="delete" class="btn btn-danger">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
 



@endsection