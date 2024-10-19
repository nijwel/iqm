@extends('layouts.app')
@section('page_title' , 'Product Create')
@section('content')
	
	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Product</span> - Create</h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>

		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('/home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
					<span class="breadcrumb-item active">Product Create</span>
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
				<h5 class="card-title">Create Product</h5>
				<div class="header-elements">
					<div class="list-icons">
	            		<a class="list-icons-item" data-action="collapse"></a>
	            		<a class="list-icons-item" data-action="reload"></a>
	            		<a class="list-icons-item" data-action="remove"></a>
	            	</div>
	        	</div>
			</div>

				<div class="card-body">
					<form action="{{ route('store.product') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="row">
							{{-- <div class="form-group col-lg-8 col-sm-12">
								<label class="form-group-lebel">Product Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ old('product_name') }}" placeholder="Product Name">
								@error('product_name')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div> --}}

							{{-- <div class="form-group col-lg-4 col-sm-12">
								<label class="form-group-lebel">Product Code<span class="text-danger"> (NB: Select Supplier For Product Code) </span></label>
								<input type="text" readonly name="product_code" id="product_code_show" class="form-control @error('product_code') is-invalid @enderror" value="{{ old('product_code') }}" placeholder="Product Code">
								@error('product_code')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div> --}}

							<div class="form-group col-lg-2 col-sm-12">
								<label class="form-group-lebel">Brand <span class="text-danger">*</span></label>
								<select class="form-control select2 @error('category_id') is-invalid @enderror" name="category_id" id="category">
									<option disabled selected value="">--Select--</option>
									@foreach($category as $row)
										<option value="{{ $row->id }}" >{{ $row->category }}</option>
									@endforeach
								</select>
								@error('category_id')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-2 col-sm-12">
								<label class="form-group-lebel">Model</label>
								<select class="form-control select2 @error('subcategory_id') is-invalid @enderror" name="subcategory_id">
									<option disabled selected value="">--Select--</option>
								</select>
								@error('subcategory_id')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-2 col-sm-12">
								<label class="form-group-lebel">Stock</label>
								<input type="number" name="product_stock" id="product_stock" class="form-control @error('product_stock') is-invalid @enderror" min="0" step="any" value="0" placeholder="Stock">
								@error('product_code')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-2 col-sm-12">
								<label class="form-group-lebel">Net Price</label>
								<input type="number" name="net_price" id="net_price" class="form-control @error('net_price') is-invalid @enderror" min="0" step="any"  placeholder="Net Price">
								@error('net_price')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-2 col-sm-12">
								<label class="form-group-lebel">Costing</label>
								<input type="number" name="buying_price" id="buying_price" class="form-control @error('buying_price') is-invalid @enderror" min="0" step="any" value="{{ old('buying_price') }}" placeholder="Buying Price">
								@error('product_code')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-2 col-sm-12">
								<label class="form-group-lebel">Retail Price</label>
								<input type="number" name="retail_price" id="retail_price" class="form-control @error('retail_price') is-invalid @enderror" min="0" step="any" value="{{ old('retail_price') }}" placeholder="Retail Price">
								@error('product_code')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror

							</div>
							<div class="form-group col-lg-2 col-sm-12">
								<label class="form-group-lebel">Whole Sale</label>
								<input type="number" name="whole_sale" id="whole_sale" class="form-control @error('whole_sale') is-invalid @enderror" min="0" step="any" value="{{ old('whole_sale') }}" placeholder="Whole sale Price">
								@error('product_code')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>


							<div class="form-group col-lg-2 col-sm-12">
								<label class="form-group-lebel">Hide Price</label>
								<input type="number" name="hide_price" id="product_stock" class="form-control" min="0" step="any" value="0" placeholder="Exchange rate">
							</div>

							<div class="form-group col-lg-2 col-sm-12">
								<label class="form-group-lebel">Ex. Rate</label>
								<input type="number" name="ex_rate" id="ex_rate" class="form-control" min="1" step="any" value="1.07" placeholder="Exchange rate">
							</div>

							<div class="form-group col-lg-2 col-sm-12">
								<label class="form-group-lebel">Trans. cost</label>
								<input type="number" name="trans_cost" id="trans_cost" class="form-control" min="0" step="any" value="5" placeholder="Transport cost">
							</div>

							{{-- <div class="form-group col-lg-4 col-sm-12">
								<label class="form-group-lebel">Brand</label>
								<select class="form-control select2 @error('brand_id') is-invalid @enderror" name="brand_id">
									<option disabled selected value="">--Select--</option>
									@foreach($brand as $row)
										<option value="{{ $row->id }}" @if($row->id == old('brand_id')) selected @endif>{{ $row->brand_name }}</option>
									@endforeach
								</select>
								@error('brand_id')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div> --}}

							{{-- <div class="form-group col-lg-4 col-sm-12">
								<label class="form-group-lebel">Size</label>
								<select class="form-control select2 @error('size_id') is-invalid @enderror" name="size_id">
									<option disabled selected value="">--Select--</option>
									@foreach($size as $row)
										<option value="{{ $row->id }}" @if($row->id == old('size_id')) selected @endif>{{ $row->size }}</option>
									@endforeach
								</select>
								@error('size_id')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div> --}}

							{{-- <div class="form-group col-lg-4 col-sm-12">
								<label class="form-group-lebel">Supplier <span class="text-danger">*</span></label>
								<select class="form-control select2 @error('supplier_id') is-invalid @enderror" name="supplier_id" id="supplier">
									<option disabled selected value="">--Select--</option>
									@foreach($supplier as $row)
										<option value="{{ $row->id }}" @if($row->id == old('supplier_id')) selected @endif>{{ $row->s_name }} - #{{ $row->s_code }}</option>
									@endforeach
								</select>
								@error('supplier_id')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div> --}}
							{{-- <div class="form-group col-lg-4">
								<label class="form-group-lebel">Product Image</label>
								<input type="file" name="product_image" class="form-control h-auto">
							</div> --}}
						</div>

						{{-- <div class="form-group form-group-float">
							<label class="form-group-label">Product Description</label>
							<textarea rows="5" name="product_description" cols="5" class="form-control" placeholder="Product description"></textarea>
						</div> --}}
						<div class="justify-content-end align-items-center">
							<button type="submit" class="btn btn-primary ml-3 btn-submit">Submit</button>
						</div>
					</form>
				</div>
		</div>
	</div>

	<script>
		//edit request send
		$('body').on('click','.edit',function(){
			var id=$(this).data('id');
			var url = "{{ url('category/edit') }}/"+id;
			$.ajax({
				url:url,
				type:'get',
				success:function(data){
					$('#edit_part').html(data);
				}
			});
		});


		$('#net_price , #ex_rate , #trans_cost ').on('keyup',function(){
			let net_price = $('#net_price').val();
			let ex_rate = $('#ex_rate').val();
			let trans_cost = $('#trans_cost').val();

			let total_cost = net_price * ex_rate + Number(trans_cost);

			$('#buying_price').val(parseFloat(total_cost.toFixed(2)));

			
		});
		//Product Code

		$('#supplier').on('change',function(){
			var supplier_id = $(this).val();
			var url = "{{ url('product/code') }}/"+supplier_id;
			$.ajax({
				url:url,
				type:'get',
				success:function(data){
					$('#product_code_show').val(data);
				}
			});
		});

	</script>

	<script>
	  // All Checked
	  $('#checkAll').change(function () {
	      $('.checkItem').prop('checked',this.checked);
	  });

	  $('.checkItem').change(function () {

	    if ($('.checkItem').is(':checked')) {
	     $(".delete-btn").css("display", "");
	    }else{
	     $(".delete-btn").css("display", "none");
	    }

	  });
	</script>
	 
	 <script>
	        $('.delete_all').on('click', function(e) {

	            var allVals = [];  
	            $(".checkItem:checked").each(function() {  
	                allVals.push($(this).attr('data-id'));
	            });  


	            if(allVals.length <=0)  
	            {  
	                swal({
	                  title: "Please Select a row !",
	                })
	                 return false; 
	            }else{
	             
	             if (confirm("Are You Sure to delete? If delete data can not recover !") == true) {
	                 return true;
	               } else {
	                 return false;
	               }
	            }
	        });


	        function myFunction() {
	          // Get the checkbox
	          var checkBox = document.getElementById("checkAll");
	          // Get the output text
	          var text = document.getElementById("delete_btn");

	          // If the checkbox is checked, display the output text
	          if (checkBox.checked == true){
	            text.style.display = "block";
	          } else {
	            text.style.display = "none";
	          }
	        }

	        $(document).ready(function() {
	            $('.select2').select2();
	        });

	        $('#category').change(function(){
	        	 var cat_id = $(this).val();
	        	 if(cat_id) {
	        	    $.ajax({
	        	        url: "{{ url('sub-category/get') }}/"+cat_id,
	        	        type:"GET",
	        	        dataType:"json",
	        	        success:function(data) {
	        	        
	        	             var d =$('select[name="subcategory_id"]').empty();
	        	             $('select[name="subcategory_id"]').append('<option value="" disabled="" selected="">--Select--</option>')
	        	            $.each(data, function(key, value){
	        	                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory + '</option>');
	        	            });   

	        	        },     
	        	    });
	        	}
	        });

	</script>


@endsection