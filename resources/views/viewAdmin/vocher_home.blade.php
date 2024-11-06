@extends('viewAdmin.navigation')

@section('title', 'Contact')

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3">Giảm Giá và Vorcher
          </h6>
        </div>
      </div>
      <div class="row p-3">
        <!-- Thanh tìm kiếm -->
      </div>


      <!-- Nút dấu cộng -->
    </div>
    <div class="Diao">
      <!-- Nút đi đến trang vocher -->
      <a href="{{ url('/vocher') }}" class="btn btn-secondary btn-sm px-3 me-2" style="border-radius: 5px; font-size: 14px;">
        <i class="fas fa-eye"></i> Xem Vorcher
      </a>

      <!-- Nút đi đến trang giảm giá sản phẩm -->
      <a href="{{ url('/giamgia') }}" class="btn btn-success btn-sm px-3" style="border-radius: 5px; font-size: 14px;">
        <i class="fas fa-eye"></i> SALE Giá Sản Phẩm
      </a>
    </div>


  </div>
</div>
<!-- Modal -->




<!-- Phân trang -->








@endsection