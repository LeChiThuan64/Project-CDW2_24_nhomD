<?php $__env->startSection('title', 'Tables'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
<div id="success-alert" class="alert alert-success" style="background-color: #d4edda; color: #155724;">
  <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<html>

<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>

  </style>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/blogs_admin.css')); ?>">
</head>

<body>
  <div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
      <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
        <h6 class="text-white text-capitalize ps-3">User table</h6>
      </div>
    </div>
    <div class="row p-3">
      <!-- Thanh tìm kiếm -->
      <div class="col-md-5">
        <form action="<?php echo e(route('admin.blog.index')); ?>" method="GET" class="search-form">
          <div class="input-group">
            <div class="input-group-prepend">
              <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
            <input type="text" name="query" class="form-control" placeholder="Tìm kiếm bài viết theo tên hoặc ID..."
              aria-label="Tìm kiếm bài viết" value="<?php echo e(request()->get('query')); ?>">
          </div>
        </form>
      </div>

      <div class="col-md-2 text-right">
        <a href="<?php echo e(route('admin.blog.create')); ?>" class="btn btn-outline-primary">
          <i class="fas fa-plus"></i>
        </a>
      </div>
    </div>

    <!-- Nút dấu cộng -->
  </div>

  <div class="blog-list">
    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <!-- Thêm, model -->
    <div class="blog-item" data-bs-toggle="modal" data-bs-target="#exampleModal"
      data-content="<?php echo e($blog->content); ?>" data-image-url="<?php echo e(asset($blog->image_url)); ?>">
      <img src="<?php echo e(asset($blog->image_url)); ?>" alt="Blog Image" width="100" height="100">

      <div class="blog-info">
        <p>id : <?php echo e($blog->blog_id); ?></p>
        <p>tên : <?php echo e($blog->title); ?></p>
        <p>nội dung : <?php echo e(Str::limit(strip_tags($blog->content), 100)); ?></p>
      </div>
      <div class="blog-actions">
        <button type="button" class="btn btn-primary">
          xem
        </button>
        <button onclick="window.location.href='<?php echo e(route('admin.blog.edit', $blog->blog_id)); ?>'" class="btn btn-outline-secondary">
          <i class="fas fa-edit"></i> Sửa
        </button>



        <form action="<?php echo e(route('admin.blog.destroy', $blog->blog_id)); ?>" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa blog này không?');" style="display:inline;">
          <?php echo csrf_field(); ?>
          <?php echo method_field('DELETE'); ?>
          <button type="submit" class="btn btn-outline-danger">
            <i class="fas fa-trash"></i> Xóa
          </button>
        </form>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Blog Content</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-content">
          <!-- Nội dung blog sẽ được cập nhật tại đây -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <script>
    // Script để ẩn thông báo sau 3 giây (3000ms)
    document.addEventListener('DOMContentLoaded', function() {
      setTimeout(function() {
        var alert = document.getElementById('success-alert');
        if (alert) {
          alert.style.display = 'none';
        }
      }, 3000); // 3000ms = 3 giây
    });

    // Script để hiển thị nội dung blog khi mở modal
    document.querySelectorAll('.blog-item').forEach(item => {
      item.addEventListener('click', function() {
        const content = this.getAttribute('data-content');
        const imageUrl = this.getAttribute('data-image-url');
        document.getElementById('modal-content').innerHTML = `<img src="${imageUrl}" alt="Blog Image"><div>${content}</div>`;
      });
    });
  </script>
</body>

</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('viewAdmin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project-CDW2_24_nhomD\resources\views/viewAdmin/blogs_admin.blade.php ENDPATH**/ ?>