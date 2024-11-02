@extends('viewAdmin.navigation')
@section('title', 'List Products')
@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <div>
            <button class="btn btn-link"><i class="fas fa-download"></i> Xuất file</button>
            <button class="btn btn-link"><i class="fas fa-upload"></i> Nhập file</button>
        </div>
        <a href="{{ route('products.add') }}" class="btn btn-link">
            <i class="fas fa-plus-circle"></i> Thêm Sản Phẩm
        </a>
    </div>
    <div class="input-group mb-3">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Lọc sản phẩm</button>
        <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm">
        <button class="btn btn-search" type="button"><i class="fas fa-search"></i></button>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>tên</th>
                <th>mô tả</th>
                <th>Màu</th>
                <th>Kích thước</th>
                <th>Số lượng</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productsData as $product)
            <tr data-id="{{ $product['product_id'] }}" data-sizes-and-colors="{{ isset($product['sizesAndColors']) ? json_encode($product['sizesAndColors']) : json_encode([]) }}" data-images="{{ json_encode($product['images']) }}">
                <td class="product-cell" data-bs-toggle="modal" data-bs-target="#productModal">{{ $product['product_id'] }}</td>
                <td class="product-cell" data-bs-toggle="modal" data-bs-target="#productModal">{{ $product['name'] }}</td>
                <td class="product-cell" data-bs-toggle="modal" data-bs-target="#productModal">{{ $product['description'] }}</td>
                <td class="product-cell" data-bs-toggle="modal" data-bs-target="#productModal">{{ $product['colors'] }}</td>
                <td class="product-cell" data-bs-toggle="modal" data-bs-target="#productModal">{{ $product['sizes'] }}</td>
                <td class="product-cell" data-bs-toggle="modal" data-bs-target="#productModal">{{ $product['total_quantity'] }}</td>
                <td>
                    <div class="btn-group-column">
                        <button class="btn-icon delete-product" data-id="{{ $product['product_id'] }}">
                            <i class="fas fa-trash-alt"></i> Xóa
                        </button>

                        ||
                        <button class="btn-icon"><i class="fas fa-edit"></i> Sửa</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    <nav aria-label="Page navigations example">
        <ul class="pagination justify-content-end">
            @if ($products->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </span>
            </li>
            @else
            <li class="page-item">
                <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @endif

            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
            <li class="page-item {{ ($products->currentPage() == $page) ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
            @endforeach

            @if ($products->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </span>
            </li>
            @endif
        </ul>
    </nav>


</div>

<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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