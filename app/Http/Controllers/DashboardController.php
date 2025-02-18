<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Comptage des classes, salles de classe, enseignants, étudiants
        $classCount = ClassModel::where('school_id', Auth::id())->count();
        
        $classroomCount = Classroom::where('school_id', Auth::id())->count();
        
        $teacherCount = Teacher::where('school_id', Auth::id())->count();
        
        $studentCount = Student::where('school_id', Auth::id())->count();

        // Récupérer les 7 premiers enseignants de l'école
        $teachers = Teacher::where('school_id', Auth::id())
            ->take(7)
            ->get();

        // Calcul de la répartition des genres pour l'école spécifique
        $maleCount = Student::where('school_id', Auth::id())
            ->where('gender', 'male')
            ->count();
            
        $femaleCount = Student::where('school_id', Auth::id())
            ->where('gender', 'female')
            ->count();

        // Calcul du pourcentage
        $totalStudents = $maleCount + $femaleCount;
        $malePercentage = $totalStudents > 0 ? ($maleCount / $totalStudents) * 100 : 0;
        $femalePercentage = $totalStudents > 0 ? ($femaleCount / $totalStudents) * 100 : 0;

        // Passer les données à la vue
        return view('dashboard', compact(
            'teachers',
            'classCount',
            'classroomCount',
            'teacherCount',
            'studentCount',
            'malePercentage',
            'femalePercentage'
        ));
    }
}