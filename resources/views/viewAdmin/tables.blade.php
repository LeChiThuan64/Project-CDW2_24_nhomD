@extends('viewAdmin.navigation')

@section('title', 'Tables')

@section('content')

@if(session('success'))
<div id="success-message" class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@if(session('error'))
<div id="error-message" class="alert alert-danger">
  {{ session('error') }}
</div>
@endif




<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3">User table</h6>
        </div>
      </div>
      <div class="row p-3">
        <!-- Thanh tìm kiếm -->
        <div class="col-md-5">
          <form action="{{ url('/tables') }}" method="GET">
            <div class="input-group">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
              <input type="text" name="search" class="form-control" placeholder="Tìm kiếm khách hàng..." aria-label="Tìm kiếm khách hàng" value="{{ request()->get('search') }}">
            </div>
          </form>
        </div>

        <div class="col-md-2 text-right">
          <a href="{{ route('user.create') }}" class="btn btn-outline-primary">
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
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ và tên</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
            </tr>
          </thead>
          <tbody id="user-data">
            @foreach($users as $user)
            <tr>
              <td class="align-middle text-center">
                <span class="text-secondary text-xs font-weight-bold">{{ $user->user_id }}</span>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                  </div>
                </div>
              </td>
              <td class="align-middle text-center text-sm">
                @if($user->role == 0)
                <span class="badge badge-sm bg-gradient-primary">Admin</span>
                @else
                <span class="badge badge-sm bg-gradient-success">User</span>
                @endif
              </td>
              <td class="actions">
                <form action="{{ route('user.destroy', $user->user_id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm px-3" style="border-radius: 5px; font-size: 14px;" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                    <i class="fas fa-trash"></i> Xóa
                  </button>
                </form>

                <i class="fas fa-edit">
              </td>



            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Phân trang -->
<<div class="d-flex justify-content-center mt-4" id="pagination">

  <ul class="pagination">
    {{-- Lặp qua tất cả các trang --}}
    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
    @if ($page == $users->currentPage())
    <li class="page-item active">
      <span class="page-link">{{ $page }}</span>
    </li>
    @else
    <li class="page-item">
      <a class="page-link" href="{{ $url }}">{{ $page }}</a>
    </li>
    @endif
    @endforeach
  </ul>
  </div>



  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // hiển thông báo 3s
    setTimeout(function() {
      var successMessage = document.getElementById('success-message');
      if (successMessage) {
        successMessage.style.display = 'none';
      }

      var errorMessage = document.getElementById('error-message');
      if (errorMessage) {
        errorMessage.style.display = 'none';
      }
    }, 3000); // 3000 milliseconds = 3 giây


    $(document).on('click', '.pagination a', function(event) {
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      fetch_data(page);
    });

    function fetch_data(page) {
      $.ajax({
        url: "/tables?page=" + page,
        success: function(data) {
          $('#user-data').html($(data).find('#user-data').html());
          $('#pagination').html($(data).find('#pagination').html());
        },
        error: function(xhr) {
          console.log(xhr.responseText); // Hiển thị lỗi nếu có
        }
      });
    }
  </script>


  @endsection