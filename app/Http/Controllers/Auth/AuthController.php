<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordResetToken;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
                    return redirect()->route('client.profile')->with('success','Selamat Datang');
                }
            }else if($user->role == '3'){
                if ($user->is_active == '0') {
                    return redirect()->back()->with('message','Akun sudah tidak aktif, silahkan hubungi admin untuk mengaktifkan akun kembali');
                }
                return redirect()->route('instructor.dashboard');
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

    public function show_reset(){
        return view('auth.reset-password');
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            // Buat token baru untuk reset password
            $token = Str::random(64);

            // Hapus token yang sudah ada sebelumnya untuk email ini
            PasswordResetToken::where('email', $user->email)->delete();

            // Simpan token baru ke dalam database
            PasswordResetToken::create([
                'email' => $user->email,
                'token' => Hash::make($token),
                'created_at' => now(),
            ]);

            // Kirim email dengan token reset password
            Mail::to($user->email)->send(new ResetPassword($user, $token));

            return redirect()->back()->with('message', 'Reset password link has been sent to your email');
        } else {
            return redirect()->back()->with('message', 'Email not found');
        }
    }

    public function show_reset_password($token, Request $request){
        // Cari token reset password berdasarkan email dan validasinya
        $passwordReset = PasswordResetToken::where('email', $request->email)->first();
    
        if (!$passwordReset || !Hash::check($token, $passwordReset->token) || !$passwordReset->isTokenValid()) {
            return redirect()->route('login')->with('error', 'Invalid or expired token.');
        }
    
        return view('auth.new-password', ['token' => $token, 'email' => $request->email]);
    }

    public function action_reset_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        // Cari token reset berdasarkan email
        $passwordReset = PasswordResetToken::where('email', $request->email)->first();

        // Validasi token
        if (!$passwordReset || $passwordReset->token !== $request->token || !$passwordReset->isTokenValid()) {
            return redirect()->route('login')->with('error', 'Invalid or expired token.');
        }

        // Update password pengguna
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = bcrypt($request->password);
            $user->save();

            // Hapus token reset setelah password berhasil diperbarui
            PasswordResetToken::where('email', $request->email)->delete();

            return redirect()->route('login')->with('success', 'Password has been reset successfully.');
        }

        return redirect()->route('login')->with('error', 'User not found.');
    }
}
