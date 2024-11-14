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
            
            <div class="form-group">
                <label for="name">Category name</label>
                <input id="name" name="name" type="text" value="{{  $category->category_name }}" />
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input id="description" name="description" type="text" value="{{  $category->description }}" />
            </div>

            <div class="buttons">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('showCategories') }}" class="btn btn-secondary mx-2">Cancel</a>
            </div>
        </form>
    </div>

</body>

@endsection
