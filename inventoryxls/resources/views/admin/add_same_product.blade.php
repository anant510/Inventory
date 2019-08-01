@extends('layouts.admin')

@section('content')


<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Add Same Products Quantity</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span class="label label-primary">ADD</span>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-8"></div>
        <div class="col-md-3">
          <input type="text" id="asearch" name="s" class="form-control" placeholder="Add Same Products.">
        </div>
      </div><br>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <div id="add_sameproduct_search">
          
        </div>
        </div>
        <div class="col-md-1"></div>

      </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <!-- The footer of the box -->
  </div>
  <!-- box-footer -->
</div>

    

@endsection

@section('scripts')


<script type="text/javascript">

 $(document).ready(function(){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


   $("#asearch").keyup(function(){
    var asearch = $("#asearch").val();
     var url = "{{URL::to('/')}}";
    
     // alert(asearch);
    $.ajax({
      type:"POST",
      url:  url+"/admin/add_same_product_query",
      data:{
        asearch: asearch,
      },
      success:function(response){
        $("#add_sameproduct_search").html(response);
      }
    });
  });


});




</script>

@endsection