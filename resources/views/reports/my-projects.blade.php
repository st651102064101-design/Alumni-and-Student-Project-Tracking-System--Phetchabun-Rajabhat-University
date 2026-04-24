@extends('layouts.app')

@section('title', 'รายงานโครงงานของฉัน')

@push('styles')
<style>
    :root {
        --report-bg: #f7f8fb;
        --report-card: #ffffff;
        --report-text: #1f2a37;
        --report-muted: #67748e;
        --report-border: #e8ebf1;
        --report-primary: #2563eb;
        --report-success: #16a34a;
        --report-warning: #f59e0b;
        --report-danger: #dc2626;
        --report-radius: 18px;
        --report-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
    }

    .report-page {
        padding: 0;
    }

    .report-hero {
        background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        color: white;
        border-radius: var(--report-radius);
        padding: 40px 34px;
        margin-bottom: 28px;
        box-shadow: var(--report-shadow);
    }

    .report-hero h1 {
        font-size: 2.5rem;
        margin-bottom: 12px;
    }

    .report-hero p {
        color: rgba(255,255,255,0.8);
        max-width: 64ch;
    }

    .report-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 28px;
    }

    .report-stat {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 16px;
        padding: 24px;
        min-height: 130px;
    }

    .report-stat h2 {
        margin: 0;
        font-size: 2.25rem;
        font-weight: 700;
    }

    .report-stat p {
        margin-top: 10px;
        color: rgba(255,255,255,0.7);
        font-size: 0.95rem;
    }

    .content-card {
        background: var(--report-card);
        border-radius: var(--report-radius);
        box-shadow: var(--report-shadow);
        border: 1px solid var(--report-border);
        padding: 32px;
        margin-bottom: 24px;
    }

    .content-card h2 {
        margin-bottom: 18px;
        font-size: 1.45rem;
        color: var(--report-text);
    }

    .report-summary {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .summary-card {
        background: #f8fafc;
        border-radius: 16px;
        padding: 22px;
        border: 1px solid #e2e8f0;
    }

    .summary-card h3 {
        margin: 0;
        font-size: 1.8rem;
        color: var(--report-text);
    }

    .summary-card p {
        margin: 8px 0 0;
        color: var(--report-muted);
        font-size: 0.95rem;
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead th {
        background: #f1f5f9;
        color: var(--report-text);
        text-align: left;
        font-weight: 600;
        padding: 16px 14px;
        border-bottom: 1px solid var(--report-border);
    }

    tbody td {
        padding: 14px;
        color: var(--report-muted);
        border-bottom: 1px solid var(--report-border);
        vertical-align: top;
    }

    tbody tr:hover {
        background: #f8fafc;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-pill.completed { background: rgba(22,163,74,0.12); color: var(--report-success); }
    .status-pill.in_progress { background: rgba(37,99,235,0.12); color: var(--report-primary); }
    .status-pill.proposal { background: rgba(245,158,11,0.12); color: var(--report-warning); }
    .status-pill.pending { background: rgba(220,38,38,0.12); color: var(--report-danger); }

    .report-note {
        color: var(--report-muted);
        font-size: 0.95rem;
    }

    @media (max-width: 1024px) {
        .report-stats, .report-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 720px) {
        .report-stats, .report-summary {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="report-page">
    <div class="report-hero animate-in">
        <h1>รายงานโครงงานของฉัน</h1>
        <p>สรุปสถานะ โครงการ และผลการดำเนินงานของโครงงานที่คุณเป็นสมาชิก</p>
        <div class="report-stats">
            <div class="report-stat">
                <h2>{{ number_format($stats['totalProjects'] ?? 0) }}</h2>
                <p>โครงงานของฉันทั้งหมด</p>
            </div>
            <div class="report-stat">
                <h2>{{ number_format($stats['completedProjects'] ?? 0) }}</h2>
                <p>โครงงานเสร็จสิ้น</p>
            </div>
            <div class="report-stat">
                <h2>{{ number_format($stats['inProgressProjects'] ?? 0) }}</h2>
                <p>โครงงานกำลังดำเนินการ</p>
            </div>
            <div class="report-stat">
                <h2>{{ number_format($stats['proposalProjects'] ?? 0) }}</h2>
                <p>โครงงานที่เสนอ</p>
            </div>
        </div>
    </div>

    <div class="content-card animate-in delay-1">
        <h2>สรุปตามหมวดหมู่</h2>
        <div class="report-summary">
            @forelse($stats['totalProjectsByCategory'] as $category => $count)
            <div class="summary-card">
                <h3>{{ $count }}</h3>
                <p>{{ $category }}</p>
            </div>
            @empty
            <div class="summary-card">
                <h3>0</h3>
                <p>ไม่มีโครงงาน</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="content-card animate-in delay-2">
        <h2>รายการโครงงาน</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>รหัสโครงงาน</th>
                        <th>ชื่อโครงงาน</th>
                        <th>หมวดหมู่</th>
                        <th>ปี/เทอม</th>
                        <th>อาจารย์ที่ปรึกษา</th>
                        <th>สมาชิก</th>
                        <th>สถานะ</th>
                        <th>คะแนน</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($myProjects as $project)
                    <tr>
                        <td>{{ $project->project_code }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->category }}</td>
                        <td>{{ $project->academic_year }} / {{ $project->semester }}</td>
                        <td>{{ $project->advisor }}</td>
                        <td>{{ implode(', ', $project->members ?? []) }}</td>
                        <td>
                            <span class="status-pill {{ $project->status }}">
                                {{ $project->status == 'completed' ? 'เสร็จสิ้น' : ($project->status == 'in_progress' ? 'กำลังดำเนินการ' : ($project->status == 'proposal' ? 'เสนอ' : 'รอดำเนินการ')) }}
                            </span>
                        </td>
                        <td>{{ $project->score ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center report-note">ไม่มีโครงงานของคุณในระบบ</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
