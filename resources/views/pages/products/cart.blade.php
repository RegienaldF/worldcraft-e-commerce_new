@extends('master')

@section('index')
<!-- Page Banner Section Start -->
<div class="section page-banner-section m-0 p-0" style="background-color: #FAEDCE;">
    <h2 class="title ms-5" style="color: black;">Cart Menu</h2>
</div>
<!-- Page Banner Section End -->

<!-- Shopping Cart Section Start -->
<div class="section section-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="cart-wrapper">
                    <!-- Cart Wrapper Start -->
                    <div class="card">
                        <div class="card-body">
                            <div class="cart-table table-responsive">
                                @php
                                $groupedCarts = $carts->groupBy('name');
                                @endphp

                                @foreach ($groupedCarts as $warehouse => $cartItems)
                                <table id="cart-table" class="table mt-5" data-warehouse-id="{{ $warehouse }}">
                                    <thead>
                                        <hr>
                                        <div class="text-uppercase d-flex justify-content-between mt-5">
                                            <span style="border-bottom: 2px solid black; color: black;">
                                                <input class="form-check-input warehouse-checkbox" type="checkbox"
                                                    {{-- data-warehouse-id="{{ $warehouse }}" --}}
                                                    id="warehouse_{{ $warehouse }}"
                                                    onclick="total_cart_price()">
                                                &nbsp; Warehouse Location: {{ str_replace('_', ' ', $warehouse) }}
                                            </span>
                                            <div>
                                                <a href="#" class="btn btn-outline-danger">Clear Cart</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <tr>
                                            <th style="width: 5%;" class="product-action"></th>
                                            <th style="width: 10%;" class="product-thumb">Image</th>
                                            <th style="width: 10%;" class="product-info">Product Information</th>
                                            <th style="width: 10%;" class="product-action">Unit Price</th>
                                            <th style="width: 10%;" class="product-quantity">Quantity</th>
                                            <th style="width: 10%;" class="product-total-price">Sub-Total</th>
                                            <th style="width: 5%;" class="product-action">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($cartItems as $cart)
                                        <tr>
                                            <td class="product-action">
                                                <center>
                                                    <input
                                                        class="form-check-input item-checkbox warehouse_{{ $warehouse }}"
                                                        type="checkbox" id="item_{{ $cart->id }}"
                                                        data-cart-id="{{ $cart->id }}"
                                                        data-warehouse-id="{{ $warehouse }}"
                                                        {{-- data-item-name="{{ $cart->item_name }}"
                                                        data-sku="{{ $cart->sku }}"
                                                        data-quantity="{{ $cart->quantity }}"
                                                        data-unit-price="{{ $cart->unit_price }}"
                                                        data-subtotal="{{ $cart->unit_price * $cart->quantity }}" --}}
                                                        onclick="total_cart_price()">
                                                </center>
                                            </td>
                                            <td class="product-thumb">
                                                <img src="{{ asset('worldcraft/icons/no-image-wc.jpg') }}"
                                                    alt="Product Image">
                                            </td>
                                            <td class="product-info">
                                                <h6 class="name">{{ $cart->item_name }}</h6>
                                                <div class="product-sku">SKU: {{ $cart->sku }}</div>
                                            </td>
                                            <td class="product-info">
                                                <span class="price">&#8369;
                                                    {{ number_format($cart->unit_price, 2) }}</span>
                                            </td>
                                            <td class="quantity">
                                                <div class="product-quantity d-inline-flex">
                                                    <button type="button" class="sub" {{--
                                                        onclick="sub_qty('{{ $cart->sku }}')">-</button> --}}
                                                    onclick="updateQuantity(`{{ $cart->id }}`,`{{ $cart->sku }}`, `{{
                                                    $cart->location_id }}`, `remove`)">-</button>
                                                    <input type="text" id="quantity_{{ $cart->id }}"
                                                        value="{{ $cart->quantity }}" readonly />
                                                    <button type="button" class="add" {{--
                                                        onclick="add_qty('{{ $cart->sku }}')">+</button> --}}
                                                    onclick="updateQuantity(`{{ $cart->id }}`,`{{ $cart->sku }}`, `{{
                                                    $cart->location_id }}`, `add`)">+</button>
                                                </div>
                                            </td>
                                            <td class="product-total-price">
                                                {{-- <span id="subtotal_{{ $cart->sku }}"
                                                    class="price subtotal-price">&#8369; --}}
                                                    <span id="subtotal_{{ $cart->id }}" class="price subtotal-price">
                                                        &#8369; {{ number_format($cart->unit_price * $cart->quantity, 2)
                                                        }} </span>
                                                    <input type="hidden" id="unit_price_{{ $cart->sku }}"
                                                        value="{{ $cart->unit_price }}">
                                            </td>
                                            <td class="product-action">
                                                <a href="#" onclick="delete_cart_item()" class="remove del-info"
                                                    data-cart_id="{{ $cart->id }}"><i class="pe-7s-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Cart Wrapper End -->

                    <!-- Cart btn Start -->
                    <div class="cart-btn">
                        <div class="left-btn">
                            <a href="{{ route('index') }}" class="btn btn-outline-dark btn-hover-primary">Continue Shopping</a>
                        </div>

                    </div>
                    <!-- Cart btn Start -->
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <!-- Cart Totals Start -->
                <div class="card">
                    <div class="card-body">
                        <div class="cart-totals">
                            <div class="cart-title">
                                <h4 class="title">Cart totals</h4>
                            </div>
                            <div class="cart-total-table">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p class="value">Total</p>
                                            </td>
                                            <td>
                                                <p class="price" id="total-cart-price">&#8369; 0.00</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-total-btn">
                                <button type="button" class="btn btn-dark btn-hover-primary btn-block proceed-shipping"
                                    onclick="checkout(this)">Proceed To
                                    Shipping</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Cart Totals End -->
            </div>
        </div>
    </div>
</div>
<!-- Shopping Cart Section End -->
@endsection

@section('script')
<script>
    // delete cart item
        function delete_cart_item() {
            $('.cart-table').on('click', '.del-info', function(e) {
                e.preventDefault();
                const cart_id = $(this).data('cart_id');
                const rowToDelete = $(this).closest('tr');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('cart.delete') }}",
                            type: "POST",
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: cart_id
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted',
                                    'Item has been removed from your cart!',
                                    'success'
                                );
                                // location.reload(true);
                                rowToDelete.remove();

                            },
                            error: function(xhr, status, error) {
                                console.error(xhr);
                            }
                        });
                    }
                });
            });
        }

        // passing the value of checkbox subtotal
        function total_cart_price() {
            let total = 0;
            $('input[type=checkbox].item-checkbox').each(function() {
                if (this.checked) {
                    cart_id = $(this).data('cart-id');
                    subtotal = $('#subtotal_' + cart_id).text();
                    subtotal = parseFloat(subtotal.replace(/[₱, ]/g, ''));
                    total += subtotal;
                }
            });
            console.log(total);
            document.getElementById('total-cart-price').innerText = `₱ ${total.toFixed(2)}`;
            // console.log(total);
        }

        // function for quantity update and subtotal
        function updateQuantity(cart_id, sku, location_id, status) {
            var input_qty_id = '#quantity_' + cart_id;
            var quantity = $(input_qty_id).val();
            quantity = parseInt(quantity);

            var unit_price = parseFloat($('#unit_price_' + sku).val());
            // var new_subtotal = unit_price * quantity;
            var original_subtotal = unit_price * quantity;;

            if (status === 'add') {
                quantity += 1;
            } else {
                if (quantity > 0) {
                    quantity -= 1;
                    if (quantity < 1) {
                        alert('Quantity cannot be zero or else remove the item  from your cart.');
                        return;
                    }
                }
            }

            $(input_qty_id).val(quantity);

            // var unit_price = parseFloat($('#unit_price_' + sku).val());
            var new_subtotal = unit_price * quantity;
            $('#subtotal_' + cart_id).text('₱ ' + new_subtotal.toFixed(2));

            $.ajax({
                url: '{{ route('cart.update') }}',
                method: 'POST',
                data: {
                    sku: sku,
                    quantity: quantity,
                    user_id: '{{ Auth::user()->id }}',
                    location_id: location_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        console.log('Quantity updated successfully.');
                    }
                    else if (response.status === 'fail' && response.message === 'The maximum quantity of this product has been reached. Please check available stock.')
                    {
                        // Set quantity to available stock if it exceeds maximum
                        var maxQuantity = response.available_stock;
                        $(input_qty_id).val(maxQuantity);

                        $('#subtotal_' + cart_id).text('₱ ' + original_subtotal.toFixed(2));
                        alert('The maximum quantity of this product has been reached.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }


        // Listen for warehouse checkbox changes
        document.querySelectorAll('.warehouse-checkbox').forEach(function(warehouseCheckbox) {
            warehouseCheckbox.addEventListener('change', function() {
                const warehouseId = this.id.split('_')[1];
                const warehouseTable = document.querySelector(`table[data-warehouse-id="${warehouseId}"]`);
                const itemCheckboxes = warehouseTable.querySelectorAll('.item-checkbox');

                itemCheckboxes.forEach(function(itemCheckbox) {
                    itemCheckbox.checked = warehouseCheckbox.checked;
                });

                total_cart_price();
            });
        });

        // Listen for item checkbox changes within each warehouse table
        document.querySelectorAll('.item-checkbox').forEach(function(itemCheckbox) {
            itemCheckbox.addEventListener('change', function() {
                const warehouseId = this.dataset.warehouseId;
                const warehouseTable = document.querySelector(`table[data-warehouse-id="${warehouseId}"]`);
                const warehouseCheckbox = document.getElementById('warehouse_' + warehouseId);
                const allItems = warehouseTable.querySelectorAll('.item-checkbox');
                const checkedItems = warehouseTable.querySelectorAll('.item-checkbox:checked');

                // If all items are checked, check the warehouse checkbox, else uncheck it
                warehouseCheckbox.checked = allItems.length === checkedItems.length;
                total_cart_price();
            });
        });




        // proceed to shipping function
        function checkout(el) {
            el.disabled = true;
            var checkout_cart = [];
            $('input[type=checkbox].item-checkbox').each(function() {
                if (this.checked) {
                    cart_id = $(this).data('cart-id');
                    cart_whse = $(this).data('warehouse-id');

                    // item_name, sku, quantity, unit_price, subtotal
                    // var item_name = $(this).data('item-name');
                    // var sku = $(this).data('sku');
                    // var quantity = $(this).data('quantity');
                    // var unit_price = $(this).data('unit-price');
                    // var subtotal = $(this).data('subtotal');

                    checked_cart = {
                        'id': cart_id,
                        'pickup_location': cart_whse

                        // 'item_name': item_name,
                        // 'sku': sku,
                        // 'quantity': quantity,
                        // 'unit_price': unit_price,
                        // 'subtotal': subtotal
                    }

                    checkout_cart.push(checked_cart);
                }
            });
            if (checkout_cart.length < 1) {
                el.disabled = false;
                alert('You do not have any items to purchase.');
                return;
            }
            $.ajax({
                type: 'POST',
                url: '{{ route('proceed.to.shipping') }}',
                data: {
                    checkout_cart: checkout_cart,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response == 1) {
                        location.href = '{{ route('get_shipping_info') }}';
                        console.log('redirect to shipping page');
                    } else {
                        el.disabled = false;
                    }
                },
                error: function(error) {
                    el.disabled = false;
                }
            })
            console.log(cart_ids);
        }
</script>
@endsection
