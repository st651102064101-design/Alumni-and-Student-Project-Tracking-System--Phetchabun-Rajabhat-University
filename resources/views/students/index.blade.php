@extends('layouts.app')

@section('title', 'จัดการข้อมูลนักศึกษา')

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
        --apple-shadow: 0 2px 12px rgba(0,0,0,0.08);
        --apple-radius: 16px;
        --apple-radius-sm: 10px;
    }

    .apple-students { max-width: 100%; padding: 0; }

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
    #studentsTable { margin: 0 !important; }
    #studentsTable thead th {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--apple-text-secondary);
        white-space: nowrap;
        background: #fafafa;
        border-bottom: 1px solid var(--apple-border);
        padding: 12px 14px;
    }
    #studentsTable tbody td {
        vertical-align: middle;
        font-size: 0.9rem;
        padding: 10px 14px;
        color: var(--apple-text);
    }
    #studentsTable tbody tr { transition: background 0.15s; }
    #studentsTable tbody tr:hover { background: #f5f5f7; }
    #studentsTable tbody tr.selected { background: rgba(0,113,227,0.08); }

    /* Checkbox styling */
    .row-checkbox {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: var(--apple-blue);
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
        max-width: 560px;
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

    @media (max-width: 768px) {
        .apple-card { padding: 16px; }
        .apple-header { flex-direction: column; align-items: stretch; }
        .apple-header-actions { justify-content: flex-end; }
        .selection-bar { flex-wrap: wrap; }
    }

    /* Dark mode (match layout's YouTube dark theme) */
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

    body.dark #studentsTable thead th {
        background: #272727;
        border-bottom-color: var(--yt-border-color);
        color: #aaa;
    }

    body.dark #studentsTable tbody td {
        color: #f1f1f1 !important;
        background: var(--yt-bg-primary);
    }

    body.dark #studentsTable tbody tr {
        border-bottom: 1px solid #3f3f3f;
    }

    body.dark #studentsTable tbody tr:hover {
        background: #272727 !important;
    }

    body.dark #studentsTable tbody tr:hover td {
        background: #272727 !important;
    }

    body.dark #studentsTable tbody tr.selected td {
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
</style>
@endpush

@section('content')
<div class="apple-students">
    <div class="apple-card">
        {{-- Header with Add button --}}
        <div class="apple-header">
            <h2 class="apple-header-title">รายการนักศึกษา</h2>
            <div class="apple-header-actions">
                <button type="button" class="apple-btn apple-btn-primary" id="addStudentBtn">
                    <i class="bi bi-plus-lg"></i> เพิ่มนักศึกษา
                </button>
            </div>
        </div>

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

        @php
            use App\Models\Student;
            $students = Student::select('id','std_id','first_name','last_name','email','phone','photo_id','attachments','created_at','updated_at')->get();
        @endphp

        <div class="apple-table-wrap table-responsive">
            <table id="studentsTable" class="table table-hover align-middle" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th style="width:40px"><input type="checkbox" class="row-checkbox" id="selectAll"></th>
                        <th>ID</th>
                        <th>รหัส (std_id)</th>
                        <th>ชื่อ-สกุล</th>
                        <th>อีเมล</th>
                        <th>เบอร์โทร</th>
                        <th>รูป</th>
                        <th>ไฟล์แนบ</th>
                        <th>สร้างเมื่อ</th>
                        <th>อัพเดตเมื่อ</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($students as $s)
                    <tr data-student='@json($s)' data-id="{{ $s->id }}">
                        <td><input type="checkbox" class="row-checkbox row-select" data-id="{{ $s->id }}"></td>
                        <td>{{ $s->id ?? '-' }}</td>
                        <td>{{ $s->std_id ?? '-' }}</td>
                        <td>{{ ($s->first_name || $s->last_name) ? trim(($s->first_name ?? '') . ' ' . ($s->last_name ?? '')) : '-' }}</td>
                        <td>{{ $s->email ?? '-' }}</td>
                        <td>{{ $s->phone ?? '-' }}</td>
                        <td>
                            @if(!empty($s->photo_id))
                                <img src="{{ asset('storage/' . $s->photo_id) }}" alt="photo" style="height:40px; width:40px; object-fit:cover; border-radius:6px">
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @php
                                $atts = null;
                                if(!empty($s->attachments)) {
                                    $atts = is_string($s->attachments) ? json_decode($s->attachments, true) : $s->attachments;
                                }
                            @endphp
                            @if(!empty($atts) && is_array($atts))
                                @foreach($atts as $a)
                                    <a href="{{ asset('storage/' . $a) }}" target="_blank" class="d-block">ไฟล์</a>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $s->created_at ?? '-' }}</td>
                        <td>{{ $s->updated_at ?? '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Student Modal --}}
<div class="apple-modal-backdrop" id="studentModal">
    <div class="apple-modal">
        <div class="apple-modal-header">
            <h3 class="apple-modal-title" id="modalTitle">เพิ่มนักศึกษา</h3>
            <button type="button" class="apple-modal-close" id="closeModal">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="apple-modal-body">
            <form id="studentForm" class="apple-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="_method" value="">
                <input type="hidden" name="id" id="id">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">รหัสนักศึกษา (std_id)</label>
                        <input type="text" class="form-control" name="std_id" id="std_id" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">ชื่อ (first_name)</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">นามสกุล (last_name)</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">อีเมล (email)</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">เบอร์โทร (phone)</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">รูปนักศึกษา (photo_id)</label>
                        <input type="file" class="form-control" name="photo_id" id="photo_id" accept="image/*">
                    </div>
                    <div class="col-12" id="currentPhotoWrap" style="display:none;">
                        <label class="form-label">รูปปัจจุบัน</label>
                        <div id="currentPhotoPreview"></div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">ไฟล์แนบ (attachments)</label>
                        <input type="file" class="form-control" name="attachments[]" id="attachments" multiple>
                    </div>
                    <div class="col-12" id="currentAttachmentsWrap" style="display:none;">
                        <label class="form-label">ไฟล์แนบปัจจุบัน</label>
                        <div id="currentAttachmentsList"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="apple-modal-footer">
            <button type="button" class="apple-btn apple-btn-secondary" id="cancelModalBtn">ยกเลิก</button>
            <button type="button" class="apple-btn apple-btn-primary" id="saveStudentBtn">
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
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function(){
    // Important: build endpoints via Laravel helpers (works when app is hosted under a subdirectory like /student)
    var studentsBaseUrl = '{{ url('students') }}';

    // DataTable
    var table = $('#studentsTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        order: [[1, 'desc']],
        pageLength: 10,
        columnDefs: [
            { orderable: false, targets: 0 }
        ]
    });

    // Selection handling
    var selectedIds = [];

    function updateSelectionBar() {
        var count = selectedIds.length;
        $('#selectedCount').text(count);
        if (count > 0) {
            $('#selectionBar').addClass('show');
            // Show edit button only if 1 selected
            if (count === 1) {
                $('#editSelectedBtn').show();
            } else {
                $('#editSelectedBtn').hide();
            }
        } else {
            $('#selectionBar').removeClass('show');
        }
    }

    // Select all checkbox
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
    $('#studentsTable').on('change', '.row-select', function() {
        var id = $(this).data('id');
        var tr = $(this).closest('tr');
        if ($(this).is(':checked')) {
            if (!selectedIds.includes(id)) selectedIds.push(id);
            tr.addClass('selected');
        } else {
            selectedIds = selectedIds.filter(x => x !== id);
            tr.removeClass('selected');
        }
        // Update select all checkbox
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

    // Row double-click to edit
    $('#studentsTable').on('dblclick', 'tbody tr', function() {
        var studentJson = $(this).attr('data-student');
        if (studentJson) {
            openEditModal(JSON.parse(studentJson));
        }
    });

    // Modal functions
    function openModal(title) {
        $('#modalTitle').text(title || 'เพิ่มนักศึกษา');
        $('#studentModal').addClass('show');
        $('body').css('overflow', 'hidden');
    }

    function closeModal() {
        $('#studentModal').removeClass('show');
        $('body').css('overflow', '');
        resetForm();
    }

    function resetForm() {
        $('#studentForm')[0].reset();
        $('#id').val('');
        $('#_method').val('');
        $('#currentPhotoWrap').hide();
        $('#currentPhotoPreview').html('');
        $('#currentAttachmentsWrap').hide();
        $('#currentAttachmentsList').html('');
    }

    function openEditModal(student) {
        openModal('แก้ไขข้อมูลนักศึกษา');
        $('#id').val(student.id || '');
        $('#_method').val('PUT');
        $('#std_id').val(student.std_id || '');
        $('#first_name').val(student.first_name || '');
        $('#last_name').val(student.last_name || '');
        $('#email').val(student.email || '');
        $('#phone').val(student.phone || '');
        
        if (student.photo_id) {
            $('#currentPhotoPreview').html('<img src="{{ asset("storage") }}/' + student.photo_id + '" style="height:80px; object-fit:cover; border-radius:8px">');
            $('#currentPhotoWrap').show();
        }
    }

    // Add button
    $('#addStudentBtn').on('click', function() {
        resetForm();
        openModal('เพิ่มนักศึกษาใหม่');
    });

    // Close modal buttons
    $('#closeModal, #cancelModalBtn').on('click', closeModal);
    $('#studentModal').on('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Edit selected button
    $('#editSelectedBtn').on('click', function() {
        if (selectedIds.length === 1) {
            var tr = $('tr[data-id="' + selectedIds[0] + '"]');
            var studentJson = tr.attr('data-student');
            if (studentJson) {
                openEditModal(JSON.parse(studentJson));
            }
        }
    });

    // Save student
    $('#saveStudentBtn').on('click', function(e) {
        e.preventDefault();
        var id = $('#id').val();
        var url = '{{ route("students.store") }}';
        if (id) {
            url = studentsBaseUrl + '/' + id;
            $('#_method').val('PUT');
        } else {
            $('#_method').val('');
        }

        var form = $('#studentForm')[0];
        var formData = new FormData(form);

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: { 
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            success: function(res) {
                if (res.success && res.student) {
                    location.reload();
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
            ? 'คุณต้องการลบ ' + ids.length + ' รายการที่เลือกหรือไม่?'
            : 'คุณต้องการลบข้อมูลนี้หรือไม่?';
        $('#deleteMessage').text(msg);
        $('#deleteModal').addClass('show');
        $('body').css('overflow', 'hidden');
    }

    $('#deleteSelectedBtn').on('click', function() {
        if (selectedIds.length > 0) {
            openDeleteModal([...selectedIds]);
        }
    });

    $('#confirmDeleteBtn').on('click', function() {
        if (deleteIds.length === 0) return;
        
        var promises = deleteIds.map(function(id) {
            return $.ajax({
                url: studentsBaseUrl + '/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
        });

        Promise.all(promises)
            .then(function() {
                location.reload();
            })
            .catch(function() {
                alert('เกิดข้อผิดพลาดในการลบบางรายการ');
                location.reload();
            });
    });

    // Close modals on ESC
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
            closeDeleteModal();
        }
    });
});
</script>
@endpush
