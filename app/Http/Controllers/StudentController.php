<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentEmergencyContact;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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


    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $schoolId = Auth::id();
            
            // Valider les données de l'étudiant
            $validatedData = $this->validateStudent($request);
            
            // Vérifier la capacité de la salle de classe
            if (!$this->checkClassroomCapacity($request->classroom_id)) {
                return back()->withErrors(['classroom_id' => 'Cette salle de classe est pleine.'])->withInput();
            }
            
            $validatedData['school_id'] = $schoolId;
            $validatedData['photo'] = $this->handlePhotoUpload($request);
            
            // Créer l'étudiant
            $student = Student::create($validatedData);
            
            // Gérer les contacts d'urgence
            $this->createEmergencyContacts($student, $request->emergency_contacts);
            
            return redirect()->route('student-list')->with('success', 'Élève ajouté avec succès.');
        });
    
    }

    public function edit($id)
    {
        $schoolId = Auth::id();
        $student = Student::where('id', $id)->where('school_id', $schoolId)->firstOrFail();
        $classes = ClassModel::where('school_id', $schoolId)->get();
        $academicYears = AcademicYear::all();
        $classrooms = Classroom::where('class_model_id', $student->class_id)->get();
        $emergencyContacts = $student->emergencyContacts;
    
        return view('students.edit', compact('student', 'classes', 'academicYears', 'classrooms', 'emergencyContacts'));
    }
    


    public function update(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $schoolId = Auth::id();
            $student = Student::where('id', $id)->where('school_id', $schoolId)->firstOrFail();
            
            $validatedData = $this->validateStudent($request, $student);
            $validatedData['photo'] = $this->handlePhotoUpload($request, $student);
            
            $student->update($validatedData);
            
            // Mettre à jour les contacts d'urgence
            // Supprimer les anciens contacts
            $student->emergencyContacts()->delete();
            
            // Créer de nouveaux contacts
            $this->createEmergencyContacts($student, $request->emergency_contacts);
            
            return redirect()->route('student-list')->with('success', 'Élève modifié avec succès.');
        });
    }

    private function createEmergencyContacts(Student $student, $contactsData)
    {
        if (empty($contactsData)) {
            return;
        }

        // Types de contacts prédéfinis
        $contactTypes = ['father', 'mother', 'guardian'];

        foreach ($contactsData as $index => $contactData) {
            // Vérifier que les données essentielles sont présentes
            if (!empty($contactData['name']) && !empty($contactData['phone'])) {
                // Déterminer le type de contact
                $type = $contactTypes[$index] ?? 'guardian';

                StudentEmergencyContact::create([
                    'student_id' => $student->id,
                    'name' => $contactData['name'],
                    'country_code' => $contactData['country_code'] ?? '+225', // Code par défaut si non spécifié
                    'phone_number' => $contactData['phone'],
                    'type' => $type
                ]);
            }
        }
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
        // Modification : utiliser input() au lieu de requête JSON
        $classId = $request->input('class_id');
        $schoolId = Auth::id(); // Utilisez Auth::id() comme dans vos autres méthodes
    
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
