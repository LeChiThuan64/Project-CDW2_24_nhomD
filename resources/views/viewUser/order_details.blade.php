@extends('viewUser.navigation')
@section('title', 'Order Details')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/orders_detail.css') }}" type="text/css">
<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Order Details</h2>
        <div class="row">
            <div class="col-lg-3">
                <ul class="account-nav">
                    <li><a href="account_dashboard.html" class="menu-link menu-link_us-s">Dashboard</a></li>
                    <li><a href="{{ route('order.manager.show') }}"
                            class="menu-link menu-link_us-s menu-link_active">Orders</a></li>
                    <li><a href="account_edit_address.html" class="menu-link menu-link_us-s">Addresses</a></li>
                    <li><a href="account_edit.html" class="menu-link menu-link_us-s">Account Details</a></li>
                    <li><a href="{{ route('wishlist.index') }}" class="menu-link menu-link_us-s">Wishlist</a></li>
                    <li><a href="login_register.html" class="menu-link menu-link_us-s">Logout</a></li>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="order-details-container">
                    @foreach ($order->orderItems as $item)
                        <div class="product-info">
                            <div class="product-image">
                                @if ($item->product->images->isNotEmpty())
                                    <img src="{{ asset('assets/img/products/' . $item->product->images->first()->image_url) }}"
                                        alt="Product Image">
                                @else
                                    <img src="https://via.placeholder.com/100" alt="Product Image">
                                @endif
                            </div>
                            <div class="product-details">
                                <h3>{{ $item->product->name }}</h3>
                                <p><span>Size:</span> {{ $item->size->name }}</p>
                                <p><span>Color:</span> {{ $item->color->name }}</p>
                                <p><span>Số lượng:</span> x{{ $item->quantity }}</p>
                            </div>
                            <div class="product-price">
                                <h4>Giá sản phẩm</h4>
                                <p>{{ number_format($item->price) }} VND</p>
                            </div>
                        </div>
                    @endforeach
                    <table class="customer-info">
                        <tr>
                            <td>Khách hàng</td>
                            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td>
                                <div id="address-display">{{ $order->street_address }}</div>
                                <input type="text" id="address-input" value="{{ $order->street_address }}"
                                    style="display: none;">
                            </td>
                        </tr>
                        <tr>
                            <td>Số điện thoại</td>
                            <td>
                                <div id="phone-display">{{ $order->phone }}</div>
                                <input type="text" id="phone-input" value="{{ $order->phone }}" style="display: none;">
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <div id="email-display">{{ $order->email }}</div>
                                <input type="email" id="email-input" value="{{ $order->email }}" style="display: none;">
                            </td>
                        </tr>
                        <tr>
                            <td>Phương thức thanh toán</td>
                            <td>{{ $order->payment_method }}</td>
                        </tr>
                        <tr>
                            <td>Tổng giá trị</td>
                            <td>{{ number_format($order->total) }} VND</td>
                        </tr>
                    </table>
                    <div class="order-actions">
                        @if ($order->status === 'pending' || $order->status === 'order fails')
                            <button class="btn btn-primary" id="edit-info-btn">Chỉnh sửa thông tin</button>
                            <button class="btn btn-success" id="save-info-btn" style="display: none;">Xác nhận thay
                                đổi</button>
                            <button class="btn btn-secondary" id="cancel-info-btn" style="display: none;">Hủy thay
                                đổi</button>
                        @endif
                        @if ($order->status === 'order fails')
                            <button class="btn btn-warning" id="resend-order-btn" data-order-id="{{ $order->id }}">Gửi lại
                                đơn hàng</button>
                        @endif
                        <a href="{{ route('order.manager.show') }}" class="btn btn-primary" id="back-info-btn">Quay
                            lại</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="{{ asset('js/order_details.js') }}"></script>
@endsection