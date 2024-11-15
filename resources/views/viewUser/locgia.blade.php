@extends('viewUser.navigation')
@section('title', 'LocGia')
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

        .products-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            /* Căn giữa các mục khi số lượng ít */
            gap: 20px;
            /* Điều chỉnh khoảng cách giữa các sản phẩm */
        }

        .product-loc-wrapper {
            width: calc(33.33% - 20px);
            /* Đảm bảo 3 sản phẩm mỗi hàng */
            min-width: 250px;
            /* Đặt chiều rộng tối thiểu để tránh co quá nhỏ */
            max-width: 100%;
            margin-bottom: 20px;
        }

        .pc__img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
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
                    </button>
                </h5>
                <div id="accordion-filter-1" class="accordion-collapse collapse show border-0"
                    aria-labelledby="accordion-heading-11" data-bs-parent="#categories-list">
                    @if ($categories->isNotEmpty())
                    <ul class="list list-inline mb-0">
                        <!-- Nút hiển thị tất cả sản phẩm -->
                        <li class="list-item">
                            <a href="{{ route('locgia') }}" class="menu-link py-1 text-primary">
                                Hiển thị tất cả sản phẩm
                            </a>
                        </li>
                        <!-- Danh sách các danh mục -->
                        @foreach ($categories as $category)
                        <li class="list-item">
                            <a href="{{ route('locgia.category', $category->category_id) }}" class="menu-link py-1">
                                {{ $category->category_name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-muted py-2">Chưa có danh mục sản phẩm.</p>
                    @endif
                </div>



            </div><!-- /.accordion-item -->
        </div><!-- /.accordion-item -->










        <div class="accordion" id="price-filters">
            <div class="accordion-item mb-4">
                <h5 class="accordion-header mb-2" id="accordion-heading-price">
                    <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-filter-price" aria-expanded="true" aria-controls="accordion-filter-price">
                        Price
                    </button>
                </h5>


                <div class="price-range">
                    <input type="range" id="minPrice" min="0" max="5000000" value="0">
                    <input type="range" id="maxPrice" min="0" max="5000000" value="5000000">
                    <div class="price-labels">
                        <span>Min Price: <span id="minPriceLabel">0</span> VND</span>
                        <span>Max Price: <span id="maxPriceLabel">5.000.000</span> VND</span>
                    </div>
                    <button id="filter-button" style="
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);"
    onmouseover="this.style.backgroundColor='#0056b3'; this.style.transform='scale(1.05)';"
    onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='scale(1)';">
    Lọc
</button>


                </div>

            </div>
        </div>

        
    </div><!-- /.shop-sidebar -->


    <div class="products-grid row" id="products-grid">

        @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 product-loc-wrapper">
            <div class="product-loc mb-3 mb-md-4 mb-xxl-5">
                <div class="pc__img-wrapper">
                    <div class="swiper-container background-img js-swiper-slider" data-settings='{"resizeObserver": true}'>
                        <div class="swiper-wrapper" id="swiper-wrapper-{{ $product->product_id }}">
                            @foreach ($product->images as $image)
                            <div class="swiper-slide">
                                <a href="{{ route('product.show', $product->product_id) }}">

                                    <img loading="lazy" src="{{ asset('assets/img/products/' . $image->image_url) }}" alt="{{ $product->name }}" class="pc__img" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="pc__info position-relative">
                    <h6 class="pc__title">
                        <a href="{{ route('product.show', $product->product_id) }}" style="font-size: 1.5rem; font-weight: bold; color: #000; text-align: center;">
                            {{ $product->name }}
                        </a>
                    </h6>
                    <div class="product-loc__price d-flex">
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




    // lọc giá 
    document.addEventListener('DOMContentLoaded', function() {
    const filterButton = document.querySelector('#filter-button');
    const minPriceInput = document.getElementById('minPrice');
    const maxPriceInput = document.getElementById('maxPrice');
    const productsGrid = document.getElementById('products-grid');

    filterButton.addEventListener('click', function() {
        const minPrice = minPriceInput.value;
        const maxPrice = maxPriceInput.value;

        // Gửi yêu cầu AJAX để lọc sản phẩm
        fetch(`/locgia/filter-products?minPrice=${minPrice}&maxPrice=${maxPrice}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(products => {
            // Xóa các sản phẩm cũ
            productsGrid.innerHTML = '';

            // Kiểm tra nếu không có sản phẩm nào
            if (products.length === 0) {
                productsGrid.innerHTML = '<p class="text-center">Không tìm thấy sản phẩm nào trong khoảng giá này.</p>';
                return;
            }

            // Hiển thị sản phẩm mới dựa trên dữ liệu nhận được
            products.forEach(product => {
                const productHtml = `
                    <div class="col-sm-6 col-md-4 col-lg-3 product-loc-wrapper">
                        <div class="product-loc mb-3 mb-md-4 mb-xxl-5">
                            <div class="pc__img-wrapper">
                                <a href="/product/${product.product_id}">
                                    <img src="${product.images[0]}" class="pc__img" alt="${product.name}">
                                </a>
                            </div>
                            <div class="pc__info position-relative">
                                <h6 class="pc__title" style="font-size: 1.5rem; font-weight: bold; color: #000;">
                                    <a href="/product/${product.product_id}">${product.name}</a>
                                </h6>
                                <div class="product-loc__price d-flex">
                                    <span class="money price">${new Intl.NumberFormat('vi-VN').format(product.productSizeColors[0].price)} VND</span>
                                </div>
                            </div>
                        </div>
                    </div>`;
                productsGrid.insertAdjacentHTML('beforeend', productHtml);
            });
        })
        .catch(error => console.error('Error:', error));
    });
});

</script>


<div class="mb-5 pb-xl-5"></div>
@endsection