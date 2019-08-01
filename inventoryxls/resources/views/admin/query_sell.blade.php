<div class="box box-primary">
	 <h3 class="box-title">check</h3>
<table class="table table-hover">
	<thead style="color: red;">
		<th>pcode</th>
		<th>pname</th>
		<th>pdetail</th>
		<th>pprice</th>
		<th>pquantity</th>
		<th>Action</th>
	</thead>
	<tbody>
		@foreach($tests as $test)
		<tr>
			<td>{{ $test->pcode }}</td>
			<td>{{ $test->pname }}</td>
			<td>{{ $test->pdetail }}</td>
			<td data-price="{{ $test->pprice }}" id="price">{{ $test->pprice }}</td>
			<td>{{ $test->pquantity }}</td>
			<td>
				<form action="{{ route('admin.sell_product1',$test->id) }}" method="post">
				<div class="row">
					<div class="col-md-4">
							{{ csrf_field() }}
							<input type="hidden" name="_method" value="post">
							<input type="text" id="sell_pro" name="sell_pro" class="form-control" placeholder="Enter Quantity">
						</div>
						<div class="col-md-4">
							<input type="text" id="sell_price" name="sell_price" class="form-control" placeholder="Enter Price" value="">
						</div>
						<div class="col-md-2">
							<button  type="submit" name="exampleModal1" class="btn btn-primary" >Sell</button>
						</div>	
				</div>
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>



<script type="text/javascript">

 $(document).ready(function(){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

   $("#sell_pro").keyup(function(){
    var sell_pro = $("#sell_pro").val();
    var el = document.querySelector('#price');
  	var price = el.dataset.price;
  	var product = sell_pro*price;
  	$("#sell_price").attr("value", product);
    // var sell_price = $("#sell_price").val();
    //var mul_price = sell_pro * sell_price;
     var url = "{{URL::to('/')}}";
    
     // alert(sell_pro);
    $.ajax({
      type:"POST",
      url:  url+"/admin/sell_product1",
      data:{
        'product': product,
      },
      success:function(response){
      	swal("Done!");
        // $("#getmul").html(response).show();
      }
    });
  });


});




</script>





