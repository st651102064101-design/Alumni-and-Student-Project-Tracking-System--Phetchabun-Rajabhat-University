@extends('layouts.app')

@section('title', 'รายงานสถานที่ฝึกงาน')

@push('styles')
<style>
    :root {
        --apple-card: #ffffff;
        --apple-text: #1d1d1f;
        --apple-text-secondary: #86868b;
        --apple-blue: #0071e3;
        --apple-green: #34c759;
        --apple-orange: #ff9500;
        --apple-red: #ff3b30;
        --apple-purple: #af52de;
        --apple-shadow: 0 4px 20px rgba(0,0,0,0.08);
        --apple-shadow-hover: 0 12px 40px rgba(0,0,0,0.12);
        --apple-radius: 20px;
    }

    .report-container { padding: 0; }

    /* Header */
    .report-header {
        background: linear-gradient(135deg, #0071e3 0%, #0077ed 100%);
        border-radius: var(--apple-radius);
        padding: 50px 40px;
        color: white;
        margin-bottom: 30px;
        box-shadow: var(--apple-shadow);
    }

    .report-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .report-header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    @media (max-width: 1200px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 768px) { .stats-grid { grid-template-columns: 1fr; } }

    .stat-card {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        padding: 28px;
        box-shadow: var(--apple-shadow);
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--apple-shadow-hover);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 16px;
    }

    .stat-icon.blue { background: var(--apple-blue); }
    .stat-icon.green { background: var(--apple-green); }
    .stat-icon.orange { background: var(--apple-orange); }
    .stat-icon.purple { background: var(--apple-purple); }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--apple-text);
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 0.95rem;
        color: var(--apple-text-secondary);
    }

    /* Content Card */
    .content-card {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        padding: 32px;
        box-shadow: var(--apple-shadow);
        border: 1px solid #f0f0f0;
        margin-bottom: 24px;
        transition: all 0.3s ease;
    }

    .content-card:hover {
        box-shadow: var(--apple-shadow-hover);
    }

    .content-card h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--apple-text);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .content-card h2 i {
        font-size: 1.3rem;
        color: var(--apple-blue);
    }

    /* Two Column Layout */
    .two-column {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 24px;
    }

    @media (max-width: 1024px) {
        .two-column { grid-template-columns: 1fr; }
    }

    /* Table */
    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table thead {
        background: #f5f5f7;
        border-bottom: 2px solid #e5e5e7;
    }

    table th {
        padding: 16px;
        text-align: left;
        font-weight: 600;
        color: var(--apple-text);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    table td {
        padding: 16px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 0.95rem;
        color: var(--apple-text-secondary);
    }

    table tr:hover {
        background: #f9f9fb;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-badge.completed {
        background: rgba(52,199,89,0.1);
        color: var(--apple-green);
    }

    .status-badge.in_progress {
        background: rgba(0,113,227,0.1);
        color: var(--apple-blue);
    }

    .status-badge.pending {
        background: rgba(255,149,0,0.1);
        color: var(--apple-orange);
    }

    /* Badge */
    .badge {
        display: inline-block;
        background: #f5f5f7;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.8rem;
        color: var(--apple-text-secondary);
        margin-right: 8px;
        margin-bottom: 4px;
    }

    .badge strong {
        color: var(--apple-text);
    }

    /* Status Distribution */
    .status-dist {
        display: flex;
        gap: 12px;
        margin-top: 12px;
    }

    .status-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
    }

    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .status-dot.completed { background: var(--apple-green); }
    .status-dot.in_progress { background: var(--apple-blue); }
    .status-dot.pending { background: var(--apple-orange); }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--apple-text-secondary);
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 16px;
        opacity: 0.3;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-in {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
</style>
@endpush

@section('content')
<div class="report-container">
    <!-- Header -->
    <div class="report-header animate-in">
        <h1>
            <i class="fas fa-chart-bar"></i> รายงานสถานที่ฝึกงาน
        </h1>
        <p>สรุปข้อมูลสถานที่ฝึกงานทั้งหมดของสาขาวิชาวิทยาการคอมพิวเตอร์</p>
    </div>

    <!-- Key Statistics -->
    <div class="stats-grid">
        <div class="stat-card animate-in delay-1">
            <div class="stat-icon blue">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-value">{{ $stats['total'] }}</div>
            <div class="stat-label">ฝึกงานทั้งหมด</div>
        </div>

        <div class="stat-card animate-in delay-1">
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-value">{{ $stats['completed'] }}</div>
            <div class="stat-label">เสร็จสิ้นแล้ว</div>
        </div>

        <div class="stat-card animate-in delay-1">
            <div class="stat-icon orange">
                <i class="fas fa-spinner"></i>
            </div>
            <div class="stat-value">{{ $stats['inProgress'] }}</div>
            <div class="stat-label">กำลังฝึกงาน</div>
        </div>

        <div class="stat-card animate-in delay-1">
            <div class="stat-icon purple">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-value">{{ $stats['totalCompanies'] }}</div>
            <div class="stat-label">บริษัท/องค์กร</div>
        </div>
    </div>

    <!-- Summary Info -->
    <div class="two-column animate-in delay-2">
        <div class="content-card">
            <h2>
                <i class="fas fa-info-circle"></i> สรุปข้อมูล
            </h2>
            <div style="font-size: 0.95rem; color: var(--apple-text-secondary); line-height: 1.8;">
                <div style="margin-bottom: 12px;">
                    <strong style="color: var(--apple-text);">รอดำเนินการ:</strong> {{ $stats['pending'] }} ราย
                </div>
                <div style="margin-bottom: 12px;">
                    <strong style="color: var(--apple-text);">กำลังฝึกงาน:</strong> {{ $stats['inProgress'] }} ราย
                </div>
                <div style="margin-bottom: 12px;">
                    <strong style="color: var(--apple-text);">เสร็จสิ้น:</strong> {{ $stats['completed'] }} ราย
                </div>
                <div style="margin-bottom: 12px;">
                    <strong style="color: var(--apple-text);">อัตราความสำเร็จ:</strong> 
                    {{ $stats['total'] > 0 ? round(($stats['completed'] / $stats['total']) * 100) : 0 }}%
                </div>
            </div>
        </div>

        <div class="content-card">
            <h2>
                <i class="fas fa-calendar-alt"></i> ระยะเวลา
            </h2>
            <div style="font-size: 0.95rem; color: var(--apple-text-secondary); line-height: 1.8;">
                <div style="margin-bottom: 12px;">
                    <strong style="color: var(--apple-text);">ระยะเวลาเฉลี่ย:</strong> {{ $stats['averageDuration'] }} วัน
                </div>
                <div style="margin-bottom: 12px;">
                    <strong style="color: var(--apple-text);">ประมาณ:</strong> {{ round($stats['averageDuration'] / 30, 1) }} เดือน
                </div>
            </div>
        </div>
    </div>

    <!-- Top Companies -->
    <div class="content-card animate-in delay-3">
        <h2>
            <i class="fas fa-star"></i> บริษัท/องค์กรที่มีนักศึกษาฝึกงานมากที่สุด (Top 10)
        </h2>

        @if($companiesCount->count() > 0)
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>อันดับ</th>
                            <th>บริษัท/องค์กร</th>
                            <th>จำนวนนักศึกษา</th>
                            <th>นักศึกษา</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companiesCount as $index => $company)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $company['company_name'] }}</strong>
                                </td>
                                <td>
                                    <span class="status-badge in_progress">
                                        {{ $company['count'] }} คน
                                    </span>
                                </td>
                                <td>
                                    @foreach(array_slice($company['students'], 0, 3) as $student)
                                        <span class="badge">{{ $student }}</span>
                                    @endforeach
                                    @if(count($company['students']) > 3)
                                        <span class="badge">+{{ count($company['students']) - 3 }} คนอื่น</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>ยังไม่มีข้อมูล</p>
            </div>
        @endif
    </div>

    <!-- All Internships -->
    <div class="content-card animate-in delay-4">
        <h2>
            <i class="fas fa-list"></i> ทั้งหมด - รายละเอียดการฝึกงาน
        </h2>

        @if($allInternships->count() > 0)
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>รหัส/ชื่อนักศึกษา</th>
                            <th>บริษัท</th>
                            <th>ตำแหน่ง</th>
                            <th>วันที่เริ่มต้น</th>
                            <th>วันที่สิ้นสุด</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allInternships as $internship)
                            <tr>
                                <td>
                                    <strong>{{ $internship->student_id }}</strong><br>
                                    <small>{{ $internship->student_name }}</small>
                                </td>
                                <td>{{ $internship->company_name }}</td>
                                <td>{{ $internship->job_role ?? '-' }}</td>
                                <td>{{ $internship->start_date ? \Carbon\Carbon::parse($internship->start_date)->format('d M Y') : '-' }}</td>
                                <td>{{ $internship->end_date ? \Carbon\Carbon::parse($internship->end_date)->format('d M Y') : '-' }}</td>
                                <td>
                                    <span class="status-badge {{ $internship->status }}">
                                        {{ $internship->status_label }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>ยังไม่มีข้อมูลการฝึกงาน</p>
            </div>
        @endif
    </div>
</div>
@endsection
