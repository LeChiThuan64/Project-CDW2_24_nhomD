@extends('viewUser.navigation')
@section('title', 'Wishlist')
@section('content')
<main>
  <section class="blog-page-title mb-4 mb-xl-5">
    <div class="title-bg">
      <img loading="lazy" src="{{ asset('images_user/blog_title_bg.jpg') }}" width="1780" height="420" alt="">
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
    <div class="blog-grid row row-cols-1 row-cols-md-2 row-cols-xl-3">
      <div class="blog-grid__item">
        <div class="blog-grid__item-image">
          <img loading="lazy" class="h-auto" src="{{ asset('images_user/blog/blog-5.jpg') }}" width="450" height="400" alt="">
        </div>
        <div class="blog-grid__item-detail">
          <div class="blog-grid__item-meta">
            <span class="blog-grid__item-meta__author">By Admin</span>
            <span class="blog-grid__item-meta__date">Aprial 05, 2023</span>
          </div>
          <div class="blog-grid__item-title">
            <a href="blog_single.html">Woman with good shoes is never be ugly place</a>
          </div>
          <div class="blog-grid__item-content">
            <p>Midst one brought greater also morning green saying had good. Open stars day let over gathered, grass face one every light of under.</p>
            <a href="blog_single.html" class="readmore-link">Continue Reading</a>
          </div>
        </div>
      </div>
      <div class="blog-grid__item">
        <div class="blog-grid__item-image">
          <img loading="lazy" class="h-auto" src="{{ asset('images_user/blog/blog-6.jpg') }}" width="450" height="400" alt="">
        </div>
        <div class="blog-grid__item-detail">
          <div class="blog-grid__item-meta">
            <span class="blog-grid__item-meta__author">By Admin</span>
            <span class="blog-grid__item-meta__date">Aprial 05, 2023</span>
          </div>
          <div class="blog-grid__item-title">
            <a href="blog_single.html">Heaven upon heaven moveth every have.</a>
          </div>
          <div class="blog-grid__item-content">
            <p>Midst one brought greater also morning green saying had good. Open stars day let over gathered, grass face one every light of under.</p>
            <a href="blog_single.html" class="readmore-link">Continue Reading</a>
          </div>
        </div>
      </div>
      <div class="blog-grid__item">
        <div class="blog-grid__item-image">
          <img loading="lazy" class="h-auto" src="{{ asset('images_user/blog/blog-7.jpg') }}" width="450" height="400" alt="">
        </div>
        <div class="blog-grid__item-detail">
          <div class="blog-grid__item-meta">
            <span class="blog-grid__item-meta__author">By Admin</span>
            <span class="blog-grid__item-meta__date">Aprial 05, 2023</span>
          </div>
          <div class="blog-grid__item-title">
            <a href="blog_single.html">Tree doesn't good void, waters without created</a>
          </div>
          <div class="blog-grid__item-content">
            <p>Midst one brought greater also morning green saying had good. Open stars day let over gathered, grass face one every light of under.</p>
            <a href="blog_single.html" class="readmore-link">Continue Reading</a>
          </div>
        </div>
      </div>



    </div>


  </section>
</main>

<div class="mb-5 pb-xl-5"></div>

<!-- Footer Type 1 -->

@endsection