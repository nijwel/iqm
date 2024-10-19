<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mobile Parts @yield('page_title')</title>
    <link rel="shortcut icon" href="{{ asset('backend/') }}/images/logo.png">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Toaster-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/assets/toastr/toastr.css') }}">
    <!-- /global stylesheets -->
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="{{ asset('backend/global_assets/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">

    <!-- Core JS files -->
    <script src="{{ asset('backend/global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('backend/global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_pages/dashboard.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_charts/pages/dashboard/light/streamgraph.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_charts/pages/dashboard/light/sparklines.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_charts/pages/dashboard/light/lines.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_charts/pages/dashboard/light/areas.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_charts/pages/dashboard/light/donuts.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_charts/pages/dashboard/light/bars.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_charts/pages/dashboard/light/progress.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_charts/pages/dashboard/light/heatmaps.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_charts/pages/dashboard/light/pies.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_charts/pages/dashboard/light/bullets.js') }}"></script>
    <script src="{{ asset('/backend/assets/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/demo_pages/form_checkboxes_radios.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <!-- /theme JS files -->

    <!-- Select2 files -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>-->
    <script src="{{ asset('backend/global_assets/js/select2/select2.min.js') }}"></script>

    <script src="{{ asset('backend/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
    <!-- bootstrap color picker -->

    <script src="{{ asset('backend/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
    <script src="{{ asset('backend/global_assets/js/plugins/tables/datatables/extensions/select.min.js') }}"></script>

    <script src="{{ asset('backend/global_assets/js/demo_pages/datatables_responsive.js') }}"></script>

    <script src="{{ asset('backend/global_assets/js/demo_pages/datatables_extension_buttons_print.js') }}"></script>
</head>

<body>
    @guest()
    @else
        <!-- Main navbar -->
        @include('admin.include.main_header')
        <!--Main navbar end-->
        <!-- Page content -->
        <div class="page-content">
            <!-- Main side menu -->
            @include('admin.include.side_menu')
            <!-- Main side menu end -->
        @endguest
        <!-- Main content -->
        <div class="content-wrapper">
            <!--Content Area-->
            @yield('content')
            <!--/Content Area End-->
            <!-- Footer -->
            @guest
            @else
                @include('admin.include.footer')
            @endguest
            <!-- /Footer -->
        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

    <script src="{{ asset('/backend/assets/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $(document).on("click", "#delete", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                    title: "Are you Want to delete?",
                    text: "Once Delete, This will be Permanently Delete!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    } else {
                        swal("Safe Data!");
                    }
                });
        });
    </script>
    <script>
        @if (Session::has('messege'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            }
            var type = "{{ Session::get('alert-type', 'success') }}"
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('messege') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('messege') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('messege') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('messege') }}");
                    break;
            }
        @endif

        @if (count($errors) > 0)
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
            }
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    {{-- <script>
				CKEDITOR.replace( 'description' );
				CKEDITOR.replace( 'specification' );
			</script> --}}
</body>

</html>
