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
        <form action="{{ route('category.update', ['id' => $category->category_id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8" style="margin: 45px 0;">
                    <div class="form-group" style=" margin-bottom: 40px">
                        <label for="name">Category name</label>
                        <input id="name" name="name" type="text" value="{{  $category->category_name }}" />
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input id="description" name="description" type="text" value="{{  $category->description }}" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row justify-content-center" id="imagePlaceholderContainer"></div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <input type="file" name="image" id="imageInput" accept="image/jpeg, image/png"
                                class="btn btn-outline-secondary mb-2" style="display: none;">
                            <button class="btn btn-outline-secondary mb-2" id="chooseImageButton">Chọn ảnh</button>
                            <p class="file-info">Dung lượng file tối đa 1 MB<br>Định dạng: .JPEG, .PNG</p>
                            <input type="hidden" id="imageNames" name="imageNames" value="">
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('showCategories') }}" class="btn btn-secondary mx-2">Cancel</a>
                </div>
            </div>
        </form>
    </div>

</body>

@endsection