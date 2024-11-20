<div class="chatbox">
    <button class="chatbox-toggle">
        <svg class="image_chatbox" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
            width="24px" fill="#ffffff">
            <path
                d="M240-400h480v-80H240v80Zm0-120h480v-80H240v80Zm0-120h480v-80H240v80ZM880-80 720-240H160q-33 0-56.5-23.5T80-320v-480q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v720ZM160-320h594l46 45v-525H160v480Zm0 0v-480 480Z" />
        </svg>
    </button>
    <div class="chatbox-content">
        <div class="chatbox-header">
            <h4>Hỗ trợ trực tuyến</h4>
            <div>
                <button class="reset-chatbox">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#000">
                        <path
                            d="M440-122q-121-15-200.5-105.5T160-440q0-66 26-126.5T260-672l57 57q-38 34-57.5 79T240-440q0 88 56 155.5T440-202v80Zm80 0v-80q87-16 143.5-83T720-440q0-100-70-170t-170-70h-3l44 44-56 56-140-140 140-140 56 56-44 44h3q134 0 227 93t93 227q0 121-79.5 211.5T520-122Z" />
                    </svg>
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
<link rel="stylesheet" href="{{ asset('assets/css/chatbox.css') }}">
<script src="{{ asset('assets/js/chatbox.js') }}"></script>