@extends('viewAdmin.navigation')

@section('title', 'Tables')

@section('content')

@if (session('success'))
    <div class="alert alert-success"  style="background-color: #d4edda; color: #155724;">
        {{ session('success') }}
    </div>
@endif


<html>

<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      box-sizing: border-box;
    }

    .header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .search-container {
      display: flex;
      align-items: center;
      border: 1px solid #000;
      padding: 10px;
      flex-grow: 1;
      margin-right: 10px;
    }

    .search-container input {
      flex-grow: 1;
      border: none;
      outline: none;
      padding: 10px;
      font-size: 16px;
    }

    .search-container i {
      margin-right: 10px;
      font-size: 20px;
    }

    .add-button {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #000;
      padding: 10px;
      cursor: pointer;
      font-size: 20px;
    }

    .blog-list {
      border: 1px solid #000;
      padding: 10px;
    }

    .blog-item {
      display: flex;
      align-items: center;
      border: 1px solid #000;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 10px;
    }

    .blog-item img {
      width: 100px;
      height: 100px;
      border: 1px solid #000;
      margin-right: 10px;
    }

    .blog-item .blog-info {
      flex-grow: 1;
    }

    .blog-item .blog-info p {
      margin: 5px 0;
    }

    .blog-item .blog-actions {
      display: flex;
      align-items: center;
    }

    .blog-item .blog-actions button {
      background: none;
      border: 1px solid #000;
      padding: 5px 10px;
      margin-right: 10px;
      cursor: pointer;
      display: flex;
      align-items: center;
    }

    .blog-item .blog-actions button i {
      margin-right: 5px;
    }

    .blog-item .blog-actions .delete {
      background: none;
      border: none;
      font-size: 20px;
      cursor: pointer;
    }

    /* //hghhhh */
    .pagination-wrapper {
      text-align: center;
      /* Căn giữa các liên kết phân trang */
      padding: 13px;
      /* Thêm padding cho vùng chứa phân trang */
      margin-top: 20px;
      /* Tạo khoảng cách phía trên */
    }

    .pagination {

      padding-left: 0;
      /* Xóa padding trái mặc định */
    }

    .pagination li {
      display: inline;
      /* Hiển thị các mục liên kết trên cùng một dòng */
      padding: 0 10px;
      /* Thêm padding giữa các liên kết */
    }

    .pagination li a {
      color: #333;
      /* Màu sắc cho liên kết, bạn có thể thay đổi theo ý muốn */
      text-decoration: none;
      /* Xóa gạch chân */
      padding: 5px 10px;
      /* Padding cho liên kết để dễ bấm hơn */
      border: 1px solid #ddd;
      /* Viền xung quanh liên kết */
    }
  </style>
</head>

<body>
  <div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
      <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
        <h6 class="text-white text-capitalize ps-3">User table</h6>
      </div>
    </div>
    <div class="row p-3">
      <!-- Thanh tìm kiếm -->
      <div class="col-md-5">
        <form action="{{ route('admin.blog.index') }}" method="GET" class="search-form">
          <div class="input-group">
            <div class="input-group-prepend">
              <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
            <input type="text" name="query" class="form-control" placeholder="Tìm kiếm bài viết theo tên hoặc ID..."
              aria-label="Tìm kiếm bài viết" value="{{ request()->get('query') }}">
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


  <div class="blog-list">
    @foreach($blogs as $blog)
    <div class="blog-item">
      <img alt="Placeholder image for blog" height="100" src="{{ $blog->image_url }}" width="100" />
      <div class="blog-info">
        <p>id : {{ $blog->blog_id }}</p>
        <p>tên : {{ $blog->title }}</p>
        <p> nội dung : {{ $blog->content }}</p>
      </div>
      <div class="blog-actions">
        <!-- Nút sửa -->
        <button class="btn btn-outline-secondary">
          <i class="fas fa-edit"></i> Sửa
        </button>

        <!-- Nút xóa -->
        <form action="{{ route('admin.blog.destroy', $blog->blog_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa blog này không?');" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-outline-danger">
            <i class="fas fa-trash"></i> Xóa
          </button>
        </form>
      </div>

    </div>
    @endforeach
  </div>

  <!-- Pagination -->
  <div class="pagination-wrapper">
    {{ $blogs->links('pagination::bootstrap-4') }} <!-- Sử dụng template bootstrap-4 cho phân trang -->
  </div>

  <script>
    // Đoạn script để ẩn thông báo sau 3 giây (3000ms)
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function() {
            var alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 3000); // 3000ms = 3 giây
    });
</script>
</body>

</html>

@endsection