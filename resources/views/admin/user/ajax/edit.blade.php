<form class="form-validate-jquery" action="{{ route('update.admin',$data->id) }}" method="post" id="edit_form">
	@csrf
	<fieldset class="mb-3">
		<div class="form-group row">
			<label class="col-form-label col-lg-12">User Name<span class="text-danger">*</span></label>
			<div class="col-lg-12">
				<input type="text" name="user_name" class="form-control" id="subcategory" value="{{ $data->user_name }}" placeholder="User name">
			</div>
			<strong class="text-danger category" ></strong>
		</div>

		<div class="form-group row">
			<label class="col-form-label col-lg-12">Email<span class="text-danger">*</span></label>
			<div class="col-lg-12">
				<input type="email" name="email" class="form-control" id="subcategory" placeholder="User email" value="{{ $data->email }}">
			</div>
			<strong class="text-danger category" ></strong>
		</div>
		<div class="form-group row">
			<label class="col-form-label col-lg-12">Password<span class="text-danger">*</span></label>
			<div class="col-lg-12">
				<input type="text" name="password" class="form-control" id="subcategory" placeholder="User Password">
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
