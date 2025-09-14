<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Strand;
use App\Models\Subject;
use App\Models\StudentRegistration;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /** ---------------------------
         *  School Year Selection
         * -------------------------- */
        $startYear = $request->input('start_year', now()->year);

        // School year: June 1 → May 31 next year
        $syStart = Carbon::createFromDate($startYear, 6, 1)->startOfDay();
        $syEnd   = Carbon::createFromDate($startYear + 1, 5, 31)->endOfDay();

        /** ---------------------------
         *  Strand Counts (filtered by school year)
         * -------------------------- */
        $strandCounts = Students::select('strands.Strand_Name', DB::raw('count(*) as total'))
            ->join('strands', 'students.StrandID', '=', 'strands.StrandID')
            ->whereBetween('students.created_at', [$syStart, $syEnd])
            ->groupBy('strands.Strand_Name')
            ->pluck('total', 'Strand_Name')
            ->toArray();

        $stemCount  = $strandCounts['STEM']  ?? 0;
        $abmCount   = $strandCounts['ABM']   ?? 0;
        $humssCount = $strandCounts['HUMSS'] ?? 0;

        /** ---------------------------
         *  Enrollment Request Status
         * -------------------------- */
        $pendingCount  = StudentRegistration::where('current_status', 'Pending')
                            ->whereBetween('application_date', [$syStart, $syEnd])
                            ->count();
        $approvedCount = StudentRegistration::where('current_status', 'Approved')
                            ->whereBetween('application_date', [$syStart, $syEnd])
                            ->count();
        $rejectedCount = StudentRegistration::where('current_status', 'Rejected')
                            ->whereBetween('application_date', [$syStart, $syEnd])
                            ->count();

        /** ---------------------------
         *  Totals (filtered by school year)
         * -------------------------- */
        $totalStudents = Students::whereBetween('created_at', [$syStart, $syEnd])->count();
        $totalTeachers = Teacher::whereBetween('created_at', [$syStart, $syEnd])->count();
        $totalSection  = Section::whereBetween('created_at', [$syStart, $syEnd])->count();
        $totalSubjects = Subject::whereBetween('created_at', [$syStart, $syEnd])->count();
        $totalRequest  = StudentRegistration::whereBetween('application_date', [$syStart, $syEnd])->count();
        $totalStrands  = Strand::whereBetween('created_at', [$syStart, $syEnd])->count();
        $totalBoys     = Students::where('Gender', 'Male')
                                 ->whereBetween('created_at', [$syStart, $syEnd])
                                 ->count();
        $totalGirls    = Students::where('Gender', 'Female')
                                 ->whereBetween('created_at', [$syStart, $syEnd])
                                 ->count();

        /** ---------------------------
         *  Enrollment Trend (Yearly/Monthly)
         * -------------------------- */
                    $trendData = Students::select(
                    DB::raw("YEAR(created_at) as year"),
                    DB::raw("MONTH(created_at) as month"),
                    DB::raw("COUNT(*) as total")
                )
                ->whereBetween('created_at', [$syStart, $syEnd])
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get();

            $enrollmentTrend = [];
            foreach ($trendData as $row) {
                $enrollmentTrend[$row->year][$row->month] = $row->total;
            }


        /** ---------------------------
         *  Return View
         * -------------------------- */
        return view('dashboard', compact(
            'stemCount',
            'abmCount',
            'humssCount',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'totalStudents',
            'totalTeachers',
            'totalSection',
            'totalSubjects',
            'totalRequest',
            'totalStrands',
            'totalBoys',
            'totalGirls',
            'startYear',
            'syStart',
            'syEnd',
            'enrollmentTrend'
        ));
    }
}
