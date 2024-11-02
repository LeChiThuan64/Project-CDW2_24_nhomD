<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('icon/themify-icons-font/themify-icons/themify-icons.css') }}">
</head>

<body>
    <div class="main">
        <header>
            <div class="header-container">
                <!-- Logo -->
                <div class="logo">
                    <a class="logo-header" href="#"><img src="{{ asset('image/logo-tdc.webp') }}" alt="Logo"></a>
                </div>

                <!-- Navigation Menu -->
                <nav class="main-nav">
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">SHOP</a></li>
                        <li><a href="#">BLOG</a></li>
                        <li><a href="#">PAGES</a></li>
                        <li><a href="#">ABOUT</a></li>
                        <li><a href="#">CONTACT</a></li>
                    </ul>
                </nav>

                <!-- Icons on the Right using Themify Icons -->
                <div class="header-icons">
                    <a href="#"><i class="ti-search"></i></a>
                    <a href="#"><i class="ti-user"></i></a>
                    <a href="#"><i class="ti-shopping-cart"></i><span class="cart-count">3</span></a>
                    <a href="#"><i class="ti-heart"></i></a>
                    <a href="{{route('admin.chatbox.index')}}"><i class="ti-menu"></i></a>
                </div>
            </div>
        </header>
        <div class="container mt-5">
            <div class="row">
                <div class="row">
                    <div class="col-md-1">
                        <div class="img-product col-3"><img src="{{ asset('image/product_0.jpg') }}" alt="Thumb 1"
                                class="thumb-img" onclick="changeImage('{{ asset('image/product_0.jpg') }}')"></div>
                        <div class="img-product col-3"><img src="{{ asset('image/product_0.jpg') }}" alt="Thumb 2"
                                class="thumb-img" onclick="changeImage('{{ asset('image/product_0.jpg') }}')"></div>
                        <div class="img-product col-3"><img src="{{ asset('image/product_0.jpg') }}" alt="Thumb 2"
                                class="thumb-img" onclick="changeImage('{{ asset('image/product_0.jpg') }}')"></div>
                        <div class="img-product col-3"><img src="{{ asset('image/product_0.jpg') }}" alt="Thumb 2"
                                class="thumb-img" onclick="changeImage('{{ asset('image/product_0.jpg') }}')"></div>
                    </div>
                    <div class="col-md-5">
                        <img src="{{ asset('image/product_0.jpg') }}" alt="{{ $product->name }}"
                            class="product-img mb-4">
                    </div>
                    <div class="col-md-6">
                        <h2>{{ $product->name }}</h2>
                        <div>★★★★☆ 8k+ reviews</div>
                        <div class="price">${{ $product->price }}</div>
                        <p>{{ $product->description }}</p>
                        <div class="d-flex align-items-center mb-4">
                            <input type="number" class="qty" value="1" min="1">
                            <button class="btn btn-dark ms-3">Add to Cart</button>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <a href="#" class="btn btn-add to Wishlist"><i class="ti-heart"></i> Add to Wishlist</a>
                            <a href="#" class="btn btn-share "><i class="ti-share-alt"></i> Share</a>
                            <a href="#" class="btn btn-comparison">Comparison</a>
                        </div>
                        <p><strong>SKU:</strong> N/A</p>
                        <p><strong>Categories:</strong> Casual & Urban Wear, Jackets, Men</p>
                        <p><strong>Tags:</strong> biker, black, bomber, leather</p>
                    </div>

                    <!-- Comparison Table -->
                    <div id="comparison-table" class="comparison-table d-none">
                        <button class="close-btn">&times;</button>
                        <div class="comparison-item">
                            <h2>{{ $product->name }}</h2>
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
                                <h3 id="product-name" class="text-center">{{ $product->name }}</h3>
                                <div class="search-container">
                                    <input type="text" id="product-search" placeholder="Nhập tên hoặc ID sản phẩm...">
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
                                            <p><img src="#" alt="img-product-1"></p>
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
            </div>
        </div>
        <!-- Bao gồm component chatbox -->
        <x-chatbox />


        <script>
        function changeImage(imageSrc) {
            document.getElementById('main-img').src = imageSrc;
        }
        </script>

        <script src="{{ asset('style/js/product.js') }}"></script>
</body>

</html>