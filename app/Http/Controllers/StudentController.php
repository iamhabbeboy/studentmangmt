<?php

namespace App\Http\Controllers;

use App\CourseRegistered;
use App\Courses;
use App\Payment;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class StudentController extends Controller
{
    /**
     * @var mixed
     */
    protected $student;
    /**
     * @param Student $student
     */
    public function __construct(Student $student, Payment $payment)
    {
        $this->student = $student;
        $this->payment = $payment;
    }

    public function index()
    {
        $students = $this->student->all();
        return response()->json($students);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
    }

    /**
     * @param Request $request
     */
    public function update(Request $request)
    {
    }

    /**
     * @param $request_id
     */
    public function delete($request_id)
    {
    }
    public function login()
    {
        return view('student.login');
    }

    /**
     * @param Request $request
     */
    public function auth(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $sql = $this->student->where('email', $request->email);
        if ($sql->count() > 0) {
            return redirect()->back()->with('message', 'Student Already Exist')
                ->withInput();
        }
        $directory = $this->studentPicture($request);
        $data['photo'] = $directory;

        $sql = $this->student->create($data);
        session(['student_data' => $data]);
        return redirect()->back()->with('msg', 'your application has been submitted successfully, check back for approval')->withInput();
    }

    /**
     * @param $request
     */
    private function studentPicture($request)
    {
        $image = $request->file('photo');
        $destinationPath = public_path('/picture');
        $imagename = time() . '.' . str_replace(' ', '-', $image->getClientOriginalName());
        $image->move($destinationPath, $imagename);
        $fullpath = '/picture/' . $imagename;
        return $fullpath;
    }

    /**
     * @param CourseRegistered $courseRegistered
     */
    public function dashboard(CourseRegistered $courseRegistered, Student $student)
    {
        $user = session::has('student_data') ? array_get(session('student_data'), 'email') : null;
        $sql = $this->payment->where('student_id', $user);
        $student_info = ['data' => ''];
        if ($sql->count() > 0) {
            $student_info['data'] = true;
        }
        $payments = $sql->get()->toArray();
        $courses = $courseRegistered->loadCourse()->get()->toArray();

        $studentInfo = $student->where('email', $user)->first();

        return view('student.dashboard', compact('student_info', 'courses', 'payments', 'studentInfo'));
    }

    /**
     * @param Request $request
     */
    public function payment(Request $request)
    {
        // dd($request);
        $student_id = $request->student_id;
        $amount = $request->amount;
        $ref = $request->ref;
        $sql = $this->payment->create(['student_id' => $student_id, 'ref' => $ref, 'amount' => $amount]);
        return response()->json(['status' => true]);
    }

    public function course()
    {
        return view('courses');
    }

    /**
     * @param Request $request
     */
    public function loginAuth(Request $request)
    {
        $sql = $this->student->where('email', $request->email);
        if ($sql->count() > 0) {
            $first = $sql->first();
            $password_check = Hash::check($request->password, $first->password);
            if ($password_check) {
                session(['student_data' => $first]);
                if ($first->status != 1) {
                    return redirect()->back()->with('status', 'Application not yet approved')->withInput();
                }
                return redirect('/account/dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid information supplied')->withInput();
            }
        } else {
            return redirect()->back()->with('error', 'Invalid information supplied')->withInput();
        }
    }

    public function logout()
    {
        if (session::has('student_data')) {
            session::flush('student_data');
        }
        return redirect('/account/login');
    }

    /**
     * @param Request $request
     * @param Courses $course
     */
    public function fetchCourse(Request $request, Courses $course)
    {
        $sql = $course->loadCourse($request);
        // dd($sql->get()->toArray());
        if ($sql->count() > 0) {
            return redirect()->back()
                ->with('data', $sql->get()->toArray())
                ->withInput();
        }
        return redirect()->back()->with('data', ['has_course_info' => []])->withInput();
    }

    /**
     * @param Request $request
     */
    public function registerCourse(Request $request, CourseRegistered $courseRegistered)
    {
        $student_id = array_get(session('student_data'), 'email');
        // dd($request->course);
        foreach ($request->course as $course) {
            $data = explode('_', $course);
            $code = array_get($data, '0');
            $cid = array_get($data, '1');
            $year = array_get($data, '2');
            $semester = array_get($data, '3');

            $store = [
                'student_id' => $student_id,
                'course_id' => $cid,
                'level' => $year,
                'semester' => $semester,
            ];

            $courseRegistered->firstOrcreate(['student_id' => $student_id, 'course_id' => $cid], $store);
        }
        return redirect()->back()->with('msg', 'successfully registered')->withInput();
    }

    /**
     * @param Request $request
     * @param CourseRegistered $cregistered
     */
    public function retrieveRegistered(Request $request, CourseRegistered $cregistered)
    {
        $level = $request->level;
        $semester = $request->semester;
        $student_id = array_get(session('student_data'), 'email');

        $query = $cregistered->loadCourse($student_id, $semester, $level)->get();
        return redirect()->back()
            ->with(['couresesData' => $query->toArray(), 'semester' => $semester, 'level' => $level])->withInput();
    }
}
