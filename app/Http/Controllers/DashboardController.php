<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Alumni;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * แสดงหน้า Dashboard พร้อมข้อมูลจาก DB จริง
     */
    public function index()
    {
        // ดึงข้อมูลสถิติจาก DB จริง
        $stats = $this->getStats();
        
        // ดึงข้อมูลศิษย์เก่าดีเด่น (ล่าสุด 3 คน ที่มีงานทำ)
        $featuredAlumni = $this->getFeaturedAlumni();
        
        // ดึงข้อมูลโครงงานล่าสุด
        $latestProjects = $this->getLatestProjects();
        
        // ดึงประกาศล่าสุด
        $announcements = $this->getAnnouncements();
        
        return view('home', compact('stats', 'featuredAlumni', 'latestProjects', 'announcements'));
    }

    /**
     * ดึงสถิติต่างๆ
     */
    private function getStats()
    {
        try {
            // นับจำนวนโครงงานจาก wp_projects
            $totalProjects = Project::count();
            $completedProjects = Project::where('status', 'completed')->count();
            $inProgressProjects = Project::where('status', 'in_progress')->count();
            $proposalProjects = Project::where('status', 'proposal')->count();
        } catch (\Exception $e) {
            $totalProjects = 0;
            $completedProjects = 0;
            $inProgressProjects = 0;
            $proposalProjects = 0;
        }

        try {
            // นับจำนวนศิษย์เก่าจาก alumni
            $totalAlumni = Alumni::count();
            $employedAlumni = Alumni::where('status', 'employed')->count();
            $selfEmployedAlumni = Alumni::where('status', 'self_employed')->count();
            $furtherStudyAlumni = Alumni::where('status', 'further_study')->count();
            $unemployedAlumni = Alumni::where('status', 'unemployed')->count();
            
            // คำนวณอัตราการมีงานทำ
            $employmentRate = $totalAlumni > 0 
                ? round((($employedAlumni + $selfEmployedAlumni) / $totalAlumni) * 100) 
                : 0;
                
            // นับจำนวนรุ่นที่จบ
            $graduationYears = Alumni::distinct('graduation_year')->count('graduation_year');
        } catch (\Exception $e) {
            $totalAlumni = 0;
            $employedAlumni = 0;
            $selfEmployedAlumni = 0;
            $furtherStudyAlumni = 0;
            $unemployedAlumni = 0;
            $employmentRate = 0;
            $graduationYears = 0;
        }

        return [
            'totalAlumni' => $totalAlumni,
            'totalProjects' => $totalProjects,
            'graduationYears' => $graduationYears,
            'employmentRate' => $employmentRate,
            'employedAlumni' => $employedAlumni,
            'selfEmployedAlumni' => $selfEmployedAlumni,
            'furtherStudyAlumni' => $furtherStudyAlumni,
            'unemployedAlumni' => $unemployedAlumni,
            'completedProjects' => $completedProjects,
            'inProgressProjects' => $inProgressProjects,
            'proposalProjects' => $proposalProjects,
        ];
    }

    /**
     * ดึงข้อมูลศิษย์เก่าดีเด่น
     */
    private function getFeaturedAlumni()
    {
        try {
            // ดึงศิษย์เก่าที่มีงานทำ และมีตำแหน่งงาน (ล่าสุด 3 คน)
            return Alumni::whereIn('status', ['employed', 'self_employed'])
                ->whereNotNull('current_position')
                ->whereNotNull('current_workplace')
                ->orderBy('graduation_year', 'desc')
                ->limit(3)
                ->get();
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    /**
     * ดึงโครงงานล่าสุด
     */
    private function getLatestProjects()
    {
        try {
            return Project::orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    /**
     * ดึงประกาศล่าสุด
     */
    private function getAnnouncements()
    {
        try {
            return Announcement::active()
                ->orderBy('published_at', 'desc')
                ->limit(5)
                ->get();
        } catch (\Exception $e) {
            return collect([]);
        }
    }
}
