@extends('viewUser.navigation')
@section('title', $blog->title)
@section('content')

<HEad>
  <STYle>
    .blog-image {
      max-width: 50%;
      /* Đặt kích thước tối đa của hình ảnh (thay đổi tùy ý) */
      height: auto;
      /* Giữ tỷ lệ của hình ảnh */
      margin: 0 auto;
      /* Căn giữa hình ảnh */
      display: block;
      /* Đảm bảo hình ảnh là phần tử khối */
    }

    .mw-930 p {
      font-size: 18px;
      line-height: 1.6;
    }

    .review-textt {
      font-size: 18px;
      line-height: 1.6;
    }

    .blog-content img {
      max-width: 100%;
      /* Đảm bảo ảnh không vượt quá chiều rộng của container */
      height: auto;
      /* Giữ tỉ lệ ảnh để không bị biến dạng */
      display: block;
      /* Giúp ảnh căn chỉnh đẹp hơn */
      margin: 0 auto;
      /* Căn giữa ảnh trong content */
    }
  </STYle>
</HEad>
<main>

  <div class="mb-4 pb-4"></div>

  <section class="blog-page blog-single container" style="font-family: Arial, sans-serif;">
    <div class="mw-930">
      <h2 class="page-title" style="font-family: Arial, sans-serif;">{{ $blog->title }}</h2>
      <div class="blog-single__item-meta">
        <span class="blog-single__item-meta__author">By Admin</span>
        <span class="blog-single__item-meta__date">{{ $blog->created_at->format('F d, Y') }}</span>
      </div>
    </div>

    <div class="blog-single__item-content">
      <p>
        <!-- Sử dụng class blog-image để căn giữa và điều chỉnh kích thước ảnh -->
        <img src="{{ asset($blog->image_url) }}" alt="Blog Image" class="blog-image">
      </p>
      <div class="blog-content mw-930" style="font-family: Arial, sans-serif;">
        <!-- <p>{{ strip_tags($blog->content) }}</p> -->
        {!! $blog->content !!}

      </div>
    </div>

    <!-- Hiển thị các bình luận -->
    <div class="blog-single__reviews mw-930" style="font-family: Arial, sans-serif;">
      <h2 class="blog-single__reviews-title" style="padding-top: 10px;">Comments</h2>

      @if ($comments && count($comments) > 0)
      @php
      $visibleComments = $comments->sortByDesc('created_at')->take(3);
      @endphp
      <!-- Hiển thị 3 bình luận mới nhất -->
      @foreach ($visibleComments as $comment)
      <div class="blog-single__reviews-item">
        <div class="customer-review">
          <h6>Tên : {{ $comment->name }}</h6>
          <div class="review-date">{{ $comment->email }}</div>
          <div class="review-date">{{ $comment->created_at->format('F d, Y') }}</div>
          <div class="review-textt">
            <p class="comment-content" data-full-content="{{ $comment->comment }}">
              nội dung: {{ Str::limit($comment->comment, 50) }}
            </p>
            @if(strlen($comment->comment) > 50)
            <button class="toggle-button" onclick="toggleContent(this)" style="
               background-color: #007bff; 
               color: white; 
               border: none; 
               padding: 8px 12px; 
               font-size: 14px; 
               border-radius: 4px; 
               cursor: pointer; 
               margin-top: 8px; 
               margin-bottom: 30px;
               transition: background-color 0.3s ease;">
              Xem thêm
            </button>
            @endif
          </div>
        </div>
      </div>
      @endforeach

      <!-- Nút "Xem thêm comment" nếu có hơn 3 bình luận -->
      @if ($comments->count() > 3)
      <button id="showMoreButton" onclick="showAllComments()" style="background-color: #28a745; color: white; border: none; padding: 10px 15px; font-size: 16px; border-radius: 5px; cursor: pointer; margin-top: 15px; transition: background-color 0.3s ease;">
        Xem thêm comment
      </button>
      @endif

      <!-- Phần hiển thị toàn bộ comment còn lại, mặc định ẩn -->
      <div id="allComments" style="display: none;">
        @foreach ($comments->sortByDesc('created_at')->skip(3) as $comment)
        <div class="blog-single__reviews-item">
          <div class="customer-review">
            <h6>Tên : {{ $comment->name }}</h6>
            <div class="review-date">{{ $comment->email }}</div>
            <div class="review-date">{{ $comment->created_at->format('F d, Y') }}</div>
            <div class="review-textt">
              <p class="comment-content" data-full-content="{{ $comment->comment }}">
                nội dung: {{ Str::limit($comment->comment, 50) }}
              </p>
              @if(strlen($comment->comment) > 50)
              <button class="toggle-button" onclick="toggleContent(this)" style="
               background-color: #007bff; 
               color: white; 
               border: none; 
               padding: 8px 12px; 
               font-size: 14px; 
               border-radius: 4px; 
               cursor: pointer; 
               margin-top: 8px; 
               margin-bottom: 30px;
               transition: background-color 0.3s ease;">
                Xem thêm
              </button>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @else
      <p>Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
      @endif
    </div>


    <!-- Form gửi bình luận -->
    <div class="blog-single__review-form">
      <form action="{{ route('blog.comment', $blog->blog_id) }}" method="POST">
        @csrf
        <div class="mb-4">
          <textarea id="form-input-review" class="form-control form-control_gray" name="comment" placeholder="Your Review" cols="30" rows="8" required></textarea>

        </div>
        @guest

        <!-- Hiển thị các trường name và email nếu người dùng chưa đăng nhập -->

        <div class="form-label-fixed mb-4">

          <label for="form-input-name" class="form-label">Name *</label>

          <input id="form-input-name" class="form-control form-control-md form-control_gray" name="name" required>

        </div>

        <div class="form-label-fixed mb-4">

          <label for="form-input-email" class="form-label">Email address *</label>

          <input id="form-input-email" type="email" class="form-control form-control-md form-control_gray" name="email" required>

        </div>

        @endguest



        @auth

        <!-- Lấy name và email từ người dùng đã đăng nhập -->

        <input type="hidden" name="name" value="{{ auth()->user()->name }}">

        <input type="hidden" name="email" value="{{ auth()->user()->email }}">

        @endauth



        <div class="form-action">

          <button type="submit" class="btn btn-primary">Submit</button>

        </div>

      </form>

    </div>
  </section>
</main>
<script>
  function toggleContent(button) {
    const contentElement = button.previousElementSibling;
    const fullContent = contentElement.getAttribute('data-full-content');
    const isExpanded = button.textContent === 'Thu gọn';

    if (isExpanded) {
      contentElement.textContent = 'nội dung: ' + fullContent.slice(0, 50) + '...';
      button.textContent = 'Xem thêm';
    } else {
      contentElement.textContent = 'nội dung: ' + fullContent;
      button.textContent = 'Thu gọn';
    }
  }

  function showAllComments() {
    document.getElementById('allComments').style.display = 'block';
    document.getElementById('showMoreButton').style.display = 'none';
  }
</script>
<div class="mb-5 pb-xl-5"></div>
@endsection