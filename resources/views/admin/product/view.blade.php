<div class="container-fluid border">
	<div class="row p-2">
		<div class="col-lg-6 border-right text-center">
			<img src="{{ asset($data->product_image ? $data->product_image : 'public/backend/images/image.png' ) }}" width="300">

			<div class="mt-3" style="margin-left: 105px;">{!! DNS1D::getBarcodeHTML($data->product_code, 'CODABAR') !!}</div>
			<small># {{ $data->product_code }}</small>
			<hr>
			<div class="row mt-3">
				<div class="col-lg-6">
					<p>Stock : {{ $data->product_stock }}</p>
				</div>
				<div class="col-lg-6">
					<p>Sold : {{ $data->product_sold }}</p>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<h3 class="text-center">Product Details</h3>
			<hr>
			<table class="table datatable-responsive border">
				<tr>
					<th>Name</th>
					<th>:</th>
					<td>{{ $data->product_name }}</td>
				</tr>
				<tr>
					<th>Category</th>
					<th>:</th>
					<td>{{ $data->category->category }}</td>
				</tr>
				<tr>
					<th>Subcategory</th>
					<th>:</th>
					<td>{{ $data->subcategory->subcategory }}</td>
				</tr>
				<tr>
					<th>Brand</th>
					<th>:</th>
					<td>{{ $data->brand->brand_name }}</td>
				</tr>
				<tr>
					<th>Size</th>
					<th>:</th>
					<td>{{ $data->size->size }}</td>
				</tr>
				<tr>
					<th>Supplier</th>
					<th>:</th>
					<td>{{ $data->supplier->s_name }}</td>
				</tr>
				<tr>
					<th>Description</th>
					<th>:</th>
					<td>{{ $data->product_description }}</td>
				</tr>
			</table>
		</div>
	</div>
</div>