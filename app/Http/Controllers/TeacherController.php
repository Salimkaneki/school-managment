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
        // Récupère la liste des professeurs triée par nom de famille avec pagination
        $teachers = Teacher::orderBy('last_name', 'asc')->paginate(10);
        
        // Passe la liste des professeurs à la vue
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
