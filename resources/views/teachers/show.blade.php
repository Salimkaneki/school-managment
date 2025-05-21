<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="pb-0 card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h6 class="mb-0">Détails du Professeur</h6>
                                    <p class="text-sm mb-0">Informations complètes</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('teacher.index') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Professeurs
                                    </a>
                                    <a href="#" class="btn btn-primary ms-2">
                                        <i class="fas fa-edit me-2"></i> Modifier
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <div class="row">
                                <!-- Photo du professeur -->
                                <div class="col-md-3 text-center mb-4">
                                    @if($teacher->photo)
                                        <img src="{{ Storage::url($teacher->photo) }}" 
                                             alt="Photo de {{ $teacher->first_name }}"
                                             class="img-fluid rounded-circle"
                                             style="width: 200px; height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                             style="width: 200px; height: 200px;">
                                            <i class="fas fa-user fa-4x text-secondary"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Informations du professeur -->
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-sm text-uppercase text-muted mb-1">Prénom</h6>
                                            <p class="mb-0">{{ $teacher->first_name }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-sm text-uppercase text-muted mb-1">Nom</h6>
                                            <p class="mb-0">{{ $teacher->last_name }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-sm text-uppercase text-muted mb-1">Email</h6>
                                            <p class="mb-0">{{ $teacher->email }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-sm text-uppercase text-muted mb-1">Téléphone</h6>
                                            <p class="mb-0">{{ $teacher->phone_number ?? 'Non renseigné' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-sm text-uppercase text-muted mb-1">Genre</h6>
                                            <p class="mb-0">
                                                @switch($teacher->gender)
                                                    @case('male')
                                                        Masculin
                                                        @break
                                                    @case('female')
                                                        Féminin
                                                        @break
                                                    @default
                                                        Autre
                                                @endswitch
                                            </p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-sm text-uppercase text-muted mb-1">Nationalité</h6>
                                            <p class="mb-0">{{ $teacher->nationality ?? 'Non renseignée' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-sm text-uppercase text-muted mb-1">Années d'expérience</h6>
                                            <p class="mb-0">{{ $teacher->seniority ?? '0' }} an(s)</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-sm text-uppercase text-muted mb-1">Matière enseignée</h6>
                                            <p class="mb-0">{{ $teacher->subject }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-sm text-uppercase text-muted mb-1">Statut</h6>
                                            <p class="mb-0">
                                                @if($teacher->is_active)
                                                    <span class="badge bg-success">Actif</span>
                                                @else
                                                    <span class="badge bg-danger">Inactif</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>