<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller 
{
    public function create()
    {
        $classes = ClassModel::all(); 
        $students = Student::all(); 

        return view('payments.create', compact('classes', 'students'));
    }


    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'class_id' => 'required|exists:class_models,id',
                'student_id' => 'required|exists:students,id',
                'amount_due' => 'required|numeric',
                'amount_paid' => 'required|numeric',
            ]);

            // Vérifier le dernier paiement pour obtenir le solde actuel
            $lastPayment = Payment::where('student_id', $validated['student_id'])->orderBy('created_at', 'desc')->first();

            $currentBalance = $lastPayment ? $lastPayment->remaining_balance : $validated['amount_due'];

            if ($validated['amount_paid'] > $currentBalance) {
                return back()->withErrors('Le montant payé ne peut pas dépasser le solde dû. Solde actuel: ' . $currentBalance);
            }

            // Calculer le nouveau solde après le paiement
            $newBalance = $currentBalance - $validated['amount_paid'];

            // Créer un nouveau paiement
            Payment::create([
                'student_id' => $validated['student_id'],
                'amount_due' => $validated['amount_due'],
                'amount_paid' => $validated['amount_paid'],
                'remaining_balance' => $newBalance,
            ]);

            return redirect()->route('payment-list')->with('success', 'Paiement enregistré avec succès.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors('Une erreur est survenue lors de l\'enregistrement.');
        }
    }
    

    public function index()
    {
        $payments = Payment::with('class', 'student')->paginate(10);

        return view('payments.index', compact('payments'));
    }

    public function show($id)
    {
        $payment = Payment::with('student')->findOrFail($id);
        return view('payments.show', compact('payment'));
    }
}
