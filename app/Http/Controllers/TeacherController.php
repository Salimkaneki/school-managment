<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Teacher;

class TeacherController extends Controller
{
    // Affiche la liste des professeurs
    public function index()
    {
        $teachers = Teacher::orderBy('last_name', 'asc')->paginate(10);
        return view('teachers.index', ['teachers' => $teachers]);
    }

    // Enregistre un nouveau professeur
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers',
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female,other',
            'nationality' => 'nullable|string|max:255',
            'seniority' => 'nullable|integer',
            'subject' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Stocke l'image directement dans le dossier teachers
            // Sans ajouter /storage/ au début
            $photoPath = $request->file('photo')->store('teachers', 'public');
            $validatedData['photo'] = $photoPath; // Stocke le chemin relatif uniquement
        }

        Teacher::create($validatedData);
        
        return redirect()->route('index-teacher')
            ->with('success', 'Enseignant ajouté avec succès.');
    }
}