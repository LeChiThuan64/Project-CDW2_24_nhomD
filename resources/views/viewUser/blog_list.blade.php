@extends('viewUser.navigation')
@section('title', 'Blogs_')
@section('content')

<head>
  <style>
    .btn-simple {
      padding: 10px 20px;
      color: #6A0DAD;
      /* Màu tím nhạt */
      border: 1px solid #6A0DAD;
      /* Viền màu tím nhạt */
      border-radius: 5px;
      /* Góc bo nhẹ */
      background-color: transparent;
      /* Nền trong suốt */
      text-decoration: none;
      /* Xóa gạch chân */
      font-size: 16px;
      transition: background-color 0.2s ease, color 0.2s ease;
      /* Hiệu ứng mượt */
    }

    .btn-simple:hover {
      background-color: #6A0DAD;
      /* Nền tím nhạt khi hover */
      color: white;
      /* Màu chữ chuyển sang trắng khi hover */
    }

    .pagination-wrapper nav ul {
      display: flex;
      list-style: none;
      justify-content: center;
      padding: 0;
    }

    /* phân trang */
    .pagination-wrapper nav ul li {
      margin: 0 5px;
    }

    .pagination-wrapper nav ul li a,
    .pagination-wrapper nav ul li span {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 1px solid #ddd;
      color: blue;
      font-size: 16px;
      text-decoration: none;
    }

    .pagination-wrapper nav ul li.active span {
      background-color: red;
      color: white;
      border-color: red;
    }

    .pagination-wrapper nav ul li a:hover {
      background-color: lightgray;
    }

    .pagination-wrapper nav ul li.disabled span {
      color: #ccc;
    }

    /* tim */
    .search-form {
      display: flex;
      align-items: center;
      border: 2px solid #007bff;
      /* Màu viền */
      padding: 5px 10px;
      border-radius: 25px;
      /* Bo góc */
      background-color: white;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      /* Bóng đổ nhẹ */
    }

    .search-input {
      flex: 1;
      border: none;
      outline: none;
      padding: 8px 10px;
      font-size: 16px;
      /* Kích thước font */
      border-radius: 25px 0 0 25px;
      /* Bo góc trái */
      transition: all 0.3s;
      /* Hiệu ứng chuyển đổi mượt */
    }

    .search-button {
      padding: 8px 15px;
      border: none;
      background-color: #007bff;
      /* Màu nền nút */
      color: white;
      /* Màu chữ */
      cursor: pointer;
      border-radius: 0 25px 25px 0;
      /* Bo góc phải */
      transition: background-color 0.3s;
      /* Hiệu ứng chuyển màu */
    }

    .search-input:focus {
      box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
      /* Bóng đổ khi focus */
    }

    .search-button:hover {
      background-color: #0056b3;
      /* Màu khi hover */
    }
  </style>


</head>
<main>
  <section class="blog-page-title mb-4 mb-xl-5">
    <div class="title-bg">
      <img loading="lazy" src="{{ asset('images_user/blog_title_bg.jpg') }}" width="1780" height="420" alt="Blog Title">
    </div>
    <div class="container">
      <h2 class="page-title">The Blog</h2>
      <div class="blog__filter">
        <a href="#" class="menu-link menu-link_us-s">ALL</a>
        <a href="#" class="menu-link menu-link_us-s">COMPANY</a>
        <a href="#" class="menu-link menu-link_us-s menu-link_active">FASHION</a>
        <a href="#" class="menu-link menu-link_us-s">STYLE</a>
        <a href="#" class="menu-link menu-link_us-s">TRENDS</a>
        <a href="#" class="menu-link menu-link_us-s">BEAUTY</a>
      </div>
    </div>
  </section>

  <section class="blog-page container">
    <h2 class="d-none">The Blog</h2>

    <div class="timkiem py-5">
    @csrf

      <form action="{{ route('blog.index') }}" method="GET" class="search-form">
        <input type="text" name="query" placeholder="Tìm kiếm bài viết theo tên hoặc ID..." class="search-input">
        <button type="submit" class="search-button">
          <i class="fas fa-search"></i>
        </button>
      </form>


    </div>

    <div class="blog-grid row row-cols-1 row-cols-md-2 row-cols-xl-3">

      @foreach ($blogs as $blog)
      <div class="blog-grid__item">
        <div class="blog-grid__item-image">
          <img loading="lazy" class="h-auto" src="{{ asset($blog->image_url) }}" style="width: 100%; height: 350px; object-fit: cover;" alt="{{ $blog->title }}">
        </div>


        <div class="blog-grid__item-detail">
          <div class="blog-grid__item-meta">
            <span class="blog-grid__item-meta__author">By Admin</span>
            <span class="blog-grid__item-meta__date">{{ $blog->created_at->format('F d, Y') }}</span>
          </div>
          <div class="blog-grid__item-title">
            <a href="blog_single.html">{{ $blog->title }}</a>
          </div>
          <div class="blog-grid__item-content">
            <p>{{ Str::limit($blog->content, 100) }}</p>
            <a href="{{ route('blog.detail', ['blog_id' => $blog->blog_id]) }}" class="btn-simple">Continue Reading</a>





          </div>
        </div>
      </div>
      @endforeach

    </div>

    <!-- Hiển thị nút phân trang -->
    <div class="pagination-wrapper">
      {{ $blogs->links('pagination::bootstrap-4') }} <!-- Laravel pagination links -->
    </div>


  </section>
</main>

<div class="mb-5 pb-xl-5"></div>

@endsection