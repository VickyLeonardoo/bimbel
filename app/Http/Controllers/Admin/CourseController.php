<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    //
    public function index(){
        return view('admin.course.index',[
            'title' => 'Course List',
            'courses' => Course::all(),
        ]);
    }

    public function create(){
        return view('admin.course.create',[
            'title' => 'Create Course',
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'session' => 'required',
        ]);
        $image = $request->file('image');
        $hashName = $image->hashName();
        $image->storeAs('public/course', $hashName);
        
        $slug = Str::of($request->name)->slug('-');
        $courseSlug = Course::where('slug', $slug)->first();
        if ($courseSlug) {
            $count = 1;
            while (Course::where('slug', $slug . '_' . $count)->first()) {
                $count++;
            }
            $slug = $slug . '_' . $count;
        }
        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $hashName,
            'slug' => $slug,
            'session' => $request->session,
        ];

        
        Course::create($data);
        return redirect()->route('admin.course')->with('success','Course Created Successfully');
    }

    public function edit($slug){
        return view('admin.course.edit',[
            'title' => 'Edit Course',
            'course' => Course::where('slug',$slug)->first(),
        ]);
    }
    
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'price' => 'required',
            'description' => 'required',
            'session' => 'required',
        ]);
        $course = Course::find($id);

        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'price' => $request->price,
            'description' => $request->description,
            'slug' => Str::of($request->name)->slug('-'),
            'session' => $request->session,
        ];
        if($request->hasFile('image')){
            $image = $request->file('image');
            $hashName = $image->hashName();
            $image->storeAs('public/course', $hashName);
            $data['image'] = $hashName;
        }
        $course->update($data);
        return redirect()->route('admin.course')->with('success','Course Updated Successfully');
    }

    public function delete($id){
        try {
            $course = Course::find($id);
            if ($course) {
                // Attempt to delete the course
                $course->delete();
                // Delete the course image if deletion is successful
                if ($course->image && file_exists(public_path('storage/course/'.$course->image))) {
                    unlink(public_path('storage/course/'.$course->image));
                }
                return redirect()->route('admin.course')->with('success', 'Course Deleted Successfully');
            } else {
                return redirect()->route('admin.course')->with('error', 'Course Not Found');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // Check if the exception is a foreign key constraint violation
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'You cannot delete the course because it is related to another field');
            }
            // Rethrow the exception if it is not a foreign key constraint violation
            throw $e;
        }
    }
}
