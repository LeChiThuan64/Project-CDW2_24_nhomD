@extends('viewUser.navigation')
@section('title', 'Checkout')
@section('content')
<meta name="user-id" content="{{ Auth::user()->id }}">
<main>
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Shipping and Checkout</h2>
        <div class="checkout-steps">
            <a href="{{ route('cart.show') }}" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Shopping Bag</span>
                    <em>Manage Your Items List</em>
                </span>
            </a>
            <a href="{{ route('checkout.show') }}" class="checkout-steps__item active">
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
        <form name="checkout-form" id="checkout-form">
            <div class="checkout-form">
                <div class="billing-info__wrapper">
                    <h4>BILLING DETAILS</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" id="checkout_first_name"
                                    placeholder="First Name">
                                <label for="checkout_first_name">First Name</label>
                                <div class="error-message" id="first-name-error" style="color: red;"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" id="checkout_last_name" placeholder="Last Name">
                                <label for="checkout_last_name">Last Name</label>
                                <div class="error-message" id="last-name-error" style="color: red;"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="search-field my-3">
                                <div class="form-label-fixed hover-container">
                                    <label for="search-dropdown" class="form-label">Country / Region*</label>
                                    <div class="js-hover__open">
                                        <input type="text"
                                            class="form-control form-control-lg search-field__actor search-field__arrow-down"
                                            id="search-dropdown" name="search-keyword" readonly
                                            placeholder="Choose a location...">
                                    </div>
                                    <div class="filters-container js-hidden-content mt-2">
                                        <ul class="search-suggestion list-unstyled">
                                            <li class="search-suggestion__item js-search-select">VietNam</li>
                                            <li class="search-suggestion__item js-search-select">Australia</li>
                                            <li class="search-suggestion__item js-search-select">Canada</li>
                                            <li class="search-suggestion__item js-search-select">United Kingdom</li>
                                            <li class="search-suggestion__item js-search-select">United States</li>
                                            <li class="search-suggestion__item js-search-select">Turkey</li>
                                        </ul>
                                    </div>
                                    <input type="hidden" id="selected-country" name="country" value="">
                                    <div class="error-message" id="country-error" style="color: red;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control" id="checkout_street_address"
                                    placeholder="Street Address *">
                                <label for="checkout_company_name">Street Address *</label>
                                <div class="error-message" id="street-address-error" style="color: red;"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" id="checkout_city" placeholder="Town / City *">
                                <label for="checkout_city">Province / City *</label>
                                <div class="error-message" id="city-error" style="color: red;"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" id="checkout_zipcode"
                                    placeholder="Postcode / ZIP *">
                                <label for="checkout_zipcode">Postcode / ZIP *</label>
                                <div class="error-message" id="zipcode-error" style="color: red;"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" id="checkout_phone" placeholder="Phone *">
                                <label for="checkout_phone">Phone *</label>
                                <div class="error-message" id="phone-error" style="color: red;"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                                <input type="email" class="form-control" id="checkout_email" placeholder="Your Mail *">
                                <label for="checkout_email">Your Mail *</label>
                                <div class="error-message" id="email-error" style="color: red;"></div>
                            </div>
                        </div>
                        <!-- Hidden Banking Info Section -->
                        <div class="col-md-12 d-none" id="banking-info-section">
                            <div class="search-field my-3">
                                <div class="form-label-fixed hover-container">
                                    <label for="banking-dropdown" class="form-label">Banking Information *</label>
                                    <div class="js-hover__open">
                                        <select name="banking" id="banking-dropdown"
                                            class="form-control form-control-lg search-field__actor search-field__arrow-down">
                                            <option value="" data-name="Chọn ngân hàng" selected>Chọn ngân hàng</option>
                                            @if($bankAccounts->isNotEmpty())
                                            @foreach($bankAccounts as $account)
                                            <option value="{{ $account->id }}" data-name="{{ $account->bank_name }}"
                                                data-card="{{ substr($account->card_number, -3) }}"
                                                data-holder="{{ $account->card_holder_name }}">
                                                {{ $account->bank_name }} - ***{{ substr($account->card_number, -3) }} -
                                                {{ $account->card_holder_name }}
                                            </option>
                                            @endforeach
                                            @else
                                            <option disabled>Không có tài khoản ngân hàng nào khả dụng.</option>
                                            @endif
                                        </select>
                                    </div>
                                    <input type="hidden" id="selected-banking" name="banking" value="">
                                    <div class="error-message" id="banking-error" style="color: red;"></div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="add-bank-card-btn">Add bank card</button>
                        </div>
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
                                                data-discount="{{ $voucher->discount }}" @if($isNotYetStarted ||
                                                $isExpired) disabled @endif>
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
                    </div>
                    <div class="col-md-12">
                        <div class="mt-3">
                            <textarea class="form-control form-control_gray" placeholder="Order Notes (optional)"
                                cols="30" rows="8"></textarea>
                        </div>
                    </div>
                    <div id="bank-card-table" class="hidden-table fixed-table">
                        <!-- Nút đóng bảng -->
                        <button type="button" id="close-bank-form-btn" class="bank-form-close-btn">✖</button>
                        <h3>Thêm tài khoản ngân hàng</h3>
                        <table>
                            <tbody>
                                <!-- Chọn ngân hàng -->
                                <tr>
                                    <td>Chọn ngân hàng</td>
                                    <td>
                                        <select>
                                            <option value="" selected>Chọn ngân hàng</option>
                                            <option value="vietcombank">Vietcombank</option>
                                            <option value="techcombank">Techcombank</option>
                                            <option value="vietinbank">Vietinbank</option>
                                            <option value="bidv">BIDV</option>
                                            <option value="sacombank">Sacombank</option>
                                            <option value="mbbank">MB Bank</option>
                                        </select>
                                    </td>
                                </tr>
                                <!-- Nhập số thẻ -->
                                <tr>
                                    <td>Số thẻ</td>
                                    <td><input type="text" placeholder="Nhập số thẻ..." maxlength="19"></td>
                                </tr>
                                <!-- Họ & tên chủ thẻ -->
                                <tr>
                                    <td>Họ & tên chủ thẻ</td>
                                    <td><input type="text" placeholder="Nhập họ tên..."></td>
                                </tr>
                                <!-- Ngày phát hành thẻ -->
                                <tr>
                                    <td>Ngày phát hành thẻ</td>
                                    <td><input type="text" placeholder="dd/mm/yyyy"></td>
                                </tr>
                                <!-- Ngày hết hạn thẻ -->
                                <tr>
                                    <td>Ngày hết hạn thẻ</td>
                                    <td><input type="text" placeholder="MM/YY" maxlength="5"></td>
                                </tr>
                                <!-- Mã bảo mật CVV -->
                                <tr>
                                    <td>CVV</td>
                                    <td><input type="text" placeholder="Nhập CVV..." maxlength="3"></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Nút xác nhận -->
                        <button type="button" class="btn btn-secondary" id="add-bank-card-btn">Xác nhận</button>
                    </div>
                </div>
                <div class="checkout__totals-wrapper">
                    <div class="sticky-content">
                        <div class="checkout__totals">
                            <h3>Your Order</h3>
                            <table class="checkout-cart-items">
                                <thead>
                                    <tr>
                                        <th>PRODUCT</th>
                                        <th>SUBTOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $cartItem)
                                    <tr data-cart-item-id="{{ $cartItem['cart_item_id'] }}">
                                        <td>
                                            <a
                                                href="{{ route('product.show', $cartItem['product_id']) }}">{{ $cartItem['name'] }}</a>
                                            x {{ $cartItem['quantity'] }}
                                        </td>
                                        <td>
                                            {{ number_format($cartItem['price'] * $cartItem['quantity']) }} VND
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="checkout-totals">
                                <tbody>
                                    <tr>
                                        <th>SUBTOTAL</th>
                                        <td id="subtotal">{{ number_format($total) }} VND</td>
                                    </tr>
                                    <tr>
                                        <th>SHIPPING</th>
                                        <td>
                                            @foreach($shippingprice as $index => $shipping)
                                            <div class="form-check">
                                                <input class="form-check-input form-check-input_fill" type="radio"
                                                    name="shipping" value="{{ $shipping->price }}"
                                                    id="shipping_{{ $shipping->id }}"
                                                    {{ $index === 0 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="shipping_{{ $shipping->id }}">
                                                    {{ $shipping->name }}: {{ $shipping->price }} VND
                                                </label>
                                            </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>VOUCHER</th>
                                        <td id="voucher-info"></td>
                                    </tr>
                                    <tr>
                                        <th>TOTAL</th>
                                        <td id="total-amount"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="checkout__payment-methods">
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_3" checked>
                                <label class="form-check-label" for="checkout_payment_method_3">
                                    Cash on delivery
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_1">
                                <label class="form-check-label" for="checkout_payment_method_1">
                                    Direct bank transfer
                                </label>
                            </div>
                            <div class="policy-text">
                                Your personal data will be used to process your order, support your experience
                                throughout this website, and for other purposes described in our <a href="terms.html"
                                    target="_blank">privacy policy</a>.
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-checkout">PLACE ORDER</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>
<script>
var userId = {
    {
        Auth::user() - > id
    }
};
</script>