@extends('layouts.app')
@section('content')
	
	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Datatables</span> - Product - Barcode generator</h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>

		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
					<span class="breadcrumb-item active">Product Barcode generator</span>
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
				<h5 class="card-title">Generate Product Barcode</h5>
				<div class="header-elements">
					<div class="list-icons">
	            		<a class="list-icons-item" data-action="collapse"></a>
	            		<a class="list-icons-item" data-action="reload"></a>
	            		<a class="list-icons-item" data-action="remove"></a>
	            	</div>
	        	</div>
			</div>

				<div class="card-body">
						<div class="row">

							<div class="form-group col-lg-8 col-sm-12">
								<label class="form-group-lebel">Product <span class="text-danger">*</span></label>
								<select class="form-control select2 @error('category_id') is-invalid @enderror" name="product_id" id="product_id">
									<option disabled selected value="">--Select--</option>
									@foreach($product as $row)
										<option value="{{ $row->id }}" >{{ $row->product_name }}</option>
									@endforeach
								</select>
								@error('category_id')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-2 col-sm-12">
								<label class="form-group-lebel">Product Code</label>
								<input type="text" readonly name="product_code" id="product_code_show"  class="form-control" placeholder="Product Name">
							</div>

							<div class="form-group col-lg-2 col-sm-12">
								<label class="form-group-lebel">Barcode Qty</label>
								<input type="number" name="product_code_qty" id="product_code_qty" min="1" value="1" class="form-control" placeholder="Qty">
							</div>

						<div class="justify-content-end align-items-center">
							<button type="submit" id="print" class="btn btn-primary ml-3 btn-submit"> <i class="icon-spinner2 spinner d-none"></i> Generate</button>
						</div>
				</div>
		</div>
	</div>

	<script src="{{ asset('public') }}/backend/global_assets/js/plugins/print_this/printThis.js"></script>
	<script>

		//Product Code

		$('#product_id').on('change',function(){
			var product_id = $(this).val();
			var url = "{{ url('barcode-generate/product/code') }}/"+product_id;
			$.ajax({
				url:url,
				type:'get',
				success:function(data){
					$('#product_code_show').val(data.product_code);
				}
			});
		});

	</script>

	<script>

		$('#print').on('click', function (e) {
		    e.preventDefault();
		    $('.spinner').removeClass('d-none')
		    $.ajax({
		        url:"{{ route('print.barcode') }}",
		        type:'get',
		        data: {product_id : $('#product_id').val(),
		               product_code_qty : $('#product_code_qty').val()},
		        success:function(data){
		          $('.loading').addClass('d-none')
		            $(data).printThis({
		                debug: false,                   
		                importCSS: true,                
		                importStyle: true,                               
		                removeInline: false, 
		                printDelay: 500,
		                header : null,   
		                footer : null,
		            });

		            $('.spinner').addClass('d-none')
		        },
		        error:function(data){
		        	toastr.options = {
		        	  "closeButton": true,
		        	  "progressBar": true,
		        	  "positionClass": "toast-bottom-right",
		        	}
		        	
		        	toastr.error(data.responseJSON.errors.product_id);
		        	$('.spinner').addClass('d-none')
		        }
		    });
		});

	  $(document).ready(function() {
	      $('.select2').select2();
	  });
	</script>


@endsection