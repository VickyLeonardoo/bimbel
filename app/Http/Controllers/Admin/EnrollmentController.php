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
        return view('admin.enrollment.show',[
            'title' => 'Enrollment Detail',
            'course' => Course::find($course_id),
            'years' => Year::all(),
            'enrollments' => Enrollment::where('course_id', $course_id)->get(),
            'participant' => Enrollment::where('course_id', $course_id)->where('status', 'approved')->count(),
            // 'instructor' => InstructorCourse::where('course_id', $course_id)->get(),
        ]);
    }

    public function updateStatus($id){
        $enrollment = Enrollment::findOrFail($id);
        if ($enrollment->status == 'approved') {
            $enrollment->status = 'rejected';
        } else {
            $enrollment->status = 'approved';
        }
        $enrollment->save();
        return redirect()->back()->with('success', 'Enrollment updated successfully!');
    }
}
