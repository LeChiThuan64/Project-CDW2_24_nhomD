<?php $__env->startSection('title', 'Tables'); ?>

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Blog</title>

    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/addblog.css')); ?>">

</head>

<body>

    <div class="container">
        <div class="form-title">Thêm Blog</div>

        <form id="blog-form" action="<?php echo e(route('admin.blog.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <!-- Form Left -->
                <div class="form-left">
                    <label for="title">Tên Blog</label>
                    <input type="text" id="title" name="title" placeholder="Nhập tên blog..." class="form-control" required>
                    <small id="title-error" class="text-danger" style="display: none;">Nhập quá 100 ký tự rồi.</small>
                    <label for="content">Nội dung</label>
                    <div id="toolbar">
                        <!-- Toolbar của Quill -->
                        <select class="ql-font"></select>
                        <select class="ql-size"></select>
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-underline"></button>
                        <button class="ql-strike"></button>
                        <select class="ql-align"></select>
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                        <button class="ql-image"></button>
                        <button class="ql-link"></button>
                    </div>
                    <div id="editor-container"></div>
                </div>

                <!-- Form Right -->
                <div class="form-right">
                    <img src="#" alt="Ảnh" id="image-preview">
                    <label for="image">Chọn ảnh</label>
                    <input type="file" id="image" name="image" accept="image/jpeg, image/png"
                        onchange="previewImage(event)">
                    <p>Dung lượng file tối đa 1 MB<br>Định dạng: .JPEG, .PNG</p>
                </div>
            </div>

           
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Hủy</button>
            <div class="form-footer">
                <button type="submit" class="btn btn-success">Thêm Blog</button>
            </div>
        </form>
    </div>


    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        // Cấu hình Quill với thanh toolbar tùy chỉnh
        var quill = new Quill('#editor-container', {
            modules: {
                toolbar: '#toolbar'
            },
            theme: 'snow'
        });

        // Preview hình ảnh khi chọn file và kiểm tra dung lượng file
        function previewImage(event) {
            var file = event.target.files[0];

            // Kiểm tra dung lượng file (giới hạn 1MB = 1048576 bytes)
            if (file.size > 1048576) {
                alert('Dung lượng file quá lớn. Vui lòng chọn file dưới 1MB.');
                event.target.value = ''; // Xóa file đã chọn
                return;
            }

            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }

        // Lưu nội dung Quill vào input ẩn khi submit form
        document.getElementById('blog-form').onsubmit = async function(event) {
            event.preventDefault();

            let contentHtml = quill.root.innerHTML;
            const formData = new FormData();

            // Tìm ảnh base64 trong nội dung và tải lên server
            const images = contentHtml.match(/<img src="data:image\/[^;]+;base64[^"]+"/g);
            if (images) {
                for (let i = 0; i < images.length; i++) {
                    const base64String = images[i].match(/src="([^"]+)"/)[1];

                    // Gửi ảnh lên server để lưu trữ
                    const response = await fetch('<?php echo e(route("upload.image")); ?>', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            image: base64String
                        })
                    });

                    const data = await response.json();
                    if (data.url) {
                        // Thay thế mã base64 bằng URL ảnh trên server
                        contentHtml = contentHtml.replace(base64String, data.url);
                    }
                }
            }

            // Thêm nội dung đã cập nhật vào form và gửi
            const contentInput = document.createElement('input');
            contentInput.setAttribute('type', 'hidden');
            contentInput.setAttribute('name', 'content');
            contentInput.value = contentHtml;
            this.appendChild(contentInput);

            this.submit();
        }
        document.getElementById('title').addEventListener('input', function() {
    const titleInput = document.getElementById('title');
    const errorMessage = document.getElementById('title-error');

    if (titleInput.value.length > 100) {
        errorMessage.style.display = 'block'; // Hiển thị thông báo lỗi
    } else {
        errorMessage.style.display = 'none'; // Ẩn thông báo lỗi nếu hợp lệ
    }
});

    </script>


    <?php $__env->stopSection(); ?>
<?php echo $__env->make('viewAdmin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project-CDW2_24_nhomD\resources\views/viewAdmin/add_blog.blade.php ENDPATH**/ ?>