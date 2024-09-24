<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment; // Modèle Payment
use App\Models\ClassModel; // Modèle ClassModel
use App\Models\Student; // Modèle Student
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller 
{
    // Affiche le formulaire d'enregistrement des paiements
    public function create()
    {
        $classes = ClassModel::all(); // Récupérer toutes les classes
        $students = Student::all(); // Récupérer tous les élèves

        return view('payments.create', compact('classes', 'students'));
    }
    
    // Récupère les élèves d'une classe donnée
    public function getStudentsByClass(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:class_models,id',
        ]);

        $students = Student::where('class_id', $request->class_id)->get();
        return response()->json($students);
    }

    // Enregistre un nouveau paiement
    public function store(Request $request)
    {
        try {
            // Valider les données entrantes
            $validated = $request->validate([
                'class_id' => 'required|exists:class_models,id',
                'student_id' => 'required|exists:students,id',
                'amount_due' => 'required|numeric',
                'amount_paid' => 'required|numeric',
            ]);

            // Calculer le solde
            $balance = $validated['amount_due'] - $validated['amount_paid'];

            // Enregistrer le paiement
            Payment::create([
                'student_id' => $validated['student_id'],
                'amount_due' => $validated['amount_due'],
                'amount_paid' => $validated['amount_paid'],
                'balance' => $balance,
                'is_paid_off' => $balance == 0,
            ]);

            return redirect()->route('payment-list')->with('success', 'Paiement enregistré avec succès.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors('Une erreur est survenue lors de l\'enregistrement.');
        }
    }

    // Affiche la liste des paiements
    public function index()
    {
        $payments = Payment::with('class', 'student')->get(); // Charge les relations
        return view('payments.index', compact('payments'));
    }

    // Affiche les détails d'un paiement spécifique
    public function show($id)
    {
        $payment = Payment::with('student')->findOrFail($id); // Récupérer le paiement avec l'élève associé
        return view('payments.detail', compact('payment'));
    }
}
