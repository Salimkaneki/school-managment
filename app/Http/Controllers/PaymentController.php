<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function create()
    {
        $schoolId = Auth::id();
        
        // Récupérer uniquement les classes de l'école
        $classes = ClassModel::where('school_id', $schoolId)->get();
        
        // Récupérer les élèves avec leurs paiements et leur classe
        $students = Student::with(['payments', 'class'])
            ->where('school_id', $schoolId)
            ->get()
            ->map(function($student) {
                $totalPreviousPaid = $student->payments->sum('amount_paid');
                $classFees = $student->class->fees ?? 0;
                $remainingBalance = max(0, $classFees - $totalPreviousPaid);

                return [
                    'id' => $student->id,
                    'first_name' => $student->first_name,
                    'last_name' => $student->last_name,
                    'class_id' => $student->class_id,
                    'class_name' => $student->class->name,
                    'total_fees' => $classFees,
                    'total_previous_paid' => $totalPreviousPaid,
                    'remaining_balance' => $remainingBalance
                ];
            });

        return view('payments.create', compact('classes', 'students'));
    }

    // public function store(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $schoolId = Auth::id();

    //         $validated = $request->validate([
    //             'class_id' => 'required|exists:class_models,id',
    //             'student_id' => 'required|exists:students,id',
    //             'total_fees' => 'required|numeric|min:0',
    //             'total_previous_paid' => 'required|numeric|min:0',
    //             'amount_paid' => 'required|numeric|min:0',
    //             'remaining_balance' => 'required|numeric|min:0'
    //         ]);

    //         // Vérifier si l'étudiant existe, appartient à la classe et à l'école
    //         $student = Student::where('id', $validated['student_id'])
    //                         ->where('class_id', $validated['class_id'])
    //                         ->where('school_id', $schoolId)
    //                         ->firstOrFail();

    //         // Calculer le solde restant exact
    //         $totalPreviousPaid = Payment::where('student_id', $validated['student_id'])
    //                                   ->where('school_id', $schoolId)
    //                                   ->sum('amount_paid');
    //         $currentBalance = $validated['total_fees'] - $totalPreviousPaid;

    //         if ($validated['amount_paid'] > $currentBalance) {
    //             throw new \Exception('Le montant payé ne peut pas dépasser le solde restant.');
    //         }

    //         // Créer le paiement avec school_id
    //         $payment = Payment::create([
    //             'student_id' => $validated['student_id'],
    //             'school_id' => $schoolId,
    //             'amount_due' => $validated['total_fees'],
    //             'amount_paid' => $validated['amount_paid'],
    //             'remaining_balance' => $validated['remaining_balance']
    //         ]);

    //         DB::commit();
    //         return redirect()
    //             ->route('payment-list')
    //             ->with('success', 'Paiement enregistré avec succès.');

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error('Erreur lors de l\'enregistrement du paiement: ' . $e->getMessage());
    //         return back()
    //             ->withInput()
    //             ->withErrors(['error' => $e->getMessage()]);
    //     }
    // }

    public function store(Request $request)
{
    try {
        DB::beginTransaction();

        $schoolId = Auth::id();

        // Modifions la validation
        $validated = $request->validate([
            'class_id' => 'required|exists:class_models,id',
            'student_id' => 'required|exists:students,id',
            'total_fees' => 'required|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0',
            'remaining_balance' => 'nullable|numeric|min:0' // Rendu optionnel car calculé
        ]);

        // Vérifier si l'étudiant existe, appartient à la classe et à l'école
        $student = Student::where('id', $validated['student_id'])
                        ->where('class_id', $validated['class_id'])
                        ->where('school_id', $schoolId)
                        ->firstOrFail();

        // Calculer le total déjà payé
        $totalPreviousPaid = Payment::where('student_id', $validated['student_id'])
                                  ->where('school_id', $schoolId)
                                  ->sum('amount_paid');

        // Calculer le solde restant
        $currentBalance = $validated['total_fees'] - $totalPreviousPaid;

        if ($validated['amount_paid'] > $currentBalance) {
            throw new \Exception('Le montant payé ne peut pas dépasser le solde restant.');
        }

        // Calculer le nouveau solde restant
        $remainingBalance = $currentBalance - $validated['amount_paid'];

        // Créer le paiement avec school_id
        $payment = Payment::create([
            'student_id' => $validated['student_id'],
            'school_id' => $schoolId,
            'amount_due' => $validated['total_fees'],
            'amount_paid' => $validated['amount_paid'],
            'remaining_balance' => $remainingBalance
        ]);

        DB::commit();
        return redirect()
            ->route('payment-list')
            ->with('success', 'Paiement enregistré avec succès.');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Erreur lors de l\'enregistrement du paiement: ' . $e->getMessage());
        return back()
            ->withInput()
            ->withErrors(['error' => $e->getMessage()]);
    }
}

    public function index()
    {
        $schoolId = Auth::id();
        $payments = Payment::with(['student.class'])
            ->where('school_id', $schoolId)
            ->latest()
            ->paginate(10);

        return view('payments.index', compact('payments'));
    }

    public function edit($id)
    {
        try {
            $schoolId = Auth::id();
            $payment = Payment::with('student.class')
                            ->where('school_id', $schoolId)
                            ->findOrFail($id);
            
            $classes = ClassModel::where('school_id', $schoolId)->get();
            
            // Récupérer les informations de paiement pour l'étudiant
            $studentPayments = Payment::where('student_id', $payment->student_id)
                                    ->where('school_id', $schoolId)
                                    ->where('created_at', '<', $payment->created_at)
                                    ->latest()
                                    ->get();

            $previousPayments = $studentPayments->sum('amount_paid');

            $paymentData = [
                'id' => $payment->id,
                'student' => $payment->student,
                'class' => $payment->student->class,
                'amount_due' => $payment->amount_due,
                'amount_paid' => $payment->amount_paid,
                'previous_payments' => $previousPayments,
                'remaining_balance' => $payment->remaining_balance,
                'created_at' => $payment->created_at->format('d/m/Y')
            ];

            return view('payments.edit', compact('paymentData', 'classes'));

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'édition du paiement: ' . $e->getMessage());
            return redirect()
                ->route('payment-list')
                ->withErrors(['error' => 'Paiement introuvable ou inaccessible.']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $schoolId = Auth::id();
            $payment = Payment::where('school_id', $schoolId)->findOrFail($id);

            $validated = $request->validate([
                'amount_paid' => [
                    'required',
                    'numeric',
                    'min:0',
                    function ($attribute, $value, $fail) use ($payment, $schoolId) {
                        // Vérifier si le nouveau montant est cohérent
                        $totalPaid = Payment::where('student_id', $payment->student_id)
                                          ->where('school_id', $schoolId)
                                          ->where('id', '!=', $payment->id)
                                          ->sum('amount_paid') + $value;

                        if ($totalPaid > $payment->amount_due) {
                            $fail('Le total des paiements ne peut pas dépasser le montant dû.');
                        }
                    },
                ],
                'remaining_balance' => 'required|numeric|min:0'
            ]);

            // Vérifier la cohérence du solde restant
            $newRemainingBalance = $payment->amount_due - 
                                 ($validated['amount_paid'] + 
                                  Payment::where('student_id', $payment->student_id)
                                        ->where('school_id', $schoolId)
                                        ->where('id', '!=', $payment->id)
                                        ->sum('amount_paid'));

            if (abs($newRemainingBalance - $validated['remaining_balance']) > 0.01) {
                throw new \Exception('Le calcul du solde restant est incorrect.');
            }

            $payment->update([
                'amount_paid' => $validated['amount_paid'],
                'remaining_balance' => $validated['remaining_balance']
            ]);

            DB::commit();
            return redirect()
                ->route('payment-list')
                ->with('success', 'Paiement mis à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la mise à jour du paiement: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $schoolId = Auth::id();
            $payment = Payment::where('school_id', $schoolId)->findOrFail($id);
            $payment->delete();

            DB::commit();

            return redirect()
                ->route('payment-list')
                ->with('success', 'Paiement supprimé avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la suppression du paiement: ' . $e->getMessage());
            return back()
                ->withErrors(['error' => 'Une erreur est survenue lors de la suppression du paiement.']);
        }
    }

    public function getStudentsByClass($classId)
    {
        $schoolId = Auth::id();
        
        $students = Student::with(['payments', 'class'])
            ->where('school_id', $schoolId)
            ->where('class_id', $classId)
            ->get()
            ->map(function($student) {
                $totalPreviousPaid = $student->payments->sum('amount_paid');
                $classFees = $student->class->fees ?? 0;
                $remainingBalance = max(0, $classFees - $totalPreviousPaid);

                return [
                    'id' => $student->id,
                    'first_name' => $student->first_name,
                    'last_name' => $student->last_name,
                    'total_fees' => $classFees,
                    'total_previous_paid' => $totalPreviousPaid,
                    'remaining_balance' => $remainingBalance
                ];
            });

        return response()->json($students);
    }
}