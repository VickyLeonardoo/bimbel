<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit(){
        $user = auth()->user();
        return view('admin.profile.edit',[
            'title' => 'My Profile',
            'user' => $user
        ]);
    }

    public function editPassword(){
        return view('admin.profile.password',[
            'title' => 'Change Password'
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);
        $user = auth()->user();
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->save();

        return redirect()->back()->with('success','Profile updated successfully');
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
        $user = auth()->user();

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