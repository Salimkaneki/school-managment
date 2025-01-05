<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::withCount('classrooms')->paginate(10);
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

        $classModel = ClassModel::create([
            'name' => $request->name,
            'description' => $request->description,
            'fees' => $request->fees,
        ]);

        foreach ($request->classrooms as $classroom) {
            Classroom::create([
                'name' => $classroom['name'],
                'capacity' => $classroom['capacity'],
                'class_model_id' => $classModel->id,
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
        ]);

        if ($request->has('classrooms')) {
            $class->classrooms()->delete();
            
            foreach ($request->classrooms as $classroom) {
                Classroom::create([
                    'name' => $classroom['name'],
                    'capacity' => $classroom['capacity'],
                    'class_model_id' => $class->id,
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