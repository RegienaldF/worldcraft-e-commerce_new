@extends('master')

@section('links')
<link rel="stylesheet" href="{{ asset('assets/css/payment_custom_style.css') }}">
<style></style>
@endsection

@section('content')

    @php
    $to_checkout = Session::get('toCheckout');
    @endphp

    <section class="py-5 bg-lightblue">

        <div class="container">
            <div class="position-absolute">
                <div class="img-44"></div>
            </div>
            <div class="steps-container border-0">
                <div class="row">
                    <div class="col-12 col-lg-7 mx-auto">
                        <div class="row gutters-5 text-center aiz-steps">
                            <div class="col active done">
                                <div class="icon">
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.3 9.97C15.96 10.59 15.3 11 14.55 11H7.1L6 13H18V15H6C4.48 15 3.52 13.37 4.25 12.03L5.6 9.59L2 2H0V0H3.27L4.21 2H19.01C19.77 2 20.25 2.82 19.88 3.48L16.3 9.97ZM17.3099 4H5.15989L7.52989 9H14.5499L17.3099 4ZM6.00004 16C4.90003 16 4.01003 16.9 4.01003 18C4.01003 19.1 4.90003 20 6.00004 20C7.10004 20 8.00004 19.1 8.00004 18C8.00004 16.9 7.10004 16 6.00004 16ZM14.01 18C14.01 16.9 14.9 16 16 16C17.1 16 18 16.9 18 18C18 19.1 17.1 20 16 20C14.9 20 14.01 19.1 14.01 18Z"
                                            fill="white" />
                                    </svg>
                                </div>
                                <div class="title fs-12">{{ translate('My Cart') }}</div>
                            </div>

                            <div class="col active done">
                                <div class="icon bg-white">
                                    <svg id="Layer_1" enable-background="new 0 0 512 512" height="25" viewBox="0 0 512 512"
                                        width="25" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path fill="white"
                                                d="m256 0c-108.81 0-197.333 88.523-197.333 197.333 0 61.198 31.665 132.275 94.116 211.257 45.697 57.794 90.736 97.735 92.631 99.407 6.048 5.336 15.123 5.337 21.172 0 1.895-1.672 46.934-41.613 92.631-99.407 62.451-78.982 94.116-150.059 94.116-211.257 0-108.81-88.523-197.333-197.333-197.333zm0 474.171c-38.025-36.238-165.333-165.875-165.333-276.838 0-91.165 74.168-165.333 165.333-165.333s165.333 74.168 165.333 165.333c0 110.963-127.31 240.602-165.333 276.838z" />
                                            <path fill="white"
                                                d="m378.413 187.852-112-96c-5.992-5.136-14.833-5.136-20.825 0l-112 96c-6.709 5.75-7.486 15.852-1.735 22.561s15.852 7.486 22.561 1.735l13.586-11.646v79.498c0 8.836 7.164 16 16 16h144c8.836 0 16-7.164 16-16v-79.498l13.587 11.646c6.739 5.777 16.836 4.944 22.561-1.735 5.751-6.709 4.974-16.81-1.735-22.561zm-66.413 76.148h-112v-90.927l56-48 56 48z" />
                                        </g>
                                    </svg>
                                </div>
                                {{-- <div class="title fs-12">{{ translate('Customer Information') }}</div> --}}
                                <div class="title fs-12">{{ translate('Shipping') }}</div>
                            </div>

                            <div class="col active done">
                                <div class="icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.6667 3.33334H3.33341C2.40841 3.33334 1.67508 4.075 1.67508 5L1.66675 15C1.66675 15.925 2.40841 16.6667 3.33341 16.6667H16.6667C17.5917 16.6667 18.3334 15.925 18.3334 15V5C18.3334 4.075 17.5917 3.33334 16.6667 3.33334ZM16.6667 15H3.33341V10H16.6667V15ZM3.33341 6.66667H16.6667V5H3.33341V6.66667Z"
                                            fill="white" />
                                    </svg>
                                </div>
                                <div class="title fs-12">
                                    {{ translate('Payment') }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="icon">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M9.00008 0.666656C4.40008 0.666656 0.666748 4.39999 0.666748 8.99999C0.666748 13.6 4.40008 17.3333 9.00008 17.3333C13.6001 17.3333 17.3334 13.6 17.3334 8.99999C17.3334 4.39999 13.6001 0.666656 9.00008 0.666656ZM9.00008 15.6667C5.32508 15.6667 2.33341 12.675 2.33341 8.99999C2.33341 5.32499 5.32508 2.33332 9.00008 2.33332C12.6751 2.33332 15.6667 5.32499 15.6667 8.99999C15.6667 12.675 12.6751 15.6667 9.00008 15.6667ZM7.33341 10.8083L12.8251 5.31666L14.0001 6.49999L7.33341 13.1667L4.00008 9.83332L5.17508 8.65832L7.33341 10.8083Z"
                                            fill="black" />
                                    </svg>
                                </div>
                                <div class="title fs-12">{{ translate('Confirmation') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @php
                // $psc_accounts = [
                //     "baesa.employee@gmail.com",
                //     "edsa.employee@gmail.com",
                //     "imus.employee@gmail.com",
                //     "cebu.employee@gmail.com",
                //     "davao.employee@gmail.com",
                //     "jericsonbagat18@gmail.com",
                //     "maryjay.caloing@gmail.com",
                //     "deguzmanjean103190@gmail.com",
                //     "androrapal08@gmail.com",
                //     "ronaldpadua29@gmail.com",
                //     "josechristopher24@gmail.com",
                //     "jrbardz@gmail.com",
                //     "cagayandeoro.sales@gmail.com",
                //     "ddo.psc1.zamboanga@gmail.com",
                //     "mtpallas@multi-linegroup.com",
                //     "leazurita23@gmail.com",
                //     "enirethacsagunam@gmail.com",
                //     "chubzgarcia26@yahoo.com",
                //     "joshgudboy@gmail.com",
                //     "wc.sales.coordinator@gmail.com",
                //     "saldeanamae@gmail.com"
                // ];

                try {
                    // $pscs = \App\User::where('is_psc', 1)->select('email')->get()->pluck('email')->toArray();
                    $pscs = [];
                    $psc_accounts = \App\Models\User::where('is_psc', 1)->select('email')->get()->pluck('email')->toArray();
                }
                catch(\Throwable $th) {
                    $pscs = [$th->getMessage()];
                    //     $psc_accounts = [
                    //     "baesa.employee@gmail.com",
                    //     "edsa.employee@gmail.com",
                    //     "imus.employee@gmail.com",
                    //     "cebu.employee@gmail.com",
                    //     "davao.employee@gmail.com",
                    //     "jericsonbagat18@gmail.com",
                    //     "maryjay.caloing@gmail.com",
                    //     "deguzmanjean103190@gmail.com",
                    //     "androrapal08@gmail.com",
                    //     "ronaldpadua29@gmail.com",
                    //     "josechristopher24@gmail.com",
                    //     "jrbardz@gmail.com",
                    //     "cagayandeoro.sales@gmail.com",
                    //     "ddo.psc1.zamboanga@gmail.com",
                    //     "mtpallas@multi-linegroup.com",
                    //     "leazurita23@gmail.com",
                    //     "enirethacsagunam@gmail.com",
                    //     "chubzgarcia26@yahoo.com",
                    //     "joshgudboy@gmail.com",
                    //     "wc.sales.coordinator@gmail.com",
                    //     "saldeanamae@gmail.com"
                    // ];
                }
            @endphp
            <div class="my-4">
                <div class="text-left">
                    <div class="row">
                        <div class="col-xxl-8 col-xl-8 mx-auto">
                            <form class="form-default" action="{{ route('payment.checkout') }}" method="post" id="checkout-form">
                                @csrf
                                {{-- HIDDEN INPUTS --}}
                                    <input type="hidden" name="customer_data" id="customer_data">
                                    <input type="hidden" name="payment_option" id="payment_option">
                                    <input type="hidden" name="payment_type" id="payment_type">

                                    {{-- For Service  --}}
                                    <input type="hidden" name="service_type" id="service_type" value="{{ Session::get('service')["service_type"] }}">
                                    <input type="hidden" name="service_fee" id="service_fee" value="{{ Session::get('service')["service_fee"] }}">
                                    {{-- ADDITIONAL COST FOR PSC ACCOUNTS --}}
                                    <input type="hidden" name="additional_cost" id="additional_cost" value="0">
                                    <input type="hidden" name="inspection_note" id="inspection_note" value="">
                                {{-- END HIDDEN INPUTS --}}
                                <div class="row">
                                    {{-- Payment Method --}}
                                    <div class="col-12">
                                        <div class="card shadow p-3 mb-5 bg-body rounded">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-start">
                                                    <div class="card-customer-wallet-title">
                                                        Payment Method
                                                    </div>
                                                </div>

                                                <div class="mt-3">
                                                    <div>
                                                        <div class="d-flex align-items-center gap-1">
                                                            <div class="mr-2">
                                                                <div class="payment-method-subtitle">
                                                                    {{ translate('Online payments powered by ') }}
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <img src="{{ asset('assets/img/image36.svg') }}"
                                                                    alt="Paynamics Payment" class="paynamics-img" style="margin-top: -4px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @php
                                                    $payment_methods = \App\Models\PaymentMethodList::where('status', 1)
                                                        ->orderBy('id', 'asc')
                                                        ->get();

                                                    $scheduled_date = '2023-06-01';
                                                    $show = 1;
                                                @endphp

                                                @if(env('APP_ENV') == 'production' || $show == 1)
                                                    @if(now()->format('Y-m-d') >= $scheduled_date || Auth::user()->email == 'erwincaloing@gmail.com' || Auth::user()->email == 'erwincaloingfiles@gmail.com' || Auth::user()->email == 'erwincaloingmultiline@gmail.com' ||  Auth::user()->user_type == 'admin')
                                                        <div class="">
                                                            {{-- <div class="row">
                                                                @foreach ($payment_methods as $key => $value)
                                                                    <div class="payment-item c-pointer col-auto mt-2"
                                                                        onclick="togglePaynamics('{{ $value->value }}')"
                                                                        id="{{ $value->value }}">
                                                                        {{ translate($value->name) }}
                                                                    </div>
                                                                @endforeach
                                                            </div> --}}

                                                            <div id="paynamics" class="payment-details">
                                                                <div class="row">
                                                                    @foreach ($payment_methods as $key => $value)
                                                                        @php
                                                                            $paymentOption = $value->value;
                                                                        @endphp
                                                                        <div class="col-md-6 {{ $value->value }}">
                                                                            <div class="header-details mb-0">
                                                                                {{ $value->name }}
                                                                            </div>

                                                                            @php
                                                                                $payment_channels = \App\Models\PaymentChannel::where('status', 1)
                                                                                    ->where('payment_method_id', $value->id)
                                                                                    ->orderBy('id', 'asc')
                                                                                    ->get();
                                                                            @endphp

                                                                            <div class="payment-details-body">
                                                                                @foreach ($payment_channels as $key => $channel)
                                                                                    <div class="form-craft-radio">
                                                                                        <label for="{{ $channel->value }}" class="pt-3 text-paragraph-thin c-pointer">
                                                                                            <input type="radio" id="{{ $channel->value }}" name="payment_channel" value="{{ $channel->value }}" data-payment-option="{{ $paymentOption }}" style="height: 11px;">
                                                                                            <img style="max-width: 55px;" src="{{ uploaded_asset($channel->image) }}" class="pl-3 px-2" alt="">
                                                                                            {{ $channel->name }}
                                                                                        </label>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="alert alert-secondary d-none" role="alert">
                                                        Paynamics is only available for production environment.
                                                    </div>
                                                @endif
                                                <!-- Ending of condition to display the paynamics on specific account -->

                                                <hr class="my-2">

                                                @php
                                                    $other_payment_methods = \App\Models\OtherPaymentMethod::where('status', 1)->get();
                                                @endphp
                                                @php
                                                    // LIST OF USERS
                                                    // $users_email = ['programmers.multiline@gmail.com','caloingerwin@gmail.com','wcreseller2023@gmail.com','wc_dealer@gmail.com','marcocalderonangeles@gmail.com'];
                                                @endphp
                                                @if(DB::table('addons')->where('unique_identifier','mpgs')->first()->version == 1)
                                                    {{-- @if(in_array(Auth::user()->email , $users_email))
                                                    @endif --}}
                                                    <div class="form-craft-radio">
                                                        <label for="credit_card" class="pt-3 text-paragraph-thin c-pointer">
                                                            <input type="radio" id="credit_card" name="payment_channel" value="other-payment-method" data-payment-option="credit_card" style="height: 11px;">
                                                            <img style="max-width: 80px;" src="{{ asset('/worldcraft/icons/mastercard-visa.png') }}" class="pl-3 px-2" alt="">
                                                            {{-- Mastercard / VISA --}}
                                                        </label>
                                                    </div>
                                                @endif

                                                <div class="other-method">
                                                    <div class="payment-method-subtitle-2">
                                                        Other payment methods
                                                    </div>
                                                    <div class="row">
                                                        @foreach ($other_payment_methods as $key => $value)
                                                            @if(Session::get('service')["service_type"] == 'in_house_delivery')
                                                                @if($value->unique_id != 'cash_on_pickup')
                                                                    <div class="payment-item c-pointer col-auto mt-2"
                                                                        onclick="togglePaymentMethod('{{ $value->unique_id }}')"
                                                                        id="{{ $value->unique_id }}">
                                                                        {{ $value->name }}
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="payment-item c-pointer col-auto mt-2"
                                                                    onclick="togglePaymentMethod('{{ $value->unique_id }}')"
                                                                    id="{{ $value->unique_id }}">
                                                                    {{ $value->name }}
                                                                </div>
                                                            @endif
                                                            {{-- <div class="payment-item c-pointer col-auto mt-2"
                                                                onclick="togglePaymentMethod('{{ $value->unique_id }}')"
                                                                id="{{ $value->unique_id }}">
                                                                {{ $value->name }}
                                                            </div> --}}
                                                        @endforeach
                                                    </div>

                                                    <div id="cop_container" style="display: none">
                                                        <hr>
                                                        <div class="">
                                                            {{-- 1st Step --}}
                                                            <div class="d-flex flex-sm-row flex-column justify-content-start mb-4">
                                                                {{-- <div class="mr-4">
                                                                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect width="34" height="34" rx="17" fill="#1B1464"/>
                                                                    <path d="M19.1829 12.8182H17.4279L14.8974 14.4439V16.1342L17.2788 14.6129H17.3384V23H19.1829V12.8182Z" fill="white"/>
                                                                    </svg>
                                                                </div> --}}
                                                                <div class="mt-2">
                                                                    <div class="order-upload-receipt-title">
                                                                        @php
                                                                            $cop_payment_method = \App\Models\OtherPaymentMethod::where('unique_id', 'cash_on_pickup')
                                                                                ->select('name', 'unique_id', 'id')
                                                                                ->first();

                                                                            $cop_payment_method_steps = \App\Models\OtherPaymentMethodStep::where('other_payment_method_id', $cop_payment_method->id)
                                                                                ->get();
                                                                        @endphp
                                                                        Steps on how to pay using {{ ucfirst(str_replace('_', ' ', $cop_payment_method->name)) }}:
                                                                    </div>
                                                                    <div class="mt-3">
                                                                        @foreach ($cop_payment_method_steps as $key => $value)
                                                                            <div class="d-flex align-items-start">
                                                                                <div class="mr-3 order-upload-receipt-subtitle">
                                                                                    {{ $key + 1 }}.
                                                                                </div>
                                                                                <div class="order-upload-receipt-subtitle">
                                                                                    {{ $value->step }}
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="bank_transfer_container" style="display: none">
                                                        <hr>
                                                        <div class="">
                                                            {{-- 1st Step --}}
                                                            <div class="d-flex flex-sm-row flex-column justify-content-start mb-4">
                                                                <div class="mr-4">
                                                                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect width="34" height="34" rx="17" fill="#1B1464"/>
                                                                    <path d="M19.1829 12.8182H17.4279L14.8974 14.4439V16.1342L17.2788 14.6129H17.3384V23H19.1829V12.8182Z" fill="white"/>
                                                                    </svg>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <div class="order-upload-receipt-title">
                                                                        @php
                                                                            $other_payment_method = \App\Models\OtherPaymentMethod::where('unique_id', 'bank_transfer')
                                                                                ->select('name', 'unique_id', 'id')
                                                                                ->first();

                                                                            $other_payment_method_steps = \App\Models\OtherPaymentMethodStep::where('other_payment_method_id', $other_payment_method->id)
                                                                                ->get();

                                                                            $bank_details = \App\Models\OtherPaymentMethodBankDetail::where('other_payment_method_id', $other_payment_method->id)
                                                                                ->where('status', 1)
                                                                                ->get();
                                                                        @endphp
                                                                        Steps on how to pay using {{ ucfirst(str_replace('_', ' ', $other_payment_method->name)) }}:
                                                                    </div>
                                                                    <div class="mt-3">
                                                                        @foreach ($other_payment_method_steps as $key => $value)
                                                                            <div class="d-flex align-items-start">
                                                                                <div class="mr-3 order-upload-receipt-subtitle">
                                                                                    {{ $key + 1 }}.
                                                                                </div>
                                                                                <div class="order-upload-receipt-subtitle">
                                                                                    {{ $value->step }}
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                        <div class="d-flex align-items-start">
                                                                            <div class="mr-4 order-upload-receipt-subtitle">
                                                                            </div>
                                                                            <div class="order-upload-receipt-subtitle">
                                                                                <div>
                                                                                    <div class="row gutters-5 mt-3">
                                                                                        @foreach ($bank_details as $key => $bank)
                                                                                            @if ($bank->other_payment_method->type == 'e_wallet')
                                                                                                @php
                                                                                                    $pup_location = \App\Models\PickupPoint::where('name', ucfirst(str_replace('_', ' ', $order->pickup_point_location)))
                                                                                                        ->pluck('id');
                                                                                                @endphp

                                                                                                @if (in_array($bank->pickup_point_location, $pup_location->toArray()))
                                                                                                    <div class="col-12 mb-2 py-2">
                                                                                                        <div class="d-flex align-items-center">
                                                                                                            <div class="mr-3">
                                                                                                                <img src="{{ asset($bank->bank_image) }}" class="img-fluid" alt="">
                                                                                                            </div>
                                                                                                            <div>
                                                                                                                <p class="order-upload-receipt-label mb-0">{{ $bank->bank_name }}</p>
                                                                                                                <p class="order-upload-receipt-details mb-0">{{ $bank->bank_acc_number }}</p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            @else
                                                                                                <div class="col-auto mb-2">
                                                                                                    <div class="order-upload-receipt-payment-gateway">
                                                                                                        <div class="d-flex align-items-center">
                                                                                                            <div class="mr-3 bank-logo">
                                                                                                                <img src="{{ uploaded_asset($bank->bank_image) }}" class="img-fluid" alt="">
                                                                                                            </div>
                                                                                                            <div>
                                                                                                                <p class="order-upload-receipt-label mb-0">{{ $bank->bank_name }}</p>
                                                                                                                <p class="order-upload-receipt-details mb-0">
                                                                                                                    {{ $bank->bank_acc_number }}
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- 2nd Step --}}
                                                            <div class="d-flex flex-sm-row flex-column justify-content-start">
                                                                <div class="mr-4">
                                                                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect width="34" height="34" rx="17" fill="#1B1464"/>
                                                                    <path d="M14.0572 23H21.0373V21.4588H16.6026V21.3892L18.3576 19.6044C20.3363 17.7053 20.8832 16.7805 20.8832 15.6321C20.8832 13.9268 19.4961 12.679 17.4478 12.679C15.4293 12.679 13.9975 13.9318 13.9975 15.8658H15.7525C15.7525 14.8267 16.4087 14.1754 17.4229 14.1754C18.3924 14.1754 19.1133 14.767 19.1133 15.7266C19.1133 16.5767 18.5962 17.1832 17.592 18.2024L14.0572 21.6676V23Z" fill="white"/>
                                                                    </svg>
                                                                </div>
                                                                <div>
                                                                    <div data-toggle="aizuploader" data-type="image" data-multiple="true">
                                                                        <div class="steps-container h-100 mt-4 mt-md-0">
                                                                            <div class="row">
                                                                                <div class="col-lg-8">
                                                                                    <div class="order-details-title mb-2">
                                                                                        Upload proof of payment
                                                                                    </div>
                                                                                    <div class="order-details-subtitle">
                                                                                        {{-- You can attach screenshots or photos of of your receipts then wait for us to verify your payment, it will take at least 12-24 hours. --}}
                                                                                        Please attach screenshots or photos of your receipts then wait for us to verify your payment, it will take at least 12-24 hours.
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-4 d-flex align-items-center justify-content-end">
                                                                                    <button type="button" class="btn btn-primary mt-4 mt-md-0">
                                                                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.25 12.375V7.875H14.25L9 2.625L3.75 7.875H6.75V12.375H11.25ZM9 4.7475L10.6275 6.375H9.75V10.875H8.25V6.375H7.3725L9 4.7475ZM14.25 15.375V13.875H3.75V15.375H14.25Z" fill="white"/>
                                                                                        </svg>
                                                                                        Choose Files
                                                                                    </button>
                                                                                    <input type="hidden" name="proof_of_payment" class="selected-files" id="proof_of_payment">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="file-preview box sm">
                                                                    </div>

                                                                    @if ($errors->has('proof_of_payment'))
                                                                        <span class="invalid-feedback d-block" role="alert">
                                                                            {{ $errors->first('proof_of_payment') }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group mt-5">
                                                        <label for="" class="col-form-label">Note:</label>
                                                        <textarea name="note" id="note" cols="15" rows="4" class="form-control form-craft"></textarea>
                                                    </div>

                                                    <div class="text-danger">
                                                        <p><span class="fw-600">Notice:</span> <span class="opacity-900">Payment first before reservation of stocks</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xxl-4 col-xl-4 mx-auto">
                            <div class="mb-0">
                                @include('frontend.partials.cart_summary')
                            </div>
                            {{-- <div class="d-flex justify-content-between fw-500 fs-18">
                                <div>Order Timer:</div>

                                <div id="display_">05:00</div>
                            </div> --}}

                            {{-- @if(in_array(Auth::user()->email, $psc_accounts))
                                <div class="card border-0 shadow-sm rounded mt-0">
                                    <div class="shadow-sm bg-white p-2 p-lg-4 rounded text-left">
                                        <div class="fw-700 fs-24 text-center mb-1" style="color:#0C0736;">
                                            {{ translate('Customer Details') }}
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-sm-5 col-form-label">Customer Name: <span class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" name="customer_name">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-sm-5 col-form-label">Complete Address: <span class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" rows="1" id="customer_complete_address" name="customer_complete_address"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-sm-5 col-form-label" >Mobile Number: <span class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                            <input type="text" class="form-control" name="customer_mobile_number">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-sm-5 col-form-label" >Email Address: <span class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                            <input type="text" class="form-control" name="customer_email_address">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <label class="col-sm-5 col-form-label">Tin Number: <span class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                            <input type="text" class="form-control" name="customer_tin_number">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1 d-none">
                                            <label class="col-sm-5 col-form-label">Additional Cost (₱): <span class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                            <input type="number" class="form-control" name="customer_add_cost" id="customer_add_cost" value="0" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-8 col-xl-8">
                            <label for="agree_checkbox" class="form-craft-check d-flex align-items-center">
                                <input type="checkbox" required id="agree_checkbox" style="height: 20px;">
                                <span class="d-flex text-craft-sub ml-2" style="font-size:14px;">
                                    <span class="mr-1 ml-2">
                                        {{ translate('I agree to the') }}
                                        <a class="link-blue" href="{{ route('terms') }}" target="_blank">
                                            <strong>{{ translate('terms and conditions') }}</strong>,
                                        </a>
                                        <a class="link-blue" href="{{ route('returnpolicy') }}" target="_blank">
                                            <strong>{{ translate('return policy') }}</strong> &
                                        </a>
                                        <a class="link-blue" href="{{ route('privacypolicy') }}" target="_blank">
                                            <strong>{{ translate('privacy policy') }}</strong>.
                                        </a>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-xxl-8 col-xl-8" style="opacity: 0; pointer-events:none; height : 0px;">
                            <label for="agree_checkbox2" class="form-craft-check d-flex align-items-center">
                                <input type="checkbox" required id="agree_checkbox2" style="height: 20px;">
                                <span class="d-flex text-craft-sub ml-2" style="font-size:14px; font-weight: 700">
                                    <span class="mr-1 ml-2">
                                        {{ translate("All goods and it's parts were inspected and confirmed to be in good condition and complete.") }}
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-xxl-8 col-xl-8 d-none">
                            <label class="form-craft-check d-flex align-items-center mt-2">
                                <span class="d-flex text-craft-sub" style="font-size:14px;">
                                    <span class="">
                                        How would you like to inspect your order?
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-xxl-8 col-xl-8 d-none">
                            <label class="form-craft-check d-flex align-items-center">
                                <input type="checkbox" required id="buyer_representative" style="height: 20px;" data-value="Conduct an actual inspection together with the buyer's representative upon pickup.">
                                <span class="d-flex text-craft-sub ml-2" style="font-size:14px; font-weight: 700">
                                    <span class="mr-1 ml-2">
                                        {{-- For actual inspection together with buyer's representative upon pickup. --}}
                                        Conduct an actual inspection together with the buyer's representative upon pickup.
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-xxl-8 col-xl-8 d-none">
                            <label class="form-craft-check d-flex align-items-center">
                                <input type="checkbox" required id="wc_representative" style="height: 20px;" data-value="Allow the WorldCraft representative to perform the inspection only.">
                                <span class="d-flex text-craft-sub ml-2" style="font-size:14px; font-weight: 700">
                                    <span class="mr-1 ml-2">
                                        {{-- For actual inspection of WorldCraft representative only. --}}
                                        Allow the WorldCraft representative to perform the inspection only.
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-xxl-8 col-xl-8 d-flex mt-4">
                            <div class="col-xxl-6 col-xl-6 d-flex justify-content-start pl-0">
                                <a href="{{ route('get_shipping_info') }}"
                                    class="link-back-cart d-flex align-items-center">
                                    <svg class="mr-2" width="19" height="20" viewBox="0 0 19 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.625 9.20833H5.40708L8.24125 6.36625L7.125 5.25L2.375 10L7.125 14.75L8.24125 13.6337L5.40708 10.7917H16.625V9.20833Z"
                                            fill="#62616A" />
                                    </svg>
                                    {{ translate('Back to Shipping') }}
                                    {{-- {{ translate('Back to Customer Information') }} --}}
                                </a>
                            </div>
                            <div class="col-xxl-6 col-xl-6 d-flex justify-content-end pr-0">
                                <button type="submit" onclick="submitOrder(this)"
                                    class="btn fw-600 d-flex align-items-center" id="submit-btn">
                                    <svg class="mr-2" width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.5832 7.79167H16.4998C17.5082 7.79167 18.3332 8.61667 18.3332 9.625V18.7917C18.3332 19.8 17.5082 20.625 16.4998 20.625H5.49984C4.4915 20.625 3.6665 19.8 3.6665 18.7917V9.625C3.6665 8.61667 4.4915 7.79167 5.49984 7.79167H6.4165V5.95833C6.4165 3.42833 8.46984 1.375 10.9998 1.375C13.5298 1.375 15.5832 3.42833 15.5832 5.95833V7.79167ZM10.9998 3.20833C9.47817 3.20833 8.24984 4.43667 8.24984 5.95833V7.79167H13.7498V5.95833C13.7498 4.43667 12.5215 3.20833 10.9998 3.20833ZM16.4998 18.7917H5.49984V9.625H16.4998V18.7917ZM12.8332 14.2083C12.8332 15.2167 12.0082 16.0417 10.9998 16.0417C9.9915 16.0417 9.1665 15.2167 9.1665 14.2083C9.1665 13.2 9.9915 12.375 10.9998 12.375C12.0082 12.375 12.8332 13.2 12.8332 14.2083Z"
                                            fill="white" />
                                    </svg>
                                    {{ translate('Place Order') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('modal')

    <div class="modal" id="modalTimer">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="p-3">
                        <div id="start_timer" style="display: none">
                            <p class="fw-600">
                                Your order must be finished within five minutes. You will return to your cart after the allotted time has passed.
                            </p>
                            <button type="button" id="start_timer_btn" class="btn btn-primary fw-600 cart-mobile-ui w-100 mt-3">Okay. I understand.</button>
                        </div>
                        <div id="extension" style="display: none">
                            <p class="fw-600">
                                Your allotted five minutes has ended. Would you like more time to complete your order?
                            </p>
                            <button type="button" id="reset_timer_btn" class="btn btn-primary fw-600 cart-mobile-ui w-100 mt-3">Yes, I want to continue.</button>
                            <button type="button" onclick="backToCart()" class="btn btn-secondary fw-600 cart-mobile-ui w-100 mt-3">Back to cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="termsAndCondition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-zoom" role="document" style="max-width: 500px;">
            <div class="modal-content">

                <form id="termsAndConditionsForm" onsubmit="return validateCheckbox()">
                    <div class="modal-header justify-content-center">
                        <h6 class="modal-title fw-600">{{ translate('Terms and Condition') }}</h6>
                        {{-- <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true"></span>
                        </button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="p-3">
                            {{-- <h3 class="text-center mb-3" style="font-size: 1.4rem !important; font-weight: bold;">Terms and Conditions</h3> --}}
                            <div class="text-justify">
                                @include('frontend.inc.toc')
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12" id="validation-message-terms" style="display: none">
                                <label style="color: red">* Can't proceed as you didn't agree to the terms and conditions.</label>
                            </div>
                            <div class="col-12" id="AgreeTermsAndCondtions">
                                <label for="agree_checkbox_toc" class="form-craft-check d-flex align-items-center">
                                    <input type="checkbox" name="agree_checkbox_toc" id="agree_checkbox_toc" style="height: 20px;" >
                                    <span class="d-flex text-craft-sub ml-2" style="font-size:14px;">
                                        <span class="mr-1 ml-2">
                                            I agree to the WorldCraft's terms and conditions.
                                        </span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('get_shipping_info') }}" type="button" class="btn btn-secondary"><i class="las la-arrow-left"></i> Back to Shipping</a>
                            <button class="btn btn-primary" id="continue-btn" type="submit" disabled>Proceed <i class="las la-arrow-right"></i></button>
                        </div>
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
                    </div> --}}
                    {{-- <div class="modal-footer justify-content-between align-items-center">
                        <a href="{{ route('checkout.shipping_info') }}" type="button" class="btn btn-secondary"><i class="las la-arrow-left"></i> Back to Shipping</a>
                        <button class="btn btn-primary" id="continue-btn" type="submit" disabled>Proceed <i class="las la-arrow-right"></i></button>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cashOnPickupModal">
        <div class="modal-dialog modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fw-600">{{ translate('For Cash On Pickup') }}</h6>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3 text-center" >
                        <h3 class="text-header-blue "><strong>Our Store Locations</strong></h3>
                        <p >Please come to the nearest warehouse to pay with cash upon pickup.</p>
                    </div>

                    <section>
                        <div class="container">
                            @php
                                $north_store_locations = \App\Models\StoreLocation::where('status', 1)
                                    ->where('island_name', 'north_luzon')->get(['island_name', 'name', 'address', 'phone_number', 'google_maps_url']);

                                $south_store_locations = \App\Models\StoreLocation::where('status', 1)
                                    ->where('island_name', 'south_luzon')->get(['island_name', 'name', 'address', 'phone_number', 'google_maps_url']);

                                $visayas_store_locations = \App\Models\StoreLocation::where('status', 1)
                                    ->where('island_name', 'visayas')->get(['island_name', 'name', 'address', 'phone_number', 'google_maps_url']);

                                $mindanao_store_locations = \App\Models\StoreLocation::where('status', 1)
                                    ->where('island_name', 'mindanao')->get(['island_name', 'name', 'address', 'phone_number', 'google_maps_url']);
                            @endphp
                            <div class="row">
                                <div class="col-12 col-lg-12">
                                    <p class="opacity-60 text-breadcrumb fw-600">N O R T H  L U Z O N</p>
                                    @foreach ($north_store_locations as $key => $north_store)
                                        <div class="p-4 lightblue-bg rounded shadow-sm overflow-hidden mw-100 text-left store-card mb-3">
                                            <a href="https://maps.google.com/?q={{ $north_store->address }}" target="_blank" class="float-right">
                                                <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13 0.5625V3.56212C13 4.06512 12.4141 4.31166 12.0753 3.95988L11.2694 3.12295L5.77324 8.83052C5.5617 9.0502 5.21876 9.0502 5.00721 8.83052L4.49653 8.3002C4.28499 8.08052 4.28499 7.72437 4.49653 7.50471L9.99276 1.79709L9.18696 0.960258C8.84682 0.607031 9.08772 0 9.56999 0H12.4583C12.7575 0 13 0.251836 13 0.5625ZM9.18642 6.34673L8.82531 6.72173C8.77501 6.77397 8.73511 6.83598 8.70789 6.90423C8.68067 6.97248 8.66666 7.04562 8.66667 7.11949V10.5H1.44444V3H7.40278C7.54643 2.99999 7.6842 2.94073 7.78578 2.83526L8.14689 2.46026C8.48812 2.10588 8.24645 1.5 7.76389 1.5H1.08333C0.485017 1.5 0 2.00367 0 2.625V10.875C0 11.4963 0.485017 12 1.08333 12H9.02778C9.62609 12 10.1111 11.4963 10.1111 10.875V6.74447C10.1111 6.24333 9.52765 5.99236 9.18642 6.34673Z" fill="#161DBC"/>
                                                </svg>
                                            </a>
                                            <p class="fw-600 text-title-thin">{{ $north_store->name }}</p>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C15.31 2 18 4.69 18 8C18 12.5 12 19 12 19C12 19 6 12.5 6 8C6 4.69 8.69 2 12 2ZM19 22V20H5V22H19ZM8 8C8 5.79 9.79 4 12 4C14.21 4 16 5.79 16 8C16 10.13 13.92 13.46 12 15.91C10.08 13.47 8 10.13 8 8ZM10 8C10 6.9 10.9 6 12 6C13.1 6 14 6.9 14 8C14 9.1 13.11 10 12 10C10.9 10 10 9.1 10 8Z" fill="#62616A"/>
                                                    </svg>
                                                </div>
                                                <div class="col-md-10">
                                                    <a href="https://maps.google.com/?q={{ $north_store->address }}" target="_blank">
                                                        {{ $north_store->address }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-1">
                                                    <svg id="Layer_1" enable-background="new 0 0 512.021 512.021" height="16" viewBox="0 0 512.021 512.021" width="24" xmlns="http://www.w3.org/2000/svg">
                                                        <g>
                                                            <path d="m367.988 512.021c-16.528 0-32.916-2.922-48.941-8.744-70.598-25.646-136.128-67.416-189.508-120.795s-95.15-118.91-120.795-189.508c-8.241-22.688-10.673-46.108-7.226-69.612 3.229-22.016 11.757-43.389 24.663-61.809 12.963-18.501 30.245-33.889 49.977-44.5 21.042-11.315 44.009-17.053 68.265-17.053 7.544 0 14.064 5.271 15.645 12.647l25.114 117.199c1.137 5.307-.494 10.829-4.331 14.667l-42.913 42.912c40.482 80.486 106.17 146.174 186.656 186.656l42.912-42.913c3.838-3.837 9.361-5.466 14.667-4.331l117.199 25.114c7.377 1.581 12.647 8.101 12.647 15.645 0 24.256-5.738 47.224-17.054 68.266-10.611 19.732-25.999 37.014-44.5 49.977-18.419 12.906-39.792 21.434-61.809 24.663-6.899 1.013-13.797 1.518-20.668 1.519zm-236.349-479.321c-31.995 3.532-60.393 20.302-79.251 47.217-21.206 30.265-26.151 67.49-13.567 102.132 49.304 135.726 155.425 241.847 291.151 291.151 34.641 12.584 71.866 7.64 102.132-13.567 26.915-18.858 43.685-47.256 47.217-79.251l-95.341-20.43-44.816 44.816c-4.769 4.769-12.015 6.036-18.117 3.168-95.19-44.72-172.242-121.772-216.962-216.962-2.867-6.103-1.601-13.349 3.168-18.117l44.816-44.816z"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="col-md-10">
                                                    <a href="tel:{{ $north_store->phone_number }}" target="_blank">
                                                        {{ $north_store->phone_number }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-12 col-lg-12">
                                    <p class="opacity-60 text-breadcrumb fw-600">S O U T H  L U Z O N</p>
                                    @foreach ($south_store_locations as $key => $south_store)
                                        <div class="p-4 lightblue-bg rounded shadow-sm overflow-hidden mw-100 text-left store-card mb-3">
                                            <a href="https://maps.google.com/?q={{ $south_store->address }}" target="_blank" class="float-right">
                                                <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13 0.5625V3.56212C13 4.06512 12.4141 4.31166 12.0753 3.95988L11.2694 3.12295L5.77324 8.83052C5.5617 9.0502 5.21876 9.0502 5.00721 8.83052L4.49653 8.3002C4.28499 8.08052 4.28499 7.72437 4.49653 7.50471L9.99276 1.79709L9.18696 0.960258C8.84682 0.607031 9.08772 0 9.56999 0H12.4583C12.7575 0 13 0.251836 13 0.5625ZM9.18642 6.34673L8.82531 6.72173C8.77501 6.77397 8.73511 6.83598 8.70789 6.90423C8.68067 6.97248 8.66666 7.04562 8.66667 7.11949V10.5H1.44444V3H7.40278C7.54643 2.99999 7.6842 2.94073 7.78578 2.83526L8.14689 2.46026C8.48812 2.10588 8.24645 1.5 7.76389 1.5H1.08333C0.485017 1.5 0 2.00367 0 2.625V10.875C0 11.4963 0.485017 12 1.08333 12H9.02778C9.62609 12 10.1111 11.4963 10.1111 10.875V6.74447C10.1111 6.24333 9.52765 5.99236 9.18642 6.34673Z" fill="#161DBC"/>
                                                </svg>
                                            </a>
                                            <p class="fw-600 text-title-thin">{{ $south_store->name }}</p>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C15.31 2 18 4.69 18 8C18 12.5 12 19 12 19C12 19 6 12.5 6 8C6 4.69 8.69 2 12 2ZM19 22V20H5V22H19ZM8 8C8 5.79 9.79 4 12 4C14.21 4 16 5.79 16 8C16 10.13 13.92 13.46 12 15.91C10.08 13.47 8 10.13 8 8ZM10 8C10 6.9 10.9 6 12 6C13.1 6 14 6.9 14 8C14 9.1 13.11 10 12 10C10.9 10 10 9.1 10 8Z" fill="#62616A"/>
                                                        </svg>
                                                </div>
                                                <div class="col-md-10">
                                                    <a href="https://maps.google.com/?q={{ $south_store->address }}" target="_blank">
                                                        {{ $south_store->address }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-1">
                                                    <svg id="Layer_1" enable-background="new 0 0 512.021 512.021" height="16" viewBox="0 0 512.021 512.021" width="24" xmlns="http://www.w3.org/2000/svg">
                                                        <g>
                                                            <path d="m367.988 512.021c-16.528 0-32.916-2.922-48.941-8.744-70.598-25.646-136.128-67.416-189.508-120.795s-95.15-118.91-120.795-189.508c-8.241-22.688-10.673-46.108-7.226-69.612 3.229-22.016 11.757-43.389 24.663-61.809 12.963-18.501 30.245-33.889 49.977-44.5 21.042-11.315 44.009-17.053 68.265-17.053 7.544 0 14.064 5.271 15.645 12.647l25.114 117.199c1.137 5.307-.494 10.829-4.331 14.667l-42.913 42.912c40.482 80.486 106.17 146.174 186.656 186.656l42.912-42.913c3.838-3.837 9.361-5.466 14.667-4.331l117.199 25.114c7.377 1.581 12.647 8.101 12.647 15.645 0 24.256-5.738 47.224-17.054 68.266-10.611 19.732-25.999 37.014-44.5 49.977-18.419 12.906-39.792 21.434-61.809 24.663-6.899 1.013-13.797 1.518-20.668 1.519zm-236.349-479.321c-31.995 3.532-60.393 20.302-79.251 47.217-21.206 30.265-26.151 67.49-13.567 102.132 49.304 135.726 155.425 241.847 291.151 291.151 34.641 12.584 71.866 7.64 102.132-13.567 26.915-18.858 43.685-47.256 47.217-79.251l-95.341-20.43-44.816 44.816c-4.769 4.769-12.015 6.036-18.117 3.168-95.19-44.72-172.242-121.772-216.962-216.962-2.867-6.103-1.601-13.349 3.168-18.117l44.816-44.816z"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="col-md-10">
                                                    <a href="tel:{{ $south_store->phone_number }}" target="_blank">
                                                        {{ $south_store->phone_number }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-12 col-lg-12">
                                    <div>
                                        <p class="opacity-60 text-breadcrumb fw-600">V I S A Y A S</p>
                                        @foreach ($visayas_store_locations as $key => $visayas)
                                            <div class="p-4 lightblue-bg rounded shadow-sm overflow-hidden mw-100 text-left store-card mb-3">
                                                <a href="https://maps.google.com/?q={{ $visayas->address }}" target="_blank" class="float-right">
                                                    <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13 0.5625V3.56212C13 4.06512 12.4141 4.31166 12.0753 3.95988L11.2694 3.12295L5.77324 8.83052C5.5617 9.0502 5.21876 9.0502 5.00721 8.83052L4.49653 8.3002C4.28499 8.08052 4.28499 7.72437 4.49653 7.50471L9.99276 1.79709L9.18696 0.960258C8.84682 0.607031 9.08772 0 9.56999 0H12.4583C12.7575 0 13 0.251836 13 0.5625ZM9.18642 6.34673L8.82531 6.72173C8.77501 6.77397 8.73511 6.83598 8.70789 6.90423C8.68067 6.97248 8.66666 7.04562 8.66667 7.11949V10.5H1.44444V3H7.40278C7.54643 2.99999 7.6842 2.94073 7.78578 2.83526L8.14689 2.46026C8.48812 2.10588 8.24645 1.5 7.76389 1.5H1.08333C0.485017 1.5 0 2.00367 0 2.625V10.875C0 11.4963 0.485017 12 1.08333 12H9.02778C9.62609 12 10.1111 11.4963 10.1111 10.875V6.74447C10.1111 6.24333 9.52765 5.99236 9.18642 6.34673Z" fill="#161DBC"/>
                                                    </svg>
                                                </a>
                                                <p class="fw-600 text-title-thin">{{ $visayas->name }}</p>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C15.31 2 18 4.69 18 8C18 12.5 12 19 12 19C12 19 6 12.5 6 8C6 4.69 8.69 2 12 2ZM19 22V20H5V22H19ZM8 8C8 5.79 9.79 4 12 4C14.21 4 16 5.79 16 8C16 10.13 13.92 13.46 12 15.91C10.08 13.47 8 10.13 8 8ZM10 8C10 6.9 10.9 6 12 6C13.1 6 14 6.9 14 8C14 9.1 13.11 10 12 10C10.9 10 10 9.1 10 8Z" fill="#62616A"/>
                                                            </svg>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <a href="https://maps.google.com/?q={{ $visayas->address }}" target="_blank">
                                                            {{ $visayas->address }}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-1">
                                                        <svg id="Layer_1" enable-background="new 0 0 512.021 512.021" height="16" viewBox="0 0 512.021 512.021" width="24" xmlns="http://www.w3.org/2000/svg">
                                                            <g>
                                                                <path d="m367.988 512.021c-16.528 0-32.916-2.922-48.941-8.744-70.598-25.646-136.128-67.416-189.508-120.795s-95.15-118.91-120.795-189.508c-8.241-22.688-10.673-46.108-7.226-69.612 3.229-22.016 11.757-43.389 24.663-61.809 12.963-18.501 30.245-33.889 49.977-44.5 21.042-11.315 44.009-17.053 68.265-17.053 7.544 0 14.064 5.271 15.645 12.647l25.114 117.199c1.137 5.307-.494 10.829-4.331 14.667l-42.913 42.912c40.482 80.486 106.17 146.174 186.656 186.656l42.912-42.913c3.838-3.837 9.361-5.466 14.667-4.331l117.199 25.114c7.377 1.581 12.647 8.101 12.647 15.645 0 24.256-5.738 47.224-17.054 68.266-10.611 19.732-25.999 37.014-44.5 49.977-18.419 12.906-39.792 21.434-61.809 24.663-6.899 1.013-13.797 1.518-20.668 1.519zm-236.349-479.321c-31.995 3.532-60.393 20.302-79.251 47.217-21.206 30.265-26.151 67.49-13.567 102.132 49.304 135.726 155.425 241.847 291.151 291.151 34.641 12.584 71.866 7.64 102.132-13.567 26.915-18.858 43.685-47.256 47.217-79.251l-95.341-20.43-44.816 44.816c-4.769 4.769-12.015 6.036-18.117 3.168-95.19-44.72-172.242-121.772-216.962-216.962-2.867-6.103-1.601-13.349 3.168-18.117l44.816-44.816z"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <a href="tel:{{ $visayas->phone_number }}" target="_blank">
                                                            {{ $visayas->phone_number }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div>
                                        <p class="opacity-60 text-breadcrumb fw-600">M I N D A N A O</p>
                                        @foreach ($mindanao_store_locations as $key => $mindanao)
                                            <div class="p-4 lightblue-bg rounded shadow-sm overflow-hidden mw-100 text-left store-card mb-3">
                                                <a href="https://maps.google.com/?q={{ $mindanao->address }}" target="_blank" class="float-right">
                                                    <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13 0.5625V3.56212C13 4.06512 12.4141 4.31166 12.0753 3.95988L11.2694 3.12295L5.77324 8.83052C5.5617 9.0502 5.21876 9.0502 5.00721 8.83052L4.49653 8.3002C4.28499 8.08052 4.28499 7.72437 4.49653 7.50471L9.99276 1.79709L9.18696 0.960258C8.84682 0.607031 9.08772 0 9.56999 0H12.4583C12.7575 0 13 0.251836 13 0.5625ZM9.18642 6.34673L8.82531 6.72173C8.77501 6.77397 8.73511 6.83598 8.70789 6.90423C8.68067 6.97248 8.66666 7.04562 8.66667 7.11949V10.5H1.44444V3H7.40278C7.54643 2.99999 7.6842 2.94073 7.78578 2.83526L8.14689 2.46026C8.48812 2.10588 8.24645 1.5 7.76389 1.5H1.08333C0.485017 1.5 0 2.00367 0 2.625V10.875C0 11.4963 0.485017 12 1.08333 12H9.02778C9.62609 12 10.1111 11.4963 10.1111 10.875V6.74447C10.1111 6.24333 9.52765 5.99236 9.18642 6.34673Z" fill="#161DBC"/>
                                                    </svg>
                                                </a>
                                                <p class="fw-600 text-title-thin">{{ $mindanao->name }}</p>
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C15.31 2 18 4.69 18 8C18 12.5 12 19 12 19C12 19 6 12.5 6 8C6 4.69 8.69 2 12 2ZM19 22V20H5V22H19ZM8 8C8 5.79 9.79 4 12 4C14.21 4 16 5.79 16 8C16 10.13 13.92 13.46 12 15.91C10.08 13.47 8 10.13 8 8ZM10 8C10 6.9 10.9 6 12 6C13.1 6 14 6.9 14 8C14 9.1 13.11 10 12 10C10.9 10 10 9.1 10 8Z" fill="#62616A"/>
                                                            </svg>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <a href="https://maps.google.com/?q={{ $mindanao->address }}" target="_blank">
                                                            {{ $mindanao->address }}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-1">
                                                        <svg id="Layer_1" enable-background="new 0 0 512.021 512.021" height="16" viewBox="0 0 512.021 512.021" width="24" xmlns="http://www.w3.org/2000/svg">
                                                            <g>
                                                                <path d="m367.988 512.021c-16.528 0-32.916-2.922-48.941-8.744-70.598-25.646-136.128-67.416-189.508-120.795s-95.15-118.91-120.795-189.508c-8.241-22.688-10.673-46.108-7.226-69.612 3.229-22.016 11.757-43.389 24.663-61.809 12.963-18.501 30.245-33.889 49.977-44.5 21.042-11.315 44.009-17.053 68.265-17.053 7.544 0 14.064 5.271 15.645 12.647l25.114 117.199c1.137 5.307-.494 10.829-4.331 14.667l-42.913 42.912c40.482 80.486 106.17 146.174 186.656 186.656l42.912-42.913c3.838-3.837 9.361-5.466 14.667-4.331l117.199 25.114c7.377 1.581 12.647 8.101 12.647 15.645 0 24.256-5.738 47.224-17.054 68.266-10.611 19.732-25.999 37.014-44.5 49.977-18.419 12.906-39.792 21.434-61.809 24.663-6.899 1.013-13.797 1.518-20.668 1.519zm-236.349-479.321c-31.995 3.532-60.393 20.302-79.251 47.217-21.206 30.265-26.151 67.49-13.567 102.132 49.304 135.726 155.425 241.847 291.151 291.151 34.641 12.584 71.866 7.64 102.132-13.567 26.915-18.858 43.685-47.256 47.217-79.251l-95.341-20.43-44.816 44.816c-4.769 4.769-12.015 6.036-18.117 3.168-95.19-44.72-172.242-121.772-216.962-216.962-2.867-6.103-1.601-13.349 3.168-18.117l44.816-44.816z"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <a href="tel:{{ $mindanao->phone_number }}" target="_blank">
                                                            {{ $mindanao->phone_number }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#termsAndCondition').modal('show');
            $('#continue-btn').prop({'disabled': false});
        })
        function validateCheckbox() {
            // Check if the checkbox is not checked
            if (!document.getElementById('agree_checkbox_toc').checked) {
                $('#validation-message-terms').show();
                document.getElementById('agree_checkbox_toc').focus();
            }
            else {
                $('#agree_checkbox').prop({'checked':true});
                $('#validation-message-terms').hide();
                $('#termsAndCondition').modal('hide');
            }
            return false;
        }
        $('#agree_checkbox_toc').on('change', function () {
            $('#validation-message-terms').hide();
        })

        // $('#termsAndConditionsForm').submit(function (e) {
        //     if(!$('#termsAndCondition #agree_checkbox_toc').is(":checked")) {
        //         // $('#termsAndCondition #agree_checkbox_toc').prop({'required' : true});
        //         $('#validation-message-terms').css("display","block");
        //     }
        //     else {
        //         $('#validation-message-terms').hide();
        //         $('#termsAndCondition').modal('hide');

        //         $('#agree_checkbox').prop({'checked':true});
        //     }
        //     return false;
        // })
        var pscs = {!! str_replace("'", "\'", json_encode($pscs)) !!};
            var count = 0; // needed for safari
            let customer_data = '';



            window.onload = function() {
                $.get("{{ route('check_auth') }}", function(data, status) {
                    if (data == 1) {
                        // Do nothing
                    } else {
                        window.location = '{{ route('login.user') }}';
                    }
                });
            }

            setTimeout(function() {
                count = 1;
            }, 200);

            $(document).ready(function() {
                $('#start_timer').show();
                // $('#modalTimer').modal({backdrop: 'static', keyboard: false},'show');
                // $("input[type=radio]").prop('checked', true);
                // $(".online_payment").click(function() {
                //     $('#manual_payment_description').parent().addClass('d-none');
                // });
                $('#agree_checkbox2').prop('checked', true);
                togglePlaceOrder();
            });

            $('#modalTimer').on('hidden.bs.modal', function () {
                startTimer();
                $('#start_timer').hide();
            })


            function use_wallet() {
                $('input[name=payment_option]').val('wallet');
                if ($('#agree_checkbox').is(":checked") && $('#agree_checkbox').is(":checked") && $('#payment_option').val() && $('#payment_type').val()) {
                    $('#checkout-form').submit();
                } else {
                    if ($('#payment_option').val()) {
                        if(!$('#agree_checkbox').is(":checked") && !$('#agree_checkbox2').is(":checked")) {
                            AIZ.plugins.notify('danger', '{{ translate('You need to agree with our policies') }}');
                        }
                    } else {
                        AIZ.plugins.notify('danger', '{{ translate('Please select your payment option') }}');
                    }
                }
            }

            function submitOrder(el) {
                if($('#payment_type').val() == 'paynamics') {
                    if($('input[name="payment_channel"]:checked').length < 1) {
                        AIZ.plugins.notify('danger', '{{ translate('Please select your payment channel.') }}');
                        return;

                    }
                }


                // if($('input[name="inspection_note"]').val() == '') {
                //     AIZ.plugins.notify('danger', 'Please select your inspection type.');
                //     return;

                // }
            // $(el).prop('disabled', true);
            var psc_accounts = {!! str_replace("'", "\'", json_encode($psc_accounts)) !!};
                name         = $("input[name=customer_name]").val();
                address      = $("#customer_complete_address").val();
                mobile_num   = $("input[name=customer_mobile_number]").val();
                email_add    = $("input[name=customer_email_address]").val();
                tin_num      = $("input[name=customer_tin_number]").val();
                add_cost     = $("input[name=customer_add_cost]").val();

                var user_email = '{{ Auth::user()->email }}';
                if(psc_accounts.includes(user_email) || user_email == 'admin@worldcraft.com.ph') {

                    if (name === "" || address === "" || mobile_num === "" || email_add === "" || tin_num === "" || add_cost == "") {
                        AIZ.plugins.notify('danger', "Please complete all required fields for Customer Details");
                        return;
                    }
                    customer_data = {
                        'name' : name,
                        'address' : address,
                        'mobile' : mobile_num,
                        'email' : email_add,
                        'tin' : tin_num,
                        'add_cost' : add_cost
                    };
                }
                $('#customer_data').val(customer_data != null ? JSON.stringify(customer_data) : '');


                if(($('#payment_type').val() == 'other-payment-method' && $('#payment_option').val() == 'bank_transfer') && $('#proof_of_payment').val() == '') {

                    AIZ.plugins.notify('danger', 'Please upload your proof of payment to proceed your order.');
                        return;
                }


                if ($('#agree_checkbox').is(":checked") && $('#agree_checkbox2').is(":checked") && $('#payment_type').val()) {
                    $(el).prop('disabled', true);
                    $('#checkout-form').submit();
                } else {
                    if($('#payment_type').val() == '') {
                        AIZ.plugins.notify('danger', '{{ translate('Please select your payment option') }}');
                    }

                    // else if($('input[name="payment_channel"]:checked').length < 1) {
                    //     AIZ.plugins.notify('danger', '{{ translate('Please select your payment type') }}');
                    // }
                    else {
                        if ($('#agree_checkbox').not(":checked") && $('#agree_checkbox2').not(":checked")) {
                            AIZ.plugins.notify('danger', '{{ translate('You need to agree with our policies') }}');
                        }
                    }
                    $(el).prop('disabled', false);
                }
            }

            function toggleManualPaymentData(id) {
                $('#manual_payment_description').parent().removeClass('d-none');
                $('#manual_payment_description').html($('#manual_payment_info_' + id).html());
            }

            $("input[type='radio'][name='payment_channel']").click(function() {
                // hide steps in bank transfer
                $('#cop_container').hide();
                $('#bank_transfer_container').hide();
                var data = {
                    "_token": "{{ csrf_token() }}",
                    "payment_channel": $(this).val()
                }
                // console.log($(this).val())

                if($(this).val() != 'other-payment-method') {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('checkout.paynamics.additional_fee') }}',
                        data: data,
                        success: function(data) {
                            if (data.status == 1) {
                                var price = 0;
                                var overall_total = $('#overall_total').val();

                                if (data.rate == 'fixed') {
                                    price = data.price;
                                } else {
                                    price = (data.price / 100) * overall_total;
                                }

                                $('#paynamics_selected').show();
                                $("#paynamics_price_val").val(price.toFixed(2));
                                $('#paynamics_price').text('₱' + price.toFixed(2));

                                computeTotal();
                            }
                        }
                    });
                }
                else {
                }
                togglePlaceOrder();

                $('#submit-btn').addClass('btn-place-order');
                $('#submit-btn').removeClass('btn-place-order-disabled');
            });

            function togglePaynamics(id) {

                $('input[name="payment_channel"]').prop('checked',false)
                $('.payment-item').removeClass("active-payment");
                $('#payment_option').val(id);
                $('#paynamics').toggle(true);
                $('#other-payment-methods').toggle(false);
                $('#payment_type').val('paynamics');

                if ($('#payment_option').val() && $('#agree_checkbox').is(':checked')) {
                    $('#submit-btn').addClass('btn-place-order');
                    $('#submit-btn').removeClass('btn-place-order-disabled');
                }

                @foreach ($payment_methods as $key => $value)
                    var unique_id = "{{ $value->value }}"

                    if (id == unique_id) {
                    $('#' + unique_id).addClass("active-payment");
                    $('.' + unique_id).toggle(true);
                    }

                    else {
                    $('.' + unique_id).toggle(false);
                    }
                @endforeach

            }
            function togglePaymentMethod(id) {
                // alert(id);
                // hide steps in bank transfer
                $('#bank_transfer_container').hide();
                $('#cop_container').hide();
                $('#paynamics_selected').hide();
                $('#paynamics_price').text('0');
                $('#paynamics_price_val').val(0);
                $('input[name="payment_channel"]').prop('checked',false)
                removePaynamics();

                $('.payment-item').removeClass("active-payment");
                $('#payment_option').val(id);
                // $('#paynamics').toggle(false);
                $('#other-payment-methods').toggle(true);
                $('#payment_type').val('other-payment-method');

                @foreach ($other_payment_methods as $key => $value)
                    var unique_id = "{{ $value->unique_id }}"

                    if (id == unique_id) {
                    $('#' + unique_id).addClass("active-payment");
                    $('.' + unique_id).toggle(true);
                    }

                    else {
                    $('.' + unique_id).toggle(false);
                    $('.' + unique_id).removeClass('d-none')
                    }
                @endforeach

                if (id == "user-wallet") {
                    $('#payment_option').val('user-wallet')
                    $('#user-wallet').addClass("active-payment");
                    $('.pickup').toggle(false);
                    $('.bank-transfer').toggle(false);
                    $('.otc-deposit').toggle(false);
                    $('.gcash-qr').toggle(false);
                    $('.user-wallet').toggle(true);
                }


                // to display steps
                if(id == 'bank_transfer') {
                    $('#bank_transfer_container').show();
                    $('#cop_container').hide();
                }
                else if(id == 'cash_on_pickup') {
                    $('#cop_container').show();
                    $('#bank_transfer_container').hide();
                }
                else {
                    $('#cop_container').hide();
                    $('#bank_transfer_container').hide();
                }

                if(id == 'credit_card') {
                    $('#credit_card').addClass("active-payment");
                    $('.credit_card').toggle(true);
                }

                togglePlaceOrder();
                computeTotal();
                // if($('#service_type').val() != '') {
                //     toggleService($('#service_type').val(), $('#service_fee').val());
                // }
            }

            $('#agree_checkbox').on('change', togglePlaceOrder);
            aggree_checkBox = document.getElementById('agree_checkbox').addEventListener('click', event => {
                if(!event.target.checked) {
                    $('#termsAndCondition #agree_checkbox_toc').prop({'checked' : false});
                    $('#termsAndCondition').modal({backdrop: 'static', keyboard: false}, 'show')
                }
            });
            $('#agree_checkbox2').on('change', togglePlaceOrder);

            function togglePlaceOrder() {

                $('#submit-btn').addClass('btn-place-order-disabled');
                var _payment_option = $('#payment_option').val();
                var _cb1 = $('#agree_checkbox').is(':checked');
                var _cb2 = $('#agree_checkbox2').is(':checked');

                if(_payment_option != '' && _cb1 == true && _cb2 == true) {
                    $('#submit-btn').addClass('btn-place-order');
                    $('#submit-btn').removeClass('btn-place-order-disabled');
                }
                else {
                    $('#submit-btn').addClass('btn-place-order-disabled');
                }
            }


            $('#customer_add_cost').keyup(function () {
                var cost = $(this).val()
                var cost_val = 0;

                $('#additional_cost_container').hide();
                if (cost.length > 0) {
                    $('#additional_cost').val(cost)
                    if(parseFloat(cost) > 0) {
                        $('#additional_cost_container').show();
                        cost_val = parseFloat(cost);
                        document.getElementById('additional_cost_container_price').innerHTML = '₱' + cost_val.toFixed(2);
                    }
                } else {
                    $('#additional_cost').val(0)
                }
                // computeTotal();


                var additional_cost = parseFloat(document.getElementById('additional_cost').value);
                var paynamics_price = parseFloat(document.getElementById('paynamics_price_val').value);
                if(isNaN(paynamics_price)) {
                    paynamics_price = 0.00;
                }
                var overall_total = parseFloat(document.getElementById('overall_total').value);
                var total_price = additional_cost + paynamics_price + overall_total;

                document.getElementById('overall_total_display').innerHTML = '₱' + total_price.toFixed(2);
            });
    </script>

    <script>

        // var charges = $('#service_fee').val();

        // $('#cashOnPickupBtn').on('click', function (e) {
        //     $('input[name="payment_channel"]').prop("checked", false)
        //     togglePaymentMethod('');
        //     $('#cashOnPickupModal').modal('show');

        //     $('#payment_option').val('');
        //     $('#payment_type').val('');
        // })

        // *New*
        // function toggleService(service_selected, charges) {
        //     $('.service-item').removeClass("service-item-active");
        //     $('#' + service_selected).addClass("service-item-active");

        //     total_charges = parseFloat(charges);
        //     display_overall = parseFloat($('#overall_total').val())


        //     total_amount = parseFloat(display_overall + total_charges);
        //     // $('#overall_total_display').text('₱'+ total_amount.toFixed(2));
        //     $('#overall_total_display').text('₱'+ numberWithCommas(total_amount.toFixed(2)));
        //     $('input#service_type').val(service_selected);
        //     $('input#service_fee').val(total_charges.toFixed(2));


        //     if(parseFloat(charges) > 0) {
        //         $('#service').css('display','block');
        //         $('#service #service_fee_display').html('₱'+ $('input#service_fee').val());
        //     }
        //     else {
        //         $('#service').css('display','none');
        //         $('#service #service_fee_display').html('₱'+ $('input#service_fee').val());
        //     }
        // }
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>

    <script>
        $('#region_code').on('change', function () {
            var region_code = $(this).val();

            $('#province_code').empty();

            $.ajax({
                type : 'GET',
                url : '{{ route("get-province") }}',
                data : {'region_code' : region_code},
                success: function (response) {
                    $.each(response, function (k,v) {
                        $('#province_code').append("<option value='"+v.provCode+"'>"+v.provDesc+"</option>")
                    })
                },
            })
        })
        $('#province_code').on('change', function () {

            var province_code = $(this).val();

            $('#city_code').empty();

            $.ajax({
                type : 'GET',
                url : '{{ route("get-city") }}',
                data : {'province_code' : province_code},
                success: function (response) {
                    $.each(response, function (k,v) {
                        $('#city_code').append("<option value='"+v.citymunCode+"'>"+v.citymunDesc+"</option>")
                    })
                },

            })
        })
        $('#city_code').on('change', function () {
            var city_code = $(this).val();

            $('#brgy_code').empty();

            $.ajax({
                type : 'GET',
                url : '{{ route("get-barangay") }}',
                data : {'city_code' : city_code},
                success: function (response) {
                    $.each(response, function (k,v) {
                        $('#brgy_code').append("<option value='"+v.brgyCode+"'>"+v.brgyDesc+"</option>")
                    })
                },
            })
        })

        $("input[name='payment_channel']").on('change', function () {
            var _payment_option = $(this).data('payment-option');
            if(_payment_option == 'credit_card') {

                $('input#payment_option').val(_payment_option)
                $('input#payment_type').val('other-payment-method')
            }
            else {

                $('input#payment_option').val(_payment_option)
                $('input#payment_type').val('paynamics')
            }



            $('#other-payment-methods').toggle(false);
            $('.payment-item').removeClass("active-payment");
        })
    </script>
    <script>
        let timer;
        let timeInSeconds = 301; // Initial time in seconds (5 minutes)

        const display = document.getElementById('display');

        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            return `${minutes.toString().padStart(2, '0')}:${remainingSeconds.toString().padStart(2, '0')}`;
        }

        function updateDisplay() {
            display.textContent = formatTime(timeInSeconds);
        }

        function startTimer() {
            timer = setInterval(function () {
                timeInSeconds--;
                if (timeInSeconds < 0) {
                    clearInterval(timer);
                    // alert("Time's up!");

                    $('#modalTimer').modal({backdrop: 'static', keyboard: false},'show');
                    $('#modalTimer #extension').show();
                } else {
                    updateDisplay();
                }
            }, 1000);
        }

        function extendTime() {
            timeInSeconds += 301; // Extend time by 1 minute
            updateDisplay();
        }

        $('#start_timer_btn').on('click', function () {
            $('#modalTimer').modal('hide');
        })

        $('#reset_timer_btn').on('click', function () {
            extendTime();
            $('#start_timer').hide();

            $('#modalTimer').modal('hide');
        })
        function backToCart() {
            $('#reset_timer_btn').prop('disabled', true);
            window.location.href = '{{ route('cart.index') }}';
        }
    </script>

    <script>
        $('#continue-btn').on('click', function () {

        })


        $(document).ready(function() {
            $('#buyer_representative').change(function() {
                $('#inspection_note').val('')
                if ($(this).is(':checked')) {
                    value_ch = $(this).data('value')
                    $('#wc_representative').prop('checked', false);
                    $('#inspection_note').val(value_ch)
                }
            });

            $('#wc_representative').change(function() {
                $('#inspection_note').val('')
                if ($(this).is(':checked')) {
                    value_ch = $(this).data('value')
                    $('#buyer_representative').prop('checked', false);
                    $('#inspection_note').val(value_ch)
                }
            });
        });
    </script>

@endsection
