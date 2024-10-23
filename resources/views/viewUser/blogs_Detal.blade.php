@extends('viewUser.navigation')
@section('title', $blog->title)
@section('content')

<HEad>
  <STYle>
    .blog-image {
      max-width: 80%;
      /* Đặt giới hạn kích thước tối đa của hình ảnh */
      margin: 0 auto;
      /* Căn giữa hình ảnh */
      display: block;
      /* Đảm bảo hình ảnh là phần tử khối */
    }

    .mw-930 p {
      font-size: 18px;
      /* Tăng kích thước chữ */

      line-height: 1.6;
      /* Điều chỉnh khoảng cách giữa các dòng để dễ đọc hơn */
    }
    .review-textt{
      font-size: 18px;
      /* Tăng kích thước chữ */

      line-height: 1.6;
    }
  </STYle>
</HEad>
<main>
  <div class="mb-4 pb-4"></div>
  <section class="blog-page blog-single container">
    <div class="mw-930">
      <h2 class="page-title">{{ $blog->title }}</h2>
      <div class="blog-single__item-meta">
        <span class="blog-single__item-meta__author">By Admin</span>
        <span class="blog-single__item-meta__date">{{ $blog->created_at->format('F d, Y') }}</span>
      </div>
    </div>

    <div class="blog-single__item-content">
      <p>
        <img loading="lazy" class="blog-image w-100 h-auto d-block" src="{{ asset($blog->image_url) }}"
          alt="{{ $blog->title }}">
      </p>
      <div class="mw-930">
        <p>{{ $blog->content }}</p>
      </div>
    </div>

    <!-- Hiển thị các bình luận -->
    <div class="blog-single__reviews mw-930">
      <h2 class="blog-single__reviews-title">Comments</h2>

      @if ($comments && count($comments) > 0)
      @foreach ($comments as $comment)
      <div class="blog-single__reviews-item">
        <div class="customer-review">
          <h6>{{ $comment->name }}</h6>
          <div class="review-date">{{ $comment->created_at->format('F d, Y') }}</div>
          <div class="review-textt">
            <p>{{ $comment->comment }}</p>
          </div>
        </div>
      </div>
      @endforeach
      @else
      <p>No comments yet. Be the first to comment!</p>
      @endif


    </div>

    <!-- Form gửi bình luận -->
    <div class="blog-single__review-form">
      <form action="{{ route('blog.comment', $blog->blog_id) }}" method="POST">
        @csrf
        <div class="mb-4">
          <textarea id="form-input-review" class="form-control form-control_gray" name="comment" placeholder="Your Review" cols="30" rows="8" required></textarea>
        </div>
        <div class="form-label-fixed mb-4">
          <label for="form-input-name" class="form-label">Name *</label>
          <input id="form-input-name" class="form-control form-control-md form-control_gray" name="name" required>
        </div>
        <div class="form-label-fixed mb-4">
          <label for="form-input-email" class="form-label">Email address *</label>
          <input id="form-input-email" type="email" class="form-control form-control-md form-control_gray" name="email" required>
        </div>
        <div class="form-action">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </section>
</main>

<div class="mb-5 pb-xl-5"></div>
@endsection