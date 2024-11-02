@extends('viewAdmin.navigation')
@section('title', 'Add Products')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container bg">
    <h2>Thêm Sản Phẩm</h2>
    @if(session('success'))
    <div class="alert alert-success" id="successMessage">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="bordered">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Tên sản phẩm</label>
                        <input type="text" name="productName" class="form-control" id="productName" required
                            oninvalid="this.setCustomValidity('Vui lòng điền tên sản phẩm')"
                            oninput="this.setCustomValidity('')">
                    </div>
                    <div class="mb-3">
                        <label for="productContent" class="form-label">Nội dung</label>
                        <textarea name="productContent" class="form-control" id="productContent" rows="5"></textarea>
                    </div>

                    <!-- Chọn màu -->
                    <div class="mb-3">
                        <label class="form-label">Màu</label>
                        <div id="colorContainer">
                            <button type="button" class="btn btn-outline-warning color-button" data-color-id="1">Đen</button>
                            <button type="button" class="btn btn-outline-danger color-button" data-color-id="2">Đỏ</button>
                            <button type="button" class="btn btn-outline-secondary color-button" data-color-id="3">Xám</button>
                        </div>
                    </div>

                    <!-- Chọn kích thước -->
                    <div class="mb-3">
                        <label class="form-label">Kích thước</label>
                        <div id="sizeContainer" style="display: none;">
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="1">XS</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="2">S</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="3">M</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="4">L</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="5">XL</button>
                        </div>
                    </div>



                    <!-- Nhập số lượng và giá cho từng kết hợp -->
                    <div id="quantityInputs"></div>

                    <!-- Số lượng tổng và danh mục -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category" class="form-label">Danh mục</label>
                            <select name="category" class="form-select" id="category" required>
                                <option selected>Chọn danh mục</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Upload hình ảnh -->
                <div class="col-md-4">
                    <div class="row mb-3 justify-content-center" id="imagePlaceholderContainer"></div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <input type="file" name="images[]" id="imageInput" accept="image/jpeg, image/png" multiple class="btn btn-outline-secondary mb-2" style="display: none;">
                            <button class="btn btn-outline-secondary mb-2" id="chooseImageButton">Chọn ảnh</button>
                            <p class="file-info">Dung lượng file tối đa 1 MB<br>Định dạng: .JPEG, .PNG</p>
                        </div>
                    </div>
                    <input type="hidden" id="imageNames" name="imageNames">
                </div>
            </div>

            <div class="text-end">
                <div class="text-end">
                    <a href="{{ route('products.showListProducts') }}" class="btn btn-outline-secondary btn-custom-size">
                        Quay Lại
                    </a>
                    <button type="submit" class="btn btn-outline-secondary btn-custom-size">Thêm</button>
                </div>

            </div>
        </div>
    </form>
</div>

@endsection