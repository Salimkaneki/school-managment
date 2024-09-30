<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassModel;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Afficher la liste des présences
    public function index(Request $request)
    {
        // Votre logique ici pour afficher la liste des présences
        $attendances = Attendance::all();
        
        return view('attendances.index', compact('attendances'));
    }

    // Afficher le formulaire pour marquer les présences
    public function create()
    {
        $classes = ClassModel::all(); 
        $students = Student::all();


        return view('attendances.create', compact('classes','students'));
    }

    // Enregistrer les présences
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:class_models,id',
            'student_id' => 'required|exists:students,id',
            'hours' => 'required|string',
        ]);

        // Enregistrer l'absence
        Attendance::create([
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            'date' => now(), // Enregistrer la date du jour
            'present' => false, // Absence notée par défaut
            'hours' => $request->hours // Enregistrer les heures d'absence
        ]);

        return redirect()->route('attendances.create')
            ->with('success', 'Absence enregistrée avec succès.');
    }
}

