<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::where('school_id', Auth::guard('web')->user()->id)
            ->withCount('classrooms')
            ->paginate(10);

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

        DB::beginTransaction();

        try {
            $classModel = ClassModel::create([
                'name' => $request->name,
                'description' => $request->description,
                'fees' => $request->fees,
                'school_id' => Auth::guard('web')->user()->id,
            ]);

            if ($request->has('classrooms') && count($request->classrooms) > 0) {
                foreach ($request->classrooms as $classroom) {
                    Classroom::create([
                        'name' => $classroom['name'],
                        'capacity' => $classroom['capacity'],
                        'class_model_id' => $classModel->id,
                        'school_id' => Auth::guard('web')->user()->id,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('class-list')->with('success', 'Classe créée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue, veuillez réessayer.');
        }
    }

    public function edit($id)
    {
        $class = ClassModel::where('school_id', Auth::guard('web')->user()->id)
            ->with('classrooms')
            ->findOrFail($id);

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

        $class = ClassModel::where('school_id', Auth::guard('web')->user()->id)
            ->findOrFail($id);

        DB::beginTransaction();

        try {
            $class->update([
                'name' => $request->name,
                'description' => $request->description,
                'fees' => $request->fees,
            ]);

            if ($request->has('classrooms') && count($request->classrooms) > 0) {
                $class->classrooms()->delete();

                foreach ($request->classrooms as $classroom) {
                    Classroom::create([
                        'name' => $classroom['name'],
                        'capacity' => $classroom['capacity'],
                        'class_model_id' => $class->id,
                        'school_id' => Auth::guard('web')->user()->id,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('class-list')->with('success', 'Classe mise à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue, veuillez réessayer.');
        }
    }

    public function destroy($id)
    {
        $class = ClassModel::where('school_id', Auth::guard('web')->user()->id)
            ->findOrFail($id);

        DB::beginTransaction();

        try {
            $class->classrooms()->delete();
            $class->delete();

            DB::commit();
            return redirect()->route('class-list')->with('success', 'Classe supprimée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
}
