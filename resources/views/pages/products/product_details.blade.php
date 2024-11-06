@extends('master')
<style>
    .radio-input {
        display: none;
    }

    .radio-label {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        border: 1px solid #0000005c;
        border-radius: 5px;
        cursor: pointer;
        background-color: #fff;
        color: #000000;
        font-size: 14px;
        text-align: center;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .radio-input:checked+.radio-label {
        background-color: #b8001f;
        color: #fff;
    }

    .radio-label:hover {
        background-color: #b8001f;
        color: #fff;
    }

    .warehouse-selection {
        border: 1px solid #9f9f9f !important;
    }

    /* Select warehouse */
    .select-box {
        position: relative;
        display: block;
        margin: 0 auto;
        font-family: "Open Sans", "Helvetica Neue", "Segoe UI", "Calibri", "Arial", sans-serif;
        font-size: 18px;
        color: #60666d;
    }

    @media (min-width: 768px) {
        .select-box {
            width: 70%;
        }
    }

    @media (min-width: 992px) {
        .select-box {
            width: 50%;
        }
    }

    @media (min-width: 1200px) {
        .select-box {
            width: 30%;
        }
    }

    .select-box__current {
        position: relative;
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        outline: none;
    }

    .select-box__current:focus+.select-box__list {
        opacity: 1;
        -webkit-animation-name: none;
        animation-name: none;
    }

    .select-box__current:focus+.select-box__list .select-box__option {
        cursor: pointer;
    }

    .select-box__current:focus .select-box__icon {
        transform: translateY(-50%) rotate(180deg);
    }

    .select-box__icon {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        width: 20px;
        opacity: 0.3;
        transition: 0.2s ease;
    }

    .select-box__value {
        display: flex;
    }

    .select-box__input {
        display: none;
    }

    .select-box__input:checked+.select-box__input-text {
        display: block;
    }

    .select-box__input-text {
        display: none;
        width: 100%;
        margin: 0;
        padding: 15px;
        background-color: #fff;
    }

    .select-box__list {
        position: absolute;
        width: 32.6% !important;
        padding: 0;
        list-style: none;
        opacity: 0;
        -webkit-animation-name: HideList;
        animation-name: HideList;
        -webkit-animation-duration: 0.5s;
        animation-duration: 0.5s;
        -webkit-animation-delay: 0.5s;
        animation-delay: 0.5s;
        -webkit-animation-fill-mode: forwards;
        animation-fill-mode: forwards;
        -webkit-animation-timing-function: step-start;
        animation-timing-function: step-start;
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
    }

    .select-box__option {
        display: block;
        padding: 15px;
        background-color: #fff;
    }

    .select-box__option:hover,
    .select-box__option:focus {
        color: #546c84;
        background-color: #fbfbfb;
    }

    @-webkit-keyframes HideList {
        from {
            transform: scaleY(1);
        }

        to {
            transform: scaleY(0);
        }
    }

    @keyframes HideList {
        from {
            transform: scaleY(1);
        }

        to {
            transform: scaleY(0);
        }
    }

    /* product thumb */
    .details-gallery-thumbs {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .details-gallery-thumbs .swiper-container {
        width: 100%;
        overflow: hidden;
    }

    .details-gallery-thumbs .swiper-wrapper {
        display: flex;
        flex-direction: row;
        /* Ensures thumbnails are aligned horizontally */
    }

    .details-gallery-thumbs .swiper-slide {
        width: 150px;
        margin-right: 15px;
        opacity: 0.5;
        cursor: pointer;
    }

    .details-gallery-thumbs .swiper-slide-active {
        opacity: 1;
    }

    .swiper-button-prev,
    .swiper-button-next {
        top: 50%;
        transform: translateY(-50%);
    }
</style>

@section('index')
    <!-- Product Details Section Start -->
    <div class="section section-padding-02" style="margin-top: -50px;">
        <div class="container" style="max-width: 90%;">
            <div class="row mb-3" style="margin-top: -65px;">
                <!-- Product Images Section -->
                <div class="col-md-6" style="height: 100%;">
                    <div class="product-details-images">
                        <div class="details-gallery-images">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="single-img zoom">
                                            {{-- <img src="{{ $product->image ? asset('images/product/' . $product->image) : asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}"
                                                alt="{{ $product->name }}" class="image-fluid"> --}}
                                                <img id="variantImage" src="{{ !empty($productStocks->first()->file_name) ? asset($productStocks->first()->file_name) : asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}"
                                                    alt="{{ $product->name }}" onerror="this.onerror=null; this.src='{{ asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}';"
                                                    class="image-fluid">

                                            <div class="inner-stuff">
                                                <div class="gallery-item"
                                                    data-src="{{ !empty($product->file_name) ? asset($product->file_name) : asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}">
                                                    <a href="javascript:void(0)">
                                                        <i class="lastudioicon-full-screen"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- details gallery thumb start --}}
                        <div class="details-gallery-thumbs">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}"
                                            alt="Product Thumbnail">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}"
                                            alt="Product Thumbnail">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}"
                                            alt="Product Thumbnail">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}"
                                            alt="Product Thumbnail">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}"
                                            alt="Product Thumbnail">
                                    </div>
                                </div>
                            </div>

                            <!-- Add Arrows -->
                            <div class="swiper-button-prev"><i class="pe-7s-angle-left"></i></div>
                            <div class="swiper-button-next"><i class="pe-7s-angle-right"></i></div>
                        </div>
                        {{-- details gallery thumb end --}}
                    </div>
                </div>

                <!-- Product Details Section -->
                <div class="col-md-6 ms-auto">
                    <div class="product-details-description">
                        <h4 class="product-name"
                            style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 25px;">
                            {{ $product->name }}</h4>
                        <div class="sku d-flex mt-2 align-items-center">
                            <span class="fw-bold me-2">SKU:</span>
                            <h6 id="sku" class="mb-0"
                                style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 16px; font-weight: 400">
                                {{ $productStocks->first()->sku ?? $product->sku }}
                            </h6>
                            <div class="ms-auto d-flex">
                                <div class="me-2 p-2" style="font-size: 25px; cursor: pointer;">
                                    <i class="pe-7s-angle-left"></i>
                                </div>
                                <div class="p-2" style="font-size: 25px; cursor: pointer;">
                                    <i class="pe-7s-angle-right"></i>
                                </div>
                            </div>
                        </div>

                        <div class="review-wrapper mb-3">
                            <div class="review-star">
                                <div class="star" style="width: 80%;"></div>
                            </div>
                        </div>

                        <hr>

                        <div class="price">
                            @php
                                $active_promo = 0;
                                $price = $product->unit_price;
                                $srp = $price;

                                if ($product->promos_status == 'active' && $product->item_promo_status == 'approved') {
                                    $active_promo = 1;
                                    $promo_discount = $product->percentage_discount;
                                    $price -= ($price * $promo_discount) / 100;
                                }
                            @endphp
                            @if ($price < $srp)
                                <div class="old-price text-decoration-line-through" style="color: black;">
                                    ₱{{ number_format($srp, 2) }}
                                </div>
                            @else
                                &nbsp;
                            @endif

                            <div class="sale-price" style="color: {{ $active_promo == 1 ? '#fd1c1c' : 'black' }};"><b>₱
                                    {{ number_format($price, 2) }}</b>
                            </div>
                            {{-- @if ($product->old_price)
                                <span class="old-price">₱{{ number_format($product->unit_price, 2) }}</span>
                            @endif --}}
                        </div>

                        <hr>

                        {{-- SKU Variant Selection start --}}
                        <div class="d-flex justify-content-start mt-2 flex-column mb-1">
                            @foreach ($attributes as $attributeName => $attributeValues)
                                <div>
                                    <span class="label d-flex">
                                        {{ ucfirst($attributeName) }}:
                                    </span>
                                    <ul class="d-flex list-unstyled aiz-radio-inline" id="radioButtonContainerId">
                                        @foreach ($attributeValues as $index => $value)
                                            @if (
                                                \App\Models\ProductStock::where([
                                                    'product_id' => $product->id,
                                                    'variant' => str_replace(' ', '', $value),
                                                ])->exists())
                                            @endif
                                            <li>
                                                <input type="radio" name="{{ $attributeName }}"
                                                    id="{{ $attributeName }}{{ $index }}"
                                                    value="{{ $value }}" class="radio-input"
                                                    @if ($index == 0) checked @endif>
                                                <label for="{{ $attributeName }}{{ $index }}" class="radio-label">
                                                    <span>{{ $value == 'NonTilt' || $value == 'Non Tilt' ? 'Non-Tilt' : $value }}</span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <br>
                            @endforeach

                            @if (!empty($product->colors) && count(json_decode($product->colors)) > 0)
                                <div>
                                    <span class="label d-flex">{{ __('Color') }}:</span>
                                    <ul class="d-flex list-unstyled aiz-radio-inline mt-2" id="radioButtonColorId">
                                        @foreach (json_decode($product->colors) as $key => $color)
                                            <li>
                                                <label class="aiz-megabox mr-2 rounded-0" data-toggle="tooltip"
                                                    data-title="{{ \App\Models\Color::where('code', $color)->first()->name }}">
                                                    <input type="radio" name="color" value="{{ $color }}"
                                                        id="color{{ $loop->index }}"
                                                        @if ($key == 0) checked @endif>
                                                    <span
                                                        class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1">
                                                        <span class="size-30px d-inline-block rounded"
                                                            style="background: {{ $color }};"></span>
                                                    </span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        {{-- SKU Variant Selection end --}}

                        {{-- display table discounts per item --}}
                        <div id="warehouse_promo_list_container" class="mt-3" style="display: none;">
                            <hr>
                            {{-- <div class="product-details-label mb-3">
                                Enjoy a discount based on your pickup location
                            </div> --}}
                            <div id="warehouse_promo_list_discounts" class="table-responsive">
                                <table class="table table-bordered" style="max-width: 360px;">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        Enjoy a discount based on your pickup location
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-sm btn-transparent dropdown-toggle p-0"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#discountTableBody" aria-expanded="false"
                                                            aria-controls="discountTableBody">

                                                        </button>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="discountTableBody" class="collapse show">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- test --}}
                        <input type="hidden" value="{{ $productStocks->first()->sku ?? $product->sku }}"
                            id="get_sku">

                        <div class="w-50 mb-5">
                            <select id="warehouse_selected" class="form-select warehouse-selection"
                                onchange="updateMaxQuantity()" aria-label="Default select example"
                                style="line-height: 3.5 !important; font-size: 14px;">
                                {{-- Loop stocks per warehouse --}}
                            </select>
                        </div>

                        {{-- <div class="w-75 mb-5" style="margin-top: -30px;">
                            <div class="select-box__current" tabindex="1">
                                <div class="select-box__value">
                                    <input class="select-box__input" type="radio" id="0" value="1"
                                        name="Ben" checked="checked" />
                                    <p class="select-box__input-text">Cream</p>
                                </div>
                                <div class="select-box__value">
                                    <input class="select-box__input" type="radio" id="1" value="2"
                                        name="Ben" />
                                    <p class="select-box__input-text">Cheese</p>
                                </div>
                                <div class="select-box__value">
                                    <input class="select-box__input" type="radio" id="2" value="3"
                                        name="Ben" />
                                    <p class="select-box__input-text">Milk</p>
                                </div>
                                <div class="select-box__value">
                                    <input class="select-box__input" type="radio" id="3" value="4"
                                        name="Ben" />
                                    <p class="select-box__input-text">Honey</p>
                                </div>
                                <div class="select-box__value">
                                    <input class="select-box__input" type="radio" id="4" value="5"
                                        name="Ben" />
                                    <p class="select-box__input-text">Toast</p>
                                </div><img class="select-box__icon" src="http://cdn.onlinewebfonts.com/svg/img_295694.svg"
                                    alt="Arrow Icon" aria-hidden="true" />
                            </div>
                            <ul class="select-box__list" style="z-index: 1000;">
                                <li>
                                    <label class="select-box__option" for="0"
                                        aria-hidden="aria-hidden">Cream</label>
                                </li>
                                <li>
                                    <label class="select-box__option" for="1"
                                        aria-hidden="aria-hidden">Cheese</label>
                                </li>
                                <li>
                                    <label class="select-box__option" for="2"
                                        aria-hidden="aria-hidden">Milk</label>
                                </li>
                                <li>
                                    <label class="select-box__option" for="3"
                                        aria-hidden="aria-hidden">Honey</label>
                                </li>
                                <li>
                                    <label class="select-box__option" for="4"
                                        aria-hidden="aria-hidden">Toast</label>
                                </li>
                            </ul>
                        </div> --}}


                        <div class="product-meta" style="margin-top: -40px;">
                            <div class="product-quantity d-inline-flex">
                                <button type="button" class="sub" id="sub_qty" onclick="sub_qty()">-</i></button>
                                <input type="text" id="quantity" value="1" min="1" readonly />
                                <button type="button" class="add" id="add_qty" onclick="add_qty()">+</button>
                            </div>

                            <div class="meta-action">
                                <button class="btn btn-dark btn-hover-primary" id="add_to_cart">Add To
                                    Cart</button>
                            </div>

                            <div class="meta-action" style="height: 100%;">
                                <button class="d-flex justify-content-center align-items-center action"
                                    id="add_to_wishlist">
                                    <i class="pe-7s-like"></i>
                                </button>
                            </div>
                        </div>

                        <hr>

                        <div class="mt-3">
                            <div><span class="fw-bold">Product Description:</span></div>
                            <span id="">{!! $product->description !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Details Section End -->

    <!-- Product Details tab Section Start -->
    <div class="section section-padding-01">
        <div class="container" style="max-width: 100%;">
            <!-- Product Details Tabs Start -->
            <div class="product-details-tabs mb-5">
                <ul class="nav justify-content-center">
                    <li><button data-bs-toggle="tab" data-bs-target="#information">Information</button></li>
                    <li><button data-bs-toggle="tab" data-bs-target="#reviews">Reviews (03)</button></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="information">
                        <div class="information-content">
                            <h4 class="title">Information</h4>
                            {!! $product->description !!}
                        </div>
                    </div>

                    <div class="tab-pane fade" id="reviews">
                        <!-- Reviews Content Start -->
                        <div class="reviews-content">
                            <!-- Review Comment Start  -->
                            <div class="reviews-comment">
                                <!-- Single Comment Start  -->
                                <div class="single-reviews">
                                    <div class="comment-author">
                                        <img src="assets/images/author/author-1.png" alt="">
                                    </div>
                                    <div class="comment-content">
                                        <div class="author-name-rating">
                                            <h6 class="name">Rosie Silva</h6>
                                            <div class="review-star">
                                                <div class="star" style="width: 80%;"></div>
                                            </div>
                                        </div>
                                        <span class="date">11/20/2021</span>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse deleniti itaque
                                            velit explicabo at eum incidunt vel reprehenderit maxime eos facere ut
                                            pariatur voluptas aut, porro quia molestias sequi cupiditate!</p>
                                    </div>
                                </div>
                                <!-- Single Comment End  -->

                                <!-- Single Comment Start  -->
                                <div class="single-reviews">
                                    <div class="comment-author">
                                        <img src="assets/images/author/author-2.png" alt="">
                                    </div>
                                    <div class="comment-content">
                                        <div class="author-name-rating">
                                            <h6 class="name">Aidyn Cody</h6>
                                            <div class="review-star">
                                                <div class="star" style="width: 80%;"></div>
                                            </div>
                                        </div>
                                        <span class="date">11/20/2021</span>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse deleniti itaque
                                            velit explicabo at eum incidunt vel reprehenderit maxime eos facere ut
                                            pariatur voluptas aut, porro quia molestias sequi cupiditate!</p>
                                    </div>
                                </div>
                                <!-- Single Comment End  -->

                                <!-- Single Comment Start  -->
                                <div class="single-reviews">
                                    <div class="comment-author">
                                        <img src="assets/images/author/author-3.png" alt="">
                                    </div>
                                    <div class="comment-content">
                                        <div class="author-name-rating">
                                            <h6 class="name">Rosie Silva</h6>
                                            <div class="review-star">
                                                <div class="star" style="width: 80%;"></div>
                                            </div>
                                        </div>
                                        <span class="date">11/20/2021</span>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse deleniti itaque
                                            velit explicabo at eum incidunt vel reprehenderit maxime eos facere ut
                                            pariatur voluptas aut, porro quia molestias sequi cupiditate!</p>
                                    </div>
                                </div>
                                <!-- Single Comment End  -->
                            </div>
                            <!-- Review Comment End  -->

                            <!-- Review Form Start  -->
                            <div class="reviews-form">
                                <h3 class="reviews-title">Add a review </h3>

                                <form action="#">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="single-form">
                                                <input type="text" placeholder="Enter your name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="single-form">
                                                <input type="email" placeholder="john.smith@example.com">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="review-rating">
                                                <label class="title">Rating:</label>
                                                <ul id="rating" class="rating">
                                                    <li class="star" title='Poor' data-value='1'><i
                                                            class="fa fa-star-o"></i></li>
                                                    <li class="star" title='Poor' data-value='2'><i
                                                            class="fa fa-star-o"></i></li>
                                                    <li class="star" title='Poor' data-value='3'><i
                                                            class="fa fa-star-o"></i></li>
                                                    <li class="star" title='Poor' data-value='4'><i
                                                            class="fa fa-star-o"></i></li>
                                                    <li class="star" title='Poor' data-value='5'><i
                                                            class="fa fa-star-o"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="single-form">
                                                <textarea placeholder="Write your comments here"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="single-form">
                                                <button class="btn btn-dark btn-hover-primary">Submit Review</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Review Form End  -->

                        </div>
                        <!-- Reviews Content End -->
                    </div>
                </div>
            </div>
            <!-- Product Details Tabs End -->

        </div>
    </div>
    <!-- Product Details tab Section End -->

    <div class="might-like" style="max-width: 100%; background-color: #0c0736;">
        <div class="position-absolute">
            <div class="might-like-img-1"></div>
        </div>
        <div class="container mt-5" style="max-width: 90%;">
            <div class="might-like-title" style="text-align: center; color: white; font-size: 25px;">
                YOU MIGHT ALSO LIKE
            </div>
            <div class="pt-5">
                <div class="row gutters-6 row-cols-xxl-5 row-cols-xl-4 row-cols-lg-4 row-cols-md-4 row-cols-2">
                    <div class="col col-sm-6 mb-4">
                        <div class="aiz-card-box border-product shadow-sm hov-shadowmd has-transition bg-white mx-1">
                            <div class="card">
                                <div class="card-body shadow p-2 bg-body rounded">
                                    <a href=""><img
                                            src="{{ $product->image ? asset('images/product/' . $product->image) : asset('worldcraft/icons/no-image-wc.jpg') }}"
                                            alt="{{ $product->name }}"></a>

                                    <div class="product-content ms-2 mt-4">
                                        <h5 class="fw-bold text-dark"
                                            style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 16px; font-weight: 400">
                                            <a
                                                href="{{ route('product.details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                        </h5>
                                        <div class="mt-2">
                                            <div class="old-price text-decoration-line-through" style="color: black;">
                                                ₱
                                                {{ number_format($product->unit_price, 2) }}</div>
                                            <div class="sale-price" style="color: #fd1c1c;"><b>₱
                                                    {{ number_format($product->unit_price, 2) }}</b></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for login if user detects not logged in --}}
    <div class="modal" id="modalLogin">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <!-- Login Section Start -->
                    <div class="section section-padding" style="background-color: white !important;">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <!-- Login & Register Start -->
                                    <div class="login-register-wrapper">
                                        <img src="{{ asset('/worldcraft/Logo/Logo.png') }}" alt=""
                                            style="width: 250px; margin-left: 100px;">
                                        <h4 class="title">Login to Your Account</h4>
                                        <form action="{{ route('login.user') }}" method="POST">
                                            @csrf
                                            <div class="single-form">
                                                <input type="text" name="email" placeholder="Username or email *"
                                                    style="font-style: normal !important" required>
                                            </div>
                                            <div class="single-form">
                                                <input type="password" name="password" placeholder="Password"
                                                    style="font-style: normal !important" required>
                                            </div>
                                            <div class="single-form">
                                                <button class="btn btn-dark btn-hover-dark" type="submit">Login</button>
                                            </div>
                                        </form>
                                        <p>No account? <a href="{{ route('register') }}">Create one here.</a></p>
                                    </div>
                                    <!-- Login & Register End -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Login Section End -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // on load function for trigger get sku
        $('input[type="radio"]').on('click', function() {

            var selectedVariants = [];
            $('input[type="radio"]:checked').each(function() {
                variant_text = $(this).val();
                selectedVariants.push(variant_text.replace(' ', ''));
            });

            var combinedVariant = selectedVariants.join('-');
            var productId = {{ $product->id }};

            sku = null;
            if (selectedVariants.length > 0) {
                getVariantPrice(productId, combinedVariant);
                // getStocks();

            } else {
                $('#sku').text('');
                $('#description').html('');
            }
        });

        function getVariantPrice(product_id, variant) {
            const baseUrl = '{{ asset('') }}';
            $.ajax({
                url: "{{ route('product.variation') }}",
                type: 'GET',
                data: {
                    product_id: product_id,
                    variant: variant
                },
                success: function(response) {
                    if (response) {
                        $('#sku').text(response.sku);
                        $('#get_sku').val(response.sku);
                        $('#description').html(response.description);
                        $('#stock_quantity_label').text(0);
                        $('#warehouse_selected').prop('selectedIndex', 0);
                        $('#quantity').text(0);
                        const imagePath = response.file_name ? baseUrl + response.file_name : '{{ asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}';
                        $('#variantImage').attr('src', imagePath);
                        getStocks();

                    } else {
                        $('#sku').text('SKU not found.');
                        $('#description').html('No description available.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching product variation:', error);
                }
            });
        }

        function getStocks() {
            var sku = $('#get_sku').val();
            if (sku) {
                $.ajax({
                    url: "{{ route('product.stock.quantity') }}",
                    type: 'GET',
                    data: {
                        sku: sku
                    },
                    success: function(response) {
                        var warehouseDropdown = $('#warehouse_selected');
                        warehouseDropdown.empty();
                        warehouseDropdown.append('<option selected value="0">Select Warehouse...</option>');

                        if (response && response.length > 0) {
                            response.forEach(function(warehouse) {
                                let optionText =
                                    `${warehouse.name.replace('_', ' ')} - ${warehouse.quantity}`;
                                warehouseDropdown.append(
                                    // `<option value="${warehouse.id}">${optionText}</option>`);
                                    `<option value="${warehouse.id}" data-quantity="${warehouse.quantity}">${optionText}</option>`
                                );
                            });
                        } else {
                            warehouseDropdown.append('<option value="0">No stock available</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching quantities:', error);
                        $('#warehouse_selected').html(
                            '<option value="0">Error loading stock information</option>');
                    }
                });
            }
        }

        function updateMaxQuantity() {
            var selectedWarehouse = $('#warehouse_selected option:selected');
            var quantityInput = $('#quantity');
            var availableStock = selectedWarehouse.data('quantity');

            if (availableStock) {
                quantityInput.attr('max', availableStock);
                if (parseInt(quantityInput.val()) > availableStock) {
                    alert('You reached the available stocks');
                    return;
                    quantityInput.val(availableStock);
                }
            } else {
                quantityInput.attr('max', 0);
            }
        }

        $(document).ready(function() {
            // clicked
            $('input[type="radio"]:checked').each(function() {
                $(this).trigger('click');
                return false;
            });

            // add to cart function
            $('#add_to_cart').click(function() {
                var productId = {{ $product->id }};
                var productName = "{{ $product->name }}";
                var sku = $('#sku').text().trim();
                var variant = [];
                $('input[type="radio"]:checked').each(function() {
                    variant.push($(this).val());
                });
                var quantity = $('#quantity').val();
                var price = {{ $product->unit_price }};
                var location_id = $('#warehouse_selected').val();
                var userId = "{{ Auth::user()->id ?? '' }}";
                if (sku === "" || sku === null) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please select a valid variant before adding to cart!",
                        footer: '<a href="#">Why do I have this issue?</a>'
                    });
                    return;
                }

                $.ajax({
                    url: "{{ route('product.add_to_cart') }}",
                    type: 'POST',
                    data: {
                        product_id: productId,
                        product_name: productName,
                        sku: sku,
                        variant: variant.join('-'),
                        quantity: quantity,
                        unit_price: price,
                        location_id: location_id,
                        user_id: userId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: "Added to Cart!",
                                text: "Your item successfully added to cart!",
                                icon: "success"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#warehouse_selected').prop('selectedIndex', 0);
                                    location.reload();
                                }
                            });
                        } else if (response.message ===
                            'Quantity exceeds available stock. Please review your cart.') {
                            alert('Quantity exceeds available stock. Please review your cart.');
                        } else {
                            alert('Failed to add to cart.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.status);
                        if (xhr.status == 403) {
                            $('#modalLogin').modal('show');
                        }
                        console.error('Error adding to cart:', error);
                    }
                });
            });

            // wishlist function
            $('#add_to_wishlist').click(function() {
                var productId = {{ $product->id }};
                var userId = 1;
                $.ajax({
                    url: "{{ route('product.add_wishlist') }}",
                    type: 'POST',
                    data: {
                        product_id: productId,
                        user_id: userId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert('Product added to wishlist!');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error adding to wishlist:', error);
                    }
                });
            });

        });

        function add_qty() {
            var qty_val = document.getElementById('quantity');
            var currentQty = parseInt(qty_val.value);
            // qty_val.value = currentQty + 1;
            var maxQuantity = parseInt(qty_val.getAttribute('max'));
            if (currentQty < maxQuantity) {
                qty_val.value = currentQty + 1;
            } else {
                alert('You reached the maximum available stocks');
                return;
            }
        }

        function sub_qty() {
            var qty_val = document.getElementById('quantity');
            var currentQty = parseInt(qty_val.value);
            if (currentQty > 1) {
                qty_val.value = currentQty - 1;
            }
        }

        // image controller for swiping
        var galleryThumbs = new Swiper('.details-gallery-thumbs .swiper-container', {
            spaceBetween: 10,
            slidesPerView: 4,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        var galleryTop = new Swiper('.details-gallery-images .swiper-container', {
            spaceBetween: 10,
            thumbs: {
                swiper: galleryThumbs
            }
        });

    </script>
@endsection
