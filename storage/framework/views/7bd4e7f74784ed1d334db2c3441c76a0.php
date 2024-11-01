<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Welcome to Home Page!</h1>
    <a href="<?php echo e(route('logout')); ?>" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>

    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Project-CDW2_24_nhomD\resources\views/viewUser/logout.blade.php ENDPATH**/ ?>