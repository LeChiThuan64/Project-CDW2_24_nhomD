<?php $__env->startSection('title', 'Register'); ?>
<?php $__env->startSection('content'); ?>

<!-- Register Form -->
<div id="register-container" class="form-container active">
    <form id="register-form" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <input type="text" name="name" id="name" placeholder="Username" required>
            <span class="text-danger" id="name-error"></span> <!-- Vị trí hiển thị lỗi -->
        </div>

        <div class="form-group">
            <input type="email" name="email" id="email" placeholder="Email address *" required>
            <span class="text-danger" id="email-error"></span> <!-- Vị trí hiển thị lỗi -->
        </div>

        <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Password *" required>
            <span class="text-danger" id="password-error"></span> <!-- Vị trí hiển thị lỗi -->
        </div>

        <div class="form-group">
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password *" required>
            <span class="text-danger" id="password-confirmation-error"></span> <!-- Vị trí hiển thị lỗi -->
        </div>

        <button type="submit" class="btn">REGISTER</button>
        <span class="text-danger" id="register-error"></span> <!-- Vị trí hiển thị lỗi tổng quát -->
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('viewUser.navLogin_Register', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project-CDW2_24_nhomD\resources\views/viewUser/register.blade.php ENDPATH**/ ?>