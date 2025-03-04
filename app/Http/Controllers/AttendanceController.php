<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    // Afficher la liste des présences d'une école spécifique
    public function index(Request $request)
    {
        $schoolId = Auth::id(); // Récupère l'ID de l'école

        $attendances = Attendance::whereHas('student', function ($query) use ($schoolId) {
            $query->where('school_id', $schoolId);
        })->with(['student', 'class'])->get();

        $classes = ClassModel::where('school_id', $schoolId)->get();
        $students = Student::where('school_id', $schoolId)->get();

        return view('attendances.index', compact('attendances', 'classes', 'students'));
    }

    // Afficher le formulaire de création d'une absence
    public function create()
    {
        $schoolId = Auth::id();

        $classes = ClassModel::where('school_id', $schoolId)->get();
        $students = Student::where('school_id', $schoolId)->get();

        return view('attendances.create', compact('classes', 'students'));
    }

    // Enregistrer une nouvelle absence
    public function store(Request $request)
    {
        $schoolId = Auth::id();

        $request->validate([
            'class_id' => 'required|exists:class_models,id',
            'student_id' => 'required|exists:students,id',
            'start_time' => 'required|array',
            'end_time' => 'required|array',
        ]);

        // Vérifier que l'étudiant appartient bien à l'école
        $student = Student::where('id', $request->student_id)
                          ->where('school_id', $schoolId)
                          ->firstOrFail();

        $absenceTimes = [];
        foreach ($request->start_time as $key => $startTime) {
            if ($startTime && $request->end_time[$key]) {
                $absenceTimes[] = [
                    'start' => $startTime,
                    'end' => $request->end_time[$key]
                ];
            }
        }

        Attendance::create([
            'student_id' => $request->student_id,
            'class_id' => $request->class_id, 
            'school_id'=> $schoolId,
            'date' => now(),
            'present' => false,
            'absence_times' => $absenceTimes
        ]);

        return redirect()->route('attendances.index')
            ->with('success', 'Absence enregistrée avec succès.');
    }

    // Modifier une absence
    public function update(Request $request, Attendance $attendance)
    {
        $schoolId = Auth::id();

        // Vérifier que l'absence appartient bien à un étudiant de cette école
        if ($attendance->student->school_id !== $schoolId) {
            abort(403, 'Accès non autorisé.');
        }

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
            ->with('success', 'Absence modifiée avec succès.');
    }

    // Supprimer une absence
    public function destroy(Attendance $attendance)
    {
        $schoolId = Auth::id();

        if ($attendance->student->school_id !== $schoolId) {
            abort(403, 'Accès non autorisé.');
        }

        $attendance->delete();
        return redirect()->route('attendances.index')
            ->with('success', 'Absence supprimée avec succès.');
    }

    // Obtenir les données d'une absence en JSON
    public function getAbsenceData(Attendance $attendance)
    {
        $schoolId = Auth::id();

        if ($attendance->student->school_id !== $schoolId) {
            return response()->json(['error' => 'Accès interdit'], 403);
        }

        return response()->json([
            'attendance' => $attendance->load('student', 'class')
        ]);
    }
}
