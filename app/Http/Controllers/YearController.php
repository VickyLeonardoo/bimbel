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

        $findDateRange = Year::where('start_date','<',$request->end_date)->where('end_date','>', $request->start_date)->first();
        if ($findDateRange) {
            return redirect()->back()->with('error','You cant set 2 years at the same time.');
        }

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

        $findDateRange = Year::where('id', '!=', $id)
                        ->where('start_date', '<', $request->end_date)
                        ->where('end_date', '>', $request->start_date)
                        ->first();
        if ($findDateRange) {
            return redirect()->back()->with('error','You cant set 2 years at the same time.');
        }

        Year::find($id)->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return redirect()->route('admin.year')->with('success','Years Registration successfully updated.');
    }

    public function delete($id){
        try {
            $year = Year::find($id);
            if ($year) {
                // Attempt to delete the year
                $year->delete();
                return redirect()->route('admin.year')->with('success', 'Year registration successfully deleted.');
            } else {
                return redirect()->route('admin.year')->with('error', 'Year not found.');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // Check if the exception is a foreign key constraint violation
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'You cannot delete the year because it is related to another field.');
            }
            // Rethrow the exception if it is not a foreign key constraint violation
            throw $e;
        }
    }

    public function updateStatus($id){
        $year = Year::find($id);

        if ($year->status == 'active') {
            $year->update([
                'status' => 'inactive',
            ]);
        }else{
            $findActive = Year::where('status','active')->first();
            if ($findActive) {
                return redirect()->back()->with('error','You cant set Active on 2 years at the same time.');
            }else{
                $year->update([
                    'status' => 'active',
                ]);
            }
        }
        return redirect()->route('admin.year')->with('success','Years Registration successfully updated.');
    }

    public function updatePublished($id){
        $year = Year::find($id);
        if ($year->is_published == true) {
            $year->update([
                'is_published' => false,
            ]);
        }else{
            $year->update([
                'is_published' => true,
            ]);
        }
        return redirect()->route('admin.year')->with('success','Years Registration successfully updated.');

    }
}
