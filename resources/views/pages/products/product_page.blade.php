@extends('master')
@section('index')
    <div class="menu-overlay"></div>
    <!-- Page Banner Section Start -->
    
    <!-- Shop Section Start -->
    <div class="section section-padding mt-n3">
        <div class="container" style="max-width: 80%; margin-top: -80px;">
            <div class="row flex-row-reverse">
                <div class="col-lg-12">
                    <!-- Shop top Bar Start -->
                    <div class="shop-top-bar col-lg-12">
                        <div class="shop-sort">
                            <span class="title">Sort By :</span>
                            <select class="nice_select">
                                <option value="1">Newest</option>
                                <option value="2">Oldest</option>
                                <option value="3">Price low to high</option>
                                <option value="4">Price high to low</option>
                            </select>
                        </div>
                    </div>
                    <!-- Shop top Bar End -->

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="grid">
                            <!-- Shop Product Wrapper Start -->
                            <div class="shop-product-wrapper">
                                <div class="row" id="productList">
                                    @foreach ($products as $product)
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="single-product">
                                                <a href="{{ route('product.details', ['id' => $product->id]) }}">
                                                    <div class="card">
                                                        <div class="card-body shadow p-2 bg-body rounded">
                                                            <a
                                                                href="{{ route('product.details', ['id' => $product->id]) }}"><img
                                                                    src="{{ $product->image ? asset('images/product/' . $product->image) : asset('worldcraft/icons/no-image-wc.jpg') }}"
                                                                    alt="{{ $product->name }}"></a>
                                                            <div class="product-content ms-2">
                                                                <h5 class="fw-bold text-dark"
                                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-size: 15px;">
                                                                    <a
                                                                        href="{{ route('product.details', ['id' => $product->id]) }}">{{ $product->name }}</a>
                                                                </h5>
                                                                <div class="mt-2">
                                                                    <div class="old-price text-decoration-line-through"
                                                                        style="color: black;">₱
                                                                        {{ number_format($product->unit_price, 2) }}</div>
                                                                    <div class="sale-price" style="color: #fd1c1c;"><b>₱
                                                                            {{ number_format($product->unit_price, 2) }}</b>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Shop Product Wrapper End -->
                        </div>
                    </div>

                    <!-- Page pagination Start -->
                    <div class="page-pagination">
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a>
                            </li>
                            <li class="page-item"><a class="page-link active" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- Page pagination End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Section End -->

    {{-- <script>
        $(document).ready(function() {
            $('.category-link').on('click', function(e) {
                e.preventDefault();

                var categoryId = $(this).data('id');
                console.log(categoryId);

                $('#productList').html('');
                if (categoryId) {
                    $.ajax({
                        url: `/category/${categoryId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(products) {
                            console.log(products);

                            let productHTML = '';
                            if (products.length > 0) {
                                products.forEach(function(product) {
                                    const productImage = product.image ?
                                        `{{ asset('images/product/${product.image}') }}` :
                                        `{{ asset('worldcraft/icons/no-image-wc.jpg') }}`;
                                    productHTML += `
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="single-product">
                                                    <a href="#"><img src="${productImage}" alt="${product.name}"></a>
                                                    <div class="product-content">
                                                        <h4 class="title"><a href="{{ route('product.details', ['id' => $product->id]) }}">${product.name}</a></h4>
                                                        <div class="price">
                                                            <span class="sale-price">${product.price}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`;
                                });
                            } else {
                                productHTML = `<p>No products found in this category.</p>`;
                            }
                            $('#productList').append(productHTML);
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error: ' + status + error);
                            $('#productList').html(
                                '<p>There was an error loading products. Please try again later.</p>'
                            );
                        }
                    });
                }
            });
        });
    </script> --}}
@endsection
