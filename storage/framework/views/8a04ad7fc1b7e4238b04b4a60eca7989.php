

<?php $__env->startSection('content'); ?>
<style>
    body {
        background: linear-gradient(135deg, #e8effd, #f8faff);
        font-family: 'Prompt', sans-serif;
    }

    .login-card {
        border: none;
        border-radius: 20px;
        padding: 2.2rem;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .brand-title {
        font-size: 2rem;
        font-weight: 600;
        color: #2463EB;
    }

    .btn-primary {
        background: linear-gradient(45deg, #3b82f6, #2563eb);
        border: none;
        border-radius: 10px;
        padding: 10px 0;
        font-weight: 500;
        box-shadow: 0 3px 10px rgba(37, 99, 235, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #2563eb, #1e40af);
    }

    .form-control {
        border-radius: 10px;
        padding: 10px 14px;
        border: 1px solid #d3d8e0;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 0.15rem rgba(37, 99, 235, 0.25);
    }

    .show-btn {
        border-radius: 10px;
        border-left: none;
    }

    .copyright {
        color: #6b7280;
        font-size: 0.85rem;
    }

    .forgot-link {
        color: #2563eb;
        text-decoration: none;
        font-weight: 500;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }
</style>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-5">

            <div class="login-card">
 
                <!-- Logo + Title -->
                <div class="text-center mb-4">
                    <h2 class="brand-title">Login</h2>
                    <p class="text-muted mb-1">กรุณาเข้าสู่ระบบ</p>
                </div>

                <!-- Login Form -->
                <form id="loginForm" class="needs-validation" novalidate
                    action="<?php echo e(route('login.verify')); ?>" method="post">
                    <?php echo csrf_field(); ?>

                    <!-- Username -->
                    <div class="mb-3">
                        <label class="form-label">ชื่อผู้ใช้งาน</label>
                        <input 
                            type="text" 
                            class="form-control"
                            id="username" 
                            name="username"
                            placeholder="กรอกชื่อผู้ใช้งาน"
                            required
                            value="651102064107"
                        >
                        <div class="invalid-feedback">กรุณากรอกชื่อผู้ใช้งาน</div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">รหัสผ่าน</label>
                        <div class="input-group">
                            <input 
                                type="password" 
                                class="form-control"
                                id="inputPassword" 
                                name="password"
                                placeholder="กรอกรหัสผ่าน"
                                required minlength="6"
                                value="0620352916"
                            >
                            <button type="button" class="btn btn-outline-secondary show-btn" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                            <div class="invalid-feedback">รหัสผ่านอย่างน้อย 6 ตัวอักษร</div>
                        </div>
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                            <label class="form-check-label" for="rememberMe">จำฉันไว้</label>
                        </div>
                        <a href="#" class="forgot-link">ลืมรหัสผ่าน?</a>
                    </div>

                    <!-- Button -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                    </div>

                </form>

            </div>

            <div class="text-center mt-3 copyright">
                © <span id="year"></span> MyApp — All rights reserved
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
    // Copyright year
    document.getElementById('year').textContent = new Date().getFullYear();

    // Toggle Password
    const toggle = document.getElementById('togglePassword');
    const pwd = document.getElementById('inputPassword');

    toggle.addEventListener('click', () => {
        const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
        pwd.setAttribute('type', type);
        toggle.innerHTML = type === 'password'
            ? '<i class="bi bi-eye"></i>'
            : '<i class="bi bi-eye-slash"></i>';
    });

    // Validation
    (function() {
        "use strict";
        const form = document.getElementById("loginForm");
        form.addEventListener("submit", function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add("was-validated");
        }, false);
    })();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/comscience/public_html/student/resources/views/authen/login.blade.php ENDPATH**/ ?>