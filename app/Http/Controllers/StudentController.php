<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    // Méthode pour afficher le formulaire d'ajout d'élève
    public function create()
    {
        $classes = ClassModel::all(); // Récupération de toutes les classes
        $academicYears = AcademicYear::all(); // Récupération de toutes les années académiques
        return view('students.create', compact('classes', 'academicYears')); // Retourne la vue avec la liste des classes et des années académiques
    }

    // Méthode pour afficher la liste des élèves
    public function index()
    {
        $students = Student::with('classModel', 'academicYear', 'classroom')->orderBy('last_name', 'asc')->paginate(10);
        return view('students.index', compact('students')); // Retourne la vue de la liste des élèves
    }

    // Méthode pour enregistrer un élève
    public function store(Request $request)
    {
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
            'previous_school_name' => 'nullable|string|max:255',
            'emergency_contacts.*.name' => 'nullable|string|max:255',
            'emergency_contacts.*.phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'required|in:male,female,other',
            'nationality' => 'required|string|max:100',
            'father_email' => 'nullable|email|max:255', 
            'mother_email' => 'nullable|email|max:255',
        ]);
    
        // Vérifier la capacité de la salle
        $classroom = Classroom::find($request->classroom_id);
        $currentStudentsCount = Student::where('classroom_id', $request->classroom_id)->count();
    
        if ($currentStudentsCount >= $classroom->capacity) {
            return back()->withErrors(['classroom_id' => 'Cette salle de classe est déjà pleine.'])->withInput();
        }
    
        // Traitement de la photo
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students_photos', 'public');
            $validatedData['photo'] = $photoPath;
        }
    
        // Traitement des contacts d'urgence
        if ($request->has('emergency_contacts')) {
            $validatedData['emergency_contacts'] = json_encode($request->emergency_contacts);
        } else {
            $validatedData['emergency_contacts'] = json_encode([]);
        }
    
        // Création de l'étudiant avec toutes les données validées
        Student::create($validatedData);
    
        return redirect()->route('student-list')->with('success', 'Élève ajouté avec succès.');
    }

    // Méthode pour afficher les élèves d'une classe spécifique
    public function getStudentsByClass(Request $request)
    {
        $classId = $request->input('class_id');

        if (!$classId) {
            return response()->json(['error' => 'ID de la classe manquant'], 400);
        }

        $students = Student::where('class_id', $classId)->get();

        if ($students->isEmpty()) {
            return response()->json(['error' => 'Aucun élève trouvé'], 404);
        }

        return response()->json($students);
    }

    // Méthode pour afficher la vue de la liste des classes pour filtrer par classe
    public function showStudentsByClass()
    {
        $classes = ClassModel::all();
        return view('students.by_class', compact('classes'));
    }

    // Méthode pour afficher les élèves d'une année académique spécifique
    public function getStudentsByAcademicYear($academicYearId)
    {
        $students = Student::where('academic_year_id', $academicYearId)->get();
        return response()->json($students);
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classes = ClassModel::all();
        $academicYears = AcademicYear::all();
        return view('students.edit', compact('student', 'classes', 'academicYears'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'date_of_birth' => 'required|date',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'class_id' => 'required|exists:class_models,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'previous_school_name' => 'nullable|string|max:255',
            'emergency_contacts.*.name' => 'nullable|string|max:255',
            'emergency_contacts.*.phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'required|in:male,female,other',
            'nationality' => 'required|string|max:100',
        ]);

        // Traitement de la photo d'élève s'il y a une photo téléchargée
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students_photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        // Traitement des contacts d'urgence
        $validatedData['emergency_contacts'] = json_encode($request->emergency_contacts);

        $student->update($validatedData);

        return redirect()->route('student-list')->with('success', 'Élève modifié avec succès.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('student-list')->with('success', 'Élève supprimé avec succès.');
    }

    public function getClassrooms($classId)
    {
        $classrooms = Classroom::where('class_model_id', $classId)
            ->select('id', 'name', 'capacity')
            ->withCount(['students as current_students'])
            ->get()
            ->map(function ($classroom) {
                $classroom->available_seats = $classroom->capacity - $classroom->current_students;
                return $classroom;
            });
    
        return response()->json($classrooms);
    }
}
