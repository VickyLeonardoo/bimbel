<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Year;

class SessionController extends Controller
{
    //
    public function index(Request $request, $slug)
{
    // Ambil tahun aktif sebagai default
    $activeYear = Year::where('status', 'active')->firstOrFail();
    $year_id = $request->get('year_id', $activeYear->id);

    // Ambil kursus dengan eager loading 'sessions' dan 'year'
    $course = Course::with(['sessions' => function($query) use ($year_id) {
        $query->where('year_id', $year_id);
    }, 'sessions.year']) // Eager load 'year' for sessions
                    ->where('slug', $slug)
                    ->firstOrFail();

    return view('admin.session.index', [
        'title' => 'Session List',
        'sessions' => $course->sessions,
        'years' => Year::all(),
        'course' => $course,
        'selected_year' => $year_id,
    ]);
}

    public function store($slug){
        $course = Course::where('slug', $slug)->first();
        $totalSession = $course->session;

        $sessionCheck = Session::where('course_id',$course->id)->where('year_id',Year::where('status','active')->first()->id)->first();
        return $sessionCheck;
        if ($sessionCheck) {
            return redirect()->back()->with('error','Session Already Created');
        }

        for ($i=1; $i <= $totalSession ; $i++) { 
            $data = [
                'name' => 'Session ' . $i,
                'course_id' => $course->id,
                'year_id' => Year::where('status','active')->first()->id,
            ];
            Session::create($data);
        }
        return redirect()->back()->with('success','Session Created Successfully');

    }

}
