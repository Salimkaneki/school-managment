<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Classroom;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    public function listClassrooms()
    {
        $classrooms = Classroom::withCount(['classModel', 'academicYear'])->get(); // Associe les salles aux classes via la relation définie

        return view('classes.classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        $academicYears = AcademicYear::all(); // Assurez-vous d'importer le modèle AcademicYear
        
        return view('classes.classrooms.create', compact('classes', 'academicYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'class_model_id' => 'required|exists:class_models,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        Classroom::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'class_model_id' => $request->class_model_id,
            'academic_year_id' => $request->academic_year_id,
        ]);

        return redirect()->route('list-classrooms')->with('success', 'Salle de classe créée avec succès.');
    }
}
