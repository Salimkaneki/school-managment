<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
{
    /**
     * Afficher la liste des écoles
     */
    public function index()
    {
        $schools = School::latest()->paginate(10);
        return view('schools.index-schools', compact('schools'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        return view('schools.create-school');
    }

    /**
     * Enregistrer une nouvelle école
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'languages' => 'required|array',
            'teaching_staff_count' => 'required|integer|min:1',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string'
        ]);

        // Traitement des fichiers
        if ($request->hasFile('rules_document')) {
            $validated['rules_document_path'] = $request->file('rules_document')
                ->store('schools/rules', 'public');
        }

        if ($request->hasFile('project_document')) {
            $validated['project_document_path'] = $request->file('project_document')
                ->store('schools/projects', 'public');
        }

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')
                ->store('schools/logos', 'public');
        }

        // Traitement des équipements
        $validated['has_sports_equipment'] = $request->has('has_sports_equipment');
        $validated['has_library'] = $request->has('has_library');
        $validated['has_computer_room'] = $request->has('has_computer_room');
        $validated['has_handicap_access'] = $request->has('has_handicap_access');

        School::create($validated);

        return redirect()->route('schools.index')
            ->with('success', 'École créée avec succès');
    }

    /**
     * Afficher une école
     */
    public function show(School $school)
    {
        return view('schools.show', compact('school'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(School $school)
    {
        return view('schools.edit', compact('school'));
    }

    /**
     * Mettre à jour une école
     */
    public function update(Request $request, School $school)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'languages' => 'required|array',
            'staff_count' => 'required|integer|min:1',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string'
        ]);

        // Mise à jour des fichiers si nécessaire
        if ($request->hasFile('rules_document')) {
            // Supprimer l'ancien fichier
            Storage::disk('public')->delete($school->rules_document_path);
            $validated['rules_document_path'] = $request->file('rules_document')
                ->store('schools/rules', 'public');
        }

        if ($request->hasFile('project_document')) {
            Storage::disk('public')->delete($school->project_document_path);
            $validated['project_document_path'] = $request->file('project_document')
                ->store('schools/projects', 'public');
        }

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($school->logo_path);
            $validated['logo_path'] = $request->file('logo')
                ->store('schools/logos', 'public');
        }

        // Mise à jour des équipements
        $validated['has_sports_equipment'] = $request->has('has_sports_equipment');
        $validated['has_library'] = $request->has('has_library');
        $validated['has_computer_room'] = $request->has('has_computer_room');
        $validated['has_handicap_access'] = $request->has('has_handicap_access');

        $school->update($validated);

        return redirect()->route('schools.index-schools')
            ->with('success', 'École mise à jour avec succès');
    }

    /**
     * Supprimer une école
     */
    public function destroy(School $school)
    {
        // Suppression des fichiers associés
        Storage::disk('public')->delete([
            $school->rules_document_path,
            $school->project_document_path,
            $school->logo_path
        ]);

        $school->delete();

        return redirect()->route('schools.index-schools')
            ->with('success', 'École supprimée avec succès');
    }
}