<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EducationDetail;
use App\Models\InstructorCourse;
use App\Http\Controllers\Controller;

class InstructorController extends Controller
{
    public function index(){
        return view('admin.instructor.index',[
            'title' => 'Instructor List',
            'instructors' => Instructor::all(),
        ]);
    }

    public function create(){
        return view('admin.instructor.create',[
            'title' => 'Create Instructor',
            'courses' => Course::all(),
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:instructors',
        'phone' => 'required',
        'address' => 'required',
        'gender' => 'required',
        'level.*' => 'required', // Add validation for dynamic fields
        'degree.*' => 'required',
        'university.*' => 'required',
        'course_instructor.*' => 'required'
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'gender' => $request->gender,
        'slug' => Str::slug($request->name)
    ];

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $hashName = $image->hashName();
        $image->storeAs('public/instructor', $hashName);
        $data['image'] = $hashName;
    }

    $instructor = Instructor::create($data);

    // Save Education Details
    if ($request->filled('level')) {
        foreach ($request->level as $key => $level) {
            EducationDetail::create([
                'instructor_id' => $instructor->id,
                'level' => $level,
                'degree' => $request->degree[$key],
                'university' => $request->university[$key]
            ]);
        }
    }

    // Save Instructor Courses
    if ($request->filled('course_instructor')) {
        foreach ($request->course_instructor as $course_id) {
            InstructorCourse::create([
                'instructor_id' => $instructor->id,
                'course_id' => $course_id
            ]);
        }
    }

    return redirect()->route('admin.instructor')->with('success', 'Instructor successfully created');
}

    public function edit($slug){
        $instructor = Instructor::where('slug', $slug)->first();
        $instructor = Instructor::with('courses')->findOrFail($instructor->id);
        $assignedCourseIds = $instructor->courses->pluck('id')->toArray();
        $courses = Course::whereNotIn('id', $assignedCourseIds)->get();
        return view('admin.instructor.edit',[
            'title' => 'Edit Instructor',
            'instructor' => $instructor,
            'courses' => $courses,
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:instructors,email,'.$id,
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'slug' => Str::slug($request->name)
        ];

        if($request->hasFile('image')){
            $image = $request->file('image');
            $hashName = $image->hashName();
            $image->storeAs('public/instructor', $hashName);
            $data['image'] = $hashName;
        }

        Instructor::where('id', $id)->update($data);
        return redirect()->route('admin.instructor')->with('success', 'Instructor successfully updated');
    }

    public function delete($id){
        if(Instructor::where('id', $id)->first()->image){
            unlink(storage_path('app/public/instructor/'.Instructor::where('id', $id)->first()->image));
        }
        Instructor::where('id', $id)->delete();
        return redirect()->route('admin.instructor')->with('success', 'Instructor successfully deleted');
    }

    public function editAddEducation($id, Request $request){
        $instructor = Instructor::find($id);
        $request->validate([
            'level' => 'required',
            'degree' => 'required',
            'university' => 'required',
        ]);

        $data = [
            'instructor_id' => $id,
            'level' => $request->level,
            'degree' => $request->degree,
            'university' => $request->university,
        ];

        EducationDetail::create($data);
        return redirect()->route('admin.instructor.edit', $instructor->slug)->with('success', 'Add Education Detail successfully updated');
    }

    public function deleteEducation($id){
        EducationDetail::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Education successfully deleted');
    }

    public function editAddCourse($id, Request $request){
        $instructor = Instructor::find($id);
        $data = [
            'instructor_id' => $id,
            'course_id' => $request->course_id
        ];

        InstructorCourse::create($data);
        return redirect()->route('admin.instructor.edit', $instructor->slug)->with('success', 'Add Course successfully updated');
    }

    public function deleteCourse($id){
        InstructorCourse::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Course successfully deleted');
    }
    
}
