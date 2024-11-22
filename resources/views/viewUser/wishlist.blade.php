@extends('viewUser.navigation')
@section('title', 'Wishlist')
@section('content')
@if (session('success'))
<script>
alert("{{ session('success') }}");
</script>
@endif
@if (session('error'))
<script>
alert("{{ session('error') }}");
</script>
@endif
<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Wishlist</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="page-content my-account__wishlist">
                    @if (Auth::check())
                    <div class="products-grid row row-cols-2 row-cols-lg-3" id="products-grid">
                        @if ($wishlistItems->isEmpty())
                        <p>Your wishlist is currently empty.</p>
                        @else
                        @foreach ($wishlistItems as $item)
                        <div class="product-card-wrapper">
                            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                                <div class="pc__img-wrapper">
                                    <div class="swiper-container background-img js-swiper-slider"
                                        data-settings='{"resizeObserver": true}'>
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <a href="{{ route('product.show', $item['product_id']) }}">
                                                    <img loading="lazy"
                                                        src="{{ asset('assets/img/products/' . $item->image) }}"
                                                        width="330" height="400" alt="{{ $item->product->name }}"
                                                        class="pc__img">
                                                </a>
                                            </div>
                                        </div>
                                        <!-- <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_prev_sm" />
                                            </svg></span>
                                        <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_next_sm" />
                                            </svg></span> -->
                                    </div>
                                    <form action="{{ route('wishlist.remove', $item->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-remove-from-wishlist">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_close" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">{{ $item->product->category->category_name }}</p>
                                    <h6 class="pc__title">{{ $item->product->name }}</h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price">{{ number_format($item->price, 0, ',', '.') }}
                                            VND</span>
                                    </div>
                                    <div class="product-card__price d-flex align-items-center">
                                    <span class="reviews-note">Sold: {{ $item->totalSold }}</span>
                                    @if ( $item['reviewCount'] > 0)
                                    <span class="money price ms-5">
                                        @for ($i = 0; $i < 5; $i++) @if ($i < $item->averageRating)<svg
                                            class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                            @else
                                            {{ '' }}
                                            @endif
                                            </svg>
                                            @endfor
                                            ({{ $item->reviewCount}})
                                    </span>
                                    @endif
                                </div>
                                    <button
                                        class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist 
                        {{ auth()->user() && auth()->user()->wishlists->contains('product_id', $item->product_id) ? 'active' : '' }}"
                                        data-product-id="{{ $item->product_id }}">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_heart" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div><!-- /.products-grid row -->

                    {{-- Phân trang --}}
                    @if (!$wishlistItems->isEmpty())
                    <div >
                        {{ $wishlistItems->links('vendor.pagination.bootstrap-5') }}
                    </div>
                    @endif
                    @else
                    <p>You need to login to use wishlist.</p>
                    <a class="btn btn-primary btn-addtocart" href="{{ route('auth') }}">Login</a>
                    @endif
                </div>

            </div>
        </div>
    </section>

</main>

<div class="mb-5 pb-xl-5"></div>
@endsection