<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassController extends Controller
{

    public function index()
    {
        // Récupérer toutes les classes avec leurs professeurs
        $classes = ClassModel::withCount('classrooms')->get();


        // Passer les données à la vue
        return view('classes.class-list', compact('classes'));
    }


    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fees' => 'required|numeric', // Validation des frais de scolarité
            'classrooms.*.name' => 'required|string|max:255',
            'classrooms.*.capacity' => 'required|integer|min:1',
        ]);
    
        // Création de la classe
        $classModel = ClassModel::create([
            'name' => $request->name,
            'description' => $request->description,
            'fees' => $request->fees, // Enregistrement des frais
        ]);
    
        // Création des salles de classe
        foreach ($request->classrooms as $classroom) {
            Classroom::create([
                'name' => $classroom['name'],
                'capacity' => $classroom['capacity'],
                'class_model_id' => $classModel->id, // Utilisation de l'ID de la classe créée
            ]);
        }
    
        return redirect()->route('create-class')->with('success', 'Classe créée avec succès.');
    }
    

    public function edit($id)
    {
        // Récupérer la classe par son ID
        $class = ClassModel::findOrFail($id);
        
        // Passer les données de la classe à la vue d'édition
        return view('classes.edit-class', compact('class'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fees' => 'required|numeric', // Validation des frais de scolarité
        ]);
    
        // Récupérer la classe par son ID
        $class = ClassModel::findOrFail($id);
    
        // Mettre à jour les données de la classe
        $class->update([
            'name' => $request->name,
            'description' => $request->description,
            'fees' => $request->fees, // Mise à jour des frais
        ]);
    
        return redirect()->route('class-list')->with('success', 'Classe mise à jour avec succès.');
    }

    public function destroy($id)
    {
        // Récupérer la classe par son ID
        $class = ClassModel::findOrFail($id);

        // Supprimer la classe
        $class->delete();

        return redirect()->route('class-list')->with('success', 'Classe supprimée avec succès.');
    }

    

}

