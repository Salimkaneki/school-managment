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
use Illuminate\Support\Facades\Log;
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
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
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
                'previous_school_name' => 'nullable|string|max:255',
                // Validation pour les contacts d'urgence
                'emergency_contacts' => 'required|array|min:2',
                'emergency_contacts.*.name' => 'required|string|max:255',
                'emergency_contacts.*.phone' => 'required|string|max:20',
            ]);
            
            // Vérifier la capacité de la salle de classe
            if (!$this->checkClassroomCapacity($request->classroom_id)) {
                return back()->withErrors(['classroom_id' => 'Cette salle de classe est pleine.'])->withInput();
            }
            
            // Préparation des données pour la création de l'étudiant
            // IMPORTANT: Exclure les contacts d'urgence qui seront traités séparément
            $studentData = [
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'phone_number' => $validatedData['phone_number'] ?? null,
                'address' => $validatedData['address'],
                'place_of_birth' => $validatedData['place_of_birth'],
                'class_id' => $validatedData['class_id'],
                'classroom_id' => $validatedData['classroom_id'],
                'academic_year_id' => $validatedData['academic_year_id'],
                'gender' => $validatedData['gender'],
                'nationality' => $validatedData['nationality'],
                'previous_school_name' => $validatedData['previous_school_name'] ?? null,
                'school_id' => $schoolId,
                'photo' => $this->handlePhotoUpload($request)
            ];
            
            // Créer l'étudiant
            $student = Student::create($studentData);
            
            // Gérer les contacts d'urgence avec la nouvelle fonction
            $this->handleEmergencyContacts($student, $request->emergency_contacts);
            
            return redirect()->route('student.list')->with('success', 'Élève ajouté avec succès.');
        });
    }

    public function edit($id)
    {
        $schoolId = Auth::id();
        $student = Student::where('id', $id)
            ->where('school_id', $schoolId)
            ->with('emergencyContacts') // Charger les contacts d'urgence
            ->firstOrFail();

        $classes = ClassModel::where('school_id', $schoolId)->get();
        $academicYears = AcademicYear::all();
        $classrooms = Classroom::where('class_model_id', $student->class_id)->get();
    
        return view('students.edit', compact('student', 'classes', 'academicYears', 'classrooms'));
    }
    
    public function update(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $schoolId = Auth::id();
            $student = Student::where('id', $id)->where('school_id', $schoolId)->firstOrFail();
            
            // Valider les données de l'étudiant
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email,' . $student->id,
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
                'previous_school_name' => 'nullable|string|max:255',
                // Validation pour les contacts d'urgence
                'emergency_contacts' => 'required|array|min:2',
                'emergency_contacts.*.name' => 'required|string|max:255',
                'emergency_contacts.*.phone' => 'required|string|max:20',
            ]);
            
            // Préparation des données pour la mise à jour de l'étudiant
            // IMPORTANT: Exclure les contacts d'urgence
            $studentData = [
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'phone_number' => $validatedData['phone_number'] ?? null,
                'address' => $validatedData['address'],
                'place_of_birth' => $validatedData['place_of_birth'],
                'class_id' => $validatedData['class_id'],
                'classroom_id' => $validatedData['classroom_id'],
                'academic_year_id' => $validatedData['academic_year_id'],
                'gender' => $validatedData['gender'],
                'nationality' => $validatedData['nationality'],
                'previous_school_name' => $validatedData['previous_school_name'] ?? null,
                'photo' => $this->handlePhotoUpload($request, $student)
            ];
            
            $student->update($studentData);
            
            // Utiliser la méthode unifiée pour gérer les contacts d'urgence
            $this->handleEmergencyContacts($student, $request->emergency_contacts);
            
            return redirect()->route('student.list')->with('success', 'Élève modifié avec succès.');
        });
    }

    // Méthode unifiée pour gérer les contacts d'urgence (création et mise à jour)
    private function handleEmergencyContacts(Student $student, $contactsData)
    {
        // Supprimer les anciens contacts
        $student->emergencyContacts()->delete();
    
        if (empty($contactsData)) {
            Log::info('Aucun contact d\'urgence fourni pour l\'étudiant', ['student_id' => $student->id]);
            return;
        }
    
        // Définir les types par défaut dans l'ordre
        $defaultTypes = ['father', 'mother', 'guardian'];
    
        foreach ($contactsData as $index => $contact) {
            $name = $contact['name'] ?? null;
            $phone = $contact['phone'] ?? null;
            $countryCode = $contact['country_code'] ?? '+225';
            $type = $defaultTypes[$index] ?? 'guardian';
    
            if ($name && $phone) {
                try {
                    $emergencyContact = [
                        'student_id' => $student->id,
                        'class_id' => $student->class_id,
                        'name' => $name,
                        'country_code' => $countryCode,
                        'phone_number' => $phone,
                        'type' => $type,
                    ];
    
                    StudentEmergencyContact::create($emergencyContact);
    
                    Log::info("Contact d'urgence enregistré avec succès", $emergencyContact);
                } catch (\Exception $e) {
                    Log::error("Erreur lors de la création d'un contact d'urgence", [
                        'error' => $e->getMessage(),
                        'student_id' => $student->id,
                        'contact' => $contact,
                    ]);
                    throw $e; // Laisser échouer la transaction
                }
            } else {
                Log::warning("Contact d'urgence ignoré à cause de données manquantes", [
                    'index' => $index,
                    'contact' => $contact
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
        
        // Supprimer d'abord les contacts d'urgence pour éviter les violations de clé étrangère
        $student->emergencyContacts()->delete();
        
        // Puis supprimer l'étudiant
        $student->delete();
        
        return redirect()->route('student.list')->with('success', 'Élève supprimé avec succès.');
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
        // Utiliser input() au lieu de requête JSON
        $classId = $request->input('class_id');
        $schoolId = Auth::id();
    
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