<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Student;


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

        $students = Student::all();

        return view('students.index', compact('students'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:6',
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'required|string|in:male,female,other',
            'date_of_birth' => 'required|date',
            'address' => 'nullable|string|max:255',
            'class_id' => 'required|exists:class_models,id',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        Student::create($validatedData);

        return redirect()->route('student-list')->with('success', 'Élève ajouté avec succès.');
    }

}
