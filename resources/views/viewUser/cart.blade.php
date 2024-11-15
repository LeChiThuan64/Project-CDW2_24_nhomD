@extends('viewUser.navigation')
@section('title', 'Cart')
@section('content')

<head>
    <style>
    .cart-table-footer {
        margin-top: 15px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .cart-table-footer h4 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #333;
        font-weight: bold;
    }

    .voucher-select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        background-color: #fff;
        color: #333;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: border-color 0.2s ease-in-out;
    }

    .voucher-select:focus {
        border-color: #007bff;
        outline: none;
    }

    #update-cart {
        display: inline-block;
        margin-top: 15px;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        background-color: #333;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-transform: uppercase;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    #update-cart:hover {
        background-color: #555;
    }
    </style>

</head>
<main>
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Cart</h2>
        <div class="checkout-steps">
            <a href="{{ route('cart.show') }}" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Shopping Bag</span>
                    <em>Manage Your Items List</em>
                </span>
            </a>
            <a href="{{ route('checkout.show')}}" class="checkout-steps__item">
                <span class="checkout-steps__item-number">02</span>
                <span class="checkout-steps__item-title">
                    <span>Shipping and Checkout</span>
                    <em>Checkout Your Items List</em>
                </span>
            </a>
            <a href="#" class="checkout-steps__item">
                <span class="checkout-steps__item-number">03</span>
                <span class="checkout-steps__item-title">
                    <span>Confirmation</span>
                    <em>Review And Submit Your Order</em>
                </span>
            </a>
        </div>
        <div class="shopping-cart">
            <div class="cart-table__wrapper">
                @if (Auth::check())
                <form method="POST" action="{{ route('cart.update') }}" id="update-cart-form">
                    @csrf
                    @method('PUT')
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th></th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $cartItem)
                            <tr class="cart-item" data-cart-item-id="{{ $cartItem['cart_item_id'] }}">
                                <td>
                                    <div class="shopping-cart__product-item">
                                        <a href="{{ route('product.show', $cartItem['product_id']) }}">
                                            <img loading="lazy"
                                                src="{{ asset('assets/img/products/' . $cartItem['images'][0]) }}"
                                                width="120" height="120" alt="">
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="shopping-cart__product-item__detail">
                                        <h4><a
                                                href="{{ route('product.show', $cartItem['product_id']) }}">{{ $cartItem['name'] }}</a>
                                        </h4>
                                        <ul class="shopping-cart__product-item__options">
                                            <li>Color: {{ $cartItem['color'] }}</li>
                                            <li>Size: {{ $cartItem['size'] }}</li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <span class="shopping-cart__product-price">{{ $cartItem['price'] }} VND</span>
                                </td>
                                <td>
                                    <div class="qty-control position-relative">
                                        <input type="number" name="quantity[{{ $cartItem['cart_item_id'] }}]"
                                            value="{{ $cartItem['quantity'] }}" min="1"
                                            class="qty-control__number text-center"
                                            data-id="{{ $cartItem['cart_item_id'] }}">

                                        <div class="qty-control__reduce">-</div>
                                        <div class="qty-control__increase">+</div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="shopping-cart__subtotal">{{ $cartItem['quantity'] * $cartItem['price'] }}
                                        VND</span>
                                </td>
                                <td>
                                    <a href="#" class="remove-cart" data-id="{{ $cartItem['cart_item_id'] }}">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                            <path
                                                d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div class="col-md-12">
                        <div class="search-field my-3">
                            <div class="form-label-fixed hover-container">
                                <label for="voucher-select" class="form-label">Voucher</label>
                                <div class="js-hover__open">
                                    <select name="voucher" id="voucher-select"
                                        class="form-control form-control-lg search-field__actor search-field__arrow-down voucher-select">
                                        <option value="" data-name="Không dùng voucher" selected>Không dùng voucher
                                        </option>
                                        @if($vouchers->isNotEmpty())
                                        @foreach($vouchers as $voucher)
                                        @php
                                        $now = \Carbon\Carbon::now();
                                        $isNotYetStarted = $now->lt(\Carbon\Carbon::parse($voucher->start_date));
                                        $isExpired = $now->gt(\Carbon\Carbon::parse($voucher->end_date));
                                        @endphp
                                        <option value="{{ $voucher->id }}" data-name="{{ $voucher->name }}"
                                            data-discount="{{ $voucher->discount }}" @if($isNotYetStarted || $isExpired)
                                            disabled @endif>
                                            {{ $voucher->name }} - Giảm {{ $voucher->discount }}%
                                            (Hiệu lực từ {{ $voucher->start_date }} đến {{ $voucher->end_date }})
                                            -
                                            @if($isNotYetStarted)
                                            Chưa bắt đầu
                                            @elseif($isExpired)
                                            Đã hết hạn
                                            @else
                                            Còn hiệu lực
                                            @endif
                                        </option>
                                        @endforeach
                                        @else
                                        <option disabled>Không có voucher nào khả dụng.</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div><button type="submit" id="update-cart" class="btn btn-dark">UPDATE CART</button></div>
                </form>
                @else
                <p>Bạn cần đăng nhập để sử dụng giỏ hàng.</p>
                <a class="btn btn-primary btn-addtocart" href="{{ route('auth') }}">Login</a>
                @endif

            </div>

            <div class="shopping-cart__totals-wrapper">
                <div class="sticky-content">
                    <div class="shopping-cart__totals">
                        <h3>Cart Totals</h3>
                        <table class="cart-totals">
                            <tbody>
                                <tr>
                                    <th>Subtotal</th>
                                    <td id="subtotal">{{ $total }} VND</td>
                                </tr>

                                <tr>
                                    <th>Voucher</th>
                                    <td id="voucher-info"></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td id="total"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mobile_fixed-btn_wrapper">
                        <div class="button-wrapper container">
                            <button class="btn btn-primary btn-checkout-cart"
                                data-url="{{ route('checkout.show') }}">PROCEED TO CHECKOUT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="mb-5 pb-xl-5"></div>
<div class="mb-5 pb-xl-5"></div>