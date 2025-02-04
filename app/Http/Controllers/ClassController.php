<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::where('school_id', Auth::id())->withCount('classrooms')->paginate(10);
        return view('classes.class-list', compact('classes'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fees' => 'required|numeric|min:0',
            'classrooms.*.name' => 'required|string|max:255',
            'classrooms.*.capacity' => 'required|integer|min:1',
        ]);

        // dd(Auth::id()); // Ajoutez cette ligne pour vérifier

    
        $classModel = ClassModel::create([
            'name' => $request->name,
            'description' => $request->description,
            'fees' => $request->fees,
            'school_id' => Auth::id(),  // Ajout de cette ligne
        ]);
    
        foreach ($request->classrooms as $classroom) {
            Classroom::create([
                'name' => $classroom['name'],
                'capacity' => $classroom['capacity'],
                'class_model_id' => $classModel->id,
                'school_id' => Auth::id(),  // Ajout de cette ligne

            ]);
        }
    
        return redirect()->route('class-list')->with('success', 'Classe créée avec succès.');
    }

    public function edit($id)
    {
        $class = ClassModel::with('classrooms')->findOrFail($id);
        return view('classes.edit-class', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'fees' => 'required|numeric|min:0',
            'classrooms.*.name' => 'required|string|max:255',
            'classrooms.*.capacity' => 'required|integer|min:1',
        ]);

        $class = ClassModel::findOrFail($id);
        
        $class->update([
            'name' => $request->name,
            'description' => $request->description,
            'fees' => $request->fees,
            'school_id' => Auth::id(),  // Ajout de cette ligne

        ]);

        if ($request->has('classrooms')) {
            $class->classrooms()->delete();
            
            foreach ($request->classrooms as $classroom) {
                Classroom::create([
                    'name' => $classroom['name'],
                    'capacity' => $classroom['capacity'],
                    'class_model_id' => $class->id,
                    'school_id' => Auth::id(),  // Ajout de cette ligne

                ]);
            }
        }

        return redirect()->route('class-list')->with('success', 'Classe mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $class = ClassModel::findOrFail($id);
        $class->classrooms()->delete();
        $class->delete();

        return redirect()->route('class-list')->with('success', 'Classe supprimée avec succès.');
    }
}