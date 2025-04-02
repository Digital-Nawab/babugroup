<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController
{
    public function index()
    {
        $nav = 'course';
        $data = Course::get();
        $category = Category::get();
        return view('courses.index', compact('data', 'nav','category'));
    }


    /**
     * Display a listing of the resource.
     */
    public function updateStatus($id)
    {
        try {
            $category = Course::findOrFail(base64_decode($id)); // Retrieve the category

            $category->status = !$category->status; // Toggle status
            $category->save();

            // Generate message based on new status
            $message = $category->status ? 'Course activated successfully!' : 'Course deactivated successfully!';

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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
//        echo '<pre>'; print_r($request->all());exit;

        try {
            if ($request->has('_id')) {
                // Update existing Category
                $data = Course::findOrFail(base64_decode($request->_id));
                $data->update([
                    'name' => $request->name,
                    'semesters' => $request->semesters,
                    'category_id' => $request->category_id,
                    'status' => $request->status ?? 1,
                ]);

                return redirect()->back()->withInput()->with('success', 'Course updated successfully!');
            } else {
                // Create a new Category
                Course::create([
                    'name' => $request->name,
                    'semesters' => $request->semesters,
                    'category_id' => $request->category_id,
                    'status' => $request->status ?? 1,
                ]);
                return redirect()->back()->withInput()->with('success', 'Course added successfully!');
            }

            return redirect()->back()->withInput()->with('success', 'Course added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to add Course! Please try again.');
        }
    }
}
