<?php

namespace App\Http\Controllers;

use App\CourseInfo;
use App\Courses;
use App\Payment;
use App\Student;
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
    public function index(Courses $course, Payment $payment, Student $student)
    {
        $students = $student->all();
        $courses = $course->loadCourse()->get();
        $payments = $payment->loadPayment()->get()->toArray();
        return view('home', compact('courses', 'payments', 'students'));
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

    public function applicant(Request $request, Student $student)
    {
        $status = $request->option;
        $students = $student->where('id', $status)->update(['status' => $status]);
        return redirect()->back()->with('status', 'application status changed successfully')->withInput();
    }

    public function deleteCourse($id)
    {
        $courses = Courses::where('id', $id)->delete();
        $courseInfo = CourseInfo::where('course_id', $id)->delete();
        return redirect()->back()->with('success', 'Course Deleted Successfully')->withInput();
    }
}
