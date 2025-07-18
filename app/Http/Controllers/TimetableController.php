<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Classroom;
use App\Models\Timetable;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\TimeSlot;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimetableController extends Controller
{
    // Voir la liste des emplois du temps
// In your TimetablesController
public function index()
{
    $timetables = Timetable::with(['class', 'classroom', 'academicYear'])
        ->when(request('academic_year_id'), function($query) {
            $query->where('academic_year_id', request('academic_year_id'));
        })
        ->paginate(10);
    
    $academicYears = AcademicYear::all();
    
    return view('timetables.index', compact('timetables', 'academicYears'));
}

    // Afficher le formulaire pour créer un emploi du temps
    public function create()
    {
        $classes = ClassModel::where('school_id', Auth::id())->get();
        $classrooms = Classroom::where('school_id', Auth::id())->get();
        $academicYears = AcademicYear::where('school_id', Auth::id())->get();
        
        return view('timetables.create', compact('classes', 'classrooms', 'academicYears'));
    }

    // Stocker un nouvel emploi du temps
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:class_models,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        // Vérifier que l'année académique appartient à l'école connectée
        $academicYear = AcademicYear::where('id', $request->academic_year_id)
                                   ->where('school_id', Auth::id())
                                   ->first();
                                   
        if (!$academicYear) {
            return redirect()->back()->withErrors(['academic_year_id' => 'Année académique invalide.']);
        }

        // Vérifier que la classe appartient à l'école connectée
        $class = ClassModel::where('id', $request->class_id)
                          ->where('school_id', Auth::id())
                          ->first();
                          
        if (!$class) {
            return redirect()->back()->withErrors(['class_id' => 'Classe invalide.']);
        }

        // Vérifier que la salle de classe appartient à l'école connectée
        $classroom = Classroom::where('id', $request->classroom_id)
                             ->where('school_id', Auth::id())
                             ->first();
                             
        if (!$classroom) {
            return redirect()->back()->withErrors(['classroom_id' => 'Salle de classe invalide.']);
        }

        $timetable = Timetable::create([
            'class_id' => $request->class_id,
            'classroom_id' => $request->classroom_id,
            'academic_year_id' => $request->academic_year_id,
            'school_id' => Auth::id(),
            'description' => $request->description,
        ]);

        return redirect()->route('timetables.index')->with('success', 'Emploi du temps créé avec succès.');
    }

    // Dans TimetableController, ajoutez cette nouvelle méthode
    public function getClassroomsByClass($classId)
    {
        $class = ClassModel::where('school_id', Auth::id())->findOrFail($classId);
        $classrooms = $class->classrooms; // Assurez-vous d'avoir défini la relation dans le modèle
        
        return response()->json([
            'classrooms' => $classrooms->map(function($classroom) {
                return [
                    'id' => $classroom->id,
                    'name' => $classroom->name,
                    'capacity' => $classroom->capacity
                ];
            })
        ]);
    }

    public function showAddCourseForm($id, Request $request)
    {
        $timetable = Timetable::where('school_id', Auth::id())
                             ->with(['class', 'classroom', 'academicYear'])
                             ->findOrFail($id);
                             
        $courses = Course::where('school_id', Auth::id())->get();
        $teachers = Teacher::where('school_id', Auth::id())->get();
        $classrooms = Classroom::where('school_id', Auth::id())->get();
        $timeSlots = TimeSlot::where('is_active', true)
                            ->where('school_id', Auth::id())
                            ->orderBy('start_time')
                            ->get();
        
        // Récupérer le classroom_id depuis l'URL ou utiliser celui de l'emploi du temps
        $selectedClassroomId = $request->classroom_id ?? $timetable->classroom_id;
        
        return view('timetables.add-course', compact('timetable', 'courses', 'teachers', 
                                                   'classrooms', 'timeSlots', 'selectedClassroomId'));
    }

    public function addCourse(Request $request, $timetable_id)
    {
        // Récupérer l'emploi du temps avant la validation
        $timetable = Timetable::where('school_id', Auth::id())->findOrFail($timetable_id);
        
        // Pré-remplir classroom_id avec la valeur de l'emploi du temps si non spécifié
        if (!$request->has('classroom_id')) {
            $request->merge(['classroom_id' => $timetable->classroom_id]);
        }
    
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'day' => 'required|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi,Samedi',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);
    
        // Récupérer le créneau horaire sélectionné
        $timeSlot = TimeSlot::findOrFail($request->time_slot_id);
        
        // Vérifier que le timeSlot appartient à l'école connectée
        if ($timeSlot->school_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }
    
        // Vérifier si un cours existe déjà dans le même créneau horaire
        $existingCourse = DB::table('timetable_courses')
            ->join('timetables', 'timetable_courses.timetable_id', '=', 'timetables.id')
            ->where('timetables.school_id', Auth::id())
            ->where('timetable_courses.classroom_id', $request->classroom_id)
            ->where('timetable_courses.day', $request->day)
            ->where(function ($query) use ($timeSlot) {
                $query->whereBetween('timetable_courses.start_time', [$timeSlot->start_time, $timeSlot->end_time])
                    ->orWhereBetween('timetable_courses.end_time', [$timeSlot->start_time, $timeSlot->end_time]);
            })
            ->first();
    
        if ($existingCourse) {
            return redirect()->back()->withErrors(['error' => 'Un cours existe déjà dans ce créneau horaire pour cette salle de classe.']);
        }
        
        // Ajouter le cours avec les horaires du créneau sélectionné
        $timetable->courses()->attach($request->course_id, [
            'teacher_id' => $request->teacher_id,
            'start_time' => $timeSlot->start_time,
            'end_time' => $timeSlot->end_time,
            'day' => $request->day,
            'classroom_id' => $request->classroom_id,
            'school_id' => Auth::id(),
        ]);
    
        return redirect()->route('timetables.index')->with('success', 'Cours ajouté avec succès.');
    }

    // Supprimer un emploi du temps
    public function destroy($id)
    {
        $timetable = Timetable::where('school_id', Auth::id())->findOrFail($id);
        $timetable->delete();
        return redirect()->route('timetables.index')->with('success', 'Emploi du temps supprimé.');
    }

    public function weeklyView($timetable_id)
    {
        // Vérifier que l'emploi du temps appartient à l'école connectée
        $timetable = Timetable::with(['academicYear', 'class', 'classroom'])
                             ->where('school_id', Auth::id())
                             ->findOrFail($timetable_id);
        
        // Jours de la semaine
        $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    
        // Créneaux horaires actifs pour cette école
        $timeSlots = TimeSlot::where('is_active', true)
             ->where('school_id', Auth::id())
             ->orderBy('start_time')
             ->get();

        // Debug : vérifier si des créneaux horaires existent
        \Log::info('Nombre de créneaux horaires trouvés: ' . $timeSlots->count());
    
        // Récupérer les cours spécifiques à cet emploi du temps
        $timetableCourses = DB::table('timetable_courses')
            ->join('courses', 'timetable_courses.course_id', '=', 'courses.id')
            ->join('teachers', 'timetable_courses.teacher_id', '=', 'teachers.id')
            ->join('classrooms', 'timetable_courses.classroom_id', '=', 'classrooms.id')
            ->join('timetables', 'timetable_courses.timetable_id', '=', 'timetables.id')
            ->where('timetable_courses.timetable_id', $timetable_id)
            ->where('timetables.school_id', Auth::id())
            ->select(
                'timetable_courses.*',
                'courses.name as course_name',
                'teachers.first_name as teacher_first_name',
                'teachers.last_name as teacher_last_name',
                'classrooms.name as classroom_name'
            )
            ->get();

        // Debug : vérifier si des cours existent
        \Log::info('Nombre de cours trouvés: ' . $timetableCourses->count());
        \Log::info('Courses data: ' . json_encode($timetableCourses));
    
        // Formatage des données pour la vue
        $formattedTimetables = [];
        
        foreach ($timeSlots as $timeSlot) {
            $timeSlotKey = sprintf('%s - %s', 
                date('H:i', strtotime($timeSlot->start_time)), 
                date('H:i', strtotime($timeSlot->end_time))
            );
            
            $formattedTimetables[$timeSlotKey] = [];
    
            foreach ($daysOfWeek as $day) {
                $course = $timetableCourses->where('day', $day)
                    ->where('start_time', $timeSlot->start_time)
                    ->where('end_time', $timeSlot->end_time)
                    ->first();
    
                if ($course) {
                    $formattedTimetables[$timeSlotKey][$day] = [
                        'course_name' => $course->course_name,
                        'teacher_name' => trim($course->teacher_first_name . ' ' . $course->teacher_last_name),
                        'classroom_name' => $course->classroom_name,
                    ];
                } else {
                    $formattedTimetables[$timeSlotKey][$day] = null;
                }
            }
        }
    
        return view('timetables.weekly-view', [
            'daysOfWeek' => $daysOfWeek,
            'formattedTimetables' => $formattedTimetables,
            'timetable' => $timetable,
            'classroomName' => $timetable->classroom->name ?? 'N/A',
            'className' => $timetable->class->name ?? 'N/A',
            'timeSlots' => $timeSlots,
            'courses' => $timetableCourses,
        ]);
    }
}