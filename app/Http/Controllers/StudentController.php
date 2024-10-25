<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    // Méthode pour afficher le formulaire d'ajout d'élève
    public function create()
    {
        $classes = ClassModel::all(); // Récupération de toutes les classes
        return view('students.create', compact('classes')); // Retourne la vue avec la liste des classes
    }

    // Méthode pour afficher la liste des élèves
    public function index()
    {
        // $students = Student::with('classModel')->get(); // Récupération des élèves avec leur classe
        $students = Student::paginate(10); // 10 élèves par page

        return view('students.index', compact('students')); // Retourne la vue de la liste des élèves
    }

    // Méthode pour enregistrer un élève
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date',
            'phone_number' => 'nullable|string|max:20',
            'class_id' => 'required|exists:class_models,id',
            'previous_school_name' => 'nullable|string|max:255',
            'emergency_contacts.*.name' => 'nullable|string|max:255',
            'emergency_contacts.*.phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'required|in:male,female,other',

        ]);

        // dd($validatedData);

    
        // Vérification de la combinaison prénom, nom et date de naissance
        $existingStudent = Student::where('first_name', $validatedData['first_name'])
            ->where('last_name', $validatedData['last_name'])
            ->where('date_of_birth', $validatedData['date_of_birth'])
            ->first();
    
        if ($existingStudent) {
            // Si un élève avec le même prénom, nom et date de naissance existe déjà
            return redirect()->back()->withErrors(['duplicate' => 'Un élève avec ce nom et cette date de naissance existe déjà.']);
        }
    
        // Traitement de la photo d'élève s'il y a une photo téléchargée
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students_photos', 'public'); // Stocker la photo
            $validatedData['photo'] = $photoPath;
        }
    
        // Traitement des contacts d'urgence
        $validatedData['emergency_contacts'] = json_encode($request->emergency_contacts); // Sérialise les contacts
    
        // Enregistrement de l'élève dans la base de données
        Student::create($validatedData);
    
        // Redirection après succès avec un message
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

    // Méthode pour générer un PDF des élèves d'une classe
    public function downloadByClass($classId)
    {
        $students = Student::where('class_id', $classId)->get();
        $pdf = Pdf::loadView('students.pdf', compact('students'));
        return $pdf->download('students_class_' . $classId . '.pdf');
    }
}
