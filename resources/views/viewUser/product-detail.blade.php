@extends('viewUser.navigation')
@section('title', 'Product detail')
@section('content')

<style>
.review-options {
    position: relative;
    display: inline-block;
}

.options-icon {
    cursor: pointer;
    font-size: 1.2rem;
}

.review-menu {
    display: none;
    position: absolute;
    right: 0;
    background-color: white;
    border: 1px solid #ddd;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    z-index: 10;
}

.review-menu button {
    display: block;
    width: 100%;
    border: none;
    background: none;
    padding: 10px;
    text-align: left;
    cursor: pointer;
}

.review-menu button:hover {
    background-color: #f5f5f5;
}
</style>
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
<<<<<<< HEAD
    <script>
        alert("{{ session('add-wishlist-success') }}");
    </script>
@endif
@if (session('delete-wishlist-success'))
    <script>
        alert("{{ session('delete-wishlist-success') }}");
    </script>
=======
<script>
alert("{{ session('add-wishlist-success') }}");
</script>
@endif
@if (session('delete-wishlist-success'))
<script>
alert("{{ session('delete-wishlist-success') }}");
</script>
>>>>>>> 03aed61a122434bce4a616eefb926e6789ac7a84
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
                    <div class="reviews-group ">{{ number_format($product['averageRating'], 1) }}
                        @for ($i = 0; $i < 5; $i++) <svg class="review-star" viewBox="0 0 9 9"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    @if (
                                                            $i
                                                            < $product['averageRating']
                                                        )
                                                                                <use href="#icon_star" /> <!-- Sao đầy -->
                                                    @else
                                                        <use href="#icon_star_empty" /> <!-- Sao trống -->
                                                    @endif
                                                </svg>
                        @endfor
                    </div>
                    <span
                        class="reviews-note text-lowercase text-secondary ms-1">{{ $product['reviewCount'] > 1 ? $product['reviewCount'] . ' reviews': $product['reviewCount'] . ' review' }}</span>
                </div>
                <span class="reviews-note ms-1">Sold: {{ $product['total_sold'] }}</span><br>
                <div id="product-price" class="pt-4 product-single__price">
                    <p>{{ number_format($product['price'], 0, ',', '.') }} VND</p>
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
                            <span id="product-quantity">{{ $product['total_quantity'] }}</span>
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
                    <a href="#" class="menu-link menu-link_us-s add-to-wishlist"
                        data-product-id="{{ $product['product_id'] }}">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_heart" />
                        </svg>
                        <span>Add to Wishlist</span>
                    </a>

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
                        <div class="product-single__reviews-item" id="review-{{ $review->id }}">
                            <div class="customer-avatar">
                                <img loading="lazy" src="{{ asset($review->user->profile_image) }}"
                                    alt="{{ $review->user->name }}">
                            </div>
                            <div class="customer-review">
                                <div class="customer-name d-flex justify-content-between">
                                    <h6>{{ $review->user->name }}</h6>
                                    <div class="review-options">
                                        <span class="options-icon" onclick="toggleMenu('menu-{{ $review->id }}')">
                                            &#8942;
                                            <!-- Icon ba dấu chấm dọc -->
                                        </span>
                                        <div class="review-menu" id="menu-{{ $review->id }}">
                                            <button
                                                onclick="deleteReview({{ $review->id }}, '{{ route('review.user.destroy', ['id' => $review->id]) }}')"
                                                class="btn-delete">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="reviews-group d-flex">
                                    {{-- Hiển thị sao đánh giá --}}
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                        </svg>
                                        @endfor

                                        {{-- Hiển thị các ngôi sao trống nếu rating dưới 5 --}}
                                        @for ($i = $review->rating; $i < 5; $i++) <svg class="review-star" viewBox="0 0 9 9"
                                                xmlns="http://www.w3.org/2000/svg">
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
<<<<<<< HEAD
=======
                                <div class="review-date">
                                    {{ $review->created_at }}
                                </div>
                                <div class="review-text">
                                    {{ $review->comment }}
                                </div>
                                <div class="review-images">
                                    @foreach ($review->images as $image)
                                    <a href="{{ asset('assets/img/reviews/' .$image->image_url) }}"
                                        data-lightbox="review-{{ $review->id }}" data-title="Review Image">
                                        <img class="review-image-item"
                                            src="{{ asset('assets/img/reviews/' .$image->image_url) }}"
                                            alt="Review Image">
                                    </a>
                                    @endforeach
                                </div>
                                @if ($review->reply)
                                <div class="seller-reply px-5 pt-5 pb-4">
                                    <h6 class="reply-title">Reply from Seller:</h6>
                                    <div class="reply-text review-text">
                                        {{ $review->reply }}
                                    </div>
                                </div>
                                @endif
>>>>>>> 03aed61a122434bce4a616eefb926e6789ac7a84
                            </div>
                        @endforeach
                    </div>

                    <div class="product-single__review-form">
                        <form name="customer-review-form" id="review-form" method="POST" enctype="multipart/form-data"
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
                                <label for="images">Add images (Max 4 images)</label>
                                <input type="file" name="images[]" class="form-control" id="imagesInput"
                                    accept="image/*" multiple>
                                <div id="error-message-images" style="color: red; display: none;">
                                    <p>You can only upload up to 4 images.</p>
                                </div>
                                <div id="imagePreview" style="margin: 10px 0;">

                                </div>

                                <div class="mb-4">
                                    <textarea name="comment" id="form-input-review"
                                        class="form-control form-control_gray" placeholder="Your Review" cols="30"
                                        rows="8"></textarea>
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
    <section class="products-carousel container">
            <!-- <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 pb-xl-2 mb-xl-4"> -->
                <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Other <strong>Products</strong></h2>
                <!-- <a class="btn-link btn-link_md default-underline text-uppercase fw-medium"
                    href="{{ route('locgia') }}">See All Products</a> -->
            <!-- </div> -->
            <div id="product_sneakers" class="position-relative">
                <div class="swiper-container js-swiper-slider" data-settings='{
            "autoplay": {
              "delay": 3000
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
                        @foreach ($productsRandom as $product)
                        <div class="swiper-slide product-card product-card_style3">
                            <div class="pc__img-wrapper border-radius-0">
                                <a href="{{ route('product.show', $product['product_id']) }}">
                                    <img loading="lazy" src="{{ asset($product['images'][0]) }}" width="330"
                                        height="400" alt="{{ $product['name'] }}" class="pc__img">
                                </a>
                            </div>

                            <div class="pc__info position-relative">
                                <p class="pc__category text-uppercase">{{ $product['category_name'] }}</p>
                                <h6 class="pc__title mb-2"><a
                                        href="{{ route('product.show', $product['product_id']) }}">{{ $product['name'] }}</a>
                                </h6>
                                <div class="product-card__price d-flex align-items-center">
                                    <span class="money price"><a
                                            href="{{ route('product.show', $product['product_id']) }}">{{ number_format($product['price'], 0, ',', '.') }}
                                            VND</a></span>
                                </div>
                                <div class="product-card__price d-flex align-items-center">
                                    <span class="reviews-note">Sold: {{ $product['total_sold'] }}</span>
                                    @if ( $product['reviewCount'] > 0)
                                    <span class="money price ms-5">
                                        @for ($i = 0; $i < 5; $i++) @if ($i < $product['averageRating'])<svg
                                            class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                            @else
                                            {{ '' }}
                                            @endif
                                            </svg>
                                            @endfor
                                            ({{ $product['reviewCount']}})
                                    </span>
                                    @endif
                                </div>


                                <button
                                    class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                    title="Add To Wishlist">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_heart" />
                                    </svg>
                                </button>
                                <!-- <form action="{{ route('wishlist.add', $product['product_id']) }}" method="POST"
                                    class="add-to-wishlist-form">
                                    @csrf
                                    <button type="submit" class="menu-link menu-link_us-s add-to-wishlist">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_heart" />
                                        </svg>
                                    </button>
                                </form> -->
                            </div>
                        </div>
                        @endforeach
                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->

                <div
                    class="products-carousel__prev navigation-sm position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md" />
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div
                    class="products-carousel__next navigation-sm position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md" />
                    </svg>
                </div><!-- /.products-carousel__next -->
            </div><!-- /.position-relative -->
        </section>
</main>

<div class="mb-5 pb-xl-5"></div>
<!-- Bao gồm component chatbox -->
<x-chatbox />
<script>
function toggleMenu(menuId) {
    const menu = document.getElementById(menuId);
    if (menu.style.display === "block") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}
document.addEventListener('click', function(event) {
    const allMenus = document.querySelectorAll('.review-menu');

    // Kiểm tra nếu click vào vùng ngoài các menu hoặc các nút trigger
    allMenus.forEach(menu => {
        if (!menu.contains(event.target) && !event.target.classList.contains('options-icon')) {
            menu.style.display = "none"; // Ẩn menu
        }
    });
});

function deleteReview(reviewId, deleteUrl) {
    if (confirm("Bạn có chắc chắn muốn xóa đánh giá này không?")) {
        fetch(deleteUrl, {
                method: "DELETE",
                headers: {
                    "X-Requested-With": "XMLHttpRequest", // Thêm header này để Laravel nhận diện yêu cầu là AJAX

                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
            })
            .then(response => response.json()) // Chuyển đổi phản hồi thành JSON
            .then(data => {
                console.log(data);

                if (data.success) {
                    alert(data.message || "Đánh giá đã được xóa thành công!");
                    const reviewElement = document.getElementById(`review-${reviewId}`);
                    if (reviewElement) {
                        reviewElement.remove(); // Chỉ xóa nếu phần tử tồn tại
                    }
                } else {
                    alert(data.message || "Không thể xóa đánh giá.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Có lỗi xảy ra. Vui lòng thử lại sau.");
            });
    }
}

document.getElementById('imagesInput').addEventListener('change', function(event) {
    const files = event.target.files;
    const previewContainer = document.getElementById('imagePreview');
    previewContainer.innerHTML = ''; // Clear previous previews

    if (files.length > 4) {
        document.getElementById('error-message-images').style.display = 'block';
    } else {
        document.getElementById('error-message-images').style.display = 'none';

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgWrapper = document.createElement('div');
                imgWrapper.style.position = 'relative';
                imgWrapper.style.display = 'inline-block';
                imgWrapper.style.marginRight = '10px';
                imgWrapper.style.marginBottom = '10px';

                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.style.maxHeight = '60px'; // Adjust size as needed
                imgElement.style.borderRadius = '5px'; // Optional: for rounded corners

                // Create and style the delete button (X)
                const deleteBtn = document.createElement('span');
                deleteBtn.innerText = '✖';
                deleteBtn.style.position = 'absolute';
                deleteBtn.style.top = '0.2em';
                deleteBtn.style.right = '0.2em';
                deleteBtn.style.color = 'white';
                deleteBtn.style.border = 'none';
                deleteBtn.style.textAlign = 'center';
                deleteBtn.style.lineHeight = '15px';
                deleteBtn.style.fontSize = '10px';
                deleteBtn.style.cursor = 'pointer';
                deleteBtn.style.width = '15px';
                deleteBtn.style.height = '15px';
                deleteBtn.style.background = 'black';
                deleteBtn.style.borderRadius = '30%';

                // Add event listener for deleting the image
                deleteBtn.addEventListener('click', function() {
                    imgWrapper.remove(); // Remove the image and the delete button
                });

                // Append the image and button to the wrapper
                imgWrapper.appendChild(imgElement);
                imgWrapper.appendChild(deleteBtn);

                // Append the wrapper to the preview container
                previewContainer.appendChild(imgWrapper);
            };
            reader.readAsDataURL(file);
        });
    }
});

document.querySelectorAll('.add-to-wishlist').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn việc chuyển hướng trang
        const productId = this.getAttribute('data-product-id');

        // Kiểm tra nếu productId hợp lệ
        if (!productId) {
            console.error('Invalid Product ID');
            return;
        }

        fetch(`/wishlist/add/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message); // Hiển thị thông báo thành công
                } else {
                    alert(data.message); // Hiển thị thông báo lỗi
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }, {
        once: true
    }); // Thêm tùy chọn để đảm bảo chỉ gọi một lần
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