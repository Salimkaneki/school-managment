<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Classroom;
use App\Models\Teacher;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        // Comptage des classes, salles de classe, enseignants, étudiants
        $classCount = ClassModel::count();
        $classroomCount = Classroom::count();
        $teacherCount = Teacher::count();
        $studentCount = Student::count();
    
        // Récupérer les 7 premiers enseignants
        $teachers = Teacher::take(7)->get();
    
        // Calcul de la répartition des genres
        $maleCount = Student::where('gender', 'male')->count();
        $femaleCount = Student::where('gender', 'female')->count();
    
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

