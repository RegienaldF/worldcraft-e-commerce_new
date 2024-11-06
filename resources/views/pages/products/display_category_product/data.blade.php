{{-- Display product based on selected new category --}}
@foreach ($products as $product)
    @php
        $active_promo = 0;
        $price = $product->unit_price;
        $srp = $price;

        if($product->promos_status == 'active' && $product->item_promo_status == 'approved') {
            $active_promo = 1;
            $promo_discount = $product->percentage_discount;
            $price -= $price * $promo_discount / 100;
        }
    @endphp
    <div class="col-lg-3 col-sm-6">
        <div class="single-product">
            <a href="{{ route('product.details', ['slug' => $product->slug]) }}">
                <div class="card">
                    <div class="card-body shadow p-2 bg-body rounded">
                        <a
                            href="{{ route('product.details', ['slug' => $product->slug]) }}">
                            <img src="{{ !empty($product->file_name) ? asset($product->file_name) : asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}"
                             alt="{{ $product->name }}" onerror="this.onerror=null; this.src='{{ asset('/worldcraft/sample-images-wc-size/kaia-mmb.jpg') }}';" style="width: 328px; height: 270px;">
                        </a>
                        <div class="product-content ms-2">
                            <h5 class="fw-bold text-dark"
                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 15px; color: black !important;">
                                <a
                                    href="{{ route('product.details', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                            </h5>
                            <div class="mt-2">
                                @if($price < $srp)
                                    <div class="old-price text-decoration-line-through"
                                        style="color: black;">₱{{ number_format($srp, 2) }}
                                    </div>
                                @else
                                    &nbsp;
                                @endif
                                @php
                                    // if()
                                @endphp
                                <div class="sale-price" style="color: {{ $active_promo == 1 ? '#fd1c1c' : 'black'}};"><b>₱
                                        {{ number_format($price, 2) }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </div>
@endforeach
