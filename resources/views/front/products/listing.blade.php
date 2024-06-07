@extends('front.layout.layout')
@section('content')
    <main id="content" class="wrapper layout-page">
        <section class="page-title z-index-2 position-relative">
            <div class="bg-body-secondary">
                <div class="container">
                    <nav class="py-4 lh-30px" aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center py-1">
                            <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
                            {{-- <li class="breadcrumb-item active" aria-current="page"><a href="#">Shop Grid Layout</a></li> --}}

                            <?php echo $categoryDetails['breadcrumbs']; ?>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="text-center py-13">
                <div class="container">
                    <h2 class="mb-0">Shop Grid Layout</h2>
                </div>
            </div>
        </section>
        <section class="container container-xxl">
            <div class="tool-bar mb-11 align-items-center justify-content-between d-lg-flex">
                <div class="tool-bar-left mb-6 mb-lg-0 fs-18px">We found <span
                        class="text-body-emphasis fw-semibold">{{ $TotalRecordCount }}</span> products available for
                    you</div>
                <div class="tool-bar-right align-items-center d-flex ">
                    <ul class="list-unstyled d-flex align-items-center list-inline me-lg-7 me-0 mb-0 ">
                        
                    </ul>
                    <form method="get" action="" id="sortProductsForm">
                        {{-- @csrf --}}
                        <ul class="list-unstyled d-flex align-items-center list-inline mb-0 ms-auto">
                            <li class="list-inline-item me-0">
                                <input type="hidden" name="url" id="url" value="{{ $url }}">
                                <form method="get" action="{{ url($url) }}" id="sortProductsForm">
                                    {{-- @csrf --}}
                                    <ul class="list-unstyled d-flex align-items-center list-inline mb-0 ms-auto">
                                        <li class="list-inline-item me-0">
                                            <input type="hidden" name="url" id="url" value="{{ $url }}">
                                            <select class="form-select" name="orderby" id="orderby" onchange="document.getElementById('sortProductsForm').submit();">
                                                <option value="" {{ request('orderby') == '' ? 'selected' : '' }}>Default sorting</option>
                                                {{-- <option value="best_popular" {{ request('orderby') == 'best_popular' ? 'selected' : '' }}>Sort by popularity</option> --}}
                                                {{-- <option value="best_rating" {{ request('orderby') == 'best_rating' ? 'selected' : '' }}>Sort by average rating</option> --}}
                                                <option value="product_latest" {{ request('orderby') == 'product_latest' ? 'selected' : '' }}>Sort by latest</option>
                                                <option value="lowest_price" {{ request('orderby') == 'lowest_price' ? 'selected' : '' }}>Sort by price: low to high</option>
                                                <option value="highest_price" {{ request('orderby') == 'highest_price' ? 'selected' : '' }}>Sort by price: high to low</option>
                                                <option value="featured_products" {{ request('orderby') == 'featured_products' ? 'selected' : '' }}>Sort by featured products</option>
                                                <option value="discounted_products" {{ request('orderby') == 'discounted_products' ? 'selected' : '' }}>Sort by discounted products</option>
                                            </select>
                                        </li>
                                    </ul>
                                </form>
                                
                            </li>
                        </ul>
                    </form>

                </div>
            </div>
        </section>
        <div class="container container-xxl pb-16 pb-lg-18">
            <div class="row">
                <div class="col-lg-9 order-lg-1">


                    <div class="row gy-11">
                        @include('front.products.ajax_products_listing')
                    </div>


                    <nav class="d-flex mt-13 pt-3 justify-content-center" aria-label="pagination" data-animate="fadeInUp">
                        {{ $categoryProducts->links() }}
                         
                    </nav>
                </div>
                <div class="col-lg-3 d-lg-block d-none">
                    @include('front.products.filters')
                </div>
            </div>
        </div>
    </main>
@endsection
