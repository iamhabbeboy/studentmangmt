<?php

namespace App\Http\Controllers;

use App\CourseInfo;
use App\Courses;
use App\Payment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Courses $course, Payment $payment)
    {
        $courses = $course->loadCourse()->get()->toArray();
        $payments = $payment->loadPayment()->get()->toArray();
        return view('home', compact('courses', 'payments'));
    }

    /**
     * @param Request $request
     * @param Course $course
     * @param CourseInfo $courseInfo
     */
    public function store(Request $request, Courses $course, CourseInfo $courseInfo)
    {
        $level = $request->level;
        $semester = $request->semester;
        $lastId = $course->create(['level' => $level, 'semester' => $semester], $request->all());
        $data = $request->all();
        $data['course_id'] = (int) $lastId->id;
        // dd($data);
        $response = $courseInfo->firstOrCreate(['title' => $request->title], $data);
        return redirect()->back()->with('msg', 'Successfully added')->withInput();
    }
}
