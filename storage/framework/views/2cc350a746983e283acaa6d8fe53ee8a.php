

<?php $__env->startSection('title', 'สถิติศิษย์เก่า'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Apple Design System */
    :root {
        --apple-bg: #f5f5f7;
        --apple-card: #ffffff;
        --apple-text: #1d1d1f;
        --apple-text-secondary: #86868b;
        --apple-border: rgba(0,0,0,0.08);
        --apple-blue: #0071e3;
        --apple-green: #34c759;
        --apple-orange: #ff9500;
        --apple-red: #ff3b30;
        --apple-purple: #af52de;
        --apple-shadow: 0 2px 12px rgba(0,0,0,0.08);
        --apple-radius: 16px;
        --apple-radius-sm: 10px;
    }

    .apple-statistics { max-width: 100%; padding: 0; }

    /* Card */
    .apple-card {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        box-shadow: var(--apple-shadow);
        border: 1px solid var(--apple-border);
        padding: 20px 24px;
        margin-bottom: 20px;
    }

    /* Header */
    .apple-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }
    .apple-header-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--apple-text);
        margin: 0;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        box-shadow: var(--apple-shadow);
        border: 1px solid var(--apple-border);
        padding: 20px;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        font-size: 1.5rem;
    }

    .stat-icon.blue { background: rgba(0,113,227,0.1); color: var(--apple-blue); }
    .stat-icon.green { background: rgba(52,199,89,0.1); color: var(--apple-green); }
    .stat-icon.orange { background: rgba(255,149,0,0.1); color: var(--apple-orange); }
    .stat-icon.red { background: rgba(255,59,48,0.1); color: var(--apple-red); }
    .stat-icon.purple { background: rgba(175,82,222,0.1); color: var(--apple-purple); }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--apple-text);
        line-height: 1.2;
    }

    .stat-label {
        font-size: 0.85rem;
        color: var(--apple-text-secondary);
        margin-top: 4px;
    }

    .stat-change {
        font-size: 0.75rem;
        margin-top: 8px;
        padding: 4px 8px;
        border-radius: 980px;
        display: inline-block;
    }

    .stat-change.up { background: rgba(52,199,89,0.1); color: var(--apple-green); }
    .stat-change.down { background: rgba(255,59,48,0.1); color: var(--apple-red); }

    /* Chart Container */
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }

    .chart-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--apple-text);
        margin-bottom: 16px;
    }

    /* Table */
    .stats-table {
        width: 100%;
        border-collapse: collapse;
    }

    .stats-table th,
    .stats-table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid var(--apple-border);
    }

    .stats-table th {
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--apple-text-secondary);
        background: #fafafa;
    }

    .stats-table td {
        font-size: 0.9rem;
        color: var(--apple-text);
    }

    .stats-table tbody tr:hover {
        background: #f5f5f7;
    }

    /* Progress Bar */
    .progress-bar-container {
        background: #e8e8ed;
        border-radius: 10px;
        height: 8px;
        overflow: hidden;
        width: 100%;
    }

    .progress-bar-fill {
        height: 100%;
        border-radius: 10px;
        transition: width 0.5s ease;
    }

    .progress-bar-fill.blue { background: var(--apple-blue); }
    .progress-bar-fill.green { background: var(--apple-green); }
    .progress-bar-fill.orange { background: var(--apple-orange); }
    .progress-bar-fill.red { background: var(--apple-red); }
    .progress-bar-fill.purple { background: var(--apple-purple); }

    /* Badge */
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

    /* Dark mode */
    body.dark {
        --apple-bg: var(--yt-bg-secondary);
        --apple-card: var(--yt-bg-primary);
        --apple-text: var(--yt-text-primary);
        --apple-text-secondary: var(--yt-text-secondary);
        --apple-border: var(--yt-border-color);
    }

    body.dark .apple-card,
    body.dark .stat-card {
        box-shadow: 0 2px 14px rgba(0,0,0,0.35);
    }

    body.dark .stats-table th {
        background: #272727;
    }

    body.dark .stats-table tbody tr:hover {
        background: #272727;
    }

    body.dark .progress-bar-container {
        background: #3f3f3f;
    }

    body.dark .status-badge.employed { background: rgba(52,199,89,0.2); color: #4cd964; }
    body.dark .status-badge.unemployed { background: rgba(255,59,48,0.2); color: #ff6b6b; }
    body.dark .status-badge.self_employed { background: rgba(255,149,0,0.2); color: #ffb340; }
    body.dark .status-badge.further_study { background: rgba(0,113,227,0.2); color: #3ea6ff; }
    body.dark .status-badge.other { background: rgba(175,82,222,0.2); color: #bf7fff; }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="apple-statistics">
    
    <div class="apple-header">
        <h2 class="apple-header-title"><i class="bi bi-bar-chart-fill me-2"></i>สถิติศิษย์เก่า</h2>
        <a href="<?php echo e(route('alumni.index')); ?>" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> กลับไปรายการศิษย์เก่า
        </a>
    </div>

    
    <div class="stats-grid" id="statsGrid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-value" id="totalAlumni">-</div>
            <div class="stat-label">ศิษย์เก่าทั้งหมด</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-briefcase-fill"></i>
            </div>
            <div class="stat-value" id="employedCount">-</div>
            <div class="stat-label">มีงานทำ</div>
            <div class="stat-change up" id="employedPercent">-</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon red">
                <i class="bi bi-person-x-fill"></i>
            </div>
            <div class="stat-value" id="unemployedCount">-</div>
            <div class="stat-label">ว่างงาน</div>
            <div class="stat-change down" id="unemployedPercent">-</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="bi bi-shop"></i>
            </div>
            <div class="stat-value" id="selfEmployedCount">-</div>
            <div class="stat-label">ธุรกิจส่วนตัว</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div class="stat-value" id="furtherStudyCount">-</div>
            <div class="stat-label">ศึกษาต่อ</div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-lg-6 mb-4">
            <div class="apple-card">
                <h5 class="chart-title"><i class="bi bi-pie-chart me-2"></i>สถานะการทำงาน</h5>
                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        
        <div class="col-lg-6 mb-4">
            <div class="apple-card">
                <h5 class="chart-title"><i class="bi bi-bar-chart me-2"></i>ประเภทงาน (ตรงสาขา/ไม่ตรงสาขา)</h5>
                <div class="chart-container">
                    <canvas id="jobTypeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-lg-8 mb-4">
            <div class="apple-card">
                <h5 class="chart-title"><i class="bi bi-calendar3 me-2"></i>จำนวนศิษย์เก่าตามปีที่จบ</h5>
                <div class="chart-container">
                    <canvas id="yearChart"></canvas>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4 mb-4">
            <div class="apple-card">
                <h5 class="chart-title"><i class="bi bi-cash-stack me-2"></i>ช่วงเงินเดือน</h5>
                <div id="salaryStats">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">เฉลี่ย</span>
                        <span class="fw-bold" id="avgSalary">-</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">สูงสุด</span>
                        <span class="fw-bold text-success" id="maxSalary">-</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">ต่ำสุด</span>
                        <span class="fw-bold text-danger" id="minSalary">-</span>
                    </div>
                    <hr>
                    <div id="salaryRanges"></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="apple-card">
        <h5 class="chart-title"><i class="bi bi-building me-2"></i>สถานที่ทำงานยอดนิยม</h5>
        <div class="table-responsive">
            <table class="stats-table">
                <thead>
                    <tr>
                        <th>อันดับ</th>
                        <th>สถานที่ทำงาน</th>
                        <th>จำนวน</th>
                        <th>สัดส่วน</th>
                    </tr>
                </thead>
                <tbody id="topWorkplacesTable">
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">กำลังโหลดข้อมูล...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    var alumniDataUrl = '<?php echo e(route("alumni.data")); ?>';
    var alumniData = [];

    // Load data using fetch
    fetch(alumniDataUrl)
        .then(response => response.json())
        .then(res => {
            alumniData = res.data || [];
            calculateStats();
            renderCharts();
        })
        .catch(err => {
            console.error('ไม่สามารถโหลดข้อมูลได้', err);
        });

    function calculateStats() {
        var total = alumniData.length;
        var employed = alumniData.filter(a => a.status === 'employed').length;
        var unemployed = alumniData.filter(a => a.status === 'unemployed').length;
        var selfEmployed = alumniData.filter(a => a.status === 'self_employed').length;
        var furtherStudy = alumniData.filter(a => a.status === 'further_study').length;

        document.getElementById('totalAlumni').textContent = total;
        document.getElementById('employedCount').textContent = employed;
        document.getElementById('unemployedCount').textContent = unemployed;
        document.getElementById('selfEmployedCount').textContent = selfEmployed;
        document.getElementById('furtherStudyCount').textContent = furtherStudy;

        if (total > 0) {
            document.getElementById('employedPercent').textContent = ((employed / total) * 100).toFixed(1) + '%';
            document.getElementById('unemployedPercent').textContent = ((unemployed / total) * 100).toFixed(1) + '%';
        }

        // Salary stats
        var salaries = alumniData.filter(a => a.salary && a.salary > 0).map(a => parseFloat(a.salary));
        if (salaries.length > 0) {
            var avg = salaries.reduce((a, b) => a + b, 0) / salaries.length;
            var max = Math.max(...salaries);
            var min = Math.min(...salaries);
            
            document.getElementById('avgSalary').textContent = formatMoney(avg) + ' บาท';
            document.getElementById('maxSalary').textContent = formatMoney(max) + ' บาท';
            document.getElementById('minSalary').textContent = formatMoney(min) + ' บาท';

            // Salary ranges
            var ranges = [
                { label: 'น้อยกว่า 15,000', min: 0, max: 15000, color: 'red' },
                { label: '15,000 - 25,000', min: 15000, max: 25000, color: 'orange' },
                { label: '25,000 - 35,000', min: 25000, max: 35000, color: 'blue' },
                { label: 'มากกว่า 35,000', min: 35000, max: Infinity, color: 'green' }
            ];

            var rangesHtml = '';
            ranges.forEach(function(r) {
                var count = salaries.filter(s => s >= r.min && s < r.max).length;
                var percent = (count / salaries.length) * 100;
                rangesHtml += `
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small>${r.label}</small>
                            <small>${count} คน (${percent.toFixed(1)}%)</small>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar-fill ${r.color}" style="width: ${percent}%"></div>
                        </div>
                    </div>
                `;
            });
            document.getElementById('salaryRanges').innerHTML = rangesHtml;
        } else {
            document.getElementById('avgSalary').textContent = '-';
            document.getElementById('maxSalary').textContent = '-';
            document.getElementById('minSalary').textContent = '-';
        }

        // Top workplaces
        var workplaces = {};
        alumniData.forEach(function(a) {
            if (a.current_workplace) {
                workplaces[a.current_workplace] = (workplaces[a.current_workplace] || 0) + 1;
            }
        });

        var sortedWorkplaces = Object.entries(workplaces)
            .sort((a, b) => b[1] - a[1])
            .slice(0, 10);

        var workplacesHtml = '';
        if (sortedWorkplaces.length > 0) {
            sortedWorkplaces.forEach(function(w, i) {
                var percent = ((w[1] / total) * 100).toFixed(1);
                workplacesHtml += `
                    <tr>
                        <td><span class="badge bg-secondary">${i + 1}</span></td>
                        <td>${w[0]}</td>
                        <td><strong>${w[1]}</strong> คน</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress-bar-container" style="width: 100px;">
                                    <div class="progress-bar-fill blue" style="width: ${percent}%"></div>
                                </div>
                                <span>${percent}%</span>
                            </div>
                        </td>
                    </tr>
                `;
            });
        } else {
            workplacesHtml = '<tr><td colspan="4" class="text-center text-muted py-4">ไม่มีข้อมูล</td></tr>';
        }
        document.getElementById('topWorkplacesTable').innerHTML = workplacesHtml;
    }

    function renderCharts() {
        // Status Chart (Doughnut)
        var statusCounts = {
            'employed': alumniData.filter(a => a.status === 'employed').length,
            'unemployed': alumniData.filter(a => a.status === 'unemployed').length,
            'self_employed': alumniData.filter(a => a.status === 'self_employed').length,
            'further_study': alumniData.filter(a => a.status === 'further_study').length,
            'other': alumniData.filter(a => a.status === 'other').length
        };

        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: ['มีงานทำ', 'ว่างงาน', 'ธุรกิจส่วนตัว', 'ศึกษาต่อ', 'อื่นๆ'],
                datasets: [{
                    data: [
                        statusCounts.employed,
                        statusCounts.unemployed,
                        statusCounts.self_employed,
                        statusCounts.further_study,
                        statusCounts.other
                    ],
                    backgroundColor: [
                        '#34c759',
                        '#ff3b30',
                        '#ff9500',
                        '#0071e3',
                        '#af52de'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                },
                cutout: '60%'
            }
        });

        // Job Type Chart (Bar)
        var jobTypeCounts = {
            'related': alumniData.filter(a => a.job_type === 'related').length,
            'unrelated': alumniData.filter(a => a.job_type === 'unrelated').length,
            'further_study': alumniData.filter(a => a.job_type === 'further_study').length,
            'other': alumniData.filter(a => a.job_type === 'other' || !a.job_type).length
        };

        new Chart(document.getElementById('jobTypeChart'), {
            type: 'bar',
            data: {
                labels: ['ตรงสาขา', 'ไม่ตรงสาขา', 'ศึกษาต่อ', 'อื่นๆ'],
                datasets: [{
                    label: 'จำนวน (คน)',
                    data: [
                        jobTypeCounts.related,
                        jobTypeCounts.unrelated,
                        jobTypeCounts.further_study,
                        jobTypeCounts.other
                    ],
                    backgroundColor: [
                        '#34c759',
                        '#ff9500',
                        '#0071e3',
                        '#86868b'
                    ],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Year Chart (Line)
        var yearCounts = {};
        alumniData.forEach(function(a) {
            if (a.graduation_year) {
                yearCounts[a.graduation_year] = (yearCounts[a.graduation_year] || 0) + 1;
            }
        });

        var sortedYears = Object.keys(yearCounts).sort();
        
        new Chart(document.getElementById('yearChart'), {
            type: 'line',
            data: {
                labels: sortedYears,
                datasets: [{
                    label: 'จำนวนศิษย์เก่า',
                    data: sortedYears.map(y => yearCounts[y]),
                    borderColor: '#0071e3',
                    backgroundColor: 'rgba(0,113,227,0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#0071e3',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    function formatMoney(num) {
        return Math.round(num).toLocaleString();
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/student/resources/views/alumni/statistics.blade.php ENDPATH**/ ?>