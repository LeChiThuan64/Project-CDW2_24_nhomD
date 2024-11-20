@extends('viewAdmin.navigation')

@section('title', 'Edit Blog')

@section('content')
<head>


    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/addblog.css') }}">

</head>
<div class="container">
    <div class="form-title">Sửa Blog</div>

    <form id="blog-form" action="{{ route('admin.blog.update', $blog->blog_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="form-left">
                <label for="title">Tên Blog</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ $blog->title }}" required>

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
                <div id="editor-container"></div> <!-- Để nội dung Quill rỗng ở đây -->
            </div>

            <div class="form-right">
                <img src="{{ asset($blog->image_url) }}" alt="Ảnh" id="image-preview" style="max-width: 100%;">
                <label for="image">Chọn ảnh mới</label>
                <input type="file" id="image" name="image" accept="image/jpeg, image/png" onchange="previewImage(event)">
                <p>Dung lượng file tối đa 1 MB<br>Định dạng: .JPEG, .PNG</p>
            </div>
        </div>
        <button type="button" class="btn btn-danger" onclick="window.history.back();">Hủy</button>
        <div class="form-footer">
            <button type="submit" class="btn btn-success">Cập nhật Blog</button>
        </div>
    </form>
</div>

<!-- Quill và Script tùy chỉnh -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    // Khởi tạo Quill và đặt nội dung từ $blog->content
    var quill = new Quill('#editor-container', {
        modules: { toolbar: '#toolbar' },
        theme: 'snow'
    });

    // Đặt nội dung hiện có của blog vào Quill
    quill.root.innerHTML = `{!! $blog->content !!}`;

    // Chuyển nội dung từ Quill vào form khi submit
    document.getElementById('blog-form').onsubmit = function(event) {
        let contentHtml = quill.root.innerHTML;
        const contentInput = document.createElement('input');
        contentInput.setAttribute('type', 'hidden');
        contentInput.setAttribute('name', 'content');
        contentInput.value = contentHtml;
        this.appendChild(contentInput);
    }

    // Preview hình ảnh khi chọn file
    function previewImage(event) {
        var file = event.target.files[0];
        if (file.size > 1048576) {
            alert('Dung lượng file quá lớn. Vui lòng chọn file dưới 1MB.');
            event.target.value = '';
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
</script>
@endsection
