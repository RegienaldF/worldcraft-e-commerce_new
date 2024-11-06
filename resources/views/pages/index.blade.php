@extends('master')

@section('index')
    <style>
        .warehouse-address {
            font-size: 12px;
            display: block;
            text-align: center;
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-warehouse {
            width: 270px;
            text-align: center;
        }

        .text-truncate {
            display: block;
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    <body>
        <div class="menu-overlay"></div>

        <!-- Slider Section Start -->
        <div class="section slider-section-03">
            <div class="slider-active">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Single Slider Start  -->
                        <div class="single-slider slider-02 swiper-slide animation-style-01"
                            style="background-image: url({{ asset('worldcraft/banners/october-banner.jpg') }});">
                        </div>
                        <!-- Single Slider End  -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Section End -->

        <!-- Slider Section Start -->
        <div class="section slider-section-03">
            <div class="slider-active">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Single Slider Start  -->
                        <div class="single-slider slider-02 swiper-slide animation-style-01"
                            style="background-image: url({{ asset('worldcraft/banners/b1t1-banner.jpg') }});">
                        </div>
                        <!-- Single Slider End  -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Section End -->

        <!-- Slider Section Start -->
        <div class="section slider-section-03">
            <div class="slider-active">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Single Slider Start  -->
                        <div class="single-slider slider-02 swiper-slide animation-style-01"
                            style="background-image: url({{ asset('worldcraft/banners/advance-ordering-banner.jpg') }});">
                        </div>
                        <!-- Single Slider End  -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Section End -->

        <!-- Slider Section Start -->
        <div class="section slider-section-03">
            <div class="slider-active">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Single Slider Start  -->
                        <div class="single-slider slider-02 swiper-slide animation-style-01"
                            style="background-image: url({{ asset('worldcraft/banners/wc-extra-banner.jpg') }});">
                        </div>
                        <!-- Single Slider End  -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Section End -->

        <!-- Slider Section Start -->
        <div class="section slider-section-03">
            <div class="slider-active">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Single Slider Start  -->
                        <div class="single-slider slider-02 swiper-slide animation-style-01"
                            style="background-image: url({{ asset('worldcraft/banners/best-seller-banner.jpg') }});">
                        </div>
                        <!-- Single Slider End  -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Section End -->

        <!-- Slider Section Start -->
        <div class="section slider-section-03">
            <div class="slider-active">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Single Slider Start  -->
                        <div class="single-slider slider-02 swiper-slide animation-style-01"
                            style="background-image: url({{ asset('worldcraft/banners/dealer-banner.jpg') }});">
                        </div>
                        <!-- Single Slider End  -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider Section End -->

        <!-- Slider Section Start -->
        <div class="section slider-section-03">
            <div class="slider-active">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Single Slider Start  -->
                        <div class="single-slider slider-02 swiper-slide animation-style-01"
                            style="background-image: url({{ asset('worldcraft/banners/overrun-banner.jpg') }});">
                        </div>
                        <!-- Single Slider End  -->
                    </div>
                    <br><br><br>
                </div>
            </div>
        </div>
        <!-- Slider Section End -->

        <!-- Benefit Section Start -->
        <div class="section section-padding-01 mt-n4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">

                        <!-- Single Benefit Start -->
                        <div class="single-benefit">
                            <img src="{{ asset('/images/icon/icon-1.png') }}" alt="Icon">
                            <h3 class="title">In-house pickup</h3>
                            <p>Worldcraft offers In-house pickup and Delivery nationwide</p>
                        </div>
                        <!-- Single Benefit End -->

                    </div>
                    <div class="col-lg-4 col-md-6">

                        <!-- Single Benefit Start -->
                        <div class="single-benefit">
                            <img src="{{ asset('/images/icon/icon-2.png') }}" alt="Icon">
                            <h3 class="title">Safe Payment</h3>
                            <p>Worldcraft supports banking payments, and Cash on Delivery payment</p>
                        </div>
                        <!-- Single Benefit End -->

                    </div>
                    <div class="col-lg-4 col-md-6">

                        <!-- Single Benefit Start -->
                        <div class="single-benefit">
                            <img src="{{ asset('/images/icon/icon-3.png') }}" alt="Icon">
                            <h3 class="title">Online Support</h3>
                            <p>Worldcraft provides online support for the customers or users needs assistance</p>
                        </div>
                        <!-- Single Benefit End -->

                    </div>

                    <!-- New Product Section Start -->
                    <div class="section section-padding-02 mt-n2">
                        <div class="container">

                            <!-- Section Title Start -->
                            <div class="section-title-02 text-center">
                                <h2 class="title">PRODUCT CATEGORY</h2>
                            </div>
                            <!-- Section Title End -->

                            <!-- Product Wrapper 02 Start -->
                            <div class="product-wrapper-02">
                                <!-- Product Tabs Content Start -->
                                <div class="product-tabs-content">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tab1">
                                            <div class="row">
                                                <div class="col-lg-3 col-sm-6">
                                                    <!-- New Arrival -->
                                                    <div
                                                        class="single-product-02 d-flex align-items-center flex-column shadow p-6 mb-3 bg-body rounded">
                                                        <div class="product-images">
                                                            <a href="{{ url('worldcraft-temp-2/shop-grid-left-sidebar?key=2') }}"
                                                                class="menu-title">
                                                                <img src="{{ asset('worldcraft/icons/new-arrival-icon.png') }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4 class="title"><a
                                                                    href="/worldcraft-temp-2/shop-grid-left-sidebar.php?key=<?php echo $category_id = 4; ?>"><b>New
                                                                        Arrival</b>
                                                                </a></h4>
                                                        </div>

                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <!-- Clearance Sale -->
                                                    <div
                                                        class="single-product-02 d-flex align-items-center flex-column shadow p-6 mb-3 bg-body rounded">
                                                        <div class="product-images">
                                                            <a
                                                                href="/worldcraft-temp-2/shop-grid-left-sidebar.php?key=<?php echo $category_id = 5; ?>">
                                                                <img src="{{ asset('worldcraft/icons/sale-icon.png') }}"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4 class="title"><a
                                                                    href="/worldcraft-temp-2/shop-grid-left-sidebar.php?key=<?php echo $category_id = 5; ?>"><b>CABINETS</b></a>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    {{-- Bed Category --}}
                                                    <div
                                                        class="single-product-02 d-flex align-items-center flex-column shadow p-6 mb-3 bg-body rounded">
                                                        <div class="product-images">
                                                            <a href="{{ url('worldcraft-temp-2/shop-grid-left-sidebar?key=1') }}"
                                                                class="menu-title">
                                                                <img src="{{ asset('worldcraft/icons/bed-icon.png') }}"
                                                                    style="width:150px" alt="product">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4 class="title"><a
                                                                    href="/worldcraft-temp-2/shop-grid-left-sidebar.php?key=<?php echo $category_id = 1; ?>"><b>BEDS</b></a>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    {{-- Chairs Category --}}
                                                    <div
                                                        class="single-product-02 d-flex align-items-center flex-column shadow p-6 mb-3 bg-body rounded">
                                                        <div class="product-images">
                                                            <a href="{{ url('worldcraft-temp-2/shop-grid-left-sidebar?key=1') }}"
                                                                class="menu-title">
                                                                <img src="{{ asset('worldcraft/icons/chair-icon.png') }}"
                                                                    style="width:150px" alt="product">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4 class="title"><a
                                                                    href="/worldcraft-temp-2/shop-grid-left-sidebar.php?key=<?php echo $category_id = 1; ?>"><b>CHAIRS</b></a>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    {{-- Racks Category --}}
                                                    <div
                                                        class="single-product-02 d-flex align-items-center flex-column shadow p-6 mb-3 bg-body rounded">
                                                        <div class="product-images">
                                                            <a href="{{ url('worldcraft-temp-2/shop-grid-left-sidebar?key=1') }}"
                                                                class="menu-title">
                                                                <img src="{{ asset('worldcraft/icons/rack-icon.png') }}"
                                                                    style="width:150px" alt="product">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4 class="title"><a
                                                                    href="/worldcraft-temp-2/shop-grid-left-sidebar.php?key=<?php echo $category_id = 1; ?>"><b>RACKS</b></a>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    {{-- School Sets Category --}}
                                                    <div
                                                        class="single-product-02 d-flex align-items-center flex-column shadow p-6 mb-3 bg-body rounded">
                                                        <div class="product-images">
                                                            <a href="{{ url('worldcraft-temp-2/shop-grid-left-sidebar?key=1') }}"
                                                                class="menu-title">
                                                                <img src="{{ asset('worldcraft/icons/school-sets.png') }}"
                                                                    style="width:150px" alt="product">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4 class="title"><a
                                                                    href="/worldcraft-temp-2/shop-grid-left-sidebar.php?key=<?php echo $category_id = 1; ?>"><b>BED</b></a>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    {{-- Table Category --}}
                                                    <div
                                                        class="single-product-02 d-flex align-items-center flex-column shadow p-6 mb-3 bg-body rounded">
                                                        <div class="product-images">
                                                            <a href="{{ url('worldcraft-temp-2/shop-grid-left-sidebar?key=1') }}"
                                                                class="menu-title">
                                                                <img src="{{ asset('worldcraft/icons/table-icon.png') }}"
                                                                    style="width:150px" alt="product">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4 class="title"><a
                                                                    href="/worldcraft-temp-2/shop-grid-left-sidebar.php?key=<?php echo $category_id = 1; ?>"><b>BED</b></a>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    {{-- Office furniture Category --}}
                                                    <div
                                                        class="single-product-02 d-flex align-items-center flex-column shadow p-6 mb-3 bg-body rounded">
                                                        <div class="product-images">
                                                            <a href="{{ url('worldcraft-temp-2/shop-grid-left-sidebar?key=1') }}"
                                                                class="menu-title">
                                                                <img src="{{ asset('worldcraft/icons/office-furniture.png') }}"
                                                                    style="width:170px" alt="product">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4 class="title"><a
                                                                    href="/worldcraft-temp-2/shop-grid-left-sidebar.php?key=<?php echo $category_id = 1; ?>"><b>OFFICE</b></a>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    {{-- Outside furniture Category --}}
                                                    <div
                                                        class="single-product-02 d-flex align-items-center flex-column shadow p-6 mb-3 bg-body rounded">
                                                        <div class="product-images">
                                                            <a href="{{ url('worldcraft-temp-2/shop-grid-left-sidebar?key=1') }}"
                                                                class="menu-title">
                                                                <img src="{{ asset('worldcraft/icons/outside-furniture.png') }}"
                                                                    style="width:150px" alt="product">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4 class="title"><a
                                                                    href="/worldcraft-temp-2/shop-grid-left-sidebar.php?key=<?php echo $category_id = 1; ?>"><b>OUTSIDE</b></a>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    {{-- Cabinet Category --}}
                                                    <div
                                                        class="single-product-02 d-flex align-items-center flex-column shadow p-6 mb-3 bg-body rounded">
                                                        <div class="product-images">
                                                            <a href="{{ url('worldcraft-temp-2/shop-grid-left-sidebar?key=1') }}"
                                                                class="menu-title">
                                                                <img src="{{ asset('worldcraft/icons/cabinet-icon.png') }}"
                                                                    style="width:135px" alt="product">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4 class="title"><a
                                                                    href="/worldcraft-temp-2/shop-grid-left-sidebar.php?key=<?php echo $category_id = 1; ?>"><b>Cabinet</b></a>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    {{-- Others Category --}}
                                                    <div
                                                        class="single-product-02 d-flex align-items-center flex-column shadow p-6 mb-3 bg-body rounded">
                                                        <div class="product-images">
                                                            <a href="{{ url('worldcraft-temp-2/shop-grid-left-sidebar?key=1') }}"
                                                                class="menu-title">
                                                                <img src="{{ asset('worldcraft/icons/other.png') }}"
                                                                    style="width:150px" alt="product">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h4 class="title"><a
                                                                    href="/worldcraft-temp-2/shop-grid-left-sidebar.php?key=<?php echo $category_id = 1; ?>"><b>OTHERS</b></a>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Tabs Content End -->

                            </div>
                            <!-- Product Wrapper 02 End -->
                            <br><br><br><br>
                        </div>
                    </div>
                    <!-- New Product Section End -->


                    <!-- Countdown Section Start -->
                    <div class="section section-padding overflow-hidden bg-color-01">
                        <div class="container">
                            <div class="countdown-main-wrapper mt-n10">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <!-- Countdown Content Start -->
                                        <div class="countdown-content">
                                            <h2 class="title">Chair Collection <span>50%</span> Off</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing sed do eiusmol tempor
                                                incididunt ut labore et
                                                dolore magna aliqua. Ut enim ad mini veniam, quis nostrud exercitation
                                                ullamco laboris nisi ut aliquip
                                                eao commodo consequat Duis aute irure.</p>

                                            <div class="countdown-wrapper">
                                                <div class="countdown" data-format="short">
                                                    <div class="single-countdown">
                                                        <span class="count countdown__time daysLeft"></span>
                                                        <span class="value countdown__time daysText"></span>
                                                    </div>
                                                    <div class="single-countdown">
                                                        <span class="count countdown__time hoursLeft"></span>
                                                        <span class="value countdown__time hoursText"></span>
                                                    </div>
                                                    <div class="single-countdown">
                                                        <span class="count countdown__time minsLeft"></span>
                                                        <span class="value countdown__time minsText"></span>
                                                    </div>
                                                    <div class="single-countdown">
                                                        <span class="count countdown__time secsLeft"></span>
                                                        <span class="value countdown__time secsText"></span>
                                                    </div>
                                                </div>
                                            </div>


                                            <a href="{{ url('/shop-grid-left-sidebar', ['key' => ($category_id = 1)]) }}"
                                                class="btn btn-primary btn-hover-dark">Shop Now</a>
                                        </div>
                                        <!-- Countdown Content End -->
                                    </div>

                                    <div class="col-lg-6">
                                        <!-- Countdown Images Start -->
                                        <div class="countdown-images">
                                            <div class="shape-1"></div>
                                            <div class="shape-2"></div>
                                            <div class="shape-3"></div>

                                            <div class="image-box">
                                                <img src="{{ asset('worldcraft/chair-sale.png') }}" alt="Countdown">
                                            </div>
                                        </div>
                                        <!-- Countdown Images End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Countdown Section End -->

                    <!-- Sale Product Section Start -->
                    {{-- <div class="section section-padding-02">
                        <div class="container">
                            <div class="">
                                <!-- Product Wrapper Start -->
                                <div class="product-wrapper product-active-02">
                                    <!-- Product Top Wrapper Start -->
                                    <div class="product-top-wrapper mt-n1">
                                        <!-- Section Title Start -->
                                        <div class="section-title">
                                            <h2 class="title">Sale Products</h2>
                                        </div>
                                        <!-- Section Title End -->

                                        <!-- Product Menu Start -->
                                        <div class="product-menu">
                                            <ul class="nav">
                                                <li><button class="active" data-bs-toggle="tab"
                                                        data-bs-target="#tab7">All Time</button></li>
                                                <li><button data-bs-toggle="tab" data-bs-target="#tab8">This
                                                        Year</button>
                                                </li>
                                                <li><button data-bs-toggle="tab" data-bs-target="#tab9">This
                                                        Month</button></li>
                                            </ul>
                                        </div>
                                        <!-- Product Menu End -->

                                        <!-- Swiper Arrows End -->
                                        <div class="swiper-arrows">
                                            <!-- Add Arrows -->
                                            <div class="swiper-button-prev"><i class="pe-7s-angle-left"></i></div>
                                            <div class="swiper-button-next"><i class="pe-7s-angle-right"></i></div>
                                        </div>
                                        <!-- Swiper Arrows End -->

                                    </div>
                                    <!-- Product Top Wrapper End -->

                                    <!-- Product Tabs Content Start -->
                                    <div class="product-tabs-content">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tab7">
                                                <div class="swiper-container">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <!-- Single Product Start 1-->
                                                            <div class="single-product-02">
                                                                <div class="product-images">
                                                                    <a href="">
                                                                        <img src="{{ asset('/worldcraft/Chairs/tOL0pxpcFhb7TL9Cw4JySrzDHsn2ZyoTTIhrtyEn.png') }}" alt="product">
                                                                    </a>

                                                                    <ul class="product-meta">
                                                                        <li><a class="action" data-bs-toggle="modal"
                                                                                data-bs-target="#quickView"
                                                                                href="#"><i
                                                                                    class="pe-7s-search"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-content">
                                                                    <h4 class="title"><a
                                                                            href="product-details.php">Modern Accent
                                                                            Chair</a></h4>
                                                                    <div class="price">
                                                                        <span class="sale-price">$40.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Single Product End -->
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <!-- Single Product Start 2 -->
                                                            <div class="single-product-02">
                                                                <div class="product-images">
                                                                    <a href="{{ url('product-details') }}">
                                                                        <img src="{{ asset('/worldcraft/Cabinets/dM8yv2wvhFWt6QKzOJT1Q5GWgOXWZNdQ5fLBHX8z.png') }}" alt="product">
                                                                    </a>

                                                                    <ul class="product-meta">
                                                                        <li><a class="action" data-bs-toggle="modal"
                                                                                data-bs-target="#quickView"
                                                                                href="#"><i
                                                                                    class="pe-7s-search"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-shopbag"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-like"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-content">
                                                                    <h4 class="title"><a
                                                                            href="product-details.php">Herman Seater
                                                                            Sofa</a></h4>
                                                                    <div class="price">
                                                                        <span class="sale-price">$40.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Single Product End -->
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <!-- Single Product Start 3 -->
                                                            <div class="single-product-02">
                                                                <div class="product-images">
                                                                    <a href="{{ url('product-details') }}">
                                                                        <img src="{{ asset('/worldcraft/Bubble Wrap/Je4y8XLuXCp6pYZWgRrz76F3fFkFHo4ZHC5d3Qwg.png') }}" alt="product">
                                                                    </a>

                                                                    <ul class="product-meta">
                                                                        <li><a class="action" data-bs-toggle="modal"
                                                                                data-bs-target="#quickView"
                                                                                href="#"><i
                                                                                    class="pe-7s-search"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-shopbag"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-like"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-content">
                                                                    <h4 class="title"><a
                                                                            href="product-details.php">Reece Seater
                                                                            Sofa</a></h4>
                                                                    <div class="price">
                                                                        <span class="sale-price">$40.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Single Product End -->
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <!-- Single Product Start 4 -->
                                                            <div class="single-product-02">
                                                                <div class="product-images">
                                                                    <a href="{{ url('product-details') }}">
                                                                        <img src="{{ asset('worldcraft/Racks/SotYKdqsj3RKnSBAmHkfuSY3dngL5uO34yMZesgy.png') }}" alt="product">
                                                                    </a>

                                                                    <ul class="product-meta">
                                                                        <li><a class="action" data-bs-toggle="modal"
                                                                                data-bs-target="#quickView"
                                                                                href="#"><i
                                                                                    class="pe-7s-search"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-shopbag"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-like"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-content">
                                                                    <h4 class="title"><a
                                                                            href="product-details.php">Round Swivel
                                                                            Chair</a></h4>
                                                                    <div class="price">
                                                                        <span class="sale-price">$40.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Single Product End -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab8">
                                                <div class="swiper-container">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <!-- Single Product Start 5-->
                                                            <div class="single-product-02">
                                                                <div class="product-images">
                                                                    <a href="{{ url('product-details') }}">
                                                                        <img src="{{ asset('/images/product/product-12.jpg') }}" alt="product">
                                                                    </a>

                                                                    <ul class="product-meta">
                                                                        <li><a class="action" data-bs-toggle="modal"
                                                                                data-bs-target="#quickView"
                                                                                href="#"><i
                                                                                    class="pe-7s-search"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-shopbag"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-like"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-content">
                                                                    <h4 class="title"><a
                                                                            href="product-details.php">Modern Accent
                                                                            Chair</a></h4>
                                                                    <div class="price">
                                                                        <span class="sale-price">$40.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Single Product End -->
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <!-- Single Product Start 2-->
                                                            <div class="single-product-02">
                                                                <div class="product-images">
                                                                    <a href="{{ url('product-details') }}">
                                                                        <img src="{{ asset('/images/product/product-05.jpg') }}" alt="product">
                                                                    </a>

                                                                    <ul class="product-meta">
                                                                        <li><a class="action" data-bs-toggle="modal"
                                                                                data-bs-target="#quickView"
                                                                                href="#"><i
                                                                                    class="pe-7s-search"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-shopbag"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-like"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-content">
                                                                    <h4 class="title"><a
                                                                            href="product-details.php">Living & Bedroom
                                                                            Chair</a></h4>
                                                                    <div class="price">
                                                                        <span class="sale-price">$40.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Single Product End -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab9">
                                                <div class="swiper-container">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <!-- Single Product Start 1-->
                                                            <div class="single-product-02">
                                                                <div class="product-images">
                                                                    <a href="{{ url('product-details') }}">
                                                                        <img src="{{ asset('/images/product/product-04.jpg') }}" alt="product">
                                                                    </a>

                                                                    <ul class="product-meta">
                                                                        <li><a class="action" data-bs-toggle="modal"
                                                                                data-bs-target="#quickView"
                                                                                href="#"><i
                                                                                    class="pe-7s-search"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-shopbag"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-like"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-content">
                                                                    <h4 class="title"><a
                                                                            href="product-details.php">High quality vase
                                                                            bottle</a></h4>
                                                                    <div class="price">
                                                                        <span class="sale-price">$40.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Single Product End -->
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <!-- Single Product Start 2-->
                                                            <div class="single-product-02">
                                                                <div class="product-images">
                                                                    <a href="{{ url('product-details') }}">
                                                                        <img src="{{ asset('/images/product/product-03.jpg') }}" alt="product">
                                                                    </a>

                                                                    <ul class="product-meta">
                                                                        <li><a class="action" data-bs-toggle="modal"
                                                                                data-bs-target="#quickView"
                                                                                href="#"><i
                                                                                    class="pe-7s-search"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-shopbag"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-like"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-content">
                                                                    <h4 class="title"><a
                                                                            href="product-details.php">Pendant Chandelier
                                                                            Light</a></h4>
                                                                    <div class="price">
                                                                        <span class="sale-price">$40.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Single Product End -->
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <!-- Single Product Start 3-->
                                                            <div class="single-product-02">
                                                                <div class="product-images">
                                                                    <a href="{{ url('product-details') }}">
                                                                        <img src="{{ asset('/images/product/product-02.jpg') }}" alt="product">
                                                                    </a>

                                                                    <ul class="product-meta">
                                                                        <li><a class="action" data-bs-toggle="modal"
                                                                                data-bs-target="#quickView"
                                                                                href="#"><i
                                                                                    class="pe-7s-search"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-shopbag"></i></a></li>
                                                                        <li><a class="action" href="#"><i
                                                                                    class="pe-7s-like"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-content">
                                                                    <h4 class="title"><a
                                                                            href="product-details.php">Simple minimal
                                                                            Chair</a></h4>
                                                                    <div class="price">
                                                                        <span class="sale-price">$40.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Single Product End -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product Tabs Content End -->
                                </div>
                                <!-- Product Wrapper End -->
                            </div>
                        </div>
                    </div> --}}
                    <!-- Sale Product Section End -->


                </div>
            </div>
            <br><br><br>
        </div>
        <!-- Benefit Section End -->

        <script>
            function updateCountdown() {
                const countdownDate = new Date("{{ $countdownDate }}").getTime();
                const now = new Date().getTime();
                const distance = countdownDate - now;

                // Calculate time components
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Update the HTML elements
                document.querySelector('.daysLeft').textContent = days;
                document.querySelector('.hoursLeft').textContent = hours;
                document.querySelector('.minsLeft').textContent = minutes;
                document.querySelector('.secsLeft').textContent = seconds;

                // Check if the countdown is finished
                if (distance < 0) {
                    clearInterval(interval);
                    document.querySelector('.countdown').innerHTML = "Countdown Finished";
                }
            }

            // Update the countdown every second
            const interval = setInterval(updateCountdown, 1000);
        </script>
    @endsection
