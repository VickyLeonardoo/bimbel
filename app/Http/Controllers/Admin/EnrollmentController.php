<?php

namespace App\Http\Controllers\Admin;

use App\Models\Year;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InstructorCourse;

class EnrollmentController extends Controller
{
    //
    public function index(){
        return view('admin.enrollment.index',[
            'title' => 'Enrollment List',
            'courses' => Course::all(),
            // 'enrollments' => Enrollment::all(),
            'year' => Year::all(),
        ]);
    }

    public function store(Request $request){
        // Validasi data jika diperlukan
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'course_id' => 'required|exists:courses,id',
            'year_id' => 'required|exists:years,id',
            'name' => 'required|string',
            'status' => 'required|in:approved,rejected',
        ]);

        Enrollment::create($validatedData);

        return redirect()->back()->with('success', 'Enrollment created successfully!');
    }

    public function show($course_id){
        $year_id = request('year_id');
        $query = Enrollment::where('course_id', $course_id);

        if ($year_id) {
            $query->where('year_id', $year_id);
        }

        $enrollments = $query->get();
        $enrollment_count = $enrollments->where('status', 'approved')->count();
        return view('admin.enrollment.show', [ 
            'title' => 'Enrollment Detail',
            'course' => Course::find($course_id), 
            'years' => Year::all(),
            'enrollments' => $enrollments,
            'enrollment_count' => $enrollment_count,
        ]);
    }


    public function updateStatus($id){
        $enrollment = Enrollment::findOrFail($id);
        if ($enrollment->status == 'approved') {
            $enrollment->status = 'rejected';
            // Set is_active to false for related attendances
            $enrollment->attendances()->update(['is_active' => false]);

            
        } else {
            $enrollment->status = 'approved';
            $enrollment->attendances()->update(['is_active' => true]);
        }
        $enrollment->save();
        return redirect()->back()->with('success', 'Enrollment updated successfully!');
    }

    public function delete_attendance(){

    }
}
