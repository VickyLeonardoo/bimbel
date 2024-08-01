<?php

namespace App\Http\Controllers\Admin;

use App\Models\Year;
use App\Models\Course;
use App\Models\Attendance;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
            'attendees' => Attendance::where('session_id', $request->get('session_id'))->with('child')->get(),
            'selected_session' => $ses_id,
        ]);
    }

    public function updateStatus(Request $request)
{
    $ids = $request->input('ids');
    $status = $request->input('status');
    $reason = $request->input('reason', ''); // Default to empty string if not provided

    DB::table('attendances')
        ->whereIn('id', $ids)
        ->update([
            'status' => $status,
            'reason' => $status === 'permission' ? $reason : null // Only update reason if status is 'permission'
        ]);

    return response()->json(['success' => true]);
}


}
