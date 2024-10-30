<?php $__env->startSection('title', 'Tables'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
<div id="success-message" class="alert alert-success">
  <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div id="error-message" class="alert alert-danger">
  <?php echo e(session('error')); ?>

</div>
<?php endif; ?>
<head>
  <style>
    .avatar-large {
    width: 150px; /* Hoặc kích thước bạn muốn */
    height: 150px;
    border-radius: 10px; /* Giữ bo góc nếu cần */
}

  </style>
</head>



<div class="row">
  <div class="col-12">
    <div class="card my-4">
      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
          <h6 class="text-white text-capitalize ps-3">User table</h6>
        </div>
      </div>
      <div class="row p-3">
        <!-- Thanh tìm kiếm -->
        <div class="col-md-5">
          <form action="<?php echo e(url('/tables')); ?>" method="GET">
            <div class="input-group">
              <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
              <input type="text" name="search" class="form-control" placeholder="Tìm kiếm khách hàng..." aria-label="Tìm kiếm khách hàng" value="<?php echo e(request()->get('search')); ?>">
            </div>
          </form>
        </div>

        <div class="col-md-2 text-right">
          <a href="<?php echo e(route('user.create')); ?>" class="btn btn-outline-primary">
            <i class="fas fa-plus"></i>
          </a>
        </div>

      </div>


      <!-- Nút dấu cộng -->
    </div>

    <div class="card-body px-0 pb-2">
      <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
          <thead>
            <tr>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ và tên</th>
              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">sdt vs email</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
            </tr>
          </thead>
          <tbody id="user-data">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td class="align-middle text-center">

                <span class="text-secondary text-xs font-weight-bold"><?php echo e($user->id); ?></span>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div>
                    <!-- <img src="<?php echo e(asset('storage/' . $user->profile_image)); ?>" class="avatar avatar-sm me-3 border-radius-lg" alt="avatar"> -->
                    <img src="<?php echo e(asset($user->profile_image)); ?>" class="avatar avatar-sm me-3 border-radius-lg" alt="avatar">




                  </div>
                  <div class="d-flex flex-column justify-content-center">

                    <h6 class="mb-0 text-sm"><?php echo e($user->name); ?></h6>
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm"><?php echo e($user->phone); ?></h6>
                  </div>
                </div>
                <div class="d-flex px-2 py-1">
                  <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm"><?php echo e($user->email); ?></h6>
                  </div>
                </div>
              </td>
              <td class="align-middle text-center text-sm">
                <?php if($user->role == 0): ?>
                <span class="badge badge-sm bg-gradient-primary">Admin</span>
                <?php else: ?>
                <span class="badge badge-sm bg-gradient-success">User</span>
                <?php endif; ?>
              </td>
              <td class="actions" style="text-align: center;">
                <!-- <button type="button" class="btn btn-warning btn-sm px-3" style="border-radius: 5px; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="fas fa-eye"></i> Xem
                </button> -->
                <!-- <button type="button" class="btn btn-warning btn-sm px-3" style="border-radius: 5px; font-size: 14px;" data-id="<?php echo e($user->id); ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="fas fa-eye"></i> Xem
                </button> -->
                <button type="button" class="btn btn-warning btn-sm px-3" style="border-radius: 5px; font-size: 14px;"
                  data-id="<?php echo e($user->id); ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="fas fa-eye"></i> Xem
                </button>


                <form action="<?php echo e(route('user.destroy', $user->id)); ?>" method="POST" style="display: inline;">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('DELETE'); ?>
                  <button type="submit" class="btn btn-danger btn-sm px-3" style="border-radius: 5px; font-size: 14px;" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                    <i class="fas fa-trash"></i> Xóa
                  </button>
                </form>

                <a href="<?php echo e(route('user.edit', $user->id)); ?>" class="btn btn-info btn-sm px-3" style="border-radius: 5px; font-size: 14px;">
                  <i class="fas fa-edit"></i> Sửa
                </a>

              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Tên đăng nhập:</strong> <span id="username"></span></p>
        <p><strong>Email:</strong> <span id="email"></span></p>
        <p><strong>Số điện thoại:</strong> <span id="phone"></span></p>
        <p><strong>Giới tính:</strong> <span id="gender"></span></p>
        <p><strong>Ngày sinh:</strong> <span id="dob"></span></p>

        <img id="profileImage" src="<?php echo e(asset('path/to/default-image.jpg')); ?>" class="avatar-large" alt="avatar">
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Phân trang -->
<div class="d-flex justify-content-center mt-4" id="pagination">
  <ul class="pagination">
    
    <?php $__currentLoopData = $users->getUrlRange(1, $users->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($page == $users->currentPage()): ?>
    <li class="page-item active">
      <span class="page-link"><?php echo e($page); ?></span>
    </li>
    <?php else: ?>
    <li class="page-item">
      <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
    </li>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // hiển thông báo 3s
  setTimeout(function() {
    var successMessage = document.getElementById('success-message');
    if (successMessage) {
      successMessage.style.display = 'none';
    }

    var errorMessage = document.getElementById('error-message');
    if (errorMessage) {
      errorMessage.style.display = 'none';
    }
  }, 3000); // 3000 milliseconds = 3 giây


  $(document).on('click', '.pagination a', function(event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
    fetch_data(page);
  });

  function fetch_data(page) {
    $.ajax({
      url: "/tables?page=" + page,
      success: function(data) {
        $('#user-data').html($(data).find('#user-data').html()); // Cập nhật bảng người dùng
        $('#pagination').html($(data).find('#pagination').html()); // Cập nhật phân trang
      },
      error: function(xhr) {
        console.log(xhr.responseText); // Hiển thị lỗi nếu có
      }
    });
  }

  // Hiển thị model
  $(document).on('click', '.btn-warning', function() {
    var userId = $(this).data('id');
    $.ajax({
      url: `/users/${userId}`, // Route lấy dữ liệu người dùng
      type: 'GET',
      success: function(data) {
        // Cập nhật thông tin user trong modal
        $('#exampleModal .modal-title').text(data.name);
        $('#exampleModal #email').text(data.email);
        $('#exampleModal #phone').text(data.phone);
        $('#exampleModal #gender').text(data.gender);
       // Lấy phần ngày từ chuỗi ngày giờ
            let formattedDob = data.dob ? data.dob.split('T')[0] : '';
            $('#exampleModal #dob').text(formattedDob);

        // Sử dụng đường dẫn đầy đủ từ backend cho ảnh
        $('#profileImage').attr('src', data.profile_image);

        $('#exampleModal').modal('show');
      },
      error: function(xhr) {
        console.log(xhr.responseText);
      }
    });
  });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('viewAdmin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project-CDW2_24_nhomD\resources\views/viewAdmin/tables.blade.php ENDPATH**/ ?>