@extends('viewUser.navigation')
@section('title', 'contact')
@section('content')

<head>
    <style>
        .price-range {
            position: relative;
            margin: 20px 0;
        }

        input[type="range"] {
            -webkit-appearance: none;
            width: 100%;
            height: 5px;
            background: #ddd;
            border-radius: 5px;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            background: #333;
            border-radius: 50%;
            cursor: pointer;
        }

        input[type="range"]::-moz-range-thumb {
            width: 20px;
            height: 20px;
            background: #333;
            border-radius: 50%;
            cursor: pointer;
        }

        .price-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
</head>

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


                <div class="price-range">
                    <input type="range" id="minPrice" min="0" max="5000000" value="0">
                    <input type="range" id="maxPrice" min="0" max="5000000" value="5000000">
                    <div class="price-labels">
                        <span>Min Price: <span id="minPriceLabel">0</span> VND</span>
                        <span>Max Price: <span id="maxPriceLabel">5.000.000</span> VND</span>
                    </div>
                    <button style="
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
"
                        onmouseover="this.style.backgroundColor='#0056b3'; this.style.transform='scale(1.05)';"
                        onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='scale(1)';">
                        Lọc
                    </button>

                </div>

            </div><!-- /.accordion-item -->
        </div><!-- /.accordion -->
    </div><!-- /.shop-sidebar -->

    <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
        @foreach ($products as $product)
        <div class="product-card-wrapper">
            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                <div class="pc__img-wrapper">
                    <div class="swiper-container background-img js-swiper-slider" data-settings='{"resizeObserver": true}'>
                        <div class="swiper-wrapper" id="swiper-wrapper-{{ $product->product_id }}">
                            <!-- Swiper slides will be added here by JavaScript -->
                        </div>
                    </div>
                </div>

                <div class="pc__info position-relative">
                    <h6 class="pc__title"><a href="{{ route('product.show', $product->product_id) }}">{{ $product->name }}</a></h6>
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




    const minPriceInput = document.getElementById('minPrice');
    const maxPriceInput = document.getElementById('maxPrice');
    const minPriceLabel = document.getElementById('minPriceLabel');
    const maxPriceLabel = document.getElementById('maxPriceLabel');

    // Function to format numbers with dots as thousands separators
    function formatCurrency(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Update the displayed values when the slider values change
    minPriceInput.addEventListener('input', function() {
        minPriceLabel.textContent = formatCurrency(minPriceInput.value);
        if (parseInt(minPriceInput.value) > parseInt(maxPriceInput.value)) {
            maxPriceInput.value = minPriceInput.value;
            maxPriceLabel.textContent = formatCurrency(maxPriceInput.value);
        }
    });

    maxPriceInput.addEventListener('input', function() {
        maxPriceLabel.textContent = formatCurrency(maxPriceInput.value);
        if (parseInt(maxPriceInput.value) < parseInt(minPriceInput.value)) {
            minPriceInput.value = maxPriceInput.value;
            minPriceLabel.textContent = formatCurrency(minPriceInput.value);
        }
    });


</script>


<div class="mb-5 pb-xl-5"></div>
@endsection