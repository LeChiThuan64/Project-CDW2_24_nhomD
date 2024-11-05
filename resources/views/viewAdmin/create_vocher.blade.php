@extends('viewAdmin.navigation')

@section('title', 'Contact')

@section('content')

<div class="container my-5" style="padding-left: 250px;">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Tạo Voucher Mới</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('vocher.store') }}" method="POST" onsubmit="return validateForm()">
                @csrf
                <!-- Lựa chọn áp dụng voucher -->
                <div class="form-group mb-4">
                    <label class="form-label d-block"><strong>Áp dụng cho:</strong></label>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="apply_to" value="all" onclick="toggleUserSelect(false)" checked class="form-check-input">
                        <label class="form-check-label">Tất cả người dùng</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="apply_to" value="specific" onclick="toggleUserSelect(true)" class="form-check-input">
                        <label class="form-check-label">Người dùng cụ thể</label>
                    </div>
                </div>

                <!-- Danh sách người dùng khi chọn "Người dùng cụ thể" -->
                <div id="user-select" style="display: none;">
                    <div class="form-group mb-4">
                        <label for="user_id" class="form-label">Chọn người dùng:</label>
                        <select name="user_id" id="user_id" class="form-select">
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Các trường khác của voucher -->
                <div class="form-group mb-4">
                    <label for="name" class="form-label">Tên Voucher:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên voucher" required>
                </div>

                <div class="form-group mb-4">
                    <label for="description" class="form-label">Mô tả Voucher:</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Nhập mô tả cho voucher" oninput="checkDescriptionLength()"></textarea>
                    <small id="description-error" class="text-danger" style="display: none;">Không được vượt quá 255 ký tự.</small>
                    <small id="char-count" class="text-muted">255 ký tự còn lại</small>
                </div>

                <div class="form-group mb-4">
                    <label for="discount" class="form-label">Giảm giá (%):</label>
                    <input type="number" name="discount" id="discount" class="form-control" placeholder="Nhập tỷ lệ giảm giá" required>
                    <small id="discount-error" class="text-danger" style="display: none;">Giảm giá phải là số từ 1 đến 100%.</small>
                </div>

                <!-- <div class="form-group mb-4">
                    <label for="start_date" class="form-label">Ngày bắt đầu:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                </div> -->
                <div class="form-group mb-4">
                    <label for="start_date" class="form-label">Ngày bắt đầu:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                </div>


                <div class="form-group mb-4">
                    <label for="end_date" class="form-label">Ngày kết thúc:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                    <small id="date-error" class="text-danger" style="display: none;">Ngày kết thúc phải sau ngày bắt đầu.</small>
                </div>

                <div class="buttons">
         
                    <button type="button" class="btn btn-danger" onclick="window.history.back();">Hủy</button>
                    <button type="submit" class="btn btn-primary w-100">Tạo Voucher</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Hiển thị danh sách người dùng nếu chọn "Người dùng cụ thể"
    function toggleUserSelect(show) {
        document.getElementById('user-select').style.display = show ? 'block' : 'none';
    }

    // Kiểm tra ngày kết thúc không trước ngày bắt đầu
    document.getElementById('end_date').addEventListener('change', function() {
        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(this.value);

        if (endDate < startDate) {
            document.getElementById('date-error').style.display = 'block';
            this.value = ''; // Xóa giá trị nếu không hợp lệ
        } else {
            document.getElementById('date-error').style.display = 'none';
        }
    });

    // Kiểm tra giảm giá
    document.getElementById('discount').addEventListener('input', function() {
        const discountValue = parseFloat(this.value);
        if (isNaN(discountValue) || discountValue < 1 || discountValue > 100) {
            document.getElementById('discount-error').style.display = 'block';
        } else {
            document.getElementById('discount-error').style.display = 'none';
        }
    });

    // Kiểm tra toàn bộ form khi submit
    function checkDescriptionLength() {
        const maxLength = 255;
        const descriptionField = document.getElementById('description');
        const descriptionError = document.getElementById('description-error');
        const charCountDisplay = document.getElementById('char-count');

        // Kiểm tra độ dài của nội dung
        if (descriptionField.value.length > maxLength) {
            // Nếu vượt quá giới hạn, hiển thị thông báo lỗi và cắt bớt chuỗi
            descriptionField.value = descriptionField.value.substring(0, maxLength);
            descriptionError.style.display = 'block';
        } else {
            // Ẩn thông báo lỗi nếu dưới giới hạn
            descriptionError.style.display = 'none';
        }

        // Cập nhật số ký tự còn lại
        const remainingChars = maxLength - descriptionField.value.length;
        charCountDisplay.textContent = `${remainingChars} ký tự còn lại`;
    }
</script>