<form class="form-validate" action="{{ route('update.amount.paid', $data->id) }}" method="post" id="add_form">
    @csrf
    <fieldset class="mb-3">
        <!-- Basic text input -->
        <div class="row">
            <div class="form-group col-lg-8 mt-2">
                <label class="form-group-lebel">Customer Name <span class="text-danger">*</span></label>
                <select name="customer_id" class="form-control customer_id select22" style="width: 100%" id="customer_id"
                    required>
                    <option disabled selected value="">--Select--</option>
                    @foreach ($customers as $row)
                        <option value="{{ $row->id }}" @if ($row->id == $data->customer_id) selected @endif>
                            {{ $row->name }}</option>
                    @endforeach
                </select>
                <strong class="text-danger category"></strong>
            </div>

            <div class="form-group col-lg-4">
                <label class="col-form-label">Amount<span class="text-danger">*</span></label>
                <input type="number" name="amount" min="0" step="any" value="{{ $data->amount }}"
                    class="form-control" required placeholder="Amount">
            </div>
        </div>
        <!-- /basic text input -->
    </fieldset>

    <div class="d-flex justify-content-end align-items-center">
        <button type="reset" data-dismiss="modal" class="btn btn-light">Close <i
                class="icon-cross3 ml-2"></i></button>
        <button type="submit" class="btn btn-primary ml-3 btn-submit">Submit</button>
    </div>
</form>
