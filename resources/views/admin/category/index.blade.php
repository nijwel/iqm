@extends('layouts.app')
@section('page_title', ' | Brand')
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Brand</span> - List</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('/home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Brand</span>
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
                <h5 class="card-title">Brand List</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('category.multi.delete') }}" method="post" id="multi_delete">
                    @csrf
                    <table class="table datatable-responsive" id="datatable">
                        <thead>
                            <tr>
                                {{-- <th width="100"><input type="checkbox" id="checkAll" onclick="myFunction()"></th> --}}
                                <th width="150">SL</th>
                                <th>Brand</th>
                                <th></th>
                                <th></th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $key=>$row)
                                <tr>
                                    {{-- <td><input type="checkbox" name="ids[]" value="{{ $row->id }}" class="checkItem"></td> --}}
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $row->category }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        @if ($row->status == 1)
                                            <a href="{{ route('active.category', $row->id) }}"><span
                                                    class="badge badge-success">Active</span></a>
                                        @else
                                            <a href="{{ route('deactive.category', $row->id) }}"><span
                                                    class="badge badge-danger">Deactive</span></a>
                                        @endif
                                    </td>
                                    <td class="text-center" width="120">
                                        <!--<div class="list-icons">-->
                                        <!--	<div class="dropdown">-->
                                        <!--		<a href="#" class="list-icons-item" data-toggle="dropdown">-->
                                        <!--			<i class="icon-menu9"></i>-->
                                        <!--		</a>-->

                                        <!--		<div class="dropdown-menu dropdown-menu-right">-->
                                        <!--			<a href="#" class="dropdown-item edit" data-id="{{ $row->id }}" data-toggle="modal" data-target="#editModal"><i class="icon-wrench3"></i> Edit</a>-->
                                        <!--			<a href="{{ route('delete.category', $row->id) }}" id="delete" class="dropdown-item"><i class="icon-bin"></i> Delete</a>-->
                                        <!--		</div>-->
                                        <!--	</div>-->
                                        <!--</div>-->
                                        <a href="#" class="badge badge-info edit" data-id="{{ $row->id }}"
                                            data-toggle="modal" data-target="#editModal"> Edit</a>
                                        <a href="{{ route('delete.category', $row->id) }}" id="delete"
                                            class="badge badge-danger"> Delete</a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        <button style="display: none;" class="btn btn-danger ml-1 mb-1 delete-btn delete_all"
                            id="delete_btn"><i class="icon-bin mr-2"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /basic responsive configuration -->

        <!-- Create Modal -->
        <div id="addModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Category</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <form class="form-validate" action="{{ route('store.category') }}" method="post" id="add_form">
                            @csrf
                            <fieldset class="mb-3">
                                <!-- Basic text input -->
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-12">Category Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" name="category" class="form-control" id="category"
                                            placeholder="Category name" required>
                                    </div>
                                    <strong class="text-danger category"></strong>
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Category</h3>
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
            var url = "{{ url('category/edit') }}/" + id;
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
