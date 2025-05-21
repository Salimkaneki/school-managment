<!-- resources/views/time-slots/create.blade.php -->
<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <h6 class="mb-0">Créer un Nouveau Créneau Horaire</h6>
                            <p class="text-sm mb-0">Définissez un nouveau créneau pour les emplois du temps</p>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="{{ route('time-slots.store') }}" method="POST">
                                @csrf
                                
                                <!-- Heure de début -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="start_time" class="form-label">Heure de Début</label>
                                        <input type="time" 
                                               class="form-control @error('start_time') is-invalid @enderror" 
                                               id="start_time" 
                                               name="start_time" 
                                               value="{{ old('start_time') }}" 
                                               required>
                                        @error('start_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Heure de fin -->
                                    <div class="col-md-6">
                                        <label for="end_time" class="form-label">Heure de Fin</label>
                                        <input type="time" 
                                               class="form-control @error('end_time') is-invalid @enderror" 
                                               id="end_time" 
                                               name="end_time" 
                                               value="{{ old('end_time') }}" 
                                               required>
                                        @error('end_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Statut du créneau -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   id="is_active" 
                                                   name="is_active" 
                                                   checked>
                                            <label class="form-check-label" for="is_active">
                                                Créneau Actif
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Boutons d'action -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary me-2">
                                            <i class="fas fa-save me-1"></i> Enregistrer le Créneau
                                        </button>
                                        <a href="{{ route('time-slots.index') }}" class="btn btn-secondary">
                                            <i class="fas fa-times me-1"></i> Annuler
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>