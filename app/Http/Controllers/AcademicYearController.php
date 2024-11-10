<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Trimester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class AcademicYearController extends Controller
{
    /**
     * Affiche la liste des années académiques
     */
    public function index()
    {
        try {
            $academicYears = AcademicYear::with('trimesters')
                ->orderBy('start_year', 'desc')
                ->get();
                
            return view('academic-years.index', compact('academicYears'));
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des années académiques: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors du chargement des années académiques.');
        }
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('academic-years.create');
    }

    /**
     * Enregistre une nouvelle année académique
     */
    public function store(Request $request)
    {
        $validated = $this->validateAcademicYear($request);

        try {
            DB::beginTransaction();

            // Désactiver les autres années académiques si celle-ci est active
            if ($validated['is_active']) {
                AcademicYear::where('is_active', true)->update(['is_active' => false]);
            }

            // Créer l'année académique
            $academicYear = AcademicYear::create([
                'start_year' => $validated['start_year'],
                'end_year' => $validated['end_year'],
                'is_active' => $validated['is_active'],
            ]);

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
                ->route('academic-years.index')
                ->with('success', 'Année académique créée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur création année académique: ' . $e->getMessage());
            
            return redirect()
                ->back()
                ->with('error', 'Une erreur est survenue lors de la création de l\'année académique.')
                ->withInput();
        }
    }

    /**
     * Affiche les détails d'une année académique
     */
    public function show(AcademicYear $academicYear)
    {
        try {
            $academicYear->load('trimesters');
            return view('academic-years.show', compact('academicYear'));
        } catch (\Exception $e) {
            Log::error('Erreur affichage année académique: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'affichage de l\'année académique.');
        }
    }

    /**
     * Affiche le formulaire de modification
     */
    public function edit(AcademicYear $academicYear)
    {
        try {
            $academicYear->load('trimesters');
            return view('academic-years.edit', compact('academicYear'));
        } catch (\Exception $e) {
            Log::error('Erreur édition année académique: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors du chargement du formulaire d\'édition.');
        }
    }

    /**
     * Met à jour une année académique
     */
    public function update(Request $request, AcademicYear $academicYear)
    {
        $validated = $this->validateAcademicYear($request, $academicYear);

        try {
            DB::beginTransaction();

            // Désactiver les autres années académiques si celle-ci est active
            if ($validated['is_active']) {
                AcademicYear::where('id', '!=', $academicYear->id)
                    ->where('is_active', true)
                    ->update(['is_active' => false]);
            }

            // Mettre à jour l'année académique
            $academicYear->update([
                'start_year' => $validated['start_year'],
                'end_year' => $validated['end_year'],
                'is_active' => $validated['is_active'],
            ]);

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
                ->route('academic-years.index')
                ->with('success', 'Année académique mise à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur mise à jour année académique: ' . $e->getMessage());
            
            return redirect()
                ->back()
                ->with('error', 'Une erreur est survenue lors de la mise à jour de l\'année académique.')
                ->withInput();
        }
    }

    /**
     * Supprime une année académique
     */
    public function destroy(AcademicYear $academicYear)
    {
        try {
            if ($academicYear->is_active) {
                return redirect()
                    ->back()
                    ->with('error', 'Impossible de supprimer une année académique active.');
            }

            DB::beginTransaction();
            
            // La suppression des trimestres se fait automatiquement grâce à la relation onDelete('cascade')
            $academicYear->delete();
            
            DB::commit();

            return redirect()
                ->route('academic-years.index')
                ->with('success', 'Année académique supprimée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur suppression année académique: ' . $e->getMessage());
            
            return redirect()
                ->back()
                ->with('error', 'Une erreur est survenue lors de la suppression de l\'année académique.');
        }
    }

    /**
     * Récupère l'année académique active
     */
    public function currentAcademicYear()
    {
        try {
            $currentAcademicYear = AcademicYear::where('is_active', true)
                ->with('trimesters')
                ->first();

            if (!$currentAcademicYear) {
                return response()->json([
                    'error' => 'Aucune année académique active n\'a été trouvée.'
                ], 404);
            }

            return response()->json([
                'data' => $currentAcademicYear
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur récupération année académique active: ' . $e->getMessage());
            return response()->json([
                'error' => 'Une erreur est survenue lors de la récupération de l\'année académique active.'
            ], 500);
        }
    }

    /**
     * Active une année académique spécifique
     */
    public function activate(AcademicYear $academicYear)
    {
        try {
            DB::beginTransaction();

            // Désactiver toutes les autres années académiques
            AcademicYear::where('id', '!=', $academicYear->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);

            // Activer l'année académique sélectionnée
            $academicYear->update(['is_active' => true]);

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'L\'année académique a été activée avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur activation année académique: ' . $e->getMessage());
            
            return redirect()
                ->back()
                ->with('error', 'Une erreur est survenue lors de l\'activation de l\'année académique.');
        }
    }

    /**
     * Valide les données de l'année académique
     */
    private function validateAcademicYear(Request $request, ?AcademicYear $academicYear = null)
    {
        $rules = [
            'start_year' => [
                'required',
                'integer',
                'min:2000',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value >= $request->input('end_year')) {
                        $fail('L\'année de début doit être inférieure à l\'année de fin.');
                    }
                },
            ],
            'end_year' => ['required', 'integer', 'min:2000'],
            'is_active' => ['nullable'],
            'trimesters' => ['required', 'array', 'min:1'],
            'trimesters.*.name' => ['required', 'string', 'max:255'],
            'trimesters.*.start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $startYear = $request->input('start_year');
                    $year = date('Y', strtotime($value));
                    if ($year < $startYear) {
                        $fail('La date de début du trimestre ne peut pas être antérieure à l\'année académique.');
                    }
                },
            ],
            'trimesters.*.end_date' => [
                'required',
                'date',
                'after_or_equal:trimesters.*.start_date',
                function ($attribute, $value, $fail) use ($request) {
                    $endYear = $request->input('end_year');
                    $year = date('Y', strtotime($value));
                    if ($year > $endYear) {
                        $fail('La date de fin du trimestre ne peut pas être postérieure à l\'année académique.');
                    }
                },
            ],
        ];

        $messages = [
            'start_year.required' => 'L\'année de début est requise.',
            'start_year.min' => 'L\'année de début doit être supérieure ou égale à 2000.',
            'end_year.required' => 'L\'année de fin est requise.',
            'end_year.min' => 'L\'année de fin doit être supérieure ou égale à 2000.',
            'trimesters.required' => 'Au moins un trimestre est requis.',
            'trimesters.min' => 'Au moins un trimestre est requis.',
            'trimesters.*.name.required' => 'Le nom du trimestre est requis.',
            'trimesters.*.start_date.required' => 'La date de début du trimestre est requise.',
            'trimesters.*.end_date.required' => 'La date de fin du trimestre est requise.',
            'trimesters.*.end_date.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
        ];

        $validated = $request->validate($rules, $messages);

        // Traitement explicite de is_active comme boolean
        $validated['is_active'] = $request->has('is_active');

        // Vérifier le chevauchement des dates des trimestres
        $trimesterDates = collect($validated['trimesters'])
            ->map(function ($trimester) {
                return [
                    'start' => strtotime($trimester['start_date']),
                    'end' => strtotime($trimester['end_date'])
                ];
            })
            ->sortBy('start');

        $previousEnd = null;
        foreach ($trimesterDates as $dates) {
            if ($previousEnd !== null && $dates['start'] <= $previousEnd) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'trimesters' => ['Les dates des trimestres ne peuvent pas se chevaucher.']
                ]);
            }
            $previousEnd = $dates['end'];
        }

        return $validated;
    }
}