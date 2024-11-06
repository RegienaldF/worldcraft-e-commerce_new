<style>
    /* new */
    .header-area {
        text-align: center;
        padding: 20px 0;
    }

    .header-logo img {
        max-width: 200px;
        margin: 0 auto;
    }

    .product-menu {
        margin-top: 1px;
    }

    .product-menu .nav li {
        list-style: none;
    }

    .product-menu .nav button {
        border: none;
        background: none;
        padding: 5px 5px;
        cursor: pointer;
    }

    .product-menu .nav button.active {
        font-weight: bold;
    }

    .nav-item a:hover,
    .nav-item a.active {
        transition: color 0.3s ease, background-color 0.3s ease;
        color: white !important;
        border-bottom: 3px solid #ccc;
        /* padding: 10px 20px; */
    }

    .nav-item a {
        transition: color 0.3s ease, background-color 0.3s ease;
        color: #ffffff;
        background-color: transparent;
        padding: 6px 4px;
    }

    .text-dark {
        color: white !important;
    }

    /* Screen resize */
    .product-menu {
        background-color: black;
        margin-top: 5px;
        height: 50px;
    }

    /* Default for larger screens */
    .product-menu ul {
        display: flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        transition: transform 0.3s ease;
    }

    @media (max-width: 1848px) {
        .product-menu ul {
            overflow-x: auto;
            display: flex;
            flex-wrap: nowrap;
            justify-content: flex-start;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            transition: transform 0.3s ease;
        }

        .product-menu ul::-webkit-scrollbar {
            display: none;
        }

        .nav-item {
            flex: 0 0 auto;
            scroll-snap-align: center;
        }

        .category-link {
            padding: 5px 10px;
            display: block;
            color: white;
            font-size: 0.8rem;
            /* Adjust font size as needed */
        }
    }

    @media (max-width: 1542px) {
        .product-menu ul {
            overflow-x: auto;
            display: flex;
            flex-wrap: nowrap;
            justify-content: flex-start;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            transition: transform 0.3s ease;
        }

        .product-menu ul::-webkit-scrollbar {
            display: none;
        }

        .nav-item {
            flex: 0 0 auto;
            scroll-snap-align: center;
        }

        .category-link {
            padding: 5px 10px;
            display: block;
            color: white;
            font-size: 0.7rem;
        }
    }

    @media (max-width: 1385px) {
        .product-menu ul {
            overflow-x: auto;
            display: flex;
            flex-wrap: nowrap;
            justify-content: flex-start;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            transition: transform 0.3s ease;
        }

        .product-menu ul::-webkit-scrollbar {
            display: none;
        }

        .nav-item {
            flex: 0 0 auto;
            scroll-snap-align: center;
        }

        .category-link {
            padding: 5px 10px;
            display: block;
            color: white;
            font-size: 0.6rem;
        }
    }
</style>

<div class="header-area header-white header-sticky d-none d-sm-block m-0 p-0" style="position: sticky !important;">
    <div class="d-flex justify-content-between align-items-center" style="border-bottom: 1px solid rgb(206, 202, 202);">
        <div class="header-meta d-flex align-items-center justify-content-between w-100">
            {{-- Left aligned part --}}
            <div class="d-flex align-items-center justify-content-start">
                <div class="header-menu">
                    <ul class="nav-menu">
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="{{ route('cart.index') }}">Cart</a></li>
                    </ul>
                </div>

                <div class="dropdown">
                    <a class="action" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="pe-7s-search"></i>
                    </a>
                    <div class="dropdown-menu dropdown-search" style="width: 300px;">
                        <div class="header-search">
                            <form action="#">
                                <input type="text" placeholder="Enter your search key ... ">
                                <button><i class="pe-7s-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Center aligned part --}}
            <div class="header-logo mx-5 mt-3 text-center">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('worldcraft/Logo/Logo.png') }}" alt="Logo">
                </a>
            </div>

            {{-- Right aligned part --}}
            <div class="d-flex align-items-center justify-content-end gap-5 me-10">
                {{-- <a class="btn btn-outline-dark w-100 my-1" href="{{ route('sign.in') }}">Sign In</a> --}}
                <a class="btn btn-outline-dark w-100 my-1"
                    href="{{ auth()->check() ? route('profile') : route('sign.in') }}">
                    {{ auth()->check() ? auth()->user()->name : 'Sign In' }}
                </a>
                <div class="dropdown">
                    <a class="action" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="pe-7s-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-profile"
                        style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;">

                        @if (auth()->check())
                            {{-- <li><a class="btn btn-primary w-100 my-1" href="{{ route('product.checkout') }}">Checkout</a></li> --}}
                            <li><a class="btn btn-primary w-100 my-1" href="{{ route('cart.index') }}">Cart</a></li>
                            <li><a class="btn btn-primary w-100 my-1"
                                    href="{{ route('product.wishlist') }}">Wishlist</a></li>
                            <li><a class="btn btn-primary w-100 my-1" href="{{ route('profile') }}">My Profile</a></li>
                            <li><a class="btn btn-primary w-100 my-1" href="{{ route('logout.user') }}">Logout</a></li>
                        @else
                            <li><a class="btn btn-primary w-100 my-1" href="{{ route('register') }}">Register</a></li>
                        @endif

                    </ul>
                </div>

                @php
                    use Illuminate\Support\Facades\Auth;
                    if (Auth::check()) {
                        $count_item_cart = DB::table('carts')->where('user_id', Auth::user()->id)->count();
                    } else {
                        $count_item_cart = 0;
                    }
                @endphp

                <div class="dropdown">
                    <a class="action" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="pe-7s-shopbag"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark" style="font-size: 10px; color: white; background-color: black !important;">{{ $count_item_cart }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-cart">
                        <div class="cart-content" id="cart-content">
                            <ul id="cart-items-list">
                                @php
                                    if(auth()->check()){
                                        $carts = DB::table('carts')
                                            ->select(
                                                'carts.id',
                                                'carts.item_name',
                                                'carts.variant',
                                                'carts.quantity',
                                                'carts.unit_price',
                                                'carts.location_id',
                                                'pickup_points.name',
                                            )
                                            ->leftJoin('pickup_points', 'carts.location_id', '=', 'pickup_points.id')
                                            ->where('carts.checkout_date', '=', null)
                                            ->where('carts.user_id', '=', Auth::user()->id)
                                            ->get();
                                    } else {
                                        $carts = collect();
                                    }
                                    $subtotal = 0;
                                @endphp

                                @foreach ($carts as $cart)
                                    @php
                                        $subtotal += $cart->unit_price * $cart->quantity;
                                    @endphp
                                    <li>
                                        <!-- Single Cart Item Start -->
                                        <div class="single-cart-item">
                                            <div class="cart-thumb">
                                                <img src="{{ asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}"
                                                    alt="Cart">
                                                <span class="product-quantity">{{ $cart->quantity }}x</span>
                                            </div>
                                            <div class="cart-item-content">
                                                <h6 class="product-name">{{ $cart->item_name }}</h6>
                                                <span class="product-price">&#8369;
                                                    {{ number_format($cart->unit_price, 2) }}</span>
                                                <div class="attributes-content">
                                                    <span>{{ $cart->variant }}</span><br>
                                                </div>
                                                <div class="attributes-content"
                                                    style="margin-top: -20px; font-style: italic !important;">
                                                    {{-- <span><strong>Location:</strong> {{ $cart->name }}</span> --}}
                                                </div>
                                                <a class="cart-remove" href="#"
                                                    data-cart-id="{{ $cart->id }}">
                                                    <i class="las la-times"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Single Cart Item End -->
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="cart-price">
                            <div class="cart-total">
                                <div class="price-inline">
                                    <span class="label">Total</span>
                                    <span class="value" id="cart-total">&#8369;
                                        {{ number_format($subtotal, 2) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-btn">
                            <a href="{{ route('cart.index') }}" class="btn btn-dark btn-hover-primary d-block">GO TO
                                CART</a>
                        </div>
                    </div>
                </div>

                <a class="action" href="{{ route('product.wishlist') }}">
                    <i class="pe-7s-like"></i>
                </a>
            </div>
        </div>
    </div>


    <!-- Product Menu Start -->
    <div class="product-menu" style="background-color: black; margin-top: 5px; height: 50px;">
        <ul class="nav d-flex align-items-center justify-content-center">
            @php
                $new_categories = [
                    'New Arrivals',
                    'Clearance Sale',
                    'Outdoor Furniture',
                    'Dining Furniture',
                    'Office Furniture',
                    'School Furniture',
                    'Bedroom Furniture',
                    'Cabinets',
                    'Seasonal Furniture',
                    'Storage Rack Furniture',
                    'Livingroom Furniture',
                    'Restaurant Furniture',
                ];
            @endphp

            @foreach ($new_categories as $item)
                <li class="nav-item mx-2">
                    <a href="{{ route('products.new-category', ['slug' => strtolower(str_replace(' ', '_', $item))]) }}"
                        class="text-dark category-link d-flex align-items-center justify-content-center mt-1">
                        {{ $item }}
                    </a>
                </li>
            @endforeach
            {{-- @foreach ($category as $item)
                <li class="nav-item mx-2">
                    <a href="{{ route('product.list', ['id' => $item->id]) }}"
                        class="text-dark category-link {{ request()->id == $item->id ? 'active' : '' }}">
                        {{ $item->name }}
                    </a>
                </li>
            @endforeach --}}
        </ul>
    </div>
    <!-- Product Menu End -->
</div>

<script>
    const slider = document.querySelector('.product-menu ul');
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('active');
    });

    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('active');
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return; // Stop the function if the mouse isn't pressed down
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2; // Scroll fast
        slider.scrollLeft = scrollLeft - walk;
    });

    slider.addEventListener('touchstart', (e) => {
        startX = e.touches[0].pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('touchmove', (e) => {
        const x = e.touches[0].pageX - slider.offsetLeft;
        const walk = (x - startX) * 2;
        slider.scrollLeft = scrollLeft - walk;
    });
</script>
