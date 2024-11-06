document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 0;
    let userName = '';
    let userPhone = '';
    let supportIssue = '';
    let detailedSupportContent = '';

    // Sự kiện chọn "Chủ đề support"
    document.querySelectorAll('.chat-option').forEach(button => {
        button.addEventListener('click', function() {
            supportIssue = this.getAttribute('data-message');
            addMessage(supportIssue, 'customer-message');

            // Ẩn các nút lựa chọn sau khi nhấn
            document.querySelectorAll('.chat-option').forEach(btn => btn.style.display = 'none');
            console.log('Đã ẩn các nút lựa chọn');
            
            proceedToNextStep();
        });
    });

    // Hàm thêm tin nhắn vào phần chatbox
    function addMessage(text, messageType) {
        const messageElement = document.createElement('p');
        messageElement.textContent = text;
        messageElement.classList.add(messageType);
        document.querySelector('.chatbox-messages').appendChild(messageElement);
        scrollToBottom(); // Cuộn xuống cuối mỗi khi thêm tin nhắn mới
    }

    // Hàm điều hướng các bước hỏi thông tin khách hàng
    function proceedToNextStep() {
        const inputField = document.querySelector('.chatbox-input');
        const sendButton = document.querySelector('.chatbox-send');

        switch (currentStep) {
            case 0:
                addMessage("Hệ thống: Nội dung chi tiết cần hỗ trợ là gì?", 'system-message');
                inputField.style.display = 'block';
                sendButton.style.display = 'inline';
                inputField.value = '';
                inputField.placeholder = "Nhập chữ và số, không ký tự đặc biệt";
                currentStep++;
                break;
            case 1:
                const detail = inputField.value.trim();
                if (/^[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/.test(detail)) {
                    detailedSupportContent = detail;
                    addMessage(detailedSupportContent, 'customer-message');
                    addMessage("Hệ thống: Tên của bạn là gì?", 'system-message');
                    inputField.value = '';
                    inputField.placeholder = "Chỉ nhập chữ và dấu tiếng Việt";
                    currentStep++;
                } else {
                    addMessage("Hệ thống: Vui lòng chỉ nhập chữ cái, số và dấu tiếng Việt.", 'system-message');
                }
                break;
            case 2:
                const name = inputField.value.trim();
                if (/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/.test(name)) {
                    userName = name;
                    addMessage(userName, 'customer-message');
                    addMessage("Hệ thống: Số điện thoại của bạn là gì?", 'system-message');
                    inputField.value = '';
                    inputField.placeholder = "Chỉ nhập số, đủ 11 chữ số";
                    currentStep++;
                } else {
                    addMessage("Hệ thống: Vui lòng chỉ nhập chữ cái và dấu tiếng Việt.", 'system-message');
                }
                break;
            case 3:
                const phone = inputField.value.trim();
                if (/^\d{11}$/.test(phone)) {
                    userPhone = phone;
                    addMessage(userPhone, 'customer-message');
                    addMessage("Hệ thống: Cảm ơn bạn đã cung cấp thông tin. Nhân viên sẽ sớm liên hệ với bạn", 'system-message');
                    inputField.style.display = 'none';
                    sendButton.style.display = 'none';
                    saveChatboxData(userName, userPhone, supportIssue, detailedSupportContent);
                    currentStep = 0;
                } else {
                    addMessage("Hệ thống: Số điện thoại phải có đúng 11 chữ số.", 'system-message');
                }
                break;
        }
    }

    // Hàm lưu dữ liệu vào database
    function saveChatboxData(name, phone, issue, detail) {
        console.log('Dữ liệu gửi đi:', { name, phone, issue, detail });
        fetch('/api/save-chatbox-data', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                customer_name: name,
                customer_phone: phone,
                support_issue: issue,
                detailed_support_content: detail
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Dữ liệu đã được lưu thành công');
            } else {
                console.log('Có lỗi xảy ra khi lưu dữ liệu:', data.error);
            }
        })
        .catch(error => {
            console.error('Lỗi khi gửi dữ liệu:', error);
        });
    }

    // Xử lý sự kiện khi nhấn nút gửi
    document.querySelector('.chatbox-send').addEventListener('click', function() {
        proceedToNextStep();
    });

    // Xử lý sự kiện khi nhấn nút reset
    document.querySelector('.reset-chatbox').addEventListener('click', function() {
        document.querySelector('.chatbox-messages').innerHTML = '<div class="system-message col-6">Xin chào! Tôi có thể giúp gì cho bạn?</div>';
        document.querySelectorAll('.chat-option').forEach(btn => btn.style.display = 'block');
        document.querySelector('.chatbox-input').style.display = 'none';
        document.querySelector('.chatbox-send').style.display = 'none';
        currentStep = 0;
        userName = '';
        userPhone = '';
        supportIssue = '';
        detailedSupportContent = '';
    });

    // Hàm cuộn xuống cuối phần tử chứa tin nhắn
    function scrollToBottom() {
        const chatboxMessages = document.querySelector('.chatbox-messages');
        chatboxMessages.scrollTop = chatboxMessages.scrollHeight;
    }    
});