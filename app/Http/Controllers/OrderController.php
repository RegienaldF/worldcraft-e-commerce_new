<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OTPVerificationController;
use App\Http\Controllers\ClubPointController;
use App\Http\Controllers\AffiliateController;
use App\Models\Order;
use App\Models\Products;
use App\Models\ProductStock;
use App\Models\Color;
use App\Models\OrderDetail;
use App\Models\CouponUsage;
use App\Models\OtpConfiguration;
use App\Models\User;
use App\Models\DeliveryLogs;
use App\Models\BusinessSetting;
use App\Models\WarehouseDiscount;
use Auth;

use Illuminate\Support\Facades\Session;
use DB;
use PDF;
use Mail;
use App\Mail\InvoiceEmailManager;
use App\Models\OrderPayment;

// Reseller Models
use App\Models\ResellerCustomer;
use App\Models\ResellerCustomerOrder;

// Employee Models
use App\EmployeeReseller;
use App\EmployeeCustomer;
use App\EmployeeCustomerOrder;

// Declined order
use App\Http\Controllers\OrderDeclinedController;

// Paynamics Integration
use App\Http\Controllers\PaynamicsController;
use App\PaynamicsTransactionRequest;

use App\OrderNote;

use App\Http\Controllers\WorldcraftApiController;
use App\Http\Controllers\SohConnectionController;
use App\Models\Coupon;

// Logging
use App\Http\Controllers\CmgLogController;
use App\Http\Controllers\MLM\v1\WebhookController;

use App\Exports\OrdersExport;
use Excel;

use App\PackingSlipApprover;
use App\PackingSlipApproversLog;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource to seller.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $orders = DB::table('orders')
            ->orderBy('code', 'desc')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('order_details.seller_id', Auth::user()->id)
            ->where('is_walkin', NULL)
            ->select('orders.id')
            ->distinct();

        if ($request->payment_status != null) {
            $orders = $orders->where('order_details.payment_status', $request->payment_status);
            $payment_status = $request->payment_status;
        }

        if ($request->delivery_status != null) {
            $orders = $orders->where('order_details.delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }

        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
        }

        $orders = $orders->paginate(10);

        foreach ($orders as $key => $value) {
            $order = \App\Order::find($value->id);
            $order->viewed = 1;
            $order->save();
        }

        return view('frontend.user.seller.orders', compact('orders', 'payment_status', 'delivery_status', 'sort_search'));
    }

    // All Orders
   /*  public function all_orders(Request $request)
    {
        $date = $request->date;
        $col_name = 'created_at';
        $query = 'desc';
        $sort_search = null;
        $paym_status = null;
        $delivery_status = null;
        $type = $col_name . ',' . $query;
        $pup_location = null;
        $order_type = null;

        $orders = Order::rightJoin('users as a', 'a.id', '=', 'orders.user_id')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->where('is_walkin', NULL)
            ->select('orders.payment_option','orders.id', 'orders.code', 'orders.grand_total', 'orders.payment_status', 'orders.created_at', 'a.first_name', 'a.last_name', 'orders.cr_number', 'orders.som_number', 'orders.dr_number', 'orders.si_number', 'orders.pickup_point_location', 'order_details.delivery_status', 'a.user_type', 'a.referred_by', 'a.display_name')
            ->distinct();


        if ($request->search != null) {
            $sort_search = $request->search;

            $orders = $orders->where(function ($query) use ($sort_search) {
                $query->where('code', 'like', '%' . $sort_search . '%')
                    ->orWhere('a.name', 'like', '%' . $sort_search . '%')
                    ->orWhere('delivery_status', 'like', '%' . $sort_search . '%')
                    ->orWhere('cr_number', 'like', '%' . $sort_search . '%');

            });
        }

        if ($date != null) {
            $start_date = date('Y-m-d', strtotime(explode(" to ", $date)[0]));
            $end_date   = date('Y-m-d', strtotime(explode(" to ", $date)[1]));

            if ($start_date == $end_date) {
                $orders = $orders->whereDate('orders.created_at', $start_date);
            } else {
                $orders = $orders->whereDate('orders.created_at', '>=', $start_date)
                    ->whereDate('orders.created_at', '<=', $end_date);
            }
        }

        if ($request->type != null) {
            $type = $request->type;

            $var = explode(",", $type);
            $col_name = $var[0];
            $query = $var[1];

            if ($col_name == 'orderDetails') {
                $orders = $orders->withCount('orderDetails');
                $orders = $orders->orderBy('order_details_count', $query);
            } else {
                $orders = $orders->orderBy($col_name, $query);
            }
        } else {
            $orders = $orders->orderBy($col_name, $query);
        }

        if ($request->payment_status != null) {
            $paym_status = $request->payment_status;

            $orders = $orders->where('orders.payment_status', '=', $paym_status);
        }

        if ($request->delivery_status != null) {
            $delivery_status = $request->delivery_status;

            $orders = $orders->where('order_details.delivery_status', 'like', '%' . $delivery_status . '%');
        }

        if ($request->order_type != null) {
            $order_type = $request->order_type;

            $orders = $orders->where('order_details.order_type', 'like', '%' . $order_type . '%');
        }

        if ($request->pup_location != null) {
            $pup_location = $request->pup_location;

            $orders = $orders->where('orders.pickup_point_location', $pup_location);
        }

        if (Auth::user()->user_type == 'staff') {
            $pup_location_id = \App\PickupPoint::where('staff_id', 'like', '%' . Auth::user()->staff->id . '%')
                ->pluck('id');

            $pup_location = \App\PickupPoint::whereIn('id', $pup_location_id)
                ->get();

            $orders = $orders->where(function ($query) use ($pup_location) {
                foreach ($pup_location as $location) {
                    $query->orWhere('orders.pickup_point_location', mb_strtolower(str_replace(' ', '_', $location->name)));
                }
            });

            $pup_location = $request->pup_location;
        }

        if (Auth::user()->user_type == 'staff' && Auth::user()->staff->role->name == 'CMG') {
            $orders = $orders->where('orders.payment_status', 'paid');
        }

        $order_ids = $orders->get()->pluck('id')->toArray();


        $orders = $orders->paginate(10);
        // dd($orders);

        return view('backend.sales.all_orders.index', compact('order_ids','orders', 'sort_search', 'date', 'col_name', 'query', 'paym_status', 'delivery_status', 'pup_location', 'order_type'));
    } */
    public function all_orders(Request $request)
    {
        $date = $request->date;
        $col_name = 'created_at';
        $query = 'desc';
        $sort_search = null;
        $reseller_uid = $request->reseller_uid;
        $paym_status = null;
        $delivery_status = null;
        $type = $col_name . ',' . $query;
        $pup_location = null;
        $order_type = null;
        $payment_method = null;

        $orders = Order::rightJoin('users as a', 'a.id', '=', 'orders.user_id')
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->where('is_walkin', NULL)
            ->select('orders.is_other_platform','orders.service_type','orders.payment_option','orders.id', 'orders.code', 'orders.grand_total', 'orders.payment_status', 'orders.created_at', 'a.first_name', 'a.last_name', 'orders.cr_number', 'orders.som_number', 'orders.dr_number', 'orders.si_number', 'orders.pickup_point_location', 'order_details.delivery_status', 'a.user_type', 'a.referred_by', 'a.display_name','a.id AS userID')
            ->distinct();


        if ($request->search != null) {
            $sort_search = $request->search;

            $orders = $orders->where(function ($query) use ($sort_search) {
                $query->where('code', 'like', '%' . $sort_search . '%')
                    ->orWhere('a.name', 'like', '%' . $sort_search . '%')
                    ->orWhere('delivery_status', 'like', '%' . $sort_search . '%')
                    ->orWhere('cr_number', 'like', '%' . $sort_search . '%');

            });
        }

        if($request->reseller_uid != null) {
            $reseller_user_id = User::where('unique_id', $request->reseller_uid)->first()->id;

            $orders = $orders->where('user_id', $reseller_user_id);
        }

        if ($date != null) {
            $start_date = date('Y-m-d', strtotime(explode(" to ", $date)[0]));
            $end_date   = date('Y-m-d', strtotime(explode(" to ", $date)[1]));

            if ($start_date == $end_date) {
                $orders = $orders->whereDate('orders.created_at', $start_date);
            } else {
                $orders = $orders->whereDate('orders.created_at', '>=', $start_date)
                    ->whereDate('orders.created_at', '<=', $end_date);
            }
        }

        if ($request->type != null) {
            $type = $request->type;

            $var = explode(",", $type);
            $col_name = $var[0];
            $query = $var[1];

            if ($col_name == 'orderDetails') {
                $orders = $orders->withCount('orderDetails');
                $orders = $orders->orderBy('order_details_count', $query);
            } else {
                $orders = $orders->orderBy($col_name, $query);
            }
        } else {
            $orders = $orders->orderBy($col_name, $query);
        }

        if ($request->payment_status != null) {
            $paym_status = $request->payment_status;

            $orders = $orders->where('orders.payment_status', '=', $paym_status);
        }

        if ($request->delivery_status != null) {
            $delivery_status = $request->delivery_status;

            $orders = $orders->where('order_details.delivery_status', 'like', '%' . $delivery_status . '%');
        }

        if ($request->order_type != null) {
            $order_type = $request->order_type;

            $orders = $orders->where('order_details.order_type', 'like', '%' . $order_type . '%');
        }

        if ($request->pup_location != null) {
            $pup_location = $request->pup_location;

            $orders = $orders->where('orders.pickup_point_location', $pup_location);
        }

        if (Auth::user()->user_type == 'staff') {
            $pup_location_id = \App\PickupPoint::where('staff_id', 'like', '%' . Auth::user()->staff->id . '%')
                ->pluck('id');

            $pup_location = \App\PickupPoint::whereIn('id', $pup_location_id)
                ->get();

            $orders = $orders->where(function ($query) use ($pup_location) {
                foreach ($pup_location as $location) {
                    $query->orWhere('orders.pickup_point_location', mb_strtolower(str_replace(' ', '_', $location->name)));
                }
            });

            $pup_location = $request->pup_location;
        }

        if (Auth::user()->user_type == 'staff' && Auth::user()->staff->role->name == 'CMG') {
            $orders = $orders->where('orders.payment_status', 'paid');
        }
        if($request->payment_method) {
            $payment_method = $request->payment_method;
            $orders = $orders->where('orders.payment_type', $payment_method);
        }

        $order_ids = $orders->get()->pluck('id')->toArray();
        $orders = $orders->paginate(15);

        return view('backend.sales.all_orders.index', compact('orders', 'sort_search', 'date', 'col_name', 'query', 'paym_status', 'delivery_status', 'pup_location', 'order_type', 'reseller_uid','order_ids','payment_method'));
    }

    public function all_orders_show(Request $request, $id)
    {
        // $request->session()->put('remain_cmg_tab', $request->fullUrl());
        // Session::put('remain_cmg_tab', $request->fullUrl());
        $order = Order::findOrFail(decrypt($id));

        $proof_of_payments = OrderPayment::where('order_id', $order->id)
            ->get();

        $notes_for_customer = OrderNote::where('order_id', $order->id)
            ->where('type', 'customer')
            ->latest()
            ->paginate(10);

        $notes_for_admin = OrderNote::where('order_id', $order->id)
            ->where('type', 'admin')
            ->latest()
            ->paginate(10);

        $cmg_logs = \App\CmgLog::where('order_id', $order->id)

            ->latest()
            ->paginate(10);


        return view('backend.sales.all_orders.show', compact('order', 'proof_of_payments', 'notes_for_customer', 'notes_for_admin', 'cmg_logs'));
    }

    // Inhouse Orders
    public function admin_orders(Request $request)
    {
        $date = $request->date;
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $admin_user_id = User::where('user_type', 'admin')->first()->id;
        $orders = DB::table('orders')
            ->orderBy('code', 'desc')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('order_details.seller_id', $admin_user_id)
            ->select('orders.id')
            ->distinct();

        if ($request->payment_type != null) {
            $orders = $orders->where('order_details.payment_status', $request->payment_type);
            $payment_status = $request->payment_type;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('order_details.delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
        }
        if ($date != null) {
            $orders = $orders->where('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->where('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        }

        $orders = $orders->paginate(15);
        return view('backend.sales.inhouse_orders.index', compact('orders', 'payment_status', 'delivery_status', 'sort_search', 'admin_user_id', 'date'));
    }

    public function show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->viewed = 1;
        $order->save();

        $proof_of_payment = OrderPayment::where('order_id', $order->id)
            ->first();

        return view('backend.sales.inhouse_orders.show', compact('order', 'proof_of_payment'));
    }

    // Seller Orders
    public function seller_orders(Request $request)
    {
        $date = $request->date;
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $admin_user_id = User::where('user_type', 'admin')->first()->id;
        $orders = DB::table('orders')
            ->orderBy('code', 'desc')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('order_details.seller_id', '!=', $admin_user_id)
            ->select('orders.id')
            ->distinct();

        if ($request->payment_type != null) {
            $orders = $orders->where('order_details.payment_status', $request->payment_type);
            $payment_status = $request->payment_type;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('order_details.delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
        }
        if ($date != null) {
            $orders = $orders->where('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->where('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        }

        $orders = $orders->paginate(15);
        return view('backend.sales.seller_orders.index', compact('orders', 'payment_status', 'delivery_status', 'sort_search', 'admin_user_id', 'date'));
    }

    public function seller_orders_show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->viewed = 1;
        $order->save();
        return view('backend.sales.seller_orders.show', compact('order'));
    }


    // Pickup point orders
    public function pickup_point_order_index(Request $request)
    {
        $date = $request->date;
        $sort_search = null;

        if (Auth::user()->user_type == 'staff' && Auth::user()->staff->pick_up_point != null) {
            //$orders = Order::where('pickup_point_id', Auth::user()->staff->pick_up_point->id)->get();
            $orders = DB::table('orders')
                ->orderBy('code', 'desc')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->where('order_details.pickup_point_id', Auth::user()->staff->pick_up_point->id)
                ->select('orders.id')
                ->distinct();

            if ($request->has('search')) {
                $sort_search = $request->search;
                $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
            }
            if ($date != null) {
                $orders = $orders->where('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->where('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
            }

            $orders = $orders->paginate(15);

            return view('backend.sales.pickup_point_orders.index', compact('orders'));
        } else {
            //$orders = Order::where('shipping_type', 'Pick-up Point')->get();
            $orders = DB::table('orders')
                ->orderBy('code', 'desc')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->where('order_details.shipping_type', 'pickup_point')
                ->select('orders.id')
                ->distinct();

            if ($request->has('search')) {
                $sort_search = $request->search;
                $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
            }
            if ($date != null) {
                $orders = $orders->where('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->where('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
            }

            $orders = $orders->paginate(15);

            return view('backend.sales.pickup_point_orders.index', compact('orders', 'sort_search', 'date'));
        }
    }

    public function pickup_point_order_sales_show($id)
    {
        if (Auth::user()->user_type == 'staff') {
            $order = Order::findOrFail(decrypt($id));

            $proof_of_payment = OrderPayment::where('order_id', $order->id)
                ->first();
            return view('backend.sales.pickup_point_orders.show', compact('order'));
        } else {
            $order = Order::findOrFail(decrypt($id));

            $proof_of_payment = OrderPayment::where('order_id', $order->id)
                ->first();
            return view('backend.sales.pickup_point_orders.show', compact('order', 'proof_of_payment'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $service = $request->session()->get('service');
        $service_type = $service['service_type'];
        $service_fee = (double)$service['service_fee'];
        $additional_cost = 0.00;
        // $additional_cost = $request->additional_cost ?? 0;

        $order = new Order;

        if (Auth::check()) {
            $order->user_id = Auth::user()->id;
        } else {
            $order->guest_id = mt_rand(100000, 999999);
        }

        $order->shipping_address = (json_encode($request->session()->get('shipping_info'))) ?? null;

        $order->payment_type = $request->payment_option;
        $order->delivery_viewed = '0';
        $order->payment_status_viewed = '0';
        $order->date = strtotime('now');
        $order->payment_option = $request->payment_type;
        $order->note = $request->note;
        // $order->psc_note = $request->customer_data;
        // $order->psc_note = '';
        if(isset($request->assisted_by)){
            $order->assisted_by = $request->assisted_by;
        }
        if(isset($request->is_walkin)){
            $order->is_walkin = '1';
        }else{
            $order->is_walkin = NULL;
        }


        if ($request->payment_type == 'paynamics') {
            $order->payment_channel = $request->payment_channel;
        }

        $order->pickup_point_location = $request->pickup_point_location;
        // $order->inspection_type = $request->inspection_note; // inspection type selected

        if ($order->save()) {

            if($order->payment_option == 'other-payment-method' && $order->payment_type == 'bank_transfer') {
                $order_payment = new OrderPayment;

                $order_payment->order_id = $order->id;
                $order_payment->user_id = Auth::user()->id;
                $order_payment->payment_method = $order->payment_type;
                $order_payment->proof_of_payment = $request->proof_of_payment;
                $order_payment->paid_at = \Carbon\Carbon::now();

                $order_payment->save();
            }
            $now = \Carbon\Carbon::now();

            $order->code = $now->year . $now->month . '-' . $order->id;
            $order->unique_code = $order->id . '-' . unique_order_code();

            $subtotal = 0;
            $tax = 0;
            $shipping = 0;

            //calculate shipping is to get shipping costs of different types
            $admin_products = array();
            $seller_products = array();

            $referral_code = null;

            $cartLeft = collect(Session::get('cart'));

            //Order Details Storing
            // foreach (Session::get('cart')->where('owner_id', Session::get('owner_id')) as $key => $cartItem){

            $toCheckout = Session::get('toCheckout');

            $order_product_id = [];

            $checkout_subtotal = 0;

            // foreach ($toCheckout['dataToSave'] as $key => $cartItem){
            foreach ($toCheckout as $key => $cartItem) {
                // $product = Product::find($cartItem['id']);

                if ($cartItem->pickup_location == $request->pickup_point_location) {
                    $cart_left_handle = collect();
                    foreach ($cartLeft as $onCartKey => $onCartItem) {
                        if ($onCartItem['id'] == $cartItem->id && $onCartItem['pickup_location'] == $cartItem->pickup_location && $onCartItem['sku'] == $cartItem->sku) {
                        } else {
                            $cart_left_handle->push($onCartItem);
                        }
                    }
                    $cartLeft = $cart_left_handle;

                    $product = Products::find($cartItem->id);

                    if ($product->added_by == 'admin') {
                        // array_push($admin_products, $cartItem['id']);
                        array_push($admin_products, $cartItem->id);
                    } else {
                        $product_ids = array();
                        if (array_key_exists($product->user_id, $seller_products)) {
                            $product_ids = $seller_products[$product->user_id];
                        }
                        // array_push($product_ids, $cartItem['id']);
                        array_push($product_ids, $cartItem->id);
                        $seller_products[$product->user_id] = $product_ids;
                    }

                    // $subtotal += $cartItem['price']*$cartItem['quantity'];
                    // $subtotal += $cartItem->price * $cartItem->quantity;
                    $subtotal += round($cartItem->price, 2) * $cartItem->quantity;
                    // $tax += $cartItem['tax']*$cartItem['quantity'];
                    $tax += $cartItem->tax * $cartItem->quantity;

                    // $product_variation = $cartItem['variant'];
                    // $product_variation = str_replace('_withReplace_','+',str_replace('_-_','&',$cartItem->variant));
                    $product_variation = DB::table('product_stocks')->where('product_id', $cartItem->id)->where('sku', $cartItem->sku)->orderBy('id','desc')->first()->variant;
                    $isPickupPointLocation = $cartItem->pickup_location ? true : false;

                    if (!$isPickupPointLocation) {
                        if ($product_variation != null) {
                            // $product_stock = $product->stocks->where('variant', $product_variation)->first();
                            $product_stock = ProductStock::where('variant', $product_variation)->where('product_id', $cartItem->id)->where('sku', $cartItem->sku)->orderBy('id','desc')->first();
                            // if($product->digital != 1 &&  $cartItem['quantity'] > $product_stock->qty){
                            if ($product->digital != 1 &&  $cartItem->quantity > $product_stock->qty) {
                                flash(translate('The requested quantity is not available for ') . $product->getTranslation('name'))->warning();
                                $order->delete();
                                return redirect()->route('cart')->send();
                            } else {
                                // $product_stock->qty -= $cartItem['quantity'];
                                // $product_stock->qty -= $cartItem->quantity;
                                $product_stock->save();
                            }
                        } else {
                            // if ($product->digital != 1 && $cartItem['quantity'] > $product->current_stock) {
                            if ($product->digital != 1 && $cartItem->quantity > $product->current_stock) {
                                flash(translate('The requested quantity is not available for ') . $product->getTranslation('name'))->warning();
                                $order->delete();
                                return redirect()->route('cart')->send();
                            } else {
                                // $product->current_stock -= $cartItem['quantity'];
                                // $product->current_stock -= $cartItem->quantity;
                                $product->save();
                            }
                        }
                    }

                    $get_reseller_discount_percentage = $product->reseller_discount;


                    $order_detail = new OrderDetail;

                    $order_detail->order_id  = $order->id;
                    $order_detail->seller_id = $product->user_id;
                    $order_detail->product_id = $product->id;
                    //To get reseller discount percentage
                    $order_detail->reseller_discount_percentage = $get_reseller_discount_percentage;

                    // new Codes for Promo
                    // store promo discount of a product
                    $order_detail->promo_product = $product->promo_discount > 0 ? json_encode(['promo_discount' => $product->promo_discount , 'promo_name' => $product->promo_name]) : NULL;
                    // Ending

                    $order_detail->variation = $product_variation;
                    $order_detail->order_type = strtolower($cartItem->pickup_order);
                    // $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                    $order_detail->price = $cartItem->price * $cartItem->quantity;
                    // $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                    $order_detail->tax = $cartItem->tax * $cartItem->quantity;
                    // $order_detail->shipping_type = $cartItem['shipping_type'];
                    $order_detail->shipping_type = $cartItem->shipping_type ?? null;
                    // $order_detail->product_referral_code = $cartItem['product_referral_code'];
                    $order_detail->product_referral_code = $cartItem->product_referral_code;

                    // $referral_code = $cartItem['product_referral_code'];
                    $referral_code = $cartItem->product_referral_code;
                    //Dividing Shipping Costs
                    // if ($cartItem['shipping_type'] == 'home_delivery') {
                    // if ($order_detail->shipping_type == 'home_delivery') {
                    //     $order_detail->shipping_cost = getShippingCost($key);
                    // } else {
                    //     if ($isPickupPointLocation) {
                    //         foreach (Session::get('handlingFee') as $hfKey => $hfValue) {
                    //             if (strtolower(str_replace(' ', '_', $hfValue->name)) == $cartItem->pickup_location) {
                    //                 $order_detail->shipping_cost = $hfValue->handling_fee;
                    //             }
                    //         }
                    //     } else {
                    //         $order_detail->shipping_cost = 0;
                    //     }
                    // }

                    $shipping += $order_detail->shipping_cost;

                    // if ($cartItem['shipping_type'] == 'pickup_point') {
                    if ($order_detail->shipping_type == 'pickup_point') {
                        $order_detail->pickup_point_id = $cartItem['pickup_point'];
                    }
                    //End of storing shipping cost

                    // $order_detail->quantity = $cartItem['quantity'];
                    $order_detail->quantity = $cartItem->quantity;

                    $checkout_subtotal += $order_detail->price;


                    // SAVE WAREHOUSE DISCOUNT
                    $warehouse_discount = null;
                    try {
                        $pup_location_id = DB::table('pickup_points')->where('name', str_replace("_"," ", strtolower($cartItem->pickup_location)))->first()->id;
                        if($pup_location_id) {
                            $warehouse_discount_model = WarehouseDiscount::where(['warehouse_id' => $pup_location_id, 'status' => 1])->where('discount_percentage','>', 0.00)->orderBy('id','desc')->first();

                            if($warehouse_discount_model) {
                                $warehouse_discount = $warehouse_discount_model->discount_percentage;
                            }
                        }
                    }
                    catch(\Throwable $th) {

                    }

                    $order_detail->warehouse_discount = $warehouse_discount;

                    $order_detail->save();

                    $product->num_of_sale++;
                    $product->save();

                    $order_product_id[] = ['id' => $order_detail->product_id, 'price' => $order_detail->price];
                }
            }

            if (count($cartLeft) <= 0) {
                $request->session()->forget('cart');
            } else {
                $request->session()->put('cart', $cartLeft);
            }

            $convenience_fee = 0;

            if ($request->payment_type == 'paynamics') {
                // get payment channel
                $payment_channel = \App\Models\PaymentChannel::where('status', 1)
                    ->where('value', $request->payment_channel)
                    ->first();

                if($payment_channel){
                    if ($payment_channel->rate == 'fixed') {
                        $convenience_fee = $payment_channel->price;
                    } else {
                        $total_without_convenience_fee = $checkout_subtotal + $tax + $shipping;

                        $convenience_fee = ($payment_channel->price / 100) * $total_without_convenience_fee;
                    }
                }
            }

            // $order->grand_total = $subtotal + $tax + $shipping + $convenience_fee + $service_fee;
            $order->grand_total = $checkout_subtotal + $tax + $shipping + $convenience_fee + $service_fee + $additional_cost;
            $order->convenience_fee = $convenience_fee;
            $order->additional_cost = $additional_cost;
            $order->service_type = $service_type;
            $order->service_fee = $service_fee;

            if (Session::has('coupon_discount')) {
                // final calculation to be saved in database
                $total_coupon_discount = 0;
                $coupon = Coupon::where('id', Session::get('coupon_id'))->first();


                // check coupon exists
                if ($coupon != null) {
                    if (strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date) {
                        $user = Auth::user();
                        $coupon_details = json_decode($coupon->details);

                        if($coupon->type == 'product_base') {
                            $coupon_product_ids = [];
                            // push all the products id in array
                            foreach ($coupon_details as $key => $coupon_detail) {
                                $coupon_product_ids[] = (int) $coupon_detail->product_id;
                            }

                            // loop product_id of order detail to check the product_id is in array
                            foreach($order_product_id as $item) {
                                if(in_array((int)$item['id'], $coupon_product_ids)) {
                                    if($coupon->discount_type == 'percent') {
                                        $computed = (float)$item['price'] * (float)$coupon->discount / 100;
                                        $total_coupon_discount += $computed;
                                    }
                                    else {
                                        $computed = (float)$item['price'] * - $coupon->discount;
                                        $total_coupon_discount += $computed;
                                    }
                                }
                            }
                        }
                        elseif($coupon->type == 'cart_base') {
                            if($coupon->discount_type == 'percent') {
                                $computed = $order->grand_total * $coupon->discount / 100;
                                $total_coupon_discount += $computed;
                            }
                            else {
                                $total_coupon_discount += $coupon->discount;
                            }
                        }
                    }
                }


                #old
                    /*
                        $coupon = Coupon::where('id', Session::get('coupon_id'))->first();
                        $coupon_details = json_decode($coupon->details);
                        if ($coupon->type == 'product_base') {
                            $can_use = false;

                            $product_list = $order_details = OrderDetail::where('order_id', $order->id)->get();

                            foreach ($product_list as $key => $product) {
                                foreach ($coupon_details as $key => $coupon_detail) {
                                    if ($coupon_detail->product_id == $product->product_id) {
                                        $can_use = true;
                                    }
                                }
                            }

                            if($can_use){

                                $order->grand_total -= Session::get('coupon_discount');
                                $order->coupon_discount = Session::get('coupon_discount');
                            }
                        }else{
                            $order->grand_total -= Session::get('coupon_discount');
                            $order->coupon_discount = Session::get('coupon_discount');
                        }
                    */
                #endOld

                $order->grand_total -= $total_coupon_discount;
                $order->coupon_discount = $total_coupon_discount;

                $order->coupon_code = $coupon->code;

                try {
                    $order->actual_coupon = $coupon->discount.' '.$coupon->discount_type;
                }
                catch(\Throwable $th) {

                }

                $usage = CouponUsage::where('user_id', Auth::user()->id)
                    ->where('coupon_id', Session::get('coupon_id'))
                    ->first();

                if ($usage != null) {
                    $coupon->usage_limit -= 1;
                    $coupon->save();

                    $usage->usages += 1;
                    $usage->save();
                } else {
                    $coupon->usage_limit -= 1;
                    $coupon->save();

                    $coupon_usage = new CouponUsage;

                    $coupon_usage->user_id = Auth::user()->id;
                    $coupon_usage->coupon_id = Session::get('coupon_id');
                    $coupon_usage->usages += 1;
                    $coupon_usage->save();
                }
            }

            // INSERT ORDER ID FOR APPROVERS OF PACKINGSLIP
            // try {
            //     PackingSlipApproversLog::create([
            //         'order_id' => $order->id
            //     ]);
            // }
            // catch (\Throwable $th) {

            // }

            $order->save();

            // if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_order')->first()->value) {
            //     try {
            //         $otpController = new OTPVerificationController;
            //         $otpController->send_order_code($order);
            //     } catch (\Exception $e) {
            //     }
            // }

            // // If referrer is reseller
            // if ($referral_code != "") {
            //     $referrer_user = User::where('referral_code', $referral_code)->first();

            //     $order_details = OrderDetail::where('order_id', $order->id)
            //         ->where('product_referral_code', $referral_code)
            //         ->count();

            //     if ($referrer_user->user_type == 'reseller') {
            //         $referral_customer = ResellerCustomer::where('customer_id', Auth::user()->id)
            //             ->where('reseller_id', $referrer_user->id)
            //             ->exists();

            //         if (!$referral_customer) {
            //             $customer = new ResellerCustomer;

            //             $customer->reseller_id = $referrer_user->id;
            //             $customer->customer_id = Auth::user()->id;
            //             $customer->total_orders += 1;
            //             $customer->last_order_date = \Carbon\Carbon::now();

            //             $customer->save();
            //         } else {
            //             $customer = ResellerCustomer::where('customer_id', Auth::user()->id)->first();

            //             $customer->total_orders += 1;
            //             $customer->last_order_date = \Carbon\Carbon::now();

            //             $customer->save();
            //         }

            //         $customer_order = new ResellerCustomerOrder;

            //         $customer_order->reseller_id        = $referrer_user->id;
            //         $customer_order->customer_id        = Auth::user()->id;
            //         $customer_order->order_id           = $order->id;
            //         $customer_order->order_code         = $order->code;
            //         $customer_order->date               = $order->date;
            //         $customer_order->number_of_products = $order_details;
            //         $customer_order->order_status       = 'pending';
            //         $customer_order->payment_status     = 'unpaid';

            //         $customer_order->save();
            //     } elseif ($referrer_user->user_type == 'employee') {
            //         $referral_customer = EmployeeCustomer::where('customer_id', Auth::user()->id)
            //             ->where('employee_id', $referrer_user->id)
            //             ->exists();

            //         $order_details = OrderDetail::where('order_id', $order->id)
            //             ->where('product_referral_code', $referral_code)
            //             ->count();

            //         if (!$referral_customer) {
            //             $customer = new EmployeeCustomer;

            //             $customer->employee_id = $referrer_user->id;
            //             $customer->customer_id = Auth::user()->id;
            //             $customer->total_orders += 1;
            //             $customer->last_order_date = \Carbon\Carbon::now();

            //             $customer->save();
            //         } else {
            //             $customer = EmployeeCustomer::where('customer_id', Auth::user()->id)->first();

            //             $customer->total_orders += 1;
            //             $customer->last_order_date = \Carbon\Carbon::now();

            //             $customer->save();
            //         }

            //         $customer_order = new EmployeeCustomerOrder;

            //         $customer_order->employee_id        = $referrer_user->id;
            //         $customer_order->customer_id        = Auth::user()->id;
            //         $customer_order->order_id           = $order->id;
            //         $customer_order->order_code         = $order->code;
            //         $customer_order->date               = $order->date;
            //         $customer_order->number_of_products = $order_details;
            //         $customer_order->order_status       = 'pending';
            //         $customer_order->payment_status     = 'unpaid';

            //         $customer_order->save();
            //     }
            // } else if ($order->user->referred_by != null) {

            //     $referrer_user = User::where('id', $order->user->referred_by)
            //         ->first();

            //     $order_details = OrderDetail::where('order_id', $order->id)
            //         ->count();

            //     if ($referrer_user->user_type == 'employee') {
            //         if ($order->user->user_type == 'customer') {
            //             $referral_customer = EmployeeCustomer::where('customer_id', $order->user_id)
            //                 ->where('employee_id', $referrer_user->id)
            //                 ->exists();

            //             $order_details = OrderDetail::where('order_id', $order->id)
            //                 ->count();

            //             if (!$referral_customer) {
            //                 $customer = new EmployeeCustomer;

            //                 $customer->employee_id = $referrer_user->id;
            //                 $customer->customer_id = $order->user_id;
            //                 $customer->total_orders += 1;
            //                 $customer->last_order_date = \Carbon\Carbon::now();

            //                 $customer->save();
            //             } else {
            //                 $customer = EmployeeCustomer::where('customer_id', $order->user_id)
            //                     ->first();

            //                 $customer->total_orders += 1;
            //                 $customer->last_order_date = \Carbon\Carbon::now();

            //                 $customer->save();
            //             }

            //             $customer_order = new EmployeeCustomerOrder;

            //             $customer_order->employee_id            = $referrer_user->id;
            //             $customer_order->customer_id            = $order->user_id;
            //             $customer_order->order_id               = $order->id;
            //             $customer_order->order_code             = $order->code;
            //             $customer_order->date                   = $order->date;
            //             $customer_order->number_of_products     = $order_details;
            //             $customer_order->order_status           = 'pending';
            //             $customer_order->payment_status         = 'unpaid';

            //             $customer_order->save();
            //         } else if ($order->user->user_type == 'reseller') {

            //             $referral_customer = EmployeeReseller::where('reseller_id', $order->user_id)
            //                 ->where('employee_id', $referrer_user->id)
            //                 ->exists();

            //             $order_details = OrderDetail::where('order_id', $order->id)
            //                 ->count();

            //             if ($referral_customer) {
            //                 $employee_reseller_order = new \App\EmployeeResellerOrder;

            //                 $employee_reseller_order->employee_id = $referrer_user->id;
            //                 $employee_reseller_order->reseller_id = $order->user_id;
            //                 $employee_reseller_order->order_id = $order->id;
            //                 $employee_reseller_order->order_code = $order->code;
            //                 $employee_reseller_order->date = $order->date;
            //                 $employee_reseller_order->number_of_products = $order_details;
            //                 $employee_reseller_order->order_status = 'pending';
            //                 $employee_reseller_order->payment_status = 'unpaid';

            //                 $employee_reseller_order->save();
            //             }
            //         }
            //     }
            // }

            // if ($request->payment_type == 'paynamics') {
            //     $handle_paynamics = new PaynamicsController;
            //     $response = $handle_paynamics->handle_payment($request->payment_option, $request->payment_channel, $order);

            //     $order->payment_reference = json_decode($response)->pay_reference ?? null;
            //     $order->save();

            //     try {
            //         $paynamics_transaction = new PaynamicsTransactionRequest;

            //         $paynamics_transaction->user_id = $order->user_id;
            //         $paynamics_transaction->notifiable_id = $order->id;
            //         $paynamics_transaction->type = 'order';
            //         $paynamics_transaction->request_id = $order->unique_code;
            //         $paynamics_transaction->response_id = json_decode($response)->response_id ?? null;
            //         $paynamics_transaction->timestamp = json_decode($response)->timestamp ?? null;
            //         $paynamics_transaction->expiry_limit = json_decode($response)->expiry_limit ?? null;
            //         $paynamics_transaction->pay_reference = json_decode($response)->pay_reference ?? null;

            //         if(isset(json_decode($response)->direct_otc_info)){
            //             $paynamics_transaction->direct_otc_info = json_encode(json_decode($response)->direct_otc_info) ?? null;
            //         }else{
            //             $paynamics_transaction->direct_otc_info =json_decode($response)->payment_action_info ?? null;
            //         }

            //         $paynamics_transaction->signature        = json_decode($response)->signature ?? null;
            //         $paynamics_transaction->response_code    = json_decode($response)->response_code ?? null;
            //         $paynamics_transaction->response_message = json_decode($response)->response_message ?? null;
            //         $paynamics_transaction->response_advise  = json_decode($response)->response_advise ?? null;

            //         $paynamics_transaction->save();
            //     } catch (\Exception $e) {
            //         \Log::error($e);
            //     }
            // }

            /*
            if(env('APP_ENV') == 'production') {
                $worldcraft_stock_api = new WorldcraftApiController;
                $worldcraft_stock_api->pass_new_order($order);


                // $new_order = new WebhookController();
                // $new_order->send_webhook_response_new_order($order);
            }
            else {

                $soh_connection_controller = new SohConnectionController;
                $soh_connection_controller->order_store($order);


                // $data = json_encode($order);
                // Mail::raw($data, function($m) { $m->to('renzjoseph061418@gmail.com')->subject('Staging Order'); });
            }
                */

            $array['view'] = 'emails.invoice';
            $array['subject'] = translate('Your order has been placed') . ' - ' . $order->code;
            if(env('APP_ENV') == 'production') {
                $array['from'] = env('MAIL_USERNAME');
            }
            else {
                $array['from'] = env('MAIL_FROM_ADDRESS');
            }
            $array['order'] = $order;

            foreach ($seller_products as $key => $seller_product) {
                try {
                    // Mail::to(\App\User::find($key)->email)->queue(new InvoiceEmailManager($array));
                } catch (\Exception $e) {
                }
            }

            //sends email to customer with the invoice pdf attached
            try {
                // Mail::to(Auth::user()->email)->queue(new InvoiceEmailManager($array));
                // Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
            } catch (\Exception $e) {
            }
            if (env('MAIL_USERNAME') != null) {
            }

            return $order->id;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $reason = 'cancel')
    {
        $order = Order::findOrFail( decrypt($id) );

        if ($order != null) {
            // Return stocks
            if($order->payment_status === 'paid'){
                foreach ($order->orderDetails as $order_detail) {
                    $pickup_point_location = \App\PickupPoint::where('name', ucfirst(str_replace('_', ' ', $order->pickup_point_location)))->first();

                    if ($pickup_point_location != null) {
                        if ($order_detail->variation != null || $order_detail->variation != "") {
                            $product_stock = \App\ProductStock::where('product_id', $order_detail->product_id)
                                ->where('variant', $order_detail->variation)
                                ->first();

                            if ($product_stock != null) {
                                $qty_ordered = $order_detail->quantity;

                                $worldcraft_stock = \App\WorldcraftStock::where('sku_id', $product_stock->sku)
                                    ->where('pup_location_id', $pickup_point_location->id)
                                    ->first();

                                $worldcraft_stock->quantity += $qty_ordered;
                                $worldcraft_stock->save();
                            }
                        } else {
                            $qty_ordered = $order_detail->quantity;

                            $worldcraft_stock = \App\WorldcraftStock::where('sku_id', $order_detail->product->sku)
                                ->where('pup_location_id', $pickup_point_location->id)
                                ->first();

                            if ($worldcraft_stock != null) {
                                $worldcraft_stock->quantity += $qty_ordered;
                                $worldcraft_stock->save();
                            }
                        }
                    }
                }
            }

            if(env('APP_ENV') == 'production') {
                // Pass cancelled order api
                $pass_cancelled_order = new \App\Http\Controllers\WorldcraftApiController;
                $pass_cancelled_order->cancelled_order($order);

                $update_delivery_status = new WebhookController();
                $update_delivery_status->send_webhook_response_cancel_order($order);
            }

            // Save declined order
            $declined_order = new OrderDeclinedController;
            $declined_order->store($order, $reason);

            foreach ($order->orderDetails as $key => $orderDetail) {
                if($order->payment_status === 'paid'){
                    try {
                        if ($orderDetail->variation != null) {
                            $product_stock = ProductStock::where('product_id', $orderDetail->product_id)->where('variant', $orderDetail->variation)->first();

                            if ($product_stock != null) {
                                $product_stock->qty += $orderDetail->quantity;
                                $product_stock->save();
                            }
                        } else {
                            $product = $orderDetail->product;
                            $product->current_stock += $orderDetail->quantity;
                            $product->save();
                        }
                    } catch (\Exception $e) {
                    }
                }

                // $orderDetail->delete();
            }
            // CHECK IF THERE WERE ADVANCE ORDERS


            try {
                /*
                $soh_connection = DB::connection('mysql_soh');
                $order_exists = $soh_connection->table('advance_orders')
                                                ->where([
                                                    'order_code' => $order->code
                                                ])
                                                ->first();
                if($order_exists) {
                    $soh_connection->table('advance_orders')->where('order_code', $order->code)->update([
                                    'status' => 'cancelled',
                                    ]);
                }
                */

            }
            catch(\Throwable $th) {
                \Log::info($th->getMessage());
            }

            $order->delete();


            flash(translate('Order successfully deleted'))->success();
        } else {
            flash(translate('Something went wrong'))->error();
        }
        return back();
    }

    public function order_details(Request $request)
    {
        $source = '';
        if($request->source) {
            $source = $request->source;
        }
        $order = Order::findOrFail($request->order_id);
        $order->save();
        return view('frontend.user.seller.order_details_seller', compact('order'));
    }

    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = '0';

        //Additional codes to get the date delivered
        if($request->status == 'picked_up') {
            $order->released_status = 'picked_up';
            $order->released_date = date('Y-m-d H:i', strtotime($request->delivery_date));
        }
        //Ending

        $order->save();

        $status = null;

        if ($request->status == 'partial_release') {
            $product_count = $order->orderDetails->sum('quantity');

            if ($product_count > 1) {
                // Do Nothing ...
            } else {
                return [
                    'success' => 0,
                    'status' => ucfirst(str_replace('_', ' ', $request->status)),
                ];
            }
        }

        if (Auth::user()->user_type == 'seller') {
            foreach ($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail) {
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();

                $status = $request->status;
            }
        } else {
            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();

                $status = $request->status;
            }
        }

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value) {
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_delivery_status($order);
            } catch (\Exception $e) {
            }
        }

        // Customer Order

        $customer_order = ResellerCustomerOrder::where('order_code', $order->code)
            ->exists();

        if ($customer_order) {
            $customer_order = ResellerCustomerOrder::where('order_code', $order->code)
                ->first();

            $customer_order->order_status = $status;
            $customer_order->save();
        }

        $customer_employee_order = EmployeeCustomerOrder::where('order_code', $order->code)
            ->exists();

        if ($customer_employee_order) {
            $customer_employee_order = EmployeeCustomerOrder::where('order_code', $order->code)
                ->first();

            $customer_employee_order->order_status = $status;
            $customer_employee_order->save();
        }

        $employee_reseller_order = \App\EmployeeResellerOrder::where('order_id', $order->id)
            ->exists();

        if ($employee_reseller_order) {
            $employee_reseller_order = \App\EmployeeResellerOrder::where('order_id', $order->id)
                ->first();

            $employee_reseller_order->order_status = $status;
            $employee_reseller_order->save();
        }

        $source = null;
        if($request->source) {
            $source = $request->source;
        }
        $deliveryLogs = DeliveryLogs::create([
            'order_id' => $order->id,
            'delivery_date' => $request->delivery_date,
            'delivery_status' => $status,
            'updated_by' => Auth::user()->id,
            'source' => $source
        ]);

        if(env('APP_ENV') == 'production') {
            $update_delivery_status_api = new \App\Http\Controllers\WorldcraftApiController;
            $update_delivery_status_api->delivery_status_update($order);

            $update_delivery_status = new WebhookController();
            $update_delivery_status->send_webhook_response_order_update($order);
        }
        else {

            $soh_connection_controller = new SohConnectionController;
            $soh_connection_controller->order_delivery_status($request);
        }

        return [
            'success' => 1,
            'status' => ucfirst(str_replace('_', ' ', $status)),
            'bare_status' => $status
        ];
    }

    public function update_payment_status(Request $request)
    {
        try {
            $order = Order::findOrFail($request->order_id);
            $pickup_point_id = \App\PickupPoint::where('name', ucfirst(str_replace('_', ' ', $order->pickup_point_location)))->first()->id;

            $no_stocks = [];
            if($request->status == 'paid') {
                foreach($order->orderDetails as $orderDetail) {
                    $order_item = \App\ProductStock::where('product_id', $orderDetail->product_id)
                    ->where('variant', $orderDetail->variation)
                    ->orderBy('id','desc')
                    ->first();

                    if ($order_item != null) {
                        $order_item_sku = $order_item->sku;
                        // echo $sku->sku;
                    } else {
                        // $sku_id = $orderDetail->product->sku ?? $orderDetail->variation ?? "SKU not found";
                        $order_item_sku =  $orderDetail->product->sku ?? $orderDetail->variation ?? "SKU not found";
                    }
                    // echo $order_item_sku.'<br>';

                    $net_saleable = $this->check_soh_stock($pickup_point_id, $order_item_sku);
                    // echo 'NET SALEABLE: '.$net_saleable. ' | ORDER QTY:'.$orderDetail->quantity. '<br>';

                    if($net_saleable < $orderDetail->quantity) {
                        $no_stocks[] = $order_item_sku;
                    }
                }
            }

            // if(count($no_stocks) > 0) {
            //     // $message = "<div style='text-align: left;'>Order will not be processed due the following SKU's NET SALEABLE is not sufficient: <br><br> <ul><li>".implode("</li><li>",$no_stocks)."</li></ul><br>"."Please advise Sales Manager regarding this. Thank you!</div>";
            //     $message = "<div style='text-align: left;'>Order will not be processed due the following SKU's NET SALEABLE is not sufficient: <br><br> <ul><li>".implode("</li><li>",$no_stocks)."</li></ul><br>"."</div>";
            //     Session::flash('unable_payment', $message);
            //     return back();
            // }

            $order->payment_status_viewed = '0';
            $order->save();
        }
        catch(\Throwable $th) {
            return $th->getMessage();
        }

        if(isset($request->payment_type)){
            if($request->payment_type !== 'wallet' && $request->payment_type !== 'onlinebanktransfer' && $request->payment_type !== 'creditcard' && $request->payment_type !== 'bank_otc' ){
                if ($order->cr_number == null) {
                    flash(translate('CR Number must be filled out first by the Treasurer'))->error();
                    return 1;
                    return redirect()->back();
                }
            }
        }else{
            if ($order->cr_number == null && $request->status == 'paid') {
                flash(translate('CR Number must be filled out first by the Treasurer'))->error();
                return 1;
            }
        }

        try{
            if(Auth::check()){
                if (Auth::user()->user_type == 'seller') {
                    foreach ($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail) {
                        $orderDetail->payment_status = $request->status;
                        $orderDetail->save();

                        $product_stock = $orderDetail->product->stocks->where('variant', $orderDetail->variation)->first();
                        if ($order->payment_status == 'paid'){
                            // $product_stock->qty -= $orderDetail->quantity;
                            // $product_stock->save();
                        }else{
                            // $product_stock->qty += $orderDetail->quantity;
                            // $product_stock->save();
                        }
                    }
                } else {
                    foreach ($order->orderDetails as $key => $orderDetail) {
                        $orderDetail->payment_status = $request->status;
                        $orderDetail->save();

                        $product_stock = $orderDetail->product->stocks->where('variant', $orderDetail->variation)->first();
                        if ($order->payment_status == 'paid'){
                            // $product_stock->qty -= $orderDetail->quantity;
                            // $product_stock->save();
                        }else{
                            // $product_stock->qty += $orderDetail->quantity;
                            // $product_stock->save();
                        }
                    }
                }
            }else{
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = $request->status;
                    $orderDetail->save();

                    $product_stock = $orderDetail->product->stocks->where('variant', $orderDetail->variation)->first();
                    if ($order->payment_status == 'paid'){
                        $product_stock->qty -= $orderDetail->quantity;
                        $product_stock->save();
                    }else{
                        $product_stock->qty += $orderDetail->quantity;
                        $product_stock->save();
                    }
                }
            }


        }catch(\Throwable $e){
            return $e;
        }

        $status = 'paid';
        foreach ($order->orderDetails as $key => $orderDetail) {
            if ($orderDetail->payment_status != 'paid') {
                $status = 'unpaid';
            }
        }

        $order->payment_status = $status;
        if($status === 'paid'){
            $order->paid_at = date('Y-m-d H:i:s');
        }
        $order->save();

        if ($order->payment_status == 'paid' && $order->commission_calculated == 0) {
            if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() == null || !\App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated) {
                if ($order->payment_type == 'cash_on_delivery') {
                    if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                        $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if ($orderDetail->product->user->user_type == 'seller') {
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price * $commission_percentage) / 100;
                                $seller->save();
                            }
                        }
                    } else {
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if ($orderDetail->product->user->user_type == 'seller') {
                                $commission_percentage = $orderDetail->product->category->commision_rate;
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price * $commission_percentage) / 100;
                                $seller->save();
                            }
                        }
                    }
                } elseif ($order->manual_payment) {
                    if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                        $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if ($orderDetail->product->user->user_type == 'seller') {
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price * (100 - $commission_percentage)) / 100 + $orderDetail->tax + $orderDetail->shipping_cost;
                                $seller->save();
                            }
                        }
                    } else {
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if ($orderDetail->product->user->user_type == 'seller') {
                                $commission_percentage = $orderDetail->product->category->commision_rate;
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price * (100 - $commission_percentage)) / 100 + $orderDetail->tax + $orderDetail->shipping_cost;
                                $seller->save();
                            }
                        }
                    }
                }
            }

            if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliatePoints($order);
            }

            if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
                if ($order->user != null) {
                    $clubpointController = new ClubPointController;
                    $clubpointController->processClubPoints($order);
                }
            }

            $order->commission_calculated = 1;
            $order->save();
        }

        $worldcraft_stock_api = new WorldcraftApiController;
        $worldcraft_stock_api->pass_stocks_update($order);

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_paid_status')->first()->value) {
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_payment_status($order);
            } catch (\Exception $e) {
            }
        }

        $customer_order = ResellerCustomerOrder::where('order_code', $order->code)
            ->exists();

        if ($customer_order) {
            $customer_order = ResellerCustomerOrder::where('order_code', $order->code)
                ->first();

            $customer_order->payment_status = $status;
            $customer_order->save();
        }

        $customer_employee_order = EmployeeCustomerOrder::where('order_code', $order->code)
            ->exists();

        if ($customer_employee_order) {
            $customer_employee_order = EmployeeCustomerOrder::where('order_code', $order->code)
                ->first();

            $customer_employee_order->payment_status = $status;
            $customer_employee_order->save();
        }

        if ($order->user->user_type == 'reseller' && $order->user->reseller->is_verified != 1) {
            $reseller = \App\Reseller::where('user_id', $order->user_id)
                ->first();

            $reseller->is_verified = 1;
            $reseller->verified_at = \Carbon\Carbon::now();
            $reseller->save();

            if(env('APP_ENV') == 'production') {
                // OVERRUNS TRIGGER SYNC FOR UPDATING USER IS_VERIFIED
                $client = new \GuzzleHttp\Client();
                $request = $client->get('https://overrun.worldcraft.com.ph/admin/submit_sync_wc_customers.php');
            }

        }
        // Check if reseller is employee's under
        $employee_reseller = EmployeeReseller::where('reseller_id', $order->user->id)
            ->exists();

        if ($employee_reseller) {
            $employee_reseller = EmployeeReseller::where('reseller_id', $order->user->id)
                ->first();

            $employee_reseller->remaining_purchase_to_be_verified -= $order->grand_total;
            $employee_reseller->total_successful_orders += 1;

            $minimum_purchase = \App\AffiliateOption::where('type', 'minimum_first_purchase')->first()->percentage;

            if ($order->grand_total >= $minimum_purchase) {
                $user = User::where('id', $order->user->id)->first();
                if(env('APP_ENV') == 'production') {
                    $webhook = new WebhookController();
                    $webhook->send_webhook_response_new_reseller($user);
                }
                $employee_reseller->is_verified = 1;

                $reseller = \App\Reseller::where('user_id', $order->user->id)->first();
                $reseller->is_verified = 1;
                $reseller->verified_at = \Carbon\Carbon::now();
                $reseller->save();

                if(env('APP_ENV') == 'production') {
                    // OVERRUNS TRIGGER SYNC FOR UPDATING USER IS_VERIFIED
                    $client = new \GuzzleHttp\Client();
                    $request = $client->get('https://overrun.worldcraft.com.ph/admin/submit_sync_wc_customers.php');
                }
            }

            $employee_reseller->save();
        }else{

            $reseller = \App\Reseller::where('user_id', $order->user->id)
                ->first();
            if($reseller && $order->payment_status == 'paid'){
                $minimum_purchase = \App\AffiliateOption::where('type', 'minimum_first_purchase')->first()->percentage;
                if ($order->grand_total >= $minimum_purchase) {
                    $user = User::where('id', $order->user->id)->first();

                    if(env('APP_ENV') == 'production') {
                        $webhook = new WebhookController();
                        $webhook->send_webhook_response_new_reseller($user);
                    }

                    $reseller->is_verified = 1;
                    $reseller->verified_at = \Carbon\Carbon::now();
                    $reseller->save();

                    if(env('APP_ENV') == 'production') {
                        // OVERRUNS TRIGGER SYNC FOR UPDATING USER IS_VERIFIED
                        $client = new \GuzzleHttp\Client();
                        $request = $client->get('https://overrun.worldcraft.com.ph/admin/submit_sync_wc_customers.php');
                    }
                }
            }

        }

        $employee_reseller_order = \App\EmployeeResellerOrder::where('order_id', $order->id)
            ->exists();

        if ($employee_reseller_order) {
            $employee_reseller_order = \App\EmployeeResellerOrder::where('order_id', $order->id)
                ->first();

            $employee_reseller_order->payment_status = $status;
            $employee_reseller_order->save();
        }

        if(env('APP_ENV') == 'production') {
            // Send update to api
            $update_payment_status_api = new \App\Http\Controllers\WorldcraftApiController;
            $update_payment_status_api->payment_status_update($order);

            $update_payment_status = new WebhookController();
            $update_payment_status->send_webhook_response_order_update($order);
        }
        else {

            $soh_connection_controller = new SohConnectionController;
            $soh_connection_controller->order_payment_status($request);
        }

        if($order->payment_status == 'paid') {
            DeliveryLogs::create([
                'order_id' => $order->id,
                'delivery_date' => now()->format('Y-m-d H:i:s'),
                'delivery_status' => 'confirmed',
                'updated_by' => Auth::user()->id,
            ]);

            // IF THERE WERE ADVANCE ORDER SKUS
            /*
            foreach ($order->orderDetails as $key => $value) {
                try {

                    $pickup_point_location = \App\PickupPoint::where('name', ucfirst(str_replace('_', ' ', $order->pickup_point_location)))
                    ->first();


                    $sku_code = '';
                    $quantity = $value->quantity;
                    $order_code = $order->code;
                    $location_id = $pickup_point_location->id;

                    if ($value->variation != null) {
                        $product_stock = \App\ProductStock::where('product_id', $value->product_id)
                            ->where('variant', $value->variation)
                            ->orderBy('id','desc')->first();

                        if($product_stock){
                            $sku_code = $product_stock->sku;
                        }

                    } else {
                        $product_sku = \App\Product::where('id', $value->product_id)
                            ->first();

                        if($product_sku){
                            $sku_code = $product_stock->sku;
                        }
                    }


                    $soh_connection = DB::connection('mysql_soh');


                    $sku = strtolower($sku_code);
                    $endsWith = '-adv'; // to lowercase the -ADV

                    if (substr($sku, -strlen($endsWith)) === $endsWith) {
                        // check if order code is exist and paid
                        $order_exists = $soh_connection->table('advance_orders')
                                                        ->where([
                                                            'order_code' => $order_code,
                                                            'status' => 'paid'
                                                        ])
                                                        ->exists();
                        if(!$order_exists) {
                            $soh_connection->table('advance_orders')->insert([
                                'order_code' => $order_code,
                                'sku' => $sku_code,
                                'location_id' => $location_id,
                                'date_paid' => now()->format('Y-m-d H:i:s'),
                                'created_at' => now()->format('Y-m-d H:i:s'),
                                'quantity' => $quantity,
                                'status' => 'paid',
                            ]);
                        }
                    }

                }
                catch(\Throwable $th) {
                    \Log::info($th->getMessage());
                }
            }
            */
        }

        flash(translate('Payment status has been updated'))->success();
        return redirect()->back();
        return 1;
    }

    /* This function is for walkin */
    public function update_payment_status2($request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->payment_status_viewed = '0';
        $order->save();

        try{
            if(Auth::check()){
                if (Auth::user()->user_type == 'seller') {
                    foreach ($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail) {
                        $orderDetail->payment_status = $request->status;
                        $orderDetail->save();

                        $product_stock = $orderDetail->product->stocks->where('variant', $orderDetail->variation)->first();
                        if ($order->payment_status == 'paid'){
                            // $product_stock->qty -= $orderDetail->quantity;
                            // $product_stock->save();
                        }else{
                            // $product_stock->qty += $orderDetail->quantity;
                            // $product_stock->save();
                        }
                    }
                } else {
                    foreach ($order->orderDetails as $key => $orderDetail) {
                        $orderDetail->payment_status = $request->status;
                        $orderDetail->save();

                        $product_stock = $orderDetail->product->stocks->where('variant', $orderDetail->variation)->first();
                        if ($order->payment_status == 'paid'){
                            // $product_stock->qty -= $orderDetail->quantity;
                            // $product_stock->save();
                        }else{
                            // $product_stock->qty += $orderDetail->quantity;
                            // $product_stock->save();
                        }
                    }
                }
            }else{
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = $request->status;
                    $orderDetail->save();

                    $product_stock = $orderDetail->product->stocks->where('variant', $orderDetail->variation)->first();
                    if ($order->payment_status == 'paid'){
                        $product_stock->qty -= $orderDetail->quantity;
                        $product_stock->save();
                    }else{
                        $product_stock->qty += $orderDetail->quantity;
                        $product_stock->save();
                    }
                }
            }


        }catch(Exception $e){

        }

        $status = 'paid';
        foreach ($order->orderDetails as $key => $orderDetail) {
            if ($orderDetail->payment_status != 'paid') {
                $status = 'unpaid';
            }
        }

        $content = $status;
        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/myText3.txt","wb");
        fwrite($fp,$content);
        fclose($fp);

        $order->payment_status = $status;
        $order->save();

        if ($order->payment_status == 'paid' && $order->commission_calculated == 0) {
            if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() == null || !\App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated) {
                if ($order->payment_type == 'cash_on_delivery') {
                    if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                        $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if ($orderDetail->product->user->user_type == 'seller') {
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price * $commission_percentage) / 100;
                                $seller->save();
                            }
                        }
                    } else {
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if ($orderDetail->product->user->user_type == 'seller') {
                                $commission_percentage = $orderDetail->product->category->commision_rate;
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price * $commission_percentage) / 100;
                                $seller->save();
                            }
                        }
                    }
                } elseif ($order->manual_payment) {
                    if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                        $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if ($orderDetail->product->user->user_type == 'seller') {
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price * (100 - $commission_percentage)) / 100 + $orderDetail->tax + $orderDetail->shipping_cost;
                                $seller->save();
                            }
                        }
                    } else {
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if ($orderDetail->product->user->user_type == 'seller') {
                                $commission_percentage = $orderDetail->product->category->commision_rate;
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price * (100 - $commission_percentage)) / 100 + $orderDetail->tax + $orderDetail->shipping_cost;
                                $seller->save();
                            }
                        }
                    }
                }
            }

            if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliatePoints($order);
            }

            if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
                if ($order->user != null) {
                    $clubpointController = new ClubPointController;
                    $clubpointController->processClubPoints($order);
                }
            }

            $order->commission_calculated = 1;
            $order->save();
        }

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_paid_status')->first()->value) {
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_payment_status($order);
            } catch (\Exception $e) {
            }
        }

        $customer_order = ResellerCustomerOrder::where('order_code', $order->code)
            ->exists();

        if ($customer_order) {
            $customer_order = ResellerCustomerOrder::where('order_code', $order->code)
                ->first();

            $customer_order->payment_status = $status;
            $customer_order->save();
        }

        $customer_employee_order = EmployeeCustomerOrder::where('order_code', $order->code)
            ->exists();

        if ($customer_employee_order) {
            $customer_employee_order = EmployeeCustomerOrder::where('order_code', $order->code)
                ->first();

            $customer_employee_order->payment_status = $status;
            $customer_employee_order->save();
        }

        if ($order->user->user_type == 'reseller' && $order->user->reseller->is_verified != 1) {
            $reseller = \App\Reseller::where('user_id', $order->user_id)
                ->first();

            $reseller->is_verified = 1;
            $reseller->verified_at = \Carbon\Carbon::now();
            $reseller->save();

            if(env('APP_ENV') == 'production') {
                // OVERRUNS TRIGGER SYNC FOR UPDATING USER IS_VERIFIED
                $client = new \GuzzleHttp\Client();
                $request = $client->get('https://overrun.worldcraft.com.ph/admin/submit_sync_wc_customers.php');
            }
        }

        // Check if reseller is employee's under
        $employee_reseller = EmployeeReseller::where('reseller_id', $order->user->id)
            ->exists();

        if ($employee_reseller) {
            $employee_reseller = EmployeeReseller::where('reseller_id', $order->user->id)
                ->first();

            $employee_reseller->remaining_purchase_to_be_verified -= $order->grand_total;
            $employee_reseller->total_successful_orders += 1;

            $minimum_purchase = \App\AffiliateOption::where('type', 'minimum_first_purchase')->first()->percentage;

            if ($order->grand_total >= $minimum_purchase) {
                $user = User::where('id', $order->user->id)->first();

                if(env('APP_ENV') == 'production') {
                    $webhook = new WebhookController();
                    $webhook->send_webhook_response_new_reseller($user);
                }

                $employee_reseller->is_verified = 1;
            }

            $employee_reseller->save();
        }else{

            $reseller = \App\Reseller::where('user_id', $order->user->id)
                ->first();
            if($reseller && $order->payment_status == 'paid'){
                $minimum_purchase = \App\AffiliateOption::where('type', 'minimum_first_purchase')->first()->percentage;
                if ($order->grand_total >= $minimum_purchase) {
                    $user = User::where('id', $order->user->id)->first();

                    if(env('APP_ENV') == 'production') {
                        $webhook = new WebhookController();
                        $webhook->send_webhook_response_new_reseller($user);
                    }

                    $reseller->is_verified = 1;
                    $reseller->verified_at = \Carbon\Carbon::now();
                    $reseller->save();
                    if(env('APP_ENV') == 'production') {
                        // OVERRUNS TRIGGER SYNC FOR UPDATING USER IS_VERIFIED
                        $client = new \GuzzleHttp\Client();
                        $request = $client->get('https://overrun.worldcraft.com.ph/admin/submit_sync_wc_customers.php');
                    }
                }
            }

        }

        $employee_reseller_order = \App\EmployeeResellerOrder::where('order_id', $order->id)
            ->exists();

        if ($employee_reseller_order) {
            $employee_reseller_order = \App\EmployeeResellerOrder::where('order_id', $order->id)
                ->first();

            $employee_reseller_order->payment_status = $status;
            $employee_reseller_order->save();
        }

        if(env('APP_ENV') == 'production') {
            // Send update to api
            $update_payment_status_api = new \App\Http\Controllers\WorldcraftApiController;
            $update_payment_status_api->payment_status_update($order);

            $update_payment_status = new WebhookController();
            $update_payment_status->send_webhook_response_order_update($order);
        }

        return 1;
    }

    public function update_partial_release(Request $request, $id)
    {
        $this->validate($request, [
            'partial_released_qty' => 'required|numeric'
        ]);

        $order_detail = OrderDetail::where('id', $id)
            ->first();

        if ($order_detail->quantity > 1) {

            if ($request->partial_released_qty <= $order_detail->quantity) {
                $order_detail->partial_released = 1;
                $order_detail->partial_released_qty = $request->partial_released_qty;

                $order_detail->save();
            } else {
                flash(translate("You can't release quantity more than the ordered quantity"))->error();
                return redirect()->back();
            }
        } else {
            flash(translate('Sorry but you cannot partial release items with one quantity'))->error();
            return redirect()->back();
        }

        flash(translate("Partial release successfully saved"))->success();
        return redirect()->back();
    }

    /**
     * Upload CR Number
     */
    public function cr_number_old(Request $request)
    {
        $this->validate($request, [
            'cr_number' => 'required|unique:orders,cr_number,' . $request->order_id
        ]);

        if (Auth::user()->user_type == 'admin' || Auth::user()->staff->role->name == 'Treasurer') {
            $order = Order::findOrFail($request->order_id);

            if (Auth::user()->user_type != 'admin' && $order->som_number != null && $order->si_number != null && $order->dr_number != null) {
                flash(translate("Sorry but you can't edit the cr number!"));
            } else {
                $data = [];
                $data['user_id'] = Auth::user()->id;
                $data['order_id'] = $order->id;

                if ($order->cr_number == null) {
                    $data['activity'] = "Added CR Number: $request->cr_number";
                } else {
                    $data['activity'] = "Updated CR Number: From $order->cr_number to $request->cr_number";
                }

                $cmg_log = new CmgLogController;
                $cmg_log->store($data);

                $order->cr_number = $request->cr_number;

                if ($order->save()) {
                    flash(translate("CR Number successfully saved!"))->success();
                } else {
                    flash(translate('Something went wrong!'))->error();
                }
            }
        } else {
            flash(translate("Sorry, but you don't have the right permission to add on this column"))->warning();
        }

            //  Session::flash('remain_cmg_tab','save');
            // return Session::get('remain_cmg_tab');
            return back()->with('remain_cmg_tab' ,'save');
    }
    public function cr_number(Request $request)
    {
        if (Auth::user()->user_type == 'admin' || Auth::user()->staff->role->name == 'Treasurer') {
            $order = Order::findOrFail($request->order_id);

            $possible_spelled = ['cancel', 'cancell','canceled','cancelled'];

            $cr_number = $request->cr_number;

            $inputted_cancel_cr_number =  preg_replace('/[^a-zA-Z0-9_ -]/s','',$request->cr_number);
            if(in_array($inputted_cancel_cr_number, $possible_spelled)) {
                $activity = "Cancelled CR Number: From $order->cr_number";
                $cr_number = null;
            }
            else {
                $this->validate($request, [
                    'cr_number' => 'required|unique:orders,cr_number,' . $request->order_id
                ]);

                if (Auth::user()->user_type != 'admin' && $order->som_number != null && $order->si_number != null && $order->dr_number != null) {
                    flash(translate("Sorry but you can't edit the cr number!"));
                }
                else{
                    if ($order->cr_number == null) {
                        $activity =  "Added CR Number: $request->cr_number";
                    } else {
                        $activity =  "Updated CR Number: From $order->cr_number to $request->cr_number";
                    }
                }
            }

            $data = [];
            $data['user_id'] = Auth::user()->id;
            $data['order_id'] = $order->id;
            $data['activity'] = $activity;

            $cmg_log = new CmgLogController;
            $cmg_log->store($data);

            $order->cr_number = $cr_number;

            if ($order->save()) {
                flash(translate("CR Number successfully saved!"))->success();
            } else {
                flash(translate('Something went wrong!'))->error();
            }
        } else {
            flash(translate("Sorry, but you don't have the right permission to add on this column"))->warning();
        }

        //  Session::flash('remain_cmg_tab','save');
        // return Session::get('remain_cmg_tab');
        return back()->with('remain_cmg_tab' ,'save');
    }

    /**
     * Upload CMG Number
     */
    public function upload_cmg(Request $request)
    {
        $this->validate($request, [
            'som_number' => 'required|unique:orders,som_number,' . $request->order_id,
            'som_number_date' => 'required|date',
            'si_number' => 'required|unique:orders,si_number,' . $request->order_id,
            'si_number_date' => 'required|date',
            'dr_number' => 'required|unique:orders,dr_number,' . $request->order_id,
            'dr_number_date' => 'required|date'
        ]);

        if (Auth::user()->user_type == 'admin' || Auth::user()->staff->role->name != 'CMG') {
            flash(translate("Sorry, but you don't have the right permission to add on this column"))->warning();
        } else {
            $order = Order::findOrFail($request->order_id);

            if ($order) {
                if ($request->has('som_number') && $request->som_number != $order->som_number) {
                    $data = [];
                    $data['user_id'] = Auth::user()->id;
                    $data['order_id'] = $order->id;

                    if ($order->som_number == null) {
                        $data['activity'] = "Added SOM Number: $request->som_number";
                    } else {
                        $data['activity'] = "Updated SOM Number: From $order->som_number to $request->som_number <br/> SOM Date: From $order->som_number_date to $request->som_number_date";
                    }

                    $cmg_log = new CmgLogController;
                    $cmg_log->store($data);
                }

                if ($request->has('si_number') && $request->si_number != $order->si_number) {
                    $data = [];
                    $data['user_id'] = Auth::user()->id;
                    $data['order_id'] = $order->id;

                    if ($order->si_number == null) {
                        $data['activity'] = "Added SI Number: $request->si_number";
                    } else {
                        $data['activity'] = "Updated SI Number: From: $order->si_number to $request->si_number <br/> SI Date: From $order->si_number_date to $request->si_number_date";
                    }

                    $cmg_log = new CmgLogController;
                    $cmg_log->store($data);
                }

                if ($request->has('dr_number') && $request->dr_number != $order->dr_number) {
                    $data = [];
                    $data['user_id'] = Auth::user()->id;
                    $data['order_id'] = $order->id;

                    if ($order->dr_number == null) {
                        $data['activity'] = "Added DR Number: $request->dr_number";
                    } else {
                        $data['activity'] = "Updated DR Number: From $order->dr_number to $request->dr_number <br/> DR Date: From $order->dr_number_date to $request->dr_number_date";
                    }

                    $cmg_log = new CmgLogController;
                    $cmg_log->store($data);
                }

                $order->som_number          = $request->som_number;
                $order->som_number_date     = $request->som_number_date;
                $order->si_number           = $request->si_number;
                $order->si_number_date      = $request->si_number_date;
                $order->dr_number           = $request->dr_number;
                $order->dr_number_date      = $request->dr_number_date;

                if ($order->save()) {
                    flash(translate("CMG Number's successfully updated"))->success();

                }
            } else {
                flash(translate('Something went wrong!'))->failed();
            }

            return back()->with('remain_cmg_tab' ,'save');
            // return redirect()->back();
        }
    }

    public function cancel($id, $reason = null){
        $order = Order::findOrFail($id);

        if ($order != null) {
            if($order->payment_status == 'paid') {
                flash(translate('The cashier has already paid for this order.'))->error();
                return back();
            }
            // Return stocks
            if($order->payment_status === 'paid'){
                foreach ($order->orderDetails as $order_detail) {
                    $pickup_point_location = \App\PickupPoint::where('name', ucfirst(str_replace('_', ' ', $order->pickup_point_location)))->first();

                    if ($pickup_point_location != null) {
                        if ($order_detail->variation != null || $order_detail->variation != "") {
                            $product_stock = \App\ProductStock::where('product_id', $order_detail->product_id)
                                ->where('variant', $order_detail->variation)
                                ->first();

                            if ($product_stock != null) {
                                $qty_ordered = $order_detail->quantity;

                                $worldcraft_stock = \App\WorldcraftStock::where('sku_id', $product_stock->sku)
                                    ->where('pup_location_id', $pickup_point_location->id)
                                    ->first();

                                $worldcraft_stock->quantity += $qty_ordered;
                                $worldcraft_stock->save();
                            }
                        } else {
                            $qty_ordered = $order_detail->quantity;

                            $worldcraft_stock = \App\WorldcraftStock::where('sku_id', $order_detail->product->sku)
                                ->where('pup_location_id', $pickup_point_location->id)
                                ->first();

                            if ($worldcraft_stock != null) {
                                $worldcraft_stock->quantity += $qty_ordered;
                                $worldcraft_stock->save();
                            }
                        }
                    }
                }
            }

            if(env('APP_ENV') == 'production') {
                // Pass cancelled order api
                $pass_cancelled_order = new \App\Http\Controllers\WorldcraftApiController;
                $pass_cancelled_order->cancelled_order($order);

                $update_delivery_status = new WebhookController();
                $update_delivery_status->send_webhook_response_cancel_order($order);
            }

            // Save declined order
            $declined_order = new OrderDeclinedController;
            $order->type = 'customer_cancel';
            $declined_order->store($order);

            foreach ($order->orderDetails as $key => $orderDetail) {
                if($order->payment_status === 'paid'){
                    try {
                        if ($orderDetail->variation != null) {
                            $product_stock = ProductStock::where('product_id', $orderDetail->product_id)->where('variant', $orderDetail->variation)->first();

                            if ($product_stock != null) {
                                $product_stock->qty += $orderDetail->quantity;
                                $product_stock->save();
                            }
                        } else {
                            $product = $orderDetail->product;
                            $product->current_stock += $orderDetail->quantity;
                            $product->save();
                        }
                    } catch (\Exception $e) {
                    }
                }

                $orderDetail->delete();
            }
            $order->delete();

            flash(translate('Order successfully deleted'))->success();
        } else {
            flash(translate('Something went wrong'))->error();
        }
        return back();
    }

    public function refund($id, $refund_reason){
        $order = Order::findOrFail($id);

        if ($order != null) {
            // Return stocks
            if($order->payment_status === 'paid' && $refund_reason !== 'Defected Product'){
                foreach ($order->orderDetails as $order_detail) {
                    $pickup_point_location = \App\PickupPoint::where('name', ucfirst(str_replace('_', ' ', $order->pickup_point_location)))->first();

                    if ($pickup_point_location != null) {
                        if ($order_detail->variation != null || $order_detail->variation != "") {
                            $product_stock = \App\ProductStock::where('product_id', $order_detail->product_id)
                                ->where('variant', $order_detail->variation)
                                ->first();

                            if ($product_stock != null) {
                                $qty_ordered = $order_detail->quantity;

                                $worldcraft_stock = \App\WorldcraftStock::where('sku_id', $product_stock->sku)
                                    ->where('pup_location_id', $pickup_point_location->id)
                                    ->first();

                                $worldcraft_stock->quantity += $qty_ordered;
                                $worldcraft_stock->save();
                            }
                        } else {
                            $qty_ordered = $order_detail->quantity;

                            $worldcraft_stock = \App\WorldcraftStock::where('sku_id', $order_detail->product->sku)
                                ->where('pup_location_id', $pickup_point_location->id)
                                ->first();

                            if ($worldcraft_stock != null) {
                                $worldcraft_stock->quantity += $qty_ordered;
                                $worldcraft_stock->save();
                            }
                        }
                    }
                }
            }
            if(env('APP_ENV') == 'production') {
                // Pass cancelled order api
                $pass_cancelled_order = new \App\Http\Controllers\WorldcraftApiController;
                $pass_cancelled_order->cancelled_order($order);

                $update_delivery_status = new WebhookController();
                $update_delivery_status->send_webhook_response_cancel_order($order);
            }


            // Save declined order
            $declined_order = new OrderDeclinedController;
            $order->type = 'fm_cancel';
            $declined_order->store($order);

            foreach ($order->orderDetails as $key => $orderDetail) {
                if($order->payment_status === 'paid' && $refund_reason !== 'Defected Product'){
                    try {
                        if ($orderDetail->variation != null) {
                            $product_stock = ProductStock::where('product_id', $orderDetail->product_id)->where('variant', $orderDetail->variation)->first();

                            if ($product_stock != null) {
                                $product_stock->qty += $orderDetail->quantity;
                                $product_stock->save();
                            }
                        } else {
                            $product = $orderDetail->product;
                            $product->current_stock += $orderDetail->quantity;
                            $product->save();
                        }
                    } catch (\Exception $e) {
                    }
                }

                $orderDetail->delete();
            }
            $order->delete();

            flash(translate('Order successfully deleted'))->success();
        } else {
            flash(translate('Something went wrong'))->error();
        }
        return back();
    }

    public function export(Request $request) {
        try {
            $ids = explode(",", $request->order_ids);

            $orders = Order::whereIn('id', $ids)->get();
            return Excel::download(new OrdersExport($orders), 'exported_order.xlsx');
        }
        catch(\Exception $ex) {
            return flash(translate('Server Error'))->danger();
        }
    }


    public function order_export(Request $request) {
        try {
            $ids = explode(",", $request->order_ids);

            $orders = Order::whereIn('id', $ids)->get();
            return view('backend.sales.all_orders.export-filtered', compact('orders'));
        }
        catch(\Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function recalculate_coupon_discount($coupon_id) {
        return;
        $coupon = Coupon::find($coupon_id);

        $coupon_discount = Session::get('coupon_discount');

        if($coupon->type == 'cart_base') {
            try {
                $coupon_discount = 0;
                if($coupon->discount_type == 'percent') {
                    $coupon_discount = ($total_price * $coupon->discount) / 100;
                }
                else {
                    $coupon_discount = $total_price - $coupon->discount;
                }
            }
            catch(\Throwable $th) {
            }
        }
        else {
            $coupon_discount = Session::get('coupon_discount');

            $coupon_details = json_decode($coupon->details);
            try {
                $coupon_discount = 0;
                foreach (Session::get('toCheckout') as $key => $cartItem) {
                    foreach ($coupon_details as $coupon_detail) {
                        if ($coupon_detail->product_id == $cartItem->id) {
                            if ($coupon->discount_type == 'percent') {
                                $coupon_discount += $cartItem->price * (int) $cartItem->quantity * $coupon->discount / 100;
                            } else if ($coupon->discount_type == 'amount') {
                                $coupon_discount += $coupon->discount;
                            }
                        }
                    }
                }
            } catch (\Throwable $th) {
            }
        }

        return $coupon_discount;
    }
    public function deliveries(Request $request) {

        $sort_search = null;

        if ($request->search != null) {
            $sort_search = $request->search;
        }

        $orders = Order::where('service_type','in_house_delivery')->where('code','LIKE','%'.$sort_search.'%')->orderBy('id','desc')->paginate(10);
        return view('backend.deliveries.index', compact('orders','sort_search'));
    }
    public function check_soh_stock($location_id, $sku) {
        try {
            if(env('APP_ENV') == 'staging') {

                // Initializing database connection of SOH System
                $soh_connection = DB::connection('mysql_soh_staging');
            }
            elseif(env('APP_ENV') == 'production') {
                // Initializing database connection of SOH System
                $soh_connection = DB::connection('mysql_soh');
            }
            else {
                return 1;
            }

            // RECEIVED FROM WAREHOUSE
            $received_wh = $soh_connection->table('tbl_transfer')->where([
                'to_location_id' => $location_id,
                'sku' => $sku,
                'status' => 'received'
            ])->sum('qty_received');

            // RECEIVED FROM SUPPLIER
            $received_supp = $soh_connection->table('tbl_incoming')->where([
                'location_id' => $location_id,
                'sku' => $sku
            ])->whereNotNull('ata_created')->sum('received_qty');

            // DEFECTIVE
            $defective = $soh_connection->table('tbl_defective')->where([
                'location_id' => $location_id,
                'sku' => $sku
            ])->sum('defective_qty');

            // TRANSFER
            $transfer = $soh_connection->table('tbl_transfer')->where([
                'from_location_id' => $location_id,
                'sku' => $sku
            ])->whereIn('status', ['received', 'assigned'])->sum('qty_assigned');

            // RETURNED
            $returned = $soh_connection->table('tbl_returned')->where([
                'location_id' => $location_id,
                'sku' => $sku
            ])->sum('returned_qty');
                        // // QUERY ORDERS
                        // $orders = $soh_connection->table('tbl_order_details')->leftJoin('tbl_order','tbl_order.order_code','tbl_order_details.order_code')
                        // ->where([
                        //    'tbl_order.pickup_point_id' => $location_id,
                        //    'tbl_order_details.sku' => $sku
                        // ])
                        // ->select('tbl_order.pickup_point_id','tbl_order.order_status','tbl_order_details.sku','tbl_order_details.quantity');


                        // // PAID ORDER
                        // $paid_orders = $orders->where('tbl_order.order_status','paid')->sum('tbl_order_details.quantity');

                        // // UNPAID ORDER
                        // $unpaid_orders = $orders->whereIn('tbl_order.order_status', [null, 'unpaid',''])->sum('tbl_order_details.quantity');


            // PAID ORDER
            $paid_orders = $soh_connection->table('tbl_order_details')->leftJoin('tbl_order','tbl_order.order_code','tbl_order_details.order_code')
                                          ->where([
                                            'tbl_order.pickup_point_id' => $location_id,
                                            'tbl_order_details.sku' => $sku,
                                            'tbl_order.order_status' => 'paid'
                                            ])
                                          ->select('tbl_order.pickup_point_id','tbl_order.order_status','tbl_order_details.sku','tbl_order_details.quantity')
                                          ->sum('tbl_order_details.quantity');

            // UNPAID ORDER
            $unpaid_orders = $soh_connection->table('tbl_order_details')->leftJoin('tbl_order','tbl_order.order_code','tbl_order_details.order_code')
                                            ->where([
                                                'tbl_order.pickup_point_id' => $location_id,
                                                'tbl_order_details.sku' => $sku
                                            ])->whereIn('tbl_order.order_status', [null, 'unpaid',''])
                                            ->select('tbl_order.pickup_point_id','tbl_order.order_status','tbl_order_details.sku','tbl_order_details.quantity')
                                            ->sum('tbl_order_details.quantity');

            // CANCELLED ORDER
            $cancelled_orders = $soh_connection->table('tbl_order_details')->leftJoin('tbl_order','tbl_order.order_code','tbl_order_details.order_code')
                                            ->where([
                                                'tbl_order.pickup_point_id' => $location_id,
                                                'tbl_order_details.sku' => $sku,
                                                'tbl_order.order_status' => 'Cancelled'
                                            ])
                                            ->select('tbl_order.pickup_point_id','tbl_order.order_status','tbl_order_details.sku','tbl_order_details.quantity')
                                            ->sum('tbl_order_details.quantity');

            // ADVANCED ORDER
            $advanced_orders = $soh_connection->table('tbl_order_details')->leftJoin('tbl_order','tbl_order.order_code','tbl_order_details.order_code')
                                              ->where([
                                                'tbl_order.pickup_point_id' => $location_id,
                                                'tbl_order_details.sku' => $sku,
                                                'tbl_order_details.order_type' => 'advance_order'
                                                ])
                                              ->where('tbl_order.order_status','!=','Cancelled')
                                              ->select('tbl_order.pickup_point_id','tbl_order.order_status','tbl_order_details.sku','tbl_order_details.quantity')
                                              ->sum('tbl_order_details.quantity');

            // ADJUSTMENT
            $adjustment_qty_add = $soh_connection->table('tbl_adjustment')->where([
                'location_id' => $location_id,
                'sku' => $sku,
                'change_status' => 'add'
            ])->sum('adjustment_qty');
            $adjustment_qty_remove = $soh_connection->table('tbl_adjustment')->where([
                'location_id' => $location_id,
                'sku' => $sku,
                'change_status' => 'remove'
            ])->sum('adjustment_qty');

            $adjustment = $adjustment_qty_add - $adjustment_qty_remove;

            // get the total net saleable
            $net_saleable = ($received_wh + $received_supp + $adjustment + $returned) - ($defective + $transfer + $paid_orders);
            // ($receive_qty_array[$i] +$incoming_qty_array[$i] +$adjustment_qty_array[$i] +$returned_qty_array[$i]) - ($defective_qty_array[$i] + $transfer_qty_array[$i] + $order_qty_paid_array[$i])
            // return $received_wh.' '.$received_supp.' '.$defective.' '.$transfer.' '.$returned.' '.$paid_orders.' '.$unpaid_orders.' '.$cancelled_orders.' '.$adjustment.' '.$advanced_orders;
            return $net_saleable;
        }
        catch(\Throwable $th) {
            return $th->getMessage();
        }
        return $location_id.' - '.$sku;
    }
    public function delivery_show($id) {
        $order = Order::find(decrypt($id));
        $delivery_logs = DeliveryLogs::where('order_id', $order->id)->get()->toArray();
        end($delivery_logs); // Move the pointer to the last element
        $lastKey = key($delivery_logs); // Get the key of the last element
        return view('backend.deliveries.show', compact('order','delivery_logs','lastKey'));
    }
    public function delivered_post(Request $request) {
        try {
            $delivery_logs_last = DeliveryLogs::where('order_id', $request->order_id)->orderBy('id','desc')->first()->delivery_status;

            if($delivery_logs_last == 'for_delivery' || $delivery_logs_last == 'no_person_to_receive' || $delivery_logs_last == 'unknown_address') {
                if($request->photos == null) {
                    flash('Please upload proof of delivery.')->error();
                    return back();
                }
            }
            // dd($request->all());
            $delivery_update = new DeliveryLogs();
            $delivery_update->order_id = $request->order_id;
            $delivery_update->delivery_date = now()->format('Y-m-d H:i:s');
            $delivery_update->delivery_status = $request->delivery_status;
            $delivery_update->updated_by = auth()->user()->id;
            $delivery_update->photos = $request->photos != null ? '['.$request->photos.']' : null;

            if($request->delivery_status == 'failed') {
                $reason = $request->reason;
                if($reason == 'other') {
                    $reason = 'Other: '.$request->other_reason;
                }
                $delivery_update->failed_reason = $reason;
            }
            if($request->delivery_status == 'rescheduling') {
                $delivery_update->rescheduled_date = date('Y-m-d H:i', strtotime($request->delivery_date_schedule));
            }
            if($delivery_update->save()) {
                if($request->delivery_status == 'failed') {
                    $order = Order::find($request->order_id);
                    $otpController = new OTPVerificationController;
                    $otpController->send_failed_delivery($order);
                }
                elseif($request->delivery_status == 'rescheduling') {
                    $order = Order::find($request->order_id);
                    $otpController = new OTPVerificationController;
                    $otpController->send_failed_delivery($order);
                }
                // return ;
                flash('Order has been updated.')->success();
                return back();
            }
            else {
                flash('Something went wrong.')->error();
                return back();
            }
        }
        catch (\Throwable $th) {
            flash($th->getMessage())->error();
            return back();
        }
        dd($request->all());
    }
    public function redeliver_cr_number(Request $request) {
        try {
            if (Auth::user()->user_type == 'admin' || Auth::user()->staff->role->name == 'Treasurer') {
                \App\RedeliverReceipt::create([
                    'user_id' => Auth::user()->id,
                    'order_id' => $request->order_id,
                    'delivery_update_log_id' => $request->log_id,
                    'log' => $request->cr_number
                ]);
                flash(translate("CR Number successfully saved!"))->success();
            }
            else{
                flash(translate("Sorry, but you don't have the right permission to add on this column"))->warning();
            }
        }
        catch(\Throwable $th) {
            flash($th->getMessage())->error();
        }
        return back();
    }
    public function show_proofs(Request $request) {
        $images = json_decode(DeliveryLogs::where('id', $request->log_id)->first()->photos);
        foreach($images as $image) {
            $src[] = uploaded_asset($image);
        }

        // return $im
        return response()->json(['data' => $src]);
    }
    public function update_ps_approve(Request $request) {
        try {
            // $user_id = Auth::user()->id;
            $logs = PackingSlipApproversLog::where('order_id', $request->order_id)->first();
            $status = $request->status;

            if($logs) {
                if($request->user_type == 'cnc') {
                    $logs->cnc_user_id = $status == 'yes' ? $request->user_id : NULL;
                    $logs->cnc_approved_at = $status == 'yes' ? now()->format('Y-m-d H:i:s') : NULL;
                }
                else if($request->user_type == 'cmg') {
                    $logs->cmg_user_id = $status == 'yes' ? $request->user_id : NULL;
                    $logs->cmg_approved_at = $status == 'yes' ? now()->format('Y-m-d H:i:s') : NULL;
                }
                else if($request->user_type == 'accounting') {
                    $logs->accounting_user_id = $status == 'yes' ? $request->user_id : NULL;
                    $logs->accounting_approved_at = $status == 'yes' ? now()->format('Y-m-d H:i:s') : NULL;
                }
                $logs->update();

                if($status == 'yes') {
                    flash(translate('You are allowing to print the packing slip of this order.'))->success();
                }
                else {
                    flash(translate('Printing the packing slip for this order is not permitted.'))->info();
                }

                try {
                    \App\PsApproversActivity::create([
                        'order_id' => $request->order_id,
                        'user_id' => $request->user_id,
                        'type'  => $request->user_type,
                        'action' => $status
                    ]);
                }
                catch(\Throwable $th) {

                }

                return redirect()->back();
            }
            else {
                flash('Something went wrong.')->error();
                return redirect()->back();
            }
        }
        catch(\Throwable $th) {
            flash(translate($th->getMessage()))->error();
            return redirect()->back();
        }

    }
}
