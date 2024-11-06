<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\AffiliateOption;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

class CheckoutController extends Controller
{
    //
    public function shipping_info(Request $request)
    {
        if(!Session::has('session_cart')) {
            return redirect()->route('cart.index');
        }
        if (Session::has('changed_address') && Session::get('changed_address') == true) {
            $changed_address = Session::get('delivery_address');
            Session::forget('service');

            Session::put('delivery_address', $changed_address);
        } else {
            $delivery_address = \App\Models\DeliveryAddress::where(['user_id' => auth()->user()->id])->get();
            foreach ($delivery_address as $address) {
                if ($address->is_default == 1) {
                    $default_address = [
                        'id' => $address->id,
                        'name' => $address->full_name,
                        'email' => auth()->user()->email,
                        'island' => $address->region->island,
                        'address' => $address->street,
                        'brgy_code' => $address->barangay->brgyDesc,
                        'city_code' => $address->city->citymunDesc,
                        'province_code' => $address->province->provDesc,
                        'region_code' => $address->region->regDesc,
                        'postal_code' => $address->zip_code,
                        'phone' => $address->phone,
                        'country' => 'Philippines',
                        'checkout_type' => 'logged',
                        'region_number' => $address->region->regCode
                    ];
                    Session::put('delivery_address', $default_address);
                    break;
                }
            }
        }
        return view('pages.products.shipping');
    }

    public function change_shipping_address(Request $request)
    {
        $address = \App\Models\DeliveryAddress::where(['id' => $request->address_id, 'user_id' => auth()->user()->id])->first();

        $session_address = [
            'id' => $address->id,
            'name' => $address->full_name,
            'email' => auth()->user()->email,
            'island' => $address->region->island,
            'address' => $address->street,
            'brgy_code' => $address->barangay->brgyDesc,
            'city_code' => $address->city->citymunDesc,
            'province_code' => $address->province->provDesc,
            'region_code' => $address->region->regDesc,
            'postal_code' => $address->zip_code,
            'phone' => $address->phone,
            'country' => 'Philippines',
            'checkout_type' => 'logged',
            'region_number' => $address->region->regCode
        ];
        $default_address_id = \App\Models\DeliveryAddress::where(['is_default' => 1, 'user_id' => auth()->user()->id])->first()->id;
        if ($default_address_id != $request->address_id) {
            Session::put('changed_address', true);
        } else {
            Session::put('changed_address', false);
        }
        Session::put('delivery_address', $session_address);
        // dd($session_address);
        return redirect()->back();
    }


    public function store_shipping_info(Request $request)
    {
        if (Auth::check() && Auth::user()->reset_cart == 0) {

            // Due to update on sessions cart, the system will clear all items in user's cart to update the next properties of the cart.
            try {
                DB::table('users')->where('id', auth()->user()->id)->update(['reset_cart' => 1]);
            } catch (\Throwable $th) {

            }
            Session::forget('cart');
            Session::forget('toCheckout');
        }
        // if (Session::has('toCheckout') && count(Session::get('toCheckout')) > 0) {

        // } else {
        //     // flash(translate("No items to checkout."))->error();
        //     return redirect()->route('cart.index');
        // }
        $session_address = Session::get('delivery_address');
        $data = [
            "id" => $session_address['id'],
            "name" => $session_address['name'],
            "email" => $session_address['email'],
            "island" => $session_address['island'],
            "address" => $session_address['address'] . ', ' . $session_address['brgy_code'],
            "country" => $session_address['country'],
            "city" => $session_address['city_code'],
            "postal_code" => $session_address['postal_code'],
            "phone" => $session_address['phone'],
            "checkout_type" => $session_address['checkout_type'],
            // for extra data
            "street" => $session_address['checkout_type'],
            "brgy_code" => $session_address['brgy_code'],
            "city_code" => $session_address['city_code'],
            "province_code" => $session_address['province_code'],
            "region_code" => $session_address['region_code'],
        ];
        $shipping_info = $data;

        $request->session()->put('shipping_info', $shipping_info);

        $subtotal = 0;
        $tax = 0;
        $shipping = 0;

        $toCheckout = [];
        $published = true;
        foreach (Session::get('session_cart') as $key => $cartItem) {
            $cart_id = $cartItem['id'];


            $cart = DB::table('carts as c')
                        ->leftJoin('pickup_points as pp', 'c.location_id', '=', 'pp.id')
                        ->leftJoin('product_stocks as ps', 'c.sku', '=', 'ps.sku')
                        ->leftJoin('products as p', 'ps.product_id', '=', 'p.id')
                        ->where('c.id', $cart_id)
                        ->where('p.published', 1)
                        ->select(
                            'c.id',
                            'c.location_id',
                            'c.sku',
                            'c.quantity',
                            'pp.name as pickup_location',
                            'ps.product_id',
                            'ps.price as latest_price',
                            'ps.variant',
                            'ps.id as ps_id'
                        )
                        ->first();

            // Check if product is unpublished or set default values if not found
            if (!$cart) {
                $published = false;
                $price = 0;
            } else {
                $price = $cart->latest_price ?? 0;
            }

            // default discounts for reseller and dealer
            $reseller_discount = 15.00;
            $employee_discount = $reseller_discount;
            $dealer_discount = 20.00;


            // CHECKS THE ACTIVE PROMO OF THIS SKU
            $item_sku = $cart->sku;
            $now = now()->format('Y-m-d H:i:s');
            $amount_discount = 0.00;
            $promos = \App\Models\Promo::where('status', 'active')->whereRaw('? between start and end', [$now])->get();
            if(count($promos) > 0) {
                foreach($promos as $promo) {

                    $promo_sku = \App\Models\PromoProduct::join('product_stocks', 'promo_products.sku_id', '=', 'product_stocks.id')->where([
                        'promo_products.promo_id' => $promo->id,
                        'promo_products.promo_status' => 'approved',
                        'location_id' => $cart->location_id
                    ])->where('product_stocks.sku', $item_sku)->select('promo_products.*','product_stocks.sku','product_stocks.price')->first();

                    if($promo_sku) {
                        $amount_discount = ($price * $promo_sku->percentage_discount) / 100;

                        // prorated discounts
                        $reseller_discount = $promo_sku->prorated_reseller_discount;
                        $employee_discount = $reseller_discount;
                        $dealer_discount = $promo_sku->prorated_dealer_discount;
                    }
                }
            }


            $promo_discount = 0;
                // Apply discount to price
                $srp = $price;
                $price -= $amount_discount;

            $toCheckout[] = (object) [
                "id" => $cart->product_id ?? 0, // product_id
                "product_stock_id" => $cart->ps_id,
                "sku" => $cart->sku,
                "owner_id" => "1",
                "pickup_location" => strtolower(str_replace(" ","_", $cart->pickup_location)),
                "pickup_order" => "same_day_pickup",
                "variant" => "",
                "quantity" => $cart->quantity,
                "price" => $price,
                "tax" => "0",
                "shipping" => "0",
                "product_referral_code" => "",
                "digital" => "0",
                "published" => $published,
                "promo_discount" => $promo_discount,
                "srp" => $srp,
            ];
        }
        Session::put('toCheckout', $toCheckout);
        // return '1';
        // foreach (Session::get('cart') as $key => $cartItem) {
        //     $subtotal += $cartItem['price'] * $cartItem['quantity'];
        //     $tax += $cartItem['tax'] * $cartItem['quantity'];
        //     // $shipping += $cartItem['shipping'] * $cartItem['quantity'];
        //     if ($request->address_id == "pickup_point_location") {
        //         foreach (Session::get('handlingFee') as $handlingFeeKey => $handlingFeeItem) {
        //             if (strtolower(str_replace(' ', '_', $handlingFeeItem->store)) == $cartItem['pickup_location']) {
        //                 $shipping += $handlingFeeItem->handling_fee * $cartItem['quantity'];
        //             }
        //         }
        //     } else {
        //         $shipping += $cartItem['shipping'] * $cartItem['quantity'];
        //     }
        // }
        $total = $subtotal + $tax + $shipping;

        if (Session::has('coupon_discount')) {
            $total -= Session::get('coupon_discount');
        }


        // Check for the latest price with or without promo...
        // foreach ($request->session()->get('toCheckout') as $key => $checkoutItem) {
        //     $product = Product::find($checkoutItem->id);

        //     try {

        //         $product_stock = DB::table('product_stocks')->where('sku', $checkoutItem->sku)->orderBy('id', 'desc')->first();


        //         $price = 0.00;

        //         if ($product_stock) {
        //             $price = $product_stock->price;
        //             $product_stock = $product_stock->sku;
        //         } else {
        //             abort(500);
        //         }
        //     } catch (\Throwable $th) {
        //         abort(500);
        //     }


        //     $pup_location_id = DB::table('pickup_points')->where('name', str_replace("_", " ", strtolower($checkoutItem->pickup_location)))->first()->id;
        //     $worldcraft_stock = DB::table('worldcraft_stocks')
        //         ->where([
        //             'sku_id' => $checkoutItem->sku,
        //             'pup_location_id' => $pup_location_id
        //         ])
        //         ->orderBy('id', 'desc')->first();


        //     // default discounts for reseller and dealer
        //     $reseller_discount = $product->reseller_discount;
        //     $employee_discount = $reseller_discount;
        //     $dealer_discount = $product->dealer_discount;


        //     // CHECKS THE ACTIVE PROMO OF THIS SKU
        //     $item_sku = $checkoutItem->sku;
        //     $now = now()->format('Y-m-d H:i:s');
        //     $amount_discount = 0.00;
        //     $promos = \App\Models\Promo::where('status', 'active')->whereRaw('? between start and end', [$now])->get();
        //     if (count($promos) > 0) {
        //         foreach ($promos as $promo) {
        //             $promo_sku = \App\Models\PromoProduct::join('product_stocks', 'promo_products.sku_id', '=', 'product_stocks.id')->where([
        //                 'promo_products.promo_id' => $promo->id,
        //                 'promo_products.promo_status' => 'approved',

        //                 'promo_products.location_id' => $pup_location_id,

        //             ])->where('product_stocks.sku', $item_sku)->select('promo_products.*', 'product_stocks.sku', 'product_stocks.price')->first();

        //             if ($promo_sku) {
        //                 $amount_discount = ($price * $promo_sku->percentage_discount) / 100;

        //                 // prorated discounts
        //                 $reseller_discount = $promo_sku->prorated_reseller_discount;
        //                 $employee_discount = $reseller_discount;
        //                 $dealer_discount = $promo_sku->prorated_dealer_discount;
        //             }
        //         }
        //     }
        //     $price -= $amount_discount;


        //     if (Auth::check()) {
        //         if (Auth::user()->user_type == 'reseller' || Auth::user()->user_type == 'employee' || Auth::user()->user_type == 'dealer') {
        //             if (Auth::user()->user_type == 'reseller') {
        //                 $price -= ($price * $reseller_discount) / 100;
        //             } elseif (Auth::user()->user_type == 'employee') {
        //                 $price -= ($price * $employee_discount) / 100;
        //             } elseif (Auth::user()->user_type == 'dealer') {
        //                 $price -= ($price * $dealer_discount) / 100;
        //             }
        //         } else {
        //             //discount calculation
        //             $flash_deals = \App\FlashDeal::where('status', 1)->get();
        //             $inFlashDeal = false;

        //             foreach ($flash_deals as $key => $flash_deal) {
        //                 if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
        //                     $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
        //                     if ($flash_deal_product->discount_type == 'percent') {
        //                         $price -= ($price * $flash_deal_product->discount) / 100;
        //                     } elseif ($flash_deal_product->discount_type == 'amount') {
        //                         $price -= $flash_deal_product->discount;
        //                     }
        //                     $inFlashDeal = true;
        //                     break;
        //                 }
        //             }

        //             if (!$inFlashDeal) {
        //                 if ($product->discount_type == 'percent') {
        //                     $price -= ($price * $product->discount) / 100;
        //                 } elseif ($product->discount_type == 'amount') {
        //                     $price -= $product->discount;
        //                 }
        //             }
        //         }
        //     } else {
        //         //discount calculation
        //         $flash_deals = \App\FlashDeal::where('status', 1)->get();
        //         $inFlashDeal = false;

        //         foreach ($flash_deals as $key => $flash_deal) {
        //             if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
        //                 $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
        //                 if ($flash_deal_product->discount_type == 'percent') {
        //                     $price -= ($price * $flash_deal_product->discount) / 100;
        //                 } elseif ($flash_deal_product->discount_type == 'amount') {
        //                     $price -= $flash_deal_product->discount;
        //                 }
        //                 $inFlashDeal = true;
        //                 break;
        //             }
        //         }

        //         if (!$inFlashDeal) {
        //             if ($product->discount_type == 'percent') {
        //                 $price -= ($price * $product->discount) / 100;
        //             } elseif ($product->discount_type == 'amount') {
        //                 $price -= $product->discount;
        //             }
        //         }
        //     }



        //     // CHECK FOR WAREHOUSE DISCOUNT WarehouseDiscount;
        //     $warehouse_discount = 0.00;
        //     if ($pup_location_id) {
        //         $warehouse_discount_model = WarehouseDiscount::where(['warehouse_id' => $pup_location_id, 'status' => 1])->where('discount_percentage', '>', 0.00)->orderBy('id', 'desc')->first();

        //         if ($warehouse_discount_model) {
        //             $warehouse_discount = $warehouse_discount_model->discount_percentage;

        //             $price -= ($price * $warehouse_discount) / 100;
        //         }

        //     }
        //     $price = round($price, 2);
        //     $checkoutItem->price = (double) $price;

        //     // $checkoutItems['tax'] = $tax;
        //     // $checkoutItems->push($checkoutItems);
        // }

        $to_checkout = Session::get('toCheckout');

        try {
            \Artisan::call('view:clear');
            \Artisan::call('cache:clear');
            return view('frontend.payment_select', compact('total', 'to_checkout'));
        } catch (\Exception $ex) {
            dd($ex);
        }
    }
    public function my_shipping_address(Request $request)
    {
        $addresses = \App\Models\DeliveryAddress::where(['user_id' => $request->user_id])->get();
        // return $addresses;
        return view('frontend.user_shipping_address', compact('addresses'))->render();
    }

    public function my_shipping_address_save(Request $request)
    {
        try {
            $is_default = 0;
            $user_id = auth()->user()->id;
            if (isset($request->is_default)) {
                $is_default = 1;

                \App\Models\DeliveryAddress::where(['user_id' => $user_id])->update(['is_default' => 0]);

            }
            // UPDATE DATA
            $delivery_address = \App\Models\DeliveryAddress::where(['id' => $request->delivery_id, 'user_id' => $user_id])->first();

            $delivery_address->full_name = $request->full_name;
            $delivery_address->phone = $request->phone;
            $delivery_address->region_code = $request->region_code;
            $delivery_address->province_code = $request->province_code;
            $delivery_address->city_code = $request->city_code;
            $delivery_address->brgy_code = $request->brgy_code;
            $delivery_address->street = $request->street;
            $delivery_address->zip_code = $request->postal_code;
            $delivery_address->is_default = $is_default;

            $delivery_address->save();

            // CHECK IF THERE IS DEFAULT ADDRESS
            $default_exists = \App\Models\DeliveryAddress::where(['user_id' => $user_id, 'is_default' => 1])->get()->count();
            if ($default_exists < 1) {
                // Set the first data as default.
                $first_address = \App\Models\DeliveryAddress::where(['user_id' => $user_id])->first();
                $first_address->is_default = 1;
                $first_address->save();
            }

            if (Session::get('delivery_address')['id'] == $delivery_address->id) {
                // RESET SESSIONS
                Session::forget('changed_address');
                Session::forget('service');
                Session::forget('delivery_address');

                $changed_address = [
                    'id' => $delivery_address->id,
                    'name' => $delivery_address->full_name,
                    'email' => auth()->user()->email,
                    'island' => $delivery_address->region->island,
                    'address' => $delivery_address->street,
                    'brgy_code' => $delivery_address->barangay->brgyDesc,
                    'city_code' => $delivery_address->city->citymunDesc,
                    'province_code' => $delivery_address->province->provDesc,
                    'region_code' => $delivery_address->region->regDesc,
                    'postal_code' => $delivery_address->zip_code,
                    'phone' => $delivery_address->phone,
                    'country' => 'Philippines',
                    'checkout_type' => 'logged',
                    'region_number' => $delivery_address->region->regCode
                ];

                Session::put('delivery_address', $changed_address);
                Session::put('changed_address', true);


                return response()->json(['message' => 'Address has been saved.', 'reload_page' => true], 200);
            }

            return response()->json(['message' => 'Address has been saved.', 'reload_page' => false], 200);
        } catch (\Throwable $th) {

            \Log::info('Pre-paid activation.', array('username' => Auth::user()->username));
            return $th->getMessage();
        }
    }

    public function save_selected_service(Request $request)
    {
        try {
            $shipping_address = $request->session()->get('delivery_address');

            $request->session()->put('service', ['service_type' => $request->type, 'service_fee' => $request->fee]);
            // return $shipping_address;
            return $shipping_address['region_number'];
            return 1;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        // return $request->all();
    }

    public function my_shipping_address_view(Request $request)
    {
        try {
            $address = \App\Models\DeliveryAddress::find($request->delivery_id);

            // return $addresses;
            return view('frontend.edit_user_shipping_address', compact('address'))->render();
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        // return $request->delivery_id;
    }

    public function checkout(Request $request)
    {
        $request->session()->put('shipping_info', Session::get('delivery_address'));
        $request->session()->put('service', ['service_type' => $request->service_type, 'service_fee' => $request->service_fee]);
        $user = Auth::user();

        $order_items = [];

        foreach(Session::get('toCheckout') as $key => $item) {
            $order_items[] = [
                'sku' => $item->sku,
                'price' => $item->price,
                'quantity' => $item->quantity,
            ];
        }
        $items_for_checkout = Session::get('toCheckout');

        foreach ($items_for_checkout as $item) {
            $pickup_point_location = \App\Models\PickupPoint::where('name', ucfirst(str_replace('_', ' ', $item->pickup_location)))
                ->select('id', 'name')
                ->first();

            $product = \App\Models\Products::where('id', $item->id)
                ->first();


            $product_stock = \App\Models\ProductStock::where('product_id', $item->id)
                ->where('sku', $item->sku)
                ->select('product_id', 'variant', 'sku')
                ->first()->sku;

            $worldcraft_stock = \App\Models\WorldcraftStocks::where('sku_id', $product_stock)
                ->select('sku_id', 'pup_location_id', 'quantity')
                ->where('pup_location_id', $pickup_point_location->id)
                ->first();

            if ($worldcraft_stock != null) {
                // check if there's still a quantity
                if ($worldcraft_stock->quantity < $item->quantity) {

                    flash("There's no more stock for item $product->name");
                    return redirect()->back();
                }
            }
        }


        if (Auth::user()->user_type == 'reseller') {
            if (Auth::user()->reseller->is_verified != 1) {
                $subtotal = 0;
                $tax = 0;
                $total = 0;

                $toCheckout = Session::get('toCheckout');

                foreach ($toCheckout as $key => $cartItem) {
                    $subtotal += $cartItem->price * $cartItem->quantity;
                    $tax += $cartItem->tax * $cartItem->quantity;
                }

                $total += $subtotal + $tax;

                $minimum_purchase = AffiliateOption::where('type', 'minimum_first_purchase')->first()->percentage ?? "N/A";


                try {

                    if ((int)$total < (int)$minimum_purchase) {
                        flash("You have to purchase a minimum amount of " . single_price($minimum_purchase) . " on your first purchase!");
                        return redirect()->back();
                    }
                }

                catch(\Throwable $th) {
                    flash($th->getMessage());
                    return redirect()->back();
                }

            }
        }

        // Check if payment option is not null
        if ($request->payment_option != null) {
            // Check Payment Type if Paynamics or Other payment methods
            if ($request->payment_type == 'paynamics') {
                $payment_type = \App\Models\PaymentMethodList::where('value', $request->payment_option)
                    ->first()->type;

                if(!$this->discountValidator($request)){
                    flash(translate('Something went Wrong! please try placing the order some other time.'))->error();
                    return redirect()->back();
                }
                $this->process_checkout($request);


                $request->session()->forget('coupon_id');
                $request->session()->forget('coupon_discount');
                $request->session()->forget('owner_id');
                $request->session()->forget('delivery_info');

                $orders = Order::findOrFail(Session::get('order_ids'));

                flash(translate('Your order has been placed successfully. Please submit payment information from purchase history'))->success();
                return redirect()->route('order_confirmed_pending_paynamics', compact('orders'));
            } else if ($request->payment_type == 'other-payment-method') {
                // Check what payment option
                if($request->payment_option == 'credit_card' || $request->payment_option == 'credit-card'){

                    $cc_description = $order_items;
                    $this->process_checkout($request, $request->payment_type);

                    $request->session()->forget('coupon_id');
                    $request->session()->forget('coupon_discount');
                    $request->session()->forget('owner_id');
                    $request->session()->forget('delivery_info');

                    $orders = Order::findOrFail(Session::get('order_ids'))->toArray()[0];
                    // dd($orders['id']);
                    // return $orders;

                    // flash(translate('To pay by credit card, please fill out the required fields.'))->success();

                    // Session::flash('initiate_checkout', '1');

                    return redirect()->route('order_confirmed_pending_mpgs', ['id' => encrypt($orders['id'])]);
                }
                if($request->payment_option == 'credit_card' || $request->payment_option == 'credit-card'){

                    $cc_description = $order_items;
                    $this->process_checkout($request, $request->payment_type);

                    $request->session()->forget('coupon_id');
                    $request->session()->forget('coupon_discount');
                    $request->session()->forget('owner_id');
                    $request->session()->forget('delivery_info');

                    $orders = Order::findOrFail(Session::get('order_ids'));

                    flash(translate('To pay by credit card, please fill out the required fields'))->success();

                    return;
                }
                elseif ($request->payment_option == 'user-wallet') {
                    $subtotal = 0;
                    $tax = 0;
                    $shipping = 0;

                    foreach (Session::get('toCheckout') as $key => $cartItem) {
                        $subtotal   += $cartItem->price * $cartItem->quantity;
                        $tax        += $cartItem->tax * $cartItem->quantity;

                        foreach (Session::get('handlingFee') as $handlingFeeKey => $handlingFeeItem) {
                            if (strtolower(str_replace(' ', '_', $handlingFeeItem->name)) == $cartItem->pickup_location) {
                                $shipping += $handlingFeeItem->handling_fee * $cartItem->quantity;
                            }
                        }
                    }

                    $grand_total = $subtotal + $tax + $shipping;

                    if ($user->balance >= $grand_total) {
                            if(!$this->discountValidator($request)){
                            flash(translate('Something went Wrong! please try placing the order some other time.'))->error();
                            return redirect()->back();
                        }
                        $this->process_checkout($request);

                        foreach ($request->session()->get('order_ids') as $item) {
                            $order = Order::findOrFail($item);

                            $user->balance -= $order->grand_total;
                            $user->save();
                        }
                    } else {
                        flash(translate("You don't have enough money on your wallet!"))->error();
                        return redirect()->back();
                    }

                    return $this->checkout_done($request->session()->get('order_ids'), null);
                } else {
                    $payment_type = \App\Models\OtherPaymentMethod::where('unique_id', $request->payment_option)
                        ->first()->type;

                        // if(!$this->discountValidator($request)){
                        //     flash(translate('Something went Wrong! please try placing the order some other time.'))->error();
                        //     return redirect()->back();
                        // }

                    $this->process_checkout($request, $request->payment_type);

                    $request->session()->forget('coupon_id');
                    $request->session()->forget('coupon_discount');
                    $request->session()->forget('owner_id');
                    $request->session()->forget('delivery_info');

                    $orders = Order::findOrFail(Session::get('order_ids'));

                    // flash(translate('Your order has been placed successfully. Please submit payment information from purchase history'))->success();
                    Session::flash(translate('Your order has been placed successfully. Please submit payment information from purchase history'));
                    /* change redirection for walkin */
                    $route = Route::currentRouteName();
                    if($route === 'walkin.payment.checkout'){
                        return redirect()->route('walkin.order_confirmed', compact('orders'));
                    }else{
                        if ($payment_type == 'single_payment_option') {
                            return redirect()->route('order_confirmed', compact('orders'));
                        } else {
                            return redirect()->route('order_confirmed_pending', compact('orders'));
                        }
                    }

                }
            }
        } else {
            flash(translate('Please select your payment option'))->info();
            return redirect()->back();
        }
    }
    public function order_confirmed()
    {
        $orders = Order::findOrFail(Session::get('order_ids'));
        $route = Route::currentRouteName();
        /* change redirection for walkin */
        if($route === 'walkin.order_confirmed'){
            return view('frontend.walkin.order_confirmed', compact('orders'));
        }else{
            return view('frontend.order_confirmed', compact('orders'));
        }


    }

    private function process_checkout($request): void
    {
        Session::forget('order_ids');

        $pickup_location = [];

        foreach (Session::get('toCheckout') as $key => $cartItem) {
            if (!in_array($cartItem->pickup_location, $pickup_location)) {
                array_push($pickup_location, $cartItem->pickup_location);
            }
        }

        $order_ids = [];

        foreach ($pickup_location as $loc) {
            $orderController = new OrderController;
            $request->pickup_point_location = $loc;
            $order_id = $orderController->store($request);
            array_push($order_ids, $order_id);
        }

        $request->session()->put('order_ids', $order_ids);
        $request->session()->put('payment_type', 'cart_payment');
    }

    public function apply_coupon_code(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->first();


        \Artisan::call('view:clear');
        \Artisan::call('cache:clear');

        if ($coupon != null) {
            if (strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date) {
                $user = Auth::user();
                 $coupon_details = json_decode($coupon->details);
                if ($coupon->usage_limit > 0 || $coupon->usage_limit == null) {
                    if ($coupon->role_restricted == 1) {
                        $roles = json_decode($coupon->roles);
                        // Check if role restricted
                        if (!in_array($user->user_type, $roles)) {
                            flash(translate("Sorry, but you don't have the right role to use this coupon code!"))->warning();
                            return redirect()->back();
                        }
                    }

                    if ($coupon->individual_use == 1) {
                        if ($user->id != $coupon->individual_user_id) {
                            flash(translate("Sorry, but you are not allowed to use this coupon!"))->warning();
                            return redirect()->back();
                        }
                    }

                    // Get items in cart
                    $cart_items = Session::get('toCheckout');

                    if(!$cart_items){
                        $cart_items = Session::get('cart');
                    }

                    $cart_items = collect($cart_items);

                    if ($coupon->type == 'product_base') {
                        $can_use = false;
                        foreach ($cart_items as $key => $cartItem) {
                            foreach ($coupon_details as $key => $coupon_detail) {

                                if(is_object($cartItem)){
                                    $item_id = $cartItem->id;
                                }else{
                                    $item_id = $cartItem['id'];
                                }

                                if ($coupon_detail->product_id == $item_id) {
                                    $can_use = true;
                                }

                            }
                        }

                        if (!$can_use) {
                            flash(translate("You can't use the coupon on this product!"))->error();
                            return redirect()->back();
                        }
                    }




                    if ($coupon->bundle_coupon == 1) {
                        if ($coupon->bundle_coupon_type == 'product') {


                            // Get bundled items
                            $bundled_items_id = CouponBundle::where('coupon_id', $coupon->id)
                                ->get(['id', 'product_id', 'product_quantity']);

                            if (count($bundled_items_id) == count($bundled_items_id->whereIn('product_id', $cart_items->pluck('id')))) {
                                $items = 0;
                                $minimum_quantity = 0;
                                $cart_quantity = 0;

                                foreach ($cart_items as $key => $item) {
                                    $cart_quantity = $item->quantity;

                                    $minimum_requirements = CouponBundle::where('coupon_id', $coupon->id)
                                        ->where('product_id', $item->id)
                                        ->first();

                                    if ($minimum_requirements != null) {
                                        $minimum_quantity = $minimum_requirements->product_quantity;
                                        $maximum_quantity = $minimum_requirements->product_quantity_max;

                                        if ($item->quantity >= $minimum_quantity && $item->quantity <= $maximum_quantity) {
                                            $coupon_bundle_item = CouponBundle::where('coupon_id', $coupon->id)
                                                ->where('product_id', $item->id)
                                                ->exists();

                                            if ($coupon_bundle_item) {
                                                $items += 1;
                                            }
                                        } else {
                                            flash(translate("You don't have the right items to use this coupon!"))->error();
                                            return redirect()->back();
                                        }
                                    }
                                }

                                if ($items != count($bundled_items_id)) {
                                    flash(translate("You don't have the right items to use this coupon!"))->error();
                                    return redirect()->back();
                                }
                            } else {
                                flash(translate("You don't have the right items to use this coupon!"))->error();
                                return redirect()->back();
                            }
                        } elseif ($coupon->bundle_coupon_type == 'category') {
                            $cart_items = Session::get('toCheckout');

                            $to_checkout_items = collect($cart_items);

                            $product_category_ids = \App\Product::whereIn('id', $to_checkout_items->pluck('id'))
                                ->pluck('category_id');

                            // Get Bundled Items
                            $bundled_category_id = \App\CouponCategoryBundle::where('coupon_id', $coupon->id)
                                ->get(['id', 'category_id', 'category_quantity', 'category_quantity_max']);

                            // Check if the number of items with bundled category ids match
                            if (count($bundled_category_id) == count($bundled_category_id->whereIn('category_id', $product_category_ids))) {
                                $category_ids = \App\CouponCategoryBundle::where('coupon_id', $coupon->id)
                                    ->pluck('category_id');

                                foreach ($bundled_category_id as $key => $category) {
                                    $minimum_quantity = $category->category_quantity;
                                    $maximum_quantity = $category->category_quantity_max;

                                    $collective_quantity = 0;

                                    foreach ($to_checkout_items as $key => $item) {
                                        $product_item = \App\Product::where('id', $item->id)
                                            ->where('category_id', $category->category_id)
                                            ->exists();

                                        if ($product_item) {
                                            $collective_quantity += $item->quantity;
                                        }
                                    }

                                    if ($collective_quantity >= $minimum_quantity && $collective_quantity <= $maximum_quantity) {
                                        // Proceed
                                    } else {
                                        flash(translate("The items on your checkout cart does not meet the requirements!"))->error();
                                        return redirect()->back();
                                    }
                                }
                            } else {
                                flash(translate("The items on your checkout cart does not meet the requirements!"))->error();
                                return redirect()->back();
                            }
                        }
                    }

                    $this->post_coupon_code($request, $coupon);
                } else if($coupon->usage_limit <= 0 ) {
                    flash(translate('Usage Limit has been reached for this coupon!'));
                    return redirect()->back();
                } else {
                    flash(translate('Usage Limit has been reached for this coupon!'));
                    return redirect()->back();
                }
            } else {
                flash(translate('Coupon expired!'))->warning();
                return redirect()->back();
            }
        } else {
            flash(translate('Invalid Coupon!'))->warning();
            return redirect()->back();
        }


        return redirect()->back();
    }
    public function get_additional_fee(Request $request)
    {
        $payment_channel = \App\Models\PaymentChannel::where('status', 1)
            ->where('value', $request->payment_channel)
            ->first();

        return ['status' => 1, 'name' => $payment_channel->name, 'rate' => $payment_channel->rate, 'price' => $payment_channel->price];
    }

}
