<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\StudentApprovedMail;
use App\Models\{Student, Year, College, Course, Registration};
//use App\Models\Year;
//use App\Models\College;
//use App\Models\Course;
//use App\Models\Registration;


class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registration = Registration::where(['status' => 'new', 'payment_status' => 'completed'])->orderBy('id', 'desc')->paginate(20);
        $college =  College::get();
        $course =  Course::get();
        $semester =  Course::get();
        $year =  Year::where(['is_current'=>'1','status'=>'1'])->first();
//       dd($year);
        return view('registration.index', compact('registration', 'college', 'course', 'semester', 'year'));
    }

    public function ApprovedRegistration(){
        $reg_approved = Registration::where(['status' => 'approved', 'payment_status' => 'completed'])->orderBy('id', 'desc')->paginate(20);
        return view('registration.approve', compact('reg_approved'));
    }
    public function RejectedRegistration(){
        $reg_rejected = Registration::where('status', 'rejected')->orderBy('id', 'desc')->paginate(20);
        return view('registration.rejected', compact('reg_rejected'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Approve($id)
    {
        $registration = Registration::find($id);

        if (!$registration) {
            return response()->json(['success' => false, 'message' => 'Registration not found.'], 404);
        }

        if ($registration->status === 'approved') {
            return response()->json(['success' => false, 'message' => 'Registration already approved.']);
        }
        $studentRegisterId = 'SR-' . strtoupper(uniqid());
        $universityEnrolmentNo = 'UN-' . strtoupper(uniqid());

        $randomPassword = Str::random(8);
        // Create a new student record
        $student = Student::create([
            'admission_form_no' => $registration->id,
            'student_register_id' => $studentRegisterId,
            'university_enrolment_no' => $universityEnrolmentNo,
            'institution_id' => $registration->institute_id,
            'course_id'      => $registration->course_id,
            'student_name'   => $registration->name,
            'gender'         => $registration->gender,
            'email'          => $registration->email,
            'mobile_num'     => $registration->mobile,
            'dob'            => $registration->dob,
            'father_name'    => $registration->father_name,
            'mother_name'    => $registration->mother_name,
            'amount'         => $registration->amount,
            'password'       => Hash::make($randomPassword),
            'salt_password'  => $randomPassword,
            'added_by'       => "admin",
        ]);

        if ($student) {
            // Update registration status
            $registration->update(['status' => 'approved']);

            Mail::to($student->email)->send(new StudentApprovedMail($student, $randomPassword));

            return response()->json(['success' => true, 'message' => 'Student approved successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to create student.']);
        }
    }

    public function Reject($id){
        $registration = Registration::find($id);
        if (!$registration) {
            return response()->json(['success' => false, 'message' => 'Registration not found.'], 404);
        }
        // Update status to "rejected"
        $registration->update(['status' => 'rejected']);
        return response()->json(['success' => true, 'message' => 'Registration rejected successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function AdminnewRegistration(Request $request)
    {
        $postData = $request->all();

        // Validate input data
        $validated = $request->validate([
            'college_id'  => 'required|exists:colleges,id',
            'course_id'     => 'required|exists:courses,id',
            'student_name'  => 'required|string|max:255',
            'gender'        => 'required|in:male,female,other',
            'email'         => 'required|email|max:255|unique:registrations,email',
            'mobile_num'    => 'required|digits_between:10,15|unique:registrations,mobile_num',
            'dob'           => 'required|date',
            'father_name'   => 'required|string|max:255',
            'mother_name'   => 'required|string|max:255',
            'amount'        => 'required|numeric|min:0',
            'payment_mode'  => 'required|string|in:cash,upi,gateway,cheque,',
            'academic_year' => 'required|string|max:10',
        ]);

        // Check Course & Category in One Query (Optimize DB Calls)
        $course = Course::where('id', $validated['course_id'])->where('status', '1')->first(['id']);
        $categoryId = College::where('id', $validated['college_id'])->where('status', '1')->value('category_id');

        if (!$course || !$categoryId) {
            return response()->json(['status' => false, 'message' => 'Invalid course or category not found'], 404);
        }

        // Unique Student Registration IDs
        $studentRegisterId = 'SR-' . Str::uuid()->toString();
        $universityEnrolmentNo = 'UN-' . Str::uuid()->toString();
        $randomPassword = Str::random(8);

        // Insert Student Data using Transaction for Safety
        DB::beginTransaction();
        try {
            $student = Registration::create([
                'college_id'        => $validated['college_id'],
                'course_id'      => $validated['course_id'],
                'category_id'    => $categoryId,
                'student_name'   => $validated['student_name'],
                'gender'         => $validated['gender'],
                'email'          => $validated['email'],
                'mobile_num'     => $validated['mobile_num'],
                'dob'            => $validated['dob'],
                'father_name'    => $validated['father_name'],
                'mother_name'    => $validated['mother_name'],
                'amount'         => $validated['amount'],
                'payment_mode'   => $validated['payment_mode'],
                'academic_year'  => $validated['academic_year'],
                'payment_status' => 'completed',
                'add_by'         => 'admin',
                'status'         => 'approved',
            ]);

            // Send Email in Background (Avoid Delays)
            Mail::to($student->email)->queue(new StudentApprovedMail($student, $randomPassword));

            DB::commit();
            return redirect()->back()->with(['success' => true, 'message' => 'Student approved successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => 'Error processing registration', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */

}
