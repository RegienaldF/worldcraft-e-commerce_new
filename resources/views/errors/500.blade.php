@extends('master')
@section('index')
    <div class="section section-padding">
        <div class="container">
            <div class="cart-wrapper">
                <!-- empty cart Start -->
                <div class="empty-cart text-center">
                    <h2 class="empty-cart-title">SOMETHING WENT WRONG</h2>
                    <div class="empty-cart-img">
                        <img src="{{ asset('/worldcraft/icons/error.png') }}" alt="Error Code">
                    </div>
                    {{-- <p>Oops. Page not found! The page you are looking for is not available. <br> Error Code: 500</p> --}}
                    <p>Sorry for the inconvenience, but we're working on it. <br> Error Code: 500</p>
                    {{-- <a href="{{ route('index') }}" class="btn btn-primary btn-hover-dark"><i class="fa fa-angle-left"></i>Continue browsing</a> --}}
                </div>
                <!-- empty cart End -->
            </div>
        </div>
    </div>
@endsection
