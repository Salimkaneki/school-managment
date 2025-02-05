<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    // Affiche la liste des professeurs
    public function index()
    {
        $teachers = Teacher::where('school_id', Auth::guard('web')->user()->id)
            ->orderBy('last_name', 'asc')
            ->paginate(10);
        return view('teachers.index', ['teachers' => $teachers]);
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('teachers.create');
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
           'birthday' => 'required|date',
           'marital_status' => 'required|in:single,married,divorced,widowed',
           'address' => 'required|string|max:255',
       ]);
    
       $validatedData['school_id'] = Auth::guard('web')->user()->id;
    
       if ($request->hasFile('photo')) {
           $photoPath = $request->file('photo')->store('teachers', 'public');
           $validatedData['photo'] = $photoPath;
       }
    
       Teacher::create($validatedData);
       
       return redirect()->route('index-teacher')
           ->with('success', 'Enseignant ajouté avec succès.');
    }

    // Affiche les détails d'un professeur
    public function show(Teacher $teacher)
    {
        // Vérifier que le professeur appartient à l'école connectée
        if ($teacher->school_id !== Auth::guard('web')->user()->id) {
            abort(403, 'Non autorisé');
        }
        return view('teachers.show', compact('teacher'));
    }

    // Affiche le formulaire d'édition
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.edit', compact('teacher'));
    }
    
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        
        // Vérifier que le professeur appartient à l'école connectée
        if ($teacher->school_id !== Auth::guard('web')->user()->id) {
            abort(403, 'Non autorisé');
        }
    
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:teachers,email,'.$id,
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'required|in:male,female,other',
            'nationality' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'seniority' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'birthday' => 'required|date',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'address' => 'required|string|max:255',
        ]);
    
        $validated['school_id'] = Auth::guard('web')->user()->id;
    
        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                Storage::delete($teacher->photo);
            }
            
            $path = $request->file('photo')->store('teachers', 'public');
            $validated['photo'] = $path;
        }
    
        $teacher->update($validated);
    
        return redirect()->route('teachers.index')
            ->with('success', 'Les informations du professeur ont été mises à jour avec succès.');
    }


    // Supprime un professeur
    public function destroy(Teacher $teacher)
    {
        // Supprime la photo si elle existe
        if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
            Storage::disk('public')->delete($teacher->photo);
        }

        $teacher->delete();
        
        return redirect()->route('index-teacher')
            ->with('success', 'Enseignant supprimé avec succès.');
    }

    // Recherche des professeurs
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $teachers = Teacher::where('school_id', Auth::guard('web')->user()->id)
            ->where(function($q) use ($query) {
                $q->where('first_name', 'LIKE', "%{$query}%")
                  ->orWhere('last_name', 'LIKE', "%{$query}%")
                  ->orWhere('email', 'LIKE', "%{$query}%")
                  ->orWhere('subject', 'LIKE', "%{$query}%");
            })
            ->paginate(10);
                
        return view('teachers.index', compact('teachers', 'query'));
    }

    // Exporte la liste des professeurs en CSV
    public function export()
    {
        $filename = "teachers-" . date('Y-m-d') . ".csv";
        $handle = fopen('php://temp', 'w+');
        
        // En-têtes du CSV
        fputcsv($handle, [
            'ID', 'Prénom', 'Nom', 'Email', 'Téléphone',
            'Genre', 'Nationalité', 'Années d\'expérience', 'Matière'
        ]);
    
        // Données filtrées par école
        $teachers = Teacher::where('school_id', Auth::guard('web')->user()->id)->get();
    
        foreach ($teachers as $teacher) {
            fputcsv($handle, [
                $teacher->id,
                $teacher->first_name,
                $teacher->last_name,
                $teacher->email,
                $teacher->phone_number,
                $teacher->gender,
                $teacher->nationality,
                $teacher->seniority,
                $teacher->subject
            ]);
        }
    
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);
    
        return response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename={$filename}");
    }

    // Filtre les professeurs par matière
    public function filterBySubject($subject)
    {
        $teachers = Teacher::where('school_id', Auth::guard('web')->user()->id)
            ->where('subject', $subject)
            ->orderBy('last_name', 'asc')
            ->paginate(10);
                
        return view('teachers.index', compact('teachers', 'subject'));
    }

    // Active/désactive un professeur
    public function toggleStatus(Teacher $teacher)
    {
        $teacher->update(['is_active' => !$teacher->is_active]);
        
        $status = $teacher->is_active ? 'activé' : 'désactivé';
        return redirect()->back()
            ->with('success', "Le statut de l'enseignant a été {$status}.");
    }
}