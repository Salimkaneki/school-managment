<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    public function create()
    {
        $classes = ClassModel::all();
        return view('students.create', compact('classes'));
    }

    public function index()
    {
        $students = Student::with('classModel')->get();
        return view('students.index', compact('students'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'required|string|in:male,female,other',
            'date_of_birth' => 'required|date',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'relationship_to_emergency_contact' => 'nullable|string|max:255',
            'previous_school' => 'nullable|string|max:255',
            'previous_school_address' => 'nullable|string|max:255',
            'class_id' => 'required|exists:class_models,id',
        ]);

        Student::create($validatedData);

        return redirect()->route('student-list')->with('success', 'Élève ajouté avec succès.');
    }

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
    
    public function showStudentsByClass()
    {
        $classes = ClassModel::all();
        return view('students.by_class', compact('classes'));
    }

    public function downloadByClass($classId)
    {
        $students = Student::where('class_id', $classId)->get();
        $pdf = Pdf::loadView('students.pdf', compact('students'));
        return $pdf->download('students_class_' . $classId . '.pdf');
    }
}
