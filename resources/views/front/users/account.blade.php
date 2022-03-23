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
        <div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="{{ asset('images/front_images/breadcrumb/bg_10.jpg' ) }}">
            <div class="overlay"></div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <h1 class="page_title text-white mb-0">My Account</h1>
            </div>
        </div>
        <div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
            <div class="container">
                <ul class="ul_li clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li>Account</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- breadcrumb_section - end
    ================================================== -->


    <!-- account_section - start
    ================================================== -->
    <section class="account_section sec_ptb_100 clearfix">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">

                <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12">
                    <div class="account_tabs_menu clearfix" data-bg-color="#F2F2F2" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="list_title mb_15">Account Details:</h3>
                        <ul class="ul_li_block nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#admin_tab"><i class="fas fa-user"></i> {{ Auth::guard('web')->user()->name }}</a>
                            </li>
                            <li>
                                <a href="login.html"><i class="fas fa-sign-out-alt"></i> Log Out <img class="arrow" src="{{ asset('images/front_images/icons/icon_02.png')}}" alt="icon_not_found"></a>
                            </li>
                            <!--<li>
                                <a data-toggle="tab" href="#profile_tab"><i class="fas fa-address-book"></i> Package Profiles</a>
                            </li>-->
                            <li>
                                <a data-toggle="tab" href="#history_tab"><i class="fas fa-file-alt"></i> Package Transaction History</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                    <div class="account_tab_content tab-content">
                        <div id="admin_tab" class="tab-pane active">
                            <div class="account_info_list" data-aos="fade-up" data-aos-delay="100">
                                <h3 class="list_title mb_30">Account:</h3>
                                <ul class="ul_li_block clearfix">
                                    <li><span>Profile ID:</span> {{ Auth::guard('web')->user()->id }}</li>
                                    <li><span>Name:</span>{{ Auth::guard('web')->user()->name }}</li>
                                    <li><span>E-mail:</span> {{ Auth::guard('web')->user()->email }}</li>
                                    <li><span>Phone Number:</span> {{ $userDetails['mobile'] }}</li>
                                    <li><span>Country:</span> {{ $userDetails['country'] }}</li>
                                    <li><span>Address:</span> {{ $userDetails['address'] }}, {{ $userDetails['city'] }}, {{ $userDetails['state'] }}</li>
                                </ul>
                                <div type="button" class="text_btn text-uppercase" data-toggle="modal" data-target="#updateDetails"><span>Change Account Information</span> <img src="{{ asset('images/front_images/icons/icon_02.png') }}" alt="icon_not_found"></div>
                                <!-- TODO Change the button so it calls a modal instead at the top right hand corner-->
                            </div>

                            <!--TODO Make transaction history to have collapsable divs like in WhatsApp-->

                            <div class="account_info_list" data-aos="fade-up" data-aos-delay="500">
                                <h3 class="list_title mb_30">Package Transaction History:</h3>
                                <ul class="ul_li_block clearfix">
                                    <li><span>Sent Package:</span> No Packages Sent Yet</li>
                                    <li><span>Package Transported:</span> 0</li>
                                </ul>
                                <a class="text_btn text-uppercase" href="#!"><span>Send A Package</span> <img src="{{ asset('images/front_images/icons/icon_02.png')}}" alt="icon_not_found"></a>
                                <a class="text_btn text-uppercase" href="#!"><span>Transport A Package</span></a>
                            </div>
                        </div>

                        <!--Will make this History tab have collapsable menus like whatsapp messenger-->
                        <div id="history_tab" class="tab-pane fade">
                            <p>Need to rework this to make it easy to read</p>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- Modal section - start ================================================== -->
            <div class="modal fade" id="updateDetails" tabindex="-1" aria-labelledby="updateDetailsModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form role="form" class="ul_li_block clearfix" method="post"  id="accountForm" action="javascript:void(0)" name="accountForm"  enctype="multipart/form-data">@csrf
                                <div class="form_item">
                                    <div class="position-relative">
                                        <input  class="form-control" value="{{ Auth::guard('web')->user()->email }}"  placeholder="Enter email" readonly="">
                                        <label for="location_one" class="input_icon"><i class="fas fa-user"></i></label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="text" id="user_name" name="user_name" value="{{ Auth::guard('web')->user()->name }}" class="form-control" id="current" placeholder="Enter user Name" readonly="">
                                        <label for="location_one" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
                                    </div>
                                    <div class="position-relative">
                                        <select class="form-select" aria-label="Default select example" id="country" name="country" style="width: 500px">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country['country_name'] }}" @if($country['country_name'] == $userDetails['country'])
                                                selected="" @endif>
                                                    {{ $country['country_name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="state" name="state"  value="{{ $userDetails['state'] }}" placeholder="Enter your State"  >
                                        <label for="location_one" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="city" name="city"  value="{{ $userDetails['city'] }}" placeholder="Enter your city"  >
                                        <label for="location_one" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="text" class="form-control" id="address" name="address"  value="{{ $userDetails['address'] }}" placeholder="Enter your address"  >
                                        <label for="location_one" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="text" id="user_mobile" name="user_mobile" value="{{ Auth::guard('web')->user()->mobile }}" class="form-control" placeholder="Enter user Mobile">
                                        <label for="location_one" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
                                    </div>
                                    <div class="position-relative">
                                        <input type="file" class="form-control-file" id="user_image" name="user_image" accept="image/*">
                                    </div>
                                    <div class="position-relative">
                                        @if(!empty(Auth::guard('web')->user()->image))
                                            <a target="_blank" href="{{url('images/front_images/user_photos/'.Auth::guard('web')->user()->image) }}">View Image</a>
                                            <input type="hidden" name="current_user_image" id="current_user_image" value="{{ Auth::guard('web')->user()->image }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="text_btn text-uppercase" style="margin-right: 23px;" data-dismiss="modal">Close</button>
                                    <button type="submit" class="text_btn text-uppercase" style="color: #79410D;"  id="aprofileUpdate" name="aprofileUpdate">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- account_section - end
    ================================================== -->


</main>
@endsection
