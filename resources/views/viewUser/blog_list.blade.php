@extends('viewUser.navigation')
@section('title', 'Blogs_')
@section('content')

<head>
  

</head>
<main>
  <section class="blog-page-title mb-4 mb-xl-5">
    <div class="title-bg">
      <img loading="lazy" src="{{ asset('assets/img/images_user/blog_title_bg.jpg') }}" width="1780" height="420" alt="Blog Title">
    </div>
    <div class="container">
      <h2 class="page-title">The Blog</h2>
     
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
          <a href="{{ route('blog.detail', ['blog_id' => $blog->blog_id]) }}">

            <img src="{{ asset($blog->image_url) }}" alt="Blog Image" class="blog-image">
          </a>
        </div>


        <div class="blog-grid__item-detail">
          <div class="blog-grid__item-meta">
            <span class="blog-grid__item-meta__author">By Admin</span>
            <span class="blog-grid__item-meta__date">{{ $blog->created_at->format('F d, Y') }}</span>
            <div class="contact-icon"><i class="fas fa-comments"></i> <span>{{ $blog->comments->count() }} Comments</span></div>
            <span><i class="fas fa-eye"></i> {{ $blog->views }} Views</span>
          </div>
          <div class="blog-grid__item-title">
            <a href="{{ route('blog.detail', ['blog_id' => $blog->blog_id]) }}">{{ $blog->title }}</a>
          </div>
          <div class="blog-grid__item-content">
            <p>{{ Str::limit(strip_tags($blog->content), 100) }}</p>
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