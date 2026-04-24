<?php $__env->startSection('title', 'จัดการข้อมูลสถานที่ฝึกงาน'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .apple-dashboard {
        padding: 24px 20px 32px;
    }

    .apple-dashboard > * + * {
        margin-top: 24px;
    }

    .apple-hero {
        position: relative;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        color: #f8fafc;
        border-radius: 28px;
        overflow: hidden;
        padding: 32px;
        box-shadow: 0 24px 70px rgba(15, 23, 42, 0.16);
    }

    .apple-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top right, rgba(96, 165, 250, 0.24), transparent 35%), radial-gradient(circle at bottom left, rgba(74, 222, 128, 0.18), transparent 25%);
        pointer-events: none;
    }

    .apple-hero .hero-content {
        position: relative;
        z-index: 1;
    }

    .apple-hero h1 {
        font-size: 2.35rem;
        line-height: 1.05;
        margin-bottom: 0.75rem;
    }

    .apple-hero p {
        color: rgba(226, 232, 240, 0.9);
        max-width: 60ch;
        margin-bottom: 1.75rem;
    }

    .hero-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }

    .hero-stat {
        flex: 1 1 220px;
        min-width: 190px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 22px;
        padding: 20px 22px;
        box-shadow: 0 16px 32px rgba(15, 23, 42, 0.08);
    }

    .hero-stat .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #0f172a;
    }

    .hero-stat .stat-label {
        color: #475569;
        margin-top: 0.35rem;
        font-size: 0.95rem;
    }

    .section-card {
        background: #ffffff;
        border-radius: 28px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 20px 50px rgba(15, 23, 42, 0.06);
        overflow: hidden;
    }

    .section-card .card-header {
        padding: 20px 24px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .section-card .card-header h2 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .filter-row {
        display: grid;
        gap: 16px;
    }

    @media (min-width: 768px) {
        .filter-row {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    .data-table-wrapper {
        overflow-x: auto;
    }

    .data-table-wrapper table {
        min-width: 780px;
        margin-bottom: 0;
    }

    .content-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
    }

    .content-card h2 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #0f172a;
    }

    .chart-container {
        position: relative;
        width: 100%;
        min-height: 240px;
    }

    .chart-container canvas {
        max-height: 320px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.35rem 0.75rem;
        border-radius: 999px;
        font-size: 0.82rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-badge.pending { background: #ffedd5; color: #b45309; }
    .status-badge.in_progress { background: #dbeafe; color: #1d4ed8; }
    .status-badge.completed { background: #d1fae5; color: #166534; }

    .btn-ghost {
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #0f172a;
    }

    .btn-ghost:hover {
        background: #f1f5f9;
    }

    .table-empty {
        min-height: 220px;
    }

    @media (max-width: 767px) {
        .apple-dashboard { padding: 18px 14px 24px; }
        .hero-stats { flex-direction: column; }
        .section-card .card-header { padding: 18px 18px; }
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="apple-dashboard">
    <div class="apple-hero">
        <div class="hero-content">
            <h1>จัดการและรายงานสถานที่ฝึกงาน</h1>
            <p>เพิ่ม แก้ไข และตรวจสอบข้อมูลสถานที่ฝึกงานด้วยอินเทอร์เฟซที่สวยงามและทันสมัยเหมือนหน้าแดชบอร์ดหลัก</p>
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="stat-value" id="summaryTotal">0</div>
                    <div class="stat-label">รายการทั้งหมด</div>
                </div>
                <div class="hero-stat">
                    <div class="stat-value" id="summaryInProgress">0</div>
                    <div class="stat-label">กำลังฝึกงาน</div>
                </div>
                <div class="hero-stat">
                    <div class="stat-value" id="summaryCompleted">0</div>
                    <div class="stat-label">เสร็จสิ้น</div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-card">
        <div class="card-header">
            <h2><i class="fas fa-building text-primary"></i> รายงานและจัดการสถานที่ฝึกงาน</h2>
            <div class="d-flex flex-wrap gap-2">
                <button id="btnBulkDelete" class="btn btn-danger d-none" onclick="bulkDelete()">
                    <i class="fas fa-trash-alt me-2"></i> ลบที่เลือก (<span id="selectedCount">0</span>)
                </button>
                <button id="btnAddInternship" class="btn btn-primary" type="button">
                    <i class="fas fa-plus me-2"></i> เพิ่มข้อมูล
                </button>
            </div>
        </div>

        <div class="px-4 py-4 border-bottom">
            <div class="filter-row">
                <div>
                    <label class="form-label">ค้นหา</label>
                    <div class="position-relative">
                        <i class="fas fa-search position-absolute top-50 translate-middle-y" style="left: 14px; color:#9ca3af;"></i>
                        <input type="text" id="searchFilter" class="form-control ps-5" placeholder="รหัส, ชื่อ, หรือบริษัท...">
                    </div>
                </div>
                <div>
                    <label class="form-label">สถานะ</label>
                    <select id="statusFilter" class="form-select">
                        <option value="">ทั้งหมด</option>
                        <option value="pending">รอดำเนินการ</option>
                        <option value="in_progress">กำลังฝึกงาน</option>
                        <option value="completed">เสร็จสิ้น</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">ปีการศึกษา</label>
                    <select id="yearFilter" class="form-select">
                        <option value="">ทั้งหมด</option>
                        <?php for($year = date('Y') + 543; $year >= date('Y') + 543 - 5; $year--): ?>
                            <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="px-4 py-4">
            <div class="content-card">
                <h2><i class="fas fa-chart-pie text-primary"></i> สถานะการฝึกงาน</h2>
                <div class="chart-container">
                    <canvas id="internshipStatusChart"></canvas>
                </div>
            </div>
            <div class="data-table-wrapper">
                <table class="table table-hover align-middle mb-0" id="dataTable">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center" style="width: 60px;">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th scope="col">รหัสนักศึกษา / ชื่อ</th>
                            <th scope="col">บริษัท / ตำแหน่ง</th>
                            <th scope="col" class="text-center">ปีการศึกษา</th>
                            <th scope="col" class="text-center">สถานะ</th>
                            <th scope="col" class="text-end">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr><td colspan="6" class="text-center py-5 text-secondary"><i class="fas fa-spinner fa-spin me-2"></i> กำลังโหลดข้อมูล...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="formModal" class="position-fixed top-0 start-0 vw-100 vh-100 bg-dark bg-opacity-50 d-none overflow-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="z-index: 1050;">
    <div class="d-flex align-items-center justify-content-center min-vh-100 p-3">
        <div class="bg-white rounded-4 shadow" style="width: 100%; max-width: 760px;">
            <form id="dataForm" onsubmit="saveData(event)">
                <?php echo csrf_field(); ?>
                <input type="hidden" id="entityId" name="id">

                <div class="border-bottom px-4 py-3">
                    <h3 class="h5 mb-0 d-flex align-items-center gap-2" id="modal-title">
                        <i class="fas fa-edit text-primary"></i> <span id="modalTitleText">เพิ่มข้อมูล</span>
                    </h3>
                </div>

                <div class="px-4 py-4">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label">รหัสนักศึกษา <span class="text-danger">*</span></label>
                            <select name="student_id" id="student_id" required class="form-select"></select>
                        <!-- select2 will be loaded in the scripts stack below -->
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                            <input type="text" name="student_name" id="student_name" required class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">ชื่อบริษัท/หน่วยงาน <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" id="company_name" required class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">ที่อยู่หน่วยงาน</label>
                            <textarea name="company_address" id="company_address" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">ตำแหน่งที่ฝึกงาน</label>
                            <input type="text" name="job_role" id="job_role" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">วันที่เริ่มฝึกงาน</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">วันสิ้นสุดฝึกงาน</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">ปีการศึกษา <span class="text-danger">*</span></label>
                            <input type="number" name="academic_year" id="academic_year" value="<?php echo e(date('Y') + 543); ?>" required class="form-control">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">ภาคเรียน <span class="text-danger">*</span></label>
                            <select name="semester" id="semester" required class="form-select">
                                <option value="1">1</option>
                                <option value="2" selected>2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">สถานะ <span class="text-danger">*</span></label>
                            <select name="status" id="status" required class="form-select">
                                <option value="pending">รอดำเนินการ</option>
                                <option value="in_progress" selected>กำลังฝึกงาน</option>
                                <option value="completed">เสร็จสิ้น</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="border-top px-4 py-3 d-flex flex-column flex-sm-row justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> บันทึกข้อมูล
                    </button>
                    <button type="button" onclick="closeModal()" class="btn btn-outline-secondary">
                        ยกเลิก
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let allData = [];
    let statusChart = null;

    // Initialize
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || ''
            }
        });

        loadData();

        $('#btnAddInternship').on('click', function() {
            openModal();
        });

        // Checkbox events
        $('#selectAll').change(function() {
            $('.row-checkbox').prop('checked', $(this).prop('checked'));
            updateSelectedCount();
        });

        $(document).on('change', '.row-checkbox', function() {
            updateSelectedCount();
            $('#selectAll').prop('checked', $('.row-checkbox:checked').length === $('.row-checkbox').length);
        });

        // Filter events
        $('#searchFilter').on('keyup', debounce(function() { loadData(); }, 500));
        $('#statusFilter, #yearFilter').change(function() { loadData(); });

        $('#student_id').select2({
            placeholder: 'เลือกรหัสนักศึกษา',
            allowClear: true,
            ajax: {
                url: '<?php echo e(route("students.list")); ?>',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return { results: data.results };
                },
                cache: true
            }
        });
    });

    function debounce(func, wait) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    function updateSelectedCount() {
        const count = $('.row-checkbox:checked').length;
        $('#selectedCount').text(count);
        if (count > 0) {
            $('#btnBulkDelete').removeClass('d-none');
        } else {
            $('#btnBulkDelete').addClass('d-none');
        }
    }

    function updateSummaryStats(data) {
        const total = data.length;
        const inProgress = data.filter(item => item.status === 'in_progress').length;
        const completed = data.filter(item => item.status === 'completed').length;

        $('#summaryTotal').text(total);
        $('#summaryInProgress').text(inProgress);
        $('#summaryCompleted').text(completed);
    }

    function renderStatusChart(data) {
        const counts = { pending: 0, in_progress: 0, completed: 0 };
        data.forEach(item => {
            if (counts[item.status] !== undefined) {
                counts[item.status] += 1;
            }
        });

        const labels = ['รอดำเนินการ', 'กำลังฝึกงาน', 'เสร็จสิ้น'];
        const values = [counts.pending, counts.in_progress, counts.completed];

        const ctx = document.getElementById('internshipStatusChart').getContext('2d');
        if (statusChart) {
            statusChart.data.datasets[0].data = values;
            statusChart.update();
            return;
        }

        statusChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: ['#f59e0b', '#2563eb', '#16a34a'],
                    borderColor: '#ffffff',
                    borderWidth: 2,
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#475569',
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + ' ราย';
                            }
                        }
                    }
                }
            }
        });
    }

    function getStatusBadge(status) {
        let label = status;
        if (status === 'pending') { label = 'รอดำเนินการ'; }
        else if (status === 'in_progress') { label = 'กำลังฝึกงาน'; }
        else if (status === 'completed') { label = 'เสร็จสิ้น'; }
        return `<span class="status-badge ${status}">${label}</span>`;
    }

    function loadData() {
        $('#tableBody').html('<tr><td colspan="6" class="text-center py-5 text-secondary"><i class="fas fa-spinner fa-spin me-2"></i> กำลังโหลดข้อมูล...</td></tr>');
        
        $.ajax({
            url: '<?php echo e(route("internships.data")); ?>',
            type: 'GET',
            data: {
                search: $('#searchFilter').val(),
                status: $('#statusFilter').val(),
                year: $('#yearFilter').val()
            },
            success: function(response) {
                allData = response.data;
                renderTable(allData);
                updateSummaryStats(allData);
                renderStatusChart(allData);
            },
            error: function() {
                $('#tableBody').html('<tr><td colspan="6" class="text-center py-5 text-danger"><i class="fas fa-exclamation-circle me-2"></i> เกิดข้อผิดพลาดในการโหลดข้อมูล</td></tr>');
            }
        });
    }

    function renderTable(data) {
        if (!data || data.length === 0) {
            $('#tableBody').html('<tr><td colspan="6" class="text-center py-5 text-secondary"><div class="d-flex flex-column align-items-center gap-3"><i class="fas fa-inbox fa-2x text-secondary"></i><p class="mb-0">ไม่พบข้อมูล</p></div></td></tr>');
            return;
        }

        let html = '';
        data.forEach(item => {
            html += `
                <tr>
                    <td class="text-center align-middle">
                        <input type="checkbox" class="form-check-input row-checkbox" value="${item.id}">
                    </td>
                    <td class="align-middle">
                        <div class="fw-semibold">${item.student_name}</div>
                        <div class="text-secondary small">${item.student_id || '-'}</div>
                    </td>
                    <td class="align-middle">
                        <div class="fw-semibold">${item.company_name}</div>
                        <div class="text-secondary small"><i class="fas fa-briefcase me-1"></i>${item.job_role || '-'}</div>
                    </td>
                    <td class="text-center align-middle">
                        <div class="fw-semibold">${item.academic_year || '-'} / ${item.semester || '-'}</div>
                    </td>
                    <td class="text-center align-middle">
                        ${getStatusBadge(item.status)}
                    </td>
                    <td class="text-end align-middle">
                        <div class="btn-group" role="group" aria-label="Actions">
                            <button type="button" onclick="editData(${item.id})" class="btn btn-sm btn-outline-primary" title="แก้ไข">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" onclick="deleteData(${item.id})" class="btn btn-sm btn-outline-danger" title="ลบ">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
        $('#tableBody').html(html);
        $('#selectAll').prop('checked', false);
        updateSelectedCount();
    }

    function openModal() {
        $('#entityId').val('');
        $('#dataForm')[0].reset();
        $('#modalTitleText').text('เพิ่มข้อมูลสถานที่ฝึกงาน');
        $('#formModal').removeClass('d-none');
    }

    function closeModal() {
        $('#formModal').addClass('d-none');
    }

    window.openModal = openModal;
    window.closeModal = closeModal;

    function editData(id) {
        const item = allData.find(d => d.id == id);
        if (!item) return;

        $('#entityId').val(item.id);
        $('#student_id').val(item.student_id);
        $('#student_name').val(item.student_name);
        $('#company_name').val(item.company_name);
        $('#company_address').val(item.company_address);
        $('#job_role').val(item.job_role);
        $('#start_date').val(item.start_date);
        $('#end_date').val(item.end_date);
        $('#academic_year').val(item.academic_year);
        $('#semester').val(item.semester);
        $('#status').val(item.status);
        
        $('#modalTitleText').text('แก้ไขข้อมูลสถานที่ฝึกงาน');
        $('#formModal').removeClass('d-none');
    }

    function saveData(e) {
        e.preventDefault();
        const id = $('#entityId').val();
        const isEdit = !!id;
        const url = isEdit ? `<?php echo e(url('internships')); ?>/${id}` : '<?php echo e(route("internships.store")); ?>';
        const method = isEdit ? 'PUT' : 'POST';

        // Add loading state to button
        const btn = $('#dataForm button[type="submit"]');
        const btnHtml = btn.html();
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2 mt-1"></i> กำลังบันทึก...');

        $.ajax({
            url: url,
            type: method,
            data: $('#dataForm').serialize(),
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    closeModal();
                    loadData();
                } else {
                    Swal.fire('ข้อผิดพลาด', response.message || 'เกิดข้อผิดพลาดบางอย่าง', 'error');
                }
            },
            error: function(xhr) {
                let msg = 'ไม่สามารถบันทึกข้อมูลได้';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    msg = Object.values(xhr.responseJSON.errors).map(e => e.join(', ')).join('\n');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                Swal.fire('ข้อผิดพลาด', msg, 'error');
            },
            complete: function() {
                // Restore button state
                btn.prop('disabled', false).html(btnHtml);
            }
        });
    }

    function deleteData(id) {
        Swal.fire({
            title: 'ยืนยันการลบ?',
            text: "คุณต้องการลบข้อมูลนี้ใช่หรือไม่? การกระทำนี้ไม่สามารถกู้คืนได้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#gray',
            confirmButtonText: 'ลบข้อมูล',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `<?php echo e(url('internships')); ?>/${id}`,
                    type: 'DELETE',
                    data: { _token: '<?php echo e(csrf_token()); ?>' },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({icon: 'success', title: 'ลบสำเร็จ', text: response.message, timer: 1500, showConfirmButton: false});
                            loadData();
                        } else {
                            Swal.fire('ข้อผิดพลาด', response.message, 'error');
                        }
                    }
                });
            }
        });
    }

    function bulkDelete() {
        const ids = $('.row-checkbox:checked').map(function() { return $(this).val(); }).get();
        if (ids.length === 0) return;

        Swal.fire({
            title: `ยืนยันการลบ ${ids.length} รายการ?`,
            text: "ข้อมูลจะไม่สามารถกู้คืนได้",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#gray',
            confirmButtonText: 'ตั้งใจลบ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo e(route("internships.bulkDestroy")); ?>',
                    type: 'POST',
                    data: { _token: '<?php echo e(csrf_token()); ?>', ids: ids },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({icon: 'success', title: 'ลบสำเร็จ', text: response.message, timer: 1500, showConfirmButton: false});
                            loadData();
                        }
                    }
                });
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/student/resources/views/internships/index.blade.php ENDPATH**/ ?>