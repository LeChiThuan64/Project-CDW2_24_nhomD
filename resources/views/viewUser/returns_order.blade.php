@extends('viewUser.navigation')
@section('title', 'Returns order')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/returns_order.css') }}" type="text/css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Đổi trả sản phẩm</h2>
        <div class="row">
            <div class="col-lg-3">
                <div class="policy-content">
                    <h2>Chính Sách Đổi Trả</h2>
                    <p>Chúng tôi cam kết đảm bảo sự hài lòng của khách hàng. Nếu bạn không hoàn toàn hài lòng với sản
                        phẩm đã mua, chúng tôi cung cấp chính sách đổi trả thuận tiện.</p>
                    <h3>1. Sản Phẩm Đủ Điều Kiện</h3>
                    <ul>
                        <li>Sản phẩm phải chưa qua sử dụng và còn nguyên bao bì.</li>
                        <li>Sản phẩm phải có nhãn mác và hóa đơn gốc.</li>
                        <li>Sản phẩm bị hư hỏng do khách hàng sử dụng không được đổi trả.</li>
                    </ul>
                    <h3>2. Thời Hạn Đổi Trả</h3>
                    <p>Bạn có thể yêu cầu đổi trả trong vòng <strong>14 ngày</strong> kể từ ngày nhận hàng.</p>
                    <h3>3. Cách Thực Hiện Đổi Trả</h3>
                    <ol>
                        <li>Liên hệ bộ phận chăm sóc khách hàng qua email hoặc hotline.</li>
                        <li>Cung cấp thông tin đơn hàng và lý do đổi trả.</li>
                        <li>Gửi sản phẩm đến địa chỉ của chúng tôi.</li>
                    </ol>
                    <h3>4. Chính Sách Hoàn Tiền</h3>
                    <p>Chúng tôi sẽ xử lý hoàn tiền trong vòng 7 ngày làm việc sau khi nhận được sản phẩm. Các phương
                        thức hoàn tiền bao gồm:</p>
                    <ul>
                        <li>Chuyển khoản ngân hàng.</li>
                        <li>Ghi có vào ví để mua hàng trong tương lai.</li>
                    </ul>
                    <h3>5. Chi Phí</h3>
                    <p>
                        <strong>Miễn phí vận chuyển đổi trả:</strong> Nếu sản phẩm bị lỗi hoặc giao sai.<br>
                        <strong>Khách hàng chịu phí vận chuyển đổi trả:</strong> Nếu đổi trả vì lý do cá nhân như thay
                        đổi kích thước hoặc màu sắc.
                    </p>
                    <h3>6. Liên Hệ</h3>
                    <p>Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ bộ phận chăm sóc khách hàng của chúng tôi qua số
                        điện thoại <a href="tel:+123456789">+123 456 789</a> hoặc email <a
                            href="mailto:support@example.com">support@example.com</a>.</p>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="return-form">
                    <h2>Yêu Cầu Đổi Trả</h2>
                    <form id="returnsOrderForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="orders_id" value="{{ $order->id }}">

                        <div class="form-group">
                            <label for="productSelect">Chọn Sản Phẩm</label>
                            <select class="form-control" id="productSelect" name="product_id" required>
                                <option value="" disabled selected>-- Chọn sản phẩm --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->product_id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="statusSelect">Tình Trạng Sản Phẩm</label>
                            <select class="form-control" id="statusSelect" name="status" required>
                                <option value="" disabled selected>-- Chọn tình trạng --</option>
                                <option value="Đã sử dụng">Đã sử dụng</option>
                                <option value="Chưa sử dụng">Chưa sử dụng</option>
                                <option value="Còn nguyên mác">Còn nguyên mác</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="reasonSelect">Lý Do Đổi Trả</label>
                            <select class="form-control" id="reasonSelect" name="reason" required>
                                <option value="" disabled selected>-- Chọn lý do --</option>
                                <option value="Sản phẩm bị lỗi">Sản phẩm bị lỗi</option>
                                <option value="Sản phẩm không đúng mô tả">Sản phẩm không đúng mô tả</option>
                                <option value="Giao sai hàng">Giao sai hàng</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="detailsTextarea">Mô Tả Chi Tiết</label>
                            <textarea class="form-control" id="detailsTextarea" name="details" rows="4"
                                placeholder="Vui lòng cung cấp thông tin chi tiết về yêu cầu đổi trả..."
                                required></textarea>
                        </div>

                        <!-- Hình ảnh 1 -->
                        <div class="form-group">
                            <label for="imageUpload1">Chọn Hình Ảnh 1</label>
                            <input type="file" class="form-control-file" id="imageUpload1" name="image1"
                                accept="image/*" onchange="previewImage(event, 'imagePreview1')" required>
                            <img id="imagePreview1" src="#" alt="Hình ảnh 1"
                                style="display: none; margin-top: 10px; width: 100px;">
                        </div>

                        <!-- Hình ảnh 2 -->
                        <div class="form-group">
                            <label for="imageUpload2">Chọn Hình Ảnh 2</label>
                            <input type="file" class="form-control-file" id="imageUpload2" name="image2"
                                accept="image/*" onchange="previewImage(event, 'imagePreview2')" required>
                            <img id="imagePreview2" src="#" alt="Hình ảnh 2"
                                style="display: none; margin-top: 10px; width: 100px;">
                        </div>

                        <div class="form-group">
                            <label for="refund_method">Hoàn Tiền Qua Ngân Hàng</label>
                            <select id="refund_method" class="form-control" name="banking_id" required>
                                <option value="null">Chọn ngân hàng</option>
                                @foreach($bankAccounts as $account)
                                    <option value="{{ $account->id }}" data-holder="{{ $account->card_holder_name }}">
                                        {{ $account->bank_name }} - ***{{ substr($account->card_number, -3) }} -
                                        {{ $account->card_holder_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Số điện thoại -->
                        <div class="form-group">
                            <label for="phone_number">Số Điện Thoại</label>
                            <input type="text" id="phone_number" class="form-control" name="phone"
                                placeholder="Nhập số điện thoại của bạn" required pattern="\d{10}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-returns_order">Gửi Yêu Cầu</button>
                            <button type="submit" class="btn btn-primary btn-back">Quay lại</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </section>
</main>
<script src="{{ asset('js/order_details.js') }}"></script>
@endsection