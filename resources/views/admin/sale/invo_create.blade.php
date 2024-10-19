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
                        <i class="icon-plus3 mr-2"></i> Invoice List
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
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
                            <label class="form-group-label">Customer Name <span class="text-danger">*</span></label>
                            <select name="customer_id" class="form-control select22" id="customer_id" required>
                                <option disabled selected value="">--Select--</option>
                                @foreach ($customers as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <strong class="text-danger category"></strong>
                        </div>

                        <div class="form-group col-lg-3 col-sm-12">
                            <label class="form-group-label">Invoice No. <span class="text-danger">*</span></label>
                            <input type="text" name="invoice_no" class="form-control" readonly
                                value="{{ 'cus -' . date('YmdHis') }}" placeholder="Invoice no.">
                        </div>

                        <div class="form-group col-lg-3 col-sm-12">
                            <label class="form-group-label">Date <span class="text-danger">*</span></label>
                            <input type="date" name="sale_date" class="form-control" value="{{ date('Y-m-d') }}"
                                required>
                        </div>
                    </div>

                    <hr>

                    <table class="table" id="dynamic_field">
                        <thead>
                            <tr>
                                <th width="50%">Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="row_1">
                                <td>
                                    <select class="form-control product_id select22" name="product_id[]" required
                                        id="product_id_1">
                                        <option disabled selected value="">--Select--</option>
                                        @foreach ($product as $row)
                                            <option value="{{ $row->id }}">{{ $row->subcategory->subcategory }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="item_price[]" id="item_price_1"
                                        class="form-control item_price" placeholder="0.00" required></td>
                                <td><input type="number" name="item_qty[]" id="item_qty_1" class="form-control item_qty"
                                        value="1" min="1" required></td>
                                <td><input type="number" name="item_total_price[]" id="item_total_price_1"
                                        class="form-control item_total_price" readonly></td>
                                <td><button type="button" class="btn btn-sm btn-primary add">+</button></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td>Total</td>
                                <td><input type="number" id="total" name="total_price" class="form-control"
                                        value="0.00" readonly></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>Due</td>
                                <td><input type="number" id="due" name="due" class="form-control" readonly
                                        value="0.00"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td>Grand Total</td>
                                <td><input type="number" id="g_total" name="g_total" class="form-control" readonly
                                        value="0.00"></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>

                    <div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.select22').select2(); // Initialize Select2

            let rowCount = 1;

            // Function to calculate total price for each row
            function calculateRowTotal(row) {
                const price = parseFloat(row.find('.item_price').val()) || 0;
                const qty = parseInt(row.find('.item_qty').val()) || 0;
                const total = price * qty;
                row.find('.item_total_price').val(total.toFixed(2));
                return total;
            }

            // Function to calculate the grand total including due
            function calculateGrandTotal() {
                let grandTotal = 0;
                $('#dynamic_field .item_total_price').each(function() {
                    grandTotal += parseFloat($(this).val()) || 0;
                });
                const due = parseFloat($('#due').val()) || 0;
                $('#total').val(grandTotal.toFixed(2));
                $('#g_total').val((grandTotal + due).toFixed(2)); // Add due to the subtotal
            }

            // Event listener for changing product
            $(document).on('change', '.product_id', function() {
                const row = $(this).closest('tr');
                const productId = $(this).val();
                const url = "{{ url('product-sale/get/price') }}/" + productId;

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        row.find('.item_price').val(data.whole_sale).trigger('change');
                        row.find('.item_qty').val(1).trigger('change');
                    }
                });
            });

            // Event listener for quantity and price change
            $(document).on('change keyup', '.item_price, .item_qty', function() {
                const row = $(this).closest('tr');
                calculateRowTotal(row);
                calculateGrandTotal();
            });

            // Add new row
            $(document).on('click', '.add', function() {
                rowCount++;
                const newRow = `
            <tr id="row_${rowCount}">
                <td>
                    <select class="form-control product_id select22" name="product_id[]" required id="product_id_${rowCount}">
                        <option disabled selected value="">--Select--</option>
                        @foreach ($product as $row)
                            <option value="{{ $row->id }}">{{ $row->subcategory->subcategory }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="item_price[]" id="item_price_${rowCount}" class="form-control item_price" placeholder="0.00" required></td>
                <td><input type="number" name="item_qty[]" id="item_qty_${rowCount}" class="form-control item_qty" value="1" min="1" required></td>
                <td><input type="number" name="item_total_price[]" id="item_total_price_${rowCount}" class="form-control item_total_price" readonly></td>
                <td><button type="button" class="btn btn-danger btn-xs remove">-</button></td>
            </tr>
        `;
                $('#dynamic_field tbody').append(newRow);
                $('.select22').select2(); // Reinitialize Select2 for the new row
            });

            // Remove row
            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
                calculateGrandTotal();
            });

            // Fetch due amount when customer is selected
            $('#customer_id').change(function() {
                const cusId = $(this).val();
                if (cusId) {
                    $.ajax({
                        url: "{{ url('customer/get/due') }}/" + cusId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#shop_name').val(data.name);
                            $('#due').val(data.due);
                            $('#g_total').val((parseFloat($('#total').val()) + parseFloat(data
                                .due)).toFixed(2)); // Include due in grand total
                        }
                    });
                }
            });
        });
    </script>
@endsection
