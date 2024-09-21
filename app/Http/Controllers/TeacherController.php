<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;

class TeacherController extends Controller
{
    // Affiche la liste des professeurs
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', ['teachers' => $teachers]);
    }

    // Enregistre un nouveau professeur
    public function store(StoreTeacherRequest $request)
    {
        // Récupérer les données validées du formulaire
        $validatedData = $request->validated();

        // Enregistrer l'enseignant
        Teacher::create($validatedData);

        // Redirection après enregistrement réussi
        return redirect()->route('index-teacher')->with('success', 'Enseignant ajouté avec succès.');
    }
}
