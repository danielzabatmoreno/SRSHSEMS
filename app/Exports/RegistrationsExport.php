<?php

namespace App\Exports;

use App\Models\StudentRegistration;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RegistrationsExport implements FromView
{
    public function view(): View
    {
        return view('students_registration.report_excel', [
            'registrations' => StudentRegistration::all()
        ]);
    }
}
