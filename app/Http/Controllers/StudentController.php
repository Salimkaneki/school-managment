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
        $schoolId = Auth::id();
        $students = Student::where('school_id', $schoolId)
            ->with('classModel', 'academicYear', 'classroom')
            ->orderBy('last_name', 'asc')
            ->paginate(10);
        return view('students.index', compact('students'));
    }

    // Affichage du formulaire d'ajout
    public function create()
    {
        $schoolId = Auth::id();
        $classes = ClassModel::where('school_id', Auth::id())->get();
        $academicYears = AcademicYear::all();
        return view('students.create', compact('classes', 'academicYears'));
    }

    // Enregistrement d'un élève
    public function store(Request $request)
    {
        // Récupérer le school_id de l'utilisateur connecté
        $schoolId = Auth::id();
        
        // Valider les données
        $validatedData = $this->validateStudent($request);
        
        // Vérifier la capacité de la classe
        if (!$this->checkClassroomCapacity($request->classroom_id)) {
            return back()->withErrors(['classroom_id' => 'Cette salle de classe est pleine.'])->withInput();
        }
        
        // Ajouter le school_id aux données validées
        $validatedData['school_id'] = $schoolId;
        
        // Gérer la photo
        $validatedData['photo'] = $this->handlePhotoUpload($request);
        
        // Encoder les contacts d'urgence
        $validatedData['emergency_contacts'] = json_encode($request->emergency_contacts ?? []);
        
        // Créer l'étudiant avec toutes les données validées
        Student::create($validatedData);
        
        return redirect()->route('student-list')->with('success', 'Élève ajouté avec succès.');
    }

    // Mise à jour d'un élève
    public function update(Request $request, $id)
    {
    // Récupérer le school_id de l'utilisateur connecté
        $schoolId = Auth::id();
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
        $schoolId = Auth::id();
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
            'classroom_id' => 'required|exists:classrooms,id', 
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

    public function getClassrooms($classId)
    {
        $classrooms = Classroom::where('class_model_id', $classId)
            ->get()
            ->map(function($classroom) {
                $occupiedSeats = Student::where('classroom_id', $classroom->id)->count();
                $availableSeats = $classroom->capacity - $occupiedSeats;
                
                return [
                    'id' => $classroom->id,
                    'name' => $classroom->name,
                    'capacity' => $classroom->capacity,
                    'available_seats' => $availableSeats
                ];
            });
    
        return response()->json($classrooms);
    }

    public function getStudentsByClass(Request $request)
    {
        $classId = $request->class_id;
        $schoolId = Auth::user()->school_id; 
    
        if (!$classId) {
            return response()->json(['error' => 'Aucune classe sélectionnée.'], 400);
        }
    
        $students = Student::where('class_id', $classId)
                           ->where('school_id', $schoolId) 
                           ->get(['id', 'first_name', 'last_name']);
    
        if ($students->isEmpty()) {
            return response()->json(['message' => 'Aucun élève trouvé pour cette classe.'], 404);
        }
    
        return response()->json($students);
    }
    


}
