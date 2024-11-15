@extends('viewUser.navigation')
@section('title', 'Home')
@section('content')
<main>
    <section class="swiper-container js-swiper-slider slideshow slideshow-navigation-white-sm"
      data-settings='{
        "autoplay": {
          "delay": 5000
        },
        "navigation": {
          "nextEl": ".slideshow__next",
          "prevEl": ".slideshow__prev"
        },
        "pagination": {
          "el": ".slideshow-pagination",
          "type": "bullets",
          "clickable": true
        },
        "slidesPerView": 1,
        "effect": "fade",
        "loop": true
      }'>
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="overflow-hidden position-relative h-100">
            <div class="slideshow-character position-absolute position-right-center mx-xl-5">
              <img loading="lazy" src="../images/home/demo10/slideshow-character1.png" width="945" height="733" alt="Woman Fashion 1" class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto">
            </div>
            <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
              <h6 class="text-yellow-bg-rounded text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">New Arrivals</h6>
              <h2 class="h1 fw-normal mb-2 mb-lg-3 animate animate_fade animate_btt animate_delay-5">Modern Jogger</h2>
              <h2 class="h2 fw-normal mb-3 mb-lg-4 animate animate_fade animate_btt animate_delay-5">399,50 TL</h2>
              <a href="shop1.html" class="btn-link btn-link_md default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop Now</a>
            </div>
          </div>
        </div><!-- /.slideshow-item -->
        <div class="swiper-slide">
          <div class="overflow-hidden position-relative h-100">
            <div class="slideshow-character position-absolute position-right-center mx-xl-5">
              <img loading="lazy" src="../images/home/demo10/slideshow-character1.png" width="945" height="733" alt="Woman Fashion 1" class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto">
            </div>
            <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
              <h6 class="text-yellow-bg-rounded text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">New Arrivals</h6>
              <h2 class="h1 fw-normal mb-2 mb-lg-3 animate animate_fade animate_btt animate_delay-5">Modern Jogger</h2>
              <h2 class="h2 fw-normal mb-3 mb-lg-4 animate animate_fade animate_btt animate_delay-5">399,50 TL</h2>
              <a href="shop1.html" class="btn-link btn-link_md default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop Now</a>
            </div>
          </div>
        </div><!-- /.slideshow-item -->
        <div class="swiper-slide">
          <div class="overflow-hidden position-relative h-100">
            <div class="slideshow-character position-absolute position-right-center mx-xl-5">
              <img loading="lazy" src="../images/home/demo10/slideshow-character1.png" width="945" height="733" alt="Woman Fashion 1" class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto">
            </div>
            <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
              <h6 class="text-yellow-bg-rounded text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">New Arrivals</h6>
              <h2 class="h1 fw-normal mb-2 mb-lg-3 animate animate_fade animate_btt animate_delay-5">Modern Jogger</h2>
              <h2 class="h2 fw-normal mb-3 mb-lg-4 animate animate_fade animate_btt animate_delay-5">399,50 TL</h2>
              <a href="shop1.html" class="btn-link btn-link_md default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop Now</a>
            </div>
          </div>
        </div><!-- /.slideshow-item -->
      </div><!-- /.slideshow-wrapper js-swiper-slider -->

      <div class="slideshow__prev position-absolute top-50 d-flex align-items-center justify-content-center">
        <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg"><use href="#icon_prev_sm" /></svg>
      </div><!-- /.slideshow__prev -->
      <div class="slideshow__next position-absolute top-50 d-flex align-items-center justify-content-center">
        <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg"><use href="#icon_next_sm" /></svg>
      </div><!-- /.slideshow__next -->

      <div class="container">
        <div class="slideshow-pagination d-flex align-items-center position-absolute bottom-0 mb-5"></div>
        <!-- /.products-pagination -->
      </div><!-- /.container -->
    </section><!-- /.slideshow -->

    <div class="container mw-1620 bg-white">
      <div class="mb-3 mb-xl-5 pt-1 pb-2"></div>

      <section class="brands-carousel container">
        <h2 class="d-none">Brands</h2>
        <div class="position-relative">
          <div class="swiper-container js-swiper-slider"
            data-settings='{
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": 7,
              "slidesPerGroup": 7,
              "effect": "none",
              "loop": true,
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "slidesPerGroup": 2,
                  "spaceBetween": 14
                },
                "768": {
                  "slidesPerView": 4,
                  "slidesPerGroup": 4,
                  "spaceBetween": 24
                },
                "992": {
                  "slidesPerView": 7,
                  "slidesPerGroup": 1,
                  "spaceBetween": 30,
                  "pagination": false
                }
              }
            }'>
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img loading="lazy" src="../images/brands/brand1.png" width="120" height="20" alt="">
              </div>
              <div class="swiper-slide">
                <img loading="lazy" src="../images/brands/brand2.png" width="87" height="20" alt="">
              </div>
              <div class="swiper-slide">
                <img loading="lazy" src="../images/brands/brand3.png" width="132" height="22" alt="">
              </div>
              <div class="swiper-slide">
                <img loading="lazy" src="../images/brands/brand4.png" width="72" height="21" alt="">
              </div>
              <div class="swiper-slide">
                <img loading="lazy" src="../images/brands/brand5.png" width="123" height="31" alt="">
              </div>
              <div class="swiper-slide">
                <img loading="lazy" src="../images/brands/brand6.png" width="137" height="22" alt="">
              </div>
              <div class="swiper-slide">
                <img loading="lazy" src="../images/brands/brand7.png" width="94" height="21" alt="">
              </div>
            </div><!-- /.swiper-wrapper -->
          </div><!-- /.swiper-container js-swiper-slider -->
        </div><!-- /.position-relative -->
  
      </section><!-- /.products-carousel container -->

      <div class="mb-3 mb-xl-5 pt-1 pb-2"></div>

      <section class="grid-banner container mb-3">
        <h2 class="d-none">Banner</h2>
        <div class="row">
          <div class="col-lg-4">
            <div class="grid-banner__item position-relative mb-3">
              <img loading="lazy" class="w-100 h-auto" src="../images/home/demo10/grid_banner_1.jpg" width="450" height="450" alt="">
              <div class="content_abs bottom-0 text-center mx-3 mx-xl-4 mb-3 mb-xl-4 pb-2 px-2">
                <a href="shop1.html" class="btn btn-outline-primary border-0 fs-base fw-normal btn-45 border-circle d-inline-flex align-items-center py-1">
                  <span>Shop Women</span>
                </a>
              </div><!-- /.content_abs .content_center -->
            </div>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <div class="grid-banner__item position-relative mb-3">
              <img loading="lazy" class="w-100 h-auto" src="../images/home/demo10/grid_banner_2.jpg" width="450" height="450" alt="">
              <div class="content_abs bottom-0 text-center mx-3 mx-xl-4 mb-3 mb-xl-4 pb-2 px-2">
                <a href="shop1.html" class="btn btn-outline-primary border-0 fs-base fw-normal btn-45 border-circle d-inline-flex align-items-center py-1">
                  <span>Shop Men</span>
                </a>
              </div><!-- /.content_abs .content_center -->
            </div>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <div class="grid-banner__item position-relative mb-3">
              <img loading="lazy" class="w-100 h-auto" src="../images/home/demo10/grid_banner_3.jpg" width="450" height="450" alt="">
              <div class="content_abs bottom-0 text-center mx-3 mx-xl-4 mb-3 mb-xl-4 pb-2 px-2">
                <a href="shop1.html" class="btn btn-outline-primary border-0 fs-base fw-normal btn-45 border-circle d-inline-flex align-items-center py-1">
                  <span>Shop Kids</span>
                </a>
              </div><!-- /.content_abs .content_center -->
            </div>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
      </section>

      <div class="mb-4 pb-4 mb-xl-4 mt-xl-3 pt-xl-3 pb-xl-4"></div>
  
      <section class="products-carousel container">
        <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 pb-xl-2 mb-xl-4">
          <h2 class="section-title fw-normal text-center">Trending Now</h2>
    
          <ul class="nav nav-tabs justify-content-center" id="collections-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link nav-link_underscore active" id="collections-tab-1-trigger" data-bs-toggle="tab" href="#collections-tab-1" role="tab" aria-controls="collections-tab-1" aria-selected="true">Accessories</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link nav-link_underscore" id="collections-tab-2-trigger" data-bs-toggle="tab" href="#collections-tab-2" role="tab" aria-controls="collections-tab-2" aria-selected="true">Sportwear</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link nav-link_underscore" id="collections-tab-3-trigger" data-bs-toggle="tab" href="#collections-tab-3" role="tab" aria-controls="collections-tab-3" aria-selected="true">Running</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link nav-link_underscore" id="collections-tab-4-trigger" data-bs-toggle="tab" href="#collections-tab-4" role="tab" aria-controls="collections-tab-4" aria-selected="true">Fitness</a>
            </li>
          </ul>
        </div>

        <div class="tab-content pt-2" id="collections-tab-content">
          <div class="tab-pane fade show active" id="collections-tab-1" role="tabpanel" aria-labelledby="collections-tab-1-trigger">
            <div id="product_1" class="position-relative">
              <div class="swiper-container js-swiper-slider"
                data-settings='{
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": 4,
                  "slidesPerGroup": 4,
                  "effect": "none",
                  "loop": false,
                  "scrollbar": {
                    "el": "#product_1 .products-carousel__scrollbar",
                    "draggable": true
                  },
                  "breakpoints": {
                    "320": {
                      "slidesPerView": 2,
                      "slidesPerGroup": 2,
                      "spaceBetween": 14
                    },
                    "768": {
                      "slidesPerView": 3,
                      "slidesPerGroup": 3,
                      "spaceBetween": 24
                    },
                    "992": {
                      "slidesPerView": 4,
                      "slidesPerGroup": 1,
                      "spaceBetween": 30,
                      "pagination": false
                    }
                  }
                }'>
                <div class="swiper-wrapper">
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Nike</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Wildhorse 6</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$29</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Puma</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Gray Vintage Chair</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Reebok</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Indy Icon Clash</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$17</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-4-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Hummel</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price price-old">$129</span>
                        <span class="money price price-sale">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Nike</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Wildhorse 6</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$29</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Puma</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Gray Vintage Chair</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Reebok</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Indy Icon Clash</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$17</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-4-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Hummel</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price price-old">$129</span>
                        <span class="money price price-sale">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Nike</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Wildhorse 6</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$29</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Puma</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Gray Vintage Chair</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Reebok</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Indy Icon Clash</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$17</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-4-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Hummel</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price price-old">$129</span>
                        <span class="money price price-sale">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                </div><!-- /.swiper-wrapper -->
              </div><!-- /.swiper-container js-swiper-slider -->
      
              <div class="pb-2 mb-4"></div>
      
              <!-- scrollbar -->
              <div class="products-carousel__scrollbar swiper-scrollbar"></div>
            </div><!-- /.position-relative -->
          </div><!-- /.tab-pane fade show-->

          <div class="tab-pane fade show" id="collections-tab-2" role="tabpanel" aria-labelledby="collections-tab-2-trigger">
            <div id="product_2" class="position-relative">
              <div class="swiper-container js-swiper-slider"
                data-settings='{
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": 4,
                  "slidesPerGroup": 4,
                  "effect": "none",
                  "loop": false,
                  "scrollbar": {
                    "el": "#product_2 .products-carousel__scrollbar",
                    "draggable": true
                  },
                  "navigation": {
                    "nextEl": "#product_2 .products-carousel__next",
                    "prevEl": "#product_2 .products-carousel__prev"
                  },
                  "breakpoints": {
                    "320": {
                      "slidesPerView": 2,
                      "slidesPerGroup": 2,
                      "spaceBetween": 14
                    },
                    "768": {
                      "slidesPerView": 3,
                      "slidesPerGroup": 3,
                      "spaceBetween": 24
                    },
                    "992": {
                      "slidesPerView": 4,
                      "slidesPerGroup": 1,
                      "spaceBetween": 30,
                      "pagination": false
                    }
                  }
                }'>
                <div class="swiper-wrapper">
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Puma</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Gray Vintage Chair</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Reebok</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Indy Icon Clash</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$17</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-4-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Hummel</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price price-old">$129</span>
                        <span class="money price price-sale">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Nike</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Wildhorse 6</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$29</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Puma</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Gray Vintage Chair</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Reebok</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Indy Icon Clash</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$17</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-4-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Hummel</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price price-old">$129</span>
                        <span class="money price price-sale">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Nike</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Wildhorse 6</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$29</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Puma</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Gray Vintage Chair</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Reebok</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Indy Icon Clash</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$17</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-4-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Hummel</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price price-old">$129</span>
                        <span class="money price price-sale">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Nike</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Wildhorse 6</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$29</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                </div><!-- /.swiper-wrapper -->
              </div><!-- /.swiper-container js-swiper-slider -->
      
              <div class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg"><use href="#icon_prev_md" /></svg>
              </div><!-- /.products-carousel__prev -->
              <div class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg"><use href="#icon_next_md" /></svg>
              </div><!-- /.products-carousel__next -->
      
              <div class="pb-2 mb-4"></div>
      
              <!-- scrollbar -->
              <div class="products-carousel__scrollbar swiper-scrollbar"></div>
            </div><!-- /.position-relative -->
          </div><!-- /.tab-pane fade show-->
  
          <div class="tab-pane fade show" id="collections-tab-3" role="tabpanel" aria-labelledby="collections-tab-3-trigger">
            <div id="product_3" class="position-relative">
              <div class="swiper-container js-swiper-slider"
                data-settings='{
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": 4,
                  "slidesPerGroup": 4,
                  "effect": "none",
                  "loop": false,
                  "scrollbar": {
                    "el": "#product_3 .products-carousel__scrollbar",
                    "draggable": true
                  },
                  "navigation": {
                    "nextEl": "#product_3 .products-carousel__next",
                    "prevEl": "#product_3 .products-carousel__prev"
                  },
                  "breakpoints": {
                    "320": {
                      "slidesPerView": 2,
                      "slidesPerGroup": 2,
                      "spaceBetween": 14
                    },
                    "768": {
                      "slidesPerView": 3,
                      "slidesPerGroup": 3,
                      "spaceBetween": 24
                    },
                    "992": {
                      "slidesPerView": 4,
                      "slidesPerGroup": 1,
                      "spaceBetween": 30,
                      "pagination": false
                    }
                  }
                }'>
                <div class="swiper-wrapper">
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Reebok</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Indy Icon Clash</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$17</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-4-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Hummel</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price price-old">$129</span>
                        <span class="money price price-sale">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Nike</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Wildhorse 6</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$29</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Puma</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Gray Vintage Chair</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Reebok</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Indy Icon Clash</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$17</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-4-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Hummel</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price price-old">$129</span>
                        <span class="money price price-sale">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Nike</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Wildhorse 6</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$29</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Puma</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Gray Vintage Chair</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Reebok</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Indy Icon Clash</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$17</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-4-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Hummel</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price price-old">$129</span>
                        <span class="money price price-sale">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Nike</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Wildhorse 6</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$29</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Puma</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Gray Vintage Chair</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                </div><!-- /.swiper-wrapper -->
              </div><!-- /.swiper-container js-swiper-slider -->
      
              <div class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg"><use href="#icon_prev_md" /></svg>
              </div><!-- /.products-carousel__prev -->
              <div class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg"><use href="#icon_next_md" /></svg>
              </div><!-- /.products-carousel__next -->
      
              <div class="pb-2 mb-4"></div>
      
              <!-- scrollbar -->
              <div class="products-carousel__scrollbar swiper-scrollbar"></div>
            </div><!-- /.position-relative -->
          </div><!-- /.tab-pane fade show-->
  
          <div class="tab-pane fade show" id="collections-tab-4" role="tabpanel" aria-labelledby="collections-tab-4-trigger">
            <div id="product_4" class="position-relative">
              <div class="swiper-container js-swiper-slider"
                data-settings='{
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": 4,
                  "slidesPerGroup": 4,
                  "effect": "none",
                  "loop": false,
                  "scrollbar": {
                    "el": "#product_4 .products-carousel__scrollbar",
                    "draggable": true
                  },
                  "navigation": {
                    "nextEl": "#product_4 .products-carousel__next",
                    "prevEl": "#product_4 .products-carousel__prev"
                  },
                  "breakpoints": {
                    "320": {
                      "slidesPerView": 2,
                      "slidesPerGroup": 2,
                      "spaceBetween": 14
                    },
                    "768": {
                      "slidesPerView": 3,
                      "slidesPerGroup": 3,
                      "spaceBetween": 24
                    },
                    "992": {
                      "slidesPerView": 4,
                      "slidesPerGroup": 1,
                      "spaceBetween": 30,
                      "pagination": false
                    }
                  }
                }'>
                <div class="swiper-wrapper">
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-4-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Hummel</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price price-old">$129</span>
                        <span class="money price price-sale">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Nike</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Wildhorse 6</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$29</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Puma</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Gray Vintage Chair</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Reebok</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Indy Icon Clash</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$17</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-4-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Hummel</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price price-old">$129</span>
                        <span class="money price price-sale">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Nike</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Wildhorse 6</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$29</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Puma</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Gray Vintage Chair</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Reebok</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Indy Icon Clash</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$17</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-4-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Hummel</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price price-old">$129</span>
                        <span class="money price price-sale">$99</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Nike</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Wildhorse 6</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$29</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Puma</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Gray Vintage Chair</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$62</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                  <div class="swiper-slide product-card product-card_style3">
                    <div class="pc__img-wrapper border-radius-0">
                      <a href="product1_simple.html">
                        <img loading="lazy" src="../images/home/demo10/product-3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img">
                      </a>
                    </div>

                    <div class="pc__info position-relative">
                      <p class="pc__category text-uppercase">Reebok</p>
                      <h6 class="pc__title mb-2"><a href="product1_simple.html">Indy Icon Clash</a></h6>
                      <div class="product-card__price d-flex align-items-center">
                        <span class="money price">$17</span>
                      </div>

                      <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                          <span class="d-none d-xxl-block">Quick View</span>
                          <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                        </button>
                      </div>

                      <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                      </button>
                    </div>
                  </div>
                </div><!-- /.swiper-wrapper -->
              </div><!-- /.swiper-container js-swiper-slider -->
      
              <div class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg"><use href="#icon_prev_md" /></svg>
              </div><!-- /.products-carousel__prev -->
              <div class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg"><use href="#icon_next_md" /></svg>
              </div><!-- /.products-carousel__next -->
      
              <div class="pb-2 mb-4"></div>
      
              <!-- scrollbar -->
              <div class="products-carousel__scrollbar swiper-scrollbar"></div>
            </div><!-- /.position-relative -->
          </div><!-- /.tab-pane fade show-->
        </div>
      </section><!-- /.products-carousel container -->
    </div>

    <div class="mb-4 pb-4 mb-xl-4 mt-xl-3 pt-xl-3 pb-xl-4"></div>

    <section class="video-banner position-relative">
      <div class="h-100 d-flex flex-column justify-content-end position-relative py-3 py-xl-5">
        <div class="container">
          <h2 class="text-white fw-normal mb-3">UOMO<br>Studio Collection</h2>
          <p class="text-white fs-6 mb-3">Low impact for the high powered.</p>
          
          <button class="btn btn-outline-primary border-0 fs-base fw-normal btn-45 border-circle bg-yellow-ffd35b text-primary mb-3">
            <span>Shop Now</span>
          </button>
        </div>
      </div>

      <button class="btn-video-player text-white position-absolute position-center" data-video="#video_banner_1">
        <svg class="btn-play" width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M15.4465 9.04281C15.4206 8.99101 15.3947 8.9651 15.3688 8.9392C15.317 8.86149 15.2652 8.80968 15.1875 8.73197C15.1098 8.65426 15.0062 8.57655 14.9285 8.52474L8.99656 4.43198L3.03874 0.313318C2.65019 0.0283787 2.15802 -0.0493319 1.71766 0.0283788C1.2773 0.106089 0.862847 0.365125 0.603811 0.753678C0.500197 0.909099 0.422487 1.06452 0.370679 1.21994C0.318872 1.34946 0.292969 1.47898 0.292969 1.6344C0.292969 1.6603 0.292969 1.71211 0.292969 1.73801V10.0012V18.2386C0.292969 18.7307 0.500197 19.1711 0.81104 19.4819C1.09598 19.7928 1.53634 20 2.02851 20C2.23573 20 2.44296 19.9741 2.62429 19.8964C2.80561 19.8446 2.96103 19.741 3.11646 19.6115L8.99656 15.5446L14.9026 11.4518C14.9285 11.4259 14.9803 11.4 15.0062 11.3741C15.3688 11.0892 15.602 10.7006 15.6797 10.2862C15.7574 9.87173 15.6797 9.40546 15.4465 9.04281ZM14.1514 10.3639L8.19355 14.4826L2.33935 18.5235C2.31345 18.5235 2.28754 18.5494 2.28754 18.5494C2.26164 18.5753 2.20983 18.6012 2.15802 18.6271C2.10622 18.653 2.08031 18.653 2.02851 18.653C1.92489 18.653 1.82128 18.6012 1.74357 18.5494C1.66586 18.4717 1.63995 18.3681 1.63995 18.2645V10.0012H1.61405V1.84163C1.61405 1.81572 1.61405 1.78982 1.61405 1.76392V1.73801C1.61405 1.71211 1.61405 1.68621 1.63995 1.6603C1.63995 1.6344 1.66586 1.6085 1.66586 1.58259C1.69176 1.55669 1.69176 1.55669 1.69176 1.53078C1.74357 1.45307 1.84718 1.40127 1.92489 1.40127C2.02851 1.37536 2.10622 1.40127 2.20983 1.45307C2.23573 1.47898 2.26164 1.47898 2.28754 1.50488L8.19355 5.59764L14.1255 9.6904C14.1514 9.71631 14.1773 9.71631 14.1773 9.74221C14.2032 9.76811 14.2032 9.79402 14.2291 9.79402C14.2809 9.89763 14.3068 10.0012 14.3068 10.1049C14.2809 10.2085 14.2291 10.3121 14.1514 10.3639Z" fill="white"/>
        </svg>
        <svg class="btn-pause" width="14" height="22" viewBox="0 0 14 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 20.7391V1.26087C1 1.1168 1.1168 1 1.26087 1C1.40494 1 1.52174 1.1168 1.52174 1.26087V20.7391C1.52174 20.8832 1.40494 21 1.26087 21C1.1168 21 1 20.8832 1 20.7391Z" stroke="white"/>
          <path d="M12.4785 20.7391V1.26087C12.4785 1.1168 12.5953 1 12.7394 1C12.8835 1 13.0003 1.1168 13.0003 1.26087V20.7391C13.0003 20.8832 12.8835 21 12.7394 21C12.5953 21 12.4785 20.8832 12.4785 20.7391Z" stroke="white"/>
        </svg>
      </button>
      <video id="video_banner_1" class="bg-video">
        <source src="https://uomo-html.flexkitux.com/videos/video_1.mp4">
      </video>
    </section>

    <div class="mb-4 pb-4 mb-xl-4 mt-xl-3 pt-xl-3 pb-xl-4"></div>

    <section class="grid-banner container mb-3">
      <div class="row">
        <div class="col-lg-4">
          <div class="grid-banner__item position-relative mb-3">
            <img loading="lazy" class="w-100 h-auto" src="../images/home/demo10/grid_banner_4.jpg" width="450" height="600" alt="">
            <div class="content_abs bottom-0 left-0 right-0 mx-3 mx-md-4 mx-xl-5 py-2 bg-white mb--1">
              <h3 class="my-2 pt-1 text-center">Leggins</h3>
            </div><!-- /.content_abs .content_center -->
          </div>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <div class="grid-banner__item position-relative mb-3">
            <img loading="lazy" class="w-100 h-auto" src="../images/home/demo10/grid_banner_5.jpg" width="450" height="600" alt="">
            <div class="content_abs bottom-0 left-0 right-0 mx-3 mx-md-4 mx-xl-5 py-2 bg-white mb--1">
              <h3 class="my-2 pt-1 text-center">Jackets & Coats</h3>
            </div><!-- /.content_abs .content_center -->
          </div>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <div class="grid-banner__item position-relative mb-3">
            <img loading="lazy" class="w-100 h-auto" src="../images/home/demo10/grid_banner_6.jpg" width="450" height="600" alt="">
            <div class="content_abs bottom-0 left-0 right-0 mx-3 mx-md-4 mx-xl-5 py-2 bg-white mb--1">
              <h3 class="my-2 pt-1 text-center">Fitness & Yoga</h3>
            </div><!-- /.content_abs .content_center -->
          </div>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
    </section>

    <div class="mb-4 pb-4 mb-xl-4 mt-xl-3 pt-xl-3 pb-xl-4"></div>

    <!--<section class="lookbook-container container">
      <h2 class="section-title fw-normal mb-3 pb-2 mb-xl-4">Featured Products</h2>

      <div class="row">
        <div class="col-lg-7">
          <div class="lookbook-products position-relative">
            <img loading="lazy" class="h-auto" src="../images/home/demo10/lookbook-bg.jpg" width="770" height="750" alt="">
            <button class="popover-point type3 position-absolute" style="left: 28%; top: 17%;" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content='
              <div class="popover-product">
                <a href="product1_simple.html">
                  <img loading="lazy" class="mb-3" src="../images/home/demo10/product-5-1.jpg" alt="">
                </a>
                <p class="fw-medium mb-0"><a href="product1_simple.html">Cableknit Shawl</a></p>
                <p class="mb-0">$129</p>
              </div>
            '><span></span></button>
            <button class="popover-point type3 position-absolute" style="left: 28%; top: 44%;" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content='
              <div class="popover-product">
                <a href="product1_simple.html">
                  <img loading="lazy" class="mb-3" src="../images/home/demo10/product-5-1.jpg" alt="">
                </a>
                <p class="fw-medium mb-0"><a href="product1_simple.html">Cableknit Shawl</a></p>
                <p class="mb-0">$129</p>
              </div>
            '><span></span></button>
            <button class="popover-point type3 position-absolute" style="left: 44%; top: 71%;" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content='
              <div class="popover-product">
                <a href="product1_simple.html">
                  <img loading="lazy" class="mb-3" src="../images/home/demo10/product-5-1.jpg" alt="">
                </a>
                <p class="fw-medium mb-0"><a href="product1_simple.html">Cableknit Shawl</a></p>
                <p class="mb-0">$129</p>
              </div>
            '><span></span></button>
          </div>
        </div>
        <div class="col-lg-5 py-4 py-xl-5 d-flex align-items-center">
          <div class="w-100">
            <div class="row">
              <div class="col-lg-2"></div>
              <div class="col-lg-7">
                <div class="position-relative">
                  <div class="swiper-container js-swiper-slider"
                    data-settings='{
                      "slidesPerView": 1,
                      "slidesPerGroup": 1,
                      "effect": "none",
                      "loop": true,
                      "pagination": {
                        "el": ".lookbook-container .slideshow-pagination",
                        "type": "bullets",
                        "clickable": true
                      }
                    }'>
                    <div class="swiper-wrapper">
                      <div class="swiper-slide product-card">
                        <div class="pc__img-wrapper">
                          <a href="product1_simple.html">
                            <img loading="lazy" src="../images/home/demo10/product-5-1.jpg" width="320" height="388" alt="Cropped Faux leather Jacket" class="pc__img">
                          </a>
                          <button class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        </div>
          
                        <div class="pc__info position-relative">
                          <p class="pc__category text-uppercase">Hummel</p>
                          <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                          <div class="product-card__price d-flex">
                            <span class="money price price-old">$129</span>
                            <span class="money price price-sale">$99</span>
                          </div>

                          <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                          </button>
                        </div>
                      </div>
                      <div class="swiper-slide product-card">
                        <div class="pc__img-wrapper">
                          <a href="product1_simple.html">
                            <img loading="lazy" src="../images/home/demo10/product-5-1.jpg" width="320" height="388" alt="Cropped Faux leather Jacket" class="pc__img">
                          </a>
                          <button class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                        </div>
          
                        <div class="pc__info position-relative">
                          <p class="pc__category text-uppercase">Hummel</p>
                          <h6 class="pc__title mb-2"><a href="product1_simple.html">Cableknit Shawl</a></h6>
                          <div class="product-card__price d-flex">
                            <span class="money price price-old">$129</span>
                            <span class="money price price-sale">$99</span>
                          </div>

                          <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="slideshow-pagination position-right-center position-right-2"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>-->

    <div class="mb-4 pb-4 mb-xl-4 mt-xl-3 pt-xl-3 pb-xl-4"></div>

    <section class="products-carousel container">
      <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 pb-xl-2 mb-xl-4">
        <h2 class="section-title fw-normal text-center">New Products</h2>
        <a class="btn-link btn-link_md default-underline text-uppercase fw-medium" href="{{ route('locgia') }}">See All Products</a>
      </div>
      <div id="product_sneakers" class="position-relative">
        <div class="swiper-container js-swiper-slider"
          data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 4,
            "slidesPerGroup": 1,
            "effect": "none",
            "loop": false,
            "navigation": {
              "nextEl": "#product_sneakers .products-carousel__next",
              "prevEl": "#product_sneakers .products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 1,
                "spaceBetween": 30,
                "pagination": false
              }
            }
          }'>
          <div class="swiper-wrapper">
            @foreach ($products as $product)
            <div class="swiper-slide product-card product-card_style3">
              <div class="pc__img-wrapper border-radius-0">
                <a href="{{ route('product.show', $product['product_id']) }}">
                  <img loading="lazy" src="{{ asset($product['images'][0]) }}" width="330" height="400" alt="{{ $product['name'] }}" class="pc__img">
                </a>
              </div>

              <div class="pc__info position-relative">
                <p class="pc__category text-uppercase">{{ $product['category'] }}</p>
                <h6 class="pc__title mb-2"><a href="{{ route('product.show', $product['product_id']) }}">{{ $product['name'] }}</a></h6>
                <div class="product-card__price d-flex align-items-center">
                  <span class="money price"><a href="{{ route('product.show', $product['product_id']) }}">{{ $product['price'] }}</a></span>
                </div>

                <div class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body mb-1">
                  <!-- <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart" title="Add To Cart">Add To Cart</button> -->
                  <!-- <button class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-quick-view" data-bs-toggle="modal" data-bs-target="#quickView" title="Quick view">
                    <span class="d-none d-xxl-block">Quick View</span>
                    <span class="d-block d-xxl-none"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_view" /></svg></span>
                  </button> -->
                </div>

                <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                  <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg>
                </button>
                <form action="{{ route('wishlist.add', $product['product_id']) }}" method="POST"
                        class="add-to-wishlist-form">
                        @csrf
                        <button type="submit" class="menu-link menu-link_us-s add-to-wishlist">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_heart" />
                            </svg>
                        </button>
                    </form>
              </div>
            </div>  
            @endforeach
          </div><!-- /.swiper-wrapper -->
        </div><!-- /.swiper-container js-swiper-slider -->

        <div class="products-carousel__prev navigation-sm bg-grey-eeeeee position-absolute top-50 d-flex align-items-center justify-content-center">
          <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg"><use href="#icon_prev_md" /></svg>
        </div><!-- /.products-carousel__prev -->
        <div class="products-carousel__next navigation-sm bg-grey-eeeeee position-absolute top-50 d-flex align-items-center justify-content-center">
          <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg"><use href="#icon_next_md" /></svg>
        </div><!-- /.products-carousel__next -->
      </div><!-- /.position-relative -->
    </section>

    <div class="mb-4 pb-4 mb-xl-4 mt-xl-3 pt-xl-3 pb-xl-4"></div>

    <section class="blog-carousel container">
      <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 pb-xl-2 mb-xl-4">
        <h2 class="section-title fw-normal text-center">Latest News</h2>
        <a class="btn-link btn-link_md default-underline text-uppercase fw-medium" href="{{ route('blog.index') }}">Read all articles</a>
      </div>

      <div class="position-relative">
        <div class="swiper-container js-swiper-slider"
          data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 3,
            "slidesPerGroup": 3,
            "effect": "none",
            "loop": true,
            "breakpoints": {
              "320": {
                "slidesPerView": 1,
                "slidesPerGroup": 1,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 3,
                "slidesPerGroup": 1,
                "spaceBetween": 30
              }
            }
          }'>
          <div class="swiper-wrapper blog-grid row-cols-xl-3">
            @foreach($blogs as $blog)
            <div class="swiper-slide blog-grid__item mb-4">
              <div class="blog-grid__item-image">
                <a href="{{ route('blog.detail', ['blog_id' => $blog->blog_id]) }}"><img loading="lazy" class="h-auto" src="{{ asset( $blog->image_url ) }}" width="450" height="300" alt=""></a>
              </div>
              <div class="blog-grid__item-detail">
                <div class="blog-grid__item-meta">
                  <span class="blog-grid__item-meta__author">BY {{ $blog->user ? $blog->user->name : 'Anonymous' }}
                  </span>
                  <span class="blog-grid__item-meta__date">{{ $blog->created_at }}</span>
                </div>
                <div class="blog-grid__item-title mb-0">
                  <a href="{{ route('blog.detail', ['blog_id' => $blog->blog_id]) }}">{{ $blog->title }}</a>
                </div>
              </div>
            </div>
            @endforeach
          </div><!-- /.swiper-wrapper -->
        </div><!-- /.swiper-container js-swiper-slider -->
      </div><!-- /.position-relative -->
    </section>

    <div class="mb-4 pb-4 mb-xl-4 mt-xl-3 pt-xl-3 pb-xl-4"></div>
  </main>
@endsection