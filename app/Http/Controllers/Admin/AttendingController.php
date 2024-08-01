<?php

namespace App\Http\Controllers\Admin;

use App\Models\Year;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendance;

class AttendingController extends Controller
{
    public function index(){
        return view('admin.attending.index',[
            'title' => 'Course List',
            'courses' => Course::all(),
            'year' => Year::all(),
        ]);
    }

    public function show(Request $request, $slug)
    {
        // Ambil tahun aktif sebagai default
    $activeYear = Year::where('status', 'active')->firstOrFail();
    $year_id = $request->get('year_id', $activeYear->id);
    $ses_id = $request->get('session_id');

    // Ambil kursus dengan eager loading 'sessions' dan 'year'
    $course = Course::with(['sessions' => function($query) use ($year_id) {
        $query->where('year_id', $year_id);
    }, 'sessions.year']) // Eager load 'year' for sessions
                    ->where('slug', $slug)
                    ->firstOrFail();

        return view('admin.attending.show', [
            'title' => 'Session List',
            'sessions' => $course->sessions,
            'years' => Year::all(),
            'course' => $course,
            'selected_year' => $year_id,
            'attendees' => Attendance::where('session_id', $request->get('session_id'))->get(),
            'selected_session' => $ses_id,
        ]);
    }


}
