@extends('master')

@section('about')

    <body>
        <div class="menu-overlay"></div>
        <!-- Page Banner Section Start -->
        <div class="section page-banner-section" style="background-color: #FAEDCE;">
            <div class="container">

                <!-- Page Banner Content End -->
                <div class="page-banner-content">
                    <h2 class="title" style="color: black;">About Us</h2>
                </div>
                <!-- Page Banner Content End -->

            </div>
        </div>
        <!-- Page Banner Section End -->

        <!-- History Section Start -->
        <div class="section section-padding-02">
            <div class="container">

                <!-- History content End -->
                <div class="history-content text-center">

                    <div class="section-title-03">
                        <h6 class="sub-title">History</h6>
                        <h2 class="title">Worldcraft Furniture</h2>
                    </div>

                    <p>Lorem ipsum dolor sit amet, consectet adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nullaotho pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                        culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natusxcl
                        error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo
                        inventore veritatis et quasi architecto beatae vitae dictapteo sunt explicabo. Nemo enim ipsam
                        voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos
                        qui ratione voluptatem drt sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor
                        sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                        dolore magnam aliquam quaerat voluptatem.</p>

                </div>
                <!-- History content End -->

                <div class="history-icon text-center">
                    <img src="{{ asset('/images/icon/icon-5.jpg') }}" alt="Icon">
                </div>

            </div>
        </div>
        <!-- History Section End -->

        <!-- Images Gallery Section Start -->
        <div class="section section-padding-02 mt-n6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Image Gallery Start -->
                        <div class="image-gallery">
                            <img src="{{ asset('/worldcraft/about770x290.png') }}" alt="gallery">
                        </div>
                        <!-- Image Gallery End -->
                    </div>
                    <div class="col-lg-4">
                        <!-- Image Gallery Start -->
                        <div class="image-gallery">
                            <img src="{{ asset('/worldcraft/about370x290.png') }}" alt="gallery">
                        </div>
                        <!-- Image Gallery End -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Image Gallery Start -->
                        <div class="image-gallery">
                            <img src="{{ asset('/worldcraft/about570x290.png') }}" alt="gallery">
                        </div>
                        <!-- Image Gallery End -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Image Gallery Start -->
                        <div class="image-gallery">
                            <img src="{{ asset('/worldcraft/about570x290-1.png') }}" alt="gallery">
                        </div>
                        <!-- Image Gallery End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Images Gallery Section End -->

        <!-- Counter Section Start -->
        <div class="section section-padding mt-n6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- Single Counter Start -->
                        <div class="single-counter">
                            <span class="count"><span class="odometer" data-count-to="21"></span><sub>+</sub></span>
                            <p> Years of Exprience</p>
                        </div>
                        <!-- Single Counter End -->
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- Single Counter Start -->
                        <div class="single-counter">
                            <span class="count"><span class="odometer" data-count-to="30"></span><sub>K</sub></span>
                            <p>Happy Customers</p>
                        </div>
                        <!-- Single Counter End -->
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- Single Counter Start -->
                        <div class="single-counter">
                            <span class="count"><span class="odometer" data-count-to="15"></span><sub>+</sub></span>
                            <p>Award Winner</p>
                        </div>
                        <!-- Single Counter End -->
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- Single Counter Start -->
                        <div class="single-counter">
                            <span class="count"><span class="odometer" data-count-to="100"></span><sub>%</sub></span>
                            <p>Products Guranteed</p>
                        </div>
                        <!-- Single Counter End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Counter Section End -->

        <!-- Brand Logo Section Start -->
        {{-- <div class="section section-padding mt-n2">
            <div class="container">
                <div class="brand-row">

                    <div class="brand-col">
                        <!-- Single Brand Start -->
                        <div class="single-brand">
                            <img src="assets/images/brand/brand-1.png" alt="brand">
                        </div>
                        <!-- Single Brand Start -->
                    </div>

                    <div class="brand-col">
                        <!-- Single Brand Start -->
                        <div class="single-brand">
                            <img src="assets/images/brand/brand-2.png" alt="brand">
                        </div>
                        <!-- Single Brand Start -->
                    </div>

                    <div class="brand-col">
                        <!-- Single Brand Start -->
                        <div class="single-brand">
                            <img src="assets/images/brand/brand-3.png" alt="brand">
                        </div>
                        <!-- Single Brand Start -->
                    </div>

                    <div class="brand-col">
                        <!-- Single Brand Start -->
                        <div class="single-brand">
                            <img src="assets/images/brand/brand-4.png" alt="brand">
                        </div>
                        <!-- Single Brand Start -->
                    </div>

                    <div class="brand-col">
                        <!-- Single Brand Start -->
                        <div class="single-brand">
                            <img src="assets/images/brand/brand-5.png" alt="brand">
                        </div>
                        <!-- Single Brand Start -->
                    </div>

                </div>
            </div>
        </div> --}}
        <!-- Brand Logo Section End -->

        <!-- Footer Section Start -->
        <?php // include 'footer.php'; ?>
        <!-- Footer Section End -->

        <!--Back To Start-->
        <a href="#" class="back-to-top">
            <i class="pe-7s-angle-up"></i>
        </a>
        <!--Back To End-->

    </body>
@endsection
