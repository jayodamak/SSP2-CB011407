<?php use App\Models\Product; ?>
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
                            <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <section class="container">
    <div class="shopping-cart">

        
        <section class="container">
            <div class="shopping-cart">
                <h2 class="text-center fs-2 mt-12 mb-13">Shopping Cart</h2>
                <form class="table-responsive-md pb-8 pb-lg-10">
                    @php $total_price = 0 @endphp
                    <table class="table border">
                        <thead class="bg-body-secondary">
                            <tr class="fs-15px letter-spacing-01 fw-semibold text-uppercase text-body-emphasis">
                                <th scope="col" class="fw-semibold border-1 ps-11">Products</th>
                                <th scope="col" class="fw-semibold border-1">Quantity</th>
                                <th colspan="2" class="fw-semibold border-1">Price (LKR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getCartItems as $item)
                            <?php
                            $getAttributePrice = \App\Models\ProductsAttribute::getProductDetailsBySize($item['product_id'], $item['product_size']);
                            ?>
                            <tr class="position-relative">
                                <th scope="row" class="pe-5 ps-8 py-7 shop-product">
                                    <div class="d-flex align-items-center">
                                        {{-- <div class="form-check">
                                            <input class="form-check-input rounded-0" type="checkbox" name="check-product" value="checkbox">
                                        </div> --}}
                                        <div class="ms-6 me-7">
                                            <a href="{{ url('product/' . $item['product']['id']) }}">
                                                <img src="{{ asset('front/images/products/' . $item['product']['product_image']) }}"
                                                    data-src="{{ asset('front/images/products/' . $item['product']['product_image']) }}"
                                                    class="lazy-image" width="75" height="100" alt="Product Image">
                                            </a>
                                        </div>
                                        <div>
                                            <p class="fw-500 mb-1 text-body-emphasis">
                                                <a href="{{ url('product/' . $item['product']['id']) }}">{{ $item['product']['product_name'] }}</a>
                                            </p>
                                            @if (!empty($item['product']['product_discount']) && $item['product']['product_discount'] > 0)
                                                <span class="text-decoration-line-through">LKR {{ $item['product']['product_price'] }}</span>
                                                <span class="fs-18px text-body-emphasis ps-6 fw-bold">LKR {{ $item['product']['final_price'] }}</span>
                                                <span class="badge text-bg-primary fs-6 fw-semibold ms-7 px-6 py-3">{{ $item['product']['product_discount'] }}%</span>
                                            @else
                                                <span id="final-price" class="fs-18px text-body-emphasis fw-bold"> {{ number_format($item['product']['final_price'], 2) }}
                                                </span>
                                            @endif
                                            <p><span>Size: {{ $item['product_size'] }}</span></p>
                                        </div>
                                    </div>
                                </th>
                                <td class="align-middle">
                                    <div class="input-group position-relative shop-quantity">
                                        <a  href="#" class="shop-down position-absolute z-index-2 updateCartItem qtyMinus" data-cartid="{{$item['id']}}" data-qty="{{$item['product_qty']}}"><i class="far fa-minus"></i></a>
                                        <input  id="input-qty-cart-{{$item['id']}}"   name="number[]" type="number" data-qty="{{$item['product_qty']}}" data-unitPrice="{{$item['product']['final_price']}}"
                                            class="form-control form-control-sm px-10 py-4 fs-6 text-center border-0"
                                            value="{{ $item['product_qty'] }}" required readonly>
                                        <a  href="#" class="shop-up position-absolute z-index-2 updateCartItem qtyPlus" data-cartid="{{$item['id']}}" data-qty="{{$item['product_qty']}}"><i class="far fa-plus"></i></a>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0 text-body-emphasis fw-bold product-price" id="finale-price-per-product-{{$item['id']}}">  </p>
                                </td>
                                <td class="align-middle text-end pe-8">
                                    <a href="#" class="d-block text-secondary deleteCartItem" data-cartid="{{$item['id']}}" id="delete-cart-item">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                            @php $total_price += ($item['product']['final_price'] * $item['product_qty']) @endphp
                            @endforeach
                            <tr>
                                <td class="pt-5 pb-10 position-relative bg-body ps-0 left">
                                </td>
                                <td colspan="3" class="text-end pt-5 pb-10 position-relative bg-body right pe-0">
                                    <button type="submit" value="Update Cart" class="btn btn-outline-dark my-5">Update
                                        Cart
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row pt-8 pt-lg-11 pb-16 pb-lg-18 justify-content-end">
                        <div class="col-lg-4 pt-lg-0 pt-11 ms-auto">
                            <div class="card border-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1)">
                                <div class="card-body px-9 pt-6">
                                    @php
                                        $delivery_charge = ($total_price > 10000) ? 0 : 400;
                                        $final_price = $total_price + $delivery_charge;
                                    @endphp
                                    <div class="d-flex align-items-center justify-content-between mb-5">
                                        <span>Subtotal (LKR):</span>
                                        <span class="d-block ml-auto text-body-emphasis fw-bold" id="sub-total"> {{ number_format($total_price, 2) }}</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span>Delivery (LKR):</span>
                                        <span class="d-block ml-auto text-body-emphasis fw-bold" id="delivery-charge">{{ number_format($delivery_charge, 2) }}</span>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent px-0 pt-5 pb-7 mx-9">
                                    <div class="d-flex align-items-center justify-content-between fw-bold mb-7">
                                        <span class="text-secondary text-body-emphasis">Total price:</span>
                                        <span class="d-block ml-auto text-body-emphasis fs-4 fw-bold" id="total-price">LKR {{ number_format($final_price, 2) }}</span>
                                    </div>
                                    <a href="{{ url('checkout') }}"
                                        class="btn w-100 btn-dark btn-hover-bg-primary btn-hover-border-primary"
                                        title="Check Out">Check Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </section>
        
    </div>
</section>

        
    </main>
@endsection
