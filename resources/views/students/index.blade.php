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
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des Élèves</h6>
                                    <p class="text-sm">Voici la liste de tous les élèves</p>
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
                                        <a href="{{ route('create-student') }}" class="dropdown-item">Ajouter un Élève</a>
                                        <a href="{{ route('show-students-by-class') }}" class="dropdown-item">Élèves par Classe</a>
                                        <a href="{{ route('attendances.create') }}" class="dropdown-item">Enregistrer une Absence</a>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 py-0">
                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($students->isEmpty())
                                <div class="text-center py-2">
                                    <p class="font-weight-semibold text-lg mb-0">Aucun élève enregistré</p>
                                </div>
                            @else
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0 table-bordered">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-3">Prénom et Nom</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Contacts</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Classe</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                @if($student->photo)
                                                                    <img src="{{ Storage::url($student->photo) }}" 
                                                                        class="avatar avatar-sm rounded-circle me-2"
                                                                        alt="Photo de {{ $student->first_name }}">
                                                                @else
                                                                    <img src="{{ asset('images/default-avatar.png') }}" 
                                                                        class="avatar avatar-sm rounded-circle me-2"
                                                                        alt="Photo par défaut">
                                                                @endif
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm font-weight-semibold">{{ $student->last_name }} {{ $student->first_name }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <p class="text-sm text-dark font-weight-semibold mb-0">{{ $student->phone_number }}</p>
                                                        <span class="text-secondary text-sm font-weight-normal">{{ $student->email }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-sm font-weight-normal">
                                                            {{ $student->classModel ? $student->classModel->name : 'Non assigné' }}
                                                        </span>
                                                        <br>
                                                        <span class="text-secondary text-sm font-weight-normal">
                                                            {{ $student->academicYear->name ?? 'Aucune année' }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <!-- Bouton Voir -->
                                                            <button type="button" 
                                                                    class="btn btn-link text-primary px-3 mb-0"
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#studentModal{{ $student->id }}">
                                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M15.58 12C15.58 13.98 13.98 15.58 12 15.58C10.02 15.58 8.42001 13.98 8.42001 12C8.42001 10.02 10.02 8.42001 12 8.42001C13.98 8.42001 15.58 10.02 15.58 12Z" stroke="#007bff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M12 20.27C15.53 20.27 18.82 18.19 21.11 14.59C22.01 13.18 22.01 10.81 21.11 9.39997C18.82 5.79997 15.53 3.71997 12 3.71997C8.47003 3.71997 5.18003 5.79997 2.89003 9.39997C1.99003 10.81 1.99003 13.18 2.89003 14.59C5.18003 18.19 8.47003 20.27 12 20.27Z" stroke="#007bff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </button>

                                                            <!-- Bouton Modifier -->
                                                            <a href="{{ route ('edit-students', $student->id)}}" 
                                                               class="btn btn-link text-warning px-3 mb-0">
                                                                <svg width="14" height="14" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H0C0 15.5523 0.447715 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 0 11.9624 0 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99951 15V12.2279H0V15H1.99951ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z" fill="#FF8600"/>
                                                                </svg>
                                                            </a>

                                                            <!-- Bouton Supprimer -->
                                                            <form action="{{ route('student.delete', $student->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="btn btn-link text-danger px-3 mb-0"
                                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')">
                                                                    <svg width="14" height="14" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M1.98314 3.33333H14.0165" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        <path d="M12.3499 3.33333V14C12.3499 14.442 12.1744 14.8659 11.8619 15.1785C11.5493 15.4911 11.1254 15.6667 10.6833 15.6667H5.31661C4.87458 15.6667 4.45067 15.4911 4.13811 15.1785C3.82555 14.8659 3.64994 14.442 3.64994 14V3.33333M5.31661 3.33333V1.66667C5.31661 1.22464 5.49221 0.800716 5.80477 0.488155C6.11734 0.175595 6.54125 0 6.98327 0H8.99994C9.44196 0 9.86588 0.175595 10.1784 0.488155C10.491 0.800716 10.6666 1.22464 10.6666 1.66667V3.33333" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        <path d="M6.98327 7.33333V11.6667" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        <path d="M9.01661 7.33333V11.6667" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
 
                                                        <!-- Modal Détails Élève -->
                                                        <div class="modal fade" id="studentModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-light">
                                                                        <h5 class="modal-title" style="color: #000;">Détails de l'Élève</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body p-4" style="overflow-y: hidden;">
                                                                        <div class="row g-4">
                                                                            <!-- Photo de l'élève et informations principales -->
                                                                            <div class="col-lg-4 text-center">
                                                                                @if($student->photo)
                                                                                    <img src="{{ Storage::url($student->photo) }}" 
                                                                                        alt="Photo de {{ $student->first_name }}" 
                                                                                        class="img-fluid rounded-circle border shadow-sm mb-3" 
                                                                                        style="width: 180px; height: 180px; object-fit: cover;">
                                                                                @else
                                                                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto border shadow-sm mb-3" 
                                                                                        style="width: 180px; height: 180px;">
                                                                                        <i class="fas fa-user fa-4x text-secondary opacity-50"></i>
                                                                                    </div>
                                                                                @endif
                                                                                <h4 class="mb-2" style="color: #000;">{{ $student->first_name }} {{ $student->last_name }}</h4>
                                                                                <div class="d-flex justify-content-center gap-2 flex-wrap mb-3">
                                                                                    <span class="badge" style="background-color: #E3F2FD; color: #1976D2; font-weight: 500; padding: 8px 12px;">
                                                                                        <i class="fas fa-graduation-cap me-1"></i> {{ $student->classModel->name ?? 'Non assigné' }}
                                                                                    </span>
                                                                                    <span class="badge" style="background-color: #E8F5E9; color: #2E7D32; font-weight: 500; padding: 8px 12px;">
                                                                                        <i class="fas fa-calendar-alt me-1"></i> {{ $student->academicYear->name ?? 'Non assigné' }}
                                                                                    </span>
                                                                                </div>
                                                                                
                                                                                @if($student->email)
                                                                                    <button class="btn btn-outline-primary btn-sm w-100 mb-2">
                                                                                        <i class="fas fa-envelope me-2"></i>{{ $student->email }}
                                                                                    </button>
                                                                                @endif
                                                                            </div>

                                                                            <!-- Informations détaillées -->
                                                                            <div class="col-lg-8">
                                                                                <div class="row g-4">
                                                                                    <!-- Informations personnelles -->
                                                                                    <div class="col-12">
                                                                                        <h6 class="border-bottom pb-2 mb-3" style="color: #000;">Informations personnelles</h6>
                                                                                        <div class="row g-3">
                                                                                            @php
                                                                                            $mainInfo = [
                                                                                                ['icon' => 'calendar', 'label' => 'Date de naissance', 'value' => $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') : 'Non renseigné'],
                                                                                                ['icon' => 'venus-mars', 'label' => 'Genre', 'value' => $student->gender == 'male' ? 'Masculin' : ($student->gender == 'female' ? 'Féminin' : 'Autre')],
                                                                                                ['icon' => 'globe', 'label' => 'Nationalité', 'value' => $student->nationality ?? 'Non renseignée'],
                                                                                                ['icon' => 'heart', 'label' => 'Statut matrimonial', 'value' => [
                                                                                                    'single' => 'Célibataire',
                                                                                                    'married' => 'Marié(e)',
                                                                                                    'divorced' => 'Divorcé(e)',
                                                                                                    'widowed' => 'Veuf(ve)'
                                                                                                ][$student->marital_status] ?? 'Non renseigné'],
                                                                                            ];
                                                                                            @endphp

                                                                                            @foreach($mainInfo as $info)
                                                                                                <div class="col-sm-6">
                                                                                                    <div class="d-flex align-items-center">
                                                                                                        <div class="flex-shrink-0">
                                                                                                            <span class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                                                                                <i class="fas fa-{{ $info['icon'] }} text-primary"></i>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <div class="flex-grow-1 ms-3">
                                                                                                            <small style="color: #000;">{{ $info['label'] }}</small>
                                                                                                            <div style="color: #000; font-weight: 500;">{{ $info['value'] }}</div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>

                                                                                    <!-- Coordonnées -->
                                                                                    <div class="col-12">
                                                                                        <h6 class="border-bottom pb-2 mb-3" style="color: #000;">Coordonnées</h6>
                                                                                        @if($student->address)
                                                                                            <div class="d-flex align-items-start mb-3">
                                                                                                <span class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 35px; height: 35px;">
                                                                                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                                                                                </span>
                                                                                                <div class="ms-3">
                                                                                                    <small style="color: #000;">Adresse</small>
                                                                                                    <div style="color: #000; font-weight: 500;">{{ $student->address }}</div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                        @if($student->phone_number)
                                                                                            <div class="d-flex align-items-center">
                                                                                                <span class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 35px; height: 35px;">
                                                                                                    <i class="fas fa-phone text-primary"></i>
                                                                                                </span>
                                                                                                <div class="ms-3">
                                                                                                    <small style="color: #000;">Téléphone</small>
                                                                                                    <div style="color: #000; font-weight: 500;">{{ $student->phone_number }}</div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>

                                                                                    <!-- Informations académiques -->
                                                                                    <div class="col-12">
                                                                                        <h6 class="border-bottom pb-2 mb-3" style="color: #000;">Informations académiques</h6>
                                                                                        <div class="row g-3">
                                                                                            <div class="col-sm-6">
                                                                                                <small style="color: #000;">Classe</small>
                                                                                                <div style="color: #000; font-weight: 500;">{{ $student->classModel->name ?? 'Non assigné' }}</div>
                                                                                            </div>
                                                                                            <div class="col-sm-6">
                                                                                                <small style="color: #000;">Année Académique</small>
                                                                                                <div style="color: #000; font-weight: 500;">{{ $student->academicYear->name ?? 'Non assigné' }}</div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-12">
                                                                                        <h6 class="border-bottom pb-2 mb-3" style="color: #000;">École précédente</h6>
                                                                                        <p class="text-sm">{{ $student->previous_school_name ?? 'Non renseigné' }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>

                        
                        <div class="border-top py-3 px-3 d-flex align-items-center">
                                <!-- Bouton Previous -->
                                @if ($students->onFirstPage())
                                    <button class="btn btn-sm btn-white d-sm-block d-none mb-0" disabled>Précédent</button>
                                @else
                                    <a href="{{ $students->previousPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0">Précédent</a>
                                @endif
                                
                                <!-- Pagination -->
                                <nav aria-label="Pagination" class="ms-auto">
                                    <ul class="pagination pagination-light mb-0">
                                        @foreach ($students->links()->elements[0] as $page => $url)
                                            @if ($page == $students->currentPage())
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
                                @if ($students->hasMorePages())
                                    <a href="{{ $students->nextPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto">Suivant</a>
                                @else
                                    <button class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto" disabled>Suivant</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>
</x-app-layout>