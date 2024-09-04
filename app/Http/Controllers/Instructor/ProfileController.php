<?php

namespace App\Http\Controllers\Instructor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit(){
        return view('instructor.profile.edit',[
            'title' => 'My Profile',
            'user' => Auth::guard('user')->user(),
        ]);
    }

    public function update(Request $request){
        return view('instructor.profile.edit');
    }
}
