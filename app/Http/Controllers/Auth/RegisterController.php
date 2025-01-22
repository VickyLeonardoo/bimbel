<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use App\Models\UserVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            'name.required' => 'Nama wajib ',
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
            'role' => '2',
        ];
        $time = Carbon::now();
        $otp = rand(100000,999999);
        $user = User::create($data);
        UserVerification::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'validTime' =>$time
        ]);
        Mail::to($user->email)->send(new OtpMail($data,$otp));

        $kredensil = array(
            'email' => $request->email,
            'password' => $request->password,
        );

        if (Auth::guard('user')->attempt($kredensil)) {
            $user = Auth::guard('user')->user();
            if ($user->role == '2') {
                if ($user->is_active == true) {
                    return redirect()->route('page.verif')->with('success','Kamu behrasil Mendaftar, silahkan Periksa Email Kamu untuk Verifikasi OTP  ');
                }else{
                    return 'pelanggan';
                }
            }
        }
    }

    public function verifPage(){
        return view('auth.verif');
    }

    public function verifyOtp(Request $request){
        // date_default_timezone_set('Asia/Jakarta');
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|string|max:1'
        ]);
        $combinedNumber = implode('', $request->input('otp'));
        
        $userId = Auth::guard('user')->user()->id;
        $otp = UserVerification::where('user_id',$userId)->where('otp',$combinedNumber)->first();
        if (!$otp) {
            return redirect()->back()->with('message', 'Kode OTP tidak sesuai.');
        }else{
            $validTime = $otp->validTime;
            $currentTime = now();
            $timeDifference = $currentTime->diffInMinutes($validTime);
            if ($timeDifference > 5) {
                return redirect()->back()->with('message', 'Kode OTP sudah tidak berlaku. Silakan kirim ulang OTP.');
            }else{
                $user = User::where('id',$userId)->update([
                    'is_verified' => '1',
                ]);
                $otp->delete();
                return redirect()->route('client.home')->with('success','Kamu berhasil Verifikasi');
            }
        }
    }

    public function resend(){
        date_default_timezone_set('Asia/Jakarta');
        $time = Carbon::now();
        $addTime = $time->addMinutes(5);
        $userId = Auth::guard('user')->user()->id;
        $email = User::where('id',$userId)->first();
        $otp = UserVerification::where('user_id',$userId)->first();
        $otpNumber = rand(100000,999999);
        if (!$otp){
            UserVerification::create([
                'user_id' => $userId,
                'otp' => $otpNumber,
                'validTime' => $addTime,
            ]);
            Mail::to($email)->send(new OtpMail($email,$otp['otp']));
            return response()->json(['success' => true]);
        }else{
            $otp->update([
                'otp' => $otpNumber,
                'validTime' => $addTime,
            ]);
            Mail::to($email)->send(new OtpMail($email,$otp['otp']));
            return response()->json(['success' => true]);

        }
    }

}
