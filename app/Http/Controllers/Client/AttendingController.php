<?php

namespace App\Http\Controllers\Client;

use App\Models\Year;
use App\Models\Course;
use App\Models\Attendance;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendingController extends Controller
{
    public function index(Request $request){
        
            
        $user = Auth::user()->load('child');
        $children = $user->child;
        $years = Year::all();
        $courses = Course::all();

        return view('client.attending.index',[
            'childs' => $children,
            'years' => $years,
            'courses' => $courses
        ]);
    }

    public function show(Request $request){
        $request->validate([
            'child_id' => 'required',
            'year_id' => 'required',
            'course_id' => 'required'
        ]);

        $year_id = $request->year_id;
        $course_id = $request->course_id;
    
        // Ambil kursus dengan eager loading 'sessions' dan 'year'
        $course = Course::with(['sessions' => function($query) use ($year_id) {
            $query->where('year_id', $year_id);
        }, 'sessions.year'])
        ->where('id', $course_id)
        ->firstOrFail();

        $findChild = Enrollment::where('year_id', $year_id)
            ->where('course_id', $course->id)
            ->where('child_id', $request->child_id)
            ->with('child')
            ->get();

        // Ambil kehadiran dan susun dalam bentuk yang lebih mudah diakses
        $attendances = Attendance::where('year_id', $year_id)
            ->where('child_id',$request->child_id)
            ->get()
            ->groupBy('child_id')
            ->map(function($group) {
                return $group->keyBy('session_id');
            });

            $presentCount = 0;
            $absentCount = 0;
            $lateCount = 0;
            $permissionCount = 0;
            $notStartedCount = 0;
            
            // Mengiterasi attendance berdasarkan session_id
            foreach ($attendances as $childId => $sessions) {
                foreach ($sessions as $attendance) {
                    switch ($attendance->status) {
                        case 'present':
                            $presentCount++;
                            break;
                        case 'absent':
                            $absentCount++;
                            break;
                        case 'late':
                            $lateCount++;
                            break;
                        case 'permission':
                            $permissionCount++;
                            break;
                        default: 
                            $notStartedCount++; // Untuk kasus status null atau belum dimulai
                    }
                }
            }

        return view('client.attending.show', [
            'sessions' => $course->sessions,
            'years' => Year::all(),
            'course' => $course,
            'selected_year' => $year_id,
            'attendances' => $attendances,
            'childs' => $findChild,
            'presentCount' => $presentCount,
            'absentCount' => $absentCount,
            'lateCount' => $lateCount,
            'permissionCount' => $permissionCount,
            'notStartedCount' => $notStartedCount
        ]); 


    }
}
