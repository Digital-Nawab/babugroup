<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController
{

    public function index()
    {
        $data = University::paginate(10);
        return view('universities.index', compact('data'));
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


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'status' => 'boolean',
        ]);

//        echo '<pre>'; print_r($request->all());exit;

        try {
            if ($request->has('_id')) {
                // Update existing university
                $university = University::findOrFail(base64_decode($request->_id));
                $university->update([
                    'name' => $request->name,
                    'location' => $request->location,
                    'status' => $request->status ?? 1,
                ]);

                return redirect()->back()->withInput()->with('success', 'University updated successfully!');
            } else {
                // Create a new university
                University::create([
                    'name' => $request->name,
                    'location' => $request->location,
                    'status' => $request->status ?? 1,
                ]);

                return redirect()->back()->withInput()->with('success', 'University added successfully!');
            }

            return redirect()->back()->withInput()->with('success', 'University added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Failed to add university! Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */

}
