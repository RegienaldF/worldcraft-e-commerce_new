<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductsController;


use App\Http\Controllers\DeliveryAddressController;
use App\Http\Controllers\WorldcraftPagesController;
Route::get('order-confirmed-layout', function () {
    return view('frontend.order_confirmed_test');
});
Route::get('check-sessions', function () {
    // print_r(Session::all());
    // dump(Session::all());
    dd(Session::all());
});

Route::get('/', [WorldcraftPagesController::class, 'index'])->name('index');
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

Route::get('/sign-in', [UserController::class, 'sign_in'])->name('sign.in');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/insert_users', [UserController::class, 'insert_users'])->name('insert.user');
Route::post('/login', [UserController::class, 'user_login'])->name('login.user');

Route::get('/check-auth', [HomeController::class, 'check_auth'])->name('check_auth');
// user controller
Route::middleware(['auth'])->group(function(){
    Route::controller(UserController::class)->group(function () {
        Route::get('/my-profile', 'view_profile')->name('profile')->middleware(['auth']);
        Route::get('/logout', 'logout')->name('logout.user');
    });
});

// PRODUCTS
Route::middleware(['auth'])->group(function () {
    Route::controller(ProductsController::class)->group(function () {

        // Display item, checkout, product details, and product list
        Route::get('/product_details/{slug}', 'get_variation')->name('product.details');
        Route::get('/product/variant-price', 'product_variation')->name('product.variation');
        Route::get('product-stocks', 'get_stocks')->name('products.stock');
        Route::get('/wishlist', 'wishlist')->name('product.wishlist');
        // Route::get('/cart', 'cart')->name('product.cart');
        Route::get('/checkout', 'checkout')->name('product.checkout');

        // Filter by new product category
        Route::get('products/{slug}', 'search_by_category')->name('products.new-category');
        Route::get('/product/stock/quantity', 'getStockQuantity')->name('product.stock.quantity');

        Route::get('products/{slug}', 'search_by_category')->name('products.new-category');
        // Route::get('/carts', 'display_cart_items')->name('cart.data');

        // Functions
        Route::post('/add_wishlist', 'add_wishlist')->name('product.add_wishlist');
        Route::post('shipping', 'proceed_shipping')->name('shipping.item');

    });
});


// CART
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add_to_cart', [CartController::class, 'add_to_cart'])->name('product.add_to_cart');
    Route::post('/cart/update',[CartController::class,'updateQuantity'])->name('cart.update');
    Route::post('/cart/delete',[CartController::class, 'delete_cart_item'])->name('cart.delete');

    Route::post('proceed-to-shipping', [CartController::class, 'proceed_to_shipping'])->name('proceed.to.shipping');
});


// CHECKOUT
Route::resource('addresses','AddressController');
Route::middleware(['auth'])->group(function () {
    // Route::post('proceed-to-shipping', '')
    // Route::get('/checkout/shipping_info', 'shipping_info')->name('shipping');
    Route::get('/checkout/shipping_info', [CheckoutController::class, 'shipping_info'])->name('get_shipping_info');
    Route::any('/checkout/payment_select', [CheckoutController::class, 'store_shipping_info'])->name('checkout.store_shipping_infostore');

    Route::get('my-shipping-address',[CheckoutController::class, 'my_shipping_address'])->name('checkout.get.shipping-address');
    Route::get('view-shipping-address', [CheckoutController::class, 'my_shipping_address_view'])->name('view.shipping.address');
    Route::post('save-shipping-address',[CheckoutController::class, 'my_shipping_address_save'])->name('save.shipping.address');
    Route::post('/checkout/selected_service',[CheckoutController::class, 'save_selected_service'])->name('checkout.selected_service');
    Route::post('delivery-address-store', [DeliveryAddressController::class, 'store'])->name('delivery-address.store');
    Route::post('change-shipping-address', [CheckoutController::class, 'change_shipping_address'])->name('change-selected-shipping-address');

    Route::post('/checkout/payment', [CheckoutController::class, 'checkout'])->name('payment.checkout');
    Route::post('/checkout/apply_coupon_code', [CheckoutController::class, 'apply_coupon_code'])->name('checkout.apply_coupon_code');
    Route::post('/checkout/paynamics/get_additional_fee', [CheckoutController::class, 'get_additional_fee'])->name('checkout.paynamics.additional_fee');

    Route::get('/checkout/order-confirmed', [CheckoutController::class, 'order_confirmed'])->name('order_confirmed');

	// Route::get('/checkout/shipping_info', [CheckoutController::class, 'get_shipping_info'])->name('checkout.shipping_info');


});

Route::middleware(['auth'])->group(function(){
    Route::get('/sellerpolicy', [HomeController::class, 'sellerpolicy'])->name('sellerpolicy');
    Route::get('/returnpolicy', [HomeController::class, 'returnpolicy'])->name('returnpolicy');
    Route::get('/supportpolicy', [HomeController::class, 'supportpolicy'])->name('supportpolicy');
    Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
    Route::get('/privacypolicy', [HomeController::class, 'privacypolicy'])->name('privacypolicy');
});




