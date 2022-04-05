<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Relm Report " name="description">
        <meta content="Steco" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/front_images/favicon.png' ) }}">

		<!-- framework - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/bootstrap.min.css') }}">
		<!-- C3 Chart css -->
		<link href="{{ url('libs/c3/c3.min.css') }}" rel="stylesheet" type="text/css">
		<!-- icon - css include -->
		<link rel="stylesheet" type="text/css" href="{{ url('css/front_css/icons.min.css') }}">

		<!-- animation - css include -->
		<link  id="app-style" rel="stylesheet" type="text/css" href="{{ url('css/front_css/app.min.css') }}">

    </head>

    <body>

        <!-- Loader -->
            <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

         <!-- Begin page -->
         <div class="accountbg" style="background: url('/images/front_images/bg.jpg'); background-size: cover !important;background-position: center;"></div>

        <div class="account-pages mt-5 pt-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-5 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mt-4">
                                    <div class="mb-3">

                                        <a href=""><img src="{{url('images/front_images/logo.png') }}" height="30" alt="logo"></a>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <h4 class="font-size-18 mt-2 text-center">Welcome Back !</h4>
                                    <p class="text-muted text-center mb-4">Sign in to continue to Relm Report.</p>
                                    @include('front.flash_message')

                                    <form class="form-horizontal" id="login_form" action="{{ url('/user-login') }}" method="post">@csrf

                                        <div class="mb-3">
                                            <label class="form-label" for="username">Email</label>
                                            <input type="text" class="form-control"type="email" name="email" placeholder="Enter email">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="userpassword">Password</label>
                                            <input type="password" class="form-control" id="userpassword" type="password" name="password" placeholder="Password" placeholder="Enter password">
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="customControlInline">
                                                    <label class="form-check-label" for="customControlInline">
                                                        Remember me
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 text-end">
                                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </div>

                                        <div class="mb-0 row">
                                            <div class="col-12 mt-4">
                                                <a href="{{ url('forgot-password') }}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                        <div class="mt-5 text-center position-relative">
                            <p class="text-white">Don't have an account ? <a href="" class="fw-bold text-primary"> Contact Admin </a> </p>
                            <p class="text-white"><script>document.write(new Date().getFullYear())</script> © Vistechy. Crafted with <i class="mdi mdi-heart text-danger"></i> by Steco</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- fraimwork - jquery include -->
		<script src="{{ url('libs/jquery/jquery.min.js') }}"></script>
		<script src="{{ url('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ url('libs/metismenu/metisMenu.min.js') }}"></script>

		<!-- animation - jquery include -->
		<script src="{{ url('libs/simplebar/simplebar.min.js') }}"></script>
		<script src="{{ url('libs/node-waves/waves.min.js') }}"></script>

        <script src="{{ url('js/front_js/app.js') }}"></script>


    </body>
</html>
