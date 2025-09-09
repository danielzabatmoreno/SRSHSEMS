<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentRegistration; // depende kung ito yung model name mo

class StudentController extends Controller
{
    public function studentDashboard()
    {
        // kunin yung registration ng current student
        $registration = StudentRegistration::where('user_id', auth()->id())->first();

        return view('dashboard.student', compact('registration'));
    }

    public function subjects()
    {
        // dito mo ilalagay logic to fetch subjects
        return view('student.subjects');
    }

    public function schedule()
    {
        // dito mo ilalagay logic to fetch schedule
        return view('student.schedule');
    }
}
