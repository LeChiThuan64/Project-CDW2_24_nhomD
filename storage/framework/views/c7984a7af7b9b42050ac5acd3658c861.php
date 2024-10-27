<?php $__env->startSection('title', 'Blogs_'); ?>
<?php $__env->startSection('content'); ?>

<head>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/blog_list.css')); ?>">

</head>
<main>
  <section class="blog-page-title mb-4 mb-xl-5">
    <div class="title-bg">
      <img loading="lazy" src="<?php echo e(asset('assets/img/images_user/blog_title_bg.jpg')); ?>" width="1780" height="420" alt="Blog Title">
    </div>
    <div class="container">
      <h2 class="page-title">The Blog</h2>
      <div class="blog__filter">
        <a href="#" class="menu-link menu-link_us-s">ALL</a>
        <a href="#" class="menu-link menu-link_us-s">COMPANY</a>
        <a href="#" class="menu-link menu-link_us-s menu-link_active">FASHION</a>
        <a href="#" class="menu-link menu-link_us-s">STYLE</a>
        <a href="#" class="menu-link menu-link_us-s">TRENDS</a>
        <a href="#" class="menu-link menu-link_us-s">BEAUTY</a>
      </div>
    </div>
  </section>

  <section class="blog-page container">
    <h2 class="d-none">The Blog</h2>

    <div class="timkiem py-5">
    <?php echo csrf_field(); ?>

      <form action="<?php echo e(route('blog.index')); ?>" method="GET" class="search-form">
        <input type="text" name="query" placeholder="Tìm kiếm bài viết theo tên hoặc ID..." class="search-input">
        <button type="submit" class="search-button">
          <i class="fas fa-search"></i>
        </button>
      </form>


    </div>

    <div class="blog-grid row row-cols-1 row-cols-md-2 row-cols-xl-3">

      <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="blog-grid__item">
        <div class="blog-grid__item-image">
        <img src="<?php echo e(asset($blog->image_url)); ?>" alt="Blog Image" class="blog-image">
        </div>


        <div class="blog-grid__item-detail">
          <div class="blog-grid__item-meta">
            <span class="blog-grid__item-meta__author">By Admin</span>
            <span class="blog-grid__item-meta__date"><?php echo e($blog->created_at->format('F d, Y')); ?></span>
          </div>
          <div class="blog-grid__item-title">
            <a href="blog_single.html"><?php echo e($blog->title); ?></a>
          </div>
          <div class="blog-grid__item-content">
            <p><?php echo e(Str::limit(strip_tags($blog->content), 100)); ?></p>
            <a href="<?php echo e(route('blog.detail', ['blog_id' => $blog->blog_id])); ?>" class="btn-simple">Continue Reading</a>





          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    <!-- Hiển thị nút phân trang -->
    <div class="pagination-wrapper">
      <?php echo e($blogs->links('pagination::bootstrap-4')); ?> <!-- Laravel pagination links -->
    </div>


  </section>
</main>

<div class="mb-5 pb-xl-5"></div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('viewUser.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project-CDW2_24_nhomD\resources\views/viewUser/blog_list.blade.php ENDPATH**/ ?>