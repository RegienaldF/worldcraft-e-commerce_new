

@php
    $shipping_data = Session::get('shipping_info');
    $service_data = Session::get('service');
@endphp

<div class="card">
    <div class="bg-white p-3 p-lg-4 rounded text-left">
        @if ($service_data['service_type'] == 'in_house_delivery')
            <div class="summary_header mb-3">
                <div class="fw-700 fs-16 " style="color:#0C0736;">{{ translate('Shipping Details') }}</div>
            </div>
            <div class="summary-body mb-0">
                <div class="fw-600 fs-14 lh-21">{{ translate('Address:') }}</div>
                <div>{{ $shipping_data['address'] . ', ' . $shipping_data['city'] . ', ' . $shipping_data['province_code'] . ', ' . $shipping_data['postal_code'] }}</div>
                <hr>
                <div class="fw-600 fs-14 lh-21">{{ translate('Service:') }}</div>
                <div>{{ ucwords(str_replace('_',' ',$service_data['service_type'])) }}</div>
            </div>
        @else
            <div class="summary_header mb-3">
                <div class="fw-700 fs-16 " style="color:#0C0736;">{{ ucwords(str_replace('_',' ',$service_data['service_type'])) }}</div>
            </div>
            <div class="summary-body mb-0">
                <div class="fw-600 fs-14 lh-21">{{ translate('Pickup Point:') }}</div>
                <div>
                    {{-- {{ ucwords(str_replace('_',' ', Session::get('toCheckout')[0]->pickup_location)) }} --}}
                </div>
                <div>
                    @php
                        $pup_name = ucwords(str_replace('_',' ', Session::get('toCheckout')[0]->pickup_location));

                        $pup = \App\Models\PickupPoint::where('name', $pup_name)->first();
                    @endphp
                    {{ $pup->address }}
                </div>
            </div>

        @endif
    </div>
</div>
<div class="card">
    <div class="bg-white p-3 p-lg-4 rounded text-left">
        <div class="summary_header">
            @php
                $total_price = 0;
                $total_point = 0;
                $handling_fee = 0;
                $pickup_location = [];
                $handlingFee = 0;
                $iterateValue = 0;
                $items = 0;

                $service_fee = (double) Session::get('service')['service_fee'];
            @endphp

            @foreach (Session::get('toCheckout') as $key => $all_orders)
                @php
                    $items++;
                    $product = \App\Models\Products::find($all_orders->id);

                    $total_point += $product->earn_point * $all_orders->quantity;

                    $total_price += ($all_orders->price + $all_orders->tax) * $all_orders->quantity;

                    if (in_array($all_orders->pickup_location, $pickup_location)) {

                    } else {
                        array_push($pickup_location, $all_orders->pickup_location);
                    }
                @endphp
            @endforeach

            {{-- @foreach ($pickup_location as $location)
                @foreach (Session::get('handlingFee') as $key => $itemStore)
                    @php
                        if (strtolower(str_replace(' ', '_', $itemStore->name)) == $location) {
                            $handlingFee += $itemStore->handling_fee;
                        }
                    @endphp
                @endforeach
            @endforeach --}}

            @php
                $overall_total = $total_price + $handlingFee + $service_fee;
                // echo $overall_total;
            @endphp

            <div class="fs-14 fw-600 float-right p-1 pl-2 pr-2" style="border: 1px solid #C2CBD7; background:#F2F5FA">
                {{ $items }} {{ translate('Item(s)') }}</div>
            <div class="fw-700 fs-24 " style="color:#0C0736;">{{ translate('Summary') }}</div>
        </div>
        <div class="summary-body">
            <div class="fw-400 fs-14 lh-21 float-right">{{ single_price($total_price) }}</div>
            <div class="fw-600 fs-14 lh-21">{{ translate('Subtotal') }}</div>

            @if($service_fee > 0)
                <hr>

                <div id="service">
                    <div class="fw-400 fs-14 lh-21 float-right" id="service_fee_display">{{ single_price($service_fee) }}</div>
                    <div class="fw-600 fs-14 lh-21">{{ translate('Delivery Fee') }}</div>
                </div>
            @endif

            <div id="additional_cost_container" style="display: none;">
                <hr>
                <div class="fw-400 fs-14 lh-21 float-right" id="additional_cost_container_price"></div>
                <div class="fw-600 fs-14 lh-21">{{ translate('Additional Cost') }}</div>
            </div>
            <div id="paynamics_selected" style="display: none;">
                <hr>
                <input type="hidden" id="paynamics_price_val">
                <div class="fw-400 fs-14 lh-21 float-right" id="paynamics_price"></div>
                <div class="fw-600 fs-14 lh-21">{{ translate('Convenience Fee') }}</div>
            </div>
            <hr>
            @if (Session::has('coupon_id'))

                @php

                    $coupon_discount = Session::get('coupon_discount');
                    $coupon_id = Session::get('coupon_id');
                    $coupon = App\Models\Coupon::find($coupon_id);

                    // $coupon_discount = 0;
                    // if($coupon->type == 'cart_base') {
                    //     if($coupon->discount_type == 'percent') {
                    //         $coupon_discount = ($total_price * $coupon->discount) / 100;
                    //     }
                    //     else {
                    //         $coupon_discount = $total_price - $coupon->discount;
                    //     }
                    // }
                    // else {
                    //     $coupon_discount = Session::get('coupon_discount');

                    //     $coupon_details = json_decode($coupon->details);
                    //     try {
                    //         $coupon_discount = 0;
                    //         foreach (Session::get('toCheckout') as $key => $cartItem) {
                    //             foreach ($coupon_details as $coupon_detail) {
                    //                 if ($coupon_detail->product_id == $cartItem->id) {
                    //                     if ($coupon->discount_type == 'percent') {
                    //                         $coupon_discount += $cartItem->price * (int) $cartItem->quantity * $coupon->discount / 100;
                    //                     } else if ($coupon->discount_type == 'amount') {
                    //                         $coupon_discount += $coupon->discount;
                    //                     }
                    //                 }
                    //             }
                    //         }
                    //     } catch (\Throwable $th) {
                    //     }
                    // }
                @endphp
                {{-- <div class="fw-400 fs-14 lh-21 float-right">{{ single_price(Session::get('coupon_discount')) }}</div> --}}
                <div class="fw-400 fs-14 lh-21 float-right">{{ single_price($coupon_discount) }}</div>
                <div class="fw-600 fs-14 lh-21">{{ translate('Coupon Discount') }}</div>
                <hr>
                @php
                    // $overall_total -= Session::get('coupon_discount');
                    $overall_total -= $coupon_discount;
                @endphp
            @endif

            <input type="hidden" id="overall_total" value="{{ $overall_total }}">
            <div class="fw-600 fs-16 lh-21 float-right" id="overall_total_display" style="color:#D71921">{{ single_price($overall_total) }}</div>
            <div class="fw-600 fs-14 lh-21">{{ translate('Total') }}</div>

        </div>
        <div class="summary-footer">
            @if (Session::has('coupon_discount'))
                <div class="mt-3">
                    <form class="" action="{{ route('checkout.remove_coupon_code') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <div class="form-control">{{ \App\Models\Coupon::find(Session::get('coupon_id'))->code }}</div>
                            <div class="input-group-append">
                                <button type="submit"
                                    class="btn btn-primary">{{ translate('Change Coupon') }}</button>
                            </div>
                        </div>
                    </form>
                    <div class="my-3 mx-auto coupon-description-bg">
                        <div>
                            <strong>
                                Coupon Description:
                            </strong>
                            {{ \App\Models\Coupon::find(Session::get('coupon_id'))->description }}
                        </div>
                        <div class="my-2">
                            <strong>
                                Discount:
                            </strong>

                            @if (\App\Models\Coupon::find(Session::get('coupon_id'))->discount_type == 'amount')
                                ₱
                            @endif

                            {{ \App\Models\Coupon::find(Session::get('coupon_id'))->discount }}

                            @if (\App\Models\Coupon::find(Session::get('coupon_id'))->discount_type == 'percent')
                                {{ '%' }}
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-3">
                    @if(Auth::user()->user_type != 'dealer')


                    @endif
                    <form class="" action="{{ route('checkout.apply_coupon_code') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-craft fs-26 lh-24 fw-400" name="code"
                                placeholder="{{ translate('Enter coupon code') }}" required>
                            <div class="input-group-append">
                                <button type="submit" style="position:absolute;height: 50px;top: 0;right: 0px;"
                                    class="btn btn-dark border-0 rounded-0" style="">
                                    {{ translate('Apply') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function computeTotal () {
        var additional_cost = parseFloat(document.getElementById('additional_cost').value);
        var paynamics_price = parseFloat(document.getElementById('paynamics_price_val').value);
        if(isNaN(paynamics_price)) {
            paynamics_price = 0.00;
        }
        var overall_total = parseFloat(document.getElementById('overall_total').value);
        var total_price = additional_cost + paynamics_price + overall_total;
        var formatted_price = '₱' + addCommas(total_price.toFixed(2));

        document.getElementById('overall_total_display').innerHTML = formatted_price;
    }

    function removePaynamics () {
        document.getElementById('overall_total_display').innerHTML = "{{ single_price($overall_total) }}"
    }
    function addCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>
