@foreach ($categoryProducts as $product)

    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card card-product grid-2 bg-transparent border-0">
            <figure class="card-img-top position-relative mb-7 overflow-hidden">
                <a href="{{ url('product/' . $product['id']) }}" class="hover-zoom-in d-block" title="Shield Conditioner">
                    <img src="{{ url('front/images/products/' . $product['product_image']) }}"
                        data-src="{{ url('front/images/products/' . $product['product_image']) }}"
                        class="img-fluid lazy-image w-100" alt="Shield Conditioner" width="450" height="600">
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
                        href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Wishlist">
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
                        {{ $product['final_price'] }}</ins>&nbsp;&nbsp;&nbsp;
                    @if ($product['product_discount'] != '')
                        <del class=" text-body fw-500 me-4 fs-13px">LKR
                            {{ $product['product_price'] }}</del>
                    @endif
                </span>

                <h4 class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                    <a class="text-decoration-none text-reset"
                        href="shop/product-details-v1.html">{{ $product['product_name'] }}</a>
                </h4>
                
            </div>
        </div>
    </div>
@endforeach
