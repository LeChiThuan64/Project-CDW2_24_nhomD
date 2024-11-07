@extends('viewUser.navigation')
@section('title', 'Wishlist')
@section('content')
<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Wishlist</h2>
        <div class="row">
            <div class="col-lg-3">
                <ul class="account-nav">
                    <li><a href="account_dashboard.html" class="menu-link menu-link_us-s">Dashboard</a></li>
                    <li><a href="account_orders.html" class="menu-link menu-link_us-s">Orders</a></li>
                    <li><a href="account_edit_address.html" class="menu-link menu-link_us-s">Addresses</a></li>
                    <li><a href="account_edit.html" class="menu-link menu-link_us-s">Account Details</a></li>
                    <li><a href="account_wishlist.html" class="menu-link menu-link_us-s menu-link_active">Wishlist</a>
                    </li>
                    <li><a href="login_register.html" class="menu-link menu-link_us-s">Logout</a></li>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="page-content my-account__wishlist">
                    <div class="products-grid row row-cols-2 row-cols-lg-3" id="products-grid">
                        @if (Auth::check())
                        @foreach ($wishlistItems as $item)
                        <div class="product-card-wrapper">
                            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                                <div class="pc__img-wrapper">
                                    <div class="swiper-container background-img js-swiper-slider"
                                        data-settings='{"resizeObserver": true}'>
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <a href="{{ route('product.show', $item['product_id']) }}"><img
                                                        loading="lazy"
                                                        src="{{ asset('assets/img/products/' . $item->image) }}"
                                                        width="330" height="400" alt="{{ $item->product->name }}"
                                                        class="pc__img">
                                                </a>
                                            </div>
                                        </div>
                                        <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_prev_sm" />
                                            </svg></span>
                                        <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_next_sm" />
                                            </svg></span>
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
                                    <!-- Hiển thị danh mục sản phẩm -->
                                    <h6 class="pc__title">{{ $item->product->name }}</h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price">{{ $item->price }} VND</span>
                                    </div>

                                    <button
                                        class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                        title="Add To Wishlist">
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
                        <p>Bạn cần đăng nhập để sử dụng wishlist.</p><p></p><p></p>
                        <a class="btn btn-primary btn-addtocart" href="{{ route('auth') }}">Login</a>
                        @endif

                    </div><!-- /.products-grid row -->
                </div>
            </div>
        </div>
    </section>
</main>

<div class="mb-5 pb-xl-5"></div>
@endsection