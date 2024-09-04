<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('instructor.dashboard',[
            'title' => 'Dashboard',
            'courses' => Course::count(),
            'instructor' => Instructor::where('is_active',true)->count(),
            'order' => Order::where('status','confirmed')->count(),
        ]);
    }
}
