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
        ]);
        $course = Course::find($id);

        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'price' => $request->price,
            'description' => $request->description,
            'slug' => Str::of($request->name)->slug('-'),
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
        $course = Course::find($id);
        $course->delete();
        unlink(public_path('storage/course/'.$course->image));
        return redirect()->route('admin.course')->with('success','Course Deleted Successfully');
    }
}