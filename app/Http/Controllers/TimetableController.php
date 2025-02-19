<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Classroom;
use App\Models\Timetable;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\TimeSlot;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;




class TimetableController extends Controller
{
    // Voir la liste des emplois du temps
    public function index()
    {
        $timetables = Timetable::with('class', 'classroom')->paginate(5);
        return view('timetables.index', compact('timetables'));
    }

    // Afficher le formulaire pour créer un emploi du temps
    public function create()
    {
        $classes = ClassModel::all();
        $classrooms = Classroom::all();
        return view('timetables.create', compact('classes', 'classrooms'));
    }

    // Stocker un nouvel emploi du temps
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:class_models,id',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);

        $timetable = Timetable::create([
            'class_id' => $request->class_id,
            'classroom_id' => $request->classroom_id,
        ]);

        return redirect()->route('timetables.index')->with('success', 'Emploi du temps créé avec succès.');
    }

    // Dans TimetableController, ajoutez cette nouvelle méthode
    public function getClassroomsByClass($classId)
    {
        $class = ClassModel::findOrFail($classId);
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

    // Afficher le formulaire pour ajouter un cours
    public function showAddCourseForm($id)
    {
        $timetable = Timetable::findOrFail($id);
        $courses = Course::all();
        $teachers = Teacher::all();
        $classrooms = Classroom::all();
        $timeSlots = TimeSlot::where('is_active', true)
                            ->orderBy('start_time')
                            ->get();
    
        return view('timetables.add-course', compact('timetable', 'courses', 'teachers', 'classrooms', 'timeSlots'));
    }



    public function addCourse(Request $request, $timetable_id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id',
            'time_slot_id' => 'required|exists:time_slots,id', // Nouvelle validation
            'day' => 'required|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi',
            'classroom_id' => 'required|exists:classrooms,id',
        ]);
    
        // Récupérer le créneau horaire sélectionné
        $timeSlot = TimeSlot::findOrFail($request->time_slot_id);
    
        // Vérifier si un cours existe déjà dans le même créneau horaire
        $existingCourse = DB::table('timetable_courses')
            ->where('classroom_id', $request->classroom_id)
            ->where('day', $request->day)
            ->where(function ($query) use ($timeSlot) {
                $query->whereBetween('start_time', [$timeSlot->start_time, $timeSlot->end_time])
                    ->orWhereBetween('end_time', [$timeSlot->start_time, $timeSlot->end_time]);
            })
            ->first();
    
        if ($existingCourse) {
            return redirect()->back()->withErrors(['error' => 'Un cours existe déjà dans ce créneau horaire pour cette salle de classe.']);
        }
    
        // Ajouter le cours avec les horaires du créneau sélectionné
        $timetable = Timetable::find($timetable_id);
        $timetable->courses()->attach($request->course_id, [
            'teacher_id' => $request->teacher_id,
            'start_time' => $timeSlot->start_time,
            'end_time' => $timeSlot->end_time,
            'day' => $request->day,
            'classroom_id' => $request->classroom_id,
        ]);
    
        return redirect()->route('timetables.index')->with('success', 'Cours ajouté avec succès.');
    }
    
    


    // Voir un emploi du temps spécifique
    public function view($id)
    {
        $timetable = Timetable::with('class', 'classroom', 'course', 'teacher')
                              ->where('id', $id)
                              ->first();
    
        if (!$timetable) {
            abort(404, 'Emploi du temps non trouvé.');
        }
    
        // Assurez-vous que les données sont correctement organisées
        $timetableSlots = $this->getTimetableSlots($timetable);
        $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    
        return view('timetables.view', compact('timetableSlots', 'daysOfWeek'));
    }
    
    private function getTimetableSlots($timetable)
    {
        // Implémentez cette méthode pour organiser les créneaux horaires et les cours
        // Exemple de retour de tableau
        return [
            (object)[
                'time_range' => '08:00 - 09:00',
                'courses' => [
                    'Monday' => ['course_name' => 'Mathématiques', 'teacher_name' => 'Dupont'],
                    // Ajoutez d'autres jours si nécessaire
                ]
            ],
            // Ajoutez d'autres créneaux horaires
        ];
    }
    
    

    // Supprimer un emploi du temps
    public function destroy($id)
    {
        Timetable::findOrFail($id)->delete();
        return redirect()->route('timetables.index')->with('success', 'Emploi du temps supprimé.');
    }


    public function weeklyView($timetable_id)
    {
        // Jours de la semaine
        $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    
        // Créneaux horaires
         $timeSlots = TimeSlot::where('is_active', true)
             ->orderBy('start_time')
             ->get()
             ->map(function($slot) {
                 return sprintf('%s - %s', 
                     date('H:i', strtotime($slot->start_time)), 
                date('H:i', strtotime($slot->end_time))
                 );
             });
    
        // Récupérer les cours spécifiques à cet emploi du temps et à la salle de classe
        $timetableCourses = DB::table('timetable_courses')
            ->join('courses', 'timetable_courses.course_id', '=', 'courses.id')
            ->join('teachers', 'timetable_courses.teacher_id', '=', 'teachers.id')
            ->join('classrooms', 'timetable_courses.classroom_id', '=', 'classrooms.id')
            ->where('timetable_courses.timetable_id', $timetable_id) // Filtrer par emploi du temps
            ->select(
                'timetable_courses.*',
                'courses.name as course_name',
                'teachers.first_name as teacher_first_name',
                'teachers.last_name as teacher_last_name',
                'classrooms.name as classroom_name'
            )
            ->get()
            ->groupBy(function ($timetable) {
                return date('H:i', strtotime($timetable->start_time)) . ' - ' . date('H:i', strtotime($timetable->end_time));
            });
    
        // Formatage des données pour la vue
        $formattedTimetables = [];
        foreach ($timeSlots as $timeSlot) {
            $formattedTimetables[$timeSlot] = [];
    
            foreach ($daysOfWeek as $day) {
                if (isset($timetableCourses[$timeSlot])) {
                    $course = $timetableCourses[$timeSlot]->firstWhere('day', $day);
                } else {
                    $course = null;
                }
    
                if ($course) {
                    $formattedTimetables[$timeSlot][$day] = [
                        'course_name' => $course->course_name,
                        'teacher_name' => $course->teacher_first_name . ' ' . $course->teacher_last_name,
                        'classroom_name' => $course->classroom_name,
                    ];
                } else {
                    $formattedTimetables[$timeSlot][$day] = null;
                }
            }
        }
    
        // Récupérer les informations de la salle et de la classe
        $timetable = Timetable::find($timetable_id);
        $classroomName = Classroom::find($timetable->classroom_id)->name;
        $className = ClassModel::find($timetable->class_id)->name;
    
        return view('timetables.weekly-view', [
            'daysOfWeek' => $daysOfWeek,
            'formattedTimetables' => $formattedTimetables,
            'classroomName' => $classroomName,
            'className' => $className,
        ]);
    
    }    
}



// namespace App\Http\Controllers;

// use App\Models\ClassModel;
// use App\Models\Classroom;
// use App\Models\Timetable;
// use App\Models\Course;
// use App\Models\Teacher;
// use App\Models\TimeSlot;
// use App\Models\School;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;

// class TimetableController extends Controller
// {
//     public function index()
//     {
//         $timetables = Timetable::where('school_id', Auth::id())
//             ->with('class', 'classroom')
//             ->paginate(5);
//         return view('timetables.index', compact('timetables'));
//     }

//     public function create()
//     {
//         $classes = ClassModel::where('school_id', Auth::id())->get();
//         $classrooms = Classroom::where('school_id', Auth::id())->get();
//         return view('timetables.create', compact('classes', 'classrooms'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'class_id' => 'required|exists:class_models,id',
//             'classroom_id' => 'required|exists:classrooms,id',
//         ]);

//         $timetable = Timetable::create([
//             'class_id' => $request->class_id,
//             'classroom_id' => $request->classroom_id,
//             'school_id' => Auth::id(),
//         ]);

//         return redirect()->route('timetables.index')
//             ->with('success', 'Emploi du temps créé avec succès.');
//     }

//     public function getClassroomsByClass($classId)
//     {
//         $class = ClassModel::where('school_id', Auth::id())
//             ->findOrFail($classId);
            
//         $classrooms = $class->classrooms()
//             ->where('school_id', Auth::id())
//             ->get();
        
//         return response()->json([
//             'classrooms' => $classrooms->map(function($classroom) {
//                 return [
//                     'id' => $classroom->id,
//                     'name' => $classroom->name,
//                     'capacity' => $classroom->capacity
//                 ];
//             })
//         ]);
//     }

//     public function showAddCourseForm($id)
//     {
//         $timetable = Timetable::where('school_id', Auth::id())
//             ->findOrFail($id);
            
//         $courses = Course::where('school_id', Auth::id())->get();
//         $teachers = Teacher::where('school_id', Auth::id())->get();
//         $classrooms = Classroom::where('school_id', Auth::id())->get();
//         $timeSlots = TimeSlot::where('school_id', Auth::id())
//             ->where('is_active', true)
//             ->orderBy('start_time')
//             ->get();
    
//         return view('timetables.add-course', compact('timetable', 'courses', 'teachers', 'classrooms', 'timeSlots'));
//     }

//     public function addCourse(Request $request, $timetable_id)
//     {
//         $timetable = Timetable::where('school_id', Auth::id())
//             ->findOrFail($timetable_id);

//         $request->validate([
//             'course_id' => 'required|exists:courses,id',
//             'teacher_id' => 'required|exists:teachers,id',
//             'time_slot_id' => 'required|exists:time_slots,id',
//             'day' => 'required|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi',
//             'classroom_id' => 'required|exists:classrooms,id',
//         ]);
    
//         $timeSlot = TimeSlot::where('school_id', Auth::id())
//             ->findOrFail($request->time_slot_id);
    
//         $existingCourse = DB::table('timetable_courses')
//             ->join('timetables', 'timetable_courses.timetable_id', '=', 'timetables.id')
//             ->where('timetables.school_id', Auth::id())
//             ->where('classroom_id', $request->classroom_id)
//             ->where('day', $request->day)
//             ->where(function ($query) use ($timeSlot) {
//                 $query->whereBetween('start_time', [$timeSlot->start_time, $timeSlot->end_time])
//                     ->orWhereBetween('end_time', [$timeSlot->start_time, $timeSlot->end_time]);
//             })
//             ->first();
    
//         if ($existingCourse) {
//             return redirect()->back()
//                 ->withErrors(['error' => 'Un cours existe déjà dans ce créneau horaire pour cette salle de classe.']);
//         }
    
//         $timetable->courses()->attach($request->course_id, [
//             'teacher_id' => $request->teacher_id,
//             'start_time' => $timeSlot->start_time,
//             'end_time' => $timeSlot->end_time,
//             'day' => $request->day,
//             'classroom_id' => $request->classroom_id,
//         ]);
    
//         return redirect()->route('timetables.index')
//             ->with('success', 'Cours ajouté avec succès.');
//     }

//     public function weeklyView($timetable_id)
//     {
//         $timetable = Timetable::where('school_id', Auth::id())
//             ->findOrFail($timetable_id);

//         $daysOfWeek = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    
//         $timeSlots = TimeSlot::where('school_id', Auth::id())
//             ->where('is_active', true)
//             ->orderBy('start_time')
//             ->get()
//             ->map(function($slot) {
//                 return sprintf('%s - %s', 
//                     date('H:i', strtotime($slot->start_time)), 
//                     date('H:i', strtotime($slot->end_time))
//                 );
//             });
    
//         $timetableCourses = DB::table('timetable_courses')
//             ->join('courses', 'timetable_courses.course_id', '=', 'courses.id')
//             ->join('teachers', 'timetable_courses.teacher_id', '=', 'teachers.id')
//             ->join('classrooms', 'timetable_courses.classroom_id', '=', 'classrooms.id')
//             ->join('timetables', 'timetable_courses.timetable_id', '=', 'timetables.id')
//             ->where('timetables.school_id', Auth::id())
//             ->where('timetable_courses.timetable_id', $timetable_id)
//             ->select(
//                 'timetable_courses.*',
//                 'courses.name as course_name',
//                 'teachers.first_name as teacher_first_name',
//                 'teachers.last_name as teacher_last_name',
//                 'classrooms.name as classroom_name'
//             )
//             ->get()
//             ->groupBy(function ($timetable) {
//                 return date('H:i', strtotime($timetable->start_time)) . ' - ' . date('H:i', strtotime($timetable->end_time));
//             });
    
//         $formattedTimetables = [];
//         foreach ($timeSlots as $timeSlot) {
//             $formattedTimetables[$timeSlot] = [];
    
//             foreach ($daysOfWeek as $day) {
//                 if (isset($timetableCourses[$timeSlot])) {
//                     $course = $timetableCourses[$timeSlot]->firstWhere('day', $day);
//                 } else {
//                     $course = null;
//                 }
    
//                 if ($course) {
//                     $formattedTimetables[$timeSlot][$day] = [
//                         'course_name' => $course->course_name,
//                         'teacher_name' => $course->teacher_first_name . ' ' . $course->teacher_last_name,
//                         'classroom_name' => $course->classroom_name,
//                     ];
//                 } else {
//                     $formattedTimetables[$timeSlot][$day] = null;
//                 }
//             }
//         }
    
//         $classroomName = Classroom::where('school_id', Auth::id())
//             ->where('id', $timetable->classroom_id)
//             ->value('name');
            
//         $className = ClassModel::where('school_id', Auth::id())
//             ->where('id', $timetable->class_id)
//             ->value('name');
    
//         return view('timetables.weekly-view', [
//             'daysOfWeek' => $daysOfWeek,
//             'formattedTimetables' => $formattedTimetables,
//             'classroomName' => $classroomName,
//             'className' => $className,
//         ]);
//     }

//     public function destroy($id)
//     {
//         $timetable = Timetable::where('school_id', Auth::id())
//             ->findOrFail($id);
            
//         $timetable->delete();
        
//         return redirect()->route('timetables.index')
//             ->with('success', 'Emploi du temps supprimé.');
//     }
// }