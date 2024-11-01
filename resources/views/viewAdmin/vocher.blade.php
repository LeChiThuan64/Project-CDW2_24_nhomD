@extends('viewAdmin.navigation')

@section('title', 'Voucher')

@section('content')
<div class="container">
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
</div>
<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3">Voucher</h6>
        </div>
      </div>
      <div class="row p-3">
        <!-- Thanh tìm kiếm -->
        <div class="col-md-5">
          <form action="#" method="GET">
            <div class="input-group">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
              <input type="text" name="search" class="form-control" placeholder="Tìm kiếm khách hàng..." aria-label="Tìm kiếm khách hàng">
            </div>
          </form>
        </div>
        <div class="col-md-2 text-right">
          <a href="{{ route('vocher.create') }}" class="btn btn-outline-primary">
            <i class="fas fa-plus"></i> Tạo Voucher
          </a>
        </div>
      </div>
    </div>

    <div class="card-body px-0 pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên voucher</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mô tả</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giảm giá</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày bắt đầu</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày kết thúc</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Áp dụng cho</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($vochers as $vocher)
            <tr>
              <td>
                <h6 class="mb-0 text-sm">{{ $vocher->name }}</h6>
              </td>
              <td>
                <h6 class="mb-0 text-sm">{{ Str::limit($vocher->description, 25) }}</h6>
              </td>

              <td class="text-center">
                <h6 class="mb-0 text-sm">{{ $vocher->discount }}%</h6>
              </td>
              <td>
                <h6 class="mb-0 text-sm">{{ \Carbon\Carbon::parse($vocher->start_date)->format('d/m/Y') }}</h6>
              </td>
              <td>
                <h6 class="mb-0 text-sm">{{ \Carbon\Carbon::parse($vocher->end_date)->format('d/m/Y') }}</h6>
              </td>

              <td>
                <h6 class="mb-0 text-sm">
                  {{ $vocher->is_global ? 'Tất cả người dùng' : ($vocher->user->name ?? 'N/A') }}
                </h6>
              </td>
              <td class="actions text-center">
                <button type="button" class="btn btn-warning btn-sm px-3" style="border-radius: 5px; font-size: 14px;">
                  <i class="fas fa-eye"></i> Xem
                </button>
                <form action="{{ route('vocher.destroy', $vocher->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa voucher này?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm px-3" style="border-radius: 5px; font-size: 14px;">
                    <i class="fas fa-trash"></i> Xóa
                  </button>
                </form>

                <a href="{{ route('vocher.edit', $vocher->id) }}" class="btn btn-info btn-sm px-3" style="border-radius: 5px; font-size: 14px;">
                  <i class="fas fa-edit"></i> Sửa
                </a>


              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  // Tự động ẩn thông báo sau 3 giây
  setTimeout(function() {
    let alert = document.getElementById('success-alert');
    if (alert) {
      alert.classList.remove('show');
    }
  }, 3000); // 3 giây
</script>
@endsection