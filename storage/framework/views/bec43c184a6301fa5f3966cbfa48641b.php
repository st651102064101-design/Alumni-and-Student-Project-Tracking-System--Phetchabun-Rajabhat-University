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
        :root {
            --yt-sidebar-width: 240px;
            --yt-sidebar-mini-width: 72px;
            --yt-header-height: 56px;
            --yt-bg-primary: #ffffff;
            --yt-bg-secondary: #f2f2f2;
            --yt-bg-hover: #e5e5e5;
            --yt-bg-active: #e5e5e5;
            --yt-text-primary: #0f0f0f;
            --yt-text-secondary: #606060;
            --yt-border-color: #e5e5e5;
            --yt-accent-color: #065fd4;
        }

        body {
            font-family: 'Prompt', sans-serif;
            background-color: var(--yt-bg-secondary);
            color: var(--yt-text-primary);
            margin: 0;
            padding: 0;
        }

        /* ========== YouTube-Style Header/Navbar ========== */
        .yt-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--yt-header-height);
            background: var(--yt-bg-primary);
            border-bottom: 1px solid var(--yt-border-color);
            z-index: 1030;
            display: flex;
            align-items: center;
            padding: 0 16px;
        }

        .yt-header-start {
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 200px;
        }

        .yt-menu-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: transparent;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .yt-menu-btn:hover {
            background: var(--yt-bg-hover);
        }

        .yt-menu-btn i {
            font-size: 1.5rem;
            color: var(--yt-text-primary);
        }

        .yt-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            gap: 4px;
        }

        .yt-logo-icon {
            color: #ff0000;
            font-size: 1.8rem;
        }

        .yt-logo-text {
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--yt-text-primary);
            letter-spacing: -0.5px;
        }

        .yt-header-center {
            flex: 1;
            display: flex;
            justify-content: center;
            max-width: 720px;
            margin: 0 auto;
        }

        .yt-search-box {
            display: flex;
            width: 100%;
            max-width: 600px;
        }
        

        .yt-search-input {
            flex: 1;
            height: 40px;
            border: 1px solid var(--yt-border-color);
            border-right: none;
            border-radius: 20px 0 0 20px;
            padding: 0 16px;
            font-size: 1rem;
            outline: none;
            background: var(--yt-bg-primary);
            color: var(--yt-text-primary);
        }

        .yt-search-input:focus {
            border-color: var(--yt-accent-color);
        }

        .yt-search-btn {
            width: 64px;
            height: 40px;
            border: 1px solid var(--yt-border-color);
            border-radius: 0 20px 20px 0;
            background: var(--yt-bg-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .yt-search-btn:hover {
            background: var(--yt-bg-hover);
        }

        .yt-header-end {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            justify-content: flex-end;
        }

        .yt-icon-btn {
            width: 40px;
            height: 40px;
            min-width: 40px;
            border: none;
            background: transparent;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
            position: relative;
            flex-shrink: 0;
        }

        .yt-icon-btn:hover {
            background: var(--yt-bg-hover);
        }

        .yt-icon-btn i {
            font-size: 1.25rem;
            color: var(--yt-text-primary);
        }

        .yt-notification-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            background: #ff0000;
            color: white;
            font-size: 10px;
            font-weight: 500;
            padding: 1px 5px;
            border-radius: 10px;
            min-width: 16px;
            text-align: center;
        }

        .yt-user-btn {
            width: 32px;
            height: 32px;
            min-width: 32px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
            border: none;
            padding: 0;
            background: transparent;
            flex-shrink: 0;
            position: relative;
            z-index: 10;
        }

        .yt-user-btn:hover {
            opacity: 0.8;
        }

        .yt-user-btn img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ========== YouTube-Style Sidebar ========== */
        .yt-sidebar {
            position: fixed;
            top: var(--yt-header-height);
            left: 0;
            bottom: 0;
            width: var(--yt-sidebar-width);
            background: var(--yt-bg-primary);
            z-index: 1020;
            overflow-y: auto;
            overflow-x: hidden;
            transition: transform 0.2s ease, width 0.2s ease;
        }

        .yt-sidebar::-webkit-scrollbar {
            width: 8px;
        }

        .yt-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .yt-sidebar::-webkit-scrollbar-thumb {
            background: #909090;
            border-radius: 4px;
        }

        .yt-sidebar::-webkit-scrollbar-thumb:hover {
            background: #606060;
        }

        /* Mini Sidebar */
        .yt-sidebar-mini {
            display: none;
            flex-direction: column;
            align-items: center;
            padding: 4px 0;
        }

        .yt-mini-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 74px;
            text-decoration: none;
            color: var(--yt-text-primary);
            border-radius: 10px;
            margin: 0 4px;
            transition: background 0.2s;
        }

        .yt-mini-item:hover {
            background: var(--yt-bg-hover);
        }

        .yt-mini-item.active {
            background: var(--yt-bg-active);
        }

        .yt-mini-item i {
            font-size: 1.25rem;
            margin-bottom: 4px;
        }

        .yt-mini-item span {
            font-size: 10px;
            text-align: center;
            line-height: 1.2;
        }

        /* Full Sidebar */
        .yt-sidebar-full {
            padding: 12px 12px;
        }

        .yt-nav-section {
            margin-bottom: 12px;
        }

        .yt-section-title {
            font-size: 12px;
            font-weight: 500;
            color: var(--yt-text-secondary);
            padding: 8px 12px 4px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .yt-nav-item {
            display: flex;
            align-items: center;
            padding: 0 12px;
            height: 40px;
            text-decoration: none;
            color: var(--yt-text-primary);
            border-radius: 10px;
            transition: background 0.2s;
            gap: 24px;
            position: relative;
        }

        .yt-nav-item:hover {
            background: var(--yt-bg-hover);
            color: var(--yt-text-primary);
        }

        .yt-nav-item.active {
            background: var(--yt-bg-active);
            font-weight: 500;
        }

        .yt-nav-item i {
            font-size: 1.25rem;
            width: 24px;
            text-align: center;
        }

        .yt-nav-item span {
            font-size: 14px;
            white-space: nowrap;
        }

        .yt-has-submenu .yt-arrow {
            position: absolute;
            right: 12px;
            font-size: 12px;
            transition: transform 0.2s;
        }

        .yt-has-submenu[aria-expanded="true"] .yt-arrow {
            transform: rotate(180deg);
        }

        .yt-submenu {
            padding: 4px 0 4px 36px;
        }

        .yt-submenu-item {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: var(--yt-text-secondary);
            border-radius: 10px;
            font-size: 14px;
            transition: background 0.2s, color 0.2s;
        }

        .yt-submenu-item:hover {
            background: var(--yt-bg-hover);
            color: var(--yt-text-primary);
        }

        .yt-submenu-item.active {
            background: var(--yt-bg-active);
            color: var(--yt-text-primary);
            font-weight: 500;
        }

        .yt-divider {
            border: none;
            border-top: 1px solid var(--yt-border-color);
            margin: 12px 0;
        }

        .yt-sidebar-footer {
            padding: 12px;
            margin-top: 12px;
        }

        .yt-footer-links {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 12px;
        }

        .yt-footer-links a {
            font-size: 12px;
            color: var(--yt-text-secondary);
            text-decoration: none;
        }

        .yt-footer-links a:hover {
            color: var(--yt-text-primary);
        }

        .yt-copyright {
            font-size: 12px;
            color: var(--yt-text-secondary);
            margin: 0;
        }

        /* Sidebar Overlay (Mobile) */
        .yt-sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1015;
        }

        /* ========== Main Content Area ========== */
        .yt-main {
            margin-left: var(--yt-sidebar-width);
            margin-top: var(--yt-header-height);
            padding: 24px;
            min-height: calc(100vh - var(--yt-header-height));
            transition: margin-left 0.2s ease;
        }

        /* Desktop: allow collapsing the sidebar via the menu button */
        body.yt-sidebar-collapsed .yt-sidebar {
            transform: translateX(-100%);
        }

        body.yt-sidebar-collapsed .yt-main {
            margin-left: 0;
        }

        /* ========== User Dropdown ========== */
        .yt-user-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 300px;
            background: var(--yt-bg-primary);
            border-radius: 12px;
            box-shadow: 0 4px 32px rgba(0, 0, 0, 0.1), 0 0 0 1px var(--yt-border-color);
            z-index: 1040;
            display: none;
            max-height: calc(100vh - var(--yt-header-height) - 24px);
            overflow-x: hidden;
            overflow-y: auto;
        }

        .yt-user-dropdown.show {
            display: block;
        }

        .yt-user-dropdown-header {
            display: flex;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid var(--yt-border-color);
            gap: 16px;
        }

        .yt-user-dropdown-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .yt-user-dropdown-info h6 {
            margin: 0;
            font-weight: 500;
            font-size: 16px;
            color: var(--yt-text-primary);
        }

        .yt-user-dropdown-info p {
            margin: 0;
            font-size: 14px;
            color: var(--yt-text-secondary);
        }

        .yt-user-dropdown-link {
            display: block;
            padding: 4px 0;
            color: var(--yt-accent-color);
            font-size: 14px;
            text-decoration: none;
        }

        .yt-user-dropdown-link:hover {
            text-decoration: underline;
        }

        .yt-user-dropdown-menu {
            padding: 8px 0;
        }

        .yt-user-dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            text-decoration: none;
            color: var(--yt-text-primary);
            gap: 16px;
            transition: background 0.2s;
        }

        .yt-user-dropdown-item:hover {
            background: var(--yt-bg-hover);
        }

        .yt-user-dropdown-item i {
            font-size: 1.25rem;
            width: 24px;
            text-align: center;
            color: var(--yt-text-secondary);
        }

        .yt-user-dropdown-item span {
            font-size: 14px;
        }

        .yt-user-dropdown-divider {
            border: none;
            border-top: 1px solid var(--yt-border-color);
            margin: 8px 0;
        }

        /* ========== Notification Dropdown ========== */
        .yt-notification-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 360px;
            max-height: 500px;
            background: var(--yt-bg-primary);
            border-radius: 12px;
            box-shadow: 0 4px 32px rgba(0, 0, 0, 0.1), 0 0 0 1px var(--yt-border-color);
            z-index: 1040;
            display: none;
            overflow: hidden;
        }

        .yt-notification-dropdown.show {
            display: block;
        }

        .yt-notification-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            border-bottom: 1px solid var(--yt-border-color);
        }

        .yt-notification-header h6 {
            margin: 0;
            font-weight: 500;
            font-size: 16px;
        }

        .yt-notification-body {
            max-height: 400px;
            overflow-y: auto;
        }

        .yt-notification-item {
            display: flex;
            padding: 12px 16px;
            gap: 12px;
            border-bottom: 1px solid var(--yt-border-color);
            transition: background 0.2s;
            cursor: pointer;
        }

        .yt-notification-item:hover {
            background: var(--yt-bg-hover);
        }

        .yt-notification-item.unread {
            background: rgba(6, 95, 212, 0.05);
        }

        .yt-notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--yt-bg-secondary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .yt-notification-content h6 {
            margin: 0 0 4px;
            font-size: 14px;
            font-weight: 500;
        }

        .yt-notification-content p {
            margin: 0;
            font-size: 13px;
            color: var(--yt-text-secondary);
        }

        .yt-notification-time {
            font-size: 12px;
            color: var(--yt-text-secondary);
        }

        /* ========== Responsive Styles ========== */
        
        /* Mini sidebar mode (Medium screens) */
        @media (max-width: 1312px) {
            .yt-sidebar {
                width: var(--yt-sidebar-mini-width);
            }

            .yt-sidebar-mini {
                display: flex;
            }

            .yt-sidebar-full {
                display: none;
            }

            .yt-main {
                margin-left: var(--yt-sidebar-mini-width);
            }
        }

        /* Sidebar expanded on hover/click for medium screens */
        @media (max-width: 1312px) {
            .yt-sidebar.expanded {
                width: var(--yt-sidebar-width);
                box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            }

            .yt-sidebar.expanded .yt-sidebar-mini {
                display: none;
            }

            .yt-sidebar.expanded .yt-sidebar-full {
                display: block;
            }
        }

        /* Tablet & Smaller */
        @media (max-width: 1024px) {
            .yt-header-start {
                min-width: auto;
                gap: 12px;
            }

            .yt-logo-text {
                font-size: 1rem;
            }
        }

        /* Mobile (Hidden sidebar by default) */
        @media (max-width: 792px) {
            .yt-sidebar {
                transform: translateX(-100%);
                width: var(--yt-sidebar-width);
            }

            .yt-sidebar-mini {
                display: none !important;
            }

            .yt-sidebar-full {
                display: block !important;
            }

            .yt-sidebar.expanded {
                transform: translateX(0);
            }

            .yt-sidebar-overlay.show {
                display: block;
            }

            .yt-main {
                margin-left: 0;
            }

            .yt-header {
                padding: 0 8px;
                gap: 4px;
            }

            .yt-header-start {
                min-width: auto;
                gap: 8px;
            }

            .yt-header-center {
                display: none;
            }

            .yt-header-end {
                gap: 4px;
            }

            .yt-menu-btn {
                width: 36px;
                height: 36px;
            }

            .yt-icon-btn {
                width: 36px;
                height: 36px;
                min-width: 36px;
            }

            .yt-user-btn {
                width: 30px;
                height: 30px;
                min-width: 30px;
            }

            .yt-search-mobile-btn {
                display: flex !important;
            }

            .yt-notification-dropdown,
            .yt-user-dropdown {
                width: calc(100vw - 32px);
                right: -8px;
            }

            .yt-logo {
                gap: 2px;
            }

            .yt-logo-icon {
                font-size: 1.25rem;
            }

            .yt-logo-text {
                display: none;
            }
        }

        @media (min-width: 793px) {
            .yt-search-mobile-btn {
                display: none !important;
            }
        }

        /* ========== Dark Mode ========== */
        body.dark {
            --yt-bg-primary: #0f0f0f;
            --yt-bg-secondary: #181818;
            --yt-bg-hover: #272727;
            --yt-bg-active: #272727;
            --yt-text-primary: #f1f1f1;
            --yt-text-secondary: #aaaaaa;
            --yt-border-color: #303030;
            --yt-accent-color: #3ea6ff;
        }

        body.dark .yt-search-input {
            background: var(--yt-bg-secondary);
            color: var(--yt-text-primary);
        }

        body.dark .yt-search-btn {
            background: var(--yt-bg-hover);
        }

        /* ========== Legacy Styles for Cards ========== */
        .avatar-sm {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #007bff20;
        }

        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.07);
            background: var(--yt-bg-primary);
        }

        .btn-primary {
            background: linear-gradient(45deg, #007bff, #0056d6);
            border: none;
            border-radius: 10px;
            padding: 10px 16px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #0066e0, #004ac1);
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

    
    <header class="yt-header">
        
        <div class="yt-header-start">
            <button type="button" class="yt-menu-btn" id="menuToggle" title="เมนู">
                <i class="bi bi-list"></i>
            </button>
            <a href="<?php echo e(url('/')); ?>" class="yt-logo">
                <i class="bi bi-mortarboard-fill yt-logo-icon"></i>
                <span class="yt-logo-text">EduSystem</span>
            </a>
        </div>

        
        <div class="yt-header-center">
        </div>

        
        <div class="yt-header-end">
            
            <button class="yt-icon-btn yt-search-mobile-btn" id="mobileSearchBtn" style="display: none;">
                <i class="bi bi-search"></i>
            </button>

            
            <button type="button" class="yt-icon-btn" id="toggleDark" title="โหมดมืด/สว่าง">
                <i class="bi bi-moon" id="darkModeIcon"></i>
            </button>

            
            <div class="position-relative">
                <button type="button" class="yt-icon-btn" id="notificationBtn" title="การแจ้งเตือน">
                    <i class="bi bi-bell"></i>
                    <span class="yt-notification-badge">3</span>
                </button>
                
                
                <div class="yt-notification-dropdown" id="notificationDropdown">
                    <div class="yt-notification-header">
                        <h6>การแจ้งเตือน</h6>
                        <button class="btn btn-sm btn-link text-decoration-none">ทำเครื่องหมายว่าอ่านแล้ว</button>
                    </div>
                    <div class="yt-notification-body">
                        <div class="yt-notification-item unread">
                            <div class="yt-notification-icon">
                                <i class="bi bi-person-plus text-primary"></i>
                            </div>
                            <div class="yt-notification-content">
                                <h6>นักศึกษาใหม่ลงทะเบียน</h6>
                                <p>สมชาย ใจดี ได้ลงทะเบียนเข้าสู่ระบบ</p>
                                <span class="yt-notification-time">5 นาทีที่แล้ว</span>
                            </div>
                        </div>
                        <div class="yt-notification-item unread">
                            <div class="yt-notification-icon">
                                <i class="bi bi-folder text-warning"></i>
                            </div>
                            <div class="yt-notification-content">
                                <h6>โครงงานใหม่รออนุมัติ</h6>
                                <p>มีโครงงานใหม่ 2 รายการรอการอนุมัติ</p>
                                <span class="yt-notification-time">1 ชั่วโมงที่แล้ว</span>
                            </div>
                        </div>
                        <div class="yt-notification-item">
                            <div class="yt-notification-icon">
                                <i class="bi bi-check-circle text-success"></i>
                            </div>
                            <div class="yt-notification-content">
                                <h6>สำรองข้อมูลเสร็จสิ้น</h6>
                                <p>ระบบได้สำรองข้อมูลอัตโนมัติเรียบร้อยแล้ว</p>
                                <span class="yt-notification-time">เมื่อวานนี้</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="position-relative">
                <button type="button" class="yt-user-btn" id="userBtn">
                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode((auth()->user()->first_name ?? 'Admin') . '+' . (auth()->user()->last_name ?? 'User'))); ?>&background=0D8ABC&color=fff" alt="Profile">
                </button>

                
                <div class="yt-user-dropdown" id="userDropdown">
                    <div class="yt-user-dropdown-header">
                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode((auth()->user()->first_name ?? 'Admin') . '+' . (auth()->user()->last_name ?? 'User'))); ?>&background=0D8ABC&color=fff" class="yt-user-dropdown-avatar" alt="Profile">
                        <div class="yt-user-dropdown-info">
                            <h6><?php echo e((auth()->user()->first_name ?? 'Admin') . ' ' . (auth()->user()->last_name ?? 'User')); ?></h6>
                            <p><?php echo e(auth()->user()->email ?? 'admin@example.com'); ?></p>
                            <a href="<?php echo e(url('/profile')); ?>" class="yt-user-dropdown-link">จัดการบัญชีของคุณ</a>
                        </div>
                    </div>
                    <div class="yt-user-dropdown-menu">
                        <a href="<?php echo e(url('/profile')); ?>" class="yt-user-dropdown-item">
                            <i class="bi bi-person"></i>
                            <span>โปรไฟล์ของฉัน</span>
                        </a>
                        <a href="<?php echo e(url('/settings')); ?>" class="yt-user-dropdown-item">
                            <i class="bi bi-gear"></i>
                            <span>ตั้งค่า</span>
                        </a>
                        <hr class="yt-user-dropdown-divider">
                        <a href="#" class="yt-user-dropdown-item" id="darkModeToggleMenu">
                            <i class="bi bi-moon"></i>
                            <span>โหมดมืด</span>
                        </a>
                        <a href="<?php echo e(url('/help')); ?>" class="yt-user-dropdown-item">
                            <i class="bi bi-question-circle"></i>
                            <span>ช่วยเหลือ</span>
                        </a>
                        <hr class="yt-user-dropdown-divider">
                        <a href="<?php echo e(route('logout')); ?>" class="yt-user-dropdown-item">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>ออกจากระบบ</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    
    <?php echo $__env->make('components.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <main class="yt-main">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.body;
            
            // ========== Sidebar Toggle ==========
            const menuToggle = document.getElementById('menuToggle');
            const sidebar = document.getElementById('ytSidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            function toggleSidebar() {
                const w = window.innerWidth;
                if (w <= 792) {
                    body.classList.remove('yt-sidebar-collapsed');
                    if (sidebar) sidebar.classList.toggle('expanded');
                    if (sidebarOverlay) sidebarOverlay.classList.toggle('show');
                    return;
                }
                if (w <= 1312) {
                    body.classList.remove('yt-sidebar-collapsed');
                    if (sidebarOverlay) sidebarOverlay.classList.remove('show');
                    if (sidebar) sidebar.classList.toggle('expanded');
                    return;
                }
                if (sidebar) sidebar.classList.remove('expanded');
                if (sidebarOverlay) sidebarOverlay.classList.remove('show');
                body.classList.toggle('yt-sidebar-collapsed');
            }

            if (menuToggle) {
                menuToggle.addEventListener('click', toggleSidebar);
            }
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    if (sidebar) sidebar.classList.remove('expanded');
                    sidebarOverlay.classList.remove('show');
                    body.classList.remove('yt-sidebar-collapsed');
                });
            }

            window.addEventListener('resize', function() {
                const w = window.innerWidth;
                if (sidebarOverlay && w > 792) sidebarOverlay.classList.remove('show');
                if (w <= 1312) body.classList.remove('yt-sidebar-collapsed');
            });

            // ========== Dark Mode Toggle ==========
            const toggleDark = document.getElementById('toggleDark');
            const darkModeIcon = document.getElementById('darkModeIcon');
            const darkModeToggleMenu = document.getElementById('darkModeToggleMenu');

            function toggleDarkMode() {
                body.classList.toggle('dark');
                const isDark = body.classList.contains('dark');
                if (darkModeIcon) darkModeIcon.className = isDark ? 'bi bi-sun' : 'bi bi-moon';
                localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
            }

            if (toggleDark) {
                toggleDark.addEventListener('click', toggleDarkMode);
            }
            if (darkModeToggleMenu) {
                darkModeToggleMenu.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleDarkMode();
                });
            }

            // Load saved dark mode preference
            if (localStorage.getItem('darkMode') === 'enabled') {
                body.classList.add('dark');
                if (darkModeIcon) darkModeIcon.className = 'bi bi-sun';
            }

            // ========== Notification Dropdown ==========
            const notificationBtn = document.getElementById('notificationBtn');
            const notificationDropdown = document.getElementById('notificationDropdown');

            // ========== User Dropdown ==========
            const userBtn = document.getElementById('userBtn');
            const userDropdown = document.getElementById('userDropdown');

            if (notificationBtn && notificationDropdown) {
                notificationBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    notificationDropdown.classList.toggle('show');
                    if (userDropdown) userDropdown.classList.remove('show');
                });
            }

            if (userBtn && userDropdown) {
                userBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('show');
                    if (notificationDropdown) notificationDropdown.classList.remove('show');
                });
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                if (notificationDropdown) notificationDropdown.classList.remove('show');
                if (userDropdown) userDropdown.classList.remove('show');
            });

            // Prevent dropdown close when clicking inside
            if (notificationDropdown) {
                notificationDropdown.addEventListener('click', function(e) { e.stopPropagation(); });
            }
            if (userDropdown) {
                userDropdown.addEventListener('click', function(e) { e.stopPropagation(); });
            }

            // ========== Mobile Search ==========
            const mobileSearchBtn = document.getElementById('mobileSearchBtn');
            if (mobileSearchBtn) {
                mobileSearchBtn.addEventListener('click', function() {
                    const query = prompt('ค้นหา:');
                    if (query) {
                        window.location.href = '/search?q=' + encodeURIComponent(query);
                    }
                });
            }
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/student/resources/views/layouts/app.blade.php ENDPATH**/ ?>