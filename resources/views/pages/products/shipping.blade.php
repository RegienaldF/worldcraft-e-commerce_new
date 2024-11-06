@extends('master')
@section('links')
    <style>
        .service-item {
            cursor: pointer;
            background-color: #F2F5FA;
            border: 1px solid #C2CBD7;
            border-radius: 5px;
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 21px;
            padding: 13px 18px;
        }

        .service-item-active {
            border: #1B1464 2px solid;
            box-sizing: border-box;
            background: #fff;
        }

        .service-item-active::after {
            content: '';
            width: 19px;
            height: 19px;
            top: -5px;
            right: -10px;
            background-repeat: no-repeat;
            position: absolute;
            display: inline-block;
            z-index: 50;
        }
    </style>
@endsection
@section('index')
    <section class="pt-5 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7 mx-auto">
                    <div class="row gutters-5 text-center aiz-steps">
                        <div class="col active done">
                            <div class="icon bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                </svg>
                            </div>
                            <div class="title fs-12">My Cart</div>
                        </div>

                        <div class="col active done">
                            <div class="icon bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-truck" viewBox="0 0 16 16">
                                    <path
                                        d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                                </svg>
                            </div>
                            <div class="title fs-12">Shipping</div>

                        </div>

                        <div class="col">
                            <div class="icon">
                                <svg width="20" height="20" viewBox="0 0 20 20" class="filter-black" fill="#none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.6667 3.33334H3.33341C2.40841 3.33334 1.67508 4.075 1.67508 5L1.66675 15C1.66675 15.925 2.40841 16.6667 3.33341 16.6667H16.6667C17.5917 16.6667 18.3334 15.925 18.3334 15V5C18.3334 4.075 17.5917 3.33334 16.6667 3.33334ZM16.6667 15H3.33341V10H16.6667V15ZM3.33341 6.66667H16.6667V5H3.33341V6.66667Z"
                                        fill="black"></path>
                                </svg>

                            </div>
                            <div class="title fs-12">
                                Payment
                            </div>
                        </div>
                        <div class="col">
                            <div class="icon">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.00008 0.666656C4.40008 0.666656 0.666748 4.39999 0.666748 8.99999C0.666748 13.6 4.40008 17.3333 9.00008 17.3333C13.6001 17.3333 17.3334 13.6 17.3334 8.99999C17.3334 4.39999 13.6001 0.666656 9.00008 0.666656ZM9.00008 15.6667C5.32508 15.6667 2.33341 12.675 2.33341 8.99999C2.33341 5.32499 5.32508 2.33332 9.00008 2.33332C12.6751 2.33332 15.6667 5.32499 15.6667 8.99999C15.6667 12.675 12.6751 15.6667 9.00008 15.6667ZM7.33341 10.8083L12.8251 5.31666L14.0001 6.49999L7.33341 13.1667L4.00008 9.83332L5.17508 8.65832L7.33341 10.8083Z"
                                        fill="black"></path>
                                </svg>
                            </div>
                            <div class="title fs-12">Confirmation</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4 gry-bg">
        <div class="container">
            @php
                $user_address = \App\Models\DeliveryAddress::where('user_id', Auth::user()->id)->get();
            @endphp
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-xxl-8 col-xl-10 mx-auto">
                    @if (count($user_address) > 0)
                        @php
                            $customer_address = Session::get('delivery_address');
                        @endphp

                        {{-- @if (\App\OtpConfiguration::where('type', 'otp_for_order')->first()->value == 1 && \App\OtpConfiguration::where('type', 'otp_for_paid_status')->first()->value == 1 && \App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value == 1)
                        @if (format_phone_number($customer_address['phone']) == '' || format_phone_number($customer_address['phone']) == null)
                            <div role="alert" class="mb-3">
                                <div class="p-2 bg-primary text-white rounded-top">REMINDER:</div>
                                <div class="p-2 bg-white d-flex align-items-center rounded-bottom" style="font-size: 14px">
                                    <div style="max-width: 2em; width: 100%; font-size: 1rem" class="d-flex justify-content-center">
                                        <i class="las la-exclamation-circle mx-auto"></i>
                                    </div>
                                    <div class="my-auto" style="font-size: 0.9rem">
                                        <div>To ensure you receive SMS notifications, we recommend updating your phone number in the Shipping or Home Address.</div>
                                        <div class="mt-1">Please use <span style="font-weight: 600;color: #5c5c5c;">09xx-xxx-xxxx</span> for the format.</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif --}}
                    @endif
                    <form class="form-default" data-toggle="validator"
                        action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                        @csrf
                        <input type="hidden" name="checkout_type" value="logged">

                        {{-- SHIPPING ADDRESS --}}
                        <div class="card shadow-none border-0">
                            <div class="card-body shadow p-3 mb-5 bg-body rounded">
                                <div class="d-flex justify-content-start border-bottom">
                                    <div class="card-customer-wallet-title">
                                        Shipping / Home Address
                                    </div>
                                </div>
                                <div class="mt-2 d-flex justify-content-between align-items-center gap-2 flex-wrap">
                                    @if (count($user_address) > 0)
                                        @php
                                            $customer_address = Session::get('delivery_address');
                                        @endphp

                                        <div class="address_container">
                                            <div id="customer_name" class="fs-16 fw-600 text-uppercase">
                                                {{ $customer_address['name'] }}
                                            </div>
                                            <div id="customer_phone" class="fw-600">
                                                {{ $customer_address['phone'] }}
                                            </div>
                                            <div id="customer_address">
                                                {{ $customer_address['address'] }}, {{ $customer_address['brgy_code'] }},
                                                {{ $customer_address['city_code'] }},
                                                {{ $customer_address['province_code'] }}
                                                {{ $customer_address['postal_code'] }}
                                            </div>
                                        </div>
                                    @else
                                        <div></div>
                                    @endif
                                    <div>

                                        <a class="link-blue" href="#" id="changeAddress" style="color: #1B1464">
                                            <strong>Change</strong>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php
                            $allow_service = '';
                            $pup_selected = Session::get('session_cart')[0]['pickup_location'];
                            if (
                                $pup_selected == 'edsa' ||
                                $pup_selected == 'baesa_warehouse' ||
                                $pup_selected == 'maw' ||
                                $pup_selected == 'balintawak_warehouse'
                            ) {
                                $allow_service = '';
                                // if(env('APP_ENV') != 'production') {
                                //     $allow_service = '';
                                // }
                            }
                        @endphp
                        {{-- SERVICES --}}
                        <div class="card shadow-none border-0 {{ $allow_service }}">
                            <div class="card-body shadow p-3 mb-5 bg-body rounded">
                                <div class="d-flex justify-content-start border-bottom">
                                    <div class="card-customer-wallet-title">
                                        Services
                                    </div>
                                </div>
                                <div class="mt-2 container">
                                    <div class="row">
                                        <div class="service-item col-12 ml-0 mb-2"
                                            onclick="toggleService('in_store_pickup','0.00')" id="in_store_pickup">
                                            <div class="row align-items-center">
                                                <div class="col-9">
                                                    <h6><strong>In Store Pickup</strong></h6>
                                                    {{-- <small>&nbsp;</small> --}}
                                                    <small>Pickup Point:
                                                        {{ ucwords(str_replace('_', ' ', Session::get('session_cart')[0]['pickup_location'])) }}</small>
                                                </div>
                                                <div class="col-3">
                                                    <h6 class="text-right">
                                                        <strong>₱0</strong>
                                                        </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="service-item col-12 ml-0 mb-2" id="in_house_delivery"
                                            @if (Session::has('delivery_address') && Session::get('delivery_address')['region_number'] != 13) style="color: #bbbec36b; border: 1px solid #ebebeb"
                                            onclick="unavailableService()"
                                        @else
                                            onclick="toggleService('in_house_delivery','900.00')" @endif>
                                            <div class="row align-items-center">
                                                <div class="col-9">
                                                    <h6><strong>In House Delivery</strong></h6>
                                                    <small>Delivered within 3-5 working days (Order up to a weight of 1,000
                                                        kg.)</small>
                                                </div>
                                                <div class="col-3">
                                                    <h6 class="text-right">
                                                        <strong>₱900</strong>
                                                        </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="service-item col-12 ml-0 mb-2 d-none"
                                            onclick="toggleService('third_party','0.00')" id="third_party">
                                            <div class="row align-items-center">
                                                <div class="col-9">
                                                    <h6><strong>3rd Party Logistics</strong></h6>
                                                    <small>Book your own provider</small>
                                                </div>
                                                <div class="col-3">
                                                    <h6 class="text-right">
                                                        <strong>₱0</strong>
                                                        </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Form SUBMISSION --}}
                        <div class="row align-items-center mb-5">
                            <div class="col-xxl-12 col-xl-12 d-flex mt-4">
                                <div class="col-xxl-6 col-xl-6 d-flex justify-content-start pl-0">
                                    <a href="{{ route('cart.index') }}" class="link-back-cart d-flex align-items-center">
                                        <svg class="mr-2" width="19" height="20" viewBox="0 0 19 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.625 9.20833H5.40708L8.24125 6.36625L7.125 5.25L2.375 10L7.125 14.75L8.24125 13.6337L5.40708 10.7917H16.625V9.20833Z"
                                                fill="#62616A" />
                                        </svg>
                                        Back to Cart
                                    </a>
                                </div>
                                <div class="col-xxl-6 col-xl-6 d-flex justify-content-end pr-0">
                                    <button type="submit" class="btn btn-primary p-2" id="submitBtn" disabled>
                                        Continue to Payment
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modal')
    <div class="modal" id="addDeliveryAddress">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="p-1">
                        <h6 class="fw-600">Add Shipping Address</h6>
                        <hr>
                        {{-- <p>
                            Please enter an address when placing an order.
                        </p> --}}
                        {{-- <form action="{{ route('delivery-address.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="is_default" value="1">
                            <div class="row mb-1">
                                <div class="col-6">
                                    <label for="" class="form-control-label">{{ translate("Full Name / Recipient's Name") }}</label>
                                    <input type="text" class="form-control" name="full_name"
                                        placeholder="Full Name" oninput="validateInput(this)" required
                                        value="{{ Auth::user()->name }}" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-control-label">{{ translate('Phone') }}
                                        <small>(09XX-XXXX-XXXX)</small></label>
                                    <input type="text" class="form-control form-craft" name="phone"
                                        placeholder="Phone" required>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-6">
                                    <label for="" class="form-control-label">{{ translate('Region') }}</label>
                                    <select class="form-control aiz-selectpicker" data-live-search="true"
                                        name="region_code" id="region_code" required>
                                        <option value="" hidden selected>Select region...</option>
                                        @foreach (\App\Models\PhRegion::get() as $region)
                                            <option value="{{ $region->regCode }}">{{ $region->regDesc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-control-label">{{ translate('Province') }}</label>
                                    <select class="form-control aiz-selectpicker" data-live-search="true"
                                        name="province_code" id="province_code" required>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-6">
                                    <label for="" class="form-control-label">{{ translate('City') }}</label>
                                    <select class="form-control aiz-selectpicker" data-live-search="true"
                                        name="city_code" id="city_code" required>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-control-label">{{ translate('Barangay') }}</label>
                                    <select class="form-control aiz-selectpicker" data-live-search="true"
                                        name="brgy_code" id="brgy_code" required>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-12">
                                    <label for=""
                                        class="form-control-label">{{ translate('House No. / Street / Bldg.') }}</label>
                                    <input name="street" class="form-control form-craft" required />
                                </div>
                                <div class="col-12">
                                    <label for=""
                                        class="form-control-label">{{ translate('Postal Code') }}</label>
                                    <input type="text" class="form-control form-craft" name="postal_code"
                                        placeholder="Postal Code" required>
                                </div>
                            </div>
                            @if (count($user_address) > 0)
                                <div class="row mb-0 mt-3">
                                    <div class="col-12">
                                        <div class="form-craft-check d-flex justify-content-left">
                                            <input type="checkbox" id="set-as-default">
                                            <label for="set-as-default"
                                                class="text-subprimary ml-3 ">{{ translate('Set as default') }}</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between flex-wrap mt-0">
                                @if (count($user_address) > 0)
                                    <button type="button" class="btn fw-600 cart-mobile-ui mt-3"
                                        id="cancelAddingAddress">Cancel</button>
                                @else
                                    <a href="{{ route('cart') }}" class="btn fw-600 cart-mobile-ui mt-3">Cancel</a>
                                @endif
                                <button type="submit" class="btn btn-primary fw-600 cart-mobile-ui mt-3">Submit</button>
                            </div>
                        </form> --}}
                        <form action="{{ route('delivery-address.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="is_default" value="1">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="full_name" class="form-label">{{ translate("Full Name / Recipient's Name") }}</label>
                                    <input type="text" class="form-control border border-dark p-2" name="full_name" id="full_name"
                                        placeholder="Full Name" oninput="validateInput(this)" required
                                        value="{{ Auth::user()->name }}" style="font-size: 15px !important; color: black !important;" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">{{ translate('Phone') }}
                                        <small>(09XX-XXXX-XXXX)</small>
                                    </label>
                                    <input type="text" class="form-control border border-dark p-2" name="phone" id="phone" placeholder="Phone" style="font-size: 15px !important; color: black !important;" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="region_code" class="form-label">{{ translate('Region') }}</label>
                                    <select class="form-select border border-dark p-2" name="region_code" id="region_code" style="font-size: 15px !important; color: black !important;" required>
                                        <option value="" hidden selected>Select region...</option>
                                        @foreach (\App\Models\PhRegion::get() as $region)
                                            <option value="{{ $region->regCode }}">{{ $region->regDesc }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="province_code" class="form-label">{{ translate('Province') }}</label>
                                    <select class="form-select border border-dark p-2" name="province_code" id="province_code" style="font-size: 15px !important; color: black !important;" required>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="city_code" class="form-label">{{ translate('City') }}</label>
                                    <select class="form-select border border-dark p-2" name="city_code" id="city_code" style="font-size: 15px !important; color: black !important;" required>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="brgy_code" class="form-label">{{ translate('Barangay') }}</label>
                                    <select class="form-select border border-dark p-2" name="brgy_code" id="brgy_code" style="font-size: 15px !important; color: black !important;" required>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="street" class="form-label">{{ translate('House No. / Street / Bldg.') }}</label>
                                    <input name="street" class="form-control border border-dark p-2" id="street" style="font-size: 15px !important; color: black !important;" required />
                                </div>
                                <div class="col-12">
                                    <label for="postal_code" class="form-label">{{ translate('Postal Code') }}</label>
                                    <input type="text" class="form-control border border-dark p-2" name="postal_code" id="postal_code"
                                        placeholder="Postal Code" style="font-size: 15px !important; color: black !important;" required>
                                </div>
                            </div>

                            @if (count($user_address) > 0)
                                <div class="row mb-3 mt-3">
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="set-as-default" style="font-size: 15px !important; color: black !important;">
                                            <label for="set-as-default" class="form-check-label text-subprimary">
                                                {{ translate('Set as default') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="d-flex justify-content-between flex-wrap mt-3">
                                @if (count($user_address) > 0)
                                    <button type="button" class="btn btn-outline-secondary fw-600 cart-mobile-ui" id="cancelAddingAddress" style="font-size: 15px !important; color: black !important;">Cancel</button>
                                @else
                                    <a href="{{ route('cart') }}" class="btn btn-outline-secondary fw-600 cart-mobile-ui" style="font-size: 15px !important; color: rgb(255, 255, 255) !important;">Cancel</a>
                                @endif
                                <button type="submit" class="btn btn-dark p-2 fw-600 cart-mobile-ui" style="font-size: 15px !important; color: rgb(255, 255, 255) !important;">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="changeShippingAddress">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('change-selected-shipping-address') }}" method="POST">
                    @csrf
                    <div class="modal-header align-items-center">
                        <div class="fs-16 fw-600">My Shipping Address</div>
                    </div>
                    <div class="modal-body">
                        <div class="card shadow mb-5 bg-body-tertiary rounded">
                            <div class="card-body">
                                <input type="hidden" id="delivery_address_id" value="0">
                                <div class="p-1" id="addressContainer">

                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-dark p-2" id="add_new_address">Add Address</button>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="editShippingAddress">
        <div class="modal-dialog">
            <form id="edit_my_shipping_address">
                <div class="modal-content">
                    <div class="modal-header align-items-center">
                        <div class="fs-16 fw-600">Edit Shipping Address</div>
                    </div>
                    <div class="modal-body">
                        <div class="p-1" id="editAddressContainer">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-default" id="cancel_edit_address">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        setTimeout(() => {
            @php
                $allow_service = 1;
            @endphp
            var allow_service = '{{ $allow_service }}';
            if (allow_service == 'd-none') {
                toggleService('in_store_pickup', '0.00');
            }
        }, 100);

        var user_address_count = '{{ count($user_address) }}';
        var delivery_id = 0;
        if (user_address_count <= 0) {
            $('#addDeliveryAddress').modal({
                backdrop: 'static',
                keyboard: false
            }, 'show');
        }

        $('#set-as-default').on('change', function() {
            if ($(this).is(':checked')) {
                $('input[name="is_default"]').val('1');
            } else {
                $('input[name="is_default"]').val('0');
            }
        })


        $(document).ready(function() {

            @if (Session::has('new_added_delivery'))
                $('#changeAddress').trigger('click');
            @endif
        })
        $('#changeAddress').on('click', function() {
            @if (Session::has('delivery_address'))
                $('#delivery_address_id').val('{{ Session::get('delivery_address')['id'] }}')
            @endif

            $('#add_new_address').hide();
            $('#addressContainer').html(
                '<div class="c-preloader text-center p-3"><i class="las la-spinner la-spin la-3x"></i></div>');

            $('#changeShippingAddress').modal({
                backdrop: 'static',
                keyboard: false
            }).modal('show');
            $.ajax({
                type: 'GET',
                url: '{{ route('checkout.get.shipping-address') }}',
                data: {
                    'user_id': '{{ auth()->user()->id }}'
                },
                success: function(response) {
                    $('#addressContainer').html(response);
                    $('#add_new_address').show();
                }
            })
            return false;
        })
        $('#add_new_address').on('click', function() {
            $('#changeShippingAddress').modal('hide');
            $('#addDeliveryAddress input[name="is_default"]').val('0');
            $('#set-as-default').prop({
                'checked': false
            })
            $('#addDeliveryAddress').modal({
                backdrop: 'static',
                keyboard: false
            }).modal('show');
        });
        $('#cancelAddingAddress').on('click', function() {
            // $('#changeShippingAddress').css('display', 'block')
            $('#changeShippingAddress').modal('show');
            $('#addDeliveryAddress').modal('hide');
        })

        function updateShippingAddress(del_id) {
            delivery_id = del_id;
            $('#delivery_address_id').val(del_id);
        }

        function unavailableService() {
            AIZ.plugins.notify('info', 'This service is available within Metro Manila.');
        }

        @if (Session::has('service'))
            service_type_selected = '{{ Session::get('service')['service_type'] }}';
            service_charges = '{{ Session::get('service')['service_fee'] }}';
            toggleService(service_type_selected, service_charges)
        @endif

        function editAddress(id) {
            $('#edit_my_shipping_address button:submit').prop('disabled', true)
            // $('#changeShippingAddress').css('display', 'none')
            $('#changeShippingAddress').modal('hide');
            $('#editAddressContainer').html(
                '<div class="c-preloader text-center p-3"><i class="las la-spinner la-spin la-3x"></i></div>');
            $('#edit_my_shipping_address button:submit').html('Save');

            $.ajax({
                type: 'GET',
                url: '{{ route('view.shipping.address') }}',
                data: {
                    'delivery_id': id
                },
                success: function(response) {
                    $('#editAddressContainer').html(response);
                },
                error: function(err) {
                    $('#editAddressContainer').html('Something went wrong.');
                }
            })

            $('#editShippingAddress').modal({
                backdrop: 'static',
                keyboard: false
            }).modal('show');

            setTimeout(() => {}, 3000);
        }
        $('#cancel_edit_address').on('click', function() {
            $('#editShippingAddress').modal('hide');
            $('#changeShippingAddress').modal('show');
            // $('#changeShippingAddress').css('display', 'block');
        })

        function toggleService(service_selected, charges) {

            $('#submitBtn').attr('disabled', true);
            $('.service-item').removeClass("service-item-active");
            $('#' + service_selected).addClass("service-item-active");


            $.ajax({
                type: 'POST',
                url: '{{ route('checkout.selected_service') }}',
                data: {
                    "_token": '{{ csrf_token() }}',
                    "type": service_selected,
                    "fee": charges
                },
                success: function(response) {
                    $('#submitBtn').removeAttr('disabled');
                }
            })
            // display_overall = parseFloat($('#overall_total').val())


            // total_amount = parseFloat(display_overall + total_charges);
            // // $('#overall_total_display').text('₱'+ total_amount.toFixed(2));
            // $('#overall_total_display').text('₱'+ numberWithCommas(total_amount.toFixed(2)));
            // $('input#service_type').val(service_selected);
            // $('input#service_fee').val(total_charges.toFixed(2));


            // if(parseFloat(charges) > 0) {
            //     $('#service').css('display','block');
            //     $('#service #service_fee_display').html('₱'+ $('input#service_fee').val());
            // }
            // else {
            //     $('#service').css('display','none');
            //     $('#service #service_fee_display').html('₱'+ $('input#service_fee').val());
            // }


        }

        // $('#edit_my_shipping_address').on('submit', function (e) {
        $(document).on('submit', '#edit_my_shipping_address', function(e) {
            e.preventDefault();

            $('#edit_my_shipping_address button:submit').prop('disabled', true);
            $('#edit_my_shipping_address button:submit').html('Saving...');
            var element = document.getElementById('edit_my_shipping_address');
            var form_data = new FormData(element);
            $.ajax({
                type: 'POST',
                url: '{{ route('save.shipping.address') }}',
                processData: false,
                contentType: false,
                cache: false,
                data: form_data,
                success: function(response) {
                    AIZ.plugins.notify('success', response.message);
                    if (response.reload_page == true) {
                        location.reload();
                    } else {
                        $('#editShippingAddress').modal('hide');
                        $('#changeShippingAddress').css('display', 'block');
                        $('#changeAddress').trigger('click');
                    }
                },
                error: function(error) {
                    AIZ.plugins.notify('danger', 'Something went wrong. Try Again.');
                    $('#edit_my_shipping_address button:submit').prop('disabled', false);
                    $('#edit_my_shipping_address button:submit').html('Save');
                }
            });

            return false;
        })

        function validateInput(inputElement) {
            let value = inputElement.value;

            // Check if the first character is a space
            if (value.charAt(0) === ' ') {
                // Remove the leading space
                inputElement.value = value.substring(1);
            }

            // Use the previous regex to remove other disallowed characters
            inputElement.value = inputElement.value.replace(/[^a-zA-Z\s]/g, '');
        }
    </script>

    <script>
        $('#region_code').on('change', function() {
            var region_code = $(this).val();

            $('#province_code').empty();
            $('#province_code').append("<option value='' hidden selected>Select province...</option>")

            $.ajax({
                type: 'GET',
                url: '{{ route('get-province') }}',
                data: {
                    'region_code': region_code
                },
                success: function(response) {
                    $.each(response, function(k, v) {
                        $('#province_code').append("<option value='" + v.provCode + "'>" + v
                            .provDesc + "</option>")
                    })
                },
            })
        })
        $('#province_code').on('change', function() {

            var province_code = $(this).val();

            $('#city_code').empty();
            $('#city_code').append("<option value='' hidden selected>Select city...</option>")

            $.ajax({
                type: 'GET',
                url: '{{ route('get-city') }}',
                data: {
                    'province_code': province_code
                },
                success: function(response) {
                    $.each(response, function(k, v) {
                        $('#city_code').append("<option value='" + v.citymunCode + "'>" + v
                            .citymunDesc + "</option>")
                    })
                },

            })
        })
        $('#city_code').on('change', function() {
            var city_code = $(this).val();

            $('#brgy_code').empty();
            $('#brgy_code').append("<option value='' hidden selected>Select barangay...</option>")

            $.ajax({
                type: 'GET',
                url: '{{ route('get-barangay') }}',
                data: {
                    'city_code': city_code
                },
                success: function(response) {
                    $.each(response, function(k, v) {
                        $('#brgy_code').append("<option value='" + v.brgyCode + "'>" + v
                            .brgyDesc + "</option>")
                    })
                },
            })
        })
    </script>
@endsection
