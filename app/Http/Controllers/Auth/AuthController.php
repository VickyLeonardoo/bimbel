<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

// Suggested code may be subject to a license. Learn more: ~LicenseLog:3474481024.
    public function prosesLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        $kredensil = $request->only('email','password');
        if (Auth::guard('user')->attempt($kredensil)) {
            $user = Auth::guard('user')->user();
            if ($user->role == '1') {
                return redirect()->route('admin.dashboard')->with('message','Selamat Datang, Admin');
                // return redirect()->route('admin.home')->withToastSuccess('Kamu Berhasil Masuk!')->with('message','Berhasil');
            }else if($user->role == '2'){
                if ($user->is_active == '0') {
                    return redirect()->route('otp.show');
                }else{
                    return redirect()->route('client.profile')->with('message','Selamat Datang, Ingin Mengorder Laundry Hari ini?');
                }
            }
        }
        return redirect()->back()->with('message','Login Gagal, Email atau Password Kamu Salah!');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/login')->with('success','Berhasil Logout');
    }

}
