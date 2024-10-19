@extends('layouts.app')
@section('page_title' , 'Shop')
@section('content')
	
	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{ $shop_name == 'kkm' ? 'KKM' : ( $shop_name == 'invo' ? 'Customer' :'IQM' ) }}</span> - Invoice List</h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>

		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('/home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
					<span class="breadcrumb-item active">Product</span>
				</div>

				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
			@if(Auth::user()->user_type == 1)
			<div class="header-elements d-none">
				<div class="breadcrumb justify-content-center">
					@if($shop_name == 'iqm')
					<a href="{{ route('create.product.sale.iqm') }}" class="btn btn-sm btn-success">
						<i class="icon-plus3 mr-2"></i>
						Add New
					</a>
					@elseif($shop_name == 'kkm')
					<a href="{{ route('create.product.sale.kkm') }}" class="btn btn-sm btn-success">
						<i class="icon-plus3 mr-2"></i>
						Add New
					</a>
					@elseif($shop_name == 'invo')
					<a href="{{ route('create.product.sale.invoice') }}" class="btn btn-sm btn-success">
						<i class="icon-plus3 mr-2"></i>
						Add New
					</a>
					@endif
				</div>
			</div>
			@endif
		</div>
	</div>
	<!-- /page header -->
	<!-- Content area -->
	<div class="content">
		<!-- Basic responsive configuration -->
		<div class="card">
			<div class="card-header bg-info header-elements-inline">
				<h5 class="card-title">Invoice List</h5>
				<div class="header-elements">
					<div class="list-icons">
	            		<a class="list-icons-item" data-action="collapse"></a>
	            		<a class="list-icons-item" data-action="reload"></a>
	            		<a class="list-icons-item" data-action="remove"></a>
	            	</div>
	        	</div>
			</div>
			<form action="{{ route('product.multi.delete') }}" method="post" id="multi_delete">
				@csrf
			<table class="table datatable-responsive" id="datatable">
				<thead>
					<tr>
						{{-- <th width="50"><input type="checkbox" id="checkAll" onclick="myFunction()"></th> --}}
						<th>SL</th>
						<th>Date</th>
						<th>Shop Name</th>
						<th>Invoice No</th>
						<th>Amount</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					@forelse($data as $key=>$row)
					<tr>
						{{-- @if(Auth::user()->user_type == 1)
						<td><input type="checkbox" name="ids[]" value="{{ $row->id }}" class="checkItem"></td>
						@endif --}}
						<td width="30">{{ ++$key }}</td>
						<td>{{ Carbon\Carbon::parse($row->sale_date)->format('d M, Y') }}</td>
						<td>{{ $row->shop_name }}</td>
						<td>{{ $row->invoice_no }}</td>
						<td>{{ $row->total }}</td>
						<td class="text-center" width="150">
							<a target="_blank" href="{{ route('view.product.sale',$row->id) }}" class="badge badge-sm badge-info">view</a>
							{{-- <a href="{{ route('edit.product.sale',$row->id) }}" class="badge badge-sm badge-warning">Edit</a> --}}
							<a href="{{ route('delete.product.sale',$row->id) }}" id="delete" class="badge btn-sm badge-danger"> Delete</a>
						</td>
					</tr>
					@empty

					@endforelse
				</tbody>
			</table>
			<div>
				<button style="display: none;" class="btn btn-danger ml-1 mb-1 delete-btn delete_all" id="delete_btn"><i class="icon-bin mr-2"></i> Delete</button>
			</div>
			</form>
		</div>
		<!-- /basic responsive configuration -->

        <!-- View Modal -->
		<div id="viewModal" class="modal fade" tabindex="-1">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Product Details</h3>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<div class="modal-body" id="product_details">
						
					</div>
				</div>
			</div>
		</div>
		<!-- /modal with h3 -->
	</div>

	<script>
		//edit request send
		$('body').on('click','.view',function(){
			var id=$(this).data('id');
			var url = "{{ url('product/view') }}/"+id;
			$.ajax({
				url:url,
				type:'get',
				success:function(data){
					$('#product_details').html(data);
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

	</script>


@endsection