@extends('viewAdmin.navigation')
@section('title', 'Contact')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Chatbox Support</h6>
                </div>
            </div>
            <div class="row p-3">
                <!-- Thanh tìm kiếm -->
            </div>
            <div class="chatbox-admin">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Khách Hàng</th>
                            <th>Số Điện Thoại</th>
                            <th>Vấn Đề Hỗ Trợ</th>
                            <th>Chi Tiết Vấn Đề</th>
                            <th>Ngày yêu cầu hỗ trợ</th>
                            <th>Tình Trạng</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody id="chatbox-data">
                        @foreach ($chatboxData as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->customer_name }}</td>
                                <td>{{ $data->customer_phone }}</td>
                                <td>{{ $data->support_issue }}</td>
                                <td>{{ $data->detailed_support_content }}</td>
                                <td>{{ $data->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <select class="status-select" data-id="{{ $data->id }}">
                                        <option value="Chờ hỗ trợ" {{ $data->status == 'Chờ hỗ trợ' ? 'selected' : '' }}>Chờ
                                            hỗ
                                            trợ
                                        </option>
                                        <option value="Đã xong" {{ $data->status == 'Đã xong' ? 'selected' : '' }}>Đã
                                            xong
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <button class="update-status" data-id="{{ $data->id }}">Cập nhật</button>
                                    @if ($data->status == 'Đã xong')
                                        <button class="delete-record" data-id="{{ $data->id }}">Xóa</button>
                                    @endif
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