@extends('front.layout.layout')
@section('content')
    <main id="content" class="wrapper layout-page">
        <section class="z-index-2 position-relative pb-2 mb-12">
            <div class="bg-body-secondary mb-3">
                <div class="container">
                    <nav class="py-4 lh-30px" aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center py-1 mb-0">

                            <li class="breadcrumb-item"><a title="Home" href="../index.html">Home</a></li>
                            <li class="breadcrumb-item"><a title="Shop" href="shop-layout-v2.html">Shop</a></li>
                            <?php echo $categoryDetails['breadcrumbs']; ?>

                            {{-- <li class="breadcrumb-item active" aria-current="page">Natural Coconut Cleansing Oil</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <section class="container pt-6 pb-14 pb-lg-20">
            <div class="row ">
                <div class="col-md-6 pe-lg-13">
                    <div class="position-relative">
                        <div class="position-absolute z-index-2 w-100 d-flex justify-content-end">
                        </div>
                        <div id="slider"
                            class="slick-slider slick-slider-arrow-inside slick-slider-dots-inside slick-slider-dots-light g-0"
                            data-slick-options="{&#34;arrows&#34;:false,&#34;asNavFor&#34;:&#34;#slider-thumb&#34;,&#34;dots&#34;:false,&#34;slidesToShow&#34;:1}">
                            <a href="#" data-gallery="gallery1"><img
                                    src="{{ asset('front/images/products/' . $productDetails['product_image']) }}"
                                    data-src="{{ asset('front/images/products/' . $productDetails['product_image']) }}"
                                    class="h-auto lazy-image" width="540" height="720" alt></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pt-md-0 pt-10">
                    <p class="d-flex align-items-center mb-6">
                        @if (!empty($productDetails['product_discount']) && $productDetails['product_discount'] > 0)
                            <span class="text-decoration-line-through">LKR {{ $productDetails['product_price'] }}.00 </span>
                            <span class="fs-18px text-body-emphasis ps-6 fw-bold">LKR {{ $productDetails['final_price'] }}.00
                            </span>
                            <span
                                class="badge text-bg-primary fs-6 fw-semibold ms-7 px-6 py-3">{{ $productDetails['product_discount'] }}%</span>
                        @else
                            <span id="finale-price" class="fs-18px text-body-emphasis fw-bold ">LKR
                                {{ $productDetails['final_price'] }}.00 </span>
                        @endif
                    </p>

                    <h1 class="mb-4 pb-2 fs-4">{{ $productDetails['product_name'] }}</h1>

                    <p class="fs-15px">{{ $productDetails['description'] }}.</p>

                    <p class="mb-4 pb-2 text-body-emphasis">
                        <svg class="icon fs-5 me-4 pe-2 align-text-bottom">
                            <use xlink:href="#icon-Timer"></use>
                        </svg>
                    <p id='stock-qty'>Kindly choose your size to check availability.</p>
                    </p>
                    <div class="progress mb-7" style="height: 4px;">
                        <div id="progress-bar" class="progress-bar w-25" role="progressbar" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>




                    <form name="addToCart" id="addToCart" class="mb-9 pb-2" {{-- action="javascript:;" --}}
                        action="{{ url('add-to-cart') }}" method="POST">
                        {{-- @method('POST') --}}
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">

                        {{-- ssds --}}
                        <div class="form-group shop-swatch mb-7 d-flex align-items-center">
                            <span class="fw-semibold text-body-emphasis me-7">Size: </span>
                            <ul class="list-inline d-flex justify-content-start mb-0">
                                @foreach ($productDetails['attributes'] as $attribute)
                                    <li class="list-inline-item me-4 fw-semibold">
                                        <input type="radio" id="{{ $attribute['size'] }}" name="size"
                                            class="product-info-size d-none getPrice" value="{{ $attribute['size'] }}"
                                            product-id="{{ $productDetails['id'] }}" required>
                                        <label for="{{ $attribute['size'] }}"
                                            class="fs-14px p-4 d-block rounded text-decoration-none border"
                                            data-var="full size">{{ $attribute['size'] }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- dsds --}}
                        <div class="row align-items-end">
                            <div class="form-group col-sm-4">
                                <label class=" text-body-emphasis fw-semibold fs-15px pb-6" for="number">Quantity:
                                </label>
                                <div class="input-group position-relative w-100 input-group-lg">
                                    <a href="#"
                                        class="shop-down position-absolute translate-middle-y top-50 start-0 ps-7 product-info-2-minus"><i
                                            class="far fa-minus"></i></a>
                                    <input name="qty" type="number" id="quantity"
                                        class="product-info-2-quantity form-control w-100 px-6 text-center" value="1"
                                        min="1" required>
                                    <a href="#"
                                        class="shop-up position-absolute translate-middle-y top-50 end-0 pe-7 product-info-2-plus"><i
                                            class="far fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-8 pt-9 mt-2 mt-sm-0 pt-sm-0">
                                <button type="submit" id="product-to-cart"
                                    class="btn-hover-bg-primary btn-hover-border-primary btn btn-lg btn-dark w-100"
                                    disabled>Add
                                    To Bag
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="mb-4 pb-2">
                        <span class="text-body-emphasis">
                            <svg class="icon fs-28px me-2 pe-4">
                                <use xlink:href="#icon-delivery-1"></use>
                            </svg>Get it between:
                        </span> 2 weeks
                    </p>
                    <p class="mb-4 pb-2">
                        <span class="text-body-emphasis">
                            <svg class="icon fs-28px me-2 pe-4">
                                <use xlink:href="#icon-Package"></use>
                            </svg>Free Delivery & Returns:
                        </span> On all orders over LKR 10,000
                    </p>
                    {{-- <div class="card border-0 bg-body-tertiary rounded text-center mt-7">
                        <div class="pt-8 px-5">
                            <img class="img-fluid" src="{{ asset('front/images/products/product-gallery-06.jpg') }}"
                                alt="pay" width="357" height="28">
                        </div>
                        <div class="card-body pt-6 pb-7">
                            <p class="fs-14px fw-normal mb-0">Guarantee safe &amp; secure checkout</p>
                        </div>
                    </div> --}}

                    {{-- <ul class="list-inline d-flex justify-content-start mb-0 fs-6">
                        <li class="list-inline-item">
                            <a class="text-body text-decoration-none product-info-share product-info-share"
                                href="#"><i class="fab fa-facebook-f me-4"></i> Facebook</a>
                        </li>
                        <li class="list-inline-item ms-7">
                            <a class="text-body text-decoration-none product-info-share product-info-share"
                                href="#"><i class="fab fa-instagram me-4"></i> Instagram</a>
                        </li>
                        <li class="list-inline-item ms-7">
                            <a class="text-body text-decoration-none product-info-share product-info-share"
                                href="#"><i class="fab fa-youtube me-4"></i> Youtube</a>
                        </li>
                    </ul> --}}
                </div>
            </div>
        </section>
        <div class="border-top w-100 h-1px"></div>
        <section class="container pt-15 pb-12 pt-lg-17 pb-lg-20">
            <div class="collapse-tabs">
                <ul class="nav nav-tabs border-0 justify-content-center pb-12 d-none d-md-flex" id="productTabs"
                    role="tablist">

                    <li class="nav-item" role="presentation">
                        <button class="nav-link m-auto fw-semibold py-0 px-8 fs-4 fs-lg-3 border-0 text-body-emphasis"
                            id="how-to-use-tab" data-bs-toggle="tab" data-bs-target="#how-to-use" type="button"
                            role="tab" aria-controls="how-to-use" aria-selected="false">Size-Chart
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-inner">
                        <div class="collapse show border-md-0 border p-md-0 p-6" id="collapse-product-detail">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-8 pt-12 pt-lg-0">
                                    <div class="size-chart text-center">
                                        <table class="table table-bordered size-chart-table">
                                            <thead>
                                                <tr>
                                                    <th>Size</th>
                                                    <th>Bust (inches)</th>
                                                    <th>Waist (inches)</th>
                                                    <th>Hips (inches)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>XS</td>
                                                    <td>32</td>
                                                    <td>24.5</td>
                                                    <td>34.5</td>
                                                </tr>
                                                <tr>
                                                    <td>S</td>
                                                    <td>34</td>
                                                    <td>26.5</td>
                                                    <td>36.5</td>
                                                </tr>
                                                <tr>
                                                    <td>M</td>
                                                    <td>36</td>
                                                    <td>28.5</td>
                                                    <td>38.5</td>
                                                </tr>
                                                <tr>
                                                    <td>L</td>
                                                    <td>38</td>
                                                    <td>30.5</td>
                                                    <td>40.5</td>
                                                </tr>
                                                <tr>
                                                    <td>XL</td>
                                                    <td>40</td>
                                                    <td>32.5</td>
                                                    <td>42.5</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="how-to-use" role="tabpanel" aria-labelledby="how-to-use-tab"
                            tabindex="0">
                            <div class="card border-0 bg-transparent">
                                <div
                                    class="card-header border-0 bg-transparent px-0 py-4 product-tabs-mobile d-block d-md-none">
                                    <h5 class="mb-0">
                                        <button class="btn lh-2 fs-5 py-3 px-6 shadow-none w-100 border text-primary"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapse-to-use"
                                            aria-expanded="false" aria-controls="collapse-to-use">How To Use
                                        </button>
                                    </h5>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="ingredients" role="tabpanel" aria-labelledby="ingredients-tab"
                            tabindex="0">
                            <div
                                class="card-header border-0 bg-transparent px-0 py-4 product-tabs-mobile d-block d-md-none">
                                <h5 class="mb-0">
                                    <button class="btn lh-2 fs-5 py-3 px-6 shadow-none w-100 border text-primary"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapse-ingredients"
                                        aria-expanded="false" aria-controls="collapse-ingredients">How To Use
                                    </button>
                                </h5>
                            </div>
                            <div class="collapse border-md-0 border p-md-0 p-6" id="collapse-ingredients">
                                <div class="pb-3">
                                    <div class="table-responsive mb-5">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td class="ps-0 py-5 pe-5 text-body-emphasis">CAS
                                                    </td>
                                                    <td class="text-end py-5 ps-5 pe-0">
                                                        92128-82-0, 9057-02-7
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-0 py-5 pe-5 text-body-emphasis">
                                                        INCI
                                                    </td>
                                                    <td class="text-end py-5 ps-5 pe-0">
                                                        Nannochloropsis Oculata (micro algae)
                                                        extract, pullulan
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-0 py-5 pe-5 text-body-emphasis">
                                                        Composition
                                                    </td>
                                                    <td class="text-end py-5 ps-5 pe-0">
                                                        Nannochloropsis Oculata (micro algae)
                                                        extract, pullulan, water, ethanol
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-0 py-5 pe-5 text-body-emphasis">
                                                        Appearance
                                                    </td>
                                                    <td class="text-end py-5 ps-5 pe-0">
                                                        Yellow to amber, viscous liquid
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-0 py-5 pe-5 text-body-emphasis">
                                                        Solubility
                                                    </td>
                                                    <td class="text-end py-5 ps-5 pe-0">
                                                        Soluble in water &amp; ethanol
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="ps-0 py-5 pe-5 text-body-emphasis">
                                                        Storage
                                                    </td>
                                                    <td class="text-end py-5 ps-5 pe-0">
                                                        Store refrigerated (4-8oC / 39-46oF)
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="mb-0">
                                        Perfect for Equestrian homes or every horse lover. Designer premium
                                        signature aluminum alloy all Arthur Court is compliance with FDA
                                        regulations. Aluminum Serveware can be chilled in the freezer or
                                        refrigerator and warmed in the oven to 350. Wash by hand with mild dish
                                        soap and dry immediately – do not put in the dishwasher. Comes in Gift
                                        Box perfect for Equestrian home or Horse lover in your life.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="border-top w-100 h-1px"></div>
        <section class="container pt-15 pb-15 pt-lg-17 pb-lg-20">
            <div class="text-center">
                <h2 class="mb-12">You may also like</h2>
            </div>
            <div class="slick-slider"
                data-slick-options="{&#34;arrows&#34;:true,&#34;centerMode&#34;:true,&#34;centerPadding&#34;:&#34;calc((100% - 1440px) / 2)&#34;,&#34;dots&#34;:true,&#34;infinite&#34;:true,&#34;responsive&#34;:[{&#34;breakpoint&#34;:1200,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:3}},{&#34;breakpoint&#34;:992,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:2}},{&#34;breakpoint&#34;:576,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:1}}],&#34;slidesToShow&#34;:4}">

                @foreach ($relatedProducts as $product)
                    <div class="mb-6">
                        <div class="card card-product grid-2 bg-transparent border-0">
                            <figure class="card-img-top position-relative mb-7 overflow-hidden">
                                <a href="{{ url('product/' . $product['id']) }}" class="hover-zoom-in d-block"
                                    title="Shield Conditioner">
                                    <img src="{{ url('front/images/products/' . $product['product_image']) }}"
                                        data-src="{{ url('front/images/products/' . $product['product_image']) }}"
                                        class="img-fluid lazy-image w-100" alt="Shield Conditioner" width="330"
                                        height="440">
                                </a>
                                @if (!empty($product['product_discount']) && $product['product_discount'] > 0)
                                    <div class="position-absolute product-flash z-index-2">
                                        <span class="badge badge-product-flash on-sale bg-primary">
                                            -{{ $product['product_discount'] }}%
                                        </span>
                                    </div>
                                @endif
                                <div class="position-absolute d-flex z-index-2 product-actions  vertical">
                                    <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                        href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Add To Wishlist">
                                        <svg class="icon icon-heart-light">
                                            <use xlink:href="#icon-heart-light"></use>
                                        </svg>
                                    </a>

                                </div><a href="#"
                                    class="btn btn-add-to-cart btn-dark btn-hover-bg-primary btn-hover-border-primary position-absolute z-index-2 text-nowrap">Add
                                    To Cart</a>
                            </figure>
                            <div class="card-body text-center p-0">
                                <span
                                    class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
                                    <ins class="text-decoration-none">LKR
                                        {{ $product['final_price'] }}.00</ins>&nbsp;&nbsp;&nbsp;
                                    @if ($product['product_discount'] != '')
                                        <del class=" text-body fw-500 me-4 fs-13px">LKR
                                            {{ $product['product_price'] }}.00</del>
                                    @endif
                                </span>
                                <h4
                                    class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                                    <a class="text-decoration-none text-reset"
                                        href="product-details-v1.html">{{ $product['product_name'] }}</a>
                                </h4>
                                <div class="d-flex align-items-center fs-12px justify-content-center">
                                    <div class="rating">
                                        <div class="empty-stars">
                                            <span class="star">
                                                <svg class="icon star-o">
                                                    <use xlink:href="#star-o"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star-o">
                                                    <use xlink:href="#star-o"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star-o">
                                                    <use xlink:href="#star-o"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star-o">
                                                    <use xlink:href="#star-o"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star-o">
                                                    <use xlink:href="#star-o"></use>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="filled-stars" style="width: 80%">
                                            <span class="star">
                                                <svg class="icon star text-primary">
                                                    <use xlink:href="#star"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star text-primary">
                                                    <use xlink:href="#star"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star text-primary">
                                                    <use xlink:href="#star"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star text-primary">
                                                    <use xlink:href="#star"></use>
                                                </svg>
                                            </span>
                                            <span class="star">
                                                <svg class="icon star text-primary">
                                                    <use xlink:href="#star"></use>
                                                </svg>
                                            </span>
                                        </div>
                                    </div><span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="mb-6">
                <div class="card card-product grid-2 bg-transparent border-0">
                    <figure class="card-img-top position-relative mb-7 overflow-hidden">
                        <a href="product-details-v1.html" class="hover-zoom-in d-block"
                            title="Perfecting Facial Oil">
                            <img src="{{ asset('front/images/products/product-gallery-06.jpg') }}" data-src="{{ asset('front/images/products/product-gallery-06.jpg') }}"
                                class="img-fluid lazy-image w-100" alt="Perfecting Facial Oil" width="330"
                                height="440">
                        </a>
                        <div class="position-absolute d-flex z-index-2 product-actions  vertical"><a
                                class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Quick View">
                                <span data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                    class="d-flex align-items-center justify-content-center">
                                    <svg class="icon icon-eye-light">
                                        <use xlink:href="#icon-eye-light"></use>
                                    </svg>
                                </span>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Add To Wishlist">
                                <svg class="icon icon-star-light">
                                    <use xlink:href="#icon-star-light"></use>
                                </svg>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Compare">
                                <svg class="icon icon-arrows-left-right-light">
                                    <use xlink:href="#icon-arrows-left-right-light"></use>
                                </svg>
                            </a>
                        </div><a href="#"
                            class="btn btn-add-to-cart btn-dark btn-hover-bg-primary btn-hover-border-primary position-absolute z-index-2 text-nowrap">Add
                            To Cart</a>
                    </figure>
                    <div class="card-body text-center p-0">
                        <span
                            class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">$20.00</span>
                        <h4
                            class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                            <a class="text-decoration-none text-reset" href="product-details-v1.html">Perfecting
                                Facial Oil</a></h4>
                        <div class="d-flex align-items-center fs-12px justify-content-center">
                            <div class="rating">
                                <div class="empty-stars">
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                </div>
                                <div class="filled-stars" style="width: 100%">
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div><span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <div class="card card-product grid-2 bg-transparent border-0">
                    <figure class="card-img-top position-relative mb-7 overflow-hidden">
                        <a href="product-details-v1.html" class="hover-zoom-in d-block"
                            title="Enriched Hand &amp; Body Wash">
                            <img src="{{ asset('front/images/products/product-gallery-06.jpg') }}" data-src="{{ asset('front/images/products/product-gallery-06.jpg') }}"
                                class="img-fluid lazy-image w-100" alt="Enriched Hand &amp; Body Wash" width="330"
                                height="440">
                        </a>
                        <div class="position-absolute product-flash z-index-2 "><span
                                class="badge badge-product-flash on-new">New</span></div>
                        <div class="position-absolute d-flex z-index-2 product-actions  vertical"><a
                                class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Quick View">
                                <span data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                    class="d-flex align-items-center justify-content-center">
                                    <svg class="icon icon-eye-light">
                                        <use xlink:href="#icon-eye-light"></use>
                                    </svg>
                                </span>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Add To Wishlist">
                                <svg class="icon icon-star-light">
                                    <use xlink:href="#icon-star-light"></use>
                                </svg>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Compare">
                                <svg class="icon icon-arrows-left-right-light">
                                    <use xlink:href="#icon-arrows-left-right-light"></use>
                                </svg>
                            </a>
                        </div><a href="#"
                            class="btn btn-add-to-cart btn-dark btn-hover-bg-primary btn-hover-border-primary position-absolute z-index-2 text-nowrap">Add
                            To Cart</a>
                    </figure>
                    <div class="card-body text-center p-0">
                        <span
                            class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">$29.00</span>
                        <h4
                            class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                            <a class="text-decoration-none text-reset" href="product-details-v1.html">Enriched Hand
                                &amp; Body Wash</a></h4>
                        <div class="d-flex align-items-center fs-12px justify-content-center">
                            <div class="rating">
                                <div class="empty-stars">
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                </div>
                                <div class="filled-stars" style="width: 100%">
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div><span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <div class="card card-product grid-2 bg-transparent border-0">
                    <figure class="card-img-top position-relative mb-7 overflow-hidden">
                        <a href="product-details-v1.html" class="hover-zoom-in d-block" title="Shield Shampoo">
                            <img src="{{ asset('front/images/products/product-gallery-06.jpg') }}" data-src="{{ asset('front/images/products/product-gallery-06.jpg') }}"
                                class="img-fluid lazy-image w-100" alt="Shield Shampoo" width="330" height="440">
                        </a>
                        <div class="position-absolute product-flash z-index-2 "><span
                                class="badge badge-product-flash on-sale bg-primary">-24%</span></div>
                        <div class="position-absolute d-flex z-index-2 product-actions  vertical"><a
                                class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Quick View">
                                <span data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                    class="d-flex align-items-center justify-content-center">
                                    <svg class="icon icon-eye-light">
                                        <use xlink:href="#icon-eye-light"></use>
                                    </svg>
                                </span>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Add To Wishlist">
                                <svg class="icon icon-star-light">
                                    <use xlink:href="#icon-star-light"></use>
                                </svg>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Compare">
                                <svg class="icon icon-arrows-left-right-light">
                                    <use xlink:href="#icon-arrows-left-right-light"></use>
                                </svg>
                            </a>
                        </div><a href="#"
                            class="btn btn-add-to-cart btn-dark btn-hover-bg-primary btn-hover-border-primary position-absolute z-index-2 text-nowrap">Add
                            To Cart</a>
                    </figure>
                    <div class="card-body text-center p-0">
                        <span
                            class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
                            <del class=" text-body fw-500 me-4 fs-13px">$25.00</del>
                            <ins class="text-decoration-none">$19.00</ins></span>
                        <h4
                            class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                            <a class="text-decoration-none text-reset" href="product-details-v1.html">Shield
                                Shampoo</a></h4>
                        <div class="d-flex align-items-center fs-12px justify-content-center">
                            <div class="rating">
                                <div class="empty-stars">
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                </div>
                                <div class="filled-stars" style="width: 80%">
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div><span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <div class="card card-product grid-2 bg-transparent border-0">
                    <figure class="card-img-top position-relative mb-7 overflow-hidden">
                        <a href="product-details-v1.html" class="hover-zoom-in d-block" title="Enriched Hand Wash">
                            <img src="{{ asset('front/images/products/product-gallery-06.jpg') }}" data-src="{{ asset('front/images/products/product-gallery-06.jpg') }}"
                                class="img-fluid lazy-image w-100" alt="Enriched Hand Wash" width="330"
                                height="440">
                        </a>
                        <div class="position-absolute product-flash z-index-2 "><span
                                class="badge badge-product-flash on-sale bg-primary">-26%</span></div>
                        <div class="position-absolute d-flex z-index-2 product-actions  vertical"><a
                                class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Quick View">
                                <span data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                    class="d-flex align-items-center justify-content-center">
                                    <svg class="icon icon-eye-light">
                                        <use xlink:href="#icon-eye-light"></use>
                                    </svg>
                                </span>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Add To Wishlist">
                                <svg class="icon icon-star-light">
                                    <use xlink:href="#icon-star-light"></use>
                                </svg>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Compare">
                                <svg class="icon icon-arrows-left-right-light">
                                    <use xlink:href="#icon-arrows-left-right-light"></use>
                                </svg>
                            </a>
                        </div><a href="#"
                            class="btn btn-add-to-cart btn-dark btn-hover-bg-primary btn-hover-border-primary position-absolute z-index-2 text-nowrap">Add
                            To Cart</a>
                    </figure>
                    <div class="card-body text-center p-0">
                        <span
                            class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
                            <del class=" text-body fw-500 me-4 fs-13px">$39.00</del>
                            <ins class="text-decoration-none">$29.00</ins></span>
                        <h4
                            class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                            <a class="text-decoration-none text-reset" href="product-details-v1.html">Enriched Hand
                                Wash</a></h4>
                        <div class="d-flex align-items-center fs-12px justify-content-center">
                            <div class="rating">
                                <div class="empty-stars">
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                </div>
                                <div class="filled-stars" style="width: 80%">
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div><span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <div class="card card-product grid-2 bg-transparent border-0">
                    <figure class="card-img-top position-relative mb-7 overflow-hidden">
                        <a href="product-details-v1.html" class="hover-zoom-in d-block" title="Enriched Duo">
                            <img src="{{ asset('front/images/products/product-gallery-06.jpg') }}" data-src="{{ asset('front/images/products/product-gallery-06.jpg') }}"
                                class="img-fluid lazy-image w-100" alt="Enriched Duo" width="330" height="440">
                        </a>
                        <div class="position-absolute d-flex z-index-2 product-actions  vertical"><a
                                class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Quick View">
                                <span data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                    class="d-flex align-items-center justify-content-center">
                                    <svg class="icon icon-eye-light">
                                        <use xlink:href="#icon-eye-light"></use>
                                    </svg>
                                </span>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Add To Wishlist">
                                <svg class="icon icon-star-light">
                                    <use xlink:href="#icon-star-light"></use>
                                </svg>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Compare">
                                <svg class="icon icon-arrows-left-right-light">
                                    <use xlink:href="#icon-arrows-left-right-light"></use>
                                </svg>
                            </a>
                        </div><a href="#"
                            class="btn btn-add-to-cart btn-dark btn-hover-bg-primary btn-hover-border-primary position-absolute z-index-2 text-nowrap">Add
                            To Cart</a>
                    </figure>
                    <div class="card-body text-center p-0">
                        <span
                            class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">$29.00</span>
                        <h4
                            class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                            <a class="text-decoration-none text-reset" href="product-details-v1.html">Enriched
                                Duo</a></h4>
                        <div class="d-flex align-items-center fs-12px justify-content-center">
                            <div class="rating">
                                <div class="empty-stars">
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                </div>
                                <div class="filled-stars" style="width: 100%">
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div><span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <div class="card card-product grid-2 bg-transparent border-0">
                    <figure class="card-img-top position-relative mb-7 overflow-hidden">
                        <a href="product-details-v1.html" class="hover-zoom-in d-block" title="Shield Spray">
                            <img src="{{ asset('front/images/products/product-gallery-06.jpg') }}" data-src="{{ asset('front/images/products/product-gallery-06.jpg') }}"
                                class="img-fluid lazy-image w-100" alt="Shield Spray" width="330" height="440">
                        </a>
                        <div class="position-absolute d-flex z-index-2 product-actions  vertical"><a
                                class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Quick View">
                                <span data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                    class="d-flex align-items-center justify-content-center">
                                    <svg class="icon icon-eye-light">
                                        <use xlink:href="#icon-eye-light"></use>
                                    </svg>
                                </span>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Add To Wishlist">
                                <svg class="icon icon-star-light">
                                    <use xlink:href="#icon-star-light"></use>
                                </svg>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Compare">
                                <svg class="icon icon-arrows-left-right-light">
                                    <use xlink:href="#icon-arrows-left-right-light"></use>
                                </svg>
                            </a>
                        </div><a href="#"
                            class="btn btn-add-to-cart btn-dark btn-hover-bg-primary btn-hover-border-primary position-absolute z-index-2 text-nowrap">Add
                            To Cart</a>
                    </figure>
                    <div class="card-body text-center p-0">
                        <span
                            class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">$29.00</span>
                        <h4
                            class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                            <a class="text-decoration-none text-reset" href="product-details-v1.html">Shield
                                Spray</a></h4>
                        <div class="d-flex align-items-center fs-12px justify-content-center">
                            <div class="rating">
                                <div class="empty-stars">
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                </div>
                                <div class="filled-stars" style="width: 100%">
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div><span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <div class="card card-product grid-2 bg-transparent border-0">
                    <figure class="card-img-top position-relative mb-7 overflow-hidden">
                        <a href="product-details-v1.html" class="hover-zoom-in d-block" title="Shield Spray">
                            <img src="{{ asset('front/images/products/product-gallery-06.jpg') }}" data-src="{{ asset('front/images/products/product-gallery-06.jpg') }}"
                                class="img-fluid lazy-image w-100" alt="Shield Spray" width="330" height="440">
                        </a>
                        <div class="position-absolute product-flash z-index-2 "><span
                                class="badge badge-product-flash on-sale bg-primary">-36%</span></div>
                        <div class="position-absolute d-flex z-index-2 product-actions  vertical"><a
                                class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Quick View">
                                <span data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                    class="d-flex align-items-center justify-content-center">
                                    <svg class="icon icon-eye-light">
                                        <use xlink:href="#icon-eye-light"></use>
                                    </svg>
                                </span>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                href="#" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Add To Wishlist">
                                <svg class="icon icon-star-light">
                                    <use xlink:href="#icon-star-light"></use>
                                </svg>
                            </a>
                            <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-title="Compare">
                                <svg class="icon icon-arrows-left-right-light">
                                    <use xlink:href="#icon-arrows-left-right-light"></use>
                                </svg>
                            </a>
                        </div><a href="#"
                            class="btn btn-add-to-cart btn-dark btn-hover-bg-primary btn-hover-border-primary position-absolute z-index-2 text-nowrap">Add
                            To Cart</a>
                    </figure>
                    <div class="card-body text-center p-0">
                        <span
                            class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
                            <del class=" text-body fw-500 me-4 fs-13px">$39.00</del>
                            <ins class="text-decoration-none">$25.00</ins></span>
                        <h4
                            class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                            <a class="text-decoration-none text-reset" href="product-details-v1.html">Shield
                                Spray</a></h4>
                        <div class="d-flex align-items-center fs-12px justify-content-center">
                            <div class="rating">
                                <div class="empty-stars">
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star-o">
                                            <use xlink:href="#star-o"></use>
                                        </svg>
                                    </span>
                                </div>
                                <div class="filled-stars" style="width: 90%">
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                    <span class="star">
                                        <svg class="icon star text-primary">
                                            <use xlink:href="#star"></use>
                                        </svg>
                                    </span>
                                </div>
                            </div><span class="reviews ms-4 pt-3 fs-14px">2947 reviews</span>
                        </div>
                    </div>
                </div>
            </div> --}}
            </div>
        </section>
        <div class="border-top w-100 h-1px"></div>

    </main>
@endsection
