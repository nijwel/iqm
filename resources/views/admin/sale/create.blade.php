@extends('layouts.app')
@section('content')
    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4>
                    <i class="icon-arrow-left52 mr-2"></i>
                    <span class="font-weight-semibold">
                        {{ strtoupper($shop) }} - Shop Invoice
                    </span>
                </h4>
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
                    <a href="{{ route('index.product.sale.' . ($shop == 'kkm' ? 'kkm' : ($shop == 'mn' ? 'mn' : 'iqm'))) }}"
                        class="btn btn-sm btn-success">
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
                        <div class="form-group col-lg-3 col-sm-12">
                            <label class="form-group-lebel">Shop Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="shop_name" value="{{ strtoupper($shop) }}"
                                readonly>
                            @error('shop_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-lg-3 col-sm-12">
                            <label class="form-group-lebel">Invoice No. <span class="text-danger">*</span></label>
                            <input type="text" name="invoice_no" class="form-control" readonly
                                value="{{ strtoupper($shop) }} - {{ date('Ymdhis') }}">
                            @error('invoice_no')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-lg-3 col-sm-12">
                            <label class="form-group-lebel">Date<span class="text-danger">*</span></label>
                            <input type="date" name="sale_date"
                                class="form-control @error('sale_date') is-invalid @enderror" value="{{ date('Y-m-d') }}"
                                required>
                            @error('sale_date')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <hr>

                    <table class="table" id="dynamic_field">
                        <thead>
                            <tr>
                                <th width="50%">Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control product_id" name="product_id[]" required>
                                            <option disabled selected value="">--Select--</option>
                                            @foreach ($product as $row)
                                                <option value="{{ $row->id }}">{{ $row->subcategory->subcategory }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="item_price[]" class="form-control item_price" required
                                            placeholder="0.00" min="0" step="0.01">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="item_qty[]" class="form-control item_qty" required
                                            value="1" min="1" placeholder="0">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="number" name="item_total_price[]"
                                            class="form-control item_total_price" step="0.01" readonly placeholder="0">
                                    </div>
                                </td>
                                <td>
                                    {{-- <button type="button" class="btn btn-sm btn-primary add">+</button> --}}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td class="text-right"><strong>Total</strong></td>
                                <td>
                                    <input type="text" id="total" name="total_price" class="form-control total"
                                        readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary add">+</button>
                                </td>
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
        let i = 1;

        $(document).ready(function() {
            $('.product_id').select2(); // Initialize Select2 on existing select elements
        });

        $(document).on('change', '.product_id', function() {
            const productId = $(this).val();
            const row = $(this).closest('tr');

            if (productId) {
                $.get(`{{ url('product-sale/get/price') }}/${productId}`, function(data) {
                    row.find('.item_price').val(data.buying_price);
                    row.find('.item_qty').val(1);
                    calculateTotal(row);
                });
            }
        });

        $('.add').click(function() {
            i++;
            const newRow = `
            <tr>
                <td>
                    <select class='form-control product_id' name='product_id[]' required>
                        <option disabled selected>--Select--</option>
                        @foreach ($product as $row)
                            <option value='{{ $row->id }}'>{{ $row->subcategory->subcategory }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type='number' class='form-control item_price' name='item_price[]' step="0.01" required placeholder='0.00' min='0'></td>
                <td><input type='number' class='form-control item_qty' name='item_qty[]' required value='1' min='1'></td>
                <td><input type='number' class='form-control item_total_price' name='item_total_price[]' step="0.01" readonly></td>
                <td><button type='button' class='btn btn-danger remove'>-</button></td>
            </tr>
        `;
            $('#dynamic_field tbody').append(newRow);
            $('.product_id').select2(); // Re-initialize Select2 for the new row
        });

        $(document).on('click', '.remove', function() {
            $(this).closest('tr').remove();
            totalPrice();
        });

        $(document).on('change keyup', '.item_price, .item_qty', function() {
            const row = $(this).closest('tr');
            calculateTotal(row);
        });

        function calculateTotal(row) {
            const price = parseFloat(row.find('.item_price').val()) || 0;
            const qty = parseInt(row.find('.item_qty').val()) || 0;
            const total = (price * qty).toFixed(2);
            row.find('.item_total_price').val(total);
            totalPrice();
        }

        function totalPrice() {
            let total = 0;
            $(".item_total_price").each(function() {
                const value = parseFloat($(this).val()) || 0;
                total += value;
            });
            $("#total").val(total.toFixed(2));
        }
    </script>
@endsection
