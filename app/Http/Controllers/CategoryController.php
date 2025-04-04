<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $nav = 'category';
        $title = "Add Category";
        $data = Category::paginate(10);
        return view('admin.tools.category', compact('title','data', 'nav'));
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:universities,name',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'University added successfully!', 
            'category' => $category
        ], 200);
    }

    public function getCategory(){
        $data = Category::latest()->get();
        return response()->json($data);
    }


    public function updateCategoryStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);
        $category = Category::findOrFail($id);
        $category->status = $request->status;
        $category->save();

        return response()->json([
            'success' => true,
            'message' => 'Category status updated successfully'
        ]);
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'error' => 'category not found!'
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully!'
        ], 200);
    }
}
