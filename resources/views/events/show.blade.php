<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="pb-0 card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="mb-0">Détails de l'Événement</h6>
                                    <p class="text-sm mb-0">Informations complètes sur l'événement</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('event.list') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Événements
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h5 class="font-weight-bolder mb-3">{{ $event->title }}</h5>
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                                    <span>Date de l'événement : {{ $event->event_date->format('d/m/Y') }}</span>
                                                </div>
                                                <div class="d-flex align-items-center mb-3">
                                                    <i class="fas fa-clock text-primary me-2"></i>
                                                    <span>Créé le : {{ $event->created_at->format('d/m/Y H:i') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <h6 class="font-weight-bolder mb-3">Description</h6>
                                                <p class="text-sm">{{ $event->description ?? 'Aucune description disponible' }}</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <a href="{{ route('event.list') }}" class="btn btn-secondary me-2">
                                                    Retour
                                                </a>
                                                <a href="edit-event" class="btn btn-primary me-2">
                                                    <i class="fas fa-edit me-2"></i> Modifier
                                                </a>
                                                <form action="{{ route('event.delete', $event->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">
                                                        <i class="fas fa-trash-alt me-2"></i> Supprimer
                                                    </button>
                                                </form>
                                            </div>
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