@extends('viewUser.navigation')
@section('title', 'Search product')
@section('content')

<div class="mb-4 pb-lg-3"></div>

<section class="shop-main container d-flex">


    <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
        @foreach ($products as $product)
        <div class="product-card-wrapper">
            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                <div class="pc__img-wrapper">
                    <div class="swiper-container background-img js-swiper-slider"
                        data-settings='{"resizeObserver": true}'>
                        <div class="swiper-wrapper" id="swiper-wrapper-{{ $product->product_id }}">
                            <!-- Swiper slides will be added here by JavaScript -->
                        </div>
                    </div>
                </div>

                <div class="pc__info position-relative">
                    <h6 class="pc__title"><a
                            href="{{ route('product.show', $product->product_id) }}">{{ $product->name }}</a></h6>
                    <div class="product-card__price d-flex">
                        @php
                        $price = $product->productSizeColors->first()->price ?? 0; // Gán giá về 0 nếu không có giá
                        @endphp
                        <span class="money price">
                            @if($price > 0)
                            {{ number_format($price, 0, ',', '.') }} VND
                            @else
                            N/A
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const products = @json($products); // Lấy dữ liệu sản phẩm từ Blade

    products.forEach(product => {
        const swiperWrapper = document.getElementById(`swiper-wrapper-${product.product_id}`);

        product.images.forEach(image => {
            const imgElement = `
                    <div class="swiper-slide">
                        <a href="{{ route('product.show', '') }}/${product.product_id}">
                            <img loading="lazy" src="{{ asset('assets/img/products') }}/${image.image_url}" width="330" height="400" alt="${product.name}" class="pc__img">
                        </a>
                    </div>`;
            swiperWrapper.innerHTML += imgElement;
        });
    });
});
</script>


<div class="mb-5 pb-xl-5"></div>
@endsection