<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController
{
    public function index()
    {
        $nav = 'category';
        $data = Category::paginate(10);
        return view('category.index', compact('data', 'nav'));
    }


    /**
     * Display a listing of the resource.
     */
    public function updateStatus($id)
    {
        try {
            $category = Category::findOrFail(base64_decode($id)); // Retrieve the category

            $category->status = !$category->status; // Toggle status
            $category->save();

            // Generate message based on new status
            $message = $category->status ? 'Category activated successfully!' : 'Category deactivated successfully!';

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
                $data = Category::findOrFail(base64_decode($request->_id));
                $data->update([
                    'name' => $request->name,
                    'status' => $request->status ?? 1,
                ]);

                return redirect()->back()->withInput()->with('success', 'Category updated successfully!');
            } else {
                // Create a new Category
                Category::create([
                    'name' => $request->name,
                    'status' => $request->status ?? 1,
                ]);
                return redirect()->back()->withInput()->with('success', 'Category added successfully!');
            }

            return redirect()->back()->withInput()->with('success', 'Category added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to add Category! Please try again.');
        }
    }

    public function collegeCourses($id){
        if(Session::has('admin')){
            $data['title'] = "College Details";
            $data['nav'] = 'college';
            $data['id'] = $id;
            $data['college_year'] =DB::table('tbl_academic_year')->where("is_active", '1')->orderBy('id', 'desc')->get();
            $data['college_courses'] =DB::table('courses')->where("is_active", '1')->get();
            $data['data'] =DB::table('tbl_academic_course')->where("institution_id", base64_decode($id))->paginate(20);
//             echo '<pre>'; print_r($data); exit;
            return view('admin.college.college-courses', $data);
        }else{
            return redirect('auth/dashboard');
        }
    }

}
