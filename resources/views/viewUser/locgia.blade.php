@extends('viewUser.navigation')
@section('title', 'contact')
@section('content')

<div class="mb-4 pb-lg-3"></div>

<section class="shop-main container d-flex">
    <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
        <div class="aside-header d-flex d-lg-none align-items-center">
            <h3 class="text-uppercase fs-6 mb-0">Filter By</h3>
            <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
        </div><!-- /.aside-header -->

        <div class="pt-4 pt-lg-0"></div>

        <div class="accordion" id="categories-list">
            <div class="accordion-item mb-4 pb-3">
                <h5 class="accordion-header" id="accordion-heading-11">
                    <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-filter-1" aria-expanded="true" aria-controls="accordion-filter-1">
                        Product Categories
                        <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                            <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                <path d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                            </g>
                        </svg>
                    </button>
                </h5>
                <div id="accordion-filter-1" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-11" data-bs-parent="#categories-list">
                    <div class="accordion-body px-0 pb-0 pt-3">
                        <ul class="list list-inline mb-0">
                            <li class="list-item">
                                <a href="#" class="menu-link py-1">Dresses</a>
                            </li>
                            <li class="list-item">
                                <a href="#" class="menu-link py-1">Shorts</a>
                            </li>
                            <li class="list-item">
                                <a href="#" class="menu-link py-1">Sweatshirts</a>
                            </li>
                            <li class="list-item">
                                <a href="#" class="menu-link py-1">Swimwear</a>
                            </li>
                            <li class="list-item">
                                <a href="#" class="menu-link py-1">Jackets</a>
                            </li>
                            <li class="list-item">
                                <a href="#" class="menu-link py-1">T-Shirts & Tops</a>
                            </li>
                            <li class="list-item">
                                <a href="#" class="menu-link py-1">Jeans</a>
                            </li>
                            <li class="list-item">
                                <a href="#" class="menu-link py-1">Trousers</a>
                            </li>
                            <li class="list-item">
                                <a href="#" class="menu-link py-1">Men</a>
                            </li>
                            <li class="list-item">
                                <a href="#" class="menu-link py-1">Jumpers & Cardigans</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- /.accordion-item -->
        </div><!-- /.accordion-item -->










        <div class="accordion" id="price-filters">
            <div class="accordion-item mb-4">
                <h5 class="accordion-header mb-2" id="accordion-heading-price">
                    <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-filter-price" aria-expanded="true" aria-controls="accordion-filter-price">
                        Price
                        <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                            <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                <path d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                            </g>
                        </svg>
                    </button>
                </h5>
                <div id="accordion-filter-price" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-price" data-bs-parent="#price-filters">
                    <input class="price-range-slider" type="text" name="price_range" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]" data-currency="$">
                    <div class="price-range__info d-flex align-items-center mt-2">
                        <div class="me-auto">
                            <span class="text-secondary">Min Price: </span>
                            <span class="price-range__min">$250</span>
                        </div>
                        <div>
                            <span class="text-secondary">Max Price: </span>
                            <span class="price-range__max">$450</span>
                        </div>
                    </div>
                </div>
            </div><!-- /.accordion-item -->
        </div><!-- /.accordion -->
    </div><!-- /.shop-sidebar -->

    <div class="shop-list flex-grow-1">
        

        <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
           

            <div class="product-card-wrapper">
                <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                    <div class="pc__img-wrapper">
                        <div class="swiper-container background-img js-swiper-slider" data-settings='{"resizeObserver": true}'>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="product1_simple.html"><img loading="lazy" src="../images/products/product_2.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img"></a>
                                </div><!-- /.pc__img-wrapper -->
                                <div class="swiper-slide">
                                    <a href="product1_simple.html"><img loading="lazy" src="../images/products/product_2-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img"></a>
                                </div><!-- /.pc__img-wrapper -->
                            </div>
                            <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_prev_sm" />
                                </svg></span>
                            <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_next_sm" />
                                </svg></span>
                        </div>
                        <button class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                    </div>

                    <div class="pc__info position-relative">
                        <p class="pc__category">Dresses</p>
                        <h6 class="pc__title"><a href="product1_simple.html">Calvin Shorts</a></h6>
                        <div class="product-card__price d-flex">
                            <span class="money price">$62</span>
                        </div>

                        <div class="d-flex align-items-center mt-1">
                            <a href="#" class="swatch-color pc__swatch-color" style="color: #222222"></a>
                            <a href="#" class="swatch-color swatch_active pc__swatch-color" style="color: #b9a16b"></a>
                            <a href="#" class="swatch-color pc__swatch-color" style="color: #f5e6e0"></a>
                        </div>

                        <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_heart" />
                            </svg>
                        </button>
                    </div>

                    <div class="pc-labels position-absolute top-0 start-0 w-100 d-flex justify-content-between">
                        <div class="pc-labels__right ms-auto">
                            <span class="pc-label pc-label_sale d-block text-white">-67%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-card-wrapper">
                <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                    <div class="pc__img-wrapper">
                        <div class="swiper-container background-img js-swiper-slider" data-settings='{"resizeObserver": true}'>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="product1_simple.html"><img loading="lazy" src="../images/products/product_3.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img"></a>
                                </div><!-- /.pc__img-wrapper -->
                                <div class="swiper-slide">
                                    <a href="product1_simple.html"><img loading="lazy" src="../images/products/product_3-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img"></a>
                                </div><!-- /.pc__img-wrapper -->
                            </div>
                            <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_prev_sm" />
                                </svg></span>
                            <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_next_sm" />
                                </svg></span>
                        </div>
                        <button class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart js-open-aside" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                    </div>

                    <div class="pc__info position-relative">
                        <p class="pc__category">Dresses</p>
                        <h6 class="pc__title"><a href="product1_simple.html">Kirby T-Shirt</a></h6>
                        <div class="product-card__price d-flex">
                            <span class="money price">$17</span>
                        </div>

                        <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_heart" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

          

         
           
        </div><!-- /.products-grid row -->

        
    </div>
</section><!-- /.shop-main container -->
</main>

<div class="mb-5 pb-xl-5"></div>


<!-- Footer Type 1 -->

@endsection