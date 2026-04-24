@extends('layouts.app')

@section('title', 'โปรไฟล์ผู้ใช้')

@push('styles')
<style>
    :root {
        --apple-card: #ffffff;
        --apple-text: #1d1d1f;
        --apple-text-secondary: #86868b;
        --apple-blue: #0071e3;
        --apple-blue-hover: #0077ed;
        --apple-green: #34c759;
        --apple-red: #ff3b30;
        --apple-shadow: 0 4px 20px rgba(0,0,0,0.08);
        --apple-shadow-hover: 0 12px 40px rgba(0,0,0,0.12);
        --apple-radius: 20px;
    }

    .profile-container { padding: 0; }

    /* Header */
    .profile-header {
        background: linear-gradient(135deg, #0071e3 0%, #0077ed 100%);
        border-radius: var(--apple-radius);
        padding: 50px 40px;
        color: white;
        margin-bottom: 30px;
        box-shadow: var(--apple-shadow);
    }

    .profile-header-content {
        display: flex;
        align-items: center;
        gap: 24px;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(255,255,255,0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: #0071e3;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }

    .profile-header-info h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .profile-header-info p {
        font-size: 1rem;
        opacity: 0.9;
    }

    /* Cards Grid */
    .profile-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 24px;
    }

    @media (max-width: 768px) {
        .profile-grid { grid-template-columns: 1fr; }
    }

    .profile-card {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        padding: 32px;
        box-shadow: var(--apple-shadow);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .profile-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--apple-shadow-hover);
    }

    .profile-card h2 {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--apple-text);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .profile-card h2 i {
        color: var(--apple-blue);
        font-size: 1.2rem;
    }

    .profile-info-item {
        margin-bottom: 16px;
    }

    .profile-info-label {
        font-size: 0.85rem;
        color: var(--apple-text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .profile-info-value {
        font-size: 1rem;
        color: var(--apple-text);
        font-weight: 500;
    }

    .permission-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .permission-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.95rem;
        color: var(--apple-text);
    }

    .permission-check {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--apple-green);
        color: white;
        font-size: 0.7rem;
        flex-shrink: 0;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        background: rgba(52,199,89,0.1);
        color: var(--apple-green);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* Full Width Cards */
    .profile-card-full {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        padding: 32px;
        box-shadow: var(--apple-shadow);
        border: 1px solid #f0f0f0;
        margin-top: 24px;
        transition: all 0.3s ease;
    }

    .profile-card-full:hover {
        box-shadow: var(--apple-shadow-hover);
    }

    .profile-card-full h2 {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--apple-text);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .button-group {
        display: flex;
        gap: 12px;
        margin-top: 16px;
    }

    .apple-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 12px;
        font-size: 0.95rem;
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

    .apple-btn-danger {
        background: var(--apple-red);
        color: white;
    }

    .apple-btn-danger:hover {
        background: #ff453a;
        transform: scale(1.02);
    }

    .description-text {
        font-size: 0.95rem;
        color: var(--apple-text-secondary);
        line-height: 1.6;
        margin-bottom: 16px;
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
</style>
@endpush

@section('content')
<div class="profile-container">
    <!-- Header -->
    <div class="profile-header animate-in">
        <div class="profile-header-content">
            <div class="profile-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="profile-header-info">
                <h1>{{ auth()->user()->name ?? 'ผู้ใช้งาน' }}</h1>
                <p>{{ auth()->user()->email ?? 'ไม่มีอีเมล' }}</p>
            </div>
        </div>
    </div>

    <!-- Info Grid -->
    <div class="profile-grid">
        <!-- Account Info -->
        <div class="profile-card animate-in delay-1">
            <h2>
                <i class="fas fa-user-circle"></i> ข้อมูลบัญชี
            </h2>
            <div>
                <div class="profile-info-item">
                    <div class="profile-info-label">ชื่อผู้ใช้</div>
                    <div class="profile-info-value">{{ auth()->user()->name ?? '-' }}</div>
                </div>
                <div class="profile-info-item">
                    <div class="profile-info-label">อีเมล</div>
                    <div class="profile-info-value">{{ auth()->user()->email ?? '-' }}</div>
                </div>
                <div class="profile-info-item">
                    <div class="profile-info-label">สถานะสมาชิก</div>
                    <div class="profile-info-value">
                        <div class="status-badge">
                            <i class="fas fa-check-circle"></i> ใช้งานอยู่
                        </div>
                    </div>
                </div>
                <div class="profile-info-item">
                    <div class="profile-info-label">เข้าสู่ระบบครั้งสุดท้าย</div>
                    <div class="profile-info-value">{{ auth()->user()->updated_at?->format('d M Y, H:i') ?? 'ครั้งแรก' }}</div>
                </div>
            </div>
        </div>

        <!-- Permissions -->
        <div class="profile-card animate-in delay-2">
            <h2>
                <i class="fas fa-shield-alt"></i> สิทธิ์การเข้าถึง
            </h2>
            <div class="permission-list">
                <div class="permission-item">
                    <div class="permission-check">
                        <i class="fas fa-check" style="font-size: 0.6rem;"></i>
                    </div>
                    <span>จัดการนักศึกษา</span>
                </div>
                <div class="permission-item">
                    <div class="permission-check">
                        <i class="fas fa-check" style="font-size: 0.6rem;"></i>
                    </div>
                    <span>จัดการโครงงาน</span>
                </div>
                <div class="permission-item">
                    <div class="permission-check">
                        <i class="fas fa-check" style="font-size: 0.6rem;"></i>
                    </div>
                    <span>จัดการศิษย์เก่า</span>
                </div>
                <div class="permission-item">
                    <div class="permission-check">
                        <i class="fas fa-check" style="font-size: 0.6rem;"></i>
                    </div>
                    <span>จัดการสถานที่ฝึกงาน</span>
                </div>
                <div class="permission-item">
                    <div class="permission-check">
                        <i class="fas fa-check" style="font-size: 0.6rem;"></i>
                    </div>
                    <span>ดูรายงานสถิติ</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Security -->
    <div class="profile-card-full animate-in delay-3">
        <h2>
            <i class="fas fa-lock"></i> ความปลอดภัย
        </h2>
        <p class="description-text">เพื่อความปลอดภัยของบัญชีของคุณ แนะนำให้เปลี่ยนรหัสผ่านอย่างสม่ำเสมอ</p>
        <div class="button-group">
            <button class="apple-btn apple-btn-primary">
                <i class="fas fa-key"></i> เปลี่ยนรหัสผ่าน
            </button>
        </div>
    </div>

    <!-- Logout -->
    <div class="profile-card-full animate-in delay-3">
        <h2>
            <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
        </h2>
        <p class="description-text">คลิกปุ่มด้านล่างเพื่อออกจากระบบอย่างปลอดภัย</p>
        <div class="button-group">
            <a href="{{ route('logout') }}" class="apple-btn apple-btn-danger">
                <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
            </a>
        </div>
    </div>
</div>
    </div>
</div>
@endsection
