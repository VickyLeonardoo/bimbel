<?php

namespace App\Http\Controllers\Client;

use App\Models\Course;
use App\Models\VisiMisi;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function index(){
        return view('client.home.home',[
            'visi' => VisiMisi::all(),
        ]);
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
