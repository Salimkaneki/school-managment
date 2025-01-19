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
        // Récupérer toutes les absences avec les relations
        $attendances = Attendance::with(['student', 'class'])->get();
        
        // Récupérer les classes et étudiants pour le modal d'édition
        $classes = ClassModel::all();
        $students = Student::all();
        
        // Passer toutes les variables à la vue
        return view('attendances.index', compact('attendances', 'classes', 'students'));
    }

    // Afficher le formulaire pour marquer les présences
    public function create()
    {
        $classes = ClassModel::all(); 
        $students = Student::all();


        return view('attendances.create', compact('classes','students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:class_models,id',
            'student_id' => 'required|exists:students,id',
            'start_time' => 'required|array',
            'end_time' => 'required|array',
        ]);

        // Créer un tableau des heures d'absence
        $absenceTimes = [];
        foreach ($request->start_time as $key => $startTime) {
            if ($startTime && $request->end_time[$key]) {
                $absenceTimes[] = [
                    'start' => $startTime,
                    'end' => $request->end_time[$key]
                ];
            }
        }

        // Enregistrer l'absence
        Attendance::create([
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            'date' => now(),
            'present' => false,
            'absence_times' => $absenceTimes
        ]);

        return redirect()->route('attendances.index')
            ->with('success', 'Absence enregistrée avec succès.');
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'class_id' => 'required|exists:class_models,id',
            'student_id' => 'required|exists:students,id',
            'start_time' => 'required|array',
            'end_time' => 'required|array',
        ]);

        $absenceTimes = [];
        foreach ($request->start_time as $key => $startTime) {
            if ($startTime && $request->end_time[$key]) {
                $absenceTimes[] = [
                    'start' => $startTime,
                    'end' => $request->end_time[$key]
                ];
            }
        }

        $attendance->update([
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            'absence_times' => $absenceTimes
        ]);

        return redirect()->route('attendances.index')
            ->with('success', 'Absence modifiée avec succès');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')
            ->with('success', 'Absence supprimée avec succès');
    }

    public function getAbsenceData(Attendance $attendance)
    {
        return response()->json([
            'attendance' => $attendance->load('student', 'class')
        ]);
    }
}

