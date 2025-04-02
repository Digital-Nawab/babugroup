<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;

class YearController
{
    public function index()
    {
        return Year::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_current' => 'boolean',
            'status' => 'boolean'
        ]);

        return Year::create($request->all());
    }

    public function show(Year $year)
    {
        return $year;
    }

    public function update(Request $request, Year $year)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'is_current' => 'boolean',
            'status' => 'boolean'
        ]);

        if ($request->has('is_current') && $request->is_current) {
            Year::setCurrentYear($year->id);
        }

        $year->update($request->all());

        return $year;
    }

    public function destroy(Year $year)
    {
        $year->delete();

        return response()->json(['message' => 'Year deleted successfully']);
    }

    public function setCurrent(Request $request, $id)
    {
        Year::setCurrentYear($id);
        return response()->json(['message' => 'Current year updated successfully']);
    }
}
