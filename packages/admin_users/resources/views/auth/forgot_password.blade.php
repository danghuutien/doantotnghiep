<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Forgot Password</title>
        {{-- Laravel csrf_token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('admin_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('admin_assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <!-- Toastr -->
        <link rel="stylesheet" href="{{asset('core/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('admin_assets/plugins/toastr/toastr.min.css')}}">
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
                                            <h5 class="text-primary"> Reset Password</h5>
                                            <p>Re-Password with {{env('APP_NAME')}}.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ asset('admin_assets/images/profile-img.png') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div>
                                    <a href="index.html">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ asset('admin_assets/images/logo.svg') }}" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="p-2">
                                    <div class="alert alert-success text-center mb-4" role="alert">
                                        Enter your Email and instructions will be sent to you!
                                    </div>
                                    {{-- <form class="form-horizontal"> --}}
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="forgot_password_email" placeholder="Enter email">
                                        </div>
                    
                                        <div class="text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" id="forgot_password_comfirm" action="{!! route('admin.setForgotPassword') !!}">Reset</button>
                                        </div>
                                    {{-- </form> --}}
                                </div>
            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="progress-box"><div class="progress-run"></div></div>
        <section id="loading_box"><div id="loading_image"></div></section>
        <!-- JAVASCRIPT -->
        <script src="{{ asset('admin_assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin_assets/libs/node-waves/waves.min.js') }}"></script>
        <!-- Toastr -->
        <script src="{{asset('admin_assets/plugins/toastr/toastr.min.js')}}"></script>
        
        <!-- App js -->
        <script src="{{ asset('admin_assets/js/app.js') }}"></script>
        <script>
            var required_forgot_email   = '@lang('AdminUser::admin.login.required_forgot_email')';
        </script>
        <script src="{{asset('core/js/functions.js')}}"></script>
        <script src="{{asset('core/js/login.js')}}"></script>
    </body>
</html>