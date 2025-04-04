<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    public function index()
    {
        $title = "Add University"; 
        $data = University::paginate(10);
        return view('admin.tools.university', compact('title','data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:universities,name',
            'location' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }
        $university = University::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'University added successfully!', 
            'university' => $university
        ], 200);
    }

    public function getUniversity(){
        $data = University::latest()->get();
        return response()->json($data);
    }

    public function updateUniversityStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);
        $university = University::findOrFail($id);
        $university->status = $request->status;
        $university->save();

        return response()->json([
            'success' => true,
            'message' => 'University status updated successfully'
        ]);
    }

    public function updateUniversity(Request $request, $id)
    {
        $university = University::find($id);
        if (!$university) {
            return response()->json([
                'status' => false,
                'error' => 'University not found!'
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:universities,name,' . $id,
            'location' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $university->update([
            'name' => $request->name,
            'location' => $request->location,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'University updated successfully!'
        ], 200);
    }


    /**
     * Display a listing of the resource.
     */
    public function updateStatus($id)
    {
        try {
            $category = University::findOrFail(base64_decode($id)); // Retrieve the category

            $category->status = !$category->status; // Toggle status
            $category->save();

            // Generate message based on new status
            $message = $category->status ? 'University activated successfully!' : 'University deactivated successfully!';

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update status!');
        }
    }

}
