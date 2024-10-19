<form class="form-validate-jquery" action="{{ route('update.size',$data->id) }}" method="post" id="edit_form">
	@csrf
	<fieldset class="mb-3">
		<!-- Basic text input -->
		<div class="form-group row">
			<label class="col-form-label col-lg-12">Size <span class="text-danger">*</span></label>
			<div class="col-lg-12">
				<input type="text" name="size" class="form-control" value="{{ $data->size }}" placeholder="Size">
			</div>
		</div>
		<!-- /basic text input -->
	</fieldset>

	<div class="d-flex justify-content-end align-items-center">
		<button type="reset" data-dismiss="modal" class="btn btn-light">Close <i class="icon-cross3 ml-2"></i></button>
		<button type="submit" class="btn btn-primary ml-3">Save Change</button>
	</div>
</form>
