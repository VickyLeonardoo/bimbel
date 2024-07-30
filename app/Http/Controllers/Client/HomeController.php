<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        return view('client.home.home');
    }

    public function programme(){
        return view('client.home.programme',[
            'courses' => Course::all(),
        ]);
    }

    public function instructor(){
        return view('client.home.instructor',[
            'instructors' => Instructor::all(),
        ]);
    }


}
