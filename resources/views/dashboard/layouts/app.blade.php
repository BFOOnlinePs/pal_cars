<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title')</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    {{--    <link rel="stylesheet" href="{{ asset('assets/fonts/Tajawal/SansPro.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap_rtl-v4.2.1/bootstrap.min.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap_rtl-v4.2.1/custom_rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mycustomstyle.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/jquery-ui.css') }}">
    @yield('style')

    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <style>
        * {
            font-family: 'Tajawal', sans-serif;
        }

        #calendar {
            direction: ltr !important;
        }

    </style>

</head>

<body class="layout-top-nav" style="height: auto;" data-new-gr-c-s-check-loaded="14.1147.0" data-gr-ext-installed
    cz-shortcut-listen="true">
    <div class="wrapper">

        @include('layouts.navbar')
        <!-- Navbar -->
        {{-- @if(auth()->check() && auth()->user()->user_role == '["1"]') --}}
        @if(auth()->check() && in_array('1', json_decode(auth()->user()->user_role, true)))
        <div id="navbarContainer">
            @include('dashboard.layouts.navbar')
        </div>
        @endif
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        {{-- @include('layouts.sidebar') --}}
        <!-- Content Wrapper. Contains page content -->
        @include('dashboard.layouts.content')

        <div class="modal fade" id="modal-lg-view_attachment">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        <iframe id="view_attachment_result" src="" frameborder="0" width="100%"
                            style="height: 550px">

                        </iframe>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('dashboard.layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.js') }}"></script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        // $(function() {
        //     // Select all input elements with type="date" and apply Datepicker
        //     $('.date_format').datepicker({
        //         dateFormat: 'yy-mm-dd'
        //     });
        // });
    </script>

    @yield('script')
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>

        function toggleNavbar() {
            $('#navbarContainer').toggle();
        }

        function viewAttachment(url) {
            document.getElementById('view_attachment_result').src = url;
        }

        function numberFormat(value, decimals = 2) {
            // Convert the value to a float with specified decimals
            const floatValue = parseFloat(value);

            // Check if the conversion was successful
            if (isNaN(floatValue)) {
                throw new Error('Invalid value provided');
            }

            // Use toFixed to round to the specified number of decimals
            const roundedValue = floatValue.toFixed(decimals);

            // Use Number() to convert back to a number (removes trailing zeros)
            return Number(roundedValue);
        }

    </script>
</body>

</html>
