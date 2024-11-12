@extends('viewAdmin.navigation')

@section('title', 'Create Category')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('assets/css/edit_user.css') }}">
</head>

<body>
    <div class="container" style="margin-top:-150px">
        <div class="header">Create Category</div>
        <!-- <div class="sub-header">Quản lý thông tin hồ sơ để bảo mật tài khoản</div> -->
        <form action="{{ route('category.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="name">Category name</label>
                <input id="name" name="name" type="text" />
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input id="description" name="description" type="text" />
            </div>

            <div class="buttons">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('showCategories') }}" class="btn btn-secondary mx-2">Cancel</a>
            </div>
        </form>
    </div>

</body>

@endsection
