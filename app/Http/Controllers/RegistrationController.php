<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\StudentRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

// add exports
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegistrationsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class RegistrationController extends Controller
{
    public function __construct()
    {
        if (! Auth::check()) {
            redirect('/login')->send();
        }
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'Registrar' && $user->role !== 'Admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }

        $query = StudentRegistration::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('RegistrationID', 'LIKE', "%{$search}%");
        }

        $registrations = $query->paginate(5);

        return view('students_registration.index', compact('registrations'));
    }

    public function create()
    {
        return view('students_registration.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'FirstName' => 'required|string|max:50',
                'MiddleName' => 'nullable|string|max:50',
                'LastName' => 'required|string|max:50',
                'DOB' => 'required|date',
                'Gender' => 'required|string|in:Male,Female,Other',
                'Address' => 'required|string',
                'ContactNo' => 'required|string|max:15',
                'Email' => 'required|string|email|max:100|unique:student_registration',
                'Strand' => 'required|string|in:STEM,ABM,HUMSS',
                'GradeLevel' => 'required|string|in:Grade 11,Grade 12',
                'FatherFullName' => 'required|string|max:100',
                'MotherFullName' => 'required|string|max:100',
                'FatherContactNo' => 'required|string|max:15',
                'MotherContactNo' => 'required|string|max:15',
                'Form138' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'PSA' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            ]);

            if ($request->hasFile('Form138')) {
                $filePath = $request->file('Form138')->store('form138', 'public');
                $data['Form138'] = $filePath;
            } else {
                $data['Form138'] = null;
            }

            $data['Status'] = 'Pending';

            StudentRegistration::create($data);

            return redirect()->route('students_registration.index')
                ->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Registration failed. '.$e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $registration = StudentRegistration::findOrFail($id);

        return view('students_registration.edit', compact('registration'));
    }

    public function update(Request $request, $id)
    {
        try {
            $registration = StudentRegistration::findOrFail($id);

            // Status update: Approve/Reject
            if ($request->has('current_status')) {
                $data = ['current_status' => $request->current_status];

                switch ($request->current_status) {
                    case 'Approved':
                        $data['approved_date'] = now();
                        $data['rejected_date'] = null;

                        $plainPassword = Str::random(8);
                        $hashedPassword = Hash::make($plainPassword);

                        try {
                            User::create([
                                'name' => $registration->FirstName.' '.$registration->LastName,
                                'email' => $registration->Email,
                                'password' => $hashedPassword,
                                'role' => 'Student',
                            ]);

                            Mail::to($registration->Email)->send(new TestMail($registration, $plainPassword));
                        } catch (\Exception $e) {
                            return back()->withInput()
                                ->withErrors(['error' => 'Email sending failed. '.$e->getMessage()]);
                        }
                        break;

                    case 'Rejected':
                        $data['rejected_date'] = now();
                        $data['approved_date'] = null;

                        User::where('email', $registration->Email)
                            ->where('role', 'Student')
                            ->delete();
                        break;

                    default: // Pending
                        $data['approved_date'] = null;
                        $data['rejected_date'] = null;

                        User::where('email', $registration->Email)
                            ->where('role', 'Student')
                            ->delete();
                        break;
                }

                $registration->update($data);

                $statusMessage = $request->current_status == 'Approved' ? 'approved' : 'rejected';

                return redirect()->route('students_registration.index')
                    ->with('success', "Registration has been {$statusMessage} successfully");
            }

            // General edit
            $data = $request->validate([
                'FirstName' => 'required|string|max:50',
                'MiddleName' => 'nullable|string|max:50',
                'LastName' => 'required|string|max:50',
                'DOB' => 'required|date',
                'Gender' => 'required|string|in:Male,Female,Other',
                'Address' => 'required|string',
                'ContactNo' => 'required|string|max:15',
                'Email' => 'required|string|email|max:100|unique:student_registration,Email,'.$id.',RegistrationID',
                'GradeLevel' => 'required|string|in:Grade 11,Grade 12',
                'Strand' => 'required|string|in:STEM,ABM,HUMSS',
                'FatherFullName' => 'required|string|max:100',
                'MotherFullName' => 'required|string|max:100',
                'FatherContactNo' => 'required|string|max:15',
                'MotherContactNo' => 'required|string|max:15',
                'Form138' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'PSA' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
                'Status' => 'required|string|in:Pending,Approved,Rejected',
            ]);

            // Handle Form138
            if ($request->hasFile('Form138')) {
                $file = $request->file('Form138');
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('form138', $fileName, 'public');
                $data['Form138'] = $filePath;
            } else {
                unset($data['Form138']);
            }

            // Handle PSA
            if ($request->hasFile('PSA')) {
                $file = $request->file('PSA');
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('psa', $fileName, 'public');
                $data['PSA'] = $filePath;
            } else {
                $data['PSA'] = null;
            }

            $registration->update($data);

            return redirect()->route('students_registration.index')
                ->with('success', 'Registration updated successfully');

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Update failed. '.$e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $registration = StudentRegistration::findOrFail($id);
            $registration->delete();

            return redirect()->route('students_registration.index')
                ->with('success', 'Registration deleted successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Delete failed. '.$e->getMessage()]);
        }
    }

   // ✅ Excel export gamit Blade
    public function exportExcel()
    {
        return Excel::download(new RegistrationsExport, 'student_registrations.xlsx');
    }

    // ✅ PDF export gamit Blade
    public function exportPDF()
    {
        $registrations = StudentRegistration::all();
        $pdf = Pdf::loadView('students_registration.report_pdf', compact('registrations'));
        return $pdf->download('student_registrations.pdf');
    }

    // ✅ Word export gamit PhpWord
    public function exportDoc()
    {
        $registrations = StudentRegistration::all();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText("Student Registration Report", ['bold' => true, 'size' => 16]);

        foreach ($registrations as $reg) {
            $section->addText("ID: {$reg->RegistrationID}");
            $section->addText("Name: {$reg->FirstName} {$reg->LastName}");
            $section->addText("Strand: {$reg->Strand}, Grade: {$reg->GradeLevel}");
            $section->addText("Status: {$reg->current_status}");
            $section->addTextBreak(1);
        }

        $fileName = "student_registrations.docx";
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $phpWord->save($tempFile, 'Word2007');

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }
}