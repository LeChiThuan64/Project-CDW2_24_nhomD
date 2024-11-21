@extends('viewAdmin.navigation')
@section('title', 'Order Manager')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Orders manager</h6>
                    </div>
                </div>
                <div class="row p-3">
                    <!-- Thanh tìm kiếm -->
                </div>
                <div class="Diao">
                    <!-- Nút đi đến trang vocher -->
                    <a href="{{ route('customer.list') }}" class="btn btn-secondary btn-sm px-3 me-2" style="border-radius: 5px; font-size: 14px;">
                        <i class="fas fa-eye"></i> Danh sách khách hàng
                    </a>

                    <!-- Nút đi đến trang giảm giá sản phẩm
                    <a href="{{ url('/giamgia') }}" class="btn btn-success btn-sm px-3" style="border-radius: 5px; font-size: 14px;">
                        <i class="fas fa-eye"></i> SALE Giá Sản Phẩm
                    </a> -->
                    </div>
                <div class="orders_manager">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Mã khách hàng</th>
                                <th>Tên Khách Hàng</th>
                                <th>Số Điện Thoại</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Tổng đơng hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Trạng thái đơn hàng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="orders_manager">
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user_id}}</td>
                                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->street_address }}</td>
                                    <td>{{ number_format($order->total) }} VND
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        @if ($order->status === 'pending')
                                            <button class="btn btn-success btn-orders-confirm"
                                                data-order-id="{{ $order->id }}">Xác nhận đơn hàng</button>
                                            <button class="btn btn-success btn-orders-fail" data-order-id="{{ $order->id }}">Báo
                                                lỗi</button>
                                        @elseif ($order->status === 'on delivery')
                                            <button class="btn btn-success btn-orders-fail" data-order-id="{{ $order->id }}">Báo
                                                lỗi</button>
                                        @elseif ($order->status === 'cancelled')
                                            <button class="btn btn-danger btn-orders-delete"
                                                data-order-id="{{ $order->id }}">Xóa đơn hàng</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Bảng ẩn -->
                    <div id="errorReportFormContainer" class="error-report-form-orders" style="display: none;">
                        <div class="error-report-box">
                            <h4>Báo lỗi đơn hàng</h4>
                            <form id="errorReportForm">
                                <input type="hidden" id="errorOrderId" name="orderId" value="">
                                <div class="form-group check-fail">
                                    <label for="errorType">Nguyên nhân</label><br>
                                    <input type="radio" id="errorType1" name="errorType" value="Thanh toán thất bại">
                                    <label for="errorType1">Thanh toán thất bại</label><br>
                                    <input type="radio" id="errorType2" name="errorType"
                                        value="Địa chỉ giao hàng không chính xác">
                                    <label for="errorType2">Địa chỉ giao hàng không chính xác</label><br>
                                    <input type="radio" id="errorType3" name="errorType" value="Vấn đề về vận chuyển">
                                    <label for="errorType3">Vấn đề về vận chuyển</label>
                                </div>
                                <div class="form-group fail-detail">
                                    <label for="errorDescription">Mô tả nguyên nhân</label>
                                    <textarea id="errorDescription" name="errorDescription" class="form-control"
                                        rows="4"></textarea>
                                </div>
                                <button type="button" id="submitErrorReport" class="btn btn-success mt-3">Gửi báo
                                    lỗi</button>
                                <button type="button" id="closeErrorReportForm"
                                    class="btn btn-secondary mt-3">Đóng</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection