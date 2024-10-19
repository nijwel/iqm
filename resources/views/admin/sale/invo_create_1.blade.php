@extends('layouts.app')
@section('content')
	
	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Customer</span> - Invoice</h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>

		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('/home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
					<span class="breadcrumb-item active">Shop Invoice</span>
				</div>

				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
			<div class="header-elements d-none">
				<div class="breadcrumb justify-content-center">
					<a href="{{ route('index.product.sale.invoice') }}" class="btn btn-sm btn-success">
						<i class="icon-plus3 mr-2"></i>
						Invoice List
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
				<h5 class="card-title">Sale Product</h5>
				<div class="header-elements">
					<div class="list-icons">
	            		<a class="list-icons-item" data-action="collapse"></a>
	            		<a class="list-icons-item" data-action="reload"></a>
	            		<a class="list-icons-item" data-action="remove"></a>
	            	</div>
	        	</div>
			</div>

				<div class="card-body">
					<form action="{{ route('store.product.sale') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="row">

							<input type="hidden" class="form-control shop_name" id="shop_name" name="shop_name">

							<div class="form-group col-lg-3 col-sm-12">
								<label class="form-group-lebel">Customer Name <span class="text-danger">*</span></label>
									<select name="customer_id" class="form-control customer_id select22" style="width: 100%" id="customer_id">
										<option disabled selected value="">--Select--</option>
										@foreach($customers as $row)
										<option value="{{ $row->id }}">{{ $row->name }}</option>
										@endforeach
									</select>
								<strong class="text-danger category" ></strong>
							</div>

							<div class="form-group col-lg-3 col-sm-12">
								<label class="form-group-lebel">Invoice No. <span class="text-danger">*</span></label>
								<input type="text" name="invoice_no" class="form-control" readonly value="{{  'cus -' . date('Ymdhis') }}"  placeholder="Invoice no.">
								@error('invoice_no')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

							<div class="form-group col-lg-3 col-sm-12">
								<label class="form-group-lebel">Date<span class="text-danger">*</span></label>
								<input type="date" name="sale_date"  class="form-control @error('sale_date') is-invalid @enderror" value="{{ date('m/d/Y') }}" required placeholder="Total Price">
								@error('sale_date')
								    <span class="invalid-feedback" role="alert">
								        <p>{{ $message }}</p>
								    </span>
								@enderror
							</div>

						</div>
						<hr>
						<table class="table" id="dynamic_field">
							<thead>
								<tr>
									<th>Product</th>
									<th>Price</th>
									<th>Qty</th>
									<th>Total</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="form-group">
											<select class="form-control product_id" name="product_id[]" required id="product_id_1">
												<option disabled selected value="">--Select--</option>
												@foreach($product as $row)
													<option value="{{ $row->id }}" >{{ $row->subcategory->subcategory }}</option>
												@endforeach
											</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="number" name="item_price[]" id="item_price_1" class="form-control item_price" value="" required  placeholder="0.00">
										</div>
									</td>

									<td>
										<div class="form-group">
											<input type="number" required name="item_qty[]" id="item_qty_1" class="form-control item_qty" value="0"  placeholder="0">
										</div>
									</td>

									<td>
										<div class="form-group">
											<input type="number" required name="item_total_price[]" id="item_total_price_1" class="form-control item_total_price" readonly value=""  placeholder="0">
										</div>
									</td>
									<td>
										<div class="form-group">
											<button type="button" id="add" class="btn btn-sm btn-primary add">+</button>
										</div>
									</td>
								</tr>
							</tbody>

							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<td align="right" >Sub Total</td>
									<td><input type="number" id="total" value="0.00" name="total_price" min="0" step="any"   class="form-control form-control-sm total" readonly></td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td align="right" >Due</td>
									<td><input type="number" readonly id="due" value="0.00" name="due" min="0" step="any"  class="form-control form-control-sm total"></td>
									<td></td>
								</tr>
								{{-- <tr>
									<td></td>
									<td></td>
									<td align="right" >Paid</td>
									<td><input type="number" id="paid" value="0.00" name="paid" min="0" step="any"  class="form-control form-control-sm total"></td>
									<td></td>
								</tr> --}}
								<tr>
									<td></td>
									<td></td>
									<td align="right" >Grand Total</td>
									<td><input type="number" id="g_total" value="0.00" name="g_total" min="0" step="any"  class="form-control form-control-sm total" readonly ></td>
									<td></td>
								</tr>
							</tfoot>
						</table>
						<div class="">
							<button type="submit" class="btn btn-primary ml-3 btn-submit">Submit</button>
						</div>
					</form>
				</div>
		</div>
	</div>

	<script>


		$(document).on('change', '.product_id', function calculate() {

			var product_id = $(this).val();

			var url = "{{ url('product-sale/get/price') }}/"+product_id;
			$.ajax({
				url:url,
				type:'get',
				success:function(data){
					$('#item_price_'+i).val(data.whole_sale);
					$('#item_total_price_'+i).val(data.whole_sale);
					$('#item_qty_'+i).val(1);
					totalPrice()
				}
			});

		});
		
              var postURL = "<?php echo url('addmore'); ?>";
              var i=1;  


              $('#add').click(function(){  
                   // i++;  
                   // $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

              	var count = ++i;			
              	var html = "<tr id='row_"+count+"'>";
              		html += "<td><select class='form-control product_id' name='product_id[]' id='product_id_"+count+"'><option disabled selected >--Select--</option>@foreach($product as $row)<option value='{{ $row->id }}' >{{ $row->subcategory->subcategory }}</option>@endforeach</select></td>";

              		html += "<td><input type='number' class='form-control test item_price' required name='item_price[]' step='any' min='0' id='item_price_"+count+"' placeholder='0.00' ></td>";

              		html +="<td><input type='number' step='any' required name='item_qty[]' onkeydown='enter(this.id,this.value)' min='1' value='1' class='form-control test item_qty' id='item_qty_"+count+"' placeholder='0' ></td>";

              		html +="<td><input type='number' step='any' required name='item_total_price[]' min='0'  class='form-control test item_total_price' readonly id='item_total_price_"+count+"' placeholder='0.00' ></td>";
              		html += "<td><button type='button' data-row='row_"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
              		html += "</tr>"; 

              		 $('#dynamic_field').append(html);
              		 
              });

              $(document).on('click', '.remove', function(){
               var delete_row = $(this).data("row");
               $('#' + delete_row).remove();
               totalPrice()

              });

      		$(document).ready(function select() {

      			for(j=1; j<=i; j++){
                  $('#product_id_'+ j+'').select2();
              	}
              });

			$(document).on( 'click' ,'.add' , function select() {

				for(j=1; j<=i; j++){
	            $('#product_id_'+ j+'').select2();
	        	}
	        });



      		$(document).on('change keyup ', '.item_price , .item_qty , .product_id', function calculate() {
      		     
      		    var i = parseInt($('#dynamic_field tr').length);

      		    // alert(i)

      		    for(j=1; j<=i; j++){
      		  
      		        item_price  = $('#item_price_'+j ).val();
      		        item_qty  = $('#item_qty_'+ j ).val();
      		         
      		     if (item_price != '' && item_qty != ''){
      		          total_qty = (parseFloat(item_price) * parseFloat(item_qty));
      		          $('#item_total_price_'+j+'').val(total_qty.toFixed(2));

      		          totalPrice();
      		       
      		      }else{
      		        $('#item_total_price_'+ j+'').val(0);
      		        
      		      }
      		    }
      		  
      		});

	</script>
	<script>

		function totalPrice(){
		   var calculated_total_sum = 0;      
           $("#dynamic_field .item_total_price").each(function () {
            var get_textbox_value = $(this).val();

            if ($.isNumeric(get_textbox_value)) {
              calculated_total_sum += parseFloat(get_textbox_value);
              }                  
            });

           	var due = parseFloat($("#due").val());
           	$("#total").val(calculated_total_sum.toFixed(2));
           	$("#g_total").val(calculated_total_sum + due);
		}

		$(document).on('change keyup', '#due , #paid ', function calculate() {

			var sub_total = $("#total").val();
			var due = $("#due").val();
			var paid = $("#paid").val();

			var g_total = parseFloat(sub_total) + parseFloat(due) - parseFloat(paid);

			$("#g_total").val(g_total.toFixed(2));



		});

		//Product Code

		$(document).ready(function() {
	            $('.select22').select2();
	        });

		$('#customer_id').change(function(){
			 var cus_id = $(this).val();

			 if(cus_id) {
			    $.ajax({
			        url: "{{ url('customer/get/due') }}/"+cus_id,
			        type:"GET",
			        dataType:"json",
			        success:function(data) {
			          $('#shop_name').val(data.name);
			          $('#due').val(data.due);
			          $("#g_total").val(data.due);
			        },     
			    });
			}
		});
	</script>

@endsection