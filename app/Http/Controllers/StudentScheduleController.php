<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentScheduleController extends Controller
{
    public function index()
    {
        return view('student_schedule.index');
    }
}
