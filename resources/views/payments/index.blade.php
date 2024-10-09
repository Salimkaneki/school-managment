<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-12 mb-4">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des Paiements</h6>
                                    <p class="text-sm">Détails des paiements effectués.</p>
                                </div>
                                <div class="ms-auto">
                                    <a href="{{ route('make-payment') }}" class="btn btn-primary">Ajouter un Paiement</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100 text-center">
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Élève</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Montant dû</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Montant payé</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Solde</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">État</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Date</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Mode de paiement</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                        <tr>
                                            <td class="align-middle bg-transparent border-bottom text-xs">{{ $payment->student->last_name }} {{ $payment->student->first_name }}</td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">{{ number_format($payment->amount_due, 2) }} XoF</td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">{{ number_format($payment->amount_paid, 2) }} XoF</td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">{{ number_format($payment->balance, 2) }} XoF</td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">{{ $payment->balance == 0 ? 'Payé en totalité' : 'Partiellement payé' }}</td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">{{ $payment->payment_date ? $payment->payment_date->format('d/m/Y') : 'Date non spécifiée' }}</td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">{{ $payment->payment_method ?? 'Non spécifié' }}</td>
                                            <td class="text-center align-middle bg-transparent border-bottom text-xs">
                                                <a href="{{ route('detail-payment', $payment->id) }}" class="btn btn-link text-primary">Détails</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
