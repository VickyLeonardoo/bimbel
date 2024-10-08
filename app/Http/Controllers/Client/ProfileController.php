<?php

namespace App\Http\Controllers\Client;

use App\Models\Child;
use App\Rules\ClassRange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('client.profile.profile');
    }

    public function editProfile()
    {
        return view('client.profile.editProfile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $user = auth()->user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->with('success', 'Berhasil Update Profile');
    }

    public function addChildren()
    {
        return view('client.child.create');
    }

    public function storeChildren(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name.*' => 'required|string|max:255',
            'school.*' => 'required|string|max:255',
            'bod.*' => 'required|date',
            'class.*' => ['required', 'string', 'max:255', new ClassRange],
        ]);
    
        // Iterate over the input arrays and create Child records
        foreach ($request->name as $index => $name) {
            $child = new Child();
            $child->user_id = auth()->user()->id;
            $child->name = $name;
            $child->school = $request->school[$index];
            $child->bod = $request->bod[$index];
            $child->class = $request->class[$index];
            $child->save();
        }
    
        // Redirect or return a response
        return redirect()->route('client.profile')->with('success', 'Children added successfully.');
    }
    public function editChildren($id)
    {
        return view('client.child.edit',[
            'child' => Child::find($id)
        ]);
    }
    public function updateChildren(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'school' => 'required',
            'bod' => 'required',
            'class' => 'required',
        ]);

        $child = Child::find($id);
        $child->name = request('name');
        $child->school = request('school');
        $child->bod = request('bod');
        $child->class = request('class');
        $child->save();

        return redirect()->route('client.profile')->with('success', 'Children updated successfully.');
    }

    public function deleteChildren($id)
    {
        $child = Child::find($id);
        $child->delete();
        return redirect()->route('client.profile')->with('success', 'Children deleted successfully.');
    }
}
