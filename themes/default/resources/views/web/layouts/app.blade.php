<!DOCTYPE HTML>
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale={{ isiOSDevice() ? 1 : 2}}"/>
    <link href="{{ $config_general['favicon'] ?? asset('favicon.ico') }}" type="image/x-icon" rel="shortcut icon"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="agent" content="{{ checkAgent() }}">
    {{-- Các meta seo --}}
    @include('Default::general.layouts.seo')
    {{-- Cấu hình Asset --}}
    {!! Asset::renderHeader() !!}
    <link rel="preconnect" href="https://resize.sudospaces.com">
    <link rel="dns-prefectch" href="https://resize.sudospaces.com">
    <style type="text/css">
        @php
            echo file_get_contents(public_path('assets/css/general.min.css'));
            echo file_get_contents(public_path('assets/libs/owl-carousel/owl.carousel.min.css'));
        @endphp
    </style>
    @yield('head')
    {!!$config_code['html_head'] ?? ''!!}
</head>
<body class="@if((Route::getCurrentRoute() != null) && (Route::getCurrentRoute()->uri() != '/')) page-view @endif">
    @if(checkAgent() == 'web')
	   @include('Default::general.layouts.adminbar')
    @endif
    <div id="wrapper" class="page-wrapper">
        @include('Default::web.layouts.header')
        <main class="main {{ checkAgent() }} @if((Route::getCurrentRoute() != null) && (Route::getCurrentRoute()->uri() != '/' && checkAgent() == 'mobile')) pt-60 @endif">
            @yield('content')
            @if((Route::getCurrentRoute() != null) && (Route::getCurrentRoute()->uri() != '/'))
                @include('Default::web.layouts.showroom-system')
            @endif
        </main>
        @include('Default::web.layouts.footer')
    </div>
    <section id="loading_box" data-device="web" data-error="Có lỗi xảy ra vui lòng thử lại!">
        <div id="loading_image">
            <div class="outer">
                <div class="inner"></div>
            </div>
        </div>
    </section>
    <section id="show_compare" class="compare" data-compare_box=""></section>
    <div id="toast-container" class="toast-top-right">
        <div class="toast" aria-live="assertive" style="">
            <div class="toast-message">
                <p></p>
            </div>
        </div>
    </div>
    {!! Asset::renderFooter() !!}
    @yield('footerComment')
    @yield('foot')
    @php
        $third_party_script_body = str_replace(['<script','</script'],['\x3Cscript','\x3C/script'],$config_code['html_body'] ?? '');
    @endphp
    <script type="text/javascript" defer>
        document.addEventListener("DOMContentLoaded", function(event) {
            $(document).ready(function() {
                setTimeout(function() {
                    let script_body = `{!!$third_party_script_body!!}`;
                    $('body').append(script_body);
                }, 10000);
            });
        });
    </script>
</body>
</html>
