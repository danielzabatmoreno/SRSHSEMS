<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Strand;
use App\Models\Subject;
use App\Models\StudentRegistration;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get strand counts
        $strandCounts = Students::select('strands.Strand_Name', DB::raw('count(*) as total'))
            ->join('strands', 'students.StrandID', '=', 'strands.StrandID')
            ->groupBy('strands.Strand_Name')
            ->pluck('total', 'Strand_Name')
            ->toArray();

        // Initialize counts with 0 if no students
        $stemCount  = $strandCounts['STEM']  ?? 0;
        $abmCount   = $strandCounts['ABM']   ?? 0;
        $humssCount = $strandCounts['HUMSS'] ?? 0;
        $pendingCount = StudentRegistration::where('current_status', 'Pending')->count();
        $approvedCount   = StudentRegistration::where('current_status', 'Approved')->count();
        $rejectedCount   = StudentRegistration::where('current_status', 'Rejected')->count();

        // Totals
        $totalStudents = Students::count();
        $totalTeachers = Teacher::count();
        $totalSection  = Section::count();   // ✅ singular fixed
        $totalSubjects = Subject::count();
        $totalEnrolled = Students::count();
        $totalStrands  = Strand::count();
        $totalBoys     = Students::where('Gender', 'Male')->count();
        $totalGirls    = Students::where('Gender', 'Female')->count();

        // Pass to view
        return view('dashboard', compact(
            'stemCount',
            'abmCount',
            'humssCount',
            'totalStudents',
            'totalTeachers',
            'totalSection',
            'totalSubjects',
            'totalEnrolled',
            'totalStrands',
            'totalBoys',
            'totalGirls',
            'pendingCount',
            'approvedCount',
            'rejectedCount'
        ));
    }
}
