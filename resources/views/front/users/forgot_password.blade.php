<!doctype html>
<html lang="en">
    <head>
    
        <meta charset="utf-8">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Relm Report " name="description">
        <meta content="Steco" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/front_images/favicon.ico' ) }}">

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
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mt-4">
                                    <div class="mb-3">
                                        <a href=""><img src="{{url('images/front_images/logo.png') }}" height="30" alt="logo"></a>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <h4 class="font-size-18 mt-2 text-center">Reset Password</h4>
                                    <p class="text-muted text-center mb-4">Enter your Email and instructions will be sent to you!</p>
    
                                    <form class="form-horizontal" action="index.html">

                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="useremail" name="email" placeholder="Enter email">
                                        </div>

                                        <div class="mb-3">
                                            <div class="text-end">
                                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                                            </div>
                                        </div>
                                    </form>
    
                                </div>
    
                            </div>
                        </div>
                        <div class="mt-5 text-center position-relative">
                            <p class="text-white">Remember It ? <a href="pages-login.html" class="font-weight-bold text-primary"> Sign In Here </a> </p>
                            <p class="text-white"><script>document.write(new Date().getFullYear())</script> © Admiria. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
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
