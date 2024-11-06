@extends('master')
@section('index')
    <!-- Page Banner Section Start -->
    <div class="section page-banner-section m-0 p-0" style="background-color: #FAEDCE;">
        <h2 class="title ms-5" style="color: black;">Worldcraft Products</h2>
    </div>
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
                                    @include('pages.products.display_category_product.data')
                                </div>
                            </div>
                            <!-- Shop Product Wrapper End -->
                        </div>
                    </div>

                    <!-- Page pagination Start -->
                    <div class="auto-load text-center mt-3" style="display: none;">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    @if($total_page > 1)
                        <div class="row text-center align-items-center justify-content-center" id="load-more-button-container" style="padding : 20px;">
                            <button type="button" class="btn btn-success load-more-data w-25 p-2" disabled>Load More Products...</button>
                        </div>
                    @endif
                    <!-- Page pagination End -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    var ENDPOINT = "{{ route('products.new-category', ['slug' => $slug]) }}";
    var page = 1;
    var total_page = '{{ $total_page }}';
    var remaining_page = total_page;
    console.log(total_page);
    $(document).ready(function () {
        $('.load-more-data').prop({'disabled' : false});
    })

    $('.load-more-data').on('click', function () {
        $('#load-more-button-container').hide();
        page++;
        LoadMore(page);
    })

    function LoadMore(page){
        $('.auto-load').show();
        $.ajax({
            type : 'GET',
            url : ENDPOINT + "?page=" + page,
            datatype : "html",
            success: function (response) {
                remaining_page--;
                if(remaining_page > 1) {
                    $('#load-more-button-container').show();
                }
                $('.auto-load').hide();
                $('#productList').append(response.html)
            },
            error : function (error) {
                console.log('Server error.');
            }
        })
    }
</script>

@endsection
