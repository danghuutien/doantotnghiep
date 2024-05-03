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
    <!-- Icons Css -->
    <link href="{{ asset('admin_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin_assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/plugins/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('core/libs/nestable/nestable.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('admin_assets/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    @yield('head')
    <script src="{{ asset('admin_assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/node-waves/waves.min.js') }}"></script>
    <!-- apexcharts -->
    <script src="{{ asset('admin_assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{ asset('admin_assets/js/pages/dashboard.init.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('core/libs/nestable/jquery.nestable.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('admin_assets/js/app.js') }}"></script>
    <script src="{{ asset('core/js/functions.js') }}"></script>
</head>
<body data-sidebar="dark">
    <div class="sudo-wrap">
        <div id="layout-wrapper">
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <form action="#" class="dropzone dz-clickable">
                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                </div>
                                <h4>Drop files here or click to upload.</h4>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>