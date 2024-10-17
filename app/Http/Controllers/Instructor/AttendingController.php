<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendingController extends Controller
{
    public function index(){
        return view('instructor.attending.index',[
            'title' => 'Attending List',
            'courses' => Course::all(),
            'year' => Year::all(),
        ]);
    }

    public function show(Request $request, $slug) {
        $classes = [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12
        ];
        // Ambil tahun aktif
        $activeYear = Year::where('status', 'active')->firstOrFail();
        $year_id = $request->get('year_id', $activeYear->id);
        $ses_id = $request->get('session_id');
        $class = $request->get('class');

        // Ambil kursus dengan eager loading 'sessions' dan 'year'
        $course = Course::with(['sessions' => function($query) use ($year_id) {
            $query->where('year_id', $year_id);
        }, 'sessions.year']) // Eager load 'year' for sessions
                        ->where('slug', $slug)
                        ->firstOrFail();

        return view('instructor.attending.show', [
            'title' => 'Attendee List',
            'sessions' => $course->sessions,
            'years' => Year::all(),
            'course' => $course,
            'selected_year' => $year_id,
            'attendees' => Attendance::where('session_id', $request->get('session_id'))->where('year_id', $year_id)->where('class', $class)->with('child')->get(),
            'selected_session' => $ses_id,
            'classes' => $classes,
            'selected_class' => $class,
        ]);
    }

    public function updateStatus(Request $request){
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

    public function showReport(Request $request, $slug) {
        $classes = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        
        // Ambil tahun aktif
        $activeYear = Year::where('status', 'active')->firstOrFail();
        $year_id = $request->get('year_id', $activeYear->id);
        $class = $request->get('class');
    
        // Ambil kursus dengan eager loading 'sessions' dan 'year'
        $course = Course::with(['sessions' => function($query) use ($year_id) {
            $query->where('year_id', $year_id);
        }, 'sessions.year'])
        ->where('slug', $slug)
        ->firstOrFail();
        
        $findChild = Enrollment::where('class', $class)
            ->where('year_id', $year_id)
            ->where('course_id', $course->id)
            ->with('child')
            ->get();
    
        // Ambil kehadiran dan susun dalam bentuk yang lebih mudah diakses
        $attendances = Attendance::where('year_id', $year_id)
            ->where('class', $class)
            ->get()
            ->groupBy('child_id')
            ->map(function($group) {
                return $group->keyBy('session_id');
            });
    
        return view('instructor.attending.report', [
            'title' => 'Attendee List',
            'sessions' => $course->sessions,
            'years' => Year::all(),
            'course' => $course,
            'selected_year' => $year_id,
            'attendances' => $attendances,
            'classes' => $classes,
            'selected_class' => $class,
            'childs' => $findChild,
        ]);
    }
}
