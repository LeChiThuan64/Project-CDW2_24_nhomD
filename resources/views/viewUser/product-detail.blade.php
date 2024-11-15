@extends('viewUser.navigation')
@section('title', 'Product detail')
@section('content')
@if (session('add-review-error'))
<script>
alert("{{ session('add-review-error') }}");
</script>
@endif

@if (session('add-review-success'))
<script>
alert("{{ session('add-review-success') }}");
</script>
@endif

@if (session('add-wishlist-success'))
<script>
    alert("{{ session('add-wishlist-success') }}");
</script>
@endif
@if (session('delete-wishlist-success'))
<script>
    alert("{{ session('delete-wishlist-success') }}");
</script>
@endif

<main>
    <div class="mb-md-1 pb-md-3"></div>
    <section class="product-single container">
        <div class="row">
            <div class="col-lg-7">
                <div class="product-single__media" data-media-type="vertical-thumbnail">
                    <div class="product-single__image">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @if (!empty($product['images']) && isset($product['images'][0]))
                                <div class="swiper-slide product-single__image-item">
                                    <img id="mainImage" loading="lazy" class="h-auto"
                                        src="{{ asset($product['images'][0]) }}" width="674" height="674"
                                        alt="Product Image">
                                </div>
                                @else
                                <p>No images available</p>
                                @endif
                            </div>

                            <!-- <div class="swiper-button-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_prev_sm" />
                                </svg></div>
                            <div class="swiper-button-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_next_sm" />
                                </svg></div> -->
                        </div>
                    </div>
                    <div class="product-single__thumbnail">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($product['images'] as $image)
                                <div class="swiper-slide product-single__image-item">
                                    <img loading="lazy" class="h-auto thumbnail" src="{{ $image }}" width="104"
                                        height="104" alt="" onclick="changeMainImage('{{ $image }}', this)">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-5">
                <div class="d-flex justify-content-between mb-4 pb-md-2">
                    <!-- <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                    </div> -->
                </div>
                <h1 class="product-single__name">{{ $product['name'] }}</h1>
                <div class="product-single__rating">
                    <div class="reviews-group d-flex">
                        @for ($i = 0; $i < 5; $i++) <svg class="review-star" viewBox="0 0 9 9"
                            xmlns="http://www.w3.org/2000/svg">
                            @if ($i
                            < $product['averageRating']) <use href="#icon_star" /> <!-- Sao đầy -->
                            @else
                            <use href="#icon_star_empty" /> <!-- Sao trống -->
                            @endif
                            </svg>
                            @endfor
                    </div>
                    <span class="reviews-note text-lowercase text-secondary ms-1">{{ $product['reviewCount'] }}
                        reviews</span>
                </div>
                <div id="product-price" class="product-single__price">
                    <p>{{ $product['price'] }} VND</p>
                </div>
                <div class="product-single__short-desc">
                    <p>{{ $product['description'] }}</p>
                </div>
                <form name="addtocart-form" method="post"
                    action="{{ route('cart.add', ['productId' => $product['product_id']]) }}" id="add-to-cart-form">
                    @csrf
                    <div class="product-single__swatches">

                        <div class="product-swatch text-swatches">
                            <label>Sizes</label>
                            <div class="swatch-list">
                                @foreach($product['sizes'] as $size)
                                @if ($size)
                                <input type="radio" name="size_id" id="swatch-size-{{ $size->id }}"
                                    value="{{ $size->id }}">
                                <label class="swatch js-swatch" for="swatch-size-{{ $size->id }}"
                                    title="{{ $size->name }}">{{ $size->name }}</label>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="product-swatch color-swatches">
                            <label>Color</label>
                            <div class="swatch-list">
                                @foreach($product['colors'] as $color)
                                @if ($color)
                                <input type="radio" name="color_id" id="swatch-color-{{ $color->id }}"
                                    value="{{ $color->id }}">
                                <label class="swatch swatch-color js-swatch" for="swatch-color-{{ $color->id }}"
                                    style="color: {{ $color->color_code }};" title="{{ $color->name }}"></label>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div>
                            Quantities:
                            <span id="product-quantity"></span>
                        </div><br>
                    </div>
                    <div class="product-single__addtocart">
                        <div class="qty-control position-relative">
                            <input type="number" name="quantity" value="1" min="1"
                                class="qty-control__number text-center">
                            <div class="qty-control__reduce">-</div>
                            <div class="qty-control__increase">+</div>
                        </div><!-- .qty-control -->
                        <button type="submit" id="add-to-cart-btn" class="btn btn-primary btn-addtocart">Add to
                            Cart</button>
                    </div>
                    <div class="product-single__addtocart checkout">
                        <button type="submit" class="btn btn-primary btn-addtocart">Checkout</button><br>
                    </div>
                </form>
                <div id="product-info" data-product-id="{{ $product['product_id'] }}"></div>
                <div class="product-single__addtolinks add-to-wishlist">
                    <form action="{{ route('wishlist.add', $product['product_id']) }}" method="POST"
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
                    <script src="js/details-disclosure.js" defer="defer"></script>
                    <script src="js/share.js" defer="defer"></script>
                    <!-- Button comparison product -->
                    <button
                        class="menu-link menu-link_us-s to-share border-0 bg-transparent d-flex align-items-center comparison-button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#5f6368">
                            <path
                                d="m320-160-56-57 103-103H80v-80h287L264-503l56-57 200 200-200 200Zm320-240L440-600l200-200 56 57-103 103h287v80H593l103 103-56 57Z" />
                        </svg>
                        <use href="#icon_comparison" />
                        </svg>
                        <span>Comparison</span>
                    </button>
                    <!-- Comparison Table -->
                    <div id="comparison-table" class="comparison-table d-none">
                        <button class="close-btn">&times;</button>
                        <div class="comparison-item">
                            <h2>{{ $product['name'] }}</h2>
                        </div>
                        <div class="comparison-item product2">
                            <a href="#" class="btn btn-outline-secondary btn-add-product">Thêm sản phẩm</a>
                        </div>
                        <div class="comparison-item btn-comparsion">
                            <button class="btn-table comparsion">So sánh ngay</button>
                            <button class="btn-table delete-product">Xóa sản phẩm</button>
                        </div>
                    </div>

                    <!-- Modal for adding products -->
                    <div id="add-product-modal" class="modal d-none">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Add Product</h2>
                            <div class="product-info">
                                <h3 id="product-name" class="text-center">{{ $product['name'] }}</h3>
                                <div class="search-container">
                                    <input type="text" id="product-search" placeholder="Nhập tên sản phẩm...">
                                </div>
                                <div id="search-results" class="search-results"></div>
                            </div>
                        </div>
                    </div>

                    <div class="comparison-section d-none">
                        <div class="comparison-content">
                            <button class="close-btn">&times;</button>
                            <div class="comparison-header">
                                <div class="col-3">
                                    <h2 class="title-comparsion">So sánh sản phẩm</h2>
                                </div>
                                <div class="col-9">
                                    <div class="product-wrapper">
                                        <div class="product-card" id="product1-card">
                                            <p><img src="{{ asset($product['images'][0]) }}" alt="img-product-1"></p>
                                            <span id="product1-name">Sản phẩm 1</span>
                                        </div>
                                        <div class="product-card" id="product2-card">
                                            <p><img src="#" alt="img-product-2"></p>
                                            <span id="product2-name">Sản phẩm 2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="comparison-details">
                                <div class="col-3 ">
                                    <h3 class="title-details">Thông tin chi tiết</h3>
                                </div>
                                <div class="col-9">
                                    <div class="details-wrapper">
                                        <div class="details-card product-1">
                                            <span>Thông tin sản phẩm 1</span>
                                        </div>
                                        <div class="details-card product-2">
                                            <span>Thông tin sản phẩm 2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-single__meta-info">
                    <div class="meta-item">
                        <label>Categories:</label>
                        <span>{{ $product['category'] }}</span>
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
                        ({{ $product['reviewCount'] }})</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                    aria-labelledby="tab-description-tab">
                    <div class="product-single__description">
                        <p>{{ $product['description'] }}</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-additional-info" role="tabpanel"
                    aria-labelledby="tab-additional-info-tab">
                    <div class="product-single__addtional-info">
                        <!-- <div class="item">
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
                        </div> -->
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                    <h2 class="product-single__reviews-title">Reviews</h2>
                    <div class="product-single__reviews-list">
                        @foreach ($product['reviews'] as $review)
                        <div class="product-single__reviews-item">
                            <div class="customer-avatar">
                                <img loading="lazy" src="{{ asset($review->user->profile_image) }}"
                                    alt="{{ $review->user->name }}">
                            </div>
                            <div class="customer-review">
                                <div class="customer-name">
                                    <h6>{{ $review->user->name }}</h6>
                                </div>
                                <div class="reviews-group d-flex">
                                    {{-- Hiển thị sao đánh giá --}}
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                        </svg>
                                        @endfor

                                        {{-- Hiển thị các ngôi sao trống nếu rating dưới 5 --}}
                                        @for ($i = $review->rating; $i < 5; $i++) <svg class="review-star"
                                            viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star_empty" />
                                            </svg>
                                            @endfor
                                </div>
                                <div class="review-date">
                                    {{ $review->created_at }}
                                </div>
                                <div class="review-text">
                                    {{ $review->comment }}
                                </div>
                                @if ($review->reply)
                                <div class="dropdown px-5 pb-5" data-bs-auto-close="false">
                                    <button class="btn btn-link dropdown-toggle custom-dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Reply from seller
                                    </button>
                                    <ul class="dropdown-menu custom-dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <div class="reply-text review-text">
                                                {{ $review->reply }}
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- <h5>Be the first to review “Message Cotton T-Shirt”</h5> -->
                    <div class="product-single__review-form">
                        <form name="customer-review-form" id="review-form" method="POST"
                            action="{{ route('addReview', ['productId' => $product['product_id']]) }}">
                            @csrf

                            <!-- <p>Your email address will not be published. Required fields are marked *</p> -->
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
                                <input type="hidden" name="rating" id="form-input-rating" value="">
                            </div>
                            <div class="mb-4">
                                <textarea name="comment" id="form-input-review" class="form-control form-control_gray"
                                    placeholder="Your Review" cols="30" rows="8"></textarea>
                                    <div id="error-message-review" style="color: red; display: none;">
                                        <p>Please select a rating and write a review before submitting.</p>
                                    </div>
                                <div class="form-action">
                                    <button type="submit" class="btn btn-primary mt-1">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="mb-5 pb-xl-5"></div>
<!-- Bao gồm component chatbox -->
<x-chatbox />
<script>
document.getElementById('review-form').addEventListener('submit', function(event) {
    var rating = document.getElementById('form-input-rating').value;
    var comment = document.getElementById('form-input-review').value.trim();

    // Kiểm tra xem rating có được chọn và comment có được nhập không
    if (!rating || !comment) {
        event.preventDefault(); // Ngừng gửi form
        document.getElementById('error-message-review').style.display = 'block'; // Hiển thị thông báo lỗi
    }
});
</script>
<!-- <script>
    $(document).ready(function() {
        // Xử lý submit form bằng AJAX
        $('#review-form').submit(function(e) {
            e.preventDefault();  // Ngừng việc submit form theo cách truyền thống

            var formData = new FormData(this); // Lấy dữ liệu từ form

            $.ajax({
                url: $(this).attr('action'),  // Lấy URL hành động từ form
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Nếu việc gửi thành công, bạn có thể xử lý phản hồi
                    if (response.success) {
                        alert('Review đã được gửi!');
                        // Cập nhật danh sách đánh giá hoặc làm mới giao diện nếu cần
                        $('#form-input-review').val('');  // Dọn sạch textarea
                    } else {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại sau!');
                }
            });
        });
    });
</script> -->
@endsection