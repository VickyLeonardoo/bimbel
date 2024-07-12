<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserVerification;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
            'phone' => 'required|string|max:255'
        ],[
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password_confirmation.required' => 'Konfirmasi Password wajib diisi',
            'password_confirmation.same' => 'Konfirmasi Password harus sama dengan Password',
            'phone.required' => 'Nomor HP wajib diisi'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'role' => '1',
            'is_active' => '1',
            'is_verified' => '1',
        ];
        $time = Carbon::now();
        $otp = rand(100000,999999);
        $user = User::create($data);
        UserVerification::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'validTime' =>$time
        ]);
        $kredensil = array(
            'email' => $request->email,
            'password' => $request->password,
        );
        if (Auth::guard('user')->attempt($kredensil)) {
            $user = Auth::guard('user')->user();
            if ($user->role == '1') {
                if ($user->is_active == '0') {
                    return redirect()->route('otp.show');
                }else{
                    return 'pelanggan';
                }
            }
        }
        return redirect('/home')->with('message','Kamu behrasil Mendaftar, silahkan Periksa Email Kamu untuk Verifikasi OTP  ');
    }

}
