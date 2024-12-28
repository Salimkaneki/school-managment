<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid px-4 py-4">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="pb-0 card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="mb-0">Modifier un Paiement</h6>
                                    <p class="text-sm mb-0">Modification du paiement #{{ str_pad($paymentData['id'], 6, '0', STR_PAD_LEFT) }}</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('payment-list') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Paiements
                                    </a>
                                </div>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mx-4 mt-4" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mx-4 mt-4" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-body px-4 py-4">
                            <!-- Informations de l'étudiant -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="p-3 border rounded">
                                        <h6 class="mb-3 font-weight-bold">Informations de l'élève</h6>
                                        <p class="mb-1">
                                            <span class="text-muted">Nom complet:</span>
                                            <strong>{{ $paymentData['student']->last_name }} {{ $paymentData['student']->first_name }}</strong>
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-muted">Classe:</span>
                                            <strong>{{ $paymentData['class']->name }}</strong>
                                        </p>
                                        <p class="mb-0">
                                            <span class="text-muted">Date du paiement:</span>
                                            <strong>{{ $paymentData['created_at'] }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 border rounded">
                                        <h6 class="mb-3 font-weight-bold">Récapitulatif du paiement</h6>
                                        <p class="mb-1">
                                            <span class="text-muted">Montant total dû:</span>
                                            <strong>{{ number_format($paymentData['amount_due'], 0, ',', ' ') }} XOF</strong>
                                        </p>
                                        <p class="mb-1">
                                            <span class="text-muted">Paiements précédents:</span>
                                            <strong>{{ number_format($paymentData['previous_payments'], 0, ',', ' ') }} XOF</strong>
                                        </p>
                                        <p class="mb-0">
                                            <span class="text-muted">Solde actuel:</span>
                                            <strong>{{ number_format($paymentData['remaining_balance'], 0, ',', ' ') }} XOF</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('payment.update', $paymentData['id']) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="amount_paid" class="form-label">Montant payé</label>
                                        <input type="number" 
                                               step="0.01" 
                                               class="form-control @error('amount_paid') is-invalid @enderror" 
                                               id="amount_paid" 
                                               name="amount_paid"
                                               value="{{ old('amount_paid', $paymentData['amount_paid']) }}"
                                               required>
                                        @error('amount_paid')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="remaining_balance" class="form-label">Solde restant</label>
                                        <input type="number" 
                                               step="0.01" 
                                               class="form-control" 
                                               id="remaining_balance" 
                                               name="remaining_balance"
                                               value="{{ old('remaining_balance', $paymentData['remaining_balance']) }}"
                                               readonly>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('payment-list') }}" class="btn btn-light border">Annuler</a>
                                    <button type="submit" class="btn btn-dark">Mettre à jour</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>

    <script>
        // Calcul automatique du solde restant
        document.getElementById('amount_paid').addEventListener('input', function() {
            const amountDue = {{ $paymentData['amount_due'] }};
            const previousPayments = {{ $paymentData['previous_payments'] }};
            const currentPayment = parseFloat(this.value) || 0;
            
            // Calcul du nouveau solde
            const remainingBalance = Math.max(0, amountDue - previousPayments - currentPayment);
            document.getElementById('remaining_balance').value = remainingBalance.toFixed(2);
        });
    </script>
</x-app-layout>