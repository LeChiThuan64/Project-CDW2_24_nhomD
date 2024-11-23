@extends('viewAdmin.navigation')
@section('title', 'Returns Order Detail')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/returns_order_detail_admin.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/returns_order_detail_admin.css') }}">
<div class="container my-5" style="padding-left: 250px;">
    <div class="card shadow-lg border-0" style="width: 80%; margin-left: auto;">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0 text-white">Returns Order Detail</h4>
        </div>
        <div class="card-body p-4">
            <div class="returns_order_detail">
                <div class="card-body">
                    <h5>Mã đơn hàng : {{ $returnsOrderDetails->orders_id }}</h5>
                    <p>Sản phẩm: {{ $returnsOrderDetails->product->name }}</p>
                    <p>Tình trạng: {{ $returnsOrderDetails->status_product }}</p>
                    <p>Nguyên nhân: {{ $returnsOrderDetails->return_reason }}</p>
                    <p>Mô tả chi tiết: {{ $returnsOrderDetails->detailed_description }}</p>
                    <p>Hình ảnh 1: <img src="{{ asset('assets/img/returns_order/' . $returnsOrderDetails->image_1) }}"
                            alt="Image 1" style="width: 100px;" class="img-thumbnail"
                            onclick="showImageModal(this.src)"></p>
                    <p>Hình ảnh 2: <img src="{{ asset('assets/img/returns_order/' . $returnsOrderDetails->image_2) }}"
                            alt="Image 2" style="width: 100px;" class="img-thumbnail"
                            onclick="showImageModal(this.src)"></p>
                    <p>Ngân hàng: {{ $returnsOrderDetails->bankAccount->bank_name }} -
                        ***{{ substr($returnsOrderDetails->bankAccount->card_number, -3) }}
                        - {{ $returnsOrderDetails->bankAccount->card_holder_name }}</p>
                    <p>Số điện thoại: {{ $returnsOrderDetails->phone }}</p>
                    <p>Created At: {{ $returnsOrderDetails->created_at->format('d/m/Y') }}</p>
                    <div class="form-group mb-4">
                        <label class="form-label d-block"><strong>Trạng thái đổi trả:</strong></label>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="return_status" value="Chấp nhận trả hàng" id="accepted"
                                class="form-check-input">
                            <label class="form-check-label" for="accepted">Chấp nhận trả hàng</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="return_status" value="Từ chối trả hàng" id="rejected"
                                class="form-check-input">
                            <label class="form-check-label" for="rejected">Từ chối trả hàng</label>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="reason" class="form-label">Lý do:</label>
                        <textarea name="reason" id="reason" class="form-control"
                            placeholder="Nhập lý do chấp nhận hoặc từ chối đổi trả"></textarea>
                    </div>
                </div>
            </div>
            <div class="buttons mt-4">
                <a href="{{ route('returns.orders.index') }}" class="btn btn-secondary btn-back">Quay lại</a>
                @if($returnsOrderDetails->status != 'Đã xong')
                    <a href="#" class="btn btn-secondary btn-Confirm" data-id="{{ $returnsOrderDetails->id }}"
                        data-product-id="{{ $returnsOrderDetails->product_id }}"
                        data-orders-id="{{ $returnsOrderDetails->orders_id }}" onclick="submitReturnForm(this)">Xác
                        nhận</a>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="imageModal" class="modal">
    <span class="close" onclick="closeImageModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>
<script src="{{ asset('js/returns_order_detail_admin.js') }}"></script>
@endsection