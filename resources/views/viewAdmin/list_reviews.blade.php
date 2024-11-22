@extends('viewAdmin.navigation')
@section('title', 'Manage Reviews')
@section('content')
<style>
    #modalImages {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 20px;
}

.image-preview-item {
    position: relative;
    width: 100px;
    height: 100px;
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f8f8f8;
}

.image-preview-item img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

.image-preview-item + .image-preview-item {
    margin-left: 10px;
}

.image-preview-remove {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    font-size: 12px;
}

.image-preview-remove:hover {
    background: rgba(0, 0, 0, 0.8);
}

    </style>
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h5 class="text-white text-capitalize ps-3">List Reviews</h5>
                </div>
            </div>
            <div class="row p-3">
                <!-- Thanh tìm kiếm -->
                <div class="col-md-5">
                    <form action="{{ route('review.show') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" style="height: 42px;"
                                placeholder="Search categories by user name, product name, rating"
                                aria-label="search-category" value="">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- <div class="col-md-2 text-right">
                    <a href="{{ route('category.showCreate') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus"></i>
                    </a>
                </div> -->

            </div>
            <!-- Nút dấu cộng -->
        </div>
        @if (session('delete-success'))
        <div class="alert alert-success" id="success-message">
            {{ session('delete-success') }}
        </div>
        @endif
        @if (session('delete-failure'))
        <div class="alert alert-danger" id="failure-message">
            {{ session('delete-failure') }}
        </div>
        @endif

        @if (session('update-success'))
        <div class="alert alert-success" id="success-message">
            {{ session('update-success') }}
        </div>
        @endif
        @if (session('create-success'))
        <div class="alert alert-success" id="success-message">
            {{ session('create-success') }}
        </div>
        @endif
        @if (session('add-reply-success'))
        <div class="alert alert-success" id="success-message">
            {{ session('add-reply-success') }}
        </div>
        @endif
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User
                                name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product
                                name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rating
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Review
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Action</th>

                        </tr>
                    </thead>
                    <tbody id="user-data">
                        @foreach($reviews as $review)
                        <tr>
                            <td class="align-middle text-center">

                                <span class="text-secondary text-xs font-weight-bold">{{ $review->id }}</span>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $review->user->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">

                                        <h6 class="mb-0 text-sm">{{ $review->product->name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="align-middle text-center">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $review->rating }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $review->comment }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="actions">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#viewReviewModal"
        data-content="{{ $review->comment }}"
        data-user="{{ $review->user->name }}"
        data-product="{{ $review->product->name }}"
        data-rating="{{ $review->rating }}"
        data-date="{{ $review->created_at }}"
        data-reply="{{ $review->reply }}"
        data-images="{{ json_encode($review->images->map(function($image) { return asset('assets/img/reviews/' . $image->image_url); } )) }}">
    <i class="fas fa-eye"></i>
</button>


                                <form action="{{ route('review.destroy', ['id' => $review->id]) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm px-3"
                                        style="border-radius: 10px; font-size: 12px;"
                                        onclick="return confirm('Are you sure delete this review?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>

                                <button type="button"
                                    class="btn btn-{{ $review->reply ? 'dark' : 'info' }} btn-sm px-3 btn-reply"
                                    data-bs-toggle="modal" data-bs-target="#replyModal"
                                    data-review-id="{{ $review->id }}" data-reply="{{ $review->reply ?? '' }}">
                                    <i class="fas fa-edit"></i> {{ $review->reply ? 'Replied' : 'Reply' }}
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Reply -->
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replyModalLabel">Reply</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form reply -->
                <form id="replyForm" action="" method="POST">
                    @csrf
                    <textarea name="reply" id="modal-reply-textarea" placeholder="Enter your reply here"
                        class="form-control"></textarea>
                    <button type="submit" class="btn btn-primary mt-5">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal view reviews -->
<div class="modal fade" id="viewReviewModal" tabindex="-1" aria-labelledby="viewReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewReviewModalLabel">Review Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    <p><strong>User:</strong> <span id="modalUser"></span></p>
    <p><strong>Product:</strong> <span id="modalProduct"></span></p>
    <p><strong>Rating:</strong> <span id="modalRating"></span></p>
    <p><strong>Review:</strong> <span id="modalComment"></span></p>
    <p><strong>Date:</strong> <span id="modalDate"></span></p>
    <p><strong>Image: </strong><div id="modalImages" class="image-preview-container mt-3"></div></p>
     <!-- Thêm hình ảnh -->
    <hr class="cross">
    <p><strong>Reply review:</strong> <span id="modalReply"></span></p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>

        </div>
    </div>
</div>
@if ($reviews->count() > 0 && $reviews->lastPage() > 1)
<nav aria-label="Page navigation example">
    <ul class="paginations justify-content-end">
        @if ($reviews->onFirstPage())
        <li class="page-items disabled">
            <span class="page-links" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </span>
        </li>
        @else
        <li class="page-items">
            <a class="page-links" href="{{ $reviews->previousPageUrl() }}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        @endif

        @php
        // Xác định số trang hiện tại
        $currentPage = $reviews->currentPage();
        // Xác định số trang tối đa để hiển thị
        $totalPages = $reviews->lastPage();
        // Xác định khoảng cần hiển thị (ví dụ: 3 trang)
        $range = 1;
        // Xác định bắt đầu và kết thúc trang
        $start = max(1, $currentPage - $range);
        $end = min($totalPages, $currentPage + $range);

        // Điều chỉnh để luôn hiển thị tối thiểu 3 trang nếu có đủ
        if ($end - $start < 2) { if ($start==1) { $end=min($start + 2, $totalPages); } else { $start=max(1, $end - 2); }
            } @endphp @foreach (range($start, $end) as $page) <li
            class="page-items {{ ($reviews->currentPage() == $page) ? 'active' : '' }}">
            <a class="page-links" href="{{ $reviews->url($page) }}">{{ $page }}</a>
            </li>
            @endforeach

            @if ($reviews->hasMorePages())
            <li class="page-items">
                <a class="page-links" href="{{ $reviews->nextPageUrl() }}" aria-label="Next">
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


<script>
document.addEventListener('DOMContentLoaded', function() {
    const replyModal = document.getElementById('replyModal');
    replyModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const reviewId = button.getAttribute('data-review-id');
        const reply = button.getAttribute('data-reply');

        // Cập nhật action của form với đúng review_id
        const form = document.getElementById('replyForm');
        form.action = `/reviews/${reviewId}/reply`; // Route động

        // Đặt giá trị của textarea
        const textarea = document.getElementById('modal-reply-textarea');
        textarea.value = reply || '';
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var viewReviewModal = document.getElementById('viewReviewModal');
    viewReviewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var user = button.getAttribute('data-user');
        var product = button.getAttribute('data-product');
        var rating = button.getAttribute('data-rating');
        var comment = button.getAttribute('data-content');
        var date = button.getAttribute('data-date');
        var reply = button.getAttribute('data-reply');
        var images = JSON.parse(button.getAttribute('data-images'));

        document.getElementById('modalUser').textContent = user;
        document.getElementById('modalProduct').textContent = product;
        document.getElementById('modalRating').textContent = rating;
        document.getElementById('modalComment').textContent = comment;
        document.getElementById('modalDate').textContent = date;
        document.getElementById('modalReply').textContent = reply || 'No reply yet';

        // Lấy phần tử chứa hình ảnh trong modal
        var modalImagesContainer = document.getElementById('modalImages');
        modalImagesContainer.innerHTML = ''; // Xóa các hình ảnh cũ

        // Kiểm tra nếu không có hình ảnh
        if (images.length === 0) {
            var noImageMessage = document.createElement('span');
            noImageMessage.textContent = 'No image';
            noImageMessage.style.color = '#999'; // Màu chữ nhạt
            noImageMessage.style.fontStyle = 'italic'; 
            modalImagesContainer.appendChild(noImageMessage);
        } else {
            // Nếu có hình ảnh, hiển thị các hình ảnh
            images.forEach(function (image) {
                var imageElement = document.createElement('div');
                imageElement.classList.add('image-preview-item');
                imageElement.innerHTML = `
                    <img src="${image}" alt="Review Image">
                `;
                modalImagesContainer.appendChild(imageElement);
            });
        }
    });
});


</script>

@endsection