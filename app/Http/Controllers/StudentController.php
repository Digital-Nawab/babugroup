<?php

namespace App\Http\Controllers;

use App\Models\College;
use App\Models\Course;
use App\Models\Student;
use App\Models\Year;
use Illuminate\Http\Request;

class StudentController
{
    /**
     * Display a listing of the resource.
     */

        public function index()
    {
        $student = Student::where(['status' => 'new',])->orderBy('id', 'desc')->paginate(50);
        return view('student.index', compact('student', ));

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $college =  College::get();
        $course =  Course::get();
        $semester =  Course::get();
        $year = Year::firstWhere(['is_current' => 1, 'status' => 1]);
        return view('student.create', compact('college','course','semester','year'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
