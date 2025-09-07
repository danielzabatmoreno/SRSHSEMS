<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students; // <-- import your model here

class OldStudentController extends Controller
{
    public function searchStudent(Request $request)
    {
        $student = Student::with(['strand', 'section']) // make sure these relationships exist
            ->where('StudentID', $request->student_id) // your table PK is StudentID
            ->first();

        if (!$student) {
            return back()->with('error', 'Student not found.');
        }

        return view('public_students.old_student_registration', compact('student'));
    }

    public function registerStudent(Request $request)
    {
        $student = Student::find($request->StudentID);

        if (!$student) {
            return back()->with('error', 'Student not found.');
        }

        $student->GradeLevel = $request->GradeLevel;
        $student->save();

        return back()->with('success', 'Old student registration submitted successfully!');
    }
}
