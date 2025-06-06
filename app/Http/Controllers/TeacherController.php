<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Teacher;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::where('school_id', Auth::id())
            ->with('academicYear')
            ->orderBy('last_name', 'asc')
            ->paginate(10);

        return view('teachers.index', ['teachers' => $teachers,
            'academicYears' => AcademicYear::all()
        ]);
    }

    public function create()
    {
        $academicYears = AcademicYear::all(); // Assurez-vous d'importer le modèle AcademicYear

        return view('teachers.create', compact('academicYears'));
    }

    public function store(Request $request)
    {
       $validatedData = $request->validate([
           'first_name' => 'required|string|max:255',
           'last_name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:teachers',
           'phone_number' => 'nullable|string|max:20',
           'gender' => 'required|in:male,female,other',
           'nationality' => 'nullable|string|max:255',
           'seniority' => 'nullable|integer',
           'subject' => 'required|string|max:255',
           'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
           'birthday' => 'required|date',
           'marital_status' => 'required|in:single,married,divorced,widowed',
           'address' => 'required|string|max:255',
            'academic_year_id' => 'required|exists:academic_years,id',

       ]);
    
       $validatedData['school_id'] = Auth::id();
    
       if ($request->hasFile('photo')) {
           $photoPath = $request->file('photo')->store('teachers', 'public');
           $validatedData['photo'] = $photoPath;
       }
    
       Teacher::create($validatedData);
       
       return redirect()->route('teacher.index')
           ->with('success', 'Enseignant ajouté avec succès.');
    }

    public function show(Teacher $teacher)
    {
        if ($teacher->school_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }
        return view('teachers.show', compact('teacher'));
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $academicYears = AcademicYear::all();

        return view('teachers.edit', compact('teacher', 'academicYears'));
    }
    
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        
        if ($teacher->school_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }
    
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:teachers,email,'.$id,
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female,other',
            'nationality' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'seniority' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'birthday' => 'required|date',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'address' => 'required|string|max:255',
            'academic_year_id' => 'required|exists:academic_years,id',

        ]);
    
        $validated['school_id'] = Auth::id();
    
        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                Storage::delete($teacher->photo);
            }
            
            $path = $request->file('photo')->store('teachers', 'public');
            $validated['photo'] = $path;
        }
    
        $teacher->update($validated);
    
        return redirect()->route('teacher.index')
            ->with('success', 'Les informations du professeur ont été mises à jour avec succès.');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
            Storage::disk('public')->delete($teacher->photo);
        }

        $teacher->delete();
        
        return redirect()->route('teacher.index')
            ->with('success', 'Enseignant supprimé avec succès.');
    }
}
