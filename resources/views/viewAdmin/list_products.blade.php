@extends('viewAdmin.navigation')
@section('title', 'List Products')
@section('content')
<!-- link này chỉ sử dụng cho  list_products.blade.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


<div class="container-fluid mt-4"> <!-- Sử dụng container-fluid -->
    <div class="d-flex justify-content-between mb-3">
        <!-- <div>
            <button class="btn btn-link"><i class="fas fa-download"></i> Xuất file</button>
            <button class="btn btn-link"><i class="fas fa-upload"></i> Nhập file</button>
        </div> -->
        <a href="{{ route('products.add') }}" class="btn btn-link">
            <i class="fas fa-plus-circle"></i> Thêm Sản Phẩm
        </a>
    </div>

    <div class="input-group mb-3">
        <form action="{{ route('products.search') }}" method="GET" class="d-flex w-100">
            @csrf
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">Lọc sản phẩm </button>
                <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                    @foreach($categories as $category)
                    <li>
                        <a class="dropdown-item" href="#" data-category-id="{{ $category->category_id }}">{{ $category->category_name }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <input type="text" name="search" class="form-control" id="searchInput" placeholder="Tìm kiếm sản phẩm" aria-label="Tìm kiếm sản phẩm" autocomplete="off">
            <input type="hidden" name="category_id" id="selectedCategoryId"> <!-- Ẩn trường để lưu id danh mục đã chọn -->
            <ul id="suggestionList" class="list-group">
                <!-- Kết quả sẽ được hiển thị tại đây -->
            </ul>
            <button class="btn btn-search" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>



    <div class="table-responsive"> <!-- Thêm div này -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Danh mục</th>
                    <th>Màu</th>
                    <th>Kích thước</th>
                    <th>Số lượng</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @if ($productsData->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">Không có sản phẩm nào được tìm thấy.</td>
                </tr>
                @else
                @foreach($productsData as $product)
                <tr data-id="{{ $product['product_id'] }}" data-sizes-and-colors="{{ isset($product['sizesAndColors']) ? json_encode($product['sizesAndColors']) : json_encode([]) }}" data-images="{{ json_encode($product['images']) }}">
                    <td class="product-cell" data-bs-toggle="modal" data-bs-target="#productModal">{{ $product['product_id'] }}</td>
                    <td class="product-cell" data-bs-toggle="modal" data-bs-target="#productModal">{{ $product['name'] }}</td>
                    <td class="product-cell text-truncate" data-bs-toggle="modal" data-bs-target="#productModal" title="{{ $product['description'] }}" data-description="{{ $product['description'] }}">
                        {!! Str::limit($product['description'], 50) !!}
                    </td>

                    <td class="product-cell" data-bs-toggle="modal" data-bs-target="#productModal">{{ $product['category_name'] }}</td>
                    <td class="product-cell" data-bs-toggle="modal" data-bs-target="#productModal">{{ $product['colors'] }}</td>
                    <td class="product-cell" data-bs-toggle="modal" data-bs-target="#productModal">{{ $product['sizes'] }}</td>
                    <td class="product-cell" data-bs-toggle="modal" data-bs-target="#productModal">{{ $product['total_quantity'] }}</td>
                    <td>
                        <div class="btn-group-column">
                            <button class="btn-icon delete-product" data-id="{{ $product['product_id'] }}">
                                <i class="fas fa-trash-alt"></i> Xóa
                            </button>
                            ||
                            <a class="btn-icon edit-product"
                                data-id="{{ encrypt($product['product_id']) }}">
                                <i class="fas fa-edit"></i> Sửa
                            </a>

                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    @if ($products->count() > 0)
    <nav aria-label="Page navigation example">
        <ul class="paginations justify-content-end">
            @if ($products->onFirstPage())
            <li class="page-items disabled">
                <span class="page-links" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </span>
            </li>
            @else
            <li class="page-items">
                <a class="page-links" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @endif

            @php
            // Xác định số trang hiện tại
            $currentPage = $products->currentPage();
            // Xác định số trang tối đa để hiển thị
            $totalPages = $products->lastPage();
            // Xác định khoảng cần hiển thị (ví dụ: 3 trang)
            $range = 1;
            // Xác định bắt đầu và kết thúc trang
            $start = max(1, $currentPage - $range);
            $end = min($totalPages, $currentPage + $range);

            // Điều chỉnh để luôn hiển thị tối thiểu 3 trang nếu có đủ
            if ($end - $start < 2) {
                if ($start==1) {
                $end=min($start + 2, $totalPages);
                } else {
                $start=max(1, $end - 2);
                }
                }
                @endphp

                @foreach (range($start, $end) as $page)
                <li class="page-items {{ ($products->currentPage() == $page) ? 'active' : '' }}">
                <a class="page-links" href="{{ $products->url($page) }}">{{ $page }}</a>
                </li>
                @endforeach

                @if ($products->hasMorePages())
                <li class="page-items">
                    <a class="page-links" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                @else
                <li class="page-items disabled">
                    <span class="page-links" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </span>
                </li>
                @endif
        </ul>
    </nav>
    @endif

</div>


<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Thêm modal-lg ở đây -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Chi tiết sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Tên sản phẩm: <span id="product-name"></span></h6>
                <h6>ID: <span id="product-id"></span></h6>
                <h6>Mô tả: <span id="product-description"></span></h6>
                <hr>

                <!-- Thêm phần hiển thị ảnh sản phẩm -->
                <div class="row justify-content-center" id="product-images">
                    <!-- Ảnh sẽ được thêm vào đây thông qua JavaScript -->
                </div>

                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Màu</th>
                            <th>Kích thước</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody id="product-details-body">
                        <!-- Dữ liệu màu, kích thước, số lượng sẽ được thêm ở đây -->
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>



<!-- Modal xác nhận xóa -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa sản phẩm này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Xóa</button>
            </div>
        </div>
    </div>
</div>

<!-- aler -->


@endsection