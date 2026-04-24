@extends('layouts.app')

@section('title', 'รายงานโครงงานของตัวเอง')

@push('styles')
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
        --apple-shadow: 0 2px 12px rgba(0,0,0,0.08);
        --apple-radius: 16px;
        --apple-radius-sm: 10px;
    }

    .apple-projects { max-width: 100%; padding: 0; }

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

    /* Filter Chips */
    .apple-chips {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        align-items: center;
    }

    .apple-chip {
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
        white-space: nowrap;
    }

    .apple-chip:hover {
        background: #e8e8ed;
        color: var(--apple-text);
    }

    .apple-chip.active {
        background: var(--apple-blue);
        color: #fff;
    }

    .apple-chip i {
        font-size: 12px;
    }

    .apple-chip .chip-close {
        margin-left: 4px;
        opacity: 0.7;
    }

    .apple-chip .chip-close:hover {
        opacity: 1;
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
    #projectsTable { margin: 0 !important; }
    #projectsTable thead th {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--apple-text-secondary);
        white-space: nowrap;
        background: #fafafa;
        border-bottom: 1px solid var(--apple-border);
        padding: 12px 14px;
    }
    #projectsTable tbody td {
        vertical-align: middle;
        font-size: 0.9rem;
        padding: 10px 14px;
        color: var(--apple-text);
    }
    #projectsTable tbody tr { transition: background 0.15s; }
    #projectsTable tbody tr:hover { background: #f5f5f7; }
    #projectsTable tbody tr.selected { background: rgba(0,113,227,0.08); }

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
    .status-badge.proposal { background: #fff3e0; color: #e65100; }
    .status-badge.in_progress { background: #e3f2fd; color: #1565c0; }
    .status-badge.completed { background: #e8f5e9; color: #2e7d32; }
    .status-badge.cancelled { background: #ffebee; color: #c62828; }

    /* Category Badge */
    .category-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 980px;
        font-size: 0.75rem;
        font-weight: 500;
        background: #f0f0f0;
        color: var(--apple-text-secondary);
    }

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
        max-width: 680px;
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

    /* Members Tag Input */
    .members-container {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        padding: 8px 12px;
        border: 1px solid var(--apple-border);
        border-radius: var(--apple-radius-sm);
        min-height: 44px;
        background: #fff;
        cursor: text;
    }
    .members-container:focus-within {
        border-color: var(--apple-blue);
        box-shadow: 0 0 0 3px rgba(0,113,227,0.15);
    }
    .member-tag {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--apple-blue);
        color: #fff;
        padding: 4px 10px;
        border-radius: 980px;
        font-size: 0.8rem;
    }
    .member-tag .remove-tag {
        cursor: pointer;
        opacity: 0.8;
    }
    .member-tag .remove-tag:hover { opacity: 1; }
    .members-input {
        border: none;
        outline: none;
        flex: 1;
        min-width: 120px;
        font-size: 0.9rem;
        background: transparent;
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

    body.dark #projectsTable thead th {
        background: #272727;
        border-bottom-color: var(--yt-border-color);
        color: #aaa;
    }

    body.dark #projectsTable tbody td {
        color: #f1f1f1 !important;
        background: var(--yt-bg-primary);
    }

    body.dark #projectsTable tbody tr {
        border-bottom: 1px solid #3f3f3f;
    }

    body.dark #projectsTable tbody tr:hover {
        background: #272727 !important;
    }

    body.dark #projectsTable tbody tr:hover td {
        background: #272727 !important;
    }

    body.dark #projectsTable tbody tr.selected td {
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

    body.dark .dataTables_wrapper .dataTables_filter input:focus,
    body.dark .dataTables_wrapper .dataTables_length select:focus {
        box-shadow: 0 0 0 3px rgba(62,166,255,0.20) !important;
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

    body.dark .apple-modal-close:hover {
        background: var(--yt-bg-hover);
    }

    body.dark .apple-form .form-control,
    body.dark .apple-form .form-select {
        background: var(--yt-bg-secondary);
        color: var(--yt-text-primary);
        border-color: var(--yt-border-color);
    }

    body.dark .apple-form .form-control::placeholder {
        color: rgba(241,241,241,0.55);
    }

    body.dark .apple-form .form-label {
        color: var(--yt-text-secondary);
    }

    body.dark .apple-table-wrap a {
        color: var(--yt-accent-color);
    }

    /* Dark mode - Apple Filter Controls */
    body.dark .apple-segmented {
        background: #272727;
    }

    body.dark .apple-segmented .segment-btn {
        color: #aaa;
    }

    body.dark .apple-segmented .segment-btn:hover {
        color: #f1f1f1;
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

    body.dark .apple-dropdown-chip .dropdown-btn:hover {
        background: #3a3a3a;
        color: #f1f1f1;
    }

    body.dark .apple-dropdown-chip .dropdown-btn.active {
        background: var(--yt-accent-color);
        color: #0f0f0f;
    }

    body.dark .apple-dropdown-chip .dropdown-menu {
        background: #272727;
        border-color: #3f3f3f;
        box-shadow: 0 8px 32px rgba(0,0,0,0.4);
    }

    body.dark .apple-dropdown-chip .dropdown-item {
        color: #f1f1f1;
    }

    body.dark .apple-dropdown-chip .dropdown-item:hover {
        background: #3a3a3a;
    }

    body.dark .apple-dropdown-chip .dropdown-item.active {
        color: var(--yt-accent-color);
    }

    body.dark .apple-search-box input {
        background: #272727;
        color: #f1f1f1;
    }

    body.dark .apple-search-box input:hover {
        background: #3a3a3a;
    }

    body.dark .apple-search-box input:focus {
        background: #3a3a3a;
        box-shadow: 0 0 0 4px rgba(62,166,255,0.2);
    }

    body.dark .apple-search-box input::placeholder {
        color: #888;
    }

    body.dark .apple-search-box .search-icon {
        color: #888;
    }

    body.dark .active-filter-tag {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    body.dark .clear-all-filters {
        color: #aaa;
        border-color: #3f3f3f;
    }

    body.dark .clear-all-filters:hover {
        background: #272727;
        color: #f1f1f1;
    }

    body.dark .members-container {
        background: var(--yt-bg-secondary);
        border-color: var(--yt-border-color);
    }

    body.dark .members-input {
        color: var(--yt-text-primary);
    }

    body.dark .status-badge.proposal { background: rgba(255,149,0,0.2); color: #ffb340; }
    body.dark .status-badge.in_progress { background: rgba(0,113,227,0.2); color: #3ea6ff; }
    body.dark .status-badge.completed { background: rgba(52,199,89,0.2); color: #4cd964; }
    body.dark .status-badge.cancelled { background: rgba(255,59,48,0.2); color: #ff6b6b; }

    body.dark .category-badge {
        background: #3f3f3f;
        color: #aaa;
    }
</style>
@endpush

@section('content')
<div class="apple-projects">
    <div class="apple-card">
        {{-- Header with Add button --}}
        <div class="apple-header">
            <h2 class="apple-header-title">รายงานโครงงานของตัวเอง</h2>
            <div class="apple-header-actions">
                <button type="button" class="apple-btn apple-btn-secondary" id="refreshBtn">
                    <i class="bi bi-arrow-clockwise"></i> รีเฟรช
                </button>
                <button type="button" class="apple-btn apple-btn-primary" id="addProjectBtn">
                    <i class="bi bi-plus-lg"></i> เพิ่มโครงงาน
                </button>
            </div>
        </div>

        {{-- Filter Bar - Apple Style --}}
        <div class="apple-filter-bar">
            {{-- Status Segmented Control --}}
            <div class="apple-segmented" id="statusSegment">
                <button type="button" class="segment-btn active" data-value="">ทั้งหมด</button>
                <button type="button" class="segment-btn" data-value="proposal">เสนอ</button>
                <button type="button" class="segment-btn" data-value="in_progress">ดำเนินการ</button>
                <button type="button" class="segment-btn" data-value="completed">เสร็จสิ้น</button>
                <button type="button" class="segment-btn" data-value="cancelled">ยกเลิก</button>
            </div>

            {{-- Category Dropdown --}}
            <div class="apple-dropdown-chip" id="categoryDropdown">
                <button type="button" class="dropdown-btn" id="categoryBtn">
                    <i class="bi bi-folder"></i> หมวดหมู่
                </button>
                <div class="dropdown-menu" id="categoryMenu">
                    <div class="dropdown-item active" data-value="">ทั้งหมด</div>
                    <div class="dropdown-item" data-value="Web Application">Web Application</div>
                    <div class="dropdown-item" data-value="Mobile Application">Mobile Application</div>
                    <div class="dropdown-item" data-value="AI/Machine Learning">AI / Machine Learning</div>
                    <div class="dropdown-item" data-value="IoT">IoT</div>
                    <div class="dropdown-item" data-value="Game Development">Game Development</div>
                    <div class="dropdown-item" data-value="Data Science">Data Science</div>
                    <div class="dropdown-item" data-value="Other">อื่นๆ</div>
                </div>
            </div>

            {{-- Year Dropdown --}}
            <div class="apple-dropdown-chip" id="yearDropdown">
                <button type="button" class="dropdown-btn" id="yearBtn">
                    <i class="bi bi-calendar3"></i> ปีการศึกษา
                </button>
                <div class="dropdown-menu" id="yearMenu">
                    <div class="dropdown-item active" data-value="">ทั้งหมด</div>
                    @for($y = 2569; $y >= 2560; $y--)
                        <div class="dropdown-item" data-value="{{ $y }}">{{ $y }}</div>
                    @endfor
                </div>
            </div>

            {{-- Search Box --}}
            <div class="apple-search-box">
                <i class="bi bi-search search-icon"></i>
                <input type="text" id="filterSearch" placeholder="ค้นหาโครงงาน...">
            </div>
        </div>

        {{-- Active Filters Display --}}
        <div class="active-filters" id="activeFilters" style="display: none;"></div>

        {{-- Selection action bar --}}
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
            <table id="projectsTable" class="table table-hover align-middle" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th style="width:40px"><input type="checkbox" class="row-checkbox" id="selectAll"></th>
                        <th>รหัสโครงงาน</th>
                        <th>ชื่อโครงงาน</th>
                        <th>หมวดหมู่</th>
                        <th>ปี/เทอม</th>
                        <th>อาจารย์ที่ปรึกษา</th>
                        <th>สมาชิก</th>
                        <th>สถานะ</th>
                        <th>คะแนน</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data loaded via AJAX --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Project Modal --}}
<div class="apple-modal-backdrop" id="projectModal">
    <div class="apple-modal">
        <div class="apple-modal-header">
            <h3 class="apple-modal-title" id="modalTitle">เพิ่มโครงงาน</h3>
            <button type="button" class="apple-modal-close" id="closeModal">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="apple-modal-body">
            <form id="projectForm" class="apple-form">
                @csrf
                <input type="hidden" name="id" id="project_id">

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">รหัสโครงงาน <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="project_code" id="project_code" required placeholder="เช่น PRJ-2569-001">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">ชื่อโครงงาน <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" id="title" required placeholder="ชื่อโครงงาน">
                    </div>
                    <div class="col-12">
                        <label class="form-label">รายละเอียด</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="รายละเอียดโครงงาน..."></textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">หมวดหมู่ <span class="text-danger">*</span></label>
                        <select class="form-select" name="category" id="category" required>
                            <option value="">-- เลือกหมวดหมู่ --</option>
                            <option value="Web Application">Web Application</option>
                            <option value="Mobile Application">Mobile Application</option>
                            <option value="AI/Machine Learning">AI/Machine Learning</option>
                            <option value="IoT">IoT</option>
                            <option value="Game Development">Game Development</option>
                            <option value="Data Science">Data Science</option>
                            <option value="Other">อื่นๆ</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ปีการศึกษา <span class="text-danger">*</span></label>
                        <select class="form-select" name="academic_year" id="academic_year" required>
                            <option value="">-- เลือกปี --</option>
                            @for($y = 2569; $y >= 2560; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ภาคเรียน <span class="text-danger">*</span></label>
                        <select class="form-select" name="semester" id="semester" required>
                            <option value="">-- เลือกเทอม --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3 (ฤดูร้อน)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">อาจารย์ที่ปรึกษา</label>
                        <input type="text" class="form-control" name="advisor" id="advisor" placeholder="ชื่ออาจารย์ที่ปรึกษา">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">สถานะ <span class="text-danger">*</span></label>
                        <select class="form-select" name="status" id="status" required>
                            <option value="proposal">เสนอโครงงาน</option>
                            <option value="in_progress">กำลังดำเนินการ</option>
                            <option value="completed">เสร็จสิ้น</option>
                            <option value="cancelled">ยกเลิก</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">สมาชิกในกลุ่ม</label>
                        <div class="members-container" id="membersContainer">
                            <input type="text" class="members-input" id="memberInput" placeholder="พิมพ์ชื่อแล้วกด Enter เพื่อเพิ่ม">
                        </div>
                        <input type="hidden" name="members" id="membersHidden">
                        <small class="text-muted">กด Enter หรือ , (จุลภาค) เพื่อเพิ่มสมาชิก</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">URL เอกสาร</label>
                        <input type="url" class="form-control" name="document_url" id="document_url" placeholder="https://...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">URL Repository</label>
                        <input type="url" class="form-control" name="repository_url" id="repository_url" placeholder="https://github.com/...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">คะแนน (0-100)</label>
                        <input type="number" class="form-control" name="score" id="score" min="0" max="100" placeholder="คะแนน">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">หมายเหตุ</label>
                        <input type="text" class="form-control" name="notes" id="notes" placeholder="หมายเหตุเพิ่มเติม">
                    </div>
                </div>
            </form>
        </div>
        <div class="apple-modal-footer">
            <button type="button" class="apple-btn apple-btn-secondary" id="cancelModalBtn">ยกเลิก</button>
            <button type="button" class="apple-btn apple-btn-primary" id="saveProjectBtn">
                <i class="bi bi-check-lg"></i> บันทึก
            </button>
        </div>
    </div>
</div>

{{-- Confirm Delete Modal --}}
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

{{-- View Detail Modal --}}
<div class="apple-modal-backdrop" id="viewModal">
    <div class="apple-modal" style="max-width: 600px;">
        <div class="apple-modal-header">
            <h3 class="apple-modal-title">รายละเอียดโครงงาน</h3>
            <button type="button" class="apple-modal-close" onclick="closeViewModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="apple-modal-body" id="viewModalBody">
            {{-- Content loaded via JS --}}
        </div>
        <div class="apple-modal-footer">
            <button type="button" class="apple-btn apple-btn-secondary" onclick="closeViewModal()">ปิด</button>
            <button type="button" class="apple-btn apple-btn-primary" id="editFromViewBtn">
                <i class="bi bi-pencil"></i> แก้ไข
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function(){
    var projectsDataUrl = '{{ route("projects.data") }}';
    var projectsBaseUrl = '{{ url("projects") }}';
    var csrfToken = '{{ csrf_token() }}';

    var table;
    var projectsData = [];
    var selectedIds = [];
    var members = [];
    var currentViewProject = null;
    
    // Filter state
    var filterStatus = '';
    var filterCategory = '';
    var filterYear = '';

    // Status labels
    var statusLabels = {
        'proposal': 'เสนอโครงงาน',
        'in_progress': 'กำลังดำเนินการ',
        'completed': 'เสร็จสิ้น',
        'cancelled': 'ยกเลิก'
    };

    // Load Data
    function loadData() {
        var params = {
            search: $('#filterSearch').val(),
            status: filterStatus,
            category: filterCategory,
            year: filterYear
        };

        $.ajax({
            url: projectsDataUrl,
            data: params,
            success: function(res) {
                projectsData = res.data || [];
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

        var tbody = $('#projectsTable tbody');
        tbody.empty();

        projectsData.forEach(function(p) {
            var membersArr = p.members || [];
            var membersHtml = membersArr.length > 0 
                ? membersArr.slice(0, 2).join(', ') + (membersArr.length > 2 ? ' +' + (membersArr.length - 2) : '')
                : '-';

            var statusClass = p.status || 'proposal';
            var statusLabel = statusLabels[p.status] || p.status;

            var row = `
                <tr data-id="${p.id}" data-project='${JSON.stringify(p).replace(/'/g, "&#39;")}'>
                    <td><input type="checkbox" class="row-checkbox row-select" data-id="${p.id}"></td>
                    <td><strong>${p.project_code || '-'}</strong></td>
                    <td>
                        <a href="#" class="view-project text-decoration-none" data-id="${p.id}">
                            ${p.title || '-'}
                        </a>
                    </td>
                    <td><span class="category-badge">${p.category || '-'}</span></td>
                    <td>${p.academic_year || '-'}/${p.semester || '-'}</td>
                    <td>${p.advisor || '-'}</td>
                    <td title="${membersArr.join(', ')}">${membersHtml}</td>
                    <td><span class="status-badge ${statusClass}">${statusLabel}</span></td>
                    <td>${p.score !== null ? p.score : '-'}</td>
                    <td>
                        <button type="button" class="apple-btn apple-btn-sm apple-btn-secondary edit-btn" data-id="${p.id}" title="แก้ไข">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="apple-btn apple-btn-sm apple-btn-danger delete-btn" data-id="${p.id}" title="ลบ">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });

        table = $('#projectsTable').DataTable({
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
                emptyTable: "ไม่มีข้อมูลโครงงาน"
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

    // ========== Apple-style Filter Controls ==========
    
    var categoryLabels = {
        'Web Application': 'Web Application',
        'Mobile Application': 'Mobile App',
        'AI/Machine Learning': 'AI/ML',
        'IoT': 'IoT',
        'Game Development': 'Game',
        'Data Science': 'Data Science',
        'Other': 'อื่นๆ'
    };

    // Status Segmented Control
    $('#statusSegment .segment-btn').on('click', function() {
        $('#statusSegment .segment-btn').removeClass('active');
        $(this).addClass('active');
        filterStatus = $(this).data('value');
        updateActiveFiltersDisplay();
        loadData();
    });

    // Category Dropdown
    $('#categoryBtn').on('click', function(e) {
        e.stopPropagation();
        closeAllDropdowns();
        $('#categoryMenu').toggleClass('show');
    });

    $('#categoryMenu .dropdown-item').on('click', function() {
        $('#categoryMenu .dropdown-item').removeClass('active');
        $(this).addClass('active');
        filterCategory = $(this).data('value');
        
        var label = filterCategory ? categoryLabels[filterCategory] || filterCategory : 'หมวดหมู่';
        $('#categoryBtn').html('<i class="bi bi-folder"></i> ' + label);
        $('#categoryBtn').toggleClass('active', filterCategory !== '');
        
        $('#categoryMenu').removeClass('show');
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
        
        var label = filterYear ? 'ปี ' + filterYear : 'ปีการศึกษา';
        $('#yearBtn').html('<i class="bi bi-calendar3"></i> ' + label);
        $('#yearBtn').toggleClass('active', filterYear !== '');
        
        $('#yearMenu').removeClass('show');
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

        if (filterCategory) {
            hasFilters = true;
            html += '<span class="active-filter-tag">' + (categoryLabels[filterCategory] || filterCategory) + ' <i class="bi bi-x remove-filter" data-filter="category"></i></span>';
        }

        if (filterYear) {
            hasFilters = true;
            html += '<span class="active-filter-tag">ปี ' + filterYear + ' <i class="bi bi-x remove-filter" data-filter="year"></i></span>';
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
        if (filter === 'category') {
            filterCategory = '';
            $('#categoryMenu .dropdown-item').removeClass('active').first().addClass('active');
            $('#categoryBtn').html('<i class="bi bi-folder"></i> หมวดหมู่').removeClass('active');
        } else if (filter === 'year') {
            filterYear = '';
            $('#yearMenu .dropdown-item').removeClass('active').first().addClass('active');
            $('#yearBtn').html('<i class="bi bi-calendar3"></i> ปีการศึกษา').removeClass('active');
        }
        updateActiveFiltersDisplay();
        loadData();
    });

    // Clear all filters
    $('#activeFilters').on('click', '.clear-all-filters', function() {
        filterStatus = '';
        filterCategory = '';
        filterYear = '';
        
        $('#statusSegment .segment-btn').removeClass('active').first().addClass('active');
        $('#categoryMenu .dropdown-item').removeClass('active').first().addClass('active');
        $('#categoryBtn').html('<i class="bi bi-folder"></i> หมวดหมู่').removeClass('active');
        $('#yearMenu .dropdown-item').removeClass('active').first().addClass('active');
        $('#yearBtn').html('<i class="bi bi-calendar3"></i> ปีการศึกษา').removeClass('active');
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

    // Selection handling
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
    $('#projectsTable').on('change', '.row-select', function() {
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

    // Members tag input
    function renderMemberTags() {
        $('#membersContainer .member-tag').remove();
        members.forEach(function(m, i) {
            var tag = $('<span class="member-tag">' + m + ' <span class="remove-tag" data-index="' + i + '">&times;</span></span>');
            $('#memberInput').before(tag);
        });
        $('#membersHidden').val(JSON.stringify(members));
    }

    $('#memberInput').on('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            var val = $(this).val().trim().replace(',', '');
            if (val && !members.includes(val)) {
                members.push(val);
                renderMemberTags();
            }
            $(this).val('');
        }
    });

    $('#membersContainer').on('click', '.remove-tag', function() {
        var index = $(this).data('index');
        members.splice(index, 1);
        renderMemberTags();
    });

    $('#membersContainer').on('click', function() {
        $('#memberInput').focus();
    });

    // Modal functions
    function openModal(title) {
        $('#modalTitle').text(title || 'เพิ่มโครงงาน');
        $('#projectModal').addClass('show');
        $('body').css('overflow', 'hidden');
    }

    function closeModal() {
        $('#projectModal').removeClass('show');
        $('body').css('overflow', '');
        resetForm();
    }

    function resetForm() {
        $('#projectForm')[0].reset();
        $('#project_id').val('');
        members = [];
        renderMemberTags();
    }

    function openEditModal(project) {
        openModal('แก้ไขโครงงาน');
        $('#project_id').val(project.id);
        $('#project_code').val(project.project_code || '');
        $('#title').val(project.title || '');
        $('#description').val(project.description || '');
        $('#category').val(project.category || '');
        $('#academic_year').val(project.academic_year || '');
        $('#semester').val(project.semester || '');
        $('#advisor').val(project.advisor || '');
        $('#status').val(project.status || 'proposal');
        $('#document_url').val(project.document_url || '');
        $('#repository_url').val(project.repository_url || '');
        $('#score').val(project.score || '');
        $('#notes').val(project.notes || '');
        
        members = project.members || [];
        renderMemberTags();
    }

    // Add button
    $('#addProjectBtn').on('click', function() {
        resetForm();
        openModal('');
    });

    // Close modal
    $('#closeModal, #cancelModalBtn').on('click', closeModal);
    $('#projectModal').on('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Edit button in table
    $('#projectsTable').on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        var project = projectsData.find(p => p.id === id);
        if (project) openEditModal(project);
    });

    // Edit selected button
    $('#editSelectedBtn').on('click', function() {
        if (selectedIds.length === 1) {
            var project = projectsData.find(p => p.id === selectedIds[0]);
            if (project) openEditModal(project);
        }
    });

    // Row double-click to edit
    $('#projectsTable').on('dblclick', 'tbody tr', function() {
        var id = $(this).data('id');
        var project = projectsData.find(p => p.id === id);
        if (project) openEditModal(project);
    });

    // View project
    $('#projectsTable').on('click', '.view-project', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var project = projectsData.find(p => p.id === id);
        if (project) openViewModal(project);
    });

    function openViewModal(project) {
        currentViewProject = project;
        var membersArr = project.members || [];
        var statusLabel = statusLabels[project.status] || project.status;
        
        var html = `
            <div class="mb-3">
                <strong>รหัสโครงงาน:</strong> ${project.project_code || '-'}
            </div>
            <div class="mb-3">
                <strong>ชื่อโครงงาน:</strong> ${project.title || '-'}
            </div>
            <div class="mb-3">
                <strong>รายละเอียด:</strong><br>
                ${project.description || '-'}
            </div>
            <div class="row mb-3">
                <div class="col-md-6"><strong>หมวดหมู่:</strong> ${project.category || '-'}</div>
                <div class="col-md-6"><strong>ปี/เทอม:</strong> ${project.academic_year || '-'}/${project.semester || '-'}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6"><strong>อาจารย์ที่ปรึกษา:</strong> ${project.advisor || '-'}</div>
                <div class="col-md-6"><strong>สถานะ:</strong> <span class="status-badge ${project.status}">${statusLabel}</span></div>
            </div>
            <div class="mb-3">
                <strong>สมาชิก:</strong> ${membersArr.length > 0 ? membersArr.join(', ') : '-'}
            </div>
            <div class="row mb-3">
                <div class="col-md-6"><strong>คะแนน:</strong> ${project.score !== null ? project.score : '-'}</div>
                <div class="col-md-6"><strong>หมายเหตุ:</strong> ${project.notes || '-'}</div>
            </div>
            ${project.document_url ? '<div class="mb-3"><strong>เอกสาร:</strong> <a href="' + project.document_url + '" target="_blank">' + project.document_url + '</a></div>' : ''}
            ${project.repository_url ? '<div class="mb-3"><strong>Repository:</strong> <a href="' + project.repository_url + '" target="_blank">' + project.repository_url + '</a></div>' : ''}
        `;
        
        $('#viewModalBody').html(html);
        $('#viewModal').addClass('show');
        $('body').css('overflow', 'hidden');
    }

    window.closeViewModal = function() {
        $('#viewModal').removeClass('show');
        $('body').css('overflow', '');
        currentViewProject = null;
    };

    $('#editFromViewBtn').on('click', function() {
        if (currentViewProject) {
            closeViewModal();
            openEditModal(currentViewProject);
        }
    });

    // Save project
    $('#saveProjectBtn').on('click', function(e) {
        e.preventDefault();
        var id = $('#project_id').val();
        var url = projectsBaseUrl;
        var method = 'POST';
        
        if (id) {
            url = projectsBaseUrl + '/' + id;
            method = 'PUT';
        }

        var formData = {
            project_code: $('#project_code').val(),
            title: $('#title').val(),
            description: $('#description').val(),
            category: $('#category').val(),
            academic_year: $('#academic_year').val(),
            semester: $('#semester').val(),
            advisor: $('#advisor').val(),
            status: $('#status').val(),
            members: members,
            document_url: $('#document_url').val(),
            repository_url: $('#repository_url').val(),
            score: $('#score').val() || null,
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
                    showToast(id ? 'แก้ไขโครงงานสำเร็จ' : 'เพิ่มโครงงานสำเร็จ', 'success');
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

    // Delete Modal
    var deleteIds = [];

    window.closeDeleteModal = function() {
        $('#deleteModal').removeClass('show');
        $('body').css('overflow', '');
    };

    function openDeleteModal(ids) {
        deleteIds = ids;
        var msg = ids.length > 1 
            ? 'คุณต้องการลบ ' + ids.length + ' โครงงานที่เลือกหรือไม่?'
            : 'คุณต้องการลบโครงงานนี้หรือไม่?';
        $('#deleteMessage').text(msg);
        $('#deleteModal').addClass('show');
        $('body').css('overflow', 'hidden');
    }

    // Delete button in table
    $('#projectsTable').on('click', '.delete-btn', function() {
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
                url: projectsBaseUrl + '/' + deleteIds[0],
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
                    showToast('ลบโครงงานสำเร็จ', 'success');
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการลบ');
                }
            });
        } else {
            // Bulk delete
            $.ajax({
                url: projectsBaseUrl + '/bulk-delete',
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
                    showToast('ลบโครงงานสำเร็จ', 'success');
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
@endpush
