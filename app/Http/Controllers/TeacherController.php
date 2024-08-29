<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;


class TeacherController extends Controller
{
    // public function index() {
    //     $teachers = Teacher::all(); // 
    //     return view('teachers.index', compact('teachers'));
    // }

    public function index()
    {
        // Récupérer tous les enseignants
        $teachers = Teacher::all();
    
        // Retourner la vue avec les enseignants
        return view('teachers.index', ['teachers' => $teachers]);
    }


    public function store(StoreTeacherRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = bcrypt($validatedData['password']);
    
        Teacher::create($validatedData);
    
        return redirect()->route('index-teacher')->with('success', 'Le professeur a été ajouté avec succès.');
    }
    
}
