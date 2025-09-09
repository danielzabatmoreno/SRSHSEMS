@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome, {{ auth()->user()->name }}</h1>

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5>Enrollment Status</h5>
                    <p>{{ $registration->status ?? 'No submission' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <a href="{{ route('student.subjects') }}" class="btn btn-outline-primary w-100">View Subjects</a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('student.schedule') }}" class="btn btn-outline-success w-100">View Schedule</a>
        </div>
    </div>
</div>
@endsection
