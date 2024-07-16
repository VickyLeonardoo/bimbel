<?php

namespace App\Http\Controllers\Admin;

use App\Models\Instructor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:instructors',
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
        Instructor::create($data);
        return redirect()->route('admin.instructor')->with('success', 'Instructor successfully created');
    }

    public function edit($slug){
        $instructor = Instructor::where('slug', $slug)->first();
        return view('admin.instructor.edit',[
            'title' => 'Edit Instructor',
            'instructor' => $instructor
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
    
}
