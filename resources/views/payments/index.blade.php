<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des Paiements</h6>
                                    <p class="text-sm">Voici la liste des paiements effectués.</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" class="me-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Retour</span>
                                    </a>
                                    <a href="{{ route('make-payment') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Ajouter un Paiement</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 py-0">
                            @if($payments->isEmpty())
                                <div class="text-center py-2">
                                    <p class="font-weight-semibold text-lg mb-0">Aucun paiement enregistré</p>
                                </div>
                            @else
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0 table-bordered text-center">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Élève</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Montant dû</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Montant payé</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Solde</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">État</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Date</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Mode de paiement</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($payments as $payment)
                                                <tr>
                                                    <td class="text-sm font-weight-semibold">{{ $payment->student->last_name }} {{ $payment->student->first_name }}</td>
                                                    <td class="text-sm">{{ number_format($payment->amount_due, 2) }} XoF</td>
                                                    <td class="text-sm">{{ number_format($payment->amount_paid, 2) }} XoF</td>
                                                    <td class="text-sm">{{ number_format($payment->balance, 2) }} XoF</td>
                                                    <td class="text-sm">{{ $payment->balance == 0 ? 'Payé en totalité' : 'Partiellement payé' }}</td>
                                                    <td class="text-sm">{{ $payment->payment_date ? $payment->payment_date->format('d/m/Y') : 'Date non spécifiée' }}</td>
                                                    <td class="text-sm">{{ $payment->payment_method ?? 'Non spécifié' }}</td>
                                                    <td class="align-middle text-center">
                                                        <a href="#" class="text-secondary font-weight-bold text-xs me-2" title="Voir">Voir</a>
                                                        <form action="# method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="javascript:void(0);" class="text-danger font-weight-bold text-xs" title="Supprimer" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer ce paiement ?')) { this.closest('form').submit(); }">Supprimer</a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination personnalisée -->
                                <div class="border-top py-3 px-3 d-flex align-items-center">
                                    <!-- Bouton Previous -->
                                    @if ($payments->onFirstPage())
                                        <button class="btn btn-sm btn-white d-sm-block d-none mb-0" disabled>Précédent</button>
                                    @else
                                        <a href="{{ $payments->previousPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0">Précédent</a>
                                    @endif

                                    <!-- Pagination -->
                                    <nav aria-label="Pagination" class="ms-auto">
                                        <ul class="pagination pagination-light mb-0">
                                            @foreach ($payments->links()->elements[0] as $page => $url)
                                                @if ($page == $payments->currentPage())
                                                    <li class="page-item active" aria-current="page">
                                                        <span class="page-link font-weight-bold">{{ $page }}</span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link border-0 font-weight-bold" href="{{ $url }}">{{ $page }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </nav>

                                    <!-- Bouton Next -->
                                    @if ($payments->hasMorePages())
                                        <a href="{{ $payments->nextPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto">Suivant</a>
                                    @else
                                        <button class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto" disabled>Suivant</button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
