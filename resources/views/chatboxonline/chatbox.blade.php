<div class="chatbox">
    <button class="chatbox-toggle">
        <i class="image ti-headphone-alt"></i>
    </button>
    <div class="chatbox-content">
        <div class="chatbox-header">
            <h4>Hỗ trợ trực tuyến</h4>
            <div>
                <button class="reset-chatbox">
                    <i class="ti-back-right"></i>
                </button>
                <button class="close-chatbox">&times;</button>
            </div>
        </div>
        <div class="chatbox-messages">
            <div class="system-message col-6">Xin chào! Tôi có thể giúp gì cho bạn?</div>
            <!-- Tin nhắn sẽ hiển thị ở đây -->
        </div>
        <div class="chatbox-options">
            <button class="chat-option" data-message="Tư vấn mua hàng">Tư vấn mua hàng</button>
            <button class="chat-option" data-message="Chương trình khuyến mãi">Chương trình khuyến mãi</button>
            <button class="chat-option" data-message="Khác">Khác</button>
        </div>
        <div class="chatbox-input-container">
            <input type="text" placeholder="Nhập tin nhắn..." class="chatbox-input" style="display: none;">
            <button class="chatbox-send" style="display: none;">Gửi</button>
        </div>
    </div>
</div>

<!-- Include CSS and JS for the chatbox -->
<link rel="stylesheet" href="{{ asset('style/css/chatbox.css') }}">
<script src="{{ asset('style/js/chatbox.js') }}"></script>