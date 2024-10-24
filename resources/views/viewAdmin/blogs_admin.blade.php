@extends('viewAdmin.navigation')

@section('title', 'Tables')

@section('content')

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
  <div class="header">
    <div class="search-container">
      @csrf
      <form action="{{ route('admin.blog.index') }}" method="GET" class="search-form">
        <input type="text" name="query" placeholder="Tìm kiếm bài viết theo tên hoặc ID..." class="search-input">
        <button type="submit" class="search-button">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>
    <div class="add-button">
      <i class="fas fa-plus"></i>
    </div>
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
        <button>
          <i class="fas fa-edit"></i> Sửa
        </button>
        <button class="delete">
          <i class="fas fa-trash"></i> Xóa
        </button>
      </div>
    </div>
    @endforeach
  </div>

  <!-- Pagination -->
  <div class="pagination-wrapper">
    {{ $blogs->links('pagination::bootstrap-4') }} <!-- Sử dụng template bootstrap-4 cho phân trang -->
  </div>


</body>

</html>

@endsection