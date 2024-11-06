@extends('master')

@section('index')
<!-- My Account Section Start -->
<div class="section section-padding mt-n6">
    <div class="container" style="max-width: 80%;">
        <div class="row">
            <div class="col-xl-3 col-md-4">
                <!-- My Account Menu Start -->
                <div class="my-account-menu mt-6">
                    <ul class="nav account-menu-list flex-column">
                        <li>
                            <a class="active" data-bs-toggle="pill" href="#pills-dashboard"><i
                                    class="fa fa-tachometer"></i> Dashboard</a>
                        </li>
                        <li>
                            <a data-bs-toggle="pill" href="#pills-order">Purchased Orders</a>
                        </li>
                        <li>
                            <a data-bs-toggle="pill" href="#pills-return"> Return Orders</a>
                        </li>
                        <li>
                            <a data-bs-toggle="pill" href="#pills-decline"> Declined Orders</a>
                        </li>
                        <li>
                            <a data-bs-toggle="pill" href="#pills-perfrep"> Performance Report</a>
                        </li>
                        <li>
                            <a data-bs-toggle="pill" href="#pills-account"><i class="fa fa-user"></i> Account
                                Details</a>
                        </li>
                        <li>
                            <a href="{{ route('logout.user') }}"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- My Account Menu End -->
            </div>
            <div class="col-xl-9 col-md-8">
                <!-- Tab content start -->
                <div class="tab-content my-account-tab mt-6">
                    <div class="tab-pane fade show active" id="pills-dashboard">
                        <div class="my-account-dashboard account-wrapper">
                            <h4 class="account-title">Dashboard</h4>
                            <div class="welcome-dashboard">
                                <p>Hello, <strong>{{ Auth::user()->name }}</strong></p>
                            </div>
                            <p class="mt-25">From your account dashboard. you can easily check & view your recent
                                orders, manage your shipping and billing addresses account details.</p>
                        </div>

                        <hr>
                        <br>
                        <br>

                        @php
                        use Illuminate\Support\Facades\Auth;
                        if (Auth::check()) {
                        $count_item_cart = DB::table('carts')->where('user_id', Auth::user()->id)->count();
                        $count_item_wishlist = DB::table('wishlists')->where('user_id', Auth::user()->id)->count();
                        $count_item_ordered = DB::table('orders')->where('user_id', Auth::user()->id)->count();
                        } else {
                        $count_item_cart = 0;
                        $count_item_wishlist = 0;
                        $count_item_ordered = 0;
                        }
                        @endphp

                        <div class="row gutters-10 mb-3">
                            <div class="col-12 col-md-4 mb-2">
                                <div class="card shadow p-5 mb-5 bg-success text-white rounded">
                                    <div class="card-body">
                                        <div class="cart-craft-count cart-craft-count-success">
                                            <div class="d-flex justify-content-between w-100">
                                                <div>
                                                    <div class="cart-craft-count-title">
                                                        <h4> <b>{{ $count_item_cart }}</b> </h4>
                                                    </div>
                                                    <div class="cart-craft-count-subtitle">
                                                        Product(s) in cart
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="float-right d-flex align-items-center h-100">
                                                        <svg width="31" height="31" viewBox="0 0 31 31" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M23.6323 15.4613C23.1931 16.2621 22.3406 16.7917 21.3719 16.7917H11.749L10.3281 19.375H25.8281V21.9583H10.3281C8.36479 21.9583 7.12479 19.8529 8.06771 18.1221L9.81146 14.9704L5.16146 5.16668H2.57812V2.58334H6.80188L8.01604 5.16668H27.1327C28.1144 5.16668 28.7344 6.22584 28.2565 7.07834L23.6323 15.4613ZM24.9369 7.75001H9.24312L12.3044 14.2083H21.3719L24.9369 7.75001ZM10.3281 23.25C8.90729 23.25 7.75771 24.4125 7.75771 25.8333C7.75771 27.2542 8.90729 28.4167 10.3281 28.4167C11.749 28.4167 12.9115 27.2542 12.9115 25.8333C12.9115 24.4125 11.749 23.25 10.3281 23.25ZM20.6744 25.8333C20.6744 24.4125 21.824 23.25 23.2448 23.25C24.6656 23.25 25.8281 24.4125 25.8281 25.8333C25.8281 27.2542 24.6656 28.4167 23.2448 28.4167C21.824 28.4167 20.6744 27.2542 20.6744 25.8333Z"
                                                                fill="white" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                <div class="card shadow p-5 mb-5 text-white rounded"
                                    style="background-color: #e8ae00 !important; ">
                                    <div class="card-body">
                                        <div class="cart-craft-count cart-craft-count-warning">
                                            <div class="d-flex justify-content-between w-100">
                                                <div>
                                                    <div class="cart-craft-count-title">
                                                        <h4><b>{{ $count_item_wishlist }}</b></h4>
                                                    </div>
                                                    <div class="cart-craft-count-subtitle">
                                                        Product(s) in Wishlist
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="float-right d-flex align-items-center h-100">
                                                        <svg width="31" height="31" viewBox="0 0 31 31" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15.6045 25.4569L8.11364 18.4828C7.79091 18.1983 5 15.6595 5 12.5C5 8.59052 7.58182 6 11.9091 6C13.7909 6 15.5727 6.98276 17 8.14655C18.4227 6.98276 20.2091 6 22.0909 6C26.2591 6 29 8.43534 29 12.5C29 14.7414 27.5545 16.9612 25.9045 18.4784L25.8864 18.4957L18.3955 25.4569C18.0237 25.8049 17.5224 26 17 26C16.4776 26 15.9763 25.8049 15.6045 25.4569ZM9.63182 16.9957L17 23.8578L24.3545 17.0172C25.5955 15.8534 26.8182 14.1595 26.8182 12.5C26.8182 9.61638 25.0818 8.06896 22.0909 8.06896C19.9455 8.06896 17.8727 10.194 17 11.0172C16.2273 10.2845 14.0909 8.06896 11.9091 8.06896C8.91364 8.06896 7.18182 9.61638 7.18182 12.5C7.18182 14.1078 8.39545 15.9009 9.63182 16.9957Z"
                                                                fill="white" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                <div class="card shadow p-5 mb-5 text-white rounded"
                                    style="background-color: #040dae !important; ">
                                    <div class="card-body">
                                        <div class="cart-craft-count cart-craft-count-primary">
                                            <div class="d-flex justify-content-between w-100">
                                                <div>
                                                    <div class="cart-craft-count-title">
                                                        <h4><b>{{ $count_item_ordered }}</b></h4>
                                                    </div>
                                                    <div class="cart-craft-count-subtitle">
                                                        Product(s) ordered
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="float-right d-flex align-items-center h-100">
                                                        <svg width="31" height="31" viewBox="0 0 31 31" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M25.1875 4.52087L23.25 2.58337L21.3125 4.52087L19.375 2.58337L17.4375 4.52087L15.5 2.58337L13.5625 4.52087L11.625 2.58337L9.6875 4.52087L7.75 2.58337L5.8125 4.52087L3.875 2.58337V28.4167L5.8125 26.4792L7.75 28.4167L9.6875 26.4792L11.625 28.4167L13.5625 26.4792L15.5 28.4167L17.4375 26.4792L19.375 28.4167L21.3125 26.4792L23.25 28.4167L25.1875 26.4792L27.125 28.4167V2.58337L25.1875 4.52087ZM24.5417 24.658H6.45833V6.34212H24.5417V24.658ZM23.25 19.375H7.75V21.9584H23.25V19.375ZM7.75 14.2084H23.25V16.7917H7.75V14.2084ZM23.25 9.04171H7.75V11.625H23.25V9.04171Z"
                                                                fill="white" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Recent purchase --}}
                        {{-- <div class="row">
                            <div class="col-12">
                                <h4 class="customer-craft-dashboard-subtitle mb-3">{{ translate('My recent purchase') }}
                                </h4>
                                @foreach ($orders as $key => $order)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6 class="customer-craft-dashboard-card-title mb-0">
                                                    Order Code: <span style="color: #161DBC;">{{ $order->code ?? "N/A"
                                                        }}</span>
                                                </h6>
                                            </div>

                                            <div class="col-6">
                                                <a href="{{ route('purchase_history.show', encrypt($order->id ?? " N/A"
                                                    )) }}"
                                                    class="customer-craft-dashboard-card-subtitle float-md-right mt-2 mt-md-0 d-flex justify-content-end">View
                                                    Order Details</a>
                                            </div>
                                        </div>
                                        <hr>
                                        @foreach ($order->orderDetails as $key => $orderDetail)
                                        <div class="row mb-3">
                                            <div class="col-3 col-lg-1">
                                                @php
                                                $product_image = null;

                                                if ($orderDetail->product != null) {
                                                if ($orderDetail->variation != "") {
                                                $product_image = \App\Models\ProductStock::where('product_id',
                                                $orderDetail->product_id)
                                                ->where('variant', $orderDetail->variation)
                                                ->first();

                                                if ($product_image != null) {
                                                $product_image = uploaded_asset($product_image->image);
                                                }

                                                else {
                                                $product_image = uploaded_asset($orderDetail->product->thumbnail_img);
                                                }
                                                }

                                                else {
                                                $product_image = uploaded_asset($orderDetail->product->thumbnail_img);
                                                }
                                                }
                                                @endphp
                                                <img class="img-fluid lazyload craft-purchase-history-image"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ $product_image }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                            </div>
                                            <div class="col-9 col-lg-4">
                                                <div
                                                    class="d-flex align-items-center h-100 craft-purchase-history-name">
                                                    @if ($orderDetail->product != null)
                                                    <a href="{{ route('product', $orderDetail->product->slug ?? " N/A")
                                                        }}" target="_blank">
                                                        {{ $orderDetail->product->getTranslation('name') ?? "N/A" }}

                                                        @if ($orderDetail->variation != null)
                                                        - {{ $orderDetail->variation }}
                                                        @endif

                                                        @if ($orderDetail->order_type == 'same_day_pickup')
                                                        <div class="d-block craft-purchase-history-pickup-time">
                                                            <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M6.49967 1.08337C3.50967 1.08337 1.08301 3.51004 1.08301 6.50004C1.08301 9.49004 3.50967 11.9167 6.49967 11.9167C9.48967 11.9167 11.9163 9.49004 11.9163 6.50004C11.9163 3.51004 9.48967 1.08337 6.49967 1.08337ZM6.49967 10.8334C4.11092 10.8334 2.16634 8.88879 2.16634 6.50004C2.16634 4.11129 4.11092 2.16671 6.49967 2.16671C8.88842 2.16671 10.833 4.11129 10.833 6.50004C10.833 8.88879 8.88842 10.8334 6.49967 10.8334ZM5.41634 7.67546L8.98592 4.10587L9.74967 4.87504L5.41634 9.20837L3.24967 7.04171L4.01342 6.27796L5.41634 7.67546Z"
                                                                    fill="#10865C" />
                                                            </svg>
                                                            {{ translate('Same day pickup') }}
                                                        </div>
                                                        @else
                                                        <div class="d-block craft-purchase-history-advance-order">
                                                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M5.49475 0.083313C2.50475 0.083313 0.0834961 2.50998 0.0834961 5.49998C0.0834961 8.48998 2.50475 10.9166 5.49475 10.9166C8.49016 10.9166 10.9168 8.48998 10.9168 5.49998C10.9168 2.50998 8.49016 0.083313 5.49475 0.083313ZM5.50016 9.83331C3.106 9.83331 1.16683 7.89415 1.16683 5.49998C1.16683 3.10581 3.106 1.16665 5.50016 1.16665C7.89433 1.16665 9.8335 3.10581 9.8335 5.49998C9.8335 7.89415 7.89433 9.83331 5.50016 9.83331ZM4.9585 2.79165H5.771V5.6354L8.2085 7.08165L7.80225 7.7479L4.9585 6.04165V2.79165Z"
                                                                    fill="#E49F1A" />
                                                            </svg>
                                                            {{ translate('Advance order') }}
                                                        </div>
                                                        @endif
                                                    </a>
                                                    @else
                                                    <strong>{{ translate('Product Unavailable') }}</strong>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-2 d-flex align-items-center justify-content-end">
                                                <div class="craft-purchase-history-quantity">
                                                    <span class="opacity-50">Qty: </span><span style="color: #31303E">{{
                                                        $orderDetail->quantity ?? "N/A" }}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-5 d-flex align-items-center justify-content-end">
                                                <div class="craft-purchase-history-price">
                                                    {{ single_price($orderDetail->price ?? "N/A") }}
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <div class="align-items-start">


                                            </div>
                                            <div class="align-items-end">
                                                <div class="d-flex align-items-center">
                                                    <div class="purchase-history-total-label">
                                                        Total:
                                                    </div>
                                                    <div class="purchase-history-total-price">
                                                        {{ single_price($order->grand_total ?? "N/A") }}
                                                    </div>
                                                </div>
                                                <div class="float-right">
                                                    <p
                                                        class="@if ($order->payment_status == 'paid') text-success @else text-danger @endif mb-0">
                                                        {{ ucfirst($order->payment_status ?? "N/A") }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="account-table text-center mt-30 table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="no">No</th>
                                                <th class="name">Name</th>
                                                <th class="date">Date</th>
                                                <th class="status">Status</th>
                                                <th class="total">Total</th>
                                                <th class="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Mostarizing Oil</td>
                                                <td>Aug 22, 2020</td>
                                                <td>Pending</td>
                                                <td>$100</td>
                                                <td><a href="#">View</a></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Katopeno Altuni</td>
                                                <td>July 22, 2020</td>
                                                <td>Approved</td>
                                                <td>$45</td>
                                                <td><a href="#">View</a></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Murikhete Paris</td>
                                                <td>June 22, 2020</td>
                                                <td>On Hold</td>
                                                <td>$99</td>
                                                <td><a href="#">View</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-12">
                                <h4 class="customer-craft-dashboard-subtitle mb-3">{{ translate('My recent purchase') }}
                                </h4>

                                @php
                                $orders = 0;
                                @endphp

                                @if($orders == 0)
                                <div class="text-center mt-5">
                                    <img src="{{ asset('/worldcraft/icons/no-purchase.png') }}" alt="No Purchases"
                                        class="mb-3" style="width: 100px; height: auto;">
                                    <p>{{ translate('No recent purchases found.') }}</p>
                                </div>
                                @else
                                <div class="account-table text-center mt-30 table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="no">No</th>
                                                <th class="name">Name</th>
                                                <th class="date">Date</th>
                                                <th class="status">Status</th>
                                                <th class="total">Total</th>
                                                <th class="action">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($orders as $key => $order)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $order->name ?? "N/A" }}</td>
                                                <td>{{ $order->date ?? "N/A" }}</td>
                                                <td>{{ ucfirst($order->status) ?? "N/A" }}</td>
                                                <td>{{ single_price($order->total) ?? "N/A" }}</td>
                                                <td><a href="{{ route('purchase_history.show', encrypt($order->id ?? "
                                                        N/A")) }}">View</a></td>
                                            </tr>
                                            @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-order">
                        <div class="my-account-order account-wrapper">
                            <h4 class="account-title">Purchased Orders</h4>

                            {{-- <div class="account-table text-center mt-30 table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="no">No</th>
                                            <th class="name">Name</th>
                                            <th class="date">Date</th>
                                            <th class="status">Status</th>
                                            <th class="total">Total</th>
                                            <th class="action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mostarizing Oil</td>
                                            <td>Aug 22, 2020</td>
                                            <td>Pending</td>
                                            <td>$100</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Katopeno Altuni</td>
                                            <td>July 22, 2020</td>
                                            <td>Approved</td>
                                            <td>$45</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Murikhete Paris</td>
                                            <td>June 22, 2020</td>
                                            <td>On Hold</td>
                                            <td>$99</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}

                            <div class="row">

                                <div class="col-12 mt-5 mb-5" style="margin-top: 50px;">
                                    @php
                                    $orders = 0;
                                    @endphp

                                    @if($orders == 0)
                                    <div class="text-center mt-5">
                                        <img src="{{ asset('/worldcraft/icons/no-purchase.png') }}" alt="No Purchases"
                                            class="mb-3" style="width: 100px; height: auto;">
                                        <p>{{ translate('No recent purchases found.') }}</p>
                                    </div>
                                    @else
                                    <div class="account-table text-center mt-30 table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="no">No</th>
                                                    <th class="name">Name</th>
                                                    <th class="date">Date</th>
                                                    <th class="status">Status</th>
                                                    <th class="total">Total</th>
                                                    <th class="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach ($orders as $key => $order)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $order->name ?? "N/A" }}</td>
                                                    <td>{{ $order->date ?? "N/A" }}</td>
                                                    <td>{{ ucfirst($order->status) ?? "N/A" }}</td>
                                                    <td>{{ single_price($order->total) ?? "N/A" }}</td>
                                                    <td><a href="{{ route('purchase_history.show', encrypt($order->id ?? "
                                                            N/A")) }}">View</a></td>
                                                </tr>
                                                @endforeach --}}
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-return">
                        <div class="my-account-download account-wrapper">
                            <h4 class="account-title">Return Orders</h4>
                            {{-- <table class="table">
                                <thead>
                                    <tr>
                                        <th class="name">Product</th>
                                        <th class="date">Date</th>
                                        <th class="status">Expire</th>
                                        <th class="action">Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mostarizing Oil</td>
                                        <td>Aug 22, 2020</td>
                                        <td>Yes</td>
                                        <td><a href="#">Download File</a></td>
                                    </tr>
                                    <tr>
                                        <td>Katopeno Altuni</td>
                                        <td>July 22, 2020</td>
                                        <td>Never</td>
                                        <td><a href="#">Download File</a></td>
                                    </tr>
                                </tbody>
                            </table> --}}
                            <div class="row">
                                <div class="col-12 mt-5 mb-5" style="margin-top: 50px;">
                                    {{-- @php
                                        $orders = 0;
                                        $return_orders = DB::table('orders')
                                                    ->where('user_id', Auth::user()->id)
                                                    ->where('payment_status', 'unpaid')
                                                    ->whereNotNull('deleted_at')
                                                    ->get();
                                    @endphp

                                    @if ($return_orders->isEmpty())
                                        <div class="text-center mt-5">
                                            <img src="{{ asset('/worldcraft/icons/no-purchase.png') }}" alt="No Purchases" class="mb-3" style="width: 100px; height: auto;">
                                            <p>{{ translate('No return purchases found.') }}</p>
                                        </div>
                                    @else

                                    @endif --}}

                                    @php
                                        $orders = 0;
                                    @endphp

                                    @if($orders == 0)
                                        <div class="text-center mt-5">
                                            <img src="{{ asset('/worldcraft/icons/no-purchase.png') }}" alt="No Purchases"
                                                class="mb-3" style="width: 100px; height: auto;">
                                            <p>{{ translate('No return purchases found.') }}</p>
                                        </div>
                                    @else

                                    @endif

                                    {{-- @if($orders == 0)
                                    <div class="text-center mt-5">
                                        <img src="{{ asset('/worldcraft/icons/no-purchase.png') }}" alt="No Purchases"
                                            class="mb-3" style="width: 100px; height: auto;">
                                        <p>{{ translate('No return purchases found.') }}</p>
                                    </div>
                                    @else --}}
                                    {{-- <div class="account-table text-center mt-30 table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="no">No</th>
                                                    <th class="name">Name</th>
                                                    <th class="date">Date</th>
                                                    <th class="status">Status</th>
                                                    <th class="total">Total</th>
                                                    <th class="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> --}}
                                                {{-- @foreach ($orders as $key => $order)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $order->name ?? "N/A" }}</td>
                                                    <td>{{ $order->date ?? "N/A" }}</td>
                                                    <td>{{ ucfirst($order->status) ?? "N/A" }}</td>
                                                    <td>{{ single_price($order->total) ?? "N/A" }}</td>
                                                    <td><a href="{{ route('purchase_history.show', encrypt($order->id ?? "
                                                            N/A")) }}">View</a></td>
                                                </tr>
                                                @endforeach --}}
                                                {{--
                                            </tbody>
                                        </table> --}}
                                        {{--
                                    </div> --}}
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-decline">
                        <div class="my-account-payment account-wrapper">
                            <h4 class="account-title">Declined Orders</h4>
                            <div class="row">
                                <div class="col-12 mt-5 mb-5" style="margin-top: 50px;">
                                    @php
                                        $orders = 0;
                                        $returnOrders = DB::table('orders')
                                                ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
                                                ->where('orders.payment_status', 'unpaid')
                                                ->whereNotNull('orders.deleted_at')
                                                ->select('orders.id', 'orders.user_id', 'orders.shipping_address', 'orders.pickup_point_location', 'order_details.product_id', 'order_details.item_code', 'order_details.price', 'order_details.quantity')
                                                ->limit(10)
                                                ->get();
                                    @endphp

                                    @if($returnOrders->isEmpty())
                                        <div class="text-center mt-5">
                                            <img src="{{ asset('/worldcraft/icons/no-purchase.png') }}" alt="No Purchases"
                                                class="mb-3" style="width: 100px; height: auto;">
                                            <p>{{ translate('No return purchases found.') }}</p>
                                        </div>
                                    @else
                                        <div class="account-table text-center mt-30 table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="no">No.</th>
                                                        <th class="order-id">Order ID</th>
                                                        {{-- <th class="address">Shipping Address</th> --}}
                                                        <th class="pickup-location">Pickup Point Location</th>
                                                        <th class="product-id">Product ID</th>
                                                        <th class="item-code">Item Code</th>
                                                        <th class="price">Price</th>
                                                        <th class="quantity">Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($returnOrders as $key => $order)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $order->id }}</td>
                                                            {{-- <td>{{ $order->shipping_address ?? 'N/A' }}</td> --}}
                                                            <td>{{ $order->pickup_point_location ?? 'N/A' }}</td>
                                                            <td>{{ $order->product_id ?? 'N/A' }}</td>
                                                            <td>{{ $order->item_code ?? 'N/A' }}</td>
                                                            <td>₱{{ number_format($order->price, 2) }}</td>
                                                            <td>{{ $order->quantity }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    {{-- <div class="account-table text-center mt-30 table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="no">No</th>
                                                    <th class="name">Name</th>
                                                    <th class="date">Date</th>
                                                    <th class="status">Status</th>
                                                    <th class="total">Total</th>
                                                    <th class="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> --}}
                                                {{-- @foreach ($orders as $key => $order)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $order->name ?? "N/A" }}</td>
                                                    <td>{{ $order->date ?? "N/A" }}</td>
                                                    <td>{{ ucfirst($order->status) ?? "N/A" }}</td>
                                                    <td>{{ single_price($order->total) ?? "N/A" }}</td>
                                                    <td><a href="{{ route('purchase_history.show', encrypt($order->id ?? "
                                                            N/A")) }}">View</a></td>
                                                </tr>
                                                @endforeach --}}
                                                {{--
                                            </tbody>
                                        </table> --}}
                                        {{--
                                    </div> --}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-perfrep">
                        <div class="my-account-address account-wrapper">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            {{-- @if($paid_order_exists)
                                            @php
                                            $first_paid_order_date = \App\Order::where('user_id',
                                            auth()->user()->id)->first()->created_at;
                                            @endphp --}}
                                            <form action="" method="get" id="form_performance">

                                                <div class="d-flex justify-content-center flex-wrap align-items-center">
                                                    {{-- <div class="form-group">
                                                        <center>
                                                            <label class="text-center">Filter By: </label>
                                                            <input type="month" required name="filter_range"
                                                                class="form-control" max="<?php //echo date(" Y-m"); ?>"
                                                            min="{{ date('Y-m', strtotime($first_paid_order_date)) }}"
                                                            value="{{ $month_year_filter ?? now()->format('Y-m') }}"
                                                            onkeydown="return false"
                                                            id="filter_range"
                                                            style="cursor:pointer"
                                                            />
                                                        </center>
                                                    </div> --}}
                                                </div>
                                                <div class="row"></div>
                                            </form>

                                            <hr>
                                            {{-- <div class="container">

                                                @php
                                                $qualify_amount =
                                                \App\MonthlyVolumeDiscount::where('user_type','dealer')->first()->monthly_volume_purchase_from;
                                                @endphp

                                                <div class="row">
                                                    <div class="col-6">
                                                        <h6 class="customer-craft-dashboard-card-title mb-0">
                                                            DATE COVERED: <span style="color: #161DBC;"></span>
                                                        </h6>
                                                    </div>

                                                    <div class="col-6">
                                                        <h6 class="customer-craft-dashboard-card-title float-md-right mt-2 mt-md-0 d-flex justify-content-end text-uppercase"
                                                            style="color: #161DBC">
                                                            @php
                                                            $month = date('F', strtotime($month_year_filter));
                                                            $year = date('Y', strtotime($month_year_filter));
                                                            @endphp
                                                            @if($month_year_filter == now()->format('Y-m'))
                                                            {{ $month }} {{
                                                            \Carbon\Carbon::parse($month_year_filter)->startOfMonth()->format('j')
                                                            }} to {{ now()->format('j') }}, {{ $year }}
                                                            @else
                                                            @php
                                                            $firstDayofPreviousMonth =
                                                            \Carbon\Carbon::parse($month_year_filter)->startOfMonth()->format('j');
                                                            $lastDayofPreviousMonth =
                                                            \Carbon\Carbon::parse($month_year_filter)->endOfMonth()->format('j');
                                                            @endphp
                                                            {{ $month }} {{ $firstDayofPreviousMonth }} to {{
                                                            $lastDayofPreviousMonth }}, {{ $year }}
                                                            @endif
                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h6
                                                            class="customer-craft-dashboard-card-title mb-0 text-uppercase">
                                                            @if($month_year_filter == now()->format('Y-m'))
                                                            GROSS AMOUNT AS OF {{ now()->format('F j') }}:
                                                            @else
                                                            GROSS AMOUNT FOR THE MONTH OF {{ date('F Y',
                                                            strtotime($month_year_filter)) }}:
                                                            @endif
                                                        </h6>
                                                    </div>

                                                    <div class="col-6">
                                                        <h6
                                                            class="customer-craft-dashboard-card-title float-md-right mt-2 mt-md-0 d-flex justify-content-end">
                                                            <span style="color: #161DBC;">{{ single_price($total_paid)
                                                                }}</span>
                                                        </h6>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h6
                                                            class="customer-craft-dashboard-card-title mb-0 text-uppercase">
                                                            NET OF VAT:
                                                        </h6>
                                                    </div>

                                                    <div class="col-6">
                                                        <h6
                                                            class="customer-craft-dashboard-card-title float-md-right mt-2 mt-md-0 d-flex justify-content-end">
                                                            <span style="color: #161DBC;">{{ single_price($net_of_vat)
                                                                }}</span>
                                                        </h6>
                                                    </div>
                                                </div>

                                                @if($net_of_vat >= $qualify_amount)
                                                @php
                                                $total_amount_of_incentives = 0;
                                                $discount = 0;

                                                $ranges =
                                                \App\MonthlyVolumeDiscount::where('user_type','dealer')->get();
                                                foreach ($ranges as $key => $range) {
                                                if($range->monthly_volume_purchase_end != 'more') {
                                                if(floatval($net_of_vat) >=
                                                floatval($range->monthly_volume_purchase_from) &&
                                                floatval($net_of_vat) <= floatval($range->monthly_volume_purchase_end))
                                                    {
                                                    $discount = $range->discount;
                                                    break;
                                                    }

                                                    }
                                                    else {
                                                    if(floatval($total_paid) >=
                                                    floatval($range->monthly_volume_purchase_from)) {
                                                    $discount = $range->discount;
                                                    break;
                                                    }
                                                    }

                                                    }
                                                    $total_amount_of_incentives = $net_of_vat * ($discount / 100);

                                                    $tax = 0.10;

                                                    $total_amount_of_incentives -= $total_amount_of_incentives * $tax;
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h6
                                                                class="customer-craft-dashboard-card-title mb-0 text-uppercase">
                                                                Amount of Incentive:
                                                            </h6>
                                                        </div>

                                                        <div class="col-6">
                                                            <h6
                                                                class="customer-craft-dashboard-card-title float-md-right mt-2 mt-md-0 d-flex justify-content-end">
                                                                <span style="color: #161DBC;">{{
                                                                    single_price($total_amount_of_incentives) }}</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h6 class="customer-craft-dashboard-card-title mb-0">
                                                                STATUS:
                                                            </h6>
                                                        </div>

                                                        <div class="col-6">
                                                            <h6
                                                                class="customer-craft-dashboard-card-title float-md-right mt-2 mt-md-0 d-flex justify-content-end">
                                                                @if ($validated)
                                                                <span style="color: #008528;">Validated</span>
                                                                @else
                                                                <span style="color: #747474;">Tentative</span>
                                                                @endif
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($net_of_vat >= $qualify_amount)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="d-flex justify-content-center">
                                                                <button type="button"
                                                                    onclick="view_details('{{route('dealer.performance.show', encrypt(array('user_id' => Auth::user()->id, 'month_orders' => $month_year_filter)))}}')"
                                                                    class="d-md-inline-block btn btn-craft-primary-nopadding add-to-cart fw-600 d-block fs-11"
                                                                    id="btnViewDetails" disabled>View Details</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="mt-3">
                                                        <div class="alert alert-danger text-center" role="alert">
                                                            <h6>Your performance for this month is not qualify for our
                                                                <strong>Monthly Standard Volume Discounts</strong></h6>
                                                        </div>
                                                    </div>
                                                    @endif
                                            </div>
                                            @else
                                            <h4 class="text-center">No Paid Orders Found</h4>
                                            @endif --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-account">
                        <div class="my-account-details account-wrapper">
                            <h4 class="account-title">Account Details</h4>
                            <div class="account-details">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-form">
                                            <input type="text" value="{{ Auth::user()->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form">
                                            <input type="text" value="{{ Auth::user()->username }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <input type="text" value="{{ Auth::user()->display_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <input type="text" value="{{ Auth::user()->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <h5 class="title">Other Information</h5>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <input type="text" value="{{ Auth::user()->phone }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form">
                                            <input type="text" value="{{ Auth::user()->user_type }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form">
                                            <input type="text" value="{{ Auth::user()->unique_id }}" readonly>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="single-form">
                                            <button class="btn btn-primary btn-hover-dark">Save Change</button>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab content End -->
            </div>
        </div>
    </div>
</div>
<!-- My Account Section End -->
@endsection
