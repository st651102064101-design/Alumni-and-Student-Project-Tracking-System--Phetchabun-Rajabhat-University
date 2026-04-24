

<?php $__env->startSection('title', 'จัดการข้อมูลศิษย์เก่า'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    /* Apple Design System */
    :root {
        --apple-bg: #f5f5f7;
        --apple-card: #ffffff;
        --apple-text: #1d1d1f;
        --apple-text-secondary: #86868b;
        --apple-border: rgba(0,0,0,0.08);
        --apple-blue: #0071e3;
        --apple-blue-hover: #0077ed;
        --apple-red: #ff3b30;
        --apple-red-hover: #ff453a;
        --apple-green: #34c759;
        --apple-orange: #ff9500;
        --apple-purple: #af52de;
        --apple-shadow: 0 2px 12px rgba(0,0,0,0.08);
        --apple-radius: 16px;
        --apple-radius-sm: 10px;
    }

    .apple-alumni { max-width: 100%; padding: 0; }

    /* Card */
    .apple-card {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        box-shadow: var(--apple-shadow);
        border: 1px solid var(--apple-border);
        padding: 20px 24px;
    }

    /* Header Bar */
    .apple-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 16px;
    }
    .apple-header-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--apple-text);
        margin: 0;
    }
    .apple-header-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    /* Filter Bar - Apple Style Chips */
    .apple-filter-bar {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 20px;
        padding: 0;
        background: transparent;
        border-radius: 0;
        border: none;
        align-items: center;
    }

    /* Segmented Control - Status */
    .apple-segmented {
        display: inline-flex;
        background: #f5f5f7;
        border-radius: 980px;
        padding: 3px;
        gap: 0;
    }

    .apple-segmented .segment-btn {
        padding: 8px 16px;
        border: none;
        background: transparent;
        border-radius: 980px;
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--apple-text-secondary);
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .apple-segmented .segment-btn:hover {
        color: var(--apple-text);
    }

    .apple-segmented .segment-btn.active {
        background: #fff;
        color: var(--apple-text);
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    /* Dropdown Chip */
    .apple-dropdown-chip {
        position: relative;
    }

    .apple-dropdown-chip .dropdown-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 980px;
        font-size: 0.8rem;
        font-weight: 500;
        background: #f5f5f7;
        color: var(--apple-text-secondary);
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
    }

    .apple-dropdown-chip .dropdown-btn:hover {
        background: #e8e8ed;
        color: var(--apple-text);
    }

    .apple-dropdown-chip .dropdown-btn.active {
        background: var(--apple-blue);
        color: #fff;
    }

    .apple-dropdown-chip .dropdown-btn::after {
        content: '';
        width: 0;
        height: 0;
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 5px solid currentColor;
        margin-left: 4px;
    }

    .apple-dropdown-chip .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        margin-top: 6px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.15);
        padding: 8px 0;
        min-width: 180px;
        z-index: 100;
        display: none;
        border: 1px solid var(--apple-border);
    }

    .apple-dropdown-chip .dropdown-menu.show {
        display: block;
        animation: dropdownIn 0.15s ease;
    }

    @keyframes dropdownIn {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .apple-dropdown-chip .dropdown-item {
        padding: 10px 16px;
        font-size: 0.85rem;
        color: var(--apple-text);
        cursor: pointer;
        transition: background 0.15s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .apple-dropdown-chip .dropdown-item:hover {
        background: #f5f5f7;
    }

    .apple-dropdown-chip .dropdown-item.active {
        color: var(--apple-blue);
        font-weight: 600;
    }

    .apple-dropdown-chip .dropdown-item.active::before {
        content: '✓';
        font-weight: 700;
    }

    /* Search Box */
    .apple-search-box {
        position: relative;
        flex: 1;
        min-width: 200px;
        max-width: 280px;
    }

    .apple-search-box .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--apple-text-secondary);
        font-size: 14px;
        pointer-events: none;
    }

    .apple-search-box input {
        width: 100%;
        padding: 9px 14px 9px 36px;
        border: none;
        border-radius: 980px;
        font-size: 0.85rem;
        background: #f5f5f7;
        color: var(--apple-text);
        transition: all 0.2s ease;
    }

    .apple-search-box input:hover {
        background: #e8e8ed;
    }

    .apple-search-box input:focus {
        outline: none;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(0,113,227,0.2);
    }

    .apple-search-box input::placeholder {
        color: var(--apple-text-secondary);
    }

    /* Active Filters Display */
    .active-filters {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }

    .active-filter-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 980px;
        font-size: 0.75rem;
        font-weight: 500;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
    }

    .active-filter-tag .remove-filter {
        cursor: pointer;
        opacity: 0.8;
        font-size: 14px;
    }

    .active-filter-tag .remove-filter:hover {
        opacity: 1;
    }

    .clear-all-filters {
        padding: 6px 12px;
        border-radius: 980px;
        font-size: 0.75rem;
        font-weight: 500;
        background: transparent;
        color: var(--apple-text-secondary);
        border: 1px dashed var(--apple-border);
        cursor: pointer;
        transition: all 0.2s;
    }

    .clear-all-filters:hover {
        background: #f5f5f7;
        color: var(--apple-text);
    }

    /* Buttons */
    .apple-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        border-radius: 980px;
        font-weight: 500;
        font-size: 0.875rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .apple-btn:active { transform: scale(0.97); }
    .apple-btn-primary { background: var(--apple-blue); color: #fff; }
    .apple-btn-primary:hover { background: var(--apple-blue-hover); color: #fff; }
    .apple-btn-secondary { background: #e8e8ed; color: var(--apple-text); }
    .apple-btn-secondary:hover { background: #dcdce0; }
    .apple-btn-danger { background: var(--apple-red); color: #fff; }
    .apple-btn-danger:hover { background: var(--apple-red-hover); }
    .apple-btn-sm { padding: 6px 14px; font-size: 0.8rem; }

    /* Selection info bar */
    .selection-bar {
        display: none;
        align-items: center;
        gap: 12px;
        padding: 10px 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: var(--apple-radius-sm);
        margin-bottom: 12px;
        color: #fff;
    }
    .selection-bar.show { display: flex; }
    .selection-bar .count {
        font-weight: 600;
        background: rgba(255,255,255,0.2);
        padding: 4px 12px;
        border-radius: 980px;
        font-size: 0.85rem;
    }
    .selection-bar .actions {
        display: flex;
        gap: 8px;
        margin-left: auto;
    }
    .selection-bar .apple-btn {
        background: rgba(255,255,255,0.2);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.3);
    }
    .selection-bar .apple-btn:hover {
        background: rgba(255,255,255,0.3);
    }
    .selection-bar .apple-btn-danger {
        background: var(--apple-red);
        border-color: transparent;
    }

    /* Table */
    .apple-table-wrap {
        border-radius: var(--apple-radius);
        overflow: hidden;
        border: 1px solid var(--apple-border);
    }
    #alumniTable { margin: 0 !important; }
    #alumniTable thead th {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--apple-text-secondary);
        white-space: nowrap;
        background: #fafafa;
        border-bottom: 1px solid var(--apple-border);
        padding: 12px 14px;
    }
    #alumniTable tbody td {
        vertical-align: middle;
        font-size: 0.9rem;
        padding: 10px 14px;
        color: var(--apple-text);
    }
    #alumniTable tbody tr { transition: background 0.15s; }
    #alumniTable tbody tr:hover { background: #f5f5f7; }
    #alumniTable tbody tr.selected { background: rgba(0,113,227,0.08); }

    /* Checkbox styling */
    .row-checkbox {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: var(--apple-blue);
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 12px;
        border-radius: 980px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    .status-badge.employed { background: #e8f5e9; color: #2e7d32; }
    .status-badge.unemployed { background: #ffebee; color: #c62828; }
    .status-badge.self_employed { background: #fff3e0; color: #e65100; }
    .status-badge.further_study { background: #e3f2fd; color: #1565c0; }
    .status-badge.other { background: #f3e5f5; color: #7b1fa2; }

    /* Job Type Badge */
    .job-type-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 980px;
        font-size: 0.75rem;
        font-weight: 500;
        background: #f0f0f0;
        color: var(--apple-text-secondary);
    }
    .job-type-badge.related { background: #e8f5e9; color: #2e7d32; }
    .job-type-badge.unrelated { background: #fff3e0; color: #e65100; }
    .job-type-badge.further_study { background: #e3f2fd; color: #1565c0; }

    /* DataTables controls */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter { margin-bottom: 12px; }
    .dataTables_wrapper .dataTables_filter input,
    .dataTables_wrapper .dataTables_length select {
        border-radius: var(--apple-radius-sm) !important;
        border: 1px solid var(--apple-border) !important;
        padding: 8px 12px !important;
        font-size: 0.9rem;
        outline: none;
        box-shadow: none !important;
    }
    .dataTables_wrapper .dataTables_filter input:focus,
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: var(--apple-blue) !important;
        box-shadow: 0 0 0 3px rgba(0,113,227,0.15) !important;
    }
    .dataTables_wrapper .dataTables_paginate .pagination { gap: 4px; }
    .dataTables_wrapper .dataTables_paginate .page-link {
        border-radius: 50% !important;
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        padding: 0;
        border: 1px solid var(--apple-border) !important;
        color: var(--apple-text) !important;
        font-size: 0.85rem;
    }
    .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
        background: var(--apple-blue) !important;
        border-color: var(--apple-blue) !important;
        color: #fff !important;
    }
    .dataTables_wrapper .dataTables_info {
        font-size: 0.85rem;
        color: var(--apple-text-secondary);
    }

    /* Apple Modal */
    .apple-modal-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        backdrop-filter: blur(4px);
        z-index: 1050;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .apple-modal-backdrop.show { display: flex; }
    .apple-modal {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        width: 100%;
        max-width: 720px;
        max-height: 90vh;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        animation: modalIn 0.25s ease;
    }
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .apple-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 24px;
        border-bottom: 1px solid var(--apple-border);
    }
    .apple-modal-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--apple-text);
        margin: 0;
    }
    .apple-modal-close {
        width: 28px; height: 28px;
        border-radius: 50%;
        border: none;
        background: #e8e8ed;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }
    .apple-modal-close:hover { background: #dcdce0; }
    .apple-modal-body {
        padding: 24px;
        overflow-y: auto;
        flex: 1;
    }
    .apple-modal-footer {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        padding: 16px 24px;
        border-top: 1px solid var(--apple-border);
        background: #fafafa;
    }

    /* Form in modal */
    .apple-form .form-label {
        font-weight: 500;
        font-size: 0.875rem;
        color: var(--apple-text-secondary);
        margin-bottom: 6px;
    }
    .apple-form .form-control,
    .apple-form .form-select {
        border-radius: var(--apple-radius-sm);
        border: 1px solid var(--apple-border);
        padding: 10px 14px;
        font-size: 0.95rem;
        background: #fff;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .apple-form .form-control:focus,
    .apple-form .form-select:focus {
        border-color: var(--apple-blue);
        box-shadow: 0 0 0 3px rgba(0,113,227,0.15);
        outline: none;
    }
    .apple-form textarea.form-control {
        min-height: 80px;
        resize: vertical;
    }
    .apple-form .form-control::placeholder {
        color: var(--apple-text-secondary);
        opacity: 0.7;
    }

    @media (max-width: 768px) {
        .apple-card { padding: 16px; }
        .apple-header { flex-direction: column; align-items: stretch; }
        .apple-header-actions { justify-content: flex-end; }
        .selection-bar { flex-wrap: wrap; }
        .apple-filter-bar { flex-direction: column; }
    }

    /* Dark mode */
    body.dark {
        --apple-bg: var(--yt-bg-secondary);
        --apple-card: var(--yt-bg-primary);
        --apple-text: var(--yt-text-primary);
        --apple-text-secondary: var(--yt-text-secondary);
        --apple-border: var(--yt-border-color);
        --apple-blue: var(--yt-accent-color);
        --apple-blue-hover: var(--yt-accent-color);
    }

    body.dark .apple-card {
        box-shadow: 0 2px 14px rgba(0,0,0,0.35);
    }

    body.dark .apple-btn-secondary {
        background: var(--yt-bg-secondary);
        color: var(--yt-text-primary);
        border: 1px solid var(--yt-border-color);
    }
    body.dark .apple-btn-secondary:hover {
        background: var(--yt-bg-hover);
    }

    body.dark .apple-table-wrap {
        border-color: var(--yt-border-color);
    }

    body.dark #alumniTable thead th {
        background: #272727;
        border-bottom-color: var(--yt-border-color);
        color: #aaa;
    }

    body.dark #alumniTable tbody td {
        color: #f1f1f1 !important;
        background: var(--yt-bg-primary);
    }

    body.dark #alumniTable tbody tr {
        border-bottom: 1px solid #3f3f3f;
    }

    body.dark #alumniTable tbody tr:hover {
        background: #272727 !important;
    }

    body.dark #alumniTable tbody tr:hover td {
        background: #272727 !important;
    }

    body.dark #alumniTable tbody tr.selected td {
        background: rgba(62,166,255,0.18) !important;
    }

    body.dark .table {
        --bs-table-bg: var(--yt-bg-primary);
        --bs-table-color: #f1f1f1;
        --bs-table-border-color: #3f3f3f;
        --bs-table-striped-bg: #1a1a1a;
        --bs-table-hover-bg: #272727;
    }

    body.dark .dataTables_wrapper .dataTables_info {
        color: #aaa !important;
    }

    body.dark .dataTables_wrapper .dataTables_length label,
    body.dark .dataTables_wrapper .dataTables_filter label {
        color: #f1f1f1 !important;
    }

    body.dark .dataTables_wrapper .dataTables_filter input,
    body.dark .dataTables_wrapper .dataTables_length select {
        background: var(--yt-bg-secondary);
        color: var(--yt-text-primary);
        border-color: var(--yt-border-color) !important;
    }

    body.dark .dataTables_wrapper .dataTables_paginate .page-link {
        background: var(--yt-bg-primary);
        border-color: var(--yt-border-color) !important;
        color: var(--yt-text-primary) !important;
    }

    body.dark .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
        background: var(--yt-accent-color) !important;
        border-color: var(--yt-accent-color) !important;
        color: #0f0f0f !important;
    }

    body.dark .apple-modal {
        background: var(--yt-bg-primary);
        border: 1px solid var(--yt-border-color);
    }

    body.dark .apple-modal-header,
    body.dark .apple-modal-footer {
        border-color: var(--yt-border-color);
        background: var(--yt-bg-primary);
    }

    body.dark .apple-modal-close {
        background: var(--yt-bg-secondary);
        color: var(--yt-text-primary);
    }

    body.dark .apple-form .form-control,
    body.dark .apple-form .form-select {
        background: var(--yt-bg-secondary);
        color: var(--yt-text-primary);
        border-color: var(--yt-border-color);
    }

    body.dark .apple-form .form-control::placeholder {
        color: #aaa;
        opacity: 1;
    }

    body.dark .apple-form .form-label {
        color: var(--yt-text-secondary);
    }

    body.dark .apple-segmented {
        background: #272727;
    }

    body.dark .apple-segmented .segment-btn {
        color: #aaa;
    }

    body.dark .apple-segmented .segment-btn.active {
        background: #3a3a3a;
        color: #f1f1f1;
        box-shadow: none;
    }

    body.dark .apple-dropdown-chip .dropdown-btn {
        background: #272727;
        color: #aaa;
    }

    body.dark .apple-dropdown-chip .dropdown-btn.active {
        background: var(--yt-accent-color);
        color: #0f0f0f;
    }

    body.dark .apple-dropdown-chip .dropdown-menu {
        background: #272727;
        border-color: #3f3f3f;
    }

    body.dark .apple-dropdown-chip .dropdown-item {
        color: #f1f1f1;
    }

    body.dark .apple-dropdown-chip .dropdown-item:hover {
        background: #3a3a3a;
    }

    body.dark .apple-search-box input {
        background: #272727;
        color: #f1f1f1;
    }

    body.dark .apple-search-box input:focus {
        background: #3a3a3a;
        box-shadow: 0 0 0 4px rgba(62,166,255,0.2);
    }

    body.dark .status-badge.employed { background: rgba(52,199,89,0.2); color: #4cd964; }
    body.dark .status-badge.unemployed { background: rgba(255,59,48,0.2); color: #ff6b6b; }
    body.dark .status-badge.self_employed { background: rgba(255,149,0,0.2); color: #ffb340; }
    body.dark .status-badge.further_study { background: rgba(0,113,227,0.2); color: #3ea6ff; }
    body.dark .status-badge.other { background: rgba(175,82,222,0.2); color: #bf7fff; }

    body.dark .job-type-badge {
        background: #3f3f3f;
        color: #aaa;
    }
    body.dark .job-type-badge.related { background: rgba(52,199,89,0.2); color: #4cd964; }
    body.dark .job-type-badge.unrelated { background: rgba(255,149,0,0.2); color: #ffb340; }
    body.dark .job-type-badge.further_study { background: rgba(0,113,227,0.2); color: #3ea6ff; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="apple-alumni">
    <div class="apple-card">
        
        <div class="apple-header">
            <h2 class="apple-header-title">ข้อมูลศิษย์เก่า</h2>
            <div class="apple-header-actions">
                <button type="button" class="apple-btn apple-btn-secondary" id="refreshBtn">
                    <i class="bi bi-arrow-clockwise"></i> รีเฟรช
                </button>
                <button type="button" class="apple-btn apple-btn-primary" id="addAlumniBtn">
                    <i class="bi bi-plus-lg"></i> เพิ่มศิษย์เก่า
                </button>
            </div>
        </div>

        
        <div class="apple-filter-bar">
            
            <div class="apple-segmented" id="statusSegment">
                <button type="button" class="segment-btn active" data-value="">ทั้งหมด</button>
                <button type="button" class="segment-btn" data-value="employed">มีงานทำ</button>
                <button type="button" class="segment-btn" data-value="unemployed">ว่างงาน</button>
                <button type="button" class="segment-btn" data-value="self_employed">ธุรกิจส่วนตัว</button>
                <button type="button" class="segment-btn" data-value="further_study">ศึกษาต่อ</button>
            </div>

            
            <div class="apple-dropdown-chip" id="yearDropdown">
                <button type="button" class="dropdown-btn" id="yearBtn">
                    <i class="bi bi-calendar3"></i> ปีที่จบ
                </button>
                <div class="dropdown-menu" id="yearMenu">
                    <div class="dropdown-item active" data-value="">ทั้งหมด</div>
                    <?php for($y = 2569; $y >= 2560; $y--): ?>
                        <div class="dropdown-item" data-value="<?php echo e($y); ?>"><?php echo e($y); ?></div>
                    <?php endfor; ?>
                </div>
            </div>

            
            <div class="apple-dropdown-chip" id="jobTypeDropdown">
                <button type="button" class="dropdown-btn" id="jobTypeBtn">
                    <i class="bi bi-briefcase"></i> ประเภทงาน
                </button>
                <div class="dropdown-menu" id="jobTypeMenu">
                    <div class="dropdown-item active" data-value="">ทั้งหมด</div>
                    <div class="dropdown-item" data-value="related">ตรงสาขา</div>
                    <div class="dropdown-item" data-value="unrelated">ไม่ตรงสาขา</div>
                    <div class="dropdown-item" data-value="further_study">ศึกษาต่อ</div>
                    <div class="dropdown-item" data-value="other">อื่นๆ</div>
                </div>
            </div>

            
            <div class="apple-search-box">
                <i class="bi bi-search search-icon"></i>
                <input type="text" id="filterSearch" placeholder="ค้นหาศิษย์เก่า...">
            </div>
        </div>

        
        <div class="active-filters" id="activeFilters" style="display: none;"></div>

        
        <div class="selection-bar" id="selectionBar">
            <span>เลือกแล้ว</span>
            <span class="count" id="selectedCount">0</span>
            <span>รายการ</span>
            <div class="actions">
                <button type="button" class="apple-btn apple-btn-sm" id="editSelectedBtn">
                    <i class="bi bi-pencil"></i> แก้ไข
                </button>
                <button type="button" class="apple-btn apple-btn-sm apple-btn-danger" id="deleteSelectedBtn">
                    <i class="bi bi-trash"></i> ลบที่เลือก
                </button>
                <button type="button" class="apple-btn apple-btn-sm" id="clearSelectionBtn">
                    <i class="bi bi-x-lg"></i> ยกเลิก
                </button>
            </div>
        </div>

        <div class="apple-table-wrap table-responsive">
            <table id="alumniTable" class="table table-hover align-middle" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th style="width:40px"><input type="checkbox" class="row-checkbox" id="selectAll"></th>
                        <th>รหัสนักศึกษา</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ปีที่จบ</th>
                        <th>เกรดเฉลี่ย</th>
                        <th>ที่ทำงาน</th>
                        <th>ตำแหน่ง</th>
                        <th>ประเภทงาน</th>
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="apple-modal-backdrop" id="alumniModal">
    <div class="apple-modal">
        <div class="apple-modal-header">
            <h3 class="apple-modal-title" id="modalTitle">เพิ่มศิษย์เก่า</h3>
            <button type="button" class="apple-modal-close" id="closeModal">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="apple-modal-body">
            <form id="alumniForm" class="apple-form">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" id="alumni_id">

                <div class="row g-3">
                    
                    <div class="col-12">
                        <h6 class="text-muted mb-2"><i class="bi bi-person me-1"></i> ข้อมูลส่วนตัว</h6>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">รหัสนักศึกษา <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="student_code" id="student_code" required placeholder="เช่น 641102064001">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">คำนำหน้า</label>
                        <select class="form-select" name="prefix" id="prefix">
                            <option value="">-</option>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">ชื่อ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="first_name" id="first_name" required placeholder="ชื่อ">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">นามสกุล <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="last_name" id="last_name" required placeholder="นามสกุล">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">อีเมล</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">เบอร์โทร</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="0812345678">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">จังหวัด</label>
                        <input type="text" class="form-control" name="province" id="province" placeholder="จังหวัด">
                    </div>

                    
                    <div class="col-12 mt-3">
                        <h6 class="text-muted mb-2"><i class="bi bi-mortarboard me-1"></i> ข้อมูลการศึกษา</h6>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">ปีที่จบ <span class="text-danger">*</span></label>
                        <select class="form-select" name="graduation_year" id="graduation_year" required>
                            <option value="">-- เลือกปี --</option>
                            <?php for($y = 2569; $y >= 2550; $y--): ?>
                                <option value="<?php echo e($y); ?>"><?php echo e($y); ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">วุฒิการศึกษา</label>
                        <select class="form-select" name="degree" id="degree">
                            <option value="ปริญญาตรี">ปริญญาตรี</option>
                            <option value="ปริญญาโท">ปริญญาโท</option>
                            <option value="ปริญญาเอก">ปริญญาเอก</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">สาขาวิชา</label>
                        <input type="text" class="form-control" name="major" id="major" value="วิทยาการคอมพิวเตอร์" placeholder="สาขาวิชา">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">เกรดเฉลี่ย</label>
                        <input type="number" class="form-control" name="gpa" id="gpa" step="0.01" min="0" max="4" placeholder="0.00">
                    </div>

                    
                    <div class="col-12 mt-3">
                        <h6 class="text-muted mb-2"><i class="bi bi-briefcase me-1"></i> ข้อมูลการทำงาน</h6>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">สถานะ <span class="text-danger">*</span></label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="employed">มีงานทำ</option>
                            <option value="unemployed">ว่างงาน</option>
                            <option value="self_employed">ธุรกิจส่วนตัว</option>
                            <option value="further_study">ศึกษาต่อ</option>
                            <option value="other">อื่นๆ</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ประเภทงาน</label>
                        <select class="form-select" name="job_type" id="job_type">
                            <option value="">-- เลือก --</option>
                            <option value="related">ตรงสาขา</option>
                            <option value="unrelated">ไม่ตรงสาขา</option>
                            <option value="further_study">ศึกษาต่อ</option>
                            <option value="other">อื่นๆ</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">เงินเดือน (บาท)</label>
                        <input type="number" class="form-control" name="salary" id="salary" min="0" placeholder="เงินเดือน">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">ที่ทำงานปัจจุบัน</label>
                        <input type="text" class="form-control" name="current_workplace" id="current_workplace" placeholder="ชื่อบริษัท/หน่วยงาน">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">ตำแหน่งงาน</label>
                        <input type="text" class="form-control" name="current_position" id="current_position" placeholder="ตำแหน่งงาน">
                    </div>

                    
                    <div class="col-12 mt-3">
                        <h6 class="text-muted mb-2"><i class="bi bi-chat-dots me-1"></i> ช่องทางติดต่อ</h6>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Facebook</label>
                        <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook URL หรือชื่อ">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Line ID</label>
                        <input type="text" class="form-control" name="line_id" id="line_id" placeholder="Line ID">
                    </div>
                    <div class="col-12">
                        <label class="form-label">หมายเหตุ</label>
                        <textarea class="form-control" name="notes" id="notes" rows="2" placeholder="หมายเหตุเพิ่มเติม..."></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="apple-modal-footer">
            <button type="button" class="apple-btn apple-btn-secondary" id="cancelModalBtn">ยกเลิก</button>
            <button type="button" class="apple-btn apple-btn-primary" id="saveAlumniBtn">
                <i class="bi bi-check-lg"></i> บันทึก
            </button>
        </div>
    </div>
</div>


<div class="apple-modal-backdrop" id="deleteModal">
    <div class="apple-modal" style="max-width: 400px;">
        <div class="apple-modal-header">
            <h3 class="apple-modal-title">ยืนยันการลบ</h3>
            <button type="button" class="apple-modal-close" onclick="closeDeleteModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="apple-modal-body text-center">
            <i class="bi bi-exclamation-triangle" style="font-size: 3rem; color: var(--apple-red);"></i>
            <p class="mt-3 mb-0" id="deleteMessage">คุณต้องการลบข้อมูลที่เลือกหรือไม่?</p>
            <p class="text-muted small">การดำเนินการนี้ไม่สามารถย้อนกลับได้</p>
        </div>
        <div class="apple-modal-footer justify-content-center">
            <button type="button" class="apple-btn apple-btn-secondary" onclick="closeDeleteModal()">ยกเลิก</button>
            <button type="button" class="apple-btn apple-btn-danger" id="confirmDeleteBtn">
                <i class="bi bi-trash"></i> ลบ
            </button>
        </div>
    </div>
</div>


<div class="apple-modal-backdrop" id="viewModal">
    <div class="apple-modal" style="max-width: 600px;">
        <div class="apple-modal-header">
            <h3 class="apple-modal-title">รายละเอียดศิษย์เก่า</h3>
            <button type="button" class="apple-modal-close" onclick="closeViewModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="apple-modal-body" id="viewModalBody">
            
        </div>
        <div class="apple-modal-footer">
            <button type="button" class="apple-btn apple-btn-secondary" onclick="closeViewModal()">ปิด</button>
            <button type="button" class="apple-btn apple-btn-primary" id="editFromViewBtn">
                <i class="bi bi-pencil"></i> แก้ไข
            </button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function(){
    var alumniDataUrl = '<?php echo e(route("alumni.data")); ?>';
    var alumniBaseUrl = '<?php echo e(url("alumni")); ?>';
    var csrfToken = '<?php echo e(csrf_token()); ?>';

    var table;
    var alumniData = [];
    var selectedIds = [];
    var currentViewAlumni = null;
    
    // Filter state
    var filterStatus = '';
    var filterYear = '';
    var filterJobType = '';

    // Status labels
    var statusLabels = {
        'employed': 'มีงานทำ',
        'unemployed': 'ว่างงาน',
        'self_employed': 'ธุรกิจส่วนตัว',
        'further_study': 'ศึกษาต่อ',
        'other': 'อื่นๆ'
    };

    // Job type labels
    var jobTypeLabels = {
        'related': 'ตรงสาขา',
        'unrelated': 'ไม่ตรงสาขา',
        'further_study': 'ศึกษาต่อ',
        'other': 'อื่นๆ'
    };

    // Load Data
    function loadData() {
        var params = {
            search: $('#filterSearch').val(),
            status: filterStatus,
            year: filterYear,
            job_type: filterJobType
        };

        $.ajax({
            url: alumniDataUrl,
            data: params,
            success: function(res) {
                alumniData = res.data || [];
                renderTable();
            },
            error: function() {
                alert('ไม่สามารถโหลดข้อมูลได้');
            }
        });
    }

    function renderTable() {
        if (table) {
            table.destroy();
        }

        var tbody = $('#alumniTable tbody');
        tbody.empty();

        alumniData.forEach(function(a) {
            var fullName = (a.prefix || '') + (a.first_name || '') + ' ' + (a.last_name || '');
            var statusClass = a.status || 'other';
            var statusLabel = statusLabels[a.status] || a.status || '-';
            var jobTypeClass = a.job_type || '';
            var jobTypeLabel = jobTypeLabels[a.job_type] || a.job_type || '-';

            var row = `
                <tr data-id="${a.id}" data-alumni='${JSON.stringify(a).replace(/'/g, "&#39;")}'>
                    <td><input type="checkbox" class="row-checkbox row-select" data-id="${a.id}"></td>
                    <td><strong>${a.student_code || '-'}</strong></td>
                    <td>
                        <a href="#" class="view-alumni text-decoration-none" data-id="${a.id}">
                            ${fullName.trim() || '-'}
                        </a>
                    </td>
                    <td>${a.graduation_year || '-'}</td>
                    <td>${a.gpa ? parseFloat(a.gpa).toFixed(2) : '-'}</td>
                    <td>${a.current_workplace || '-'}</td>
                    <td>${a.current_position || '-'}</td>
                    <td><span class="job-type-badge ${jobTypeClass}">${jobTypeLabel}</span></td>
                    <td><span class="status-badge ${statusClass}">${statusLabel}</span></td>
                    <td>
                        <button type="button" class="apple-btn apple-btn-sm apple-btn-secondary edit-btn" data-id="${a.id}" title="แก้ไข">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="apple-btn apple-btn-sm apple-btn-danger delete-btn" data-id="${a.id}" title="ลบ">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });

        table = $('#alumniTable').DataTable({
            paging: true,
            searching: false,
            ordering: true,
            order: [[1, 'desc']],
            pageLength: 10,
            columnDefs: [
                { orderable: false, targets: [0, 9] }
            ],
            language: {
                lengthMenu: "แสดง _MENU_ รายการ",
                info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                infoEmpty: "ไม่มีข้อมูล",
                infoFiltered: "(กรองจาก _MAX_ รายการ)",
                paginate: {
                    first: "หน้าแรก",
                    last: "หน้าสุดท้าย",
                    next: "ถัดไป",
                    previous: "ก่อนหน้า"
                },
                emptyTable: "ไม่มีข้อมูลศิษย์เก่า"
            }
        });

        // Restore selection
        selectedIds.forEach(function(id) {
            $('tr[data-id="' + id + '"]').addClass('selected').find('.row-select').prop('checked', true);
        });
        updateSelectionBar();
    }

    // Initial load
    loadData();

    // Refresh button
    $('#refreshBtn').on('click', loadData);

    // ========== Filter Controls ==========
    
    // Status Segmented Control
    $('#statusSegment .segment-btn').on('click', function() {
        $('#statusSegment .segment-btn').removeClass('active');
        $(this).addClass('active');
        filterStatus = $(this).data('value');
        updateActiveFiltersDisplay();
        loadData();
    });

    // Year Dropdown
    $('#yearBtn').on('click', function(e) {
        e.stopPropagation();
        closeAllDropdowns();
        $('#yearMenu').toggleClass('show');
    });

    $('#yearMenu .dropdown-item').on('click', function() {
        $('#yearMenu .dropdown-item').removeClass('active');
        $(this).addClass('active');
        filterYear = $(this).data('value');
        
        var label = filterYear ? 'ปี ' + filterYear : 'ปีที่จบ';
        $('#yearBtn').html('<i class="bi bi-calendar3"></i> ' + label);
        $('#yearBtn').toggleClass('active', filterYear !== '');
        
        $('#yearMenu').removeClass('show');
        updateActiveFiltersDisplay();
        loadData();
    });

    // Job Type Dropdown
    $('#jobTypeBtn').on('click', function(e) {
        e.stopPropagation();
        closeAllDropdowns();
        $('#jobTypeMenu').toggleClass('show');
    });

    $('#jobTypeMenu .dropdown-item').on('click', function() {
        $('#jobTypeMenu .dropdown-item').removeClass('active');
        $(this).addClass('active');
        filterJobType = $(this).data('value');
        
        var label = filterJobType ? jobTypeLabels[filterJobType] || filterJobType : 'ประเภทงาน';
        $('#jobTypeBtn').html('<i class="bi bi-briefcase"></i> ' + label);
        $('#jobTypeBtn').toggleClass('active', filterJobType !== '');
        
        $('#jobTypeMenu').removeClass('show');
        updateActiveFiltersDisplay();
        loadData();
    });

    // Close dropdowns when clicking outside
    function closeAllDropdowns() {
        $('.dropdown-menu').removeClass('show');
    }
    
    $(document).on('click', function() {
        closeAllDropdowns();
    });

    // Update active filters display
    function updateActiveFiltersDisplay() {
        var html = '';
        var hasFilters = false;

        if (filterYear) {
            hasFilters = true;
            html += '<span class="active-filter-tag">ปี ' + filterYear + ' <i class="bi bi-x remove-filter" data-filter="year"></i></span>';
        }

        if (filterJobType) {
            hasFilters = true;
            html += '<span class="active-filter-tag">' + (jobTypeLabels[filterJobType] || filterJobType) + ' <i class="bi bi-x remove-filter" data-filter="jobType"></i></span>';
        }

        if (hasFilters) {
            html += '<button type="button" class="clear-all-filters">ล้างทั้งหมด</button>';
            $('#activeFilters').html(html).show();
        } else {
            $('#activeFilters').hide();
        }
    }

    // Remove individual filter
    $('#activeFilters').on('click', '.remove-filter', function() {
        var filter = $(this).data('filter');
        if (filter === 'year') {
            filterYear = '';
            $('#yearMenu .dropdown-item').removeClass('active').first().addClass('active');
            $('#yearBtn').html('<i class="bi bi-calendar3"></i> ปีที่จบ').removeClass('active');
        } else if (filter === 'jobType') {
            filterJobType = '';
            $('#jobTypeMenu .dropdown-item').removeClass('active').first().addClass('active');
            $('#jobTypeBtn').html('<i class="bi bi-briefcase"></i> ประเภทงาน').removeClass('active');
        }
        updateActiveFiltersDisplay();
        loadData();
    });

    // Clear all filters
    $('#activeFilters').on('click', '.clear-all-filters', function() {
        filterStatus = '';
        filterYear = '';
        filterJobType = '';
        
        $('#statusSegment .segment-btn').removeClass('active').first().addClass('active');
        $('#yearMenu .dropdown-item').removeClass('active').first().addClass('active');
        $('#yearBtn').html('<i class="bi bi-calendar3"></i> ปีที่จบ').removeClass('active');
        $('#jobTypeMenu .dropdown-item').removeClass('active').first().addClass('active');
        $('#jobTypeBtn').html('<i class="bi bi-briefcase"></i> ประเภทงาน').removeClass('active');
        $('#filterSearch').val('');
        
        updateActiveFiltersDisplay();
        loadData();
    });
    
    // Search
    var searchTimer;
    $('#filterSearch').on('input', function() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(loadData, 300);
    });

    // ========== Selection handling ==========
    function updateSelectionBar() {
        var count = selectedIds.length;
        $('#selectedCount').text(count);
        if (count > 0) {
            $('#selectionBar').addClass('show');
            $('#editSelectedBtn').toggle(count === 1);
        } else {
            $('#selectionBar').removeClass('show');
        }
    }

    // Select all
    $('#selectAll').on('change', function() {
        var isChecked = $(this).is(':checked');
        $('.row-select').prop('checked', isChecked);
        selectedIds = [];
        if (isChecked) {
            $('.row-select').each(function() {
                selectedIds.push($(this).data('id'));
                $(this).closest('tr').addClass('selected');
            });
        } else {
            $('tr.selected').removeClass('selected');
        }
        updateSelectionBar();
    });

    // Individual row checkbox
    $('#alumniTable').on('change', '.row-select', function() {
        var id = $(this).data('id');
        var tr = $(this).closest('tr');
        if ($(this).is(':checked')) {
            if (!selectedIds.includes(id)) selectedIds.push(id);
            tr.addClass('selected');
        } else {
            selectedIds = selectedIds.filter(x => x !== id);
            tr.removeClass('selected');
        }
        var allChecked = $('.row-select:checked').length === $('.row-select').length;
        $('#selectAll').prop('checked', allChecked);
        updateSelectionBar();
    });

    // Clear selection
    $('#clearSelectionBtn').on('click', function() {
        selectedIds = [];
        $('.row-select, #selectAll').prop('checked', false);
        $('tr.selected').removeClass('selected');
        updateSelectionBar();
    });

    // ========== Modal functions ==========
    function openModal(title) {
        $('#modalTitle').text(title || 'เพิ่มศิษย์เก่า');
        $('#alumniModal').addClass('show');
        $('body').css('overflow', 'hidden');
    }

    function closeModal() {
        $('#alumniModal').removeClass('show');
        $('body').css('overflow', '');
        resetForm();
    }

    function resetForm() {
        $('#alumniForm')[0].reset();
        $('#alumni_id').val('');
        $('#major').val('วิทยาการคอมพิวเตอร์');
    }

    function openEditModal(alumni) {
        openModal('แก้ไขข้อมูลศิษย์เก่า');
        $('#alumni_id').val(alumni.id);
        $('#student_code').val(alumni.student_code || '');
        $('#prefix').val(alumni.prefix || '');
        $('#first_name').val(alumni.first_name || '');
        $('#last_name').val(alumni.last_name || '');
        $('#email').val(alumni.email || '');
        $('#phone').val(alumni.phone || '');
        $('#province').val(alumni.province || '');
        $('#graduation_year').val(alumni.graduation_year || '');
        $('#degree').val(alumni.degree || 'ปริญญาตรี');
        $('#major').val(alumni.major || 'วิทยาการคอมพิวเตอร์');
        $('#gpa').val(alumni.gpa || '');
        $('#status').val(alumni.status || 'employed');
        $('#job_type').val(alumni.job_type || '');
        $('#salary').val(alumni.salary || '');
        $('#current_workplace').val(alumni.current_workplace || '');
        $('#current_position').val(alumni.current_position || '');
        $('#facebook').val(alumni.facebook || '');
        $('#line_id').val(alumni.line_id || '');
        $('#notes').val(alumni.notes || '');
    }

    // Add button
    $('#addAlumniBtn').on('click', function() {
        resetForm();
        openModal('เพิ่มศิษย์เก่าใหม่');
    });

    // Close modal
    $('#closeModal, #cancelModalBtn').on('click', closeModal);
    $('#alumniModal').on('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Edit button in table
    $('#alumniTable').on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        var alumni = alumniData.find(a => a.id === id);
        if (alumni) openEditModal(alumni);
    });

    // Edit selected button
    $('#editSelectedBtn').on('click', function() {
        if (selectedIds.length === 1) {
            var alumni = alumniData.find(a => a.id === selectedIds[0]);
            if (alumni) openEditModal(alumni);
        }
    });

    // Row double-click to edit
    $('#alumniTable').on('dblclick', 'tbody tr', function() {
        var id = $(this).data('id');
        var alumni = alumniData.find(a => a.id === id);
        if (alumni) openEditModal(alumni);
    });

    // View alumni
    $('#alumniTable').on('click', '.view-alumni', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var alumni = alumniData.find(a => a.id === id);
        if (alumni) openViewModal(alumni);
    });

    function openViewModal(alumni) {
        currentViewAlumni = alumni;
        var fullName = (alumni.prefix || '') + (alumni.first_name || '') + ' ' + (alumni.last_name || '');
        var statusLabel = statusLabels[alumni.status] || alumni.status || '-';
        var jobTypeLabel = jobTypeLabels[alumni.job_type] || alumni.job_type || '-';
        
        var html = `
            <div class="row mb-3">
                <div class="col-md-6"><strong>รหัสนักศึกษา:</strong> ${alumni.student_code || '-'}</div>
                <div class="col-md-6"><strong>ชื่อ-นามสกุล:</strong> ${fullName.trim() || '-'}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6"><strong>อีเมล:</strong> ${alumni.email || '-'}</div>
                <div class="col-md-6"><strong>เบอร์โทร:</strong> ${alumni.phone || '-'}</div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-4"><strong>ปีที่จบ:</strong> ${alumni.graduation_year || '-'}</div>
                <div class="col-md-4"><strong>วุฒิ:</strong> ${alumni.degree || '-'}</div>
                <div class="col-md-4"><strong>GPA:</strong> ${alumni.gpa ? parseFloat(alumni.gpa).toFixed(2) : '-'}</div>
            </div>
            <div class="mb-3">
                <strong>สาขาวิชา:</strong> ${alumni.major || '-'}
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-6"><strong>สถานะ:</strong> <span class="status-badge ${alumni.status}">${statusLabel}</span></div>
                <div class="col-md-6"><strong>ประเภทงาน:</strong> <span class="job-type-badge ${alumni.job_type || ''}">${jobTypeLabel}</span></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6"><strong>ที่ทำงาน:</strong> ${alumni.current_workplace || '-'}</div>
                <div class="col-md-6"><strong>ตำแหน่ง:</strong> ${alumni.current_position || '-'}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6"><strong>เงินเดือน:</strong> ${alumni.salary ? Number(alumni.salary).toLocaleString() + ' บาท' : '-'}</div>
                <div class="col-md-6"><strong>จังหวัด:</strong> ${alumni.province || '-'}</div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-6"><strong>Facebook:</strong> ${alumni.facebook || '-'}</div>
                <div class="col-md-6"><strong>Line ID:</strong> ${alumni.line_id || '-'}</div>
            </div>
            ${alumni.notes ? '<div class="mb-3"><strong>หมายเหตุ:</strong> ' + alumni.notes + '</div>' : ''}
        `;
        
        $('#viewModalBody').html(html);
        $('#viewModal').addClass('show');
        $('body').css('overflow', 'hidden');
    }

    window.closeViewModal = function() {
        $('#viewModal').removeClass('show');
        $('body').css('overflow', '');
        currentViewAlumni = null;
    };

    $('#editFromViewBtn').on('click', function() {
        if (currentViewAlumni) {
            closeViewModal();
            openEditModal(currentViewAlumni);
        }
    });

    // ========== Save alumni ==========
    $('#saveAlumniBtn').on('click', function(e) {
        e.preventDefault();
        var id = $('#alumni_id').val();
        var url = alumniBaseUrl;
        var method = 'POST';
        
        if (id) {
            url = alumniBaseUrl + '/' + id;
            method = 'PUT';
        }

        var formData = {
            student_code: $('#student_code').val(),
            prefix: $('#prefix').val(),
            first_name: $('#first_name').val(),
            last_name: $('#last_name').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            province: $('#province').val(),
            graduation_year: $('#graduation_year').val(),
            degree: $('#degree').val(),
            major: $('#major').val(),
            gpa: $('#gpa').val() || null,
            status: $('#status').val(),
            job_type: $('#job_type').val(),
            salary: $('#salary').val() || null,
            current_workplace: $('#current_workplace').val(),
            current_position: $('#current_position').val(),
            facebook: $('#facebook').val(),
            line_id: $('#line_id').val(),
            notes: $('#notes').val()
        };

        $.ajax({
            url: url,
            method: method,
            data: formData,
            headers: { 
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            success: function(res) {
                if (res.success) {
                    closeModal();
                    loadData();
                    showToast(id ? 'แก้ไขข้อมูลสำเร็จ' : 'เพิ่มข้อมูลสำเร็จ', 'success');
                } else {
                    alert(res.message || 'ไม่สามารถบันทึกข้อมูลได้');
                }
            },
            error: function(xhr) {
                var msg = 'เกิดข้อผิดพลาด';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    msg = Object.values(xhr.responseJSON.errors).flat().join('\n');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                alert('ข้อผิดพลาด\n' + msg);
            }
        });
    });

    // ========== Delete Modal ==========
    var deleteIds = [];

    window.closeDeleteModal = function() {
        $('#deleteModal').removeClass('show');
        $('body').css('overflow', '');
    };

    function openDeleteModal(ids) {
        deleteIds = ids;
        var msg = ids.length > 1 
            ? 'คุณต้องการลบ ' + ids.length + ' รายการที่เลือกหรือไม่?'
            : 'คุณต้องการลบข้อมูลนี้หรือไม่?';
        $('#deleteMessage').text(msg);
        $('#deleteModal').addClass('show');
        $('body').css('overflow', 'hidden');
    }

    // Delete button in table
    $('#alumniTable').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        openDeleteModal([id]);
    });

    $('#deleteSelectedBtn').on('click', function() {
        if (selectedIds.length > 0) {
            openDeleteModal([...selectedIds]);
        }
    });

    $('#confirmDeleteBtn').on('click', function() {
        if (deleteIds.length === 0) return;
        
        if (deleteIds.length === 1) {
            // Single delete
            $.ajax({
                url: alumniBaseUrl + '/' + deleteIds[0],
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                success: function() {
                    closeDeleteModal();
                    selectedIds = selectedIds.filter(id => !deleteIds.includes(id));
                    updateSelectionBar();
                    loadData();
                    showToast('ลบข้อมูลสำเร็จ', 'success');
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการลบ');
                }
            });
        } else {
            // Bulk delete
            $.ajax({
                url: alumniBaseUrl + '/bulk-delete',
                type: 'POST',
                data: { ids: deleteIds },
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                success: function() {
                    closeDeleteModal();
                    selectedIds = [];
                    updateSelectionBar();
                    loadData();
                    showToast('ลบข้อมูลสำเร็จ', 'success');
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการลบบางรายการ');
                    loadData();
                }
            });
        }
    });

    // Toast notification
    function showToast(message, type) {
        var toast = $('<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100"><div class="toast show" role="alert"><div class="toast-body d-flex align-items-center gap-2">' +
            '<i class="bi ' + (type === 'success' ? 'bi-check-circle text-success' : 'bi-exclamation-circle text-danger') + '"></i>' +
            message + '</div></div></div>');
        $('body').append(toast);
        setTimeout(function() { toast.fadeOut(function() { $(this).remove(); }); }, 3000);
    }

    // Close modals on ESC
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
            closeDeleteModal();
            closeViewModal();
        }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/student/resources/views/alumni/index.blade.php ENDPATH**/ ?>