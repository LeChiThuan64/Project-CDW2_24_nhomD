@extends('viewAdmin.navigation')
@section('title', 'Add Products')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container bg">
    <h2>Thêm Sản Phẩm</h2>
    @if(session('success'))
    <div class="alert alert-success" id="successMessage">{{ session('success') }}</div>
    @endif
    <form id="addForm" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
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
                            <button type="button" class="btn btn-outline-warning color-button" data-color-id="1" onclick="showSizeOptions('den')">Đen</button>
                            <button type="button" class="btn btn-outline-danger color-button" data-color-id="2" onclick="showSizeOptions('do')">Đỏ</button>
                            <button type="button" class="btn btn-outline-secondary color-button" data-color-id="3" onclick="showSizeOptions('xam')">Xám</button>
                        </div>
                    </div>

                    <!-- Chọn kích thước -->
                    <div class="mb-3">
                        <label class="form-label">Kích thước</label>
                        <div id="denSizeContainer" style="display: none;">
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="1">XS</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="2">S</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="3">M</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="4">L</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="5">XL</button>
                        </div>
                        <div id="doSizeContainer" style="display: none;">
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="1">XS</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="2">S</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="3">M</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="4">L</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="5">XL</button>
                        </div>
                        <div id="xamSizeContainer" style="display: none;">
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="1">XS</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="2">S</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="3">M</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="4">L</button>
                            <button type="button" class="btn btn-outline-secondary size-button" data-size-id="5">XL</button>
                        </div>
                    </div>
                    <!-- Nhập số lượng và giá cho từng kết hợp -->
                    <div id="quantityInputs">
                        <!-- Nhóm Màu Đen -->
                        <div id="group-1" class="color-group" style="display:none;">
                            <div id="input-1-1" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Đen - XS)</label>
                                        <input type="number" name="quantities[Đen-XS]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Đen - XS)</label>
                                        <input type="number" name="prices[Đen-XS]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                            <div id="input-1-2" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Đen - S)</label>
                                        <input type="number" name="quantities[Đen-S]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Đen - S)</label>
                                        <input type="number" name="prices[Đen-S]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                            <div id="input-1-3" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Đen - M)</label>
                                        <input type="number" name="quantities[Đen-M]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Đen - M)</label>
                                        <input type="number" name="prices[Đen-M]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                            <div id="input-1-4" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Đen - L)</label>
                                        <input type="number" name="quantities[Đen-L]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Đen - L)</label>
                                        <input type="number" name="prices[Đen-L]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                            <div id="input-1-5" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Đen - XL)</label>
                                        <input type="number" name="quantities[Đen-XL]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Đen - XL)</label>
                                        <input type="number" name="prices[Đen-XL]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Nhóm Màu Đỏ -->
                        <div id="group-2" class="color-group" style="display:none;">
                            <div id="input-2-1" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Đỏ - XS)</label>
                                        <input type="number" name="quantities[Đỏ-XS]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Đỏ - XS)</label>
                                        <input type="number" name="prices[Đỏ-XS]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                            <div id="input-2-2" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Đỏ - S)</label>
                                        <input type="number" name="quantities[Đỏ-S]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Đỏ - S)</label>
                                        <input type="number" name="prices[Đỏ-S]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                            <div id="input-2-3" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Đỏ - M)</label>
                                        <input type="number" name="quantities[Đỏ-M]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Đỏ - M)</label>
                                        <input type="number" name="prices[Đỏ-M]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                            <div id="input-2-4" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Đỏ - L)</label>
                                        <input type="number" name="quantities[Đỏ-L]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Đỏ - L)</label>
                                        <input type="number" name="prices[Đỏ-L]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                            <div id="input-2-5" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Đỏ - XL)</label>
                                        <input type="number" name="quantities[Đỏ-XL]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Đỏ - XL)</label>
                                        <input type="number" name="prices[Đỏ-XL]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Nhóm Màu Xám -->
                        <div id="group-3" class="color-group" style="display:none;">
                            <div id="input-3-1" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Xám - XS)</label>
                                        <input type="number" name="quantities[Xám-XS]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Xám - XS)</label>
                                        <input type="number" name="prices[Xám-XS]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                            <div id="input-3-2" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Xám - S)</label>
                                        <input type="number" name="quantities[Xám-S]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Xám - S)</label>
                                        <input type="number" name="prices[Xám-S]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                            <div id="input-3-3" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Xám - M)</label>
                                        <input type="number" name="quantities[Xám-M]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Xám - M)</label>
                                        <input type="number" name="prices[Xám-M]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                            <div id="input-3-4" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Xám - L)</label>
                                        <input type="number" name="quantities[Xám-L]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Xám - L)</label>
                                        <input type="number" name="prices[Xám-L]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>
                            <div id="input-3-5" class="input-group quantity-input" style="display:none;">
                                <div class="row">
                                    <div class="col-6">
                                        <label>Số lượng (Xám - XL)</label>
                                        <input type="number" name="quantities[Xám-XL]" class="form-control" placeholder="Số lượng" min="0">
                                    </div>
                                    <div class="col-6">
                                        <label>Giá (Xám - XL)</label>
                                        <input type="number" name="prices[Xám-XL]" class="form-control" placeholder="Giá" min="0">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <input type="hidden" name="activeColors" id="activeColors">




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
                            <input type="hidden" id="imageNames" name="imageNames" value="">
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-end">
                <a href="{{ route('products.showListProducts') }}" class="btn btn-outline-secondary btn-custom-size">
                    Quay Lại
                </a>
                <button type="submit" id="btnThem" class="btn btn-outline-secondary btn-custom-size">Thêm</button>
            </div>
        </div>
    </form>
</div>


@endsection