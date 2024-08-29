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
        $classCount = ClassModel::count();
        $classroomCount = Classroom::count();
        $teacherCount = Teacher::count();
        $studentCount = Student::count();
        $teachers = Teacher::take(7)->get();

        return view('dashboard', compact('teachers','classCount', 'classroomCount', 'teacherCount', 'studentCount'));
    }

}

