<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Student Management System'); ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }
        .navbar-brand { font-weight: 600; }
        .avatar-sm { width: 35px; height: 35px; border-radius: 50%; object-fit: cover; }
        
        /* ใส่ CSS ที่ใช้บ่อยๆ ตรงนี้ หรือแยกไฟล์ public/css/custom.css */
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

    <div class="container-fluid px-4">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/student/resources/views/layouts/login.blade.php ENDPATH**/ ?>