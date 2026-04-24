{{-- YouTube-Style Sidebar Component --}}
<aside class="yt-sidebar" id="ytSidebar">
    {{-- Mini Sidebar (collapsed) --}}
    <div class="yt-sidebar-mini" id="sidebarMini">
        <a href="{{ url('/dashboard') }}" class="yt-mini-item {{ request()->is('dashboard') ? 'active' : '' }}" title="หน้าหลัก">
            <i class="bi bi-house-door-fill"></i>
            <span>หน้าหลัก</span>
        </a>
        <a href="{{ url('/students') }}" class="yt-mini-item {{ request()->is('students*') ? 'active' : '' }}" title="นักศึกษา">
            <i class="bi bi-people-fill"></i>
            <span>นักศึกษา</span>
        </a>
        <a href="{{ url('/alumni') }}" class="yt-mini-item {{ request()->is('alumni*') ? 'active' : '' }}" title="ศิษย์เก่า">
            <i class="bi bi-mortarboard-fill"></i>
            <span>ศิษย์เก่า</span>
        </a>
        <a href="{{ url('/projects') }}" class="yt-mini-item {{ request()->is('projects*') ? 'active' : '' }}" title="โครงงาน">
            <i class="bi bi-folder-fill"></i>
            <span>โครงงาน</span>
        </a>
        <a href="{{ url('/settings') }}" class="yt-mini-item {{ request()->is('settings*') ? 'active' : '' }}" title="จัดการ">
            <i class="bi bi-gear-fill"></i>
            <span>จัดการ</span>
        </a>
    </div>

    {{-- Full Sidebar (expanded) --}}
    <div class="yt-sidebar-full" id="sidebarFull">
        {{-- Main Navigation --}}
        <div class="yt-nav-section">
            <a href="{{ url('/dashboard') }}" class="yt-nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i>
                <span>หน้าหลัก</span>
            </a>
        </div>

        <hr class="yt-divider">

        {{-- Student Management Section --}}
        <div class="yt-nav-section">
            <h6 class="yt-section-title">จัดการข้อมูล</h6>
            
            {{-- จัดการนักศึกษา --}}
            <div class="yt-nav-group">
                <a href="#studentSubmenu" class="yt-nav-item yt-has-submenu {{ request()->is('students*') || request()->is('projects*') ? 'active' : '' }}" data-bs-toggle="collapse" aria-expanded="{{ request()->is('students*') || request()->is('projects*') ? 'true' : 'false' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>จัดการนักศึกษา</span>
                    <i class="bi bi-chevron-down yt-arrow"></i>
                </a>
                <div class="collapse {{ request()->is('students*') || request()->is('projects*') ? 'show' : '' }}" id="studentSubmenu">
                    <div class="yt-submenu">
                        <a href="{{ url('/students') }}" class="yt-submenu-item {{ request()->is('students') ? 'active' : '' }}">
                            <span>รายชื่อนักศึกษา</span>
                        </a>
                        <a href="{{ url('projects') }}" class="yt-submenu-item {{ request()->is('projects*') ? 'active' : '' }}">
                            <span>โครงงานนักศึกษา</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- จัดการศิษย์เก่า --}}
            <div class="yt-nav-group">
                <a href="#alumniSubmenu" class="yt-nav-item yt-has-submenu {{ request()->is('alumni*') ? 'active' : '' }}" data-bs-toggle="collapse" aria-expanded="{{ request()->is('alumni*') ? 'true' : 'false' }}">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span>จัดการศิษย์เก่า</span>
                    <i class="bi bi-chevron-down yt-arrow"></i>
                </a>
                <div class="collapse {{ request()->is('alumni*') ? 'show' : '' }}" id="alumniSubmenu">
                    <div class="yt-submenu">
                        <a href="{{ url('/alumni') }}" class="yt-submenu-item {{ request()->is('alumni') && !request()->is('alumni/*') ? 'active' : '' }}">
                            <span>รายชื่อศิษย์เก่า</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="yt-divider">

        {{-- Quick Links --}}
        {{-- <div class="yt-nav-section">
            <h6 class="yt-section-title">ลิงก์ด่วน</h6>
            <a href="{{ url('/reports') }}" class="yt-nav-item {{ request()->is('reports*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-fill"></i>
                <span>รายงาน</span>
            </a>
            <a href="{{ url('/calendar') }}" class="yt-nav-item {{ request()->is('calendar*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event-fill"></i>
                <span>ปฏิทิน</span>
            </a>
            <a href="{{ url('/help') }}" class="yt-nav-item {{ request()->is('help*') ? 'active' : '' }}">
                <i class="bi bi-question-circle-fill"></i>
                <span>ช่วยเหลือ</span>
            </a>
        </div> --}}

        <hr class="yt-divider">

        {{-- Footer Info --}}
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

{{-- Sidebar Overlay for mobile --}}
<div class="yt-sidebar-overlay" id="sidebarOverlay"></div>
