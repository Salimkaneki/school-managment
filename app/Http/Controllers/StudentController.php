<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // Liste des élèves d'une école spécifique
    public function index()
    {
        $schoolId = Auth::guard('web')->user()->school_id;
        $students = Student::where('school_id', $schoolId)
            ->with('classModel', 'academicYear', 'classroom')
            ->orderBy('last_name', 'asc')
            ->paginate(10);
        return view('students.index', compact('students'));
    }

    // Affichage du formulaire d'ajout
    public function create()
    {
        $schoolId = Auth::guard('web')->user()->school_id;
        $classes = ClassModel::where('school_id', $schoolId)->get();
        $academicYears = AcademicYear::all();
        return view('students.create', compact('classes', 'academicYears'));
    }

    // Enregistrement d'un élève
    public function store(Request $request)
    {
        $schoolId = Auth::guard('web')->user()->school_id;
        
        $validatedData = $this->validateStudent($request);
        
        // Vérification de la capacité de la classe
        if (!$this->checkClassroomCapacity($request->classroom_id)) {
            return back()->withErrors(['classroom_id' => 'Cette salle de classe est pleine.'])->withInput();
        }
        
        $validatedData['photo'] = $this->handlePhotoUpload($request);
        $validatedData['emergency_contacts'] = json_encode($request->emergency_contacts ?? []);
        $validatedData['school_id'] = $schoolId;
        
        Student::create($validatedData);
        return redirect()->route('student-list')->with('success', 'Élève ajouté avec succès.');
    }

    // Mise à jour d'un élève
    public function update(Request $request, $id)
    {
        $schoolId = Auth::guard('web')->user()->school_id;
        $student = Student::where('id', $id)->where('school_id', $schoolId)->firstOrFail();
        
        $validatedData = $this->validateStudent($request, $student);
        $validatedData['photo'] = $this->handlePhotoUpload($request, $student);
        $validatedData['emergency_contacts'] = json_encode($request->emergency_contacts ?? []);
        
        $student->update($validatedData);
        return redirect()->route('student-list')->with('success', 'Élève modifié avec succès.');
    }

    // Suppression d'un élève
    public function destroy($id)
    {
        $schoolId = Auth::guard('web')->user()->school_id;
        $student = Student::where('id', $id)->where('school_id', $schoolId)->firstOrFail();
        
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }
        
        $student->delete();
        return redirect()->route('student-list')->with('success', 'Élève supprimé avec succès.');
    }

    // Validation des données étudiant
    private function validateStudent(Request $request, $student = null)
    {
        return $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . ($student->id ?? ''),
            'date_of_birth' => 'required|date',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'class_id' => 'required|exists:class_models,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'gender' => 'required|in:male,female,other',
            'nationality' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }

    // Vérifier la capacité de la salle de classe
    private function checkClassroomCapacity($classroomId)
    {
        $classroom = Classroom::find($classroomId);
        return $classroom && Student::where('classroom_id', $classroomId)->count() < $classroom->capacity;
    }

    // Gestion de l'upload de la photo
    private function handlePhotoUpload(Request $request, $student = null)
    {
        if ($request->hasFile('photo')) {
            if ($student && $student->photo) {
                Storage::disk('public')->delete($student->photo);
            }
            return $request->file('photo')->store('students_photos', 'public');
        }
        return $student->photo ?? null;
    }
}
