<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Quản Lý Chatbox Online</title>
    <link rel="stylesheet" href="{{ asset('style/css/chatbox_admin.css') }}">
</head>

<body>
    <div class="container">
        <div class="chatbox-admin">
            <h1>Admin Quản Lý Chatbox Online</h1>
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
                                <option value="Chờ hỗ trợ" {{ $data->status == 'Chờ hỗ trợ' ? 'selected' : '' }}>Chờ hỗ
                                    trợ
                                </option>
                                <option value="Đã xong" {{ $data->status == 'Đã xong' ? 'selected' : '' }}>Đã xong
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
    <script src="{{ asset('style/js/chatbox-admin.js') }}"></script>
</body>

</html>