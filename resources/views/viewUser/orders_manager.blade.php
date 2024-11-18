@extends('viewUser.navigation')
@section('title', 'Order Manager')
@section('content')
<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Orders</h2>
        <div class="row">
            <div class="col-lg-3">
                <ul class="account-nav">
                    <li><a href="account_dashboard.html" class="menu-link menu-link_us-s">Dashboard</a></li>
                    <li><a href="account_orders.html" class="menu-link menu-link_us-s menu-link_active">Orders</a></li>
                    <li><a href="account_edit_address.html" class="menu-link menu-link_us-s">Addresses</a></li>
                    <li><a href="account_edit.html" class="menu-link menu-link_us-s">Account Details</a></li>
                    <li><a href="{{ route('wishlist.index') }}" class="menu-link menu-link_us-s">Wishlist</a></li>
                    <li><a href="login_register.html" class="menu-link menu-link_us-s">Logout</a></li>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="page-content my-account__orders-list">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('F j, Y') }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ number_format($order->total) }} VND
                                    </td>
                                    <td class="button-actions">
                                        @if ($order->status !== 'cancelled')
                                            <a href="{{ route('orders.detail', $order->id) }}"
                                                class="btn btn-primary btn-view">XEM ĐƠN HÀNG</a>
                                            @if ($order->status === 'on delivery')
                                                <button class="btn btn-success btn-received" data-order-id="{{ $order->id }}">Đã
                                                    nhận hàng</button>
                                            @elseif ($order->status === 'delivered')
                                                <button class="btn btn-info">Đổi trả hàng</button>
                                            @elseif ($order->status === 'order fails')
                                                <button class="btn btn-warning btn-error-detail"
                                                    data-order-id="{{ $order->id }}">Chi tiết lỗi</button>
                                            @else
                                                <button class="btn btn-danger btn-cancel" data-order-id="{{ $order->id }}">HỦY ĐƠN
                                                    HÀNG</button>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="receivedOrderFormContainer" class="received-order-form" style="display: none;">
                    <div class="received-order-box">
                        <h4>Xác nhận đã nhận hàng</h4>
                        <form id="receivedOrderForm">
                            <input type="hidden" id="receivedOrderId" name="orderId" value="">
                            <p>Bạn có chắc chắn đã nhận hàng?</p>
                            <button type="button" id="confirmReceived" class="btn btn-success mt-3">Xác nhận</button>
                            <button type="button" id="closeReceivedForm" class="btn btn-secondary mt-3">Đóng</button>
                        </form>
                    </div>
                </div>
                <!-- Bảng ẩn -->
                <div id="errorDetailTable" style="display: none;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Nguyên nhân</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="errorOrderId"></td>
                                <td id="errorType"></td>
                                <td id="errorDescription"></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" id="closeErrorDetailTable" class="btn btn-secondary mt-3">Xác nhận</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Form Hủy Đơn Hàng -->
    <div id="cancelOrderFormContainer" class="cancel-order-form" style="display: none;">
        <div class="cancel-order-box">
            <h4>Lý do hủy đơn hàng</h4>
            <form id="cancelOrderForm">
                <input type="hidden" id="orderId" name="orderId" value="">
                <div>
                    <input type="radio" id="reason1" name="cancelReason" value="Thay đổi ý định mua" required>
                    <label for="reason1">Thay đổi ý định mua</label>
                </div>
                <div>
                    <input type="radio" id="reason2" name="cancelReason" value="Mua nhầm sản phẩm" required>
                    <label for="reason2">Mua nhầm sản phẩm</label>
                </div>
                <div>
                    <input type="radio" id="reason3" name="cancelReason" value="Khác" required>
                    <label for="reason3">Khác</label>
                </div>
                <div id="otherReasonContainer" style="display: none;">
                    <textarea id="otherReason" name="otherReason" rows="4" class="form-control mt-2"
                        placeholder="Nhập lý do khác"></textarea>
                </div>
                <button type="button" id="confirmCancel" class="btn btn-danger mt-3">Xác nhận hủy</button>
                <button type=" button" id="closeForm" class="btn btn-secondary mt-3">Đóng</button>
            </form>
        </div>
    </div>
</main>
@endsection