@extends('viewAdmin.navigation')
@section('title', 'AddProducts')
@section('content')
<div class="container bg">
    <h2>Thêm Sản Phẩm</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="bordered">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Tên sản phẩm</label>
                        <input type="text" name="productName" class="form-control" id="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="productContent" class="form-label">Nội dung</label>
                        <textarea name="productContent" class="form-control" id="productContent" rows="5"></textarea>
                    </div>

                    <!-- Chọn màu -->
                    <div class="mb-3">
                        <label class="form-label">Màu</label>
                        <div class="d-flex align-items-center" id="colorButtons">
                            <input type="hidden" name="selectedColorIds" id="selectedColorIds" value="">
                            <button class="btn btn-outline-secondary ms-2" data-bs-toggle="modal" data-bs-target="#colorModal">+</button>
                        </div>
                    </div>

                    <!-- Chọn kích thước -->
                    <div class="mb-3">
                        <label class="form-label">Kích thước</label>
                        <div class="btn-group" role="group" aria-label="Size options">
                            <!-- Checkbox kích thước -->
                            @foreach(['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                                <input type="checkbox" class="btn-check" id="size{{ $size }}" name="sizes[]" value="{{ $size }}" autocomplete="off">
                                <label class="btn btn-outline-secondary" for="size{{ $size }}">{{ $size }}</label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Số lượng và danh mục -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Số lượng</label>
                            <input type="number" name="quantity" class="form-control" id="quantity" required>
                        </div>
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

                    <!-- Giá sản phẩm -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="price" class="form-label">Giá sản phẩm</label>
                            <div class="d-flex align-items-center">
                                <input type="number" name="price" class="form-control me-2" id="price" required min="0" step="10000">
                                <span>VND</span>
                            </div>
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
                <button type="submit" class="btn btn-outline-secondary">Thêm</button>
            </div>
        </div>
    </form>
</div>

<!-- Modal chọn màu -->
<div class="modal fade" id="colorModal" tabindex="-1" aria-labelledby="colorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="colorModalLabel">Chọn Màu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="colorContainer">
                    <button class="btn btn-outline-danger color-button" data-id="1" data-color="Đỏ">Đỏ</button>
                    <button class="btn btn-outline-success color-button" data-id="2" data-color="Xanh">Xanh</button>
                    <button class="btn btn-outline-info color-button" data-id="3" data-color="Xanh Dương">Xanh Dương</button>
                    <button class="btn btn-outline-warning color-button" data-id="4" data-color="Vàng">Vàng</button>
                    <button class="btn btn-outline-secondary color-button" data-id="5" data-color="Xám">Xám</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@endsection
