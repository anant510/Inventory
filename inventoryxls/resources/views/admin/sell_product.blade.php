@extends('layouts.admin')

@section('content')


<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Sell Product</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
      <span class="label label-primary">Sell</span>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-8"></div>
        <div class="col-md-3">
          <input type="text" id="isearch" name="isearch" class="form-control" placeholder="Search Products by pcode.">
        </div>
      </div><br>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
        <div id="getsearch">
          
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


   $("#isearch").keyup(function(){
    var isearch = $("#isearch").val();
     var url = "{{URL::to('/')}}";
    
     // alert(isearch);
    $.ajax({
      type:"POST",
      url:  url+"/admin/query_sell",
      data:{
        isearch: isearch,
      },
      success:function(response){
        $("#getsearch").html(response).show();
      }
    });
  });


});




</script>

@endsection



