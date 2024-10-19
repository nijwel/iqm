<form class="form-validate-jquery" action="{{ route('update.brand',$data->id) }}" method="post" id="edit_form" enctype="multipart/form-data">
	@csrf
	<fieldset class="mb-3">
		<!-- Basic text input -->
		<div class="form-group row">
			<label class="col-form-label col-lg-12">Brand Name <span class="text-danger">*</span></label>
			<div class="col-lg-12">
				<input type="text" name="brand_name" class="form-control" id="category" placeholder="Brand name" value="{{ $data->brand_name }}">
			</div>
			<strong class="text-danger category" ></strong>
		</div>
		<div class="form-group row">
			<div class="col-sm-10 row">
				<label class="col-form-label col-lg-12">Brand Logo</label>
				<div class="col-lg-12">
					<input type="file" name="brand_image" class="form-control h-auto">
				</div>
			</div>
			<div class="col-sm-2 mt-4">
				<img src="{{ asset($data->brand_image) }}" width="50">
			</div>
		</div>
		<!-- /basic text input -->
	</fieldset>

	<div class="d-flex justify-content-end align-items-center">
		<button type="reset" data-dismiss="modal" class="btn btn-light">Close <i class="icon-cross3 ml-2"></i></button>
		<button type="submit" class="btn btn-primary ml-3">Save Change</button>
	</div>
</form>
