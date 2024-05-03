<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Laravel csrf_token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin_assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/toastr/toastr.min.css')}}">
    <!-- App Css-->
    <link href="{{ asset('admin_assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('core/css/style.css')}}">
    <script src="{{asset('core/js/functions.js')}}"></script>
    <style>
        .col-md-8 {
            margin: 0 auto;
        }
        .panel {
            background: #fff;
        }
        .panel-heading {
            padding: 20px 0;
            background: #ccc;
        }
        .panel-body {
            padding: 15px;
        }
        .img {
            text-align: center;
        }
        button {
            margin-top: 15px;
        }
    </style> 
</head>
<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <h3 class="panel-heading text-center">Bảo mật đăng nhập bằng App Google Authenticator</h3>
                        <div class="panel-body text-left">
                            1. Quét mã QR này bằng Ứng dụng Google Authenticator của bạn. Ngoài ra, bạn có thể sử dụng mã: <code>{{ $data['secret'] ?? '' }}</code><br/><br/>
                            <div class="img">
                                <img src="{{$data['google2fa_url']  ?? ''}}" alt="">
                            </div>
                            <br/>
                            2. Nhập mã xác thực được tạo ra từ Google Authenticator:<br/><br/>
                            <form class="form-horizontal" action="{{ route('admin.2faVerify') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('one_time_password-code') ? ' has-error' : '' }}">
                                    {{-- <label for="one_time_password" class="control-label">Mã xác thực</label> --}}
                                    <input id="one_time_password" name="one_time_password" class="form-control col-md-4"  type="text" required placeholder="Mã xác thực" />
                                </div>
                                <button class="btn btn-lg btn-login btn-block btn-success" type="submit">Xác thực</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="progress-box"><div class="progress-run"></div></div>
    <section id="loading_box"><div id="loading_image"></div></section>
    <!-- end account-pages -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin_assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ asset('admin_assets/libs/node-waves/waves.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('admin_assets/plugins/toastr/toastr.min.js')}}"></script>
    <!-- App js -->
    <script src="{{ asset('admin_assets/js/app.js')}}"></script>
    <script>
        var required_info           = '@lang('AdminUser::admin.login.required_info')';
        var required_name           = '@lang('AdminUser::admin.login.required_name')';
        var required_password       = '@lang('AdminUser::admin.login.required_password')';
        var required_forgot_email   = '@lang('AdminUser::admin.login.required_forgot_email')';
    </script>
    <script src="{{asset('core/js/login.js')}}"></script>
</body>
</html>