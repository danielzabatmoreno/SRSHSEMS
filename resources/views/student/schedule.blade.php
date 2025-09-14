@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Schedule</h1>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Time</th>
                <th>Teacher</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedule as $item)
            <tr>
                <td>{{ $item->subject->name }}</td>
                <td>{{ $item->time }}</td>
                <td>{{ $item->teacher->name }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">No schedule available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
