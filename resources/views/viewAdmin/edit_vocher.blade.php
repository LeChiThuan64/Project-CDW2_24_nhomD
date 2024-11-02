@extends('viewAdmin.navigation')

@section('title', 'Chỉnh Sửa Voucher')

@section('content')
<div class="container my-5" style="padding-left: 25px;">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Chỉnh Sửa Voucher</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('vocher.update', $vocher->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Lựa chọn áp dụng voucher -->
                <div class="form-group mb-4">
                    <label class="form-label d-block"><strong>Áp dụng cho:</strong></label>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="apply_to" value="all" onclick="toggleUserSelect(false)" class="form-check-input" {{ $vocher->is_global ? 'checked' : '' }}>
                        <label class="form-check-label">Tất cả người dùng</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="apply_to" value="specific" onclick="toggleUserSelect(true)" class="form-check-input" {{ !$vocher->is_global ? 'checked' : '' }}>
                        <label class="form-check-label">Người dùng cụ thể</label>
                    </div>
                    <div id="user-select" style="{{ $vocher->is_global ? 'display: none;' : 'display: block;' }}">
                        <div class="form-group mb-4">
                            <label for="user_id" class="form-label">Chọn người dùng:</label>
                            <select name="user_id" id="user_id" class="form-select">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $vocher->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Các trường khác của voucher -->
                <div class="form-group mb-4">
                    <label for="name" class="form-label">Tên Voucher:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên voucher" required value="{{ $vocher->name }}">
                </div>

                <div class="form-group mb-4">
                    <label for="description" class="form-label">Mô tả Voucher:</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Nhập mô tả cho voucher" maxlength="255" oninput="updateCharCount()">{{ $vocher->description }}</textarea>
                    <small id="description-error" class="text-danger" style="display: none;">Không được vượt quá 255 ký tự.</small>
                    <small id="char-count" class="text-muted">{{ 255 - strlen($vocher->description) }} ký tự còn lại</small>
                </div>

                <div class="form-group mb-4">
                    <label for="discount" class="form-label">Giảm giá (%):</label>
                    <input type="number" name="discount" id="discount" class="form-control" placeholder="Nhập tỷ lệ giảm giá" required value="{{ $vocher->discount }}">
                    <small id="discount-error" class="text-danger" style="display: none;">Giảm giá phải là số từ 1 đến 100%.</small>
                </div>

                <div class="form-group mb-4">
                    <label for="start_date" class="form-label">Ngày bắt đầu:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required value="{{ $vocher->start_date }}">
                </div>

                <div class="form-group mb-4">
                    <label for="end_date" class="form-label">Ngày kết thúc:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required value="{{ $vocher->end_date }}">
                    <small id="date-error" class="text-danger" style="display: none;">Ngày kết thúc phải sau ngày bắt đầu.</small>
                </div>

                <button type="submit" class="btn btn-primary w-100">Cập Nhật Voucher</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleUserSelect(show) {
        document.getElementById('user-select').style.display = show ? 'block' : 'none';
    }

    function updateCharCount() {
        const maxLength = 255;
        const descriptionField = document.getElementById('description');
        const charCountDisplay = document.getElementById('char-count');

        const remainingChars = maxLength - descriptionField.value.length;
        charCountDisplay.textContent = `${remainingChars} ký tự còn lại`;

        if (remainingChars < 0) {
            descriptionField.value = descriptionField.value.substring(0, maxLength);
            document.getElementById('description-error').style.display = 'block';
        } else {
            document.getElementById('description-error').style.display = 'none';
        }
    }

    document.getElementById('end_date').addEventListener('change', function() {
        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(this.value);

        if (endDate < startDate) {
            document.getElementById('date-error').style.display = 'block';
            this.value = '';
        } else {
            document.getElementById('date-error').style.display = 'none';
        }
    });

    document.getElementById('discount').addEventListener('input', function() {
        const discountValue = parseFloat(this.value);
        if (isNaN(discountValue) || discountValue < 1 || discountValue > 100) {
            document.getElementById('discount-error').style.display = 'block';
        } else {
            document.getElementById('discount-error').style.display = 'none';
        }
    });
</script>
@endsection