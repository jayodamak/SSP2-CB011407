<?php use App\Models\ProductsFilter; ?>

<div class="position-sticky top-0">
    <aside class="primary-sidebar pe-xl-9 me-xl-2 mt-12 pt-2 mt-lg-0 pt-lg-0">
        {{-- <div class="widget widget-product-category">
            <h4 class="widget-title fs-5 mb-6">Category</h4>
            <ul class="navbar-nav navbar-nav-cate" id="widget_product_category">
                <li class="nav-item">
                    <a href="#" title="Body Care"
                        class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center text-uppercase fs-14px fw-semibold letter-spacing-5"><span
                            class="text-hover-underline">Body Care</span></a>
                </li>
                <li class="nav-item">
                    <a href="#" title="Skin care"
                        class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center text-uppercase fs-14px fw-semibold letter-spacing-5 active">
                        <span class="text-hover-underline me-2">Skin care </span>
                        <span data-bs-toggle="collapse" data-bs-target="#cat_skin-care"
                            class="caret flex-grow-1 d-flex align-items-center justify-content-end collapsed"><svg
                                class="icon">
                                <use xlink:href="#icon-plus"></use>
                            </svg></span> </a>
                    <div id="cat_skin-care" class="collapse show" data-bs-parent="#widget_product_category">
                        <ul class="navbar-nav nav-submenu ps-8">
                            <li class="nav-item">
                                <a class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                    href="#"><span class="text-hover-underline">Cleanser</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                    href="#"><span class="text-hover-underline">Toner</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                    href="#"><span class="text-hover-underline">Scrubs &amp;
                                        Masks</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                    href="#"><span class="text-hover-underline">Serum</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                    href="#"><span class="text-hover-underline">Face
                                        Oils</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                    href="#"><span class="text-hover-underline">Moisturizer</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                    href="#"><span class="text-hover-underline">Eye
                                        Cream</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#" title="Hair Care"
                        class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center text-uppercase fs-14px fw-semibold letter-spacing-5"><span
                            class="text-hover-underline">Hair Care</span></a>
                </li>
                <li class="nav-item">
                    <a href="#" title="Accessories"
                        class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center text-uppercase fs-14px fw-semibold letter-spacing-5"><span
                            class="text-hover-underline">Accessories</span></a>
                </li>
            </ul>
        </div> --}}
        {{-- <div class="widget widget-product-hightlight">
            <h4 class="widget-title fs-5 mb-6">Hightlight</h4>
            <ul class="navbar-nav navbar-nav-cate" id="widget_product_hightlight">
                <li class="nav-item">
                    <a href="#" title="Best Seller"
                        class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                            class="text-hover-underline">Best Seller</span></a>
                </li>
                <li class="nav-item">
                    <a href="#" title="New Arrivals"
                        class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                            class="text-hover-underline">New Arrivals</span></a>
                </li>
                <li class="nav-item">
                    <a href="#" title="Sale"
                        class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                            class="text-hover-underline">Sale</span></a>
                </li>
                <li class="nav-item">
                    <a href="#" title="Hot Items"
                        class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                            class="text-hover-underline">Hot Items</span></a>
                </li>
            </ul>
        </div>
        <div class="widget widget-product-price">
            <h4 class="widget-title fs-5 mb-6">Price</h4>
            <ul class="navbar-nav navbar-nav-cate" id="widget_product_price">
                <li class="nav-item">
                    <a href="#" title="All"
                        class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                            class="text-hover-underline">All</span></a>
                </li>
                <li class="nav-item">
                    <a href="#" title="$10 - $50"
                        class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                            class="text-hover-underline">$10 - $50</span></a>
                </li>
                <li class="nav-item">
                    <a href="#" title="$50 - $100"
                        class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                            class="text-hover-underline">$50 - $100</span></a>
                </li>
                <li class="nav-item">
                    <a href="#" title="$100 - $200"
                        class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                            class="text-hover-underline">$100 - $200</span></a>
                </li>
            </ul>
        </div> --}}


        {{-- <div class="widget widget-product-size">
            <h4 class="widget-title fs-5 mb-6">Sizes</h4>
            <ul class="navbar-nav navbar-nav-cate" id="widget_product_size">
                <input type="hidden" name="size" id="sizeInput" value="{{ request('size') }}">

                    
               ----------------------- php $getSizes = ProductsFilter::getSizes($categoryDetails['catIds']); 
                    @foreach ($getSizes as $key => $size)
                        <li class="nav-item">
                            <a href="#" title="{{ $size }}"
                                class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                id="size{{ $key }}" onclick="setSizeFilter('{{ $size }}')">
                                <span class="text-hover-underline">{{ $size }}</span>
                            </a>
                        </li>
                    @endforeach
                </form>
            </ul>
        </div> --}}



        <div class="widget widget-product_colors">
            <h4 class="widget-title fs-5 mb-6">Colors</h4>
            <ul class="navbar-nav navbar-nav-cate" id="widget_product_colors">
                <form id="filterForm" method="get" action="{{ url($url) }}">
                    {{-- @csrf --}}
                    <input type="hidden" name="color" id="colorInput" value="{{ request('color') }}">

                    <?php $getColors = ProductsFilter::getColors($categoryDetails['catIds']); ?>
                    @foreach ($getColors as $key => $color)
                        <li class="nav-item">
                            <a href="#" title="{{ $color }}"
                                class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                id="color{{ $key }}" onclick="setColorFilter('{{ $color }}')">
                                <span class="square rounded-circle me-4"
                                    style="background-color: {{ $color }}"></span>
                                <span class="text-hover-underline">{{ $color }}</span>
                            </a>
                        </li>
                    @endforeach
                </form>
            </ul>
        </div>



        {{-- <div class="widget widget-tags">
            <h4 class="widget-title fs-5 mb-6">Tags</h4>
            <ul class="w-100 mt-n4 list-unstyled d-flex flex-wrap mb-0">
                <li class="me-6 mt-4">
                    <a href="#" title="Cleansing"
                        class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Cleansing</a>
                </li>
                <li class="me-6 mt-4">
                    <a href="#" title="Make up"
                        class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Make
                        up</a>
                </li>
                <li class="me-6 mt-4">
                    <a href="#" title="eye cream"
                        class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">eye
                        cream</a>
                </li>
                <li class="me-6 mt-4">
                    <a href="#" title="nail"
                        class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">nail</a>
                </li>
                <li class="me-6 mt-4">
                    <a href="#" title="shampoo"
                        class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">shampoo</a>
                </li>
                <li class="me-6 mt-4">
                    <a href="#" title="coffee bean"
                        class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">coffee
                        bean</a>
                </li>
                <li class="me-6 mt-4">
                    <a href="#" title="healthy"
                        class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">healthy</a>
                </li>
                <li class="me-6 mt-4">
                    <a href="#" title="skin care"
                        class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">skin
                        care</a>
                </li>
                <li class="me-6 mt-4">
                    <a href="#" title="sale"
                        class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">sale</a>
                </li>
                <li class="me-6 mt-4">
                    <a href="#" title="Cosmetics"
                        class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Cosmetics</a>
                </li>
                <li class="me-6 mt-4">
                    <a href="#" title="Natural cleansers"
                        class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Natural
                        cleansers</a>
                </li>
                <li class="me-6 mt-4">
                    <a href="#" title="Organic"
                        class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Organic</a>
                </li>
            </ul>
        </div> --}}
    </aside>
</div>
