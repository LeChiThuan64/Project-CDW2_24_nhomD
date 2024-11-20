@extends('viewAdmin.navigation')
@section('title', 'Customer List')
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
        <div class="col-md-4">
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
              data-bs-toggle="dropdown" aria-expanded="false">
              Lọc khách hàng
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="?filter=order_quantity">Theo số lượng đơn hàng</a></li>
              <li><a class="dropdown-item" href="?filter=order_value">Theo giá trị đơn hàng</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="customer_list">
        <table>
          <thead>
            <tr>
              <th>Mã khách hàng</th>
              <th>Tên khách hàng</th>
              <th>Số lượng đơn hàng</th>
              <th>Tổng giá trị</th>
              <th>Sản phẩm mua nhiều</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="orders_manager">
            @foreach($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->orders_count }}</td>
          <td>{{ number_format($user->orders_sum_total, 0, ',', '.') }} VND</td>
          <td>product1</td>
          <td class="align-middle text-center">
          <a href="#" class="btn btn-info btn-sm px-3 view-orders" style="border-radius: 5px; font-size: 14px;"
            data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-toggle="tooltip"
            data-original-title="View all orders">
            Xem tất cả đơn hàng
          </a>
          </td>
        </tr>
      @endforeach
          </tbody>
        </table>
        <!-- Bảng ẩn -->
        <div id="order-details-manager" style="display: none;">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Mã đơn hàng</th>
                <th>Số lượng sản phẩm</th>
                <th>Tổng</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Hình thức thanh toán</th>
                <th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1234</td>
                <td>25</td>
                <td>250.000 VND</td>
                <td>01234567890</td>
                <td>thu duc</td>
                <td>payment</td>
                <td>pendding</td>
              </tr>
            </tbody>
          </table>
          <button type="button" id="closeOrderDetailsManager" class="btn btn-secondary mt-3">Xác nhận</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection