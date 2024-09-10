<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\ClassModel;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with(['student', 'classModel'])->get();
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        $students = Student::all();
        $classes = ClassModel::all();
        return view('attendances.create', compact('students', 'classes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'class_id' => 'required|exists:class_models,id',
            'date' => 'required|date',
            'present' => 'required|boolean',
        ]);

        Attendance::create($validatedData);

        return redirect()->route('attendances.index')->with('success', 'Absence enregistrée avec succès.');
    }

    // Autres méthodes selon besoin
}
