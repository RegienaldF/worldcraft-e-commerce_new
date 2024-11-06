@extends('master')
@section('contact')

    <body>
        <div class="menu-overlay"></div>

        <!-- Page Banner Section Start -->
        <div class="section page-banner-section" style="background-color: #FAEDCE;">
            <div class="container">

                <!-- Page Banner Content End -->
                <div class="page-banner-content">
                    <h2 class="title" style="color: black;">Contact Us</h2>
                </div>
                <!-- Page Banner Content End -->

            </div>
        </div>
        <!-- Page Banner Section End -->

        <!-- Contact Section Start -->
        <div class="section section-padding">
            <div class="container">

                <!-- Contact Wrapper Start -->
                <div class="contact-wrapper">
                    <div class="row gx-0">
                        <div class="col-lg-4">
                            <div class="contact-info">
                                <h2 class="title">Contact Info</h2>
                                <p>For more Information kinly contact us at:</p>

                                <!-- Contact Info Items Start -->
                                <div class="contact-info-items">

                                    <div class="single-contact-info">
                                        <div class="info-icon">
                                            <i class="pe-7s-call"></i>
                                        </div>
                                        <div class="info-content">
                                            <p><a href="tel: +63289299911">+63 2 8929 9911</a></p>
                                        </div>
                                    </div>

                                    <div class="single-contact-info">
                                        <div class="info-icon">
                                            <i class="pe-7s-mail"></i>
                                        </div>
                                        <div class="info-content">
                                            <p><a href="mailto:worldcraftph@gmail.com">worldcraftph@gmail.com</a></p>
                                        </div>
                                    </div>

                                    <div class="single-contact-info">
                                        <div class="info-icon">
                                            <i class="pe-7s-map-marker"></i>
                                        </div>
                                        <div class="info-content">
                                            <p>827 Calderon Building, Barangay South Triangle, EDSA, Quezon City, 1103 Metro
                                                Manila</p>
                                        </div>
                                    </div>

                                </div>
                                <!-- Contact Info Items End -->
                                <img src="{{ asset('/worldcraft/contact-us-banner.png') }}" alt="Contact-info">

                            </div>
                        </div>
                        <div class="col-lg-8">

                            <!-- Contact Form Start  -->
                            <div class="contact-form">
                                <form id="contact-form" action="assets/php/contact.php" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="single-form">
                                                <input type="text" name="name" placeholder="Name*">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form">
                                                <input type="email" name="email" placeholder="Email*">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form">
                                                <input type="text" name="subject" placeholder="Subject">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form">
                                                <input type="text" name="phone" placeholder="Phone No">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="single-form">
                                                <textarea name="message" placeholder="Write your comments here"></textarea>
                                            </div>
                                        </div>
                                        <p class="form-message"></p>
                                        <div class="col-md-12">
                                            <div class="single-form">
                                                <button type="submit" class="btn btn-dark btn-hover-primary">Submit
                                                    Review</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Contact Form End  -->

                        </div>
                    </div>
                </div>
                <!-- Contact Wrapper End -->

            </div>
        </div>
        <!-- Contact Section End -->

        <!-- Contact Map Start -->
        <div class="contact-map">
            <iframe id="gmap_canvas"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.3059218055937!2d121.0382062759046!3d14.638567876144384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b7a935318e1f%3A0xbc9ef41da9f3d87b!2sFilipinas%20Multi-Line%20Corp.!5e0!3m2!1sen!2sph!4v1721010527370!5m2!1sen!2sph"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- Contact Map End -->

        <!--Back To Start-->
        <a href="#" class="back-to-top">
            <i class="pe-7s-angle-up"></i>
        </a>
        <!--Back To End-->
    </body>
@endsection
