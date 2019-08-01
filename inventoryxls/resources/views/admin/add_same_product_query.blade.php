
<div class="box box-primary">
	 <h3 class="box-title">Add Same quantity for same product</h3>
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
		@foreach($test_row1 as $test_row)
		<tr>
		<td>{{ $test_row->pcode }}</td>
		<td>{{ $test_row->pname }}</td>
		<td>{{ $test_row->pdetail }}</td>
		<td>{{ $test_row->pprice }}</td>
		<td>{{ $test_row->pquantity }}</td>
		<td></td>
		<td>
			<form action="{{ route('admin.add_same_product1',$test_row->id) }}" method="POST">
				<div class="row">

				{{ csrf_field() }}
				<input type="hidden" name="_method" method="POST">
				<div class="col-md-6">
				<input type="text" name="add_quantity1" class="form-control">
				</div>
				<div class="col-md-2">
				<button type="submit" name="add" class="btn btn-primary">Add</button>
				</div>
				</div>
			</form>
		</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>
