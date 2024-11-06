@extends('master')
@section('index')

    <body>
        <!-- Page Banner Section Start -->
        <div class="section page-banner-section m-0 p-0" style="background-color: #FAEDCE;">
            <h2 class="title ms-5" style="color: black;">Wishlist</h2>
        </div>
        <!-- Page Banner Section End -->

        <!-- Shopping Cart Section Start -->
        <div class="section section-padding">
            <div class="container">
                <div class="cart-wrapper">
                    <!-- Cart Wrapper Start -->
                    <div class="cart-table table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumb">Image</th>
                                    <th class="product-info">product Information</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total-price">Total Price</th>
                                    <th class="product-add-to-cart">Add to Cart</th>
                                    <th class="product-action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-thumb">
                                        <img src="assets/images/product/product-03.jpg" alt="">
                                    </td>
                                    <td class="product-info">
                                        <h6 class="name"><a href="product-details.html">Pendant Chandelier Light</a></h6>
                                        <div class="product-prices">
                                            <span class="old-price">$35.90</span>
                                            <span class="sale-price">$28.72</span>
                                        </div>
                                        <div class="product-size-color">
                                            <p>Size <span>S</span></p>
                                            <p>Color <span>White</span></p>
                                        </div>
                                    </td>
                                    <td class="quantity">
                                        <div class="product-quantity d-inline-flex">
                                            <button type="button" class="sub">-</i></button>
                                            <input type="text" value="1" />
                                            <button type="button" class="add">+</button>
                                        </div>
                                    </td>
                                    <td class="product-total-price">
                                        <span class="price">$28.72</span>
                                    </td>
                                    <td class="product-add-to-cart">
                                        <a href="#" class="btn btn-dark btn-hover-primary">Add to Cart</a>
                                    </td>
                                    <td class="product-action">
                                        <a href="#" class="remove"><i class="pe-7s-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="product-thumb">
                                        <img src="assets/images/product/product-04.jpg" alt="">
                                    </td>
                                    <td class="product-info">
                                        <h6 class="name"><a href="product-details.html">High quality vase bottle</a></h6>
                                        <div class="product-prices">
                                            <span class="sale-price">$35.72</span>
                                        </div>
                                        <div class="product-size-color">
                                            <p>Size <span>S</span></p>
                                            <p>Color <span>White</span></p>
                                        </div>
                                    </td>
                                    <td class="quantity">
                                        <div class="product-quantity d-inline-flex">
                                            <button type="button" class="sub">-</i></button>
                                            <input type="text" value="1" />
                                            <button type="button" class="add">+</button>
                                        </div>
                                    </td>
                                    <td class="product-total-price">
                                        <span class="price">$28.72</span>
                                    </td>
                                    <td class="product-add-to-cart">
                                        <a href="#" class="btn btn-dark btn-hover-primary">Add to Cart</a>
                                    </td>
                                    <td class="product-action">
                                        <a href="#" class="remove"><i class="pe-7s-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="product-thumb">
                                        <img src="assets/images/product/product-08.jpg" alt="">
                                    </td>
                                    <td class="product-info">
                                        <h6 class="name"><a href="product-details.html">Reece Seater Sofa</a></h6>
                                        <div class="product-prices">
                                            <span class="sale-price">$28.72</span>
                                        </div>
                                        <div class="product-size-color">
                                            <p>Size <span>S</span></p>
                                            <p>Color <span>White</span></p>
                                        </div>
                                    </td>
                                    <td class="quantity">
                                        <div class="product-quantity d-inline-flex">
                                            <button type="button" class="sub">-</i></button>
                                            <input type="text" value="1" />
                                            <button type="button" class="add">+</button>
                                        </div>
                                    </td>
                                    <td class="product-total-price">
                                        <span class="price">$28.72</span>
                                    </td>
                                    <td class="product-add-to-cart">
                                        <a href="#" class="btn btn-dark btn-hover-primary">Add to Cart</a>
                                    </td>
                                    <td class="product-action">
                                        <a href="#" class="remove"><i class="pe-7s-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Cart Wrapper End -->
                </div>
            </div>
        </div>
        <!-- Shopping Cart Section End -->
    </body>
@endsection
