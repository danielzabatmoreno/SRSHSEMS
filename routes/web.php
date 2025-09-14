<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicStudentRegistrationController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PublicPaymentController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\StrandController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\OldStudentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentScheduleController;
use App\Http\Controllers\StudentDashboardController;




Route::get('/', function () {
    return view('welcome'); // uses layouts/guest.blade.php
})->name('welcome');

// simple single route (auth middleware)
Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
    ->name('student.dashboard')
    ->middleware('auth');

Route::get('send-mail', [MailController::class, 'index']);
Route::get('send-registration-mail/{id}', [MailController::class, 'sendRegistrationEmail']);

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
// routes/web.php
Route::get('/get-registration/{id}', [App\Http\Controllers\StudentsController::class, 'getRegistration']);


// Rooms Routes
Route::middleware(['auth'])->prefix('rooms')->group(function () {
    Route::get('/', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/store', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/{id}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');
});

// Public routes (anyone can access to register)
Route::get('/students_registration/create', [RegistrationController::class, 'create'])->name('students_registration.create');
Route::post('/students_registration/store', [RegistrationController::class, 'store'])->name('students_registration.store');
Route::get('/students_registration/export/excel', [RegistrationController::class, 'exportExcel'])->name('students_registration.export.excel');
Route::get('/students_registration/export/pdf', [RegistrationController::class, 'exportPDF'])->name('students_registration.export.pdf');
Route::get('/students_registration/export/doc', [RegistrationController::class, 'exportDoc'])->name('students_registration.export.doc');

// Protected routes (registrar/admin only)
Route::middleware(['auth'])->group(function () {
    Route::get('/students_registration', [RegistrationController::class, 'index'])->name('students_registration.index');
    Route::get('/students_registration/{id}/edit', [RegistrationController::class, 'edit'])->name('students_registration.edit');
    Route::put('/students_registration/{id}', [RegistrationController::class, 'update'])->name('students_registration.update');
    Route::delete('/students_registration/{id}', [RegistrationController::class, 'destroy'])->name('students_registration.destroy');
});

Route::get('/public_student/old_student_registration', [PublicStudentRegistrationController::class, 'showOldRegistrationForm'])
    ->name('public_student.old_student_registration');
Route::post('/search-student', [OldStudentController::class, 'searchStudent'])->name('search.student');
Route::post('/old-student-register', [OldStudentController::class, 'registerStudent'])->name('old.student.register');


Route::middleware(['auth'])->group(function () {
    Route::resource('students', StudentsController::class);

});


Route::middleware(['auth'])->group(function () {
    Route::get('/Payment', [PaymentController::class, 'Payment_list'])->name('students_payment.Payment_list');
    Route::get('/Payment/create', [PaymentController::class, 'cashier_create'])->name('cashier_payment.create');
    Route::post('/Payment/store', [PaymentController::class, 'cashier_store'])->name('cashier_payment.store');
    Route::get('/Payment/{id}/edit', [PaymentController::class, 'edit'])->name('students_payment.edit');
    Route::put('/Payment/{id}', [PaymentController::class, 'update'])->name('students_payment.update');
    Route::delete('/Payment/{id}', [PaymentController::class, 'destroy'])->name('students_payment.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('strand', StrandController::class);
});


Route::middleware(['auth'])->group(function () {
    Route::resource('room', RoomController::class);
});


Route::middleware(['auth'])->group(function () {
    Route::resource('schedule', ScheduleController::class);
});


Route::middleware(['auth'])->group(function () {
    Route::resource('subjects', SubjectController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('sections', SectionController::class);
});


Route::get('/dashboard',[DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/pdf', [DashboardController::class, 'downloadPdf'])->name('dashboard.pdf');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

//public new student and old student can access
Route::get('/public_student/student_register', [PublicStudentRegistrationController::class, 'student_register'])->name('student_register.form');
Route::post('/public_student/store', [PublicStudentRegistrationController::class, 'store'])->name('students_register.store');

//public student payment form
Route::get('/public_payment/create', [PublicPaymentController::class, 'public_create'])->name('students_payment.create');
Route::post('/public_payment/store', [PublicPaymentController::class, 'store'])->name('students_payment.store');

