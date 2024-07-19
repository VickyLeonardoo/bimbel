<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    //
    public function index(){
        return view('admin.year.index',[
            'years' => Year::all(),
            'title' => 'Years',
        ]);
    }

    public function create(){
        return view('admin.year.create',[
            'title' => 'Years',
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        Year::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return redirect()->route('admin.year')->with('success','Years Registration successfully created.');
    }

    public function edit($id){
        return view('admin.year.edit',[
            'title' => 'Years',
            'year' => Year::find($id),
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        Year::find($id)->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return redirect()->route('admin.year')->with('success','Years Registration successfully updated.');
    }

    public function delete($id){
        Year::find($id)->delete();
        return redirect()->route('admin.year')->with('success','Years Registration successfully deleted.');
    }

    public function updateStatus($id){
        $year = Year::find($id);

        if ($year->status == 'active') {
            $year->update([
                'status' => 'inactive',
            ]);
        }else{
            $year->update([
                'status' => 'active',
            ]);
        }
        return redirect()->route('admin.year')->with('success','Years Registration successfully updated.');
    }
}
