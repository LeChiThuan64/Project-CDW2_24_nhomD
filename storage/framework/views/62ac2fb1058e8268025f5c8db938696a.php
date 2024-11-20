<?php $__env->startSection('title', $blog->title); ?>
<?php $__env->startSection('content'); ?>

<HEad>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/blogs_Detal.css')); ?>">
</HEad>
<main>

  <div class="mb-4 pb-4"></div>

  <section class="blog-page blog-single container" style="font-family: Arial, sans-serif;">
    <div class="mw-930">
      <h2 class="page-title" style="font-family: Arial, sans-serif;"><?php echo e($blog->title); ?></h2>
      <div class="blog-single__item-meta">
        <span class="blog-single__item-meta__author">By Admin</span>
        <span class="blog-single__item-meta__date"><?php echo e($blog->created_at->format('F d, Y')); ?></span>
        <div class="contact-icon"><i class="fas fa-comments"></i> <span><?php echo e($blog->comments->count()); ?> Comments</span></div>


      </div>
    </div>

    <div class="blog-single__item-content">
      <p>
        <!-- Sử dụng class blog-image để căn giữa và điều chỉnh kích thước ảnh -->
        <img src="<?php echo e(asset($blog->image_url)); ?>" alt="Blog Image" class="blog-image">
      </p>
      <div class="blog-content mw-930" style="font-family: Arial, sans-serif;">
        <!-- <p><?php echo e(strip_tags($blog->content)); ?></p> -->
        <?php echo $blog->content; ?>


      </div>
    </div>

    <!-- Hiển thị các bình luận -->
    <div class="blog-single__reviews mw-930" style="font-family: Arial, sans-serif;">
      <h2 class="blog-single__reviews-title" style="padding-top: 10px;">Comments</h2>

      <?php if($comments && $comments->whereNull('parent_id')->count() > 0): ?>
      <?php
      $visibleComments = $comments->whereNull('parent_id')->sortByDesc('created_at')->take(3);
      ?>
      <!-- Hiển thị 3 bình luận gốc mới nhất -->
      <?php $__currentLoopData = $visibleComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="blog-single__reviews-item">
        <div class="customer-review">
          <h6>Tên : <?php echo e($comment->name); ?></h6>
          <div class="review-date"><?php echo e($comment->email); ?></div>
          <div class="review-date"><?php echo e($comment->created_at->format('F d, Y')); ?></div>
          <div class="review-textt">
            <p class="comment-content" data-full-content="<?php echo e($comment->comment); ?>">
              nội dung: <?php echo e(Str::limit($comment->comment, 50)); ?>

            </p>
            <?php if(strlen($comment->comment) > 50): ?>
            <button class="toggle-button" onclick="toggleContent(this)" style="
                               background-color: #007bff; 
                               color: white; 
                               border: none; 
                               padding: 8px 12px; 
                               font-size: 14px; 
                               border-radius: 4px; 
                               cursor: pointer; 
                               margin-top: 8px; 
                               margin-bottom: 30px;
                               transition: background-color 0.3s ease;">
              Xem thêm
            </button>
            <?php endif; ?>
          </div>

          <!-- Nút Trả lời -->
          <button onclick="showReplyForm(<?php echo e($comment->id); ?>, '<?php echo e($comment->name); ?>')" style="background-color: #f0ad4e; color: white; padding: 8px 12px;">
            Trả lời
          </button>

          <!-- Nút Xóa bình luận -->
          <?php if(auth()->guard()->check()): ?>
          <?php if($comment->user_id === auth()->id()): ?>
          <form action="<?php echo e(route('comment.delete', $comment->id)); ?>" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?')">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn btn-danger">Xóa</button>
          </form>
          <?php endif; ?>
          <?php endif; ?>



          <!-- Hiển thị phản hồi của bình luận cha -->
          <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="reply" style="margin-left: 20px; margin-top: 10px;">
            <h6>Tên : <?php echo e($reply->name); ?></h6>
            <div class="review-date"><?php echo e($reply->email); ?></div>
            <div class="review-date"><?php echo e($reply->created_at->format('F d, Y')); ?></div>

            <div class="review-textt">
              <p><?php echo e($reply->comment); ?></p>
            </div>

          </div>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <!-- Nút "Xem thêm comment" nếu có hơn 3 bình luận -->
      <?php if($comments->count() > 3): ?>
      <button id="showMoreButton" onclick="showAllComments()" style="background-color: #28a745; 
      color: white; border: none; padding: 10px 15px; font-size: 16px; 
      border-radius: 5px; cursor: pointer; margin: 15px; transition: 
      background-color 0.3s ease;">
        Xem thêm comment
      </button>
      <?php endif; ?>

      <!-- Phần hiển thị toàn bộ comment còn lại, mặc định ẩn -->
      <div id="allComments" style="display: none;">
        <?php $__currentLoopData = $comments->sortByDesc('created_at')->skip(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="blog-single__reviews-item">
          <div class="customer-review">
            <h6>Tên : <?php echo e($comment->name); ?></h6>
            <div class="review-date"><?php echo e($comment->email); ?></div>
            <div class="review-date"><?php echo e($comment->created_at->format('F d, Y')); ?></div>
            <div class="review-textt">
              <p class="comment-content" data-full-content="<?php echo e($comment->comment); ?>">
                nội dung: <?php echo e(Str::limit($comment->comment, 50)); ?>

              </p>
              <?php if(strlen($comment->comment) > 50): ?>
              <button class="toggle-button" onclick="toggleContent(this)" style="
                                   background-color: #007bff; 
                                   color: white; 
                                   border: none; 
                                   padding: 8px 12px; 
                                   font-size: 14px; 
                                   border-radius: 4px; 
                                   cursor: pointer; 
                                   margin-top: 8px; 
                                   margin-bottom: 30px;
                                   transition: background-color 0.3s ease;">
                Xem thêm
              </button>
              <?php endif; ?>
            </div>

            <!-- Nút Trả lời -->
            <button onclick="showReplyForm(<?php echo e($comment->id); ?>, '<?php echo e($comment->name); ?>')" style="background-color: #f0ad4e; color: white; padding: 8px 12px;">
              Trả lời
            </button>
            <!-- Nút Xóa bình luận -->
            <?php if(auth()->guard()->check()): ?>
            <?php if($comment->user_id === auth()->id()): ?>
            <form action="<?php echo e(route('comment.delete', $comment->id)); ?>" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bình luận này không?')">
              <?php echo csrf_field(); ?>
              <?php echo method_field('DELETE'); ?>
              <button type="submit" class="btn btn-danger">Xóa</button>
            </form>
            <?php endif; ?>
            <?php endif; ?>

            <!-- Hiển thị phản hồi của bình luận cha -->
            <?php $__currentLoopData = $comment->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="reply" style="margin-left: 20px; margin-top: 10px;">
              <h6>Tên : <?php echo e($reply->name); ?></h6>
              <div class="review-date"><?php echo e($reply->email); ?></div>
              <div class="review-date"><?php echo e($reply->created_at->format('F d, Y')); ?></div>
              <div class="review-textt">
                <p><?php echo e($reply->comment); ?></p>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php else: ?>
      <p>Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
      <?php endif; ?>
    </div>


    <!-- Form gửi bình luận -->
    <div id="mainCommentForm" class="blog-single__review-form">
      <form action="<?php echo e(route('blog.comment', $blog->blog_id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="parent_id" id="parent_id" value=""> <!-- ID của bình luận gốc nếu là trả lời -->
        <div class="mb-4">
          <textarea id="form-input-review" class="form-control form-control_gray" name="comment" placeholder="Your Review" cols="30" rows="8" required></textarea>
        </div>
        <?php if(auth()->guard()->guest()): ?>

        <!-- Hiển thị các trường name và email nếu người dùng chưa đăng nhập -->

        <div class="form-label-fixed mb-4">

          <label for="form-input-name" class="form-label">Name *</label>

          <input id="form-input-name" class="form-control form-control-md form-control_gray" name="name" required>

        </div>

        <div class="form-label-fixed mb-4">

          <label for="form-input-email" class="form-label">Email address *</label>

          <input id="form-input-email" type="email" class="form-control form-control-md form-control_gray" name="email" required>

        </div>

        <?php endif; ?>



        <?php if(auth()->guard()->check()): ?>

        <!-- Lấy name và email từ người dùng đã đăng nhập -->

        <input type="hidden" name="name" value="<?php echo e(auth()->user()->name); ?>">

        <input type="hidden" name="email" value="<?php echo e(auth()->user()->email); ?>">

        <?php endif; ?>



        <div class="form-action">

          <button type="submit" class="btn btn-primary">Submit</button>

        </div>

      </form>

    </div>
  </section>
</main>
<script>
  function toggleContent(button) {
    const contentElement = button.previousElementSibling;
    const fullContent = contentElement.getAttribute('data-full-content');
    const isExpanded = button.textContent === 'Thu gọn';

    if (isExpanded) {
      contentElement.textContent = 'nội dung: ' + fullContent.slice(0, 50) + '...';
      button.textContent = 'Xem thêm';
    } else {
      contentElement.textContent = 'nội dung: ' + fullContent;
      button.textContent = 'Thu gọn';
    }
  }

  function showAllComments() {
    document.getElementById('allComments').style.display = 'block';
    document.getElementById('showMoreButton').style.display = 'none';
  }

  function showReplyForm(commentId, userName) {
    // Đặt parent_id cho bình luận hiện tại
    document.getElementById('parent_id').value = commentId;
    // Cập nhật placeholder
    document.getElementById('form-input-review').placeholder = "Trả lời cho " + userName;

    // Di chuyển form đến vị trí dưới bình luận được trả lời
    const mainForm = document.getElementById("mainCommentForm");
    const commentDiv = document.getElementById("replyForm-" + commentId);
    commentDiv.parentNode.insertBefore(mainForm, commentDiv.nextSibling);

    mainForm.style.display = 'block';
    document.getElementById('form-input-review').focus();
  }
</script>

<div class="mb-5 pb-xl-5"></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('viewUser.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project-CDW2_24_nhomD\resources\views/viewUser/blogs_Detal.blade.php ENDPATH**/ ?>