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
</head>
<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Chào mừng bạn quay trở lại !</h5>
                                        <p>Vui lòng đăng nhập để tiếp tục với {{env('APP_NAME')}}.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('admin_assets/images/profile-img.png')}}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0"> 
                            <div class="auth-logo">
                                <a href="index.html" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('admin_assets/images/logo-light.svg')}}" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>

                                <a href="index.html" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('admin_assets/images/logo.svg')}}" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" action="{!! route('admin.setLogin') !!}" id="login">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Tên đăng nhập hoặc Email</label>
                                        <input type="text" class="form-control" id="name" value="{!! env('USERNAME') !!}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Mật khẩu</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" value="{!! env('PASSWORD') !!}" aria-label="Password" aria-describedby="password-addon" id="password">
                                            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember-check">
                                        <label class="form-check-label" for="remember-check">
                                            Ghi nhớ đăng nhập
                                        </label>
                                    </div>
                                    
                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Đăng nhập</button>
                                    </div>
        
                                    {{-- <div class="mt-4 text-center">
                                        <h5 class="font-size-14 mb-3">Sign in with</h5>
        
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                                                    <i class="mdi mdi-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                                                    <i class="mdi mdi-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                                                    <i class="mdi mdi-google"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div> --}}

                                    <div class="mt-4 text-center">
                                        <a href="{!! route('admin.forgot_password') !!}" class="text-muted"><i class="mdi mdi-lock me-1"></i> Quên mật khẩu?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="mt-5 text-center">
                        
                        <div>
                            <p>Don't have an account ? <a href="auth-register.html" class="fw-medium text-primary"> Signup now </a> </p>
                        </div>
                    </div> --}}

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
    {{-- // chặn back trang khi ở trang login --}}
    <script type="text/javascript" >
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
          history.go(1);
        };
    </script>
</body>
</html>
