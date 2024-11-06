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

    <div class="container">
        <div class="col-xxl-8 col-xl-10 mx-auto">
            {{-- Shipping Address --}}
            <div class="card shadow-none border-0 d-flex align-items-center justify-content-center">
                <div class="card-body shadow p-3 mb-5 bg-body rounded">
                    <div class="d-flex justify-content-start border-bottom">
                        <div class="card-customer-wallet-title">
                            Shipping / Home Address
                        </div>
                    </div>
                    <div class="mt-2 d-flex justify-content-between align-items-center gap-2 flex-wrap">
                        <div class="address_container">
                            <div id="customer_name" class="fs-16 fw-600 text-uppercase">
                                Worldcraft Admin
                            </div>
                            <div id="customer_phone" class="fw-600">
                                09954956590
                            </div>
                            <div id="customer_address">
                                B1 L13 PHASE 2 AREA 2 SITE 8, North Bay Blvd., South, CITY OF NAVOTAS, NCR, THIRD DISTRICT
                                1416
                            </div>
                        </div>
                        <div>
                            <a class="link-blue" href="#" id="changeAddress" style="color: #1B1464">
                                <strong>Change</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Services --}}
            <div class="card shadow-none border-0 align-items-center justify-content-center">
                <div class="card-body shadow p-3 mb-5 bg-body rounded">
                    <div class="d-flex justify-content-start border-bottom">
                        <div class="card-customer-wallet-title">
                            Services
                        </div>
                    </div>
                    <div class="mt-2 container">
                        <div class="row">

                            <div class="service-item col-12 ml-0 mb-2"
                                id="in_store_pickup">
                                <div class="service-item col-12 ml-0 mb-2" onclick="toggleService('in_store_pickup','0.00')" id="in_store_pickup">
                                    <div class="row align-items-center">
                                        <div class="col-9">
                                            <h6><strong>In Store Pickup</strong></h6>
                                            {{-- <small>&nbsp;</small> --}}
                                            <small>Pickup Point: {{ ucwords(str_replace('_',' ',Session::get('session_cart')[0]['pickup_location'])) }}</small>
                                        </div>
                                        <div class="col-3">
                                            <h6 class="text-right">
                                                <strong>₱0</strong>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="service-item col-12 ml-0 mb-2" id="in_house_delivery"
                                onclick="toggleService('in_house_delivery','900.00')">
                                <div class="pickup-option row align-items-center">
                                    <div class="col-1">
                                        <input type="radio" name="pickup_option" id="pickup_option_1" class="radio-input">
                                    </div>
                                    <div class="col-8">
                                        <label for="pickup_option_1" class="d-block">
                                            <h5><strong>In House Delivery</strong></h5>
                                            <small>Delivered within 3-5 working days (Order up to a weight of 1,000 kg.)</small>
                                        </label>
                                    </div>
                                    <div class="col-3 text-right">
                                        <h6 class="text-right">
                                            <strong>₱ 900.00</strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="service-item col-12 ml-0 mb-2 d-none" onclick="toggleService('third_party','0.00')"
                                id="third_party">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        <h6><strong>3rd Party Logistics</strong></h6>
                                        <small>Book your own provider</small>
                                    </div>
                                    <div class="col-3">
                                        <h6 class="text-right">
                                            <strong>₱0</strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Button --}}
            <div class=" mb-5 row align-items-center">
                <div class="col-xxl-12 col-xl-12 d-flex mt-4">
                    <div class="col-xxl-6 col-xl-6 d-flex justify-content-start pl-0">
                        <a href="" class="link-back-cart d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg> &nbsp;
                            Back to cart
                        </a>
                    </div>
                    <div class="col-xxl-6 col-xl-6 d-flex justify-content-end pr-0">
                        <button type="submit" class="btn btn-primary p-2 fw-bold" id="submitBtn">
                            Continue to Payment
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
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
        if(allow_service == 'd-none') {
            toggleService('in_store_pickup','0.00');
        }
    }, 100);

    var user_address_count = '{{ count($user_address) }}';
    var delivery_id = 0;
    if(user_address_count <= 0) {
        $('#addDeliveryAddress').modal({backdrop: 'static', keyboard: false}, 'show');
    }

    $('#set-as-default').on('change', function() {
        if($(this).is(':checked')) {
            $('input[name="is_default"]').val('1');
        }
        else {
            $('input[name="is_default"]').val('0');
        }
    })


    $(document).ready(function () {

        @if (Session::has('new_added_delivery'))
            $('#changeAddress').trigger('click');
        @endif
    })
    $('#changeAddress').on('click', function () {
        @if(Session::has("delivery_address"))
            $('#delivery_address_id').val('{{ Session::get("delivery_address")["id"] }}')
        @endif

        $('#add_new_address').hide();
        $('#addressContainer').html('<div class="c-preloader text-center p-3"><i class="las la-spinner la-spin la-3x"></i></div>');

        $('#changeShippingAddress').modal({backdrop: 'static', keyboard: false}, 'show');
        $.ajax({
            type : 'GET',
            url  : '{{ route("checkout.get.shipping-address") }}',
            data : {'user_id' : '{{ auth()->user()->id }}'},
            success: function (response) {
                $('#addressContainer').html(response);
                $('#add_new_address').show();
            }
        })
        return false;
    })
    $('#add_new_address').on('click', function () {
        $('#changeShippingAddress').css('display','none')
        // $('#changeShippingAddress').modal('hide')
        $('#addDeliveryAddress input[name="is_default"]').val('0');
        $('#set-as-default').prop({'checked' : false})
        $('#addDeliveryAddress').modal({backdrop: 'static', keyboard: false}, 'show');
    });
    $('#cancelAddingAddress').on('click', function () {
        $('#changeShippingAddress').css('display','block')
        // $('#changeShippingAddress').modal('show')
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
        service_type_selected = '{{ Session::get("service")["service_type"] }}';
        service_charges = '{{ Session::get("service")["service_fee"] }}';
        toggleService(service_type_selected, service_charges)
    @endif

    function editAddress(id) {
        $('#edit_my_shipping_address button:submit').prop('disabled', true)
        $('#changeShippingAddress').css('display','none')
        $('#editAddressContainer').html('<div class="c-preloader text-center p-3"><i class="las la-spinner la-spin la-3x"></i></div>');
        $('#edit_my_shipping_address button:submit').html('Save');

        $.ajax({
            type : 'GET',
            url  : '{{ route("view.shipping.address") }}',
            data : {'delivery_id' : id},
            success: function (response) {
                $('#editAddressContainer').html(response);
            },
            error: function (err) {
                $('#editAddressContainer').html('Something went wrong.');
            }
        })

        $('#editShippingAddress').modal({backdrop: 'static', keyboard: false}, 'show');

        setTimeout(() => {
        }, 3000);
    }
    $('#cancel_edit_address').on('click', function () {
        $('#editShippingAddress').modal('hide');
        $('#changeShippingAddress').css('display','block');
    })
    function toggleService(service_selected, charges) {

        $('#submitBtn').attr('disabled', true);
        $('.service-item').removeClass("service-item-active");
        $('#' + service_selected).addClass("service-item-active");


        $.ajax({
            type : 'POST',
            url  : '{{ route('checkout.selected_service') }}',
            data : {
                "_token" : '{{ csrf_token() }}',
                "type"   : service_selected,
                "fee"    : charges
            },
            success: function (response) {
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
    $(document).on('submit','#edit_my_shipping_address', function (e) {
        e.preventDefault();

        $('#edit_my_shipping_address button:submit').prop('disabled', true);
        $('#edit_my_shipping_address button:submit').html('Saving...');
        var element = document.getElementById('edit_my_shipping_address');
        var form_data = new FormData(element);
        $.ajax({
            type : 'POST',
            url  : '{{ route("save.shipping.address") }}',
            processData: false,
            contentType: false,
            cache: false,
            data : form_data,
            success: function (response) {
                AIZ.plugins.notify('success', response.message);
                if(response.reload_page == true) {
                    location.reload();
                }
                else {
                    $('#editShippingAddress').modal('hide');
                    $('#changeShippingAddress').css('display','block');
                    $('#changeAddress').trigger('click');
                }
            },
            error : function (error) {
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
    $('#region_code').on('change', function () {
        var region_code = $(this).val();

        $('#province_code').empty();
        $('#province_code').append("<option value='' hidden selected>Select province...</option>")

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
        $('#city_code').append("<option value='' hidden selected>Select city...</option>")

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
        $('#brgy_code').append("<option value='' hidden selected>Select barangay...</option>")

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
</script>
@endsection
