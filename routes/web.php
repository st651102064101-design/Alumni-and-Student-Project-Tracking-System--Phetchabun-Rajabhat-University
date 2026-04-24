<?php

use App\Http\Controllers\AuthenController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// TODO: เอาออกหลังจากเซตรันบนโฮสต์เสร็จแล้ว เพื่อแก้ไข Permission
Route::get('/fix-permissions', function () {
    $storage = storage_path();
    $cache = base_path('bootstrap/cache');
    try {
        shell_exec("chmod -R 777 $storage 2>&1");
        shell_exec("chmod -R 777 $cache 2>&1");
        return "Fixed permissions successfully for <br> - $storage <br> - $cache";
    } catch (\Exception $e) {
        return "Failed to fix permissions: " . $e->getMessage();
    }
});
 
Route::get('/', [AuthenController::class, 'index']);

Route::get('login', [AuthenController::class, 'index'])->name('login');

Route::post('verify', [AuthenController::class, 'verify'])->name('login.verify');

Route::middleware('auth')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [AuthenController::class, 'logout'])->name('logout');
    Route::get('profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('settings', function () {
        return view('profile');
    })->name('settings');
    Route::get('help', function () {
        return view('help');
    })->name('help');
    
    // Students routes
    Route::get('students', function () {
        return view('students.index');
    })->name('students.index');
    Route::post('students', [AuthenController::class, 'store'])->name('students.store');
    Route::put('students/{id}', [AuthenController::class, 'update'])->name('students.update');
    Route::delete('students/{id}', [AuthenController::class, 'destroy'])->name('students.destroy');

    // Projects routes (โครงงานนักศึกษา)
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/my', [ProjectController::class, 'myProjects'])->name('projects.my');
    Route::get('projects/data', [ProjectController::class, 'data'])->name('projects.data');
    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::put('projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::post('projects/bulk-delete', [ProjectController::class, 'bulkDestroy'])->name('projects.bulkDestroy');

    // Alumni routes (ศิษย์เก่า)
    Route::get('alumni', [App\Http\Controllers\AlumniController::class, 'index'])->name('alumni.index');
    Route::get('alumni/data', [App\Http\Controllers\AlumniController::class, 'data'])->name('alumni.data');
    Route::get('alumni/statistics', [App\Http\Controllers\AlumniController::class, 'statistics'])->name('alumni.statistics');
    Route::post('alumni', [App\Http\Controllers\AlumniController::class, 'store'])->name('alumni.store');
    Route::get('alumni/{id}', [App\Http\Controllers\AlumniController::class, 'show'])->name('alumni.show');
    Route::put('alumni/{id}', [App\Http\Controllers\AlumniController::class, 'update'])->name('alumni.update');
    Route::delete('alumni/{id}', [App\Http\Controllers\AlumniController::class, 'destroy'])->name('alumni.destroy');
    Route::post('alumni/bulk-delete', [App\Http\Controllers\AlumniController::class, 'bulkDestroy'])->name('alumni.bulkDestroy');

    // Internships routes (สถานที่ฝึกงาน)
    Route::get('students/list', [\App\Http\Controllers\StudentController::class, 'list'])->name('students.list');
    Route::get('internships', [App\Http\Controllers\InternshipController::class, 'index'])->name('internships.index');
    Route::get('internships/data', [App\Http\Controllers\InternshipController::class, 'data'])->name('internships.data');
    Route::post('internships', [App\Http\Controllers\InternshipController::class, 'store'])->name('internships.store');
    Route::get('internships/{id}', [App\Http\Controllers\InternshipController::class, 'show'])->name('internships.show');
    Route::put('internships/{id}', [App\Http\Controllers\InternshipController::class, 'update'])->name('internships.update');
    Route::delete('internships/{id}', [App\Http\Controllers\InternshipController::class, 'destroy'])->name('internships.destroy');
    Route::post('internships/bulk-delete', [App\Http\Controllers\InternshipController::class, 'bulkDestroy'])->name('internships.bulkDestroy');

    // Reports routes (รายงาน)
    Route::get('reports/my-student', [ReportController::class, 'myStudentReport'])->name('reports.myStudent');
    Route::get('reports/internships', [ReportController::class, 'internshipReport'])->name('reports.internships');
});
