@extends('layouts.app')

@section('title', 'จัดการข้อมูลสถานที่ฝึกงาน')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50 rounded-t-lg">
        <h2 class="text-xl font-semibold text-gray-800">
            <i class="fas fa-building mr-2 text-blue-600"></i> รายงานและจัดการสถานที่ฝึกงาน
        </h2>
        <div class="flex gap-2">
            <button id="btnBulkDelete" class="hidden sm:inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors shadow-sm text-sm" onclick="bulkDelete()">
                <i class="fas fa-trash-alt mr-2"></i> ลบที่เลือก (<span id="selectedCount">0</span>)
            </button>
            <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm text-sm" onclick="openModal()">
                <i class="fas fa-plus mr-2"></i> เพิ่มข้อมูล
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="p-6 border-b border-gray-200 bg-gray-50/50">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ค้นหา</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchFilter" class="block w-full pl-10 rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm" placeholder="รหัส, ชื่อ, หรือบริษัท...">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">สถานะ</label>
                <select id="statusFilter" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="">ทั้งหมด</option>
                    <option value="pending">รอดำเนินการ</option>
                    <option value="in_progress">กำลังฝึกงาน</option>
                    <option value="completed">เสร็จสิ้น</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ปีการศึกษา</label>
                <select id="yearFilter" class="mt-1 block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="">ทั้งหมด</option>
                    @for($year = date('Y') + 543; $year >= date('Y') + 543 - 5; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="p-6">
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200" id="dataTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="w-12 px-6 py-3 text-center">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">รหัสนักศึกษา/ชื่อ</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">บริษัท/ตำแหน่ง</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ปีการศึกษา</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">สถานะ</th>
                        <th scope="col" class="relative px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-sm" id="tableBody">
                    <tr><td colspan="6" class="px-6 py-10 text-center"><i class="fas fa-spinner fa-spin mr-2"></i> กำลังโหลดข้อมูล...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="formModal" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <form id="dataForm" onsubmit="saveData(event)">
                @csrf
                <input type="hidden" id="entityId" name="id">
                
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-200">
                    <h3 class="text-xl leading-6 font-semibold text-gray-900 flex items-center" id="modal-title">
                        <i class="fas fa-edit mr-2 text-blue-600"></i> <span id="modalTitleText">เพิ่มข้อมูล</span>
                    </h3>
                </div>

                <div class="px-6 py-4 space-y-4 max-h-[60vh] overflow-y-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">รหัสนักศึกษา <span class="text-red-500">*</span></label>
                            <input type="text" name="student_id" id="student_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ชื่อ-นามสกุล <span class="text-red-500">*</span></label>
                            <input type="text" name="student_name" id="student_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ชื่อบริษัท/หน่วยงาน <span class="text-red-500">*</span></label>
                            <input type="text" name="company_name" id="company_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ที่อยู่หน่วยงาน</label>
                            <textarea name="company_address" id="company_address" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ตำแหน่งที่ฝึกงาน</label>
                            <input type="text" name="job_role" id="job_role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">วันที่เริ่มฝึกงาน</label>
                            <input type="date" name="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">วันสิ้นสุดฝึกงาน</label>
                            <input type="date" name="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ปีการศึกษา <span class="text-red-500">*</span></label>
                            <input type="number" name="academic_year" id="academic_year" value="{{ date('Y') + 543 }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ภาคเรียน <span class="text-red-500">*</span></label>
                            <select name="semester" id="semester" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="1">1</option>
                                <option value="2" selected>2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">สถานะ <span class="text-red-500">*</span></label>
                            <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="pending">รอดำเนินการ</option>
                                <option value="in_progress" selected>กำลังฝึกงาน</option>
                                <option value="completed">เสร็จสิ้น</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200">
                    <button type="submit" class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        <i class="fas fa-save mr-2 mt-1"></i> บันทึกข้อมูล
                    </button>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        ยกเลิก
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let allData = [];

    // Initialize
    $(document).ready(function() {
        loadData();

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
            $('#btnBulkDelete').removeClass('hidden').addClass('inline-flex');
        } else {
            $('#btnBulkDelete').addClass('hidden').removeClass('inline-flex');
        }
    }

    function getStatusBadge(status) {
        let color = 'gray', label = status;
        if (status === 'pending') { color = 'orange'; label = 'รอดำเนินการ'; }
        else if (status === 'in_progress') { color = 'blue'; label = 'กำลังฝึกงาน'; }
        else if (status === 'completed') { color = 'green'; label = 'เสร็จสิ้น'; }
        
        return `<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-${color}-100 text-${color}-800 border border-${color}-200">${label}</span>`;
    }

    function loadData() {
        $('#tableBody').html('<tr><td colspan="6" class="px-6 py-10 text-center text-gray-500"><i class="fas fa-spinner fa-spin mr-2"></i> กำลังโหลดข้อมูล...</td></tr>');
        
        $.ajax({
            url: '{{ route("internships.data") }}',
            type: 'GET',
            data: {
                search: $('#searchFilter').val(),
                status: $('#statusFilter').val(),
                year: $('#yearFilter').val()
            },
            success: function(response) {
                allData = response.data;
                renderTable(allData);
            },
            error: function() {
                $('#tableBody').html('<tr><td colspan="6" class="px-6 py-10 text-center text-red-500"><i class="fas fa-exclamation-circle mr-2"></i> เกิดข้อผิดพลาดในการโหลดข้อมูล</td></tr>');
            }
        });
    }

    function renderTable(data) {
        if (!data || data.length === 0) {
            $('#tableBody').html('<tr><td colspan="6" class="px-6 py-10 text-center text-gray-500"><div class="flex flex-col items-center"><i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i><p>ไม่พบข้อมูล</p></div></td></tr>');
            return;
        }

        let html = '';
        data.forEach(item => {
            html += `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <input type="checkbox" class="row-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="${item.id}">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${item.student_name}</div>
                        <div class="text-sm text-gray-500">${item.student_id || '-'}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">${item.company_name}</div>
                        <div class="text-sm text-gray-500"><i class="fas fa-briefcase mr-1"></i>${item.job_role || '-'}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="text-sm text-gray-900">${item.academic_year || '-'} / ${item.semester || '-'}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        ${getStatusBadge(item.status)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-2">
                            <button onclick="editData(${item.id})" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition-colors" title="แก้ไข">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteData(${item.id})" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors" title="ลบ">
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
        $('#formModal').removeClass('hidden');
    }

    function closeModal() {
        $('#formModal').addClass('hidden');
    }

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
        $('#formModal').removeClass('hidden');
    }

    function saveData(e) {
        e.preventDefault();
        const id = $('#entityId').val();
        const isEdit = !!id;
        const url = isEdit ? `{{ url('internships') }}/${id}` : '{{ route("internships.store") }}';
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
                    url: `{{ url('internships') }}/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
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
                    url: '{{ route("internships.bulkDestroy") }}',
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}', ids: ids },
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
@endpush
