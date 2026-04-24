<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * My Student Report - Report for logged-in user
     */
    public function myStudentReport()
    {
        $user = Auth::user();
        
        // Get user's projects (as member)
        $myProjects = Project::whereJsonContains('members', $user->name)->get();
        
        // Get user's internships
        $myInternships = Internship::where('student_id', $user->name)
            ->orWhere('student_name', $user->name)
            ->get();
        
        // Calculate statistics
        $stats = [
            'totalProjects' => $myProjects->count(),
            'completedProjects' => $myProjects->where('status', 'completed')->count(),
            'inProgressProjects' => $myProjects->where('status', 'in_progress')->count(),
            'proposalProjects' => $myProjects->where('status', 'proposal')->count(),
            'totalInternships' => $myInternships->count(),
            'completedInternships' => $myInternships->where('status', 'completed')->count(),
            'inProgressInternships' => $myInternships->where('status', 'in_progress')->count(),
            'pendingInternships' => $myInternships->where('status', 'pending')->count(),
        ];
        
        return view('reports.my-student-report', compact('user', 'myProjects', 'myInternships', 'stats'));
    }
    
    /**
     * Internship Report - All internships for Computer Science Branch
     */
    public function myProjectReport()
    {
        $user = Auth::user();
        $myProjects = Project::whereJsonContains('members', $user->name)->get();

        $stats = [
            'totalProjects' => $myProjects->count(),
            'completedProjects' => $myProjects->where('status', 'completed')->count(),
            'inProgressProjects' => $myProjects->where('status', 'in_progress')->count(),
            'proposalProjects' => $myProjects->where('status', 'proposal')->count(),
            'totalProjectsByCategory' => $myProjects->groupBy('category')->map->count()->toArray(),
        ];

        return view('reports.my-projects', compact('user', 'myProjects', 'stats'));
    }

    public function internshipReport()
    {
        // Get all internships grouped by various criteria
        $allInternships = Internship::all();
        
        // Group by status
        $byStatus = $allInternships->groupBy('status')->map->count();
        
        // Group by academic year
        $byYear = $allInternships->groupBy('academic_year')->map->count();
        
        // Calculate statistics
        $stats = [
            'total' => $allInternships->count(),
            'completed' => $allInternships->where('status', 'completed')->count(),
            'inProgress' => $allInternships->where('status', 'in_progress')->count(),
            'pending' => $allInternships->where('status', 'pending')->count(),
            'totalCompanies' => $allInternships->pluck('company_name')->unique()->count(),
            'averageDuration' => $this->calculateAverageDuration($allInternships),
        ];
        
        // Get company statistics
        $companiesCount = $allInternships
            ->groupBy('company_name')
            ->map(function ($group) {
                return [
                    'company_name' => $group[0]->company_name,
                    'count' => $group->count(),
                    'students' => $group->pluck('student_name')->unique()->toArray(),
                ];
            })
            ->sortByDesc('count')
            ->take(10);
        
        return view('reports.internship-report', compact('allInternships', 'stats', 'companiesCount', 'byStatus', 'byYear'));
    }
    
    /**
     * Calculate average internship duration in days
     */
    private function calculateAverageDuration($internships)
    {
        $durations = $internships->filter(function ($internship) {
            return $internship->start_date && $internship->end_date;
        })->map(function ($internship) {
            return \Carbon\Carbon::parse($internship->end_date)
                ->diffInDays(\Carbon\Carbon::parse($internship->start_date));
        });
        
        return $durations->count() > 0 ? round($durations->avg(), 1) : 0;
    }
}
