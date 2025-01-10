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
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2 dropdown-toggle" type="button" id="actionMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="btn-inner--icon">
                                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                    <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                </svg>
                                            </span>
                                            <span class="btn-inner--text">Actions</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="actionMenu">
                                            <a href="#" class="dropdown-item">Voir les Paiements par Classe</a>
                                            <a href="#" class="dropdown-item">Gérer les Emplois du Temps</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 py-0">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if($payments->isEmpty())
                                <div class="text-center py-4">
                                    <p class="font-weight-semibold text-lg mb-0">Aucun paiement enregistré</p>
                                </div>
                            @else
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0 table-bordered text-center">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Élève</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Classe</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Montant dû</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Montant payé</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Solde restant</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">État</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Date</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($payments as $payment)
                                                <tr>
                                                    <td class="text-sm font-weight-semibold">
                                                        {{ $payment->student->last_name }} {{ $payment->student->first_name }}
                                                    </td>
                                                    <td class="text-sm">
                                                        {{ $payment->student->class->name ?? 'Non spécifiée' }}
                                                    </td>
                                                    <td class="text-sm">
                                                        {{ number_format($payment->amount_due, 2) }} XOF
                                                    </td>
                                                    <td class="text-sm">
                                                        {{ number_format($payment->amount_paid, 2) }} XOF
                                                    </td>
                                                    <td class="text-sm">
                                                        {{ number_format($payment->remaining_balance, 2) }} XOF
                                                    </td>
                                                    <td class="text-sm">
                                                        @if($payment->remaining_balance == 0)
                                                            <span style="background-color: #198754; color: white; padding: 2px 8px; border-radius: 3px; font-weight: 500; font-size: 12px;">
                                                                Payé en totalité
                                                            </span>
                                                        @elseif($payment->remaining_balance == $payment->amount_due)
                                                            <span style="background-color: #dc3545; color: white; padding: 2px 8px; border-radius: 3px; font-weight: 500; font-size: 12px;">
                                                                Aucun paiement
                                                            </span>
                                                        @else
                                                            <span style="background-color: #ffc107; color: white; padding: 2px 8px; border-radius: 3px; font-weight: 500; font-size: 12px;">
                                                                Partiellement payé
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-sm">
                                                        {{ $payment->created_at ? $payment->created_at->format('d/m/Y') : 'Date non spécifiée' }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <button type="button" 
                                                                    class="btn btn-link text-primary px-3 mb-0"
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#paymentModal{{ $payment->id }}">
                                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M15.58 12C15.58 13.98 13.98 15.58 12 15.58C10.02 15.58 8.42001 13.98 8.42001 12C8.42001 10.02 10.02 8.42001 12 8.42001C13.98 8.42001 15.58 10.02 15.58 12Z" stroke="#007bff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M12 20.27C15.53 20.27 18.82 18.19 21.11 14.59C22.01 13.18 22.01 10.81 21.11 9.39997C18.82 5.79997 15.53 3.71997 12 3.71997C8.47003 3.71997 5.18003 5.79997 2.89003 9.39997C1.99003 10.81 1.99003 13.18 2.89003 14.59C5.18003 18.19 8.47003 20.27 12 20.27Z" stroke="#007bff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </button>
                                                            <a href="{{ route('payment.edit', $payment->id) }}" 
                                                               class="btn btn-link text-warning px-3 mb-0">
                                                                <svg width="14" height="14" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H0C0 15.5523 0.447715 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 0 11.9624 0 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99951 15V12.2279H0V15H1.99951ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z" fill="#FF8600"/>
                                                                </svg>
                                                            </a>
                                                            <form action="{{ route('payment.destroy', $payment->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="btn btn-link text-danger px-3 mb-0"
                                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement ?')">
                                                                    <svg width="14" height="14" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M1.98314 3.33333H14.0165" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        <path d="M12.3499 3.33333V14C12.3499 14.442 12.1744 14.8659 11.8619 15.1785C11.5493 15.4911 11.1254 15.6667 10.6833 15.6667H5.31661C4.87458 15.6667 4.45067 15.4911 4.13811 15.1785C3.82555 14.8659 3.64994 14.442 3.64994 14V3.33333M5.31661 3.33333V1.66667C5.31661 1.22464 5.49221 0.800716 5.80477 0.488155C6.11734 0.175595 6.54125 0 6.98327 0H8.99994C9.44196 0 9.86588 0.175595 10.1784 0.488155C10.491 0.800716 10.6666 1.22464 10.6666 1.66667V3.33333" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        <path d="M6.98327 7.33333V11.6667" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        <path d="M9.01661 7.33333V11.6667" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>

                                                        @foreach($payments as $payment)
                                                        <div class="modal fade" id="paymentModal{{ $payment->id }}" tabindex="-1">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content" style="border-radius: 12px;">
                                                                    <!-- Header stylisé -->
                                                                    <div class="modal-header px-3 pb-3 pt-3" style="background: linear-gradient(45deg, #2152ff, #21d4fd); border: none;">
                                                                        <div class="text-white">
                                                                            <h5 class="modal-title fw-bold mb-1">Détails du Paiement</h5>
                                                                            <small class="mb-0" style="opacity: 0.8;">Transaction #{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</small>
                                                                        </div>
                                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body p-3">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <!-- Section Étudiant -->
                                                                                <div class="d-flex align-items-center mb-3 p-2 h-100" style="background-color: #f8f9fa; border-radius: 8px;">
                                                                                    <div class="text-center me-2">
                                                                                        <div style="width: 40px; height: 40px; background: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                                                            <i class="fas fa-user-graduate" style="font-size: 16px; color: #2152ff;"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div>
                                                                                        <h6 class="fw-bold mb-0">{{ $payment->student->last_name }} {{ $payment->student->first_name }}</h6>
                                                                                        <small class="text-muted">
                                                                                            <i class="fas fa-graduation-cap me-1"></i> 
                                                                                            {{ $payment->student->class->name ?? 'Non spécifiée' }}
                                                                                        </small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Cartes de montants -->
                                                                            <div class="col-md-8">
                                                                                <div class="row g-2">
                                                                                    <!-- Montant dû -->
                                                                                    <div class="col-md-4">
                                                                                        <div class="h-100 p-2" style="background-color: #f8f9fa; border-radius: 8px;">
                                                                                            <div class="d-flex align-items-center mb-1">
                                                                                                <div style="width: 28px; height: 28px; background: #e3e6ed; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                                                                                    <i class="fas fa-file-invoice" style="color: #2152ff; font-size: 12px;"></i>
                                                                                                </div>
                                                                                                <div class="ms-2">
                                                                                                    <small class="text-muted">Montant dû</small>
                                                                                                </div>
                                                                                            </div>
                                                                                            <h6 class="fw-bold mb-0">{{ number_format($payment->amount_due, 0, ',', ' ') }} XOF</h6>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                    <!-- Montant payé -->
                                                                                    <div class="col-md-4">
                                                                                        <div class="h-100 p-2" style="background-color: #f8f9fa; border-radius: 8px;">
                                                                                            <div class="d-flex align-items-center mb-1">
                                                                                                <div style="width: 28px; height: 28px; background: #e3f6e4; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                                                                                    <i class="fas fa-check" style="color: #5cb85c; font-size: 12px;"></i>
                                                                                                </div>
                                                                                                <div class="ms-2">
                                                                                                    <small class="text-muted">Montant payé</small>
                                                                                                </div>
                                                                                            </div>
                                                                                            <h6 class="fw-bold mb-0">{{ number_format($payment->amount_paid, 0, ',', ' ') }} XOF</h6>
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Solde restant -->
                                                                                    <div class="col-md-4">
                                                                                        <div class="h-100 p-2" style="background-color: #f8f9fa; border-radius: 8px;">
                                                                                            <div class="d-flex align-items-center mb-1">
                                                                                                <div style="width: 28px; height: 28px; background: #fee6e3; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                                                                                    <i class="fas fa-exclamation" style="color: #dc3545; font-size: 12px;"></i>
                                                                                                </div>
                                                                                                <div class="ms-2">
                                                                                                    <small class="text-muted">Solde restant</small>
                                                                                                </div>
                                                                                            </div>
                                                                                            <h6 class="fw-bold mb-0">{{ number_format($payment->remaining_balance, 0, ',', ' ') }} XOF</h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Statut et Dates -->
                                                                        <div class="row g-2 mt-3">
                                                                            <!-- Statut -->
                                                                            <div class="col-md-6">
                                                                                <div class="p-2 h-100" style="background-color: #f8f9fa; border-radius: 8px;">
                                                                                    <h6 class="fw-bold mb-2 fs-7">Statut du paiement</h6>
                                                                                    @if($payment->remaining_balance == 0)
                                                                                        <div class="d-inline-block px-2 py-1" style="background-color: #dcf5e3; border-radius: 6px;">
                                                                                            <i class="fas fa-check-circle me-1" style="color: #2dce89; font-size: 12px;"></i>
                                                                                            <small style="color: #2dce89; font-weight: 600;">Payé en totalité</small>
                                                                                        </div>
                                                                                    @elseif($payment->remaining_balance == $payment->amount_due)
                                                                                        <div class="d-inline-block px-2 py-1" style="background-color: #fdd1d1; border-radius: 6px;">
                                                                                            <i class="fas fa-times-circle me-1" style="color: #dc3545; font-size: 12px;"></i>
                                                                                            <small style="color: #dc3545; font-weight: 600;">Aucun paiement</small>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="d-inline-block px-2 py-1" style="background-color: #fff3cd; border-radius: 6px;">
                                                                                            <i class="fas fa-clock me-1" style="color: #ffc107; font-size: 12px;"></i>
                                                                                            <small style="color: #ffc107; font-weight: 600;">Partiellement payé</small>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>

                                                                            <!-- Dates -->
                                                                            <div class="col-md-6">
                                                                                <div class="p-2 h-100" style="background-color: #f8f9fa; border-radius: 8px;">
                                                                                    <h6 class="fw-bold mb-2 fs-7">Informations temporelles</h6>
                                                                                    <div>
                                                                                        <small class="text-muted d-block mb-2">
                                                                                            <i class="far fa-calendar-alt me-1" style="color: #2152ff;"></i>
                                                                                            Date de paiement:
                                                                                            <span class="fw-bold">
                                                                                                {{ $payment->created_at ? $payment->created_at->format('d/m/Y') : 'Non spécifiée' }}
                                                                                            </span>
                                                                                        </small>
                                                                                        <small class="text-muted d-block">
                                                                                            <i class="far fa-clock me-1" style="color: #2152ff;"></i>
                                                                                            Dernière mise à jour:
                                                                                            <span class="fw-bold">
                                                                                                {{ $payment->updated_at ? $payment->updated_at->format('d/m/Y') : 'Non spécifiée' }}
                                                                                            </span>
                                                                                        </small>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer border-0 px-3 pb-3">
                                                                        <button type="button" class="btn btn-light btn-sm px-3" data-bs-dismiss="modal">
                                                                            <i class="fas fa-times me-1"></i>Fermer
                                                                        </button>
                                                                        <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn-sm text-white px-3" style="background: linear-gradient(45deg, #2152ff, #21d4fd);">
                                                                            <i class="fas fa-edit me-1"></i>Modifier
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
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
                                            @if($payments->lastPage() > 1)
                                                @for($i = 1; $i <= $payments->lastPage(); $i++)
                                                    <li class="page-item {{ $payments->currentPage() == $i ? 'active' : '' }}">
                                                        <a class="page-link border-0 font-weight-bold" href="{{ $payments->url($i) }}">
                                                            {{ $i }}
                                                        </a>
                                                    </li>
                                                @endfor
                                            @endif
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