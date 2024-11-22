@extends('viewUser.navigation')
@section('title', 'Search product')
@section('content')
<div class="mb-5 pb-xl-2"></div>
<main>
    <section class="shop-main container">
        <div class="products-grid row row-cols-2 row-cols-md-3 row-cols-lg-4" id="products-grid">
            @if($products->count() > 0)

            @foreach($products as $product)
            <div class="product-card-wrapper">
                <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                    <div class="pc__img-wrapper">
                        <div class="swiper-container background-img js-swiper-slider"
                            data-settings='{"resizeObserver": true}'>
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="{{ route('product.show', $product['product_id']) }}">
                                        <img loading="lazy" src="{{ asset($product['images'][0]) }}" width="330"
                                            height="400" alt="{{ $product['name'] }}" class="pc__img">
                                    </a>
                                </div><!-- /.pc__img-wrapper -->
                            </div>
                        </div>
                    </div>

                    <div class="pc__info position-relative">
                        <p class="pc__category">{{ $product['category'] }}</p>
                        <h6 class="pc__title"><a
                                href="{{ route('product.show', $product['product_id']) }}">{{ $product['name'] }}</a>
                        </h6>
                        <div class="product-card__price d-flex align-items-center">
                            <span class="money price">{{ number_format($product['price'], 0, ',', '.') }}
                                VND</span>
                        </div>
                        <div class="product-card__price d-flex align-items-center">
                            <span class="reviews-note">Sold: {{ $product['total_sold'] }}</span>
                            @if ( $product['reviewCount'] > 0)
                            <span class="money price ms-5">
                                @for ($i = 0; $i < 5; $i++) @if ($i < $product['averageRating'])<svg class="review-star"
                                    viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
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
                            class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist {{ auth()->user() && auth()->user()->wishlists->contains('product_id', $product['product_id']) ? 'active' : '' }}"
                            data-product-id="{{ $product['product_id'] }}">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_heart" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p>No products found.</p>
            @endif
        </div>
        {{ $products->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
    </section>
</main>
<div class="mb-5 pb-xl-5"></div>

@endsection