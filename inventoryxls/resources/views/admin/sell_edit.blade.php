@extends('layouts.admin')

@section('content')


<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Sell Edit Product</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span class="label label-primary">Edit</span>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
 <form action="{{ route('admin.sell_edit1',$row_sell_edit->id) }}" method="POST">

 	{{ csrf_field() }}
  <input type="hidden" name="_method" method="post">
  <div class="form-group">
    <label for="email">Pcode</label>
    <input type="text"  name="pcode" class="form-control" id="pcode" required="true" value="{{ $row_sell_edit->pcode }}">
  </div>
  <div class="form-group">
    <label for="pwd">Pname:</label>
    <input type="text" name="pname" class="form-control" id="pname" required="true" value="{{ $row_sell_edit->pname }}">
  </div>
  <div class="form-group">
    <label for="pwd">Pdetail:</label>
    <input type="text" name="pdetail" class="form-control" id="pdetail" required="true" value="{{ $row_sell_edit->pdetail }}">
  </div>
  <div class="form-group">
    <label for="pwd">Pprice:</label>
    <input type="number" name="pprice" class="form-control" id="pprice" required="true" value="{{ $row_sell_edit->pprice }}">
  </div>
  <div class="form-group">
    <label for="pwd">Pquantity:</label>
    <input type="number" name="pquantity" class="form-control" id="pquantity" required="true" value="{{ $row_sell_edit->pquantity }}">
  </div>
  <div class="form-group">
    <label for="pwd">Pimage:</label>
    <input type="file" name="pimage" class="form-control" id="pimage">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <!-- The footer of the box -->
  </div>
  <!-- box-footer -->
</div>
@endsection