@extends('viewUser.navigation')
@section('title', 'Product detail')
@section('content')
    <main>
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-single__media" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @if (!empty($product->images) && isset($product->images[0]))
                                        <div class="swiper-slide product-single__image-item">
                                            <img loading="lazy" class="h-auto"
                                                src="{{ asset('assets/img/products/' . $product->images[0]->image_url) }}"
                                                width="674" height="674" alt="Product Image">
                                            <a data-fancybox="gallery"
                                                href="{{ asset('assets/img/products/' . $product->images[0]->image_url) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_zoom" />
                                                </svg>
                                            </a>
                                        </div>
                                    @else
                                        <p>No images available</p>
                                    @endif
                                </div>
                                <div class="swiper-button-prev">
                                    <svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_prev_sm" />
                                    </svg>
                                </div>
                                <div class="swiper-button-next">
                                    <svg width="7" height="11" viewBox="0 0 7 11"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_next_sm" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="product-single__thumbnail">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($product->images as $image)
                                        <div class="swiper-slide product-single__image-item">
                                            <img loading="lazy" class="h-auto"
                                                src="{{ asset('assets/img/products/' . $image->image_url) }}" width="104"
                                                height="104" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="d-flex justify-content-between mb-4 pb-md-2">
                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                    </div>
                </div>
                <h1 class="product-single__name">{{ $product->name }}</h1>

                <div class="product-single__rating">
                    <div class="reviews-group d-flex">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                @if ($i < $averageRating)
                                    <use href="#icon_star" /> <!-- Sao đầy -->
                                @else
                                    <use href="#icon_star_empty" /> <!-- Sao trống -->
                                @endif
                            </svg>
                        @endfor
                    </div>
                    <span class="reviews-note text-lowercase text-secondary ms-1">{{ $reviewCount }} reviews</span>
                </div>

                <div class="product-single__price">
                    <span class="current-price">{{ $product->price }} $</span>
                </div>
                <div class="product-single__short-desc">
                    <p>{{ $product->description }}</p>
                </div>
                <form name="addtocart-form" method="post">
                    <div class="product-single__addtocart">
                        <div class="qty-control position-relative">
                            <input type="number" name="quantity" value="1" min="1"
                                class="qty-control__number text-center">
                            <div class="qty-control__reduce">-</div>
                            <div class="qty-control__increase">+</div>
                        </div><!-- .qty-control -->
                        <button type="submit" class="btn btn-primary btn-addtocart js-open-aside"
                            data-aside="cartDrawer">Add to Cart</button>
                    </div>
                    <div class="product-single__addtocart checkout">
                        <button type="submit" class="btn btn-primary btn-addtocart js-open-aside"
                            data-aside="cartDrawer">Checkout</button><br>
                    </div>
                </form>
                <div class="product-single__addtolinks">
                    <form action="{{ route('wishlist.add', $product->product_id) }}" method="POST"
                        class="add-to-wishlist-form">
                        @csrf
                        <button type="submit" class="menu-link menu-link_us-s add-to-wishlist">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_heart" />
                            </svg>
                            <span>Add to Wishlist</span>
                        </button>
                    </form>
                    <share-button class="share-button">
                        <button
                            class="menu-link menu-link_us-s to-share border-0 bg-transparent d-flex align-items-center">
                            <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_sharing" />
                            </svg>
                            <span>Share</span>
                        </button>
                        <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                            <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                            <div id="Article-share-template__main"
                                class="share-button__fallback flex items-center absolute top-full left-0 w-full px-2 py-4 bg-container shadow-theme border-t z-10">
                                <div class="field grow mr-4">
                                    <label class="field__label sr-only" for="url">Link</label>
                                    <input type="text" class="field__input w-full" id="url"
                                        value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health"
                                        placeholder="Link" onclick="this.select();" readonly="">
                                </div>
                                <button class="share-button__copy no-js-hidden">
                                    <svg class="icon icon-clipboard inline-block mr-1" width="11" height="13"
                                        fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                        focusable="false" viewBox="0 0 11 13">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z"
                                            fill="currentColor"></path>
                                    </svg>
                                    <span class="sr-only">Copy link</span>
                                </button>
                            </div>
                        </details>
                    </share-button>
                   
                </div>
                <div class="product-single__meta-info">
                    <div class="meta-item">
                        <!-- <label>SKU:</label> -->
                        <!-- <span>N/A</span> -->
                    </div>
                    <div class="meta-item">
                        <label>Categories:</label>
                        <span>{{ $product['category_name'] }}</span>
                    </div>
                </div>
            </div>
            </div>
            <div class="product-single__details-tab">
                <ul class="nav nav-tabs" id="myTab1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                            href="#tab-description" role="tab" aria-controls="tab-description"
                            aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                            href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                            aria-selected="false">Additional Information</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab"
                            href="#tab-reviews" role="tab" aria-controls="tab-reviews" aria-selected="false">Reviews
                            ({{ $reviewCount }})</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                        aria-labelledby="tab-description-tab">
                        <div class="product-single__description">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-additional-info" role="tabpanel"
                        aria-labelledby="tab-additional-info-tab">
                        <div class="product-single__addtional-info">
                            <div class="item">
                                <label class="h6">Weight</label>
                                <span>1.25 kg</span>
                            </div>
                            <div class="item">
                                <label class="h6">Dimensions</label>
                                <span>90 x 60 x 90 cm</span>
                            </div>
                            <div class="item">
                                <label class="h6">Size</label>
                                <span>XS, S, M, L, XL</span>
                            </div>
                            <div class="item">
                                <label class="h6">Color</label>
                                <span>Black, Orange, White</span>
                            </div>
                            <div class="item">
                                <label class="h6">Storage</label>
                                <span>Relaxed fit shirt-style dress with a rugged</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                        <h2 class="product-single__reviews-title">Reviews</h2>
                        <div class="product-single__reviews-list">
                            <div class="product-single__reviews">
                                @if (!empty($product->reviews))
                                    @foreach ($product->reviews as $review)
                                        <div class="product-single__reviews-item">
                                            <div class="customer-avatar">
                                                <!-- Giả sử avatar được lưu trong cơ sở dữ liệu, nếu không có dùng avatar mặc định -->
                                                <!-- <img loading="lazy" src="" alt=""> -->
                                            </div>
                                            <div class="customer-review">
                                                <div class="customer-name">
                                                    <h6>{{ $review->name }}</h6>
                                                    <div class="reviews-group d-flex">
                                                        {{-- Hiển thị sao đánh giá --}}
                                                        @for ($i = 0; $i < $review->rating; $i++)
                                                            <svg class="review-star" viewBox="0 0 9 9"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <use href="#icon_star" />
                                                            </svg>
                                                        @endfor


                                                        @for ($i = $review->rating; $i < 5; $i++)
                                                            <svg class="review-star" viewBox="0 0 9 9"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <use href="#icon_star_empty" />

                                                            </svg>
                                                        @endfor
                                                    </div>

                                                </div>
                                                <div class="review-date">
                                                    {{ $review->created_at }}
                                                </div>
                                                <div class="review-text">
                                                    <p>{{ $review->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="product-single__review-form">
                <form name="customer-review-form">
                    <h5>Be the first to review “Message Cotton T-Shirt”</h5>
                    <p>Your email address will not be published. Required fields are marked *</p>
                    <div class="select-star-rating">
                        <label>Your rating *</label>
                        <span class="star-rating">
                            <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                            </svg>
                            <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                            </svg>
                            <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                            </svg>
                            <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                            </svg>
                            <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc"
                                viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                            </svg>
                        </span>
                        <input type="hidden" id="form-input-rating" value="">
                    </div>
                    <div class="mb-4">
                        <textarea id="form-input-review" class="form-control form-control_gray" placeholder="Your Review" cols="30"
                            rows="8"></textarea>
                        <div class="form-action">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

    </main>

    <div class="mb-5 pb-xl-5"></div>
@endsection
