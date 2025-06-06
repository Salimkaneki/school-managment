<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\AcademicYear;
use App\Models\Teacher;

class CourseController extends Controller
{
    // Afficher la liste des cours de l'école de l'utilisateur connecté
    public function index()
    {
        $courses = Course::where('school_id', Auth::id())
                        ->with(['teacher', 'academicYear'])
                        ->paginate(10);

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $teachers = Teacher::where('school_id', Auth::id())->get();
        $academicYears = AcademicYear::all();
        
        return view('courses.create', compact('teachers', 'academicYears'));
    }

    // Enregistrer un nouveau cours
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            // 'description' => 'nullable|string', // Commenté temporairement
        ]);

        $validated['school_id'] = Auth::id();

        Course::create($validated);

        return redirect()->route('course.list')->with('success', 'Le cours a été créé avec succès.');
    }

    // Afficher le formulaire d'édition d'un cours
    public function edit($id)
    {
        $course = Course::where('school_id', Auth::id())->findOrFail($id);
        $teachers = Teacher::where('school_id', Auth::id())->get();
        $academicYears = AcademicYear::all();

        return view('courses.edit', compact('course', 'teachers', 'academicYears'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::where('school_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            // 'description' => 'nullable|string', // Commenté temporairement
        ]);

        $course->update($validated);

        return redirect()->route('course.list')->with('success', 'Le cours a été modifié avec succès.');
    }

    // Supprimer un cours
    public function destroy($id)
    {
        $course = Course::where('school_id', Auth::id())->findOrFail($id);
        $course->delete();

        return redirect()->route('course.list')->with('success', 'Le cours a été supprimé avec succès.');
    }
}