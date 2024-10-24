<?php $__env->startSection('title', $blog->title); ?>
<?php $__env->startSection('content'); ?>

<HEad>
  <STYle>
    .blog-image {
      max-width: 50%; /* Đặt kích thước tối đa của hình ảnh (thay đổi tùy ý) */
      height: auto; /* Giữ tỷ lệ của hình ảnh */
      margin: 0 auto; /* Căn giữa hình ảnh */
      display: block; /* Đảm bảo hình ảnh là phần tử khối */
    }

    .mw-930 p {
      font-size: 18px;
      line-height: 1.6;
    }

    .review-textt {
      font-size: 18px;
      line-height: 1.6;
    }
  </STYle>
</HEad>
<main>

  <div class="mb-4 pb-4"></div>
 
  <section class="blog-page blog-single container">
    <div class="mw-930">
      <h2 class="page-title"><?php echo e($blog->title); ?></h2>
      <div class="blog-single__item-meta">
        <span class="blog-single__item-meta__author">By Admin</span>
        <span class="blog-single__item-meta__date"><?php echo e($blog->created_at->format('F d, Y')); ?></span>
      </div>
    </div>

    <div class="blog-single__item-content">
      <p>
        <!-- Sử dụng class blog-image để căn giữa và điều chỉnh kích thước ảnh -->
        <img src="<?php echo e(Storage::url($blog->image_url)); ?>" alt="Blog Image" class="blog-image">
      </p>
      <div class="mw-930">
      <p><?php echo e(strip_tags($blog->content)); ?></p>

      </div>
    </div>

    <!-- Hiển thị các bình luận -->
    <div class="blog-single__reviews mw-930">
      <h2 class="blog-single__reviews-title">Comments</h2>

      <?php if($comments && count($comments) > 0): ?>
      <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="blog-single__reviews-item">
        <div class="customer-review">
          <h6><?php echo e($comment->name); ?></h6>
          <div class="review-date"><?php echo e($comment->created_at->format('F d, Y')); ?></div>
          <div class="review-textt">
            <p><?php echo e($comment->comment); ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
      <p>No comments yet. Be the first to comment!</p>
      <?php endif; ?>
    </div>

    <!-- Form gửi bình luận -->
    <div class="blog-single__review-form">
      <form action="<?php echo e(route('blog.comment', $blog->blog_id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
          <textarea id="form-input-review" class="form-control form-control_gray" name="comment" placeholder="Your Review" cols="30" rows="8" required></textarea>
        </div>
        <div class="form-label-fixed mb-4">
          <label for="form-input-name" class="form-label">Name *</label>
          <input id="form-input-name" class="form-control form-control-md form-control_gray" name="name" required>
        </div>
        <div class="form-label-fixed mb-4">
          <label for="form-input-email" class="form-label">Email address *</label>
          <input id="form-input-email" type="email" class="form-control form-control-md form-control_gray" name="email" required>
        </div>
        <div class="form-action">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </section>
</main>

<div class="mb-5 pb-xl-5"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('viewUser.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project-CDW2_24_nhomD\resources\views/viewUser/blogs_Detal.blade.php ENDPATH**/ ?>