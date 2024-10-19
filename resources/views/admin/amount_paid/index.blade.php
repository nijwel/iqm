@extends('layouts.app')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Amount Paid</span> - List</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Amount Paid</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            <div class="header-elements d-none">
                <div class="breadcrumb justify-content-center">
                    <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-sm btn-success">
                        <i class="icon-plus3 mr-2"></i>
                        Add New
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
            <div class="card-header bg-info header-elements-inline">
                <h5 class="card-title">Amount Paid List</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <table class="table datatable-responsive" id="datatable">
                <thead>
                    <tr>
                        <th width="50">SL</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Due Left</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key=>$row)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ Carbon\Carbon::parse($row->date)->format('d M, Y') }}</td>
                            <td>{{ $row->customer->name }}</td>
                            <td>{{ $row->amount }}</td>
                            <td>{{ $row->due_left }}</td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item edit" data-id="{{ $row->id }}"
                                                data-toggle="modal" data-target="#editModal"><i class="icon-wrench3"></i>
                                                Edit</a>
                                            <a href="{{ route('delete.amount.paid', $row->id) }}" id="delete"
                                                class="dropdown-item"><i class="icon-bin"></i> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /basic responsive configuration -->

        <!-- Create Modal -->
        <div id="addModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Payment</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="content">
                        <h4 class="customer_name text-center"></h4>
                        <h4 class="due_amount text-center text-danger"></h4>
                        <p class="payment_date float-right"></p>
                        <p class="last_amount"></p>
                    </div>
                    <div class="modal-body">
                        <form class="form-validate" action="{{ route('store.amount.paid') }}" method="post" id="add_form">
                            @csrf
                            <fieldset class="mb-3">
                                <!-- Basic text input -->
                                <div class="row">
                                    <div class="form-group col-lg-8 mt-2">
                                        <label class="form-group-lebel">Customer Name <span
                                                class="text-danger">*</span></label>
                                        <select name="customer_id" class="form-control customer_id select22"
                                            style="width: 100%" id="customer_id" required>
                                            <option disabled selected value="">--Select--</option>
                                            @foreach ($customers as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                        <strong class="text-danger category"></strong>
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label class="col-form-label">Amount<span class="text-danger">*</span></label>
                                        <input type="number" name="amount" min="0" step="any"
                                            value="{{ old('amount') }}" class="form-control" required
                                            placeholder="Amount">
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
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal with h3 -->

        <!-- Edit Modal -->
        <div id="editModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Customer</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body" id="edit_part">

                    </div>
                </div>
            </div>
        </div>
        <!-- /modal with h3 -->
    </div>

    <script>
        //edit request send
        $('body').on('click', '.edit', function() {
            var id = $(this).data('id');
            var url = "{{ url('customer-amount-paid/edit') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    $('#edit_part').html(data);
                }
            });
        });
    </script>

    <script>
        $('#customer_id').change(function() {
            var cus_id = $(this).val();

            if (cus_id) {
                $.ajax({
                    url: "{{ url('customer/get/due') }}/" + cus_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $(".customer_name").html('Customer Name : ' + data.name);
                        $(".due_amount").html('Due Amount : ' + data.due);
                        $(".last_amount").html('Last Paid Amount : ' + data.paid);
                        var lastPaymentDate = new Date(data.created_at);
                        var options = {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        };
                        var formattedDate = lastPaymentDate.toLocaleDateString('en-GB', options);

                        $(".payment_date").html('Last Payment Date : ' + formattedDate);
                    },
                });
            }
        });
    </script>


    <script>
        $('.select22').select2({
            dropdownParent: $('#addModal')
        });
    </script>
@endsection
