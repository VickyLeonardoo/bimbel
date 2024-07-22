<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Year;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('client.transaction.index');
    }

    public function create()
    {
        return view('client.transaction.create',[
            'title' => 'Transaction',
            'course' => Course::all(),
            'years' => Year::where('status', 'active')->get(),
        ]);
    }


}
