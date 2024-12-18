<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // public function create()
    // {
    //     $classes = ClassModel::all();
    //     $students = Student::with(['payments' => function($query) {
    //         $query->latest();
    //     }])->get()->map(function($student) {
    //         return [
    //             'id' => $student->id,
    //             'first_name' => $student->first_name,
    //             'last_name' => $student->last_name,
    //             'class_id' => $student->class_id,
    //             'previous_payment' => $student->payments->sum('amount_paid'),
    //             'remaining_balance' => $student->payments->first() ? 
    //                 $student->payments->first()->remaining_balance : 
    //                 $student->class->fees ?? 0
    //         ];
    //     });

    //     return view('payments.create', compact('classes', 'students'));
    // }

    public function create()
    {
        $classes = ClassModel::all();
        $students = Student::with(['payments' => function($query) {
            $query->latest();
        }, 'class'])->get()->map(function($student) {
            // Calculer le total des paiements précédents
            $totalPreviousPaid = $student->payments->sum('amount_paid');
            
            // Calculer le solde restant
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

    //         $validated = $request->validate([
    //             'class_id' => 'required|exists:class_models,id',
    //             'student_id' => 'required|exists:students,id',
    //             'amount_due' => 'required|numeric|min:0',
    //             'amount_paid' => 'required|numeric|min:0',
    //             'remaining_balance' => 'required|numeric|min:0'
    //         ]);

    //         // Vérifier si l'étudiant existe et appartient à la classe
    //         $student = Student::where('id', $validated['student_id'])
    //                         ->where('class_id', $validated['class_id'])
    //                         ->firstOrFail();

    //         // Récupérer le dernier paiement
    //         $lastPayment = Payment::where('student_id', $validated['student_id'])
    //                             ->latest()
    //                             ->first();

    //         $currentBalance = $lastPayment ? 
    //             $lastPayment->remaining_balance : 
    //             $validated['amount_due'];

    //         // Vérifications de cohérence
    //         if ($validated['amount_paid'] > $currentBalance) {
    //             throw new \Exception('Le montant payé ne peut pas dépasser le solde dû.');
    //         }

    //         // Créer le paiement
    //         $payment = Payment::create([
    //             'student_id' => $validated['student_id'],
    //             'amount_due' => $validated['amount_due'],
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

            $validated = $request->validate([
                'class_id' => 'required|exists:class_models,id',
                'student_id' => 'required|exists:students,id',
                'total_fees' => 'required|numeric|min:0',
                'total_previous_paid' => 'required|numeric|min:0',
                'amount_paid' => 'required|numeric|min:0',
                'remaining_balance' => 'required|numeric|min:0'
            ]);

            // Vérifier si l'étudiant existe et appartient à la classe
            $student = Student::where('id', $validated['student_id'])
                            ->where('class_id', $validated['class_id'])
                            ->firstOrFail();

            // Calculer le solde restant exact
            $totalPreviousPaid = Payment::where('student_id', $validated['student_id'])->sum('amount_paid');
            $currentBalance = $validated['total_fees'] - $totalPreviousPaid;

            // Vérifications de cohérence
            if ($validated['amount_paid'] > $currentBalance) {
                throw new \Exception('Le montant payé ne peut pas dépasser le solde restant.');
            }

            // Créer le paiement
            $payment = Payment::create([
                'student_id' => $validated['student_id'],
                'amount_due' => $validated['total_fees'],
                'amount_paid' => $validated['amount_paid'],
                'remaining_balance' => $validated['remaining_balance']
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
        $payments = Payment::with(['student.class'])
            ->latest()
            ->paginate(10);

        return view('payments.index', compact('payments'));
    }

    public function edit($id)
    {
        try {
            $payment = Payment::with('student.class')->findOrFail($id);
            $classes = ClassModel::all();
            
            // Récupérer les informations de paiement pour l'étudiant
            $studentPayments = Payment::where('student_id', $payment->student_id)
                                    ->where('created_at', '<', $payment->created_at)
                                    ->latest()
                                    ->get();

            $previousPayments = $studentPayments->sum('amount_paid');

            // Préparer les données pour la vue
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

            $payment = Payment::findOrFail($id);

            $validated = $request->validate([
                'amount_paid' => [
                    'required',
                    'numeric',
                    'min:0',
                    function ($attribute, $value, $fail) use ($payment) {
                        // Vérifier si le nouveau montant est cohérent
                        $totalPaid = Payment::where('student_id', $payment->student_id)
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
                                        ->where('id', '!=', $payment->id)
                                        ->sum('amount_paid'));

            if (abs($newRemainingBalance - $validated['remaining_balance']) > 0.01) {
                throw new \Exception('Le calcul du solde restant est incorrect.');
            }

            // Mettre à jour le paiement
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
}