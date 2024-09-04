<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(){
        return view('instructor.profile.edit',[
            'title' => 'My Profile',
            'user' => Auth::guard('user')->user(),
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);
        $user = Auth::guard('user')->user();
        $instr = $user->instructor;
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->save();

        $instr->name = $request->input('name');
        $instr->phone = $request->input('phone');
        $instr->address = $request->input('address');
        $instr->save();

        return redirect()->back()->with('success','Profile updated successfully');
    }

    public function editPassword(){
        return view('instructor.profile.password',[
            'title' => 'Change Password'
        ]);
    }

    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|same:confirm_password', // menggunakan 'confirmed' untuk memastikan kecocokan dengan confirm_password
            'confirm_password' => 'required',
        ]);

        // Mendapatkan pengguna yang sedang login
        $user = Auth::guard('user')->user();

        // Memeriksa apakah old_password sesuai dengan kata sandi yang tersimpan
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }

        // Memperbarui kata sandi pengguna
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully');
    }
}
