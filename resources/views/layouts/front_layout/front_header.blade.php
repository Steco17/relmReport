<header class="header_section sticky text-white clearfix">
    <div class="header_top clearfix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <ul class="header_contact_info ul_li clearfix">
                        <li><i class="fal fa-envelope"></i> mfuko@gmail.com</li>
                        <li><i class="fal fa-phone"></i> +237675577785</li>
                    </ul>
                </div>

                <div class="col-lg-5">
                    <ul class="primary_social_links ul_li_right clearfix">
                        <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#!"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#!"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="header_bottom clearfix">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="brand_logo">
                        <a href="index.html">
                            <img src="{{ asset('images/front_images/logo/logo_01_1x.png') }}" srcset="{{ asset('images/front_images/logo/logo_01_2x.png') }} 2x" alt="logo_not_found">
                            <img src="{{ asset('images/front_images/logo/logo_02_1x.png') }}" srcset="{{ asset('images/front_images/logo/logo_02_2x.png') }} 2x" alt="logo_not_found">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-6 order-last">
                    <ul class="header_action_btns ul_li_right clearfix">
                        <li>
                            <button type="button" class="search_btn" data-toggle="collapse" data-target="#collapse_search_body" aria-expanded="false" aria-controls="collapse_search_body">
                                <i class="fal fa-search"></i>
                            </button>
                        </li>
                        <li class="dropdown">
                            <!--<button type="button" class="cart_btn" id="cart_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fal fa-shopping-cart"></i>
                                <span class="cart_counter bg_default_red">3</span>
                            </button>
                            <div class="cart_dropdown rotors_dropdown dropdown-menu" aria-labelledby="cart_dropdown">
                                <h4 class="wrap_title">Cart Items: (3)</h4>
                                <ul class="cart_items_list ul_li_block clearfix">
                                    <li>
                                        <div class="item_image">
                                            <img src="{{ asset('images/front_images/cart/img_2.png') }}" alt="image_not_found">
                                        </div>
                                        <div class="item_content">
                                            <h4 class="item_title">Digital Infrared Thermometer</h4>
                                            <span class="item_price">$39.50</span>
                                        </div>
                                        <button type="button" class="remove_btn"><i class="fal fa-times"></i></button>
                                    </li>

                                    <li>
                                        <div class="item_image">
                                            <img src="{{ asset('images/front_images/cart/img_2.png') }}" alt="image_not_found">
                                        </div>
                                        <div class="item_content">
                                            <h4 class="item_title">Digital Infrared Thermometer</h4>
                                            <span class="item_price">$39.50</span>
                                        </div>
                                        <button type="button" class="remove_btn"><i class="fal fa-times"></i></button>
                                    </li>

                                    <li>
                                        <div class="item_image">
                                            <img src="{{ asset('images/front_images/cart/img_2.png') }}" alt="image_not_found">
                                        </div>
                                        <div class="item_content">
                                            <h4 class="item_title">Digital Infrared Thermometer</h4>
                                            <span class="item_price">$39.50</span>
                                        </div>
                                        <button type="button" class="remove_btn"><i class="fal fa-times"></i></button>
                                    </li>
                                </ul>
                                <ul class="btns_group ul_li_block clearfix">
                                    <li><a href="cart.html" class="custom_btn bg_default_red text-uppercase">View Cart <img src="{{ asset('images/front_images/icons/icon_01.png') }}" alt="icon_not_found"></a></li>
                                    <li><a href="#!" class="custom_btn bg_default_black text-uppercase">Checkout <img src="{{ asset('images/front_images/icons/icon_01.png') }}" alt="icon_not_found"></a></li>
                                </ul>
                            </div>
                        </li>-->
                        @if(Auth::check())
                            <li class="dropdown">
                                <button type="button" class="user_btn" id="user_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fal fa-user"></i>
                                </button>
                                <div class="user_dropdown rotors_dropdown dropdown-menu clearfix" aria-labelledby="user_dropdown">
                                    <div class="profile_info clearfix">
                                        <a href="#!" class="user_thumbnail">
                                            @if (isset(Auth::guard('web')->user()->image))
                                                <?php $profile_image_path = 'images/front_images/user_photos/'.Auth::guard('web')->user()->image; ?>
                                            @else
                                                <?php $profile_image_path = ' '; ?>
                                            @endif

                                            @if ($profile_image_path!= ''&&file_exists($profile_image_path))
                                                <img src="{{ asset($profile_image_path) }}"  alt="">
                                            @else
                                                <img src="{{ asset('images/default_image.png') }}" alt="thumbnail_not_found">
                                            @endif
                                        </a>
                                        <div class="user_content">
                                            <h4 class="user_name"><a href="{{ url('/account') }}">{{ Auth::guard('web')->user()->name }},{{Auth::guard('web')->user()->image }}</a></h4>
                                            <span class="user_title">Premium Sender</span>
                                        </div>
                                    </div>
                                    <ul class="ul_li_block clearfix">
                                        <li><a href="{{ url('/account') }}"><i class="fal fa-user-circle"></i> Profile</a></li>
                                        <li><a href="{{ url('/logout') }}"><i class="fal fa-sign-out"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="{{ url('/login-register') }}" style="color: white">
                                    Login
                                </a>
                            </li>
                        @endif
                        <li>
                            <button type="button" class="mobile_sidebar_btn"><i class="fal fa-align-right"></i></button>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6 col-md-12">
                    <nav class="main_menu clearfix">
                        <ul class="ul_li_center clearfix">
                            <li class="active has_child">
                                <a href="{{ url('/') }}">Home</a>

                            </li>
                            <!--<li><a href="gallery.html">Our Cars</a></li>
                            <li><a href="review.html">Reviews</a></li>-->
                            <li><a href="about.html">About</a></li>

                            <li class="has_child">
                                <a href="{{ url('/contact_us') }}">Contact Us</a>

                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>

    <div id="collapse_search_body" class="collapse_search_body collapse">
        <div class="search_body">
            <div class="container">
                <form action="#">
                    <div class="form_item">
                        <input type="search" name="search" placeholder="Type here...">
                        <button type="submit"><i class="fal fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>
