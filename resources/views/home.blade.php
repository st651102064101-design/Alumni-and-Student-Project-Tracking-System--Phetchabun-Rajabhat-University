@extends('layouts.app')

@section('title', 'หน้าหลัก | Dashboard')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=SF+Pro+Display:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    /* Apple-Style Dashboard CSS */
    :root {
        --apple-bg: #f5f5f7;
        --apple-card: #ffffff;
        --apple-text: #1d1d1f;
        --apple-text-secondary: #86868b;
        --apple-blue: #0071e3;
        --apple-blue-hover: #0077ed;
        --apple-green: #34c759;
        --apple-orange: #ff9500;
        --apple-red: #ff3b30;
        --apple-purple: #af52de;
        --apple-gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --apple-gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --apple-gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --apple-gradient-4: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        --apple-shadow: 0 4px 20px rgba(0,0,0,0.08);
        --apple-shadow-hover: 0 12px 40px rgba(0,0,0,0.12);
        --apple-radius: 20px;
        --apple-radius-sm: 14px;
    }

    body { font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Segoe UI', Roboto, sans-serif; }

    .apple-dashboard { padding: 0; }

    /* Hero Section */
    .apple-hero {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        border-radius: var(--apple-radius);
        padding: 60px 50px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 40px;
    }
    .apple-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(102,126,234,0.3) 0%, transparent 70%);
        pointer-events: none;
    }
    .apple-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: 10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(79,172,254,0.2) 0%, transparent 70%);
        pointer-events: none;
    }
    .apple-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        letter-spacing: -0.03em;
        margin-bottom: 12px;
        position: relative;
        z-index: 1;
    }
    .apple-hero p {
        font-size: 1.25rem;
        opacity: 0.8;
        font-weight: 400;
        position: relative;
        z-index: 1;
    }
    .hero-stats {
        display: flex;
        gap: 50px;
        margin-top: 40px;
        position: relative;
        z-index: 1;
    }
    .hero-stat {
        text-align: left;
    }
    .hero-stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #fff 0%, #a8edea 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-stat-label {
        font-size: 0.9rem;
        opacity: 0.7;
        margin-top: 4px;
    }

    /* Section Titles */
    .section-title {
        font-size: 2rem;
        font-weight: 600;
        color: var(--apple-text);
        letter-spacing: -0.02em;
        margin-bottom: 8px;
    }
    .section-subtitle {
        font-size: 1.1rem;
        color: var(--apple-text-secondary);
        margin-bottom: 30px;
    }

    /* Stat Cards Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 50px;
    }
    @media (max-width: 1200px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px) { .stats-grid { grid-template-columns: 1fr; } }

    .apple-stat-card {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        padding: 28px;
        box-shadow: var(--apple-shadow);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: none;
        position: relative;
        overflow: hidden;
    }
    .apple-stat-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--apple-shadow-hover);
    }
    .apple-stat-card .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        margin-bottom: 20px;
    }
    .apple-stat-card .stat-value {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--apple-text);
        letter-spacing: -0.02em;
        line-height: 1;
    }
    .apple-stat-card .stat-label {
        font-size: 0.95rem;
        color: var(--apple-text-secondary);
        margin-top: 8px;
    }
    .apple-stat-card .stat-change {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 12px;
        padding: 4px 10px;
        border-radius: 20px;
    }
    .stat-change.positive { background: rgba(52,199,89,0.1); color: var(--apple-green); }
    .stat-change.negative { background: rgba(255,59,48,0.1); color: var(--apple-red); }

    /* Alumni Section */
    .alumni-section {
        margin-bottom: 50px;
    }
    .alumni-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    @media (max-width: 992px) { .alumni-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px) { .alumni-grid { grid-template-columns: 1fr; } }

    .alumni-card {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        overflow: hidden;
        box-shadow: var(--apple-shadow);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: none;
    }
    .alumni-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--apple-shadow-hover);
    }
    .alumni-card-header {
        height: 120px;
        position: relative;
    }
    .alumni-card-header.gradient-1 { background: var(--apple-gradient-1); }
    .alumni-card-header.gradient-2 { background: var(--apple-gradient-2); }
    .alumni-card-header.gradient-3 { background: var(--apple-gradient-3); }
    .alumni-avatar {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        border: 4px solid white;
        position: absolute;
        bottom: -45px;
        left: 50%;
        transform: translateX(-50%);
        object-fit: cover;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    .alumni-card-body {
        padding: 55px 24px 28px;
        text-align: center;
    }
    .alumni-name {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--apple-text);
        margin-bottom: 4px;
    }
    .alumni-batch {
        font-size: 0.9rem;
        color: var(--apple-text-secondary);
        margin-bottom: 12px;
    }
    .alumni-position {
        font-size: 0.95rem;
        color: var(--apple-blue);
        font-weight: 500;
        margin-bottom: 16px;
    }
    .alumni-company {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f5f5f7;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        color: var(--apple-text-secondary);
    }
    .alumni-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background: rgba(255,255,255,0.95);
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--apple-text);
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    /* PR Section - Stories from Alumni */
    .stories-section {
        margin-bottom: 50px;
    }
    .stories-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }
    @media (max-width: 992px) { .stories-container { grid-template-columns: 1fr; } }

    .story-card {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        padding: 32px;
        box-shadow: var(--apple-shadow);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: none;
        position: relative;
    }
    .story-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--apple-shadow-hover);
    }
    .story-card.featured {
        grid-column: span 2;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        color: white;
    }
    @media (max-width: 992px) { .story-card.featured { grid-column: span 1; } }
    .story-card.featured .story-title,
    .story-card.featured .story-excerpt { color: white; }
    .story-card.featured .story-meta { opacity: 0.7; }

    .story-quote {
        font-size: 3rem;
        line-height: 1;
        opacity: 0.1;
        position: absolute;
        top: 20px;
        left: 24px;
    }
    .story-author {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 20px;
    }
    .story-author img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }
    .story-author-info h6 {
        font-weight: 600;
        margin-bottom: 2px;
        font-size: 1rem;
    }
    .story-author-info span {
        font-size: 0.85rem;
        color: var(--apple-text-secondary);
    }
    .story-card.featured .story-author-info span { color: rgba(255,255,255,0.7); }
    .story-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--apple-text);
        margin-bottom: 12px;
        line-height: 1.4;
    }
    .story-excerpt {
        font-size: 0.95rem;
        color: var(--apple-text-secondary);
        line-height: 1.7;
        margin-bottom: 20px;
    }
    .story-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        font-size: 0.85rem;
        color: var(--apple-text-secondary);
    }
    .story-tag {
        background: var(--apple-blue);
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    .story-card.featured .story-tag { background: rgba(255,255,255,0.2); }

    /* Quick Actions */
    .quick-actions {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 50px;
    }
    .hero-actions {
        margin-top: 32px;
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }
    .apple-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 28px;
        border-radius: 980px;
        font-size: 1rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    .apple-btn-primary {
        background: var(--apple-blue);
        color: white;
    }
    .apple-btn-primary:hover {
        background: var(--apple-blue-hover);
        transform: scale(1.02);
    }
    .apple-btn-secondary {
        background: #f5f5f7;
        color: var(--apple-text);
    }
    .apple-btn-secondary:hover {
        background: #e8e8ed;
    }

    /* Announcements */
    .announcement-list {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        overflow: hidden;
        box-shadow: var(--apple-shadow);
    }
    .announcement-item {
        padding: 24px 28px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        transition: background 0.2s;
    }
    .announcement-item:hover { background: #fafafa; }
    .announcement-item:last-child { border-bottom: none; }
    .announcement-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
        flex-shrink: 0;
    }
    .announcement-content h6 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--apple-text);
        margin-bottom: 4px;
    }
    .announcement-content p {
        font-size: 0.9rem;
        color: var(--apple-text-secondary);
        margin-bottom: 8px;
        line-height: 1.5;
    }
    .announcement-date {
        font-size: 0.8rem;
        color: var(--apple-text-secondary);
    }

    /* Responsive Hero */
    @media (max-width: 768px) {
        .apple-hero { padding: 40px 28px; }
        .apple-hero h1 { font-size: 2.2rem; }
        .apple-hero p { font-size: 1rem; }
        .hero-stats { flex-wrap: wrap; gap: 30px; }
        .hero-stat-number { font-size: 1.8rem; }
    }

    /* Animation */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
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

    /* ========== Dark Mode Support ========== */
    body.dark {
        --apple-bg: #0f0f0f;
        --apple-card: #1a1a1a;
        --apple-text: #f1f1f1;
        --apple-text-secondary: #aaaaaa;
        --apple-shadow: 0 4px 20px rgba(0,0,0,0.4);
        --apple-shadow-hover: 0 12px 40px rgba(0,0,0,0.5);
    }

    body.dark .section-title {
        color: #f1f1f1;
    }

    body.dark .section-subtitle {
        color: #aaa;
    }

    /* Dark Stat Cards */
    body.dark .apple-stat-card {
        background: #1a1a1a;
        border: 1px solid #2a2a2a;
    }

    body.dark .apple-stat-card .stat-value {
        color: #f1f1f1;
    }

    body.dark .apple-stat-card .stat-label {
        color: #aaa;
    }

    /* Dark Alumni Cards */
    body.dark .alumni-card {
        background: #1a1a1a;
        border: 1px solid #2a2a2a;
    }

    body.dark .alumni-card-body {
        background: #1a1a1a;
    }

    body.dark .alumni-name {
        color: #f1f1f1;
    }

    body.dark .alumni-batch {
        color: #aaa;
    }

    body.dark .alumni-company {
        background: #2a2a2a;
        color: #aaa;
    }

    /* Dark Story Cards */
    body.dark .story-card {
        background: #1a1a1a;
        border: 1px solid #2a2a2a;
    }

    body.dark .story-card .story-title {
        color: #f1f1f1;
    }

    body.dark .story-card .story-excerpt {
        color: #aaa;
    }

    body.dark .story-card .story-meta {
        color: #888;
    }

    body.dark .story-card .story-author-info h6 {
        color: #f1f1f1;
    }

    body.dark .story-card .story-author-info span {
        color: #aaa;
    }

    /* Dark Buttons */
    body.dark .apple-btn-secondary {
        background: #2a2a2a;
        color: #f1f1f1;
        border: 1px solid #3a3a3a;
    }

    body.dark .apple-btn-secondary:hover {
        background: #3a3a3a;
    }

    /* Dark Announcements */
    body.dark .announcement-list {
        background: #1a1a1a;
        border: 1px solid #2a2a2a;
    }

    body.dark .announcement-item {
        border-bottom-color: #2a2a2a;
    }

    body.dark .announcement-item:hover {
        background: #222;
    }

    body.dark .announcement-content h6 {
        color: #f1f1f1;
    }

    body.dark .announcement-content p {
        color: #aaa;
    }

    body.dark .announcement-date {
        color: #888;
    }
</style>
@endpush

@section('content')
<div class="apple-dashboard">
    <!-- Hero Section -->
    <div class="apple-hero animate-in">
        <h1>สาขาวิชาวิทยาการคอมพิวเตอร์</h1>
        <p>ระบบติดตามศิษย์เก่าและโครงงานนักศึกษา มหาวิทยาลัยราชภัฏเพชรบุรณ์</p>
        <div class="hero-actions">
            <a href="{{ route('projects.my') }}" class="apple-btn apple-btn-primary">
                <i class="bi bi-journal-text"></i>
                โครงงานของฉัน
            </a>
            <a href="{{ route('projects.index') }}" class="apple-btn apple-btn-secondary">
                <i class="bi bi-journal-code"></i>
                โครงงานทั้งหมด
            </a>
        </div>
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-number">{{ number_format($stats['totalAlumni'] ?? 0) }}</div>
                <div class="hero-stat-label">ศิษย์เก่าทั้งหมด</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-number">{{ number_format($stats['totalProjects'] ?? 0) }}</div>
                <div class="hero-stat-label">โครงงานนักศึกษา</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-number">{{ $stats['graduationYears'] ?? 0 }}</div>
                <div class="hero-stat-label">รุ่นที่จบการศึกษา</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-number">{{ $stats['employmentRate'] ?? 0 }}%</div>
                <div class="hero-stat-label">อัตราการมีงานทำ</div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="stats-grid">
        <div class="apple-stat-card animate-in delay-1">
            <div class="stat-icon" style="background: var(--apple-gradient-1);">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div class="stat-value">{{ number_format($stats['totalAlumni'] ?? 0) }}</div>
            <div class="stat-label">ศิษย์เก่าทั้งหมด</div>
            <div class="stat-change positive">
                <i class="bi bi-people"></i> ในระบบ
            </div>
        </div>
        <div class="apple-stat-card animate-in delay-2">
            <div class="stat-icon" style="background: var(--apple-gradient-3);">
                <i class="bi bi-briefcase-fill"></i>
            </div>
            <div class="stat-value">{{ number_format($stats['employedAlumni'] ?? 0) }}</div>
            <div class="stat-label">ศิษย์เก่ามีงานทำ</div>
            <div class="stat-change positive">
                <i class="bi bi-arrow-up"></i> {{ $stats['employmentRate'] ?? 0 }}%
            </div>
        </div>
        <div class="apple-stat-card animate-in delay-3">
            <div class="stat-icon" style="background: var(--apple-gradient-2);">
                <i class="bi bi-journal-code"></i>
            </div>
            <div class="stat-value">{{ number_format($stats['totalProjects'] ?? 0) }}</div>
            <div class="stat-label">โครงงานทั้งหมด</div>
            <div class="stat-change positive">
                <i class="bi bi-check-circle"></i> {{ $stats['completedProjects'] ?? 0 }} เสร็จสิ้น
            </div>
        </div>
        <div class="apple-stat-card animate-in delay-4">
            <div class="stat-icon" style="background: var(--apple-gradient-4);">
                <i class="bi bi-rocket-takeoff"></i>
            </div>
            <div class="stat-value">{{ number_format($stats['selfEmployedAlumni'] ?? 0) }}</div>
            <div class="stat-label">ประกอบธุรกิจส่วนตัว</div>
            <div class="stat-change positive">
                <i class="bi bi-shop"></i> เจ้าของกิจการ
            </div>
        </div>
    </div>

    <!-- Distinguished Alumni Section -->
    <div class="alumni-section">
        <h2 class="section-title">🏆 ศิษย์เก่าดีเด่น</h2>
        <p class="section-subtitle">บุคลากรที่สร้างชื่อเสียงให้กับสาขาวิชาวิทยาการคอมพิวเตอร์</p>
        
        <div class="alumni-grid">
            @forelse($featuredAlumni as $index => $alumni)
            @php
                $gradients = ['gradient-1', 'gradient-2', 'gradient-3'];
                $colors = ['667eea', 'f093fb', '4facfe'];
                $gradient = $gradients[$index % 3];
                $color = $colors[$index % 3];
                $initials = mb_substr($alumni->first_name, 0, 1) . '+' . mb_substr($alumni->last_name, 0, 1);
            @endphp
            <div class="alumni-card animate-in delay-{{ $index + 1 }}">
                <div class="alumni-card-header {{ $gradient }}">
                    <span class="alumni-badge">⭐ รุ่น {{ $alumni->graduation_year }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($alumni->first_name . ' ' . $alumni->last_name) }}&background={{ $color }}&color=fff&size=200" alt="Alumni" class="alumni-avatar">
                </div>
                <div class="alumni-card-body">
                    <h5 class="alumni-name">{{ $alumni->prefix }}{{ $alumni->first_name }} {{ $alumni->last_name }}</h5>
                    <p class="alumni-batch">รุ่นปี พ.ศ. {{ $alumni->graduation_year }}</p>
                    <p class="alumni-position">{{ $alumni->current_position ?? '-' }}</p>
                    <span class="alumni-company">
                        <i class="bi bi-building"></i>
                        {{ $alumni->current_workplace ?? '-' }}
                    </span>
                </div>
            </div>
            @empty
            <div class="alumni-card animate-in delay-1">
                <div class="alumni-card-header gradient-1">
                    <span class="alumni-badge">⭐ ตัวอย่าง</span>
                    <img src="https://ui-avatars.com/api/?name=No+Data&background=667eea&color=fff&size=200" alt="Alumni" class="alumni-avatar">
                </div>
                <div class="alumni-card-body">
                    <h5 class="alumni-name">ยังไม่มีข้อมูล</h5>
                    <p class="alumni-batch">กรุณาเพิ่มข้อมูลศิษย์เก่า</p>
                    <p class="alumni-position">-</p>
                    <span class="alumni-company">
                        <i class="bi bi-building"></i>
                        -
                    </span>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Stories from Alumni - PR Section -->
    <div class="stories-section">
        <h2 class="section-title">� โครงงานล่าสุด</h2>
        <p class="section-subtitle">โครงงานนักศึกษาที่อัพเดตล่าสุดในระบบ</p>

        <div class="stories-container">
            @forelse($latestProjects->take(3) as $index => $project)
            @php
                $statusColors = [
                    'completed' => 'var(--apple-green)',
                    'in_progress' => 'var(--apple-blue)',
                    'proposal' => 'var(--apple-orange)',
                    'cancelled' => 'var(--apple-red)',
                ];
                $statusLabels = [
                    'completed' => 'เสร็จสิ้น',
                    'in_progress' => 'กำลังดำเนินการ',
                    'proposal' => 'เสนอโครงงาน',
                    'cancelled' => 'ยกเลิก',
                ];
                $members = is_array($project->members) ? $project->members : json_decode($project->members ?? '[]', true);
            @endphp
            <div class="story-card {{ $index === 0 ? 'featured' : '' }} animate-in delay-{{ $index + 1 }}">
                <span class="story-quote">📁</span>
                <div class="story-author">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($project->project_code) }}&background={{ $index === 0 ? '667eea' : '4facfe' }}&color=fff&size=100" alt="Project">
                    <div class="story-author-info">
                        <h6>{{ $project->project_code }}</h6>
                        <span>{{ $project->category }} | ปี {{ $project->academic_year }}</span>
                    </div>
                </div>
                <h5 class="story-title">{{ $project->title }}</h5>
                <p class="story-excerpt">
                    {{ Str::limit($project->description ?? 'ไม่มีรายละเอียด', 150) }}
                    @if($project->advisor)
                    <br><strong>อาจารย์ที่ปรึกษา:</strong> {{ $project->advisor }}
                    @endif
                </p>
                <div class="story-meta">
                    <span class="story-tag" style="background: {{ $statusColors[$project->status] ?? 'var(--apple-blue)' }}">{{ $statusLabels[$project->status] ?? $project->status }}</span>
                    @if($project->score)
                    <span><i class="bi bi-star-fill" style="color: gold;"></i> {{ $project->score }} คะแนน</span>
                    @endif
                    @if(count($members ?? []) > 0)
                    <span><i class="bi bi-people"></i> {{ count($members) }} คน</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="story-card featured animate-in delay-1">
                <span class="story-quote">📁</span>
                <div class="story-author">
                    <img src="https://ui-avatars.com/api/?name=No+Data&background=667eea&color=fff&size=100" alt="Project">
                    <div class="story-author-info">
                        <h6>ยังไม่มีข้อมูล</h6>
                        <span>กรุณาเพิ่มข้อมูลโครงงาน</span>
                    </div>
                </div>
                <h5 class="story-title">ยังไม่มีโครงงานในระบบ</h5>
                <p class="story-excerpt">
                    กรุณาเพิ่มข้อมูลโครงงานนักศึกษาในหน้าจัดการโครงงาน
                </p>
                <div class="story-meta">
                    <span class="story-tag">ไม่มีข้อมูล</span>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions animate-in">
        <a href="{{ route('students.index') }}" class="apple-btn apple-btn-primary">
            <i class="bi bi-people-fill"></i>
            จัดการนักศึกษา
        </a>
        <a href="{{ route('alumni.index') }}" class="apple-btn apple-btn-secondary">
            <i class="bi bi-mortarboard"></i>
            ค้นหาศิษย์เก่า
        </a>
        <a href="{{ route('projects.index') }}" class="apple-btn apple-btn-secondary">
            <i class="bi bi-journal-code"></i>
            โครงงานนักศึกษา
        </a>
        <a href="{{ route('projects.my') }}" class="apple-btn apple-btn-secondary">
            <i class="bi bi-journal-text"></i>
            โครงงานของฉัน
        </a>
        <a href="{{ route('internships.index') }}" class="apple-btn apple-btn-secondary">
            <i class="bi bi-building"></i>
            สถานที่ฝึกงาน
        </a>
        <a href="{{ route('reports.myStudent') }}" class="apple-btn apple-btn-secondary">
            <i class="bi bi-person-check"></i>
            รายงานของฉัน
        </a>
        <a href="{{ route('reports.internships') }}" class="apple-btn apple-btn-secondary">
            <i class="bi bi-graph-up"></i>
            รายงานฝึกงาน
        </a>
        <a href="{{ route('alumni.statistics') }}" class="apple-btn apple-btn-secondary">
            <i class="bi bi-bar-chart-fill"></i>
            รายงานสถิติ
        </a>
    </div>

    <!-- Announcements -->
    <div class="mb-4">
        <h2 class="section-title">📢 ประกาศล่าสุด</h2>
        <p class="section-subtitle">ข่าวสารและกิจกรรมสำหรับศิษย์เก่าและนักศึกษา</p>
    </div>
    <div class="announcement-list animate-in">
        @forelse($announcements as $announcement)
        <div class="announcement-item">
            <div class="announcement-icon" style="background: {{ $announcement->color ?? 'var(--apple-gradient-1)' }};">
                <i class="bi {{ $announcement->icon ?? 'bi-megaphone' }}"></i>
            </div>
            <div class="announcement-content">
                <h6>{{ $announcement->title }}</h6>
                <p>{{ Str::limit($announcement->content, 150) }}</p>
                <span class="announcement-date"><i class="bi bi-clock"></i> {{ $announcement->time_ago }}</span>
            </div>
        </div>
        @empty
        <div class="announcement-item">
            <div class="announcement-icon" style="background: var(--apple-gradient-1);">
                <i class="bi bi-info-circle"></i>
            </div>
            <div class="announcement-content">
                <h6>ยังไม่มีประกาศ</h6>
                <p>ยังไม่มีประกาศในระบบ</p>
                <span class="announcement-date"><i class="bi bi-clock"></i> -</span>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection