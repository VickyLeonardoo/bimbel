<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard',[
            'title' => 'Dashboard',
            'courses' => Course::count(),
            'instructor' => Instructor::where('is_active',true)->count(),
            'order' => Order::where('status','confirmed')->count(),
        ]);
    }
}
