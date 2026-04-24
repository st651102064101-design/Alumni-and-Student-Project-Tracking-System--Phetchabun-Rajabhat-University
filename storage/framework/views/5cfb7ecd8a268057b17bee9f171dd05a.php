<?php $__env->startSection('title', 'ศูนย์ช่วยเหลือ'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg text-white p-8">
        <h1 class="text-3xl font-bold mb-2">
            <i class="fas fa-question-circle mr-2"></i> ศูนย์ช่วยเหลือและคำถามที่พบบ่อย
        </h1>
        <p class="text-blue-100">ค้นหาคำตอบสำหรับคำถามและปัญหาทั่วไป</p>
    </div>

    <!-- Search -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" id="searchHelp" class="block w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 placeholder-gray-400" placeholder="ค้นหาหัวข้อช่วยเหลือ...">
        </div>
    </div>

    <!-- FAQ Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm p-4 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">หมวดหมู่</h3>
                <nav class="space-y-2">
                    <button onclick="scrollToSection('getting-started')" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors">
                        <i class="fas fa-play-circle mr-2 text-blue-600"></i> เริ่มต้นใช้งาน
                    </button>
                    <button onclick="scrollToSection('students')" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors">
                        <i class="fas fa-users mr-2 text-green-600"></i> จัดการนักศึกษา
                    </button>
                    <button onclick="scrollToSection('projects')" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors">
                        <i class="fas fa-project-diagram mr-2 text-purple-600"></i> โครงงาน
                    </button>
                    <button onclick="scrollToSection('alumni')" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors">
                        <i class="fas fa-graduation-cap mr-2 text-orange-600"></i> ศิษย์เก่า
                    </button>
                    <button onclick="scrollToSection('internships')" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors">
                        <i class="fas fa-building mr-2 text-red-600"></i> สถานที่ฝึกงาน
                    </button>
                    <button onclick="scrollToSection('account')" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors">
                        <i class="fas fa-user-cog mr-2 text-gray-600"></i> บัญชี
                    </button>
                </nav>
            </div>
        </div>

        <!-- Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Getting Started -->
            <section id="getting-started" class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-play-circle text-blue-600 mr-2"></i> เริ่มต้นใช้งาน
                </h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">ระบบนี้คืออะไร?</h3>
                        <p class="text-gray-600">ระบบนี้ออกแบบมาเพื่อจัดการข้อมูลนักศึกษา โครงงาน ศิษย์เก่า และสถานที่ฝึกงานของสาขาวิชาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยราชภัฏเพชรบูรณ์</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">ฉันสามารถทำอะไรได้บ้าง?</h3>
                        <ul class="text-gray-600 list-disc list-inside space-y-1">
                            <li>จัดการข้อมูลนักศึกษา เพิ่มแก้ไขและลบ</li>
                            <li>ติดตามและจัดการโครงงานนักศึกษา</li>
                            <li>เก็บข้อมูลศิษย์เก่าและสถิติการไปทำงาน</li>
                            <li>บันทึกข้อมูลสถานที่ฝึกงานของนักศึกษา</li>
                            <li>ดูรายงานและสถิติอื่น ๆ</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Students -->
            <section id="students" class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-users text-green-600 mr-2"></i> จัดการนักศึกษา
                </h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">📝 วิธีเพิ่มนักศึกษา</h3>
                        <ol class="text-gray-600 list-decimal list-inside space-y-1 bg-gray-50 p-3 rounded">
                            <li>ไปที่หน้า "จัดการนักศึกษา"</li>
                            <li>คลิกปุ่ม "เพิ่มข้อมูล"</li>
                            <li>กรอกข้อมูลรหัสนักศึกษา ชื่อ นามสกุล อีเมล และเบอร์โทร</li>
                            <li>คลิก "บันทึกข้อมูล"</li>
                        </ol>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">🔍 วิธีค้นหานักศึกษา</h3>
                        <p class="text-gray-600">ใช้ช่อง "ค้นหา" และพิมพ์ชื่อหรือรหัสนักศึกษา ผลลัพธ์จะแสดงตามที่ค้นหาเรียลไทม์</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">✏️ วิธีแก้ไขข้อมูล</h3>
                        <p class="text-gray-600">คลิกปุ่ม "แก้ไข" ในแถวของนักศึกษา แล้วปรับเปลี่ยนข้อมูลตามต้องการ</p>
                    </div>
                </div>
            </section>

            <!-- Projects -->
            <section id="projects" class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-project-diagram text-purple-600 mr-2"></i> จัดการโครงงาน
                </h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">📌 สถานะโครงงาน</h3>
                        <div class="grid grid-cols-2 gap-2 text-sm text-gray-600">
                            <div>🟠 เสนอโครงงาน - ยังไม่อนุมัติ</div>
                            <div>🔵 กำลังดำเนินการ - กำลังทำ</div>
                            <div>🟢 เสร็จสิ้น - สำเร็จแล้ว</div>
                            <div>🔴 ยกเลิก - ไม่ดำเนินการต่อ</div>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">📊 โครงงานของฉัน</h3>
                        <p class="text-gray-600">คลิก "โครงงานของฉัน" เพื่อดูเฉพาะโครงงานที่คุณเป็นสมาชิก</p>
                    </div>
                </div>
            </section>

            <!-- Alumni -->
            <section id="alumni" class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-graduation-cap text-orange-600 mr-2"></i> จัดการศิษย์เก่า
                </h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">📋 บันทึกข้อมูลศิษย์เก่า</h3>
                        <p class="text-gray-600">ระบบช่วยให้คุณติดตามศิษย์เก่า วุฒิการศึกษา สถานที่ทำงาน และข้อมูลการติดต่อ</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">📊 ดูรายงาน</h3>
                        <p class="text-gray-600">ไปที่ "รายงานสถิติ" เพื่อดูข้อมูลศิษย์เก่า จำนวนผู้ได้งาน ที่ตั้งงาน และสถิติอื่น ๆ</p>
                    </div>
                </div>
            </section>

            <!-- Internships -->
            <section id="internships" class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-building text-red-600 mr-2"></i> บันทึกสถานที่ฝึกงาน
                </h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">🏢 เพิ่มข้อมูลสถานที่ฝึกงาน</h3>
                        <ol class="text-gray-600 list-decimal list-inside space-y-1 bg-gray-50 p-3 rounded">
                            <li>ไปที่หน้า "สถานที่ฝึกงาน"</li>
                            <li>คลิก "เพิ่มข้อมูล"</li>
                            <li>กรอกรหัสนักศึกษา ชื่อ ชื่อบริษัท ตำแหน่ง วันที่เริ่มและสิ้นสุด</li>
                            <li>บันทึกข้อมูล</li>
                        </ol>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">📅 สถานะฝึกงาน</h3>
                        <div class="text-gray-600 space-y-1">
                            <div>🟠 รอดำเนินการ - ยังไม่เริ่ม</div>
                            <div>🔵 กำลังฝึกงาน - กำลังฝึก</div>
                            <div>🟢 เสร็จสิ้น - ฝึกเสร็จแล้ว</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Account -->
            <section id="account" class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-cog text-gray-600 mr-2"></i> บัญชีของคุณ
                </h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">👤 ดูโปรไฟล์</h3>
                        <p class="text-gray-600">คลิกที่ชื่อหรือไอคอนโปรไฟล์ที่มุมบนขวา เพื่อดูข้อมูลบัญชีของคุณ</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">🔐 ความปลอดภัย</h3>
                        <p class="text-gray-600">แนะนำให้เปลี่ยนรหัสผ่านอย่างน้อยทุก 3 เดือน</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">🚪 ออกจากระบบ</h3>
                        <p class="text-gray-600">คลิก "ออกจากระบบ" เพื่อออกจากระบบอย่างปลอดภัย</p>
                    </div>
                </div>
            </section>

            <!-- Support -->
            <section class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h2 class="text-xl font-bold text-blue-900 mb-3 flex items-center">
                    <i class="fas fa-headset text-blue-600 mr-2"></i> ต้องการความช่วยเหลือเพิ่มเติม?
                </h2>
                <p class="text-blue-800 mb-4">หากคุณมีคำถามที่ไม่ได้รับคำตอบในหน้านี้ สามารถติดต่อ:</p>
                <div class="space-y-2 text-blue-800">
                    <p><i class="fas fa-envelope mr-2"></i> อีเมล: cs.support@pcru.ac.th</p>
                    <p><i class="fas fa-phone mr-2"></i> โทรศัพท์: 042-XXXXXX</p>
                    <p><i class="fas fa-map-marker-alt mr-2"></i> สาขาวิชาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยราชภัฏเพชรบูรณ์</p>
                </div>
            </section>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

document.getElementById('searchHelp').addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const sections = document.querySelectorAll('section');
    
    sections.forEach(section => {
        const text = section.innerText.toLowerCase();
        section.style.display = text.includes(searchTerm) ? 'block' : 'none';
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/student/resources/views/help.blade.php ENDPATH**/ ?>