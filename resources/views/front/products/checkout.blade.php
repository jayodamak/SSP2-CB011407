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
                            <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <section class="container pb-14 pb-lg-19">
            <div class="text-center">
                <h2 class="mb-6">Check out</h2>
            </div>
            <!-- Order confirmed message -->
            <div id="orderConfirmationMessage" style="display: none;"></div>
            <div class="row">
                <div class="col-lg-4 pb-lg-0 pb-14 order-lg-last">
                    <div class="card border-0 rounded-0 shadow">
                        <div class="card-header px-0 mx-10 bg-transparent py-8">
                            <h4 class="fs-4 mb-8">Order Summary</h4>
                            @php
                                $total_price = 0;
                            @endphp

                            @foreach ($getCartItems as $item)
                                @php
                                    $total_price += $item['product']['final_price'] * $item['product_qty'];
                                @endphp
                                <div class="d-flex w-100 mb-7">
                                    <div class="me-6">
                                        <img src="{{ asset('front/images/products/' . $item['product']['product_image']) }}"
                                            data-src="{{ asset('front/images/products/' . $item['product']['product_image']) }}"
                                            class="lazy-image" width="60" height="80"
                                            alt="Natural Coconut Cleansing Oil">
                                    </div>
                                    <div class="d-flex flex-grow-1">
                                        <div class="pe-6">
                                            <a href="{{ url('product/' . $item['product']['id']) }}"
                                                class>{{ $item['product']['product_name'] }}<span class="text-body">
                                                    x{{ $item['product_qty'] }}</span></a>
                                            <p class="fs-14px text-body-emphasis mb-0 mt-1">Size:
                                                <span class="text-body">{{ $item['product_size'] }}</span>
                                            </p>
                                            <p class="fs-14px text-body-emphasis mb-0 mt-1">Price:
                                                <span class="text-body">LKR {{ $item['product']['final_price'] }}</span>
                                            </p>
                                        </div>
                                        <div class="ms-auto">
                                            <p class="fs-14px text-body-emphasis mb-0 fw-bold">
                                                {{ number_format($item['product']['final_price'] * $item['product_qty'], 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="card-body px-10 py-8">
                            @php
                                $delivery_charge = ($total_price > 10000) ? 0 : 400;
                                $final_price = $total_price + $delivery_charge;
                            @endphp
                            <div class="d-flex align-items-center mb-2">
                                <span>Subtotal:</span>
                                <span class="d-block ms-auto text-body-emphasis fw-bold">LKR
                                    {{ number_format($total_price, 2) }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span>Delivery:</span>
                                <span class="d-block ms-auto text-body-emphasis fw-bold">LKR {{ number_format($delivery_charge, 2) }}</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent py-5 px-0 mx-10">
                            <div class="d-flex align-items-center fw-bold mb-6">
                                <span class="text-body-emphasis p-0">Total price:</span>
                                <span class="d-block ms-auto text-body-emphasis fw-bold">LKR {{ number_format($final_price, 2) }}</span>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="col-lg-8 order-lg-first pe-xl-20 pe-lg-6">
                    <form id="deliveryAddressForm" method="POST" action="/saveOrderDetails/{{$delivery_charge}}/{{$final_price}}"> @csrf
                        <input type="hidden" name="delivery_id">
                        <div class="checkout">
                            <div class="collapse" id="collapsecoupon">
                                <div class="card mw-60 border-0">
                                    <div class="card-body py-10 px-8 my-10 border">
                                        <p class="card-text text-body-emphasis mb-8">
                                            If you have a coupon code, please apply it below.</p>

                                        <div class="input-group position-relative">
                                            <input type="email" class="form-control bg-body rounded-end"
                                                placeholder="Your Email*">
                                            <button type="submit"
                                                class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary">
                                                Apply Coupon
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="fs-4 pt-4 mb-7">Delivery Information</h4>
                            <div class="mb-7">
                                <label class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Name</label>
                                <div class="row">
                                    <div class="col-md-6 mb-md-0 mb-7">
                                        <input type="text" class="form-control" id="order_name"
                                            name="order_name" placeholder="Full Name" required>
                                        <p id="order_name" class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-7">
                                <div class="row">
                                    <div class="col-md-8 mb-md-0 mb-7">
                                        <label for="street-address"
                                            class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">
                                            Address</label>
                                        <input type="text" class="form-control" placeholder="Address"
                                            id="order_address" name="order_address" required>
                                        <p id="order_address" class="text-danger"></p>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="apt"
                                            class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">City</label>
                                        <input type="text" class="form-control" placeholder="City" id="order_city"
                                            name="order_city" required>
                                        <p id="order_city" class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-7">
                                <label class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">info</label>
                                <div class="row">
                                    <div class="col-md-6 mb-md-0 mb-7">
                                        <input type="email" class="form-control" id="order_email"
                                            name="order_email" placeholder="Email" required>
                                        <p id="order_email" class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-7">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" id="order_mobile_1"
                                            name="order_mobile_1" placeholder="Contact number 1" required>
                                        <p id="order_mobile_1" class="text-danger"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" id="order_mobile_2"
                                            name="order_mobile_2" placeholder="Contact number 2" required>
                                        <p id="order_mobile_2" class="text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="mt-6 mb-5 form-check">
                                <input type="checkbox" class="form-check-input rounded-0 me-4" name="customCheck6"
                                    id="customCheck5">
                                <label class="text-body-emphasis" for="customCheck5">
                                    <span class="text-body-emphasis">Billing address is the same as shipping</span>
                                </label>
                            </div> --}}
                        </div>

                        
                        <div class="checkout mb-7">
                            <button type="submit"
                                class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary px-11 mt-md-7 mt-4"
                                id="orderButtonForm">Place
                                Order</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </section>
    </main>


    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
@endsection
