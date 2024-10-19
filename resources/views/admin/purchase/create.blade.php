@extends('layouts.app')
@section('content')
	
	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Datatables</span> - Product - Purchase</h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>

		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
					<span class="breadcrumb-item active">Product Purchase</span>
				</div>

				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
			<div class="header-elements d-none">
				<div class="breadcrumb justify-content-center">
					<a href="{{ route('index.product') }}" class="btn btn-sm btn-success">
						<i class="icon-plus3 mr-2"></i>
						Product List
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<!-- Content area -->
	<div class="content">
		<!-- Basic responsive configuration -->
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Purchase Product</h5>
				<div class="header-elements">
					<div class="list-icons">
	            		<a class="list-icons-item" data-action="collapse"></a>
	            		<a class="list-icons-item" data-action="reload"></a>
	            		<a class="list-icons-item" data-action="remove"></a>
	            	</div>
	        	</div>
			</div>

				<div class="card-body">
					<form action="{{ route('store.product.purchase') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="row">

							<div class="form-group col-lg-3 col-sm-12">
								<label class="form-group-lebel">Product <span class="text-danger">*</span></label>
								<select class="form-control select2 @error('product_id') is-invalid @enderror" name="product_id" id="product_id">
									<option disabled selected value="">--Select--</option>
									@foreach($product as $row)
										<option value="{{ $row->id }}" >{{ $row->product_name }}</option>
									@endforeach
								</select>
								@error('product_id')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-3 col-sm-12">
								<label class="form-group-lebel">Product Code <span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="product_code" name="product_code" value="" readonly placeholder="Product Name">
								@error('product_name')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-3 col-sm-12">
								<label class="form-group-lebel">Supplier<span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('supplier_id') is-invalid @enderror" name="supplier_id" id="supplier_id" value="" readonly placeholder="Supplier Name">
								@error('supplier_id')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-3 col-sm-12">
								<label class="form-group-lebel">Product Qty <span class="text-danger">*</span></label>
								<input type="number" name="qty" id="qty" class="form-control @error('qty') is-invalid @enderror" min="1" value="0"  placeholder="Product Qty">
								@error('qty')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-3 col-sm-12">
								<label class="form-group-lebel">Purchase Price<span class="text-danger">*</span></label>
								<input type="number" name="unit_price" id="unit_price" class="form-control @error('unit_price') is-invalid @enderror" value="0" placeholder="Unit Price">
								@error('unit_price')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-3 col-sm-12">
								<label class="form-group-lebel">Sale Price<span class="text-danger">*</span></label>
								<input type="number" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" value="0" placeholder="Unit Price">
								@error('sale_price	')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-3 col-sm-12">
								<label class="form-group-lebel">Total Price<span class="text-danger">*</span></label>
								<input type="number" readonly name="total" id="total" class="form-control @error('total') is-invalid @enderror" value="" placeholder="Total Price">
								@error('total')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-3 col-sm-12">
								<label class="form-group-lebel">Purchase Date<span class="text-danger">*</span></label>
								<input type="date" name="purchase_date" id="total" class="form-control @error('purchase_date') is-invalid @enderror" value="" placeholder="Total Price">
								@error('purchase_date')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

						</div>

						<div class="d-flex justify-content-end align-items-center">
							<button type="reset" data-dismiss="modal" class="btn btn-link"></button>
							<button type="submit" class="btn btn-primary ml-3 btn-submit">Submit</button>
						</div>
					</form>
				</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
            $('.select2').select2();
        });
	</script>
	<script>

		$(document).ready(function () {
		  $("#qty,#unit_price").keyup(function() {

		      let qty = parseInt($("#qty").val());
		      let unit_price = parseInt($("#unit_price").val());
		      let total = qty * unit_price;
		      $('#total').val(total);
		    });
		});

		//Product Code

		$('#product_id').on('change',function(){
			var product_id = $(this).val();
			var url = "{{ url('barcode-generate/product/code') }}/"+product_id;
			$.ajax({
				url:url,
				type:'get',
				success:function(data){
					$('#product_code').val(data.product_code);
					$('#supplier_id').val(data.s_name +' - '+  data.s_code);
				}
			});
		});

	</script>

@endsection