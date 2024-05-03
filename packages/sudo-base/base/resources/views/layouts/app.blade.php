<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | {{env('APP_NAME')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Laravel csrf_token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="admin_dir" content="{{ config('app.admin_dir') }}">
    <meta name="language" content="{{ \App::getLocale() }}">
    {{-- Asset đầu trang --}}
    {{-- {!! \Asset::renderHeader() !!} --}}
    {{-- Code nhúng đầu trang --}}
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_assets/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/toastr/toastr.min.css')}}">
    <!-- Icons Css -->
    <link href="{{ asset('admin_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin_assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/plugins/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('core/libs/nestable/nestable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @yield('head')
    <script src="{{ asset('admin_assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
</head>
<body data-sidebar="dark">
    <div class="sudo-wrap">
        <!-- <body data-layout="horizontal" data-topbar="dark"> -->
        <!-- Begin page -->
        <div id="layout-wrapper">

            {{-- header --}}
            @include('Core::layouts.base.header')
            
            {{-- menu --}}
            @include('Core::layouts.base.menu')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">

                        {{-- menu --}}
                        @include('Core::layouts.base.content_header')
                        @include('Core::layouts.base.alert')
                        @yield('content')
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                {{-- footer --}}
                @include('Core::layouts.base.footer')
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
        <!-- Right Sidebar -->

        <!-- /Right-bar -->
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        @include('Core::layouts.base.media')
    </div>
    {{-- Asset cuối trang --}}
    {{-- {!! \Asset::renderFooter() !!} --}}
    <!-- Code nhúng cuối trang -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/pages/table-responsive.init.js') }}"></script>
    <!-- Toastr -->
    <script src="{{asset('admin_assets/plugins/toastr/toastr.min.js')}}"></script>
    <!-- apexcharts -->
    <script src="{{ asset('admin_assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{ asset('admin_assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('core/libs/nestable/jquery.nestable.js') }}"></script>
    
    <script src="{{ asset('admin_assets/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/pages/form-mask.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('admin_assets/js/app.js') }}"></script>
    <script src="{{ asset('core/js/core.js') }}?v={{ config('SudoAsset.vesion') ?? '1.0.0' }}"></script>
    <script src="{{ asset('core/js/functions.js') }}"></script>
    <script src="{{ asset('core/libs/nestable/nestable.js') }}"></script>
    <script src="{{ asset('platforms/comments/admin/js/comments.js') }}"></script>
    @yield('foot')
</body>
</html>
