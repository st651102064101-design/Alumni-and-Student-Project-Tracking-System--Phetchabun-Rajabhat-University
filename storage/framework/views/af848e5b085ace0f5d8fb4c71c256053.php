
<aside class="yt-sidebar" id="ytSidebar">
    
    <div class="yt-sidebar-mini" id="sidebarMini">
        <a href="<?php echo e(url('/dashboard')); ?>" class="yt-mini-item <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>" title="หน้าหลัก">
            <i class="bi bi-house-door-fill"></i>
            <span>หน้าหลัก</span>
        </a>
        <a href="<?php echo e(url('/students')); ?>" class="yt-mini-item <?php echo e(request()->is('students*') ? 'active' : ''); ?>" title="นักศึกษา">
            <i class="bi bi-people-fill"></i>
            <span>นักศึกษา</span>
        </a>
        <a href="<?php echo e(url('/alumni')); ?>" class="yt-mini-item <?php echo e(request()->is('alumni*') ? 'active' : ''); ?>" title="ศิษย์เก่า">
            <i class="bi bi-mortarboard-fill"></i>
            <span>ศิษย์เก่า</span>
        </a>
        <a href="<?php echo e(url('/projects')); ?>" class="yt-mini-item <?php echo e(request()->is('projects*') ? 'active' : ''); ?>" title="โครงงาน">
            <i class="bi bi-folder-fill"></i>
            <span>โครงงาน</span>
        </a>
        <a href="<?php echo e(url('/internships')); ?>" class="yt-mini-item <?php echo e(request()->is('internships*') ? 'active' : ''); ?>" title="ฝึกงาน">
            <i class="bi bi-building"></i>
            <span>ฝึกงาน</span>
        </a>
        <a href="<?php echo e(url('/settings')); ?>" class="yt-mini-item <?php echo e(request()->is('settings*') ? 'active' : ''); ?>" title="จัดการ">
            <i class="bi bi-gear-fill"></i>
            <span>จัดการ</span>
        </a>
    </div>

    
    <div class="yt-sidebar-full" id="sidebarFull">
        
        <div class="yt-nav-section">
            <a href="<?php echo e(url('/dashboard')); ?>" class="yt-nav-item <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>">
                <i class="bi bi-house-door-fill"></i>
                <span>หน้าหลัก</span>
            </a>
        </div>

        <hr class="yt-divider">

        
        <div class="yt-nav-section">
            <h6 class="yt-section-title">จัดการข้อมูล</h6>
            
            
            <div class="yt-nav-group">
                <a href="#studentSubmenu" class="yt-nav-item yt-has-submenu <?php echo e(request()->is('students*') || request()->is('projects*') ? 'active' : ''); ?>" data-bs-toggle="collapse" aria-expanded="<?php echo e(request()->is('students*') || request()->is('projects*') ? 'true' : 'false'); ?>">
                    <i class="bi bi-people-fill"></i>
                    <span>จัดการนักศึกษา</span>
                    <i class="bi bi-chevron-down yt-arrow"></i>
                </a>
                <div class="collapse <?php echo e(request()->is('students*') || request()->is('projects*') ? 'show' : ''); ?>" id="studentSubmenu">
                    <div class="yt-submenu">
                        <a href="<?php echo e(url('/students')); ?>" class="yt-submenu-item <?php echo e(request()->is('students') ? 'active' : ''); ?>">
                            <span>รายชื่อนักศึกษา</span>
                        </a>
                        <a href="<?php echo e(url('projects')); ?>" class="yt-submenu-item <?php echo e(request()->is('projects*') ? 'active' : ''); ?>">
                            <span>โครงงานนักศึกษา</span>
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="yt-nav-group">
                <a href="#alumniSubmenu" class="yt-nav-item yt-has-submenu <?php echo e(request()->is('alumni*') ? 'active' : ''); ?>" data-bs-toggle="collapse" aria-expanded="<?php echo e(request()->is('alumni*') ? 'true' : 'false'); ?>">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span>จัดการศิษย์เก่า</span>
                    <i class="bi bi-chevron-down yt-arrow"></i>
                </a>
                <div class="collapse <?php echo e(request()->is('alumni*') ? 'show' : ''); ?>" id="alumniSubmenu">
                    <div class="yt-submenu">
                        <a href="<?php echo e(url('/alumni')); ?>" class="yt-submenu-item <?php echo e(request()->is('alumni') && !request()->is('alumni/*') ? 'active' : ''); ?>">
                            <span>รายชื่อศิษย์เก่า</span>
                        </a>
                    </div>
                </div>
            </div>

            
            <a href="<?php echo e(url('/internships')); ?>" class="yt-nav-item <?php echo e(request()->is('internships*') ? 'active' : ''); ?>">
                <i class="bi bi-building"></i>
                <span>สถานที่ฝึกงาน</span>
            </a>
        </div>

        <hr class="yt-divider">

        
        

        <hr class="yt-divider">

        
        <div class="yt-sidebar-footer">
            <div class="yt-footer-links">
                <a href="#">เกี่ยวกับ</a>
                <a href="#">นโยบาย</a>
                <a href="#">ติดต่อ</a>
            </div>
            <p class="yt-copyright">© 2026 EduSystem</p>
        </div>
    </div>
</aside>


<div class="yt-sidebar-overlay" id="sidebarOverlay"></div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/student/resources/views/components/sidebar.blade.php ENDPATH**/ ?>