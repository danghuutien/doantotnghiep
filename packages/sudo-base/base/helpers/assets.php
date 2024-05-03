<?php 

function loadStyleAdmin() {
	\Asset::addDirectly([
        // Font Awesome
        asset('admin_assets/plugins/fontawesome-free/css/all.min.css'),
        // OverlayScrollbars
        asset('admin_assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'),
        // Toastr
        asset('admin_assets/plugins/toastr/toastr.min.css'),
        // Daterangepicker
        asset('admin_assets/plugins/daterangepicker/daterangepicker.css'),
        // Datetimepicker
        asset('admin_assets/plugins/datetimepicker/jquery.datetimepicker.min.css'),
        // Select2
        asset('admin_assets/plugins/select2/css/select2.min.css'),
        // Nestable
        asset('core/libs/nestable/nestable.css'),
        // Adminlte
        asset('admin_assets/css/adminlte.min.css'),
        // Google Font: Source Sans Pro
        asset('admin_assets/plugins/source-sans-pro/css/all.min.css'),
        // Main Style
        asset('core/css/style.css'),
    ], 'styles', 'top')
    ->addDirectly([
        // jquery
        asset('admin_assets/plugins/jquery/jquery.min.js'),
        // jquery-ui
        asset('admin_assets/plugins/jquery-ui/jquery-ui.min.js'),
        // bootstrap
        asset('admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js'),
        // overlayScrollbars
        asset('admin_assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'),
        // toastr
        asset('admin_assets/plugins/toastr/toastr.min.js'),
        // moment
        asset('admin_assets/plugins/moment/moment.min.js'),
        // daterangepicker
        asset('admin_assets/plugins/daterangepicker/daterangepicker.js'),
        // datetimepicker
        asset('admin_assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js'),
        // select2
        asset('admin_assets/plugins/select2/js/select2.full.min.js'),
        // nestable
        asset('core/libs/nestable/jquery.nestable.js'),
        // tinymce
        asset('admin_assets/plugins/tinymce/tinymce.min.js'),
        // adminlte
        asset('admin_assets/js/adminlte.min.js'),
        // core functions
        asset('core/js/functions.js'),
    ], 'scripts', 'top')
    ->addDirectly([
        // core nestable
        asset('core/libs/nestable/nestable.js'),
        // core main
        asset('core/js/core.js'),
        // core script
        asset('core/js/script.js'),
    ], 'scripts', 'bottom');
}