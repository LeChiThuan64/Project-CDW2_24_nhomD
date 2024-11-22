@extends('viewAdmin.navigation')
@section('title', 'Order Manager')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Returns Orders manager</h6>
                </div>
            </div>
            <div class="row p-3">
                <!-- Thanh tìm kiếm -->
            </div>
            <div class="Diao">
                <!-- Nút đi đến trang vocher -->
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm px-3 me-2"
                    style="border-radius: 5px; font-size: 14px;">
                    <i class="fas fa-eye"></i> Quay lại
                </a>
            </div>
        </div>
        <div class="returns_order_manager">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mã khách hàng</th>
                        <th>Mã đơn hàng</th>
                        <th>Sản phẩm</th>
                        <th>Lý do đổi trả</th>
                        <th>Mô tả chi tiết</th>
                        <th>Ngày đổi trả</th>
                        <th>Số điện thoại</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($returnsOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user_id }}</td>
                            <td>{{ $order->orders_id }}</td>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->return_reason }}</td>
                            <td>{{ $order->detailed_description }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                @if ($order->status === 'Đã gửi sản phẩm')
                                    <a href="#" class="btn btn-primary btn-received" data-id="{{ $order->orders_id }}">Đã nhận
                                        sản phẩm</a>
                                @elseif ($order->status !== 'Đã xử lý xong')
                                    <a href="#" class="btn btn-primary btn-view-detail" data-id="{{ $order->id }}">Xem</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection