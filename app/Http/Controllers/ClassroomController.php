<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    public function listClassrooms()
    {
        $classrooms = Classroom::withCount('classModel')->get(); // Associe les salles aux classes via la relation définie

        return view('classes.classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        // Récupérer toutes les classes existantes
        $classes = ClassModel::all();

        // Passer les classes à la vue
        return view('classes.classrooms.create', compact('classes'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'class_model_id' => 'required|exists:class_models,id',
        ]);

        // Enregistrer la nouvelle salle de classe
        Classroom::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'class_model_id' => $request->class_model_id,
        ]);

        return redirect()->route('list-classrooms')->with('success', 'Salle de classe créée avec succès.');
    }
}
