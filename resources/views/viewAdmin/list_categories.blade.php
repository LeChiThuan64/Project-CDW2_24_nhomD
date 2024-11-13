@extends('viewAdmin.navigation')
@section('title', 'Manage categories')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">List Categories</h6>
                </div>
            </div>
            <div class="row p-3">
                <!-- Thanh tìm kiếm -->
                <div class="col-md-5">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" style="height: 42px;"
                                placeholder="Find categories..." aria-label="search-category" value="">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-2 text-right">
                    <a href="{{ route('category.showCreate') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>

            </div>
            <!-- Nút dấu cộng -->
        </div>
        @if (session('delete-success'))
        <div class="alert alert-success" id="success-message">
            {{ session('delete-success') }}
        </div>
        @endif
        @if (session('delete-failure'))
        <div class="alert alert-danger" id="failure-message">
            {{ session('delete-failure') }}
        </div>
        @endif

        @if (session('update-success'))
        <div class="alert alert-success" id="success-message">
            {{ session('update-success') }}
        </div>
        @endif
        @if (session('create-success'))
        <div class="alert alert-success" id="success-message">
            {{ session('create-success') }}
        </div>
        @endif
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category
                                name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Action</th>

                        </tr>
                    </thead>
                    <tbody id="user-data">
                        @foreach($categories as $category)
                        <tr>
                            <td class="align-middle text-center">

                                <span
                                    class="text-secondary text-xs font-weight-bold">{{ $category->category_id }}</span>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">

                                        <h6 class="mb-0 text-sm">{{ $category->category_name }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $category->description }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="actions" style="text-align: center;">

                                <form action="{{ route('category.destroy', ['id' => $category->category_id]) }}"
                                    method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm px-3"
                                        style="border-radius: 10px; font-size: 12px;"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>

                                <a href="{{ route('category.edit', ['id' => $category->category_id]) }}"
                                    class="btn btn-info btn-sm px-3" style="border-radius: 10px; font-size: 12px;">
                                    <i class="fas fa-edit"></i> Update
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection