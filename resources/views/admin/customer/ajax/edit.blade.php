<form class="form-validate-jquery" action="{{ route('update.customer',$data->id) }}" method="post" id="edit_form">
	@csrf
	<fieldset class="mb-3">
		<!-- Basic text input -->
		<div class="row">
			<div class="form-group col-lg-6">
				<label class="col-form-label">Customer Name <span class="text-danger">*</span></label>
				<input type="text" name="name" value="{{ $data->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Customer name">
			</div>
			<div class="form-group col-lg-6">
				<label class="col-form-label">Customer Phone <span class="text-danger">*</span></label>
				<input type="text" name="phone" value="{{ $data->phone }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Customer phone">
			</div>
			<div class="form-group col-lg-6">
				<label class="col-form-label">Customer Email</label>
				<input type="email" name="email" value="{{ $data->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Customer Email">
			</div>
			<div class="form-group col-lg-6">
				<label class="col-form-label">Customer Due <span class="text-danger">*</span></label>
				<input type="number" value="{{ $data->due }}" name="due" min="1" readonly step="any"  class="form-control @error('due') is-invalid @enderror" placeholder="Due amount">
			</div>
		</div>
		<!-- /basic text input -->
	</fieldset>

	<div class="d-flex justify-content-end align-items-center">
		<button type="reset" data-dismiss="modal" class="btn btn-light">Close <i class="icon-cross3 ml-2"></i></button>
		<button type="submit" class="btn btn-primary ml-3">Save Change</button>
	</div>
</form>
