<?php $__env->startSection('title', 'ศูนย์ช่วยเหลือ'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --apple-card: #ffffff;
        --apple-text: #1d1d1f;
        --apple-text-secondary: #86868b;
        --apple-blue: #0071e3;
        --apple-blue-hover: #0077ed;
        --apple-shadow: 0 4px 20px rgba(0,0,0,0.08);
        --apple-shadow-hover: 0 12px 40px rgba(0,0,0,0.12);
        --apple-radius: 20px;
    }

    .help-container { padding: 0; }

    /* Header */
    .help-header {
        background: linear-gradient(135deg, #0071e3 0%, #0077ed 100%);
        border-radius: var(--apple-radius);
        padding: 50px 40px;
        color: white;
        margin-bottom: 30px;
        box-shadow: var(--apple-shadow);
    }

    .help-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .help-header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* Search */
    .search-card {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        padding: 24px;
        box-shadow: var(--apple-shadow);
        margin-bottom: 30px;
        border: 1px solid #f0f0f0;
    }

    .search-input-wrapper {
        position: relative;
    }

    .search-input-wrapper input {
        width: 100%;
        padding: 14px 16px 14px 44px;
        font-size: 1rem;
        border-radius: 12px;
        border: 1.5px solid #e5e5e7;
        background: #f5f5f7;
        transition: all 0.3s ease;
    }

    .search-input-wrapper input:focus {
        outline: none;
        border-color: var(--apple-blue);
        background: white;
        box-shadow: 0 0 0 3px rgba(0,113,227,0.1);
    }

    .search-input-wrapper::before {
        content: '\f002';
        font-family: 'Font Awesome 5 Free';
        font-weight: 400;
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--apple-text-secondary);
        font-size: 0.9rem;
    }

    /* Layout Grid */
    .help-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 24px;
    }

    @media (max-width: 1024px) {
        .help-layout {
            grid-template-columns: 1fr;
        }
        .help-sidebar {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
    }

    @media (max-width: 768px) {
        .help-layout {
            grid-template-columns: 1fr;
        }
        .help-sidebar {
            grid-template-columns: 1fr;
        }
    }

    /* Sidebar */
    .help-sidebar {
        display: flex;
        flex-direction: column;
        gap: 8px;
        position: sticky;
        top: 20px;
        height: fit-content;
    }

    .help-sidebar h3 {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--apple-text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 8px 0;
        margin-bottom: 4px;
        display: none;
    }

    .nav-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        background: var(--apple-card);
        border: 1px solid #f0f0f0;
        border-radius: 12px;
        color: var(--apple-text);
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        text-align: left;
        width: 100%;
    }

    .nav-btn:hover {
        background: #f5f5f7;
        transform: translateX(4px);
        box-shadow: var(--apple-shadow);
    }

    .nav-btn i {
        font-size: 1.1rem;
    }

    /* Content */
    .help-content {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .help-section {
        background: var(--apple-card);
        border-radius: var(--apple-radius);
        padding: 32px;
        box-shadow: var(--apple-shadow);
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .help-section:hover {
        transform: translateY(-4px);
        box-shadow: var(--apple-shadow-hover);
    }

    .help-section h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--apple-text);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .help-section h2 i {
        font-size: 1.3rem;
    }

    .help-subsection {
        margin-bottom: 20px;
    }

    .help-subsection:last-child {
        margin-bottom: 0;
    }

    .help-subsection h3 {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--apple-text);
        margin-bottom: 8px;
    }

    .help-subsection p,
    .help-subsection li {
        font-size: 0.95rem;
        color: var(--apple-text-secondary);
        line-height: 1.6;
    }

    .help-subsection ul,
    .help-subsection ol {
        margin-left: 20px;
        space-y: 4px;
    }

    .help-subsection li {
        margin-bottom: 6px;
    }

    .code-block {
        background: #f5f5f7;
        padding: 12px 16px;
        border-radius: 8px;
        border-left: 3px solid var(--apple-blue);
        margin: 12px 0;
        font-family: 'Monaco', 'Menlo', monospace;
        font-size: 0.85rem;
        overflow-x: auto;
    }

    .status-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        margin-top: 12px;
    }

    .status-item {
        background: #f5f5f7;
        padding: 12px;
        border-radius: 8px;
        font-size: 0.9rem;
        color: var(--apple-text-secondary);
    }

    /* Support Section */
    .support-section {
        background: linear-gradient(135deg, #f5f5f7 0%, #ffffff 100%);
        border-radius: var(--apple-radius);
        padding: 32px;
        box-shadow: var(--apple-shadow);
        border: 1px solid #e5e5e7;
    }

    .support-section h2 {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--apple-blue);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .support-section p {
        font-size: 0.95rem;
        color: var(--apple-text-secondary);
        margin-bottom: 16px;
    }

    .support-info {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .support-item {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--apple-text);
        font-size: 0.9rem;
    }

    .support-item i {
        width: 20px;
        text-align: center;
        color: var(--apple-blue);
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="help-container">
    <!-- Header -->
    <div class="help-header animate-in">
        <h1>
            <i class="fas fa-question-circle"></i> ศูนย์ช่วยเหลือและคำถามที่พบบ่อย
        </h1>
        <p>ค้นหาคำตอบสำหรับคำถามและปัญหาทั่วไป</p>
    </div>

    <!-- Search -->
    <div class="search-card animate-in delay-1">
        <div class="search-input-wrapper">
            <input type="text" id="searchHelp" placeholder="ค้นหาหัวข้อช่วยเหลือ..." />
        </div>
    </div>

    <!-- Main Layout -->
    <div class="help-layout">
        <!-- Sidebar Navigation -->
        <div class="help-sidebar animate-in delay-2">
            <button onclick="scrollToSection('getting-started')" class="nav-btn">
                <i class="fas fa-play-circle" style="color: #0071e3;"></i>
                <span>เริ่มต้นใช้งาน</span>
            </button>
            <button onclick="scrollToSection('students')" class="nav-btn">
                <i class="fas fa-users" style="color: #34c759;"></i>
                <span>จัดการนักศึกษา</span>
            </button>
            <button onclick="scrollToSection('projects')" class="nav-btn">
                <i class="fas fa-project-diagram" style="color: #af52de;"></i>
                <span>โครงงาน</span>
            </button>
            <button onclick="scrollToSection('alumni')" class="nav-btn">
                <i class="fas fa-graduation-cap" style="color: #ff9500;"></i>
                <span>ศิษย์เก่า</span>
            </button>
            <button onclick="scrollToSection('internships')" class="nav-btn">
                <i class="fas fa-building" style="color: #ff3b30;"></i>
                <span>สถานที่ฝึกงาน</span>
            </button>
            <button onclick="scrollToSection('account')" class="nav-btn">
                <i class="fas fa-user-cog" style="color: #86868b;"></i>
                <span>บัญชี</span>
            </button>
        </div>

        <!-- Content -->
        <div class="help-content">
            <!-- Getting Started -->
            <section id="getting-started" class="help-section animate-in delay-1">
                <h2>
                    <i class="fas fa-play-circle"></i> เริ่มต้นใช้งาน
                </h2>
                <div class="help-subsection">
                    <h3>ระบบนี้คืออะไร?</h3>
                    <p>ระบบนี้ออกแบบมาเพื่อจัดการข้อมูลนักศึกษา โครงงาน ศิษย์เก่า และสถานที่ฝึกงานของสาขาวิชาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยราชภัฏเพชรบูรณ์</p>
                </div>
                <div class="help-subsection">
                    <h3>ฉันสามารถทำอะไรได้บ้าง?</h3>
                    <ul>
                        <li>จัดการข้อมูลนักศึกษา เพิ่มแก้ไขและลบ</li>
                        <li>ติดตามและจัดการโครงงานนักศึกษา</li>
                        <li>เก็บข้อมูลศิษย์เก่าและสถิติการไปทำงาน</li>
                        <li>บันทึกข้อมูลสถานที่ฝึกงานของนักศึกษา</li>
                        <li>ดูรายงานและสถิติอื่น ๆ</li>
                    </ul>
                </div>
            </section>

            <!-- Students -->
            <section id="students" class="help-section animate-in delay-1">
                <h2>
                    <i class="fas fa-users"></i> จัดการนักศึกษา
                </h2>
                <div class="help-subsection">
                    <h3>📝 วิธีเพิ่มนักศึกษา</h3>
                    <ol>
                        <li>ไปที่หน้า "จัดการนักศึกษา"</li>
                        <li>คลิกปุ่ม "เพิ่มข้อมูล"</li>
                        <li>กรอกข้อมูลรหัสนักศึกษา ชื่อ นามสกุล อีเมล และเบอร์โทร</li>
                        <li>คลิก "บันทึกข้อมูล"</li>
                    </ol>
                </div>
                <div class="help-subsection">
                    <h3>🔍 วิธีค้นหานักศึกษา</h3>
                    <p>ใช้ช่อง "ค้นหา" และพิมพ์ชื่อหรือรหัสนักศึกษา ผลลัพธ์จะแสดงตามที่ค้นหาเรียลไทม์</p>
                </div>
                <div class="help-subsection">
                    <h3>✏️ วิธีแก้ไขข้อมูล</h3>
                    <p>คลิกปุ่ม "แก้ไข" ในแถวของนักศึกษา แล้วปรับเปลี่ยนข้อมูลตามต้องการ</p>
                </div>
            </section>

            <!-- Projects -->
            <section id="projects" class="help-section animate-in delay-2">
                <h2>
                    <i class="fas fa-project-diagram"></i> จัดการโครงงาน
                </h2>
                <div class="help-subsection">
                    <h3>📌 สถานะโครงงาน</h3>
                    <div class="status-grid">
                        <div class="status-item">🟠 <strong>เสนอโครงงาน</strong> - ยังไม่อนุมัติ</div>
                        <div class="status-item">🔵 <strong>กำลังดำเนินการ</strong> - กำลังทำ</div>
                        <div class="status-item">🟢 <strong>เสร็จสิ้น</strong> - สำเร็จแล้ว</div>
                        <div class="status-item">🔴 <strong>ยกเลิก</strong> - ไม่ดำเนินการต่อ</div>
                    </div>
                </div>
                <div class="help-subsection">
                    <h3>📊 โครงงานของฉัน</h3>
                    <p>คลิก "โครงงานของฉัน" เพื่อดูเฉพาะโครงงานที่คุณเป็นสมาชิก</p>
                </div>
            </section>

            <!-- Alumni -->
            <section id="alumni" class="help-section animate-in delay-2">
                <h2>
                    <i class="fas fa-graduation-cap"></i> จัดการศิษย์เก่า
                </h2>
                <div class="help-subsection">
                    <h3>📋 บันทึกข้อมูลศิษย์เก่า</h3>
                    <p>ระบบช่วยให้คุณติดตามศิษย์เก่า วุฒิการศึกษา สถานที่ทำงาน และข้อมูลการติดต่อ</p>
                </div>
                <div class="help-subsection">
                    <h3>📊 ดูรายงาน</h3>
                    <p>ไปที่ "รายงานสถิติ" เพื่อดูข้อมูลศิษย์เก่า จำนวนผู้ได้งาน ที่ตั้งงาน และสถิติอื่น ๆ</p>
                </div>
            </section>

            <!-- Internships -->
            <section id="internships" class="help-section animate-in delay-3">
                <h2>
                    <i class="fas fa-building"></i> บันทึกสถานที่ฝึกงาน
                </h2>
                <div class="help-subsection">
                    <h3>🏢 เพิ่มข้อมูลสถานที่ฝึกงาน</h3>
                    <ol>
                        <li>ไปที่หน้า "สถานที่ฝึกงาน"</li>
                        <li>คลิก "เพิ่มข้อมูล"</li>
                        <li>กรอกรหัสนักศึกษา ชื่อ ชื่อบริษัท ตำแหน่ง วันที่เริ่มและสิ้นสุด</li>
                        <li>บันทึกข้อมูล</li>
                    </ol>
                </div>
                <div class="help-subsection">
                    <h3>📅 สถานะฝึกงาน</h3>
                    <div class="status-grid">
                        <div class="status-item">🟠 <strong>รอดำเนินการ</strong> - ยังไม่เริ่ม</div>
                        <div class="status-item">🔵 <strong>กำลังฝึกงาน</strong> - กำลังฝึก</div>
                        <div class="status-item">🟢 <strong>เสร็จสิ้น</strong> - ฝึกเสร็จแล้ว</div>
                    </div>
                </div>
            </section>

            <!-- Account -->
            <section id="account" class="help-section animate-in delay-3">
                <h2>
                    <i class="fas fa-user-cog"></i> บัญชีของคุณ
                </h2>
                <div class="help-subsection">
                    <h3>👤 ดูโปรไฟล์</h3>
                    <p>คลิกที่ชื่อหรือไอคอนโปรไฟล์ที่มุมบนขวา เพื่อดูข้อมูลบัญชีของคุณ</p>
                </div>
                <div class="help-subsection">
                    <h3>🔐 ความปลอดภัย</h3>
                    <p>แนะนำให้เปลี่ยนรหัสผ่านอย่างน้อยทุก 3 เดือน</p>
                </div>
                <div class="help-subsection">
                    <h3>🚪 ออกจากระบบ</h3>
                    <p>คลิก "ออกจากระบบ" เพื่อออกจากระบบอย่างปลอดภัย</p>
                </div>
            </section>

            <!-- Support -->
            <div class="support-section animate-in delay-3">
                <h2>
                    <i class="fas fa-headset"></i> ต้องการความช่วยเหลือเพิ่มเติม?
                </h2>
                <p>หากคุณมีคำถามที่ไม่ได้รับคำตอบในหน้านี้ สามารถติดต่อเราได้:</p>
                <div class="support-info">
                    <div class="support-item">
                        <i class="fas fa-envelope"></i>
                        <span><strong>อีเมล:</strong> cs.support@pcru.ac.th</span>
                    </div>
                    <div class="support-item">
                        <i class="fas fa-phone"></i>
                        <span><strong>โทรศัพท์:</strong> 042-XXXXXX</span>
                    </div>
                    <div class="support-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><strong>ที่อยู่:</strong> สาขาวิชาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยราชภัฏเพชรบูรณ์</span>
                    </div>
                </div>
            </div>
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

document.getElementById('searchHelp')?.addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const sections = document.querySelectorAll('.help-section, .support-section');
    
    sections.forEach(section => {
        const text = section.innerText.toLowerCase();
        section.style.display = text.includes(searchTerm) ? 'block' : 'none';
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/student/resources/views/help.blade.php ENDPATH**/ ?>