@extends('viewUser.navigation')
@section('title', 'Returns Order Manager')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/returns_order_manager.css') }}" type="text/css">
<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Orders</h2>
        <div class="row">
            <div class="col-lg-3">
                <ul class="account-nav">
                    <li><a href="account_dashboard.html" class="menu-link menu-link_us-s">Dashboard</a></li>
                    <li><a href="{{ route('order.manager.show') }}" class="menu-link menu-link_us-s">Orders</a></li>
                    <li><a href="{{ route('returns_order_manager.index') }}"
                            class="menu-link menu-link_us-s menu-link_active">Return
                            Orders</a></li>
                    <li><a href="account_edit_address.html" class="menu-link menu-link_us-s">Addresses</a></li>
                    <li><a href="account_edit.html" class="menu-link menu-link_us-s">Account Details</a></li>
                    <li><a href="{{ route('wishlist.index') }}" class="menu-link menu-link_us-s">Wishlist</a></li>
                    <li><a href="login_register.html" class="menu-link menu-link_us-s">Logout</a></li>
                </ul>
            </div>
            <div class="col-lg-9">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mã đơn hàng</th>
                            <th>Sản phẩm</th>
                            <th>Lý do đổi trả</th>
                            <th>Mô tả chi tiết</th>
                            <th>Ngân hàng</th>
                            <th>Số điện thoại</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($returnsOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->orders_id }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->return_reason }}</td>
                                <td>{{ $order->detailed_description }}</td>
                                <td>
                                    {{ $order->bankAccount->bank_name }} -
                                    ***{{ substr($order->bankAccount->card_number, -3) }} -
                                    {{ $order->bankAccount->card_holder_name }}
                                </td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->status }}</td>
                                <!-- <td><img src="{{ asset('assets/img/returns_order/' . $order->image_1) }}" alt="Image 1"
                                                                                                                                                                                            style="width: 50px;"></td>
                                                                                                                                                                                    <td><img src="{{ asset('assets/img/returns_order/' . $order->image_2) }}" alt="Image 2"
                                                                                                                                                                                            style="width: 50px;"></td> -->
                                <td>
                                    @if ($order->status !== 'Đã xử lý xong' && $order->status !== 'Đã gửi sản phẩm')
                                        <a href="#" class="btn btn-primary btn-view-return" data-id="{{$order->id}}">Xem</a>
                                    @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div id="fixed-table">
        <h3>Thông báo đổi trả</h3>
        <div id="order-details">
            <!-- Nội dung sẽ được thêm vào đây bằng JavaScript -->
        </div>
        <div id="buttons-container">
            <button id="send-btn" class="btn btn-secondary">Đã gửi
                hàng</button>
            <button id="close-table" class="btn btn-secondary">Đóng</button>
        </div>
    </div>
</main>
@endsection