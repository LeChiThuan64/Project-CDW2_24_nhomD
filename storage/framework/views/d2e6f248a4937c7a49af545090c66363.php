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
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      box-sizing: border-box;
    }

    .header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .search-container {
      display: flex;
      align-items: center;
      border: 1px solid #000;
      padding: 10px;
      flex-grow: 1;
      margin-right: 10px;
    }

    .search-container input {
      flex-grow: 1;
      border: none;
      outline: none;
      padding: 10px;
      font-size: 16px;
    }

    .search-container i {
      margin-right: 10px;
      font-size: 20px;
    }

    .add-button {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #000;
      padding: 10px;
      cursor: pointer;
      font-size: 20px;
    }

    .blog-list {
      border: 1px solid #000;
      padding: 10px;
    }

    .blog-item {
      display: flex;
      align-items: center;
      border: 1px solid #000;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 10px;
    }

    .blog-item img {
      width: 100px;
      height: 100px;
      border: 1px solid #000;
      margin-right: 10px;
    }

    .blog-item .blog-info {
      flex-grow: 1;
    }

    .blog-item .blog-info p {
      margin: 5px 0;
    }

    .blog-item .blog-actions {
      display: flex;
      align-items: center;
    }

    .blog-item .blog-actions button {
      background: none;
      border: 1px solid #000;
      padding: 5px 10px;
      margin-right: 10px;
      cursor: pointer;
      display: flex;
      align-items: center;
    }

    .blog-item .blog-actions button i {
      margin-right: 5px;
    }

    .blog-item .blog-actions .delete {
      background: none;
      border: none;
      font-size: 20px;
      cursor: pointer;
    }

    .pagination-wrapper {
      text-align: center;
      padding: 13px;
      margin-top: 20px;
    }

    .pagination {
      padding-left: 0;
    }

    .pagination li {
      display: inline;
      padding: 0 10px;
    }

    .pagination li a {
      color: #333;
      text-decoration: none;
      padding: 5px 10px;
      border: 1px solid #ddd;
    }
  </style>
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
    <div class="blog-item">
      <img src="<?php echo e(Storage::url($blog->image_url)); ?>" alt="Blog Image" width="100" height="100">

      <div class="blog-info">
        <p>id : <?php echo e($blog->blog_id); ?></p>
        <p>tên : <?php echo e($blog->title); ?></p>
        <p>nội dung : <?php echo e(Str::limit(strip_tags($blog->content), 100)); ?></p>
      </div>
      <div class="blog-actions">
        <button class="btn btn-outline-secondary">
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

  <!-- Pagination -->
  <div class="pagination-wrapper">
    <?php echo e($blogs->links('pagination::bootstrap-4')); ?> <!-- Sử dụng template bootstrap-4 cho phân trang -->
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
  </script>
</body>

</html>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('viewAdmin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project-CDW2_24_nhomD\resources\views/viewAdmin/blogs_admin.blade.php ENDPATH**/ ?>