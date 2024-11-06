@extends('master')
@section('index')
    <!-- Page Banner Section Start -->
    <div class="section page-banner-section m-0 p-0" style="background-color: #FAEDCE;">
        <h2 class="title ms-5" style="color: black;">Register Account</h2>
    </div>

    <!-- Register Section Start -->
    <div class="section section-padding mt-n1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <!-- Login & Register Start -->
                    <div class="login-register-wrapper">
                        <h4 class="title">Create New Account</h4>
                        <p>Already have an account? <a href="{{ route('sign.in') }}">Log in instead!</a></p>
                        <form id="registration_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="single-form">
                                <input type="text" placeholder="First Name *" name="firstname" id="firstname" style="font-style: normal !important" required>
                            </div>
                            <div class="single-form">
                                <input type="text" placeholder="Last Name *" name="lastname" id="lastname" style="font-style: normal !important" required>
                            </div>
                            <div class="single-form">
                                <input type="text" placeholder="TIN ID *" name="tin_id" id="tin_id" style="font-style: normal !important" required>
                            </div>
                            <div class="single-form">
                                <input type="text" placeholder="Username/Email *" name="username" style="font-style: normal !important" id="username"
                                    required>
                            </div>
                            <div class="single-form">
                                <input type="password" placeholder="Password *" name="password" id="password" style="font-style: normal !important" required>
                            </div>
                            <div class="single-form">
                                <input type="password" placeholder="Confirm Password *" name="confirm_password"
                                    id="confirm_password" style="font-style: normal !important" required>
                            </div>
                            <div class="single-form">
                                <button type="submit" class="btn btn-dark btn-hover-dark">Register</button>
                            </div>
                        </form>
                    </div>
                    <p id="error_message" style="color:red;"></p>
                    <!-- Login & Register End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Register Section End -->


    <script src="{{ asset('/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#registration_form').on('submit', function(e) {
                e.preventDefault();
                const data = $(this).serializeArray();

                // validation
                const password = document.getElementById('password').value;
                const confirm_pass = document.getElementById('confirm_password').value;
                const errorMessage = document.getElementById('error_message');

                if (password != confirm_pass) {
                    alert('Password not match!');
                } else {
                    $.ajax({
                        url: "{{ route('insert.user') }}",
                        type: "POST",
                        data: data,
                        success: function(response) {
                            alert('User successfully added!');
                        }
                    });
                }

            });
        });
    </script>
@endsection
