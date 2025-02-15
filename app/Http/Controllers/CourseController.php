<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Show the form to create a new course
    public function create()
    {
        $teachers = Teacher::all();
        return view('courses.create', compact('teachers'));
    }

    // Store the new course in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $course = Course::create($validated);

        return redirect()->route('course-list')->with('success', 'Le cours a été créé avec succès.');
    }

    public function edit($id)
{
    $course = Course::findOrFail($id);
    $teachers = Teacher::all();
    return view('courses.edit', compact('course', 'teachers'));
}

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'description' => 'nullable|string'
        ]);

        $course = Course::findOrFail($id);
        $course->update($validated);

        return redirect()->route('course-list')->with('success', 'Le cours a été modifié avec succès.');
    }


    public function index()
    {
        $courses = Course::with('teacher')->paginate(10);
        
        return view('courses.index', compact('courses'));
    }

        public function destroy($id)
        {
            $course = Course::findOrFail($id);
            $course->delete();
    
            return redirect()->route('course-list')->with('success', 'Le cours a été supprimé avec succès.');
        }
}
