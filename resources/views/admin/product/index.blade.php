@extends('layouts.app')
@section('page_title', 'Product')
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Product</span> - List</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('/home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Product</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @if (Auth::user()->user_type == 1)
                <div class="header-elements d-none">
                    <div class="breadcrumb justify-content-center">
                        <a href="{{ route('create.product') }}" class="btn btn-sm btn-success">
                            <i class="icon-plus3 mr-2"></i>
                            Add New
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- /page header -->
    <div class="content">
        <div class="row form-group">
            <div class="col-lg-12">
                <a href="{{ route('index.product') }}"><span
                        class="badge @if ($id == '') badge-warning @else badge-info @endif m-1"
                        style="font-size: 12px;">All Product</span></a>
                @foreach ($brands as $key => $brand)
                    @php
                        $product_count = App\Models\Admin\Product::where('category_id', $brand->id)->count();
                    @endphp
                    @if ($id)
                        <a href="{{ route('index.product.id', $brand->category_slug) }}"><span
                                class="badge @if ($brand->id == $id->id) badge-warning @else badge-info @endif m-1"
                                style="font-size: 12px;">{{ $brand->category }} ( {{ $product_count }} )</span></a>
                    @else
                        <a href="{{ route('index.product.id', $brand->category_slug) }}"><span class="badge badge-info m-1"
                                style="font-size: 12px;">{{ $brand->category }} ( {{ $product_count }} )</span></a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- Content area -->
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">
            <div class="card-header bg-info header-elements-inline">
                @if ($id)
                    <h5 class="card-title">{{ $id->category }} List</h5>
                @else
                    <h5 class="card-title">Product List</h5>
                @endif
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {{-- <form action="{{ route('index.product') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search products..."
                            value="{{ request()->get('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="submit">Search</button>
                        </div>
                    </div>
                </form> --}}

                <form action="{{ route('product.multi.delete') }}" method="post" id="multi_delete">
                    @csrf
                    <div>
                        <table class="table datatable-responsive" id="">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Costing</th>
                                    <th>Retail Price</th>
                                    <th>Wholesale</th>
                                    @if (Auth::user()->user_type == 1)
                                        <th>Stock</th>
                                        <th>Hide price</th>
                                        <th class="text-center">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $key => $row)
                                    <tr>
                                        <td width="30">{{ ++$key }}</td>
                                        <td>{{ $row->category->category }}</td>
                                        <td>{{ $row->subcategory->subcategory }}</td>
                                        <td>{{ $row->buying_price }}</td>
                                        <td>{{ $row->retail_price }}</td>
                                        <td>{{ $row->whole_sale }}</td>
                                        @if (Auth::user()->user_type == 1)
                                            <td>{{ $row->product_stock }}</td>
                                            <td>{{ $row->hide_price }}</td>
                                            <td class="text-center" width="120">
                                                <a href="{{ route('edit.product', $row->id) }}"
                                                    class="badge badge-sm badge-info">Edit</a>
                                                <a href="{{ route('delete.product', $row->id) }}" id="delete"
                                                    class="badge btn-sm badge-danger"> Delete</a>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">No products found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <button style="display: none;" class="btn btn-danger ml-1 mb-1 delete-btn delete_all"
                            id="delete_btn"><i class="icon-bin mr-2"></i> Delete</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /basic responsive configuration -->

        <!-- View Modal -->
        <div id="viewModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Product Details</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body" id="product_details">

                    </div>
                </div>
            </div>
        </div>
        <!-- /modal with h3 -->
    </div>

    <script>
        //edit request send
        $('body').on('click', '.view', function() {
            var id = $(this).data('id');
            var url = "{{ url('product/view') }}/" + id;
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    $('#product_details').html(data);
                }
            });
        });
    </script>

    <script>
        // All Checked
        $('#checkAll').change(function() {
            $('.checkItem').prop('checked', this.checked);
        });

        $('.checkItem').change(function() {

            if ($('.checkItem').is(':checked')) {
                $(".delete-btn").css("display", "");
            } else {
                $(".delete-btn").css("display", "none");
            }

        });
    </script>

    <script>
        $('.delete_all').on('click', function(e) {

            var allVals = [];
            $(".checkItem:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });


            if (allVals.length <= 0) {
                swal({
                    title: "Please Select a row !",
                })
                return false;
            } else {

                if (confirm("Are You Sure to delete? If delete data can not recover !") == true) {
                    return true;
                } else {
                    return false;
                }
            }
        });


        function myFunction() {
            // Get the checkbox
            var checkBox = document.getElementById("checkAll");
            // Get the output text
            var text = document.getElementById("delete_btn");

            // If the checkbox is checked, display the output text
            if (checkBox.checked == true) {
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        }
    </script>


@endsection
