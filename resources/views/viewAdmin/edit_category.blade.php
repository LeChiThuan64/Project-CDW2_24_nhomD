@extends('viewAdmin.navigation')

@section('title', 'Update Category')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('assets/css/edit_user.css') }}">
</head>

<body>
    <div class="container" style="margin-top:-150px">
        <div class="header">Update Category</div>
        <!-- <div class="sub-header">Quản lý thông tin hồ sơ để bảo mật tài khoản</div> -->
        <form action="{{ route('category.update', ['id' => $category->category_id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-8" style="margin: 45px 0;">
            <div class="form-group" style="margin-bottom: 40px">
                <label for="name">Category name</label>
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $category->category_name) }}" />
                <!-- Hiển thị lỗi -->
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input id="description" name="description" type="text" 
                       class="form-control @error('description') is-invalid @enderror" 
                       value="{{ old('description', $category->description) }}" />
                <!-- Hiển thị lỗi -->
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="row justify-content-center" id="imagePlaceholderContainer"></div>
            <div class="row">
                <div class="col-12 text-center">
                    <input type="file" name="image" id="imageInput" accept="image/jpeg, image/png" 
                           class="btn btn-outline-secondary mb-2 @error('image') is-invalid @enderror" style="display: none;">
                    <button type="button" class="btn btn-outline-secondary mb-2" id="chooseImageButton">Choose image</button>
                    <p class="file-info">Max file size: 1MB<br>Formats: .JPEG, .PNG</p>
                    <!-- Hiển thị lỗi -->
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('showCategories') }}" class="btn btn-secondary mx-2">Cancel</a>
        </div>
    </div>
</form>

    </div>

</body>

@endsection