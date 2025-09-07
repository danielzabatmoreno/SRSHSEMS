<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Room;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a paginated list of schedules with optional search.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $schedules = Schedule::with(['room', 'teacher', 'subject', 'section'])
            ->when($search, function ($query, $search) {
                $query->where('ScheduleID', 'like', "%{$search}%")
                      ->orWhereHas('subject', function ($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->orderBy('Day')
            ->paginate(5)
            ->withQueryString();

        return view('schedule.schedule_list', compact('schedules'));
    }

    /**
     * Show the form for creating a new schedule.
     */
    public function create()
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $sections = Section::all();
        $rooms = Room::all();

        return view('schedule.create', compact('subjects', 'teachers', 'sections', 'rooms'));
    }

    /**
     * Store a newly created schedule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'SubjectID' => 'required|exists:subjects,SubjectID',
            'TeacherID' => 'required|exists:teachers,TeacherID',
            'SectionID' => 'required|exists:sections,SectionID',
            'RoomID' => 'required|exists:rooms,RoomID',
            'Day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday',
            'Start_Time' => 'required|date_format:H:i',
            'End_Time' => 'required|date_format:H:i|after:Start_Time',
        ]);

        Schedule::create($validated);

        return redirect()->route('schedule.index')
                         ->with('success', 'Schedule created successfully');
    }

    /**
     * Show the form for editing an existing schedule.
     */
    public function edit(Schedule $schedule)
    {
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $sections = Section::all();
        $rooms = Room::all();

        return view('schedule.edit', compact('schedule', 'subjects', 'teachers', 'sections', 'rooms'));
    }

    /**
     * Update an existing schedule.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'SubjectID' => 'required|exists:subjects,SubjectID',
            'TeacherID' => 'required|exists:teachers,TeacherID',
            'SectionID' => 'required|exists:sections,SectionID',
            'RoomID' => 'required|exists:rooms,RoomID',
            'Day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday',
            'Start_Time' => 'required|date_format:H:i',
            'End_Time' => 'required|date_format:H:i|after:Start_Time',
        ]);

        $schedule->update($validated);

        return redirect()->route('schedule.index')
                         ->with('success', 'Schedule updated successfully');
    }

    /**
     * Delete a schedule.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedule.index')
                         ->with('success', 'Schedule deleted successfully');
    }
}
