@extends('front.layout.layout')
@section('content')
    <main id="content" class="wrapper layout-page">


        <!--Banner-->
        <section>
            <div class="slick-slider hero hero-header-01"
                data-slick-options="{&#34;arrows&#34;:false,&#34;autoplay&#34;:true,&#34;cssEase&#34;:&#34;ease-in-out&#34;,&#34;dots&#34;:false,&#34;fade&#34;:true,&#34;infinite&#34;:true,&#34;slidesToShow&#34;:1,&#34;speed&#34;:600}">
                {{-- <div class="vh-100 d-flex align-items-center"> --}}


                {{-- test --}}

                @foreach ($homeSliderBanners as $sliderBanner)
                    <div class="vh-100 d-flex align-items-center">
                        <div class="lazy-bg bg-overlay position-absolute z-index-1 w-100 h-100 light-mode-img"
                            data-bg-src="{{ asset('front/images/banners/' . $sliderBanner['banner_image']) }}">
                        </div>
                        <div class="lazy-bg bg-overlay dark-mode-img position-absolute z-index-1 w-100 h-100"
                            data-bg-src="{{ asset('front/images/banners/' . $sliderBanner['banner_image_dark']) }}">
                        </div>
                        <div class="z-index-2 container container-xxl py-21 pt-xl-10 pb-xl-11">
                            <div class="hero-content text-start">
                                <div data-animate="fadeInDown">
                                    <p class="text-body-emphasis mb-8 text-uppercase fw-semibold fs-15px">
                                        {{ $sliderBanner['title'] }}
                                    </p>
                                    <h1 class="mb-7 hero-title" style="width: 50%;">{{ $sliderBanner['heading'] }}</h1>
                                    <p class="hero-desc text-body-calculate fs-18px mb-11">
                                        {{ $sliderBanner['description'] }}.</p>
                                </div>
                                <a href="{{ $sliderBanner['link'] }}" data-animate="fadeInUp"
                                    class="btn btn-lg btn-dark btn-hover-bg-primary btn-hover-border-primary">
                                    {{ $sliderBanner['button'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
        </section>


        <!--Featured Products-->
        <section id="our_best_sellers_1">
            <div class="pt-14 pb-14 pt-lg-19 pb-lg-16">
                {{-- <div class="container container-xxl mb-13 d-xl-flex"> --}}
                <div class="container container-xxl py-lg-5 pt-14 pb-16">
                    <div class="mb-13 pb-3 text-center" data-animate="fadeInUp">
                        <h2 class="mb-5">Our Featured Products</h2>
                        <p class="fs-18px mb-0">Get the Look, Feel the Difference</p>
                    </div>
                </div>
                <div class="container-fluid mb-4">
                    <div class="slick-slider our-best-seller-4"
                        data-slick-options="{&#34;arrows&#34;:true,&#34;centerMode&#34;:true,&#34;centerPadding&#34;:&#34;calc((100% - 1440px) / 2)&#34;,&#34;dots&#34;:true,&#34;infinite&#34;:true,&#34;responsive&#34;:[{&#34;breakpoint&#34;:1200,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:3}},{&#34;breakpoint&#34;:992,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:2}},{&#34;breakpoint&#34;:576,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:1}}],&#34;slidesToShow&#34;:4}">

                        @foreach ($featuredProducts as $product)
                            <div data-animate="fadeInUp">
                                <div class="card card-product grid-1 bg-transparent border-0">
                                    <figure class="card-img-top position-relative mb-7 overflow-hidden ">
                                        <a href="{{ url('product/' . $product['id']) }}" class="hover-zoom-in d-block"
                                            title="{{ $product['product_name'] }}">
                                            <img src="{{ asset('front/images/products/' . $product['product_image']) }}"
                                                data-src="{{ asset('front/images/products/' . $product['product_image']) }}"
                                                class="img-fluid lazy-image w-100" alt="{{ $product['product_name'] }}"
                                                width="330" height="440">
                                        </a>

                                        @if (!empty($product['product_discount']) && $product['product_discount'] > 0)
                                            <div class="position-absolute product-flash z-index-2">
                                                <span class="badge badge-product-flash on-sale bg-primary">
                                                    -{{ $product['product_discount'] }}%
                                                </span>
                                            </div>
                                        @endif
                                        {{-- <div class="position-absolute d-flex z-index-2 product-actions  horizontal"><a
                                            class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
                                            href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Add To Cart">
                                            <svg class="icon icon-shopping-bag-open-light">
                                                <use xlink:href="#icon-shopping-bag-open-light"></use>
                                            </svg>
                                        </a>
                                        <a class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                            href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Add To Wishlist">
                                            <svg class="icon icon-heart-light">
                                                <use xlink:href="#icon-heart-light"></use>
                                            </svg>
                                        </a>
                                    </div> --}}
                                    </figure>
                                    <div class="card-body text-center p-0">
                                        <span
                                            class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
                                            <ins class="text-decoration-none">LKR
                                                {{ number_format($product['final_price'], 2) }}
                                            </ins>&nbsp;&nbsp;&nbsp;
                                            @if ($product['product_discount'] != '')
                                                <del class=" text-body fw-500 me-4 fs-13px">LKR
                                                    {{ number_format($product['product_price'], 2) }}
                                                </del>
                                            @endif
                                        </span>
                                        <h4
                                            class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                                            <a class="text-decoration-none text-reset"
                                                href="shop/product-details-v1.html">{{ $product['product_name'] }}</a>
                                        </h4>
                                        {{-- <div class="d-flex align-items-center fs-12px justify-content-center">
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
                                    </div> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>





        <!--2 boxes-->
        <section class="container container-xxl">
            <div class="row gy-30px">

                @foreach ($homeFixBanner1 as $fixBanner1)
                    <div class="col-lg-6" data-animate="fadeInUp">
                        <div class="card border-0 rounded-0 banner-01 hover-zoom-in hover-shine">
                            <img class="lazy-image object-fit-cover card-img light-mode-img"
                                src="{{ url('front/images/banners/' . $fixBanner1['banner_image']) }}"
                                data-src="{{ url('front/images/banners/' . $fixBanner1['banner_image']) }}" width="690"
                                height="420" alt="Intensive Glow C&#43; Serum">
                            <img class="lazy-image dark-mode-img object-fit-cover card-img"
                                src="{{ asset('front/images/banners/' . $fixBanner1['banner_image_dark']) }}"
                                data-src="{{ asset('front/images/banners/' . $fixBanner1['banner_image_dark']) }}"
                                width="690" height="420" alt="Intensive Glow C&#43; Serum">
                            <div class="card-img-overlay d-inline-flex flex-column p-md-12 m-md-2 p-8">
                                <h6 class="card-subtitle ls-1 fs-15px mb-5 fw-semibold text-body-calculate">
                                    {{ $fixBanner1['title'] }}
                                </h6>
                                <h3 class="card-title lh-45px mw-md-60 pe-xl-15  fs-3 pe-0">{{ $fixBanner1['heading'] }}
                                </h3>
                                {{-- <div class="mt-7"><a href="#"
                                        class="btn btn-white px-6 shadow-sm">{{ $fixBanner1['button'] }}</a></div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($homeFixBanner2 as $fixBanner2)
                    <div class="col-lg-6" data-animate="fadeInUp">
                        <div class="card border-0 rounded-0 banner-01 hover-zoom-in hover-shine">
                            <img class="lazy-image object-fit-cover card-img light-mode-img"
                                src="{{ url('front/images/banners/' . $fixBanner2['banner_image']) }}"
                                data-src="{{ url('front/images/banners/' . $fixBanner2['banner_image']) }}" width="690"
                                height="420" alt="25% off Everything">
                            <img class="lazy-image dark-mode-img object-fit-cover card-img"
                                src="{{ asset('front/images/banners/' . $fixBanner2['banner_image_dark']) }}"
                                data-src="{{ asset('front/images/banners/' . $fixBanner2['banner_image_dark']) }}"
                                width="690" height="420" alt="25% off Everything">
                            <div class="card-img-overlay d-inline-flex flex-column p-md-12 m-md-2 p-8">
                                <h3 class="card-title lh-45px fs-3 pe-15">{{ $fixBanner2['heading'] }}</h3>
                                <p class="card-text fs-15px text-body-emphasis mw-md-60 pe-xl-20">
                                    {{ $fixBanner2['title'] }}.</p>
                                {{-- <div class="mt-7"><a href="#"
                                        class="btn btn-white shadow-sm">{{ $fixBanner2['button'] }}</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </section>


        <!--Free Shipping-->
        <section class="pt-12 pb-lg-13 pb-13">
            <div class="container container-xxl">
                <div class="row">
                    <div class="col-xl-3 col-md-6" data-animate="fadeInUp">
                        <div class="icon-box icon-box-style-1 card border-0 text-center">
                            <div class="icon-box-icon card-img fs-70px text-primary">
                                <svg class="icon">
                                    <use xlink:href="#icon-box-01"></use>
                                </svg>
                            </div>
                            <div class="icon-box-content card-body pt-4">
                                <h3 class="icon-box-title card-title fs-5 mb-4 pb-2">Free Delivery</h3>
                                <p class="icon-box-desc card-text fs-18px mb-0">Free Delivery for orders over <br>LKR 10,000
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" data-animate="fadeInUp">
                        <div class="icon-box icon-box-style-1 card border-0 text-center">
                            <div class="icon-box-icon card-img fs-70px text-primary">
                                <svg class="icon">
                                    <use xlink:href="#icon-box-02"></use>
                                </svg>
                            </div>
                            <div class="icon-box-content card-body pt-4">
                                <h3 class="icon-box-title card-title fs-5 mb-4 pb-2">Returns</h3>
                                <p class="icon-box-desc card-text fs-18px mb-0">Within 10 days for an exchange.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" data-animate="fadeInUp">
                        <div class="icon-box icon-box-style-1 card border-0 text-center">
                            <div class="icon-box-icon card-img fs-70px text-primary">
                                <svg class="icon">
                                    <use xlink:href="#icon-box-03"></use>
                                </svg>
                            </div>
                            <div class="icon-box-content card-body pt-4">
                                <h3 class="icon-box-title card-title fs-5 mb-4 pb-2">Online Support</h3>
                                <p class="icon-box-desc card-text fs-18px mb-0">24 hours a day, 7 days a week</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6" data-animate="fadeInUp">
                        <div class="icon-box icon-box-style-1 card border-0 text-center">
                            <div class="icon-box-icon card-img fs-70px text-primary">
                                <svg class="icon">
                                    <use xlink:href="#icon-box-04"></use>
                                </svg>
                            </div>
                            <div class="icon-box-content card-body pt-4">
                                <h3 class="icon-box-title card-title fs-5 mb-4 pb-2">Flexible Payment</h3>
                                <p class="icon-box-desc card-text fs-18px mb-0">Pay with Cash on Delivery or Credit Cards
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Newly Released-->
        <section class="container-fluid px-10 px-xl-21 px-lg-15 pt-lg-18 pb-lg-21 py-15">
            <div class="pb-8 pb-lg-16 text-center container px-10 px-lg-25">
                <div class="mb-2 pb-3 text-center" data-animate="fadeInUp">
                    <h2 class="mb-5">Newly Released</h2>
                    <p class="fs-18px mb-0">Feel the Quality, Wear the Style</p>
                </div>

            </div>
            <div class="row mt-9 gy-8">

                @foreach ($newProducts as $product)
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card card-product grid-2 bg-transparent border-0">
                            <figure class="card-img-top position-relative mb-7 overflow-hidden">
                                <a href="{{ url('product/' . $product['id'])}}" class="hover-zoom-in d-block"
                                    title="{{ $product['product_name'] }}">
                                    <img src="{{ url('front/images/products/' . $product['product_image']) }}"
                                        data-src="{{ url('front/images/products/' . $product['product_image']) }}"
                                        class="img-fluid lazy-image w-100" alt="{{ $product['product_name'] }}"
                                        width="450" height="600">
                                </a>
                                @if (!empty($product['product_discount']) && $product['product_discount'] > 0)
                                    <div class="position-absolute product-flash z-index-2">
                                        <span class="badge badge-product-flash on-sale bg-primary">
                                            -{{ $product['product_discount'] }}%
                                        </span>
                                    </div>
                                @endif

                            </figure>
                            <div class="card-body text-center p-0">
                                <span
                                    class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
                                    <ins class="text-decoration-none">LKR
                                        {{ number_format($product['final_price'], 2) }}
</ins>&nbsp;&nbsp;&nbsp;
                                    @if ($product['product_discount'] != '')
                                        <del class=" text-body fw-500 me-4 fs-13px">LKR
                                            {{ number_format($product['product_price'], 2) }}
</del>
                                    @endif
                                </span>

                                <h4
                                    class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                                    <a class="text-decoration-none text-reset"
                                        href="shop/product-details-v1.html">{{ $product['product_name'] }}</a>
                                </h4>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
        </section>


        &nbsp;&nbsp;&nbsp;&nbsp;







    </main>
@endsection
