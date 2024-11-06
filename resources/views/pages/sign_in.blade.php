@extends('master')
@section('index')
    <!-- Page Banner Section Start -->
    <div class="section page-banner-section m-0 p-0" style="background-color: #FAEDCE;">
        <h2 class="title ms-5" style="color: black;">Login Account</h2>
    </div>

    <!-- Login Section Start -->
    <div class="section section-padding mt-n1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <!-- Login & Register Start -->
                    <div class="login-register-wrapper">
                        <h4 class="title">Login to Your Account</h4>
                        <form action="{{ route('login.user') }}" method="POST">
                            @csrf
                            <div class="single-form">
                                <input type="text" name="email" placeholder="Username or email *" style="font-style: normal !important" required>
                            </div>
                            <div class="single-form">
                                <input type="password" name="password" placeholder="Password" style="font-style: normal !important" required>
                            </div>
                            <div class="single-form">
                                <button class="btn btn-dark btn-hover-dark" type="submit">Login</button>
                            </div>
                        </form>
                        <p>No account? <a href="{{ route('register') }}">Create one here.</a></p>
                    </div>
                    <!-- Login & Register End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Login Section End -->
@endsection
