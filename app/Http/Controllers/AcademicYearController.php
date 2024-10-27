<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Trimester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class AcademicYearController extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::with('trimesters')
            ->orderBy('start_year', 'desc')
            ->get();
        return view('academic-years.index', compact('academicYears'));
    }

    public function create()
    {
        return view('academic-years.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_year' => 'required|integer|min:2000',
            'end_year' => 'required|integer|gt:start_year',
            'is_active' => 'boolean',
            'trimesters' => 'required|array|min:1',
            'trimesters.*.name' => 'required|string|max:255',
            'trimesters.*.start_date' => 'required|date',
            'trimesters.*.end_date' => 'required|date|after:trimesters.*.start_date',
        ]);

        try {
            DB::beginTransaction();

            // Créer l'année académique
            $academicYear = AcademicYear::create([
                'start_year' => $validated['start_year'],
                'end_year' => $validated['end_year'],
                'is_active' => $request->has('is_active'),
            ]);

            // Si cette année est active, désactiver les autres
            if ($request->has('is_active')) {
                AcademicYear::where('id', '!=', $academicYear->id)
                    ->update(['is_active' => false]);
            }

            // Créer les trimestres
            foreach ($validated['trimesters'] as $trimesterData) {
                $academicYear->trimesters()->create([
                    'name' => $trimesterData['name'],
                    'start_date' => $trimesterData['start_date'],
                    'end_date' => $trimesterData['end_date'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('dashboard.academic-years.index')
                ->with('success', 'Année académique créée avec succès.');

        } catch (Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la création de l\'année académique.');
        }
    }

    public function show(AcademicYear $academicYear)
    {
        $academicYear->load('trimesters');
        return view('academic-years.show', compact('academicYear'));
    }

    public function edit(AcademicYear $academicYear)
    {
        $academicYear->load('trimesters');
        return view('academic-years.edit', compact('academicYear'));
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $validated = $request->validate([
            'start_year' => 'required|integer|min:2000',
            'end_year' => 'required|integer|gt:start_year',
            'is_active' => 'boolean',
            'trimesters' => 'required|array|min:1',
            'trimesters.*.name' => 'required|string|max:255',
            'trimesters.*.start_date' => 'required|date',
            'trimesters.*.end_date' => 'required|date|after:trimesters.*.start_date',
        ]);

        try {
            DB::beginTransaction();

            $academicYear->update([
                'start_year' => $validated['start_year'],
                'end_year' => $validated['end_year'],
                'is_active' => $request->has('is_active'),
            ]);

            if ($request->has('is_active')) {
                AcademicYear::where('id', '!=', $academicYear->id)
                    ->update(['is_active' => false]);
            }

            // Supprimer les anciens trimestres
            $academicYear->trimesters()->delete();

            // Créer les nouveaux trimestres
            foreach ($validated['trimesters'] as $trimesterData) {
                $academicYear->trimesters()->create([
                    'name' => $trimesterData['name'],
                    'start_date' => $trimesterData['start_date'],
                    'end_date' => $trimesterData['end_date'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('dashboard.academic-years.index')
                ->with('success', 'Année académique mise à jour avec succès.');

        } catch (Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Une erreur est survenue lors de la mise à jour de l\'année académique.');
        }
    }

    public function destroy(AcademicYear $academicYear)
    {
        try {
            if ($academicYear->is_active) {
                return back()->with('error', 'Impossible de supprimer une année académique active.');
            }

            $academicYear->delete();
            return redirect()
                ->route('dashboard.academic-years.index')
                ->with('success', 'Année académique supprimée avec succès.');

        } catch (Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la suppression de l\'année académique.');
        }
    }

    public function activate(AcademicYear $academicYear)
    {
        try {
            DB::beginTransaction();
            
            // Désactiver toutes les autres années académiques
            AcademicYear::where('id', '!=', $academicYear->id)
                ->update(['is_active' => false]);
            
            // Activer l'année sélectionnée
            $academicYear->update(['is_active' => true]);
            
            DB::commit();
            
            return redirect()
                ->route('dashboard.academic-years.index')
                ->with('success', 'Année académique activée avec succès.');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue lors de l\'activation de l\'année académique.');
        }
    }
}