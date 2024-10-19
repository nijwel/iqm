<form class="form-validate-jquery" action="{{ route('update.sub_category',$data->id) }}" method="post" id="edit_form">
	@csrf
	<fieldset class="mb-3">
		<!-- Basic text input -->
		<div class="form-group row">
			<label class="col-form-label col-lg-12">Brand Name <span class="text-danger">*</span></label>
			<div class="col-lg-12">
				<select name="category_id" class="form-control edit_select22" style="width: 100%" id="category">
					<option disabled selected value="">--Select--</option>
					@foreach($category as $row)
					<option value="{{ $row->id }}" @if( $data->category_id ==  $row->id) selected @endif>{{ $row->category }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group row">
			<label class="col-form-label col-lg-12">Model Name <span class="text-danger">*</span></label>
			<div class="col-lg-12">
				<input type="text" name="subcategory" class="form-control" id="edit_subcategory" placeholder="Category name" value="{{ $data->subcategory }}">
			</div>
			<strong class="text-danger category" ></strong>
		</div>
		<!-- /basic text input -->
	</fieldset>

	<div class="d-flex justify-content-end align-items-center">
		<button type="reset" data-dismiss="modal" class="btn btn-light">Close <i class="icon-cross3 ml-2"></i></button>
		<button type="submit" class="btn btn-primary ml-3">Save Change</button>
	</div>
</form>

<script>
	$('.edit_select22').select2({
	        dropdownParent: $('#editModal')
	    });
</script>