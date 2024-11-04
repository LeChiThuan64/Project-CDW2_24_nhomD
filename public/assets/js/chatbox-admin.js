document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.update-status').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const status = document.querySelector(`.status-select[data-id="${id}"]`).value;
            updateStatus(id, status);
        });
    });

    document.querySelectorAll('.delete-record').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            deleteRecord(id);
        });
    });

    function updateStatus(id, status) {
        fetch(`/admin/chatbox/update-status/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Tình trạng đã được cập nhật');
                location.reload();
            } else {
                alert('Có lỗi xảy ra');
            }
        });
    }

    function deleteRecord(id) {
        if (confirm('Bạn có chắc chắn muốn xóa bản ghi này?')) {
            fetch(`/admin/chatbox/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Bản ghi đã được xóa');
                    location.reload();
                } else {
                    alert('Có lỗi xảy ra');
                }
            });
        }
    }
});