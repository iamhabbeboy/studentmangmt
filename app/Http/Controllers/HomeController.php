<?php

namespace App\Http\Controllers;

use Abiodun\MailSwifter\MailProvider;
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
        if ($request->course_id) {
            $course->where('id', $request->course_id)
                ->update(['level' => $request->level, 'semester' => $request->semester]);

            $response = $courseInfo->where('course_id', $request->course_id)
                ->update(['title' => $request->title, 'code' => $request->code, 'unit' => $request->unit]);
            return redirect()->back()->with('update_msg', 'Updated successfully')->withInput();
        }
        $level = $request->level;
        $semester = $request->semester;
        $lastId = $course->create(['level' => $level, 'semester' => $semester], $request->all());
        $data = $request->all();
        $data['course_id'] = (int) $lastId->id;

        $response = $courseInfo->firstOrCreate(['title' => $request->title], $data);
        return redirect()->back()->with('msg', 'Successfully added')->withInput();
    }

    /**
     * @param Request $request
     * @param Student $student
     */
    public function applicant(Request $request, Student $student)
    {
        $updateData = [];
        $status = $request->option;
        $matricNo = $this->studentMatricGenerator($student);
        // dd($matricNo);
        if ($status == '1') {
            $sql = $student->find($request->student_id);

            if ($sql->matric_no == '') {
                $split = explode('_', $matricNo);
                $matricChecker = $student->where('matric_no', array_get($split, '0'));

                $updateData = ['status' => $status, 'matric_no' => $split[0], 'matric_no_counter' => array_get($split, '1')];
                $students = $student->where('id', $request->student_id)->update($updateData);
                //Send mail to student
                $studentInfo = $student->find($request->student_id);
                $this->sendMatricNoToMail($studentInfo->toArray());
            }
        } else {
            $updateData = ['status' => $status];
            $students = $student->where('id', $request->student_id)->update($updateData);
        }
        return redirect()->back()->with('status', 'application status changed successfully')->withInput();
    }

    /**
     * @param $student
     */
    private function studentMatricGenerator($student, $addToNumber = 1)
    {
        $format = "SUN17/0103/";
        $totalStudent = $student->max('matric_no_counter') ?? 0;
        $matricNo = $totalStudent;
        $matricNoGenerator = $format . sprintf('%04d', intval($matricNo) + $addToNumber);
        return $matricNoGenerator . '_' . ($matricNo + $addToNumber);
    }

    private function sendMatricNoToMail($studentDetails)
    {
        $mailProvider = new MailProvider([
            'username' => 'swuregandpay@gmail.com',
            'password' => 'Education',
            'smtp' => 'smtp.gmail.com',
        ]);

        $mailProvider->from = ['swuregandpay@gmail.com' => 'Southwestern University'];
        $mailProvider->to = [
            array_get($studentDetails, 'email'),
            array_get($studentDetails, 'email') => 'Student Details',
        ];

        $mailProvider->subject = 'Southwestern University::Student Details';

        $file = public_path() . '/mail.html';
        $dataList = [
            'name' => array_get($studentDetails, 'name'),
            'matric' => array_get($studentDetails, 'matric_no'),
        ];
        $resp = $mailProvider->template($file, $dataList);
        $resp = $mailProvider->send();
    }

    /**
     * @param $id
     */
    public function deleteCourse($id)
    {
        $courses = Courses::where('id', $id)->delete();
        $courseInfo = CourseInfo::where('course_id', $id)->delete();
        return redirect()->back()->with('success', 'Course Deleted Successfully')->withInput();
    }
}
