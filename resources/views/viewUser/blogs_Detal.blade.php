@extends('viewUser.navigation')
@section('title', $blog->title)
@section('content')
<head>
<style>
    .blog-image {
        max-width: 800px;  /* Giới hạn chiều rộng tối đa */
        height: auto;  /* Để hình ảnh tự động thay đổi theo chiều rộng */
        margin: 0 auto;  /* Căn giữa hình ảnh */
        display: block;  /* Đảm bảo ảnh được hiển thị dưới dạng block để căn giữa */
        object-fit: cover;  /* Đảm bảo hình ảnh không bị méo */
    }
</style>

</head>
  <main>
    <div class="mb-4 pb-4"></div>
    <section class="blog-page blog-single container">
      <div class="mw-930">
        <h2 class="page-title">{{ $blog->title }}</h2>
        <div class="blog-single__item-meta">
          <span class="blog-single__item-meta__author">By Admin</span>
          <span class="blog-single__item-meta__date">{{ $blog->created_at->format('F d, Y') }}</span>
          <span class="blog-single__item-meta__category">Category Placeholder</span>
        </div>
      </div>
      <div class="blog-single__item-content">
        <p>
        <img loading="lazy" class="blog-image w-100 h-auto d-block" src="{{ asset($blog->image_url) }}" alt="{{ $blog->title }}">
        </p>
        <div class="mw-930">
          <p>{{ $blog->content }}</p>
        </div>
      </div>


      <div class="blog-single__reviews mw-930">
        <h2 class="blog-single__reviews-title">Reviews</h2>
        <div class="blog-single__reviews-list">
          <div class="blog-single__reviews-item">
           
            <div class="customer-review">
              <div class="customer-name">
                <h6>Janice Miller</h6>
                <div class="reviews-group d-flex">
                  <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg"><use href="#icon_star" /></svg>
                  <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg"><use href="#icon_star" /></svg>
                  <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg"><use href="#icon_star" /></svg>
                  <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg"><use href="#icon_star" /></svg>
                  <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg"><use href="#icon_star" /></svg>
                </div>
              </div>
              <div class="review-date">April 06, 2023</div>
              <div class="review-text">
                <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est…</p>
              </div>
            </div>
          </div>
         
        </div>
        <div class="blog-single__review-form">
          <form name="customer-review-form" class="needs-validation" novalidate>
            
            <div class="select-star-rating">
              <label>Your rating *</label>
              <span class="star-rating">
                <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                </svg>
                <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                </svg>
                <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                </svg>
                <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                </svg>
                <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z"/>
                </svg>
              </span>
              <input type="hidden" id="form-input-rating" value="">
            </div>
            <div class="mb-4">
              <textarea id="form-input-review" class="form-control form-control_gray" placeholder="Your Review" cols="30" rows="8" required></textarea>
            </div>
            <div class="form-label-fixed mb-4">
              <label for="form-input-name" class="form-label">Name *</label>
              <input id="form-input-name" class="form-control form-control-md form-control_gray" required>
            </div>
            <div class="form-label-fixed mb-4">
              <label for="form-input-email" class="form-label">Email address *</label>
              <input id="form-input-email" type="email" class="form-control form-control-md form-control_gray" required>
            </div>
            <div class="form-check mb-4">
              <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="remember_checkbox">
              <label class="form-check-label" for="remember_checkbox">
                Save my name, email, and website in this browser for the next time I comment.
              </label>
            </div>
            <div class="form-action">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>

  <div class="mb-5 pb-xl-5"></div>
@endsection
