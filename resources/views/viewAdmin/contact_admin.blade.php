@extends('viewAdmin.navigation')

@section('title', 'Contact')

@section('content')

@if(session('success'))
    <div id="success-message" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<head>
  <style>
    .avatar-large {
      width: 150px;
      /* Hoặc kích thước bạn muốn */
      height: 150px;
      border-radius: 10px;
      /* Giữ bo góc nếu cần */
    }
  </style>
</head>



<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3">Contact Admin</h6>
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
              <input type="text" name="search" class="form-control" placeholder="Tìm kiếm khách hàng..." aria-label="Tìm kiếm khách hàng" value="#">
            </div>
          </form>
        </div>

        <div class="col-md-2 text-right">
          <a href="#" class="btn btn-outline-primary">
            <i class="fas fa-plus"></i>
          </a>
        </div>

      </div>


      <!-- Nút dấu cộng -->
    </div>

    <div class="card-body px-0 pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ và tên</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> email</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nội Dung</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
            </tr>
          </thead>
          @foreach($messages as $message)
          <tr>
            <td>
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">{{ $message->name }}</h6>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">{{ $message->email }}</h6>
                </div>
              </div>
            </td>
            <td>
              <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm">{{ Str::limit($message->message, 50) }}</h6>
                </div>
              </div>
            </td>
            <td class="actions" style="text-align: center;">
              <button type="button" class="btn btn-warning btn-sm px-3" style="border-radius: 5px; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-eye"></i> Xem
              </button>
              <form action="{{ route('contact.destroy', $message->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm px-3" style="border-radius: 5px; font-size: 14px;" onclick="return confirm('Bạn có chắc chắn muốn xóa tin nhắn này?')">
                  <i class="fas fa-trash"></i> Xóa
                </button>
              </form>
            </td>
          </tr>
          @endforeach

        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->


<!-- Phân trang -->






<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000); // 3000 milliseconds = 3 giây
</script>



@endsection