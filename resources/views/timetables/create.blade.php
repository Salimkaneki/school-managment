<x-app-layout>
    <main class="main-content">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="card shadow-sm border-light rounded-4">
                <div class="card-header bg-white border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1 text-dark">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>Créer un Nouvel Emploi du Temps
                            </h6>
                            <p class="text-sm text-muted mb-0">Configurez l'emploi du temps pour votre classe</p>
                        </div>
                        <a href="{{ route('timetables.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i>Liste des Emplois du Temps
                        </a>
                    </div>
                </div>
                <div class="card-body px-4 py-4">
                    @if ($errors->any())
                        <div class="alert alert-light alert-dismissible fade show mb-4" role="alert">
                            <strong class="text-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation
                            </strong>
                            <ul class="text-dark ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('timetables.store') }}" method="POST" id="timetableForm">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="class_id" class="form-label">
                                        <i class="fas fa-graduation-cap me-2 text-primary"></i>Classe
                                    </label>
                                    <select 
                                        class="form-select @error('class_id') is-invalid @enderror" 
                                        name="class_id" 
                                        id="class_id" 
                                        required
                                        data-placeholder="Sélectionnez une classe"
                                    >
                                        <option value="" disabled selected>Choisissez une classe</option>
                                        @foreach($classes as $class)
                                            <option 
                                                value="{{ $class->id }}"
                                                {{ old('class_id') == $class->id ? 'selected' : '' }}
                                            >
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="classroom_id" class="form-label">
                                        <i class="fas fa-door-open me-2 text-primary"></i>Salle de Classe
                                    </label>
                                    <select 
                                        class="form-select @error('classroom_id') is-invalid @enderror" 
                                        name="classroom_id" 
                                        id="classroom_id" 
                                        required
                                        data-placeholder="Sélectionnez une salle"
                                    >
                                        <option value="" disabled selected>Choisissez une salle</option>
                                        @foreach($classrooms as $classroom)
                                            <option 
                                                value="{{ $classroom->id }}"
                                                {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}
                                            >
                                                {{ $classroom->name }} ({{ $classroom->capacity }} places)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('classroom_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="form-label">
                                        <i class="fas fa-comment-dots me-2 text-primary"></i>Description (Optionnel)
                                    </label>
                                    <textarea 
                                        class="form-control" 
                                        name="description" 
                                        id="description" 
                                        rows="3" 
                                        placeholder="Informations supplémentaires sur l'emploi du temps"
                                    >{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12 d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('timetables.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Annuler
                                </a>
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    <i class="fas fa-save me-2"></i>Créer l'Emploi du Temps
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('timetableForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function() {
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Création...';
        submitBtn.disabled = true;
    });
});
</script>