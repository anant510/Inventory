@extends('layouts.admin')

@section('content')


<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Add Product</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span class="label label-primary">Label</span>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
 <form action="{{ route('admin.store_product') }}" method="POST">

 	{{ csrf_field() }}
  <div class="form-group">
    <label for="email">Pcode</label>
    <input type="text"  name="pcode" class="form-control" id="pcode" placeholder="Enter Product Code here. Unique Code."  >
  </div>
  <div class="form-group">
    <label for="pwd">Pname:</label>
    <input type="text" name="pname" class="form-control" id="pname"  placeholder="Enter Product Name here." >
  </div>
  <div class="form-group">
    <label for="pwd">Pdetail:</label>
    <input type="text" name="pdetail" class="form-control" id="pdetail" placeholder="Enter Prouct Detail here." >
  </div>
  <div class="form-group">
    <label for="pwd">Pprice:</label>
    <input type="number" name="pprice" class="form-control" id="pprice"  placeholder="Enter Price here.." >
  </div>
  <div class="form-group">
    <label for="pwd">Pquantity:</label>
    <input type="number" name="pquantity" class="form-control" id="pquantity" placeholder="Enter Quantity here." >
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