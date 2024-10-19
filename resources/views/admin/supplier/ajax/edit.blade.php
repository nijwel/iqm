<form class="form-validate-jquery" action="{{ route('update.supplier',$data->id) }}" method="post" id="edit_form">
	@csrf
	<fieldset class="mb-3">
		<!-- Basic text input -->
		<div class="row">
			<div class="form-group col-lg-6">
				<label class="col-form-label">Supplier Name <span class="text-danger">*</span></label>
				<input type="text" name="s_name" value="{{ $data->s_name }}" class="form-control @error('s_name') is-invalid @enderror" placeholder="Supplier name">
			</div>
			<div class="form-group col-lg-6">
				<label class="col-form-label">Supplier Phone <span class="text-danger">*</span></label>
				<input type="text" name="s_phone" value="{{ $data->s_phone }}" class="form-control @error('s_phone') is-invalid @enderror" placeholder="Supplier phone">
			</div>
			<div class="form-group col-lg-6">
				<label class="col-form-label">Supplier Email</label>
				<input type="email" name="s_email" value="{{ $data->s_email }}" class="form-control @error('s_email') is-invalid @enderror" placeholder="Supplier Email">
			</div>
			<div class="form-group col-lg-6">
				<label class="col-form-label">Company Name <span class="text-danger">*</span></label>
				<input type="text" name="s_company_name" value="{{ $data->s_company_name }}" class="form-control @error('s_company_name') is-invalid @enderror" placeholder="Company name">
			</div>
			<div class="form-group col-lg-6">
				<label class="col-form-label">Company Phone <span class="text-danger">*</span></label>
				<input type="text" name="s_company_phone" value="{{ $data->s_company_phone }}" class="form-control @error('s_company_phone') is-invalid @enderror" placeholder="Company phone">
			</div>
			<div class="form-group col-lg-6">
				<label class="col-form-label">Address</label>
				<textarea name="s_address" class="form-control @error('s_address') is-invalid @enderror" placeholder="Company phone" style="height:35px;">{{ $data->s_address }}</textarea>
			</div>
		</div>
		<!-- /basic text input -->
	</fieldset>

	<div class="d-flex justify-content-end align-items-center">
		<button type="reset" data-dismiss="modal" class="btn btn-light">Close <i class="icon-cross3 ml-2"></i></button>
		<button type="submit" class="btn btn-primary ml-3">Save Change</button>
	</div>
</form>
