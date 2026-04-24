@extends('layouts.app')

@section('title', 'โปรไฟล์ผู้ใช้')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-700">
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0">
                <div class="h-16 w-16 rounded-full bg-white flex items-center justify-center shadow-sm">
                    <i class="fas fa-user text-3xl text-blue-600"></i>
                </div>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-white">{{ auth()->user()->name ?? 'ผู้ใช้งาน' }}</h1>
                <p class="text-blue-100">{{ auth()->user()->email ?? 'ไม่มีอีเมล' }}</p>
            </div>
        </div>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- ข้อมูลบัญชี -->
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-circle text-blue-600 mr-2"></i> ข้อมูลบัญชี
                </h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm text-gray-600">ชื่อผู้ใช้</label>
                        <p class="text-gray-900 font-medium">{{ auth()->user()->name ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600">อีเมล</label>
                        <p class="text-gray-900 font-medium">{{ auth()->user()->email ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600">สถานะสมาชิก</label>
                        <p class="text-gray-900 font-medium">
                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                <i class="fas fa-check-circle mr-1"></i> ใช้งานอยู่
                            </span>
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-600">เข้าสู่ระบบครั้งสุดท้าย</label>
                        <p class="text-gray-900 font-medium">{{ auth()->user()->updated_at?->format('d M Y, H:i') ?? 'ครั้งแรก' }}</p>
                    </div>
                </div>
            </div>

            <!-- สิทธิ์การเข้าถึง -->
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-shield-alt text-blue-600 mr-2"></i> สิทธิ์การเข้าถึง
                </h2>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-gray-700">จัดการนักศึกษา</span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-gray-700">จัดการโครงงาน</span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-gray-700">จัดการศิษย์เก่า</span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-gray-700">จัดการสถานที่ฝึกงาน</span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        <span class="text-gray-700">ดูรายงานสถิติ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- การเปลี่ยนรหัสผ่าน -->
        <div class="mt-6 bg-gray-50 rounded-lg p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-lock text-blue-600 mr-2"></i> ความปลอดภัย
            </h2>
            <div class="space-y-4">
                <p class="text-gray-600 text-sm">เพื่อความปลอดภัยของบัญชีของคุณ ลองเปลี่ยนรหัสผ่านอย่างสม่ำเสมอ</p>
                <button class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-key mr-2"></i> เปลี่ยนรหัสผ่าน
                </button>
            </div>
        </div>

        <!-- ออกจากระบบ -->
        <div class="mt-6">
            <a href="{{ route('logout') }}" class="inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                <i class="fas fa-sign-out-alt mr-2"></i> ออกจากระบบ
            </a>
        </div>
    </div>
</div>
@endsection
