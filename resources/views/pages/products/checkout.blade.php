@extends('master')
@section('index')
<!-- Page Banner Section Start -->
<div class="section page-banner-section m-0 p-0" style="background-color: #FAEDCE;">
    <h2 class="title ms-5" style="color: black;">Checkout Products</h2>
</div>
<!-- Page Banner Section End -->

<!-- Checkout Section Start -->
<div class="section">
    <div class="container">
        <form id="checkoutForm">
            <div class="row">
                <div class="col-lg-7">
                    <!-- Checkout Form Start -->
                    <div class="checkout-form">
                        <div class="checkout-title">
                            <h4 class="title">Billing details</h4>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="single-form">
                                    <input type="text" placeholder="First name *" name="firstname" id="firstname" value="<?php //echo htmlspecialchars($firstname); ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="single-form">
                                    <input type="text" placeholder="Last name *" name="lastname" id="lastname" value="<?php //echo htmlspecialchars($lastname); ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="single-form">
                                    <input type="text" placeholder="Tin ID" name="tin_id" id="tin_id" value="<?php //echo htmlspecialchars($tin_id); ?>" readonly>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="single-form">
                                    <label class="form-label">Street address *</label>
                                    <input type="text" placeholder="House number and street name" name="home_address" id="home_address" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="single-form">
                                    <input type="text" placeholder="Town / City *" name="town_city" id="town_city" value="<?php //echo $selectedWarehouseName?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="single-form">
                                    <input type="text" placeholder="Phone *" name="phone_num" id="phone_num" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="single-form">
                                    <input type="text" placeholder="Email address *" name="username" id="username" value="<?php //include 'session_login.php'; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="single-form checkout-note">
                            <label class="form-label">Order notes</label>
                            <textarea placeholder="Notes about your order, e.g. special notes for delivery." name="order_notes" id="order_notes"></textarea>
                        </div>
                    </div>
                    <!-- Checkout Form End -->
                </div>
                <div class="col-lg-5">
                    <div class="checkout-order">
                        <div class="checkout-title">
                            <h4 class="title">Your Order</h4>
                        </div>
                        <div class="checkout-order-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="Product-name">Product</th>
                                        <th class="Product-price">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //foreach ($items as $item) : ?>
                                        <tr>
                                            <td class="Product-name">
                                                <p><?php //echo $item['product_name'] . ' ( <span class="quantity">' . $item['quantity'] . '</span> '; ?>pc/s )</p>
                                            </td>
                                            <td class="Product-price">
                                                <p><?php //echo '$' . number_format($item['total_price'], 2); ?></p>
                                            </td>
                                        </tr>
                                    <?php //endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="Product-name">
                                            <p>Subtotal</p>
                                        </td>
                                        <td class="Product-price">
                                            <p><?php //echo '$' . number_format($grand_total, 2); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="Product-name">
                                            <p>Shipping</p>
                                        </td>
                                        <td class="Product-price">
                                            <ul class="shipping-list">
                                                <li class="radio">
                                                    <input type="radio" name="shipping" id="radio2" value="Free Shipping">
                                                    <label for="radio2"><span></span>In House Delivery</label>
                                                </li>
                                                <li class="radio">
                                                    <input type="radio" name="shipping" id="radio3" value="Local Pickup">
                                                    <label for="radio3"><span></span>In Store Pickup &nbsp;&nbsp;&nbsp;</label>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="Product-name">
                                            <p>Total</p>
                                        </td>
                                        <td class="total-price">
                                            <p><?php //echo '&#8369;' . number_format($grand_total, 2); ?></p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="checkout-payment">
                            <ul>
                                <li>
                                    <div class="single-payment">
                                        <div class="payment-radio radio">
                                            <input type="radio" name="radio" id="bank" value="Direct bank transfer">
                                            <label for="bank"><span></span> Direct bank transfer </label>
                                            <div class="payment-details">
                                                <p>Please send a Check to Store name with Store Street, Store Town, Store State, Store Postcode, Store Country.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-payment">
                                        <div class="payment-radio radio">
                                            <input type="radio" name="radio" id="check" value="Check payments">
                                            <label for="check"><span></span> Check payments </label>
                                            <div class="payment-details">
                                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-payment">
                                        <div class="payment-radio radio">
                                            <input type="radio" name="radio" id="cash" value="Cash on Delivery" checked="checked">
                                            <label for="cash"><span></span> Cash on Delivery</label>
                                            <div class="payment-details">
                                                <p>Pay with cash upon delivery.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-payment">
                                        <div class="payment-radio radio">
                                            <input type="radio" name="radio" id="paypal" value="Paypal">
                                            <label for="paypal"><span></span> Paypal <img class="payment" src="assets/images/payment-2.png" alt=""> <a href="#">What is PayPal?</a></label>
                                            <div class="payment-details">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="single-form">
                                <button type="button" class="btn btn-primary btn-hover-dark d-block" id="place_order">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Section End -->
@endsection
