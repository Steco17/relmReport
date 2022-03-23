@extends('layouts.front_layout.front_layout')
@section('content')
<main>
    <!-- mobile menu - start
    ================================================== -->
    @include('layouts.front_layout.front_sidebar')
    <!-- mobile menu - end
    ================================================== -->


    <!-- breadcrumb_section - start
    ================================================== -->
    <section class="breadcrumb_section text-center clearfix">
        <div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="{{ asset('images/front_images/breadcrumb/bg_09.jpg' ) }}">
            <div class="overlay"></div>

        </div>
    </section>
    <!-- breadcrumb_section - end
    ================================================== -->


    <!-- register_section - start
    ================================================== -->
    <section class="register_section sec_ptb_100 clearfix">

        <div class="container">
            @include('front.flash_message')
            <div class="register_card mb_60" data-bg-color="##F2F2F2" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="reg_image" data-aos="fade-up" data-aos-delay="300">
                            <img src="{{ asset('images/front_images/about/img_03.jpg' ) }}" alt="image_not_found">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="reg_form" data-aos="fade-up" data-aos-delay="500">
                            <h3 class="form_title">LogIn:</h3>

                            <p>
                                Savings of up to 15% with our car rental solutions, global coverage and a dedicated customer team
                            </p>
                            <span class="new_account mb_15">Log In or <a href="#!">Create an Account?</a></span>
                            <form id="login_form" action="{{ url('/user-login') }}" method="post">@csrf
                                <div class="form_item">
                                    <input type="email" name="email" placeholder="Your email">
                                </div>
                                <div class="form_item">
                                    <input type="password" name="password" placeholder="Password">
                                </div>
                                <button type="submit" class="custom_btn bg_default_red text-uppercase">Login <img src="{{ asset('images/front_images/icons/icon_01.png') }}" alt="icon_not_found"></button>
                                <span class="reset_pass mb_15"><a href="{{ url('forgot-password') }}">Reset Your Password by e-mail?</a></span>
                                <div class="checkbox_input mb-0">
                                    <label for="input_save"><input id="input_save" type="checkbox"> Save my name, email, and website in this browser for the next time I comment</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <div class="register_card mb-60" data-bg-color="##F2F2F2" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="reg_image" data-aos="fade-up" data-aos-delay="300">
                            <img src="{{ asset('images/front_images/about/img_03.jpg') }}" alt="image_not_found" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="section_title mb_30 text-center">
                            <h2 class="title_text mb-0" data-aos="fade-up" data-aos-delay="300">
                                <span>Register</span>
                            </h2>
                        </div>
                       <form id="register_form" action="{{ url('/user-register') }}" method="post">@csrf
                            <div class="row justify-content-lg-between">
                                <div class="" data-aos="fade-up"
                                    data-aos-delay="500">
                                    <div class="form_item">
                                        <input type="text" name="name" id="name" placeholder="Your Name*" />
                                    </div>
                                    <div class="form_item">
                                        <input type="email" name="email" id="email" placeholder="Your Email*" />
                                    </div>
                                    <div class="form_item">
                                        <input type="password" name="password" placeholder="Password*" />
                                    </div>
                                    <div class="form_item">
                                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password*" />
                                    </div>
                                    <div class="form_item">
                                        <input type="tel" name="mobile" id="mobile" placeholder="Phone Number*" />
                                    </div>
                                    <p>
                                        Your personal data will be used in mapping with the
                                        package you taken to transport, to manage access to your
                                        account, and for other purposes described in our terms.
                                    </p>
                                    <button type="submit" class="custom_btn bg_default_red text-uppercase mb-0">Sign Up <img src="{{ asset('images/front_images/icons/icon_01.png') }}" alt="icon_not_found"></button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- register_section - end
    ================================================== -->


</main>

@endsection
