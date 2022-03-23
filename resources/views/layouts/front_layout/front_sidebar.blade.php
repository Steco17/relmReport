<div class="sidebar-menu-wrapper">
    <div class="mobile_sidebar_menu">
        <button type="button" class="close_btn"><i class="fal fa-times"></i></button>

        <div class="about_content mb_60">
            <div class="brand_logo mb_15">
                <a href="index.html">
                    <img src="{{ asset('images/front_images/logo/logo_01_1x.png' ) }}" srcset="{{ asset('images/front_images/logo/logo_01_2x.png' ) }} 2x" alt="logo_not_found">
                </a>
            </div>
            <p class="mb-0">
                Nullam id dolor auctor, dignissim magna eu, mattis ante. Pellentesque tincidunt, elit a facilisis efficitur, nunc nisi scelerisque enim, rhoncus malesuada est velit a nulla. Cras porta mi vitae dolor tristique euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit
            </p>
        </div>

        <div class="menu_list mb_60 clearfix">
            <h3 class="title_text text-white">Menu</h3>
            <ul class="ul_li_block clearfix">
                <li class="active dropdown">
                    <a href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
                    <!--<ul class="dropdown-menu">
                        <li><a href="index_1.html">Home Page V.1</a></li>
                        <li><a href="index_2.html">Home Page V.2</a></li>
                    </ul>-->
                </li>
                <!--<li><a href="gallery.html">Our Cars</a></li>
                <li><a href="review.html">Reviews</a></li>-->
                <li><a href="about.html">About</a></li>
                <!--<li class="dropdown">
                    <a href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                    <ul class="dropdown-menu">
                        <li><a href="service.html">Our Service</a></li>
                        <li><a href="gallery.html">Car Gallery</a></li>
                        <li><a href="account.html">My Account</a></li>
                        <li><a href="reservation.html">Reservation</a></li>
                        <li class="dropdown">
                            <a href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blogs</a>
                            <ul class="dropdown-menu">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog_details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Our Cars</a>
                            <ul class="dropdown-menu">
                                <li><a href="car.html">Cars</a></li>
                                <li><a href="car_details.html">Car Details</a></li>
                            </ul>
                        </li>
                        <li><a href="cart.html">Shopping Cart</a></li>
                        <li><a href="faq.html">F.A.Q.</a></li>
                        <li><a href="login.html">Login</a></li>
                    </ul>
                </li>-->
                <li class="dropdown">
                    <a href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Contact Us</a>
                    <!--<ul class="dropdown-menu">
                        <li><a href="contact.html">Contact Default</a></li>
                        <li><a href="contact_wordwide.html">Contact Wordwide</a></li>
                    </ul>-->
                </li>
            </ul>
        </div>

        <div class="booking_car_form">
            <h3 class="title_text text-white mb-2">Send a Package</h3>
            <p class="mb_15">
                Nullam id dolor auctor, dignissim magna eu, mattis ante. Pellentesque tincidunt, elit a facilisis efficitur.
            </p>
            <form action="#">
                <div class="form_item">
                    <h4 class="input_title text-white">Pick Up Location</h4>
                    <div class="position-relative">
                        <input id="location_one" type="text" name="location" placeholder="City, State or Airport Code">
                        <label for="location_one" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
                    </div>
                </div>
                <div class="form_item">
                    <h4 class="input_title text-white">Weight of Package</h4>
                    <div class="position-relative">
                        <input id="location_one" type="text" name="weight" placeholder="Not more than 300Kg">
                        <label for="location_one" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
                    </div>
                </div>
                <div class="form_item">
                    <h4 class="input_title text-white">Pick A Date</h4>
                    <input type="date" name="date">
                </div>
                <button type="submit" class="custom_btn bg_default_red btn_width text-uppercase">Send Package <img src="{{ asset('images/front_images/icons/icon_01.png' ) }}" alt="icon_not_found"></button>
            </form>
        </div>

    </div>
    <div class="overlay"></div>
</div>
