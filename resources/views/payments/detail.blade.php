<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 mb-4">
                    <div class="card border shadow-xs" style="border-radius: 8px;">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-md-8 col-9">
                                    <h6 class="mb-0 font-weight-semibold text-lg">Reçu de Paiement</h6>
                                    <p class="text-sm mb-1">Détails du paiement effectué.</p>
                                </div>
                                <div class="col-md-4 col-3 text-end">
                                    <button type="button" class="btn btn-white btn-icon px-2 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pt-0 pb-1 text-sm">
                                            <span class="text-secondary">Élève:</span> &nbsp; {{ $payment->student->name }}
                                        </li>
                                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                            <span class="text-secondary">Montant dû:</span> &nbsp; {{ number_format($payment->amount_due, 2) }}
                                        </li>
                                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                            <span class="text-secondary">Montant payé:</span> &nbsp; {{ number_format($payment->amount_paid, 2) }}
                                        </li>
                                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                            <span class="text-secondary">Solde:</span> &nbsp; {{ number_format($payment->balance, 2) }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                            <span class="text-secondary">État:</span> &nbsp; 
                                            @if($payment->balance == 0)
                                                Payé en totalité
                                            @else
                                                Partiellement payé
                                            @endif
                                        </li>
                                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                            <span class="text-secondary">Date:</span> &nbsp; 
                                            {{ $payment->payment_date ? $payment->payment_date->format('d/m/Y') : 'Date non spécifiée' }}
                                        </li>

                                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                            <span class="text-secondary">Mode de paiement:</span> &nbsp; {{ $payment->payment_method ?? 'Non spécifié' }}
                                        </li>
                                        <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                            <span class="text-secondary">Commentaires:</span> &nbsp; {{ $payment->comments ?? 'Aucun commentaire' }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <a href="{{ route('payment-list') }}" class="btn btn-outline-secondary ms-2">Retour à la liste</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
