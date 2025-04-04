<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\College;
use App\Models\Course;
use App\Models\University;
use App\Models\User;
use App\Models\Year;
use App\Models\CollegeCourses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CollegeController extends Controller
{
    public function index()
    {
        $nav = 'college';
        $college_list = College::get();
        $category = Category::get();
        return view('college.index', compact('nav', 'category', 'college_list'));
    }

    public function create()
    {
        $nav = 'college';
        $university = University::get();
        $category = Category::get();
        return view('college.create', compact('nav', 'category', 'university'));
    }

    /**
     * Display a listing of the resource.
     */
    public function updateStatus($id)
    {
        try {
            $college = College::findOrFail(base64_decode($id));
            $college->status = !$college->status;
            $college->save();

            $message = $college->status ? 'College activated successfully!' : 'College deactivated successfully!';
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update status!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $session = Session::get('admin');
//        echo '<pre>'; print_r($session);exit;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->_id,
            'password' => 'required|min:6|confirmed', 
            'college_name' => 'required|string|max:255',
            'slug_url' => 'required|string|max:255|unique:colleges,slug_url,' . $request->_id,
            'category_id' => 'required|integer|exists:categories,id',
            'university_id' => 'required|integer|exists:universities,id',
            'college_code' => 'required|string|max:50|unique:colleges,college_code,' . $request->_id,
            'college_email' => 'required|email|max:255|unique:colleges,college_email,' . $request->_id,
            'college_contact' => 'required|digits_between:10,15|unique:colleges,college_contact,' . $request->_id,
            'gstn' => 'nullable|string|max:15|unique:colleges,gstn,' . $request->_id,
            'description' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:500', 
            '_id' => 'nullable|string', 
            'status' => 'nullable|boolean'
        ]);

        try {
            return DB::transaction(function () use ($request, $validated) {
            $imageData = [];
            if($request->hasFile('logo')) {
                $manager = new ImageManager(new Driver());
                $path = 'assets/images/college/';
                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }
                $uploadedImage = $request->file('logo');
                $image = $manager->read($uploadedImage);
                $image->resize(100, 100);
                $image->encode(new WebpEncoder(quality: 65));
                $filename = uniqid() . '.' .'webp';
                $image->save($path.$filename);
                $imageData['logo'] = $path.$filename;
            }

            $collegeData = [
                'university_id' => $validated['university_id'],
                'category_id' => $validated['category_id'],
                'college_name' => $validated['college_name'],
                'college_code' => $validated['college_code'],
                'slug_url' => $validated['slug_url'],
                'description' => $validated['description'],
                'college_email' => $validated['college_email'],
                'college_contact' => $validated['college_contact'],
                'gstn' => $validated['gstn'],
                'address' => $validated['address'],
                'status' => $validated['status'] ?? 1,
            ];

            if ($request->has('_id')) {
                $college = College::findOrFail(base64_decode($request->_id));
                $college->update(array_merge($collegeData, $imageData));
                $message = 'College updated successfully!';
            } else {
                $college = College::create(array_merge($collegeData, $imageData));
                $this->createUser($validated, $college->id);
                $message = 'College added successfully!';
            }
            return redirect()->back()->with('success', $message);
        });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to ' . ($request->has('_id') ? 'update' : 'add') . ' College! ' . $e->getMessage());
        }
    }

    private function createUser(array $validated, int $collegeId): User
    {
        return User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'contact' => $validated['college_contact'],
            'college_id' => $collegeId,
            'role_id' => 1,
            'added_by'=>Session::get('admin')->name,
            'added_id'=>Session::get('admin')->id,
            'password' => Hash::make($validated['password']),
            'status' => $validated['status'] ?? 1,
        ]);
    }

    public function collegeCourses($id)
    {
        if (!Session::has('admin')) {
            return redirect()->route('auth.dashboard');
        }
        $collegeId = base64_decode($id);
        // Use Eloquent with proper validation and eager loading for performance
        $college = College::findOrFail($collegeId);

        // Get courses related to the college's category
        $collegeCourses = Course::where('category_id', $college->category_id)->get();

        // Get current academic year with proper indexing
        $collegeYear = Year::where('is_current', 1)->where('status', 1)->first();

        return view('admin.college.college-courses', [
            'title' => 'College Details',
            'nav' => 'college',
            'id' => $id,
            'college' => $college,
            'college_courses' => $collegeCourses,
            'college_year' => $collegeYear
        ]);
    }

    public function addCollegeCourses(Request $request)
    {
        if (!Session::has('admin')) {
            return redirect()->route('auth.dashboard');
        }

        $admin = Session::get('admin');
        echo '<pre>'; print_r($request->all()); exit;
        try {
            // Validate request data
            $validatedData = $request->validate([
                'college_id' => 'required|exists:colleges,id',
                'year_id' => 'required|exists:years,id',
                'semesters' => 'required|array',
                'semesters.*' => 'required|array',
                'semesters.*.*' => 'required|numeric|min:0',
            ]);

            $collegeId = base64_decode($validatedData['college_id']);
            $yearId = $validatedData['year_id'];

            // Bulk insert or update for efficiency
            $dataToInsert = [];
            foreach ($validatedData['semesters'] as $courseId => $semesterFees) {
                if (!DB::table('courses')->where('id', $courseId)->exists()) {
                    continue;
                }

                foreach ($semesterFees as $semesterNumber => $fee) {
                    $dataToInsert[] = [
                        'college_id' => $collegeId,
                        'course_id' => $courseId,
                        'year_id' => $yearId,
                        'semesters' => $semesterNumber,
                        'fee' => $fee,
                        'added_by' => $admin->role_title,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            if (!empty($dataToInsert)) {
                CollegeCourses::upsert($dataToInsert, ['college_id', 'course_id', 'year_id', 'semesters'], ['fee', 'updated_at']);
            }

            return redirect()->back()->with(['success' => true, 'message' => 'Courses added successfully.']);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'An unexpected error occurred. Please try again.'])->withInput();
        }
    }

}
