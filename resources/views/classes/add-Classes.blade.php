<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 12px;">
                        <div class="card-header bg-white pb-0 pt-3 border-0">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h6 class="mb-1 text-dark">
                                        <i class="fas fa-plus-circle me-2 text-primary"></i>Créer une Nouvelle Classe
                                    </h6>
                                    <p class="text-sm text-muted mb-0">Veuillez remplir les informations ci-dessous</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('class-list') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-list me-2"></i> Liste des Classes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            @if ($errors->any())
                                <div class="alert alert-light alert-dismissible fade show" role="alert">
                                    <strong class="text-danger">
                                        <i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation
                                    </strong>
                                    <ul class="text-dark">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('store-class') }}" method="POST">
                                @csrf

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-tag me-2 text-primary"></i>Nom de la Classe
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('name') is-invalid @enderror" 
                                            id="name" 
                                            name="name" 
                                            placeholder="Entrez le nom de la classe" 
                                            value="{{ old('name') }}"
                                            required
                                        >
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="fees" class="form-label">
                                            <i class="fas fa-money-bill-wave me-2 text-primary"></i>Frais de Scolarité
                                        </label>
                                        <input 
                                            type="number" 
                                            class="form-control @error('fees') is-invalid @enderror" 
                                            id="fees" 
                                            name="fees" 
                                            placeholder="Entrez les frais de scolarité" 
                                            step="0.01" 
                                            value="{{ old('fees') }}"
                                            required
                                        >
                                        @error('fees')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="description" class="form-label">
                                            <i class="fas fa-comment-dots me-2 text-primary"></i>Description (Optionnel)
                                        </label>
                                        <textarea 
                                            class="form-control" 
                                            id="description" 
                                            name="description" 
                                            rows="3" 
                                            placeholder="Décrivez brièvement la classe"
                                        >{{ old('description') }}</textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <h6 class="mt-3 mb-3 text-dark">
                                            <i class="fas fa-school me-2 text-primary"></i>Salles de Classe
                                        </h6>
                                        <div id="classrooms-container">
                                            <!-- Première Salle de Classe -->
                                            <div class="classroom-entry mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="classroom_name_1" class="form-label">
                                                            <i class="fas fa-door-open me-2 text-primary"></i>Nom de la Salle
                                                        </label>
                                                        <input 
                                                            type="text" 
                                                            class="form-control" 
                                                            id="classroom_name_1" 
                                                            name="classrooms[0][name]" 
                                                            placeholder="Entrez le nom de la salle" 
                                                            required
                                                        >
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="classroom_capacity_1" class="form-label">
                                                            <i class="fas fa-users me-2 text-primary"></i>Capacité
                                                        </label>
                                                        <input 
                                                            type="number" 
                                                            class="form-control" 
                                                            id="classroom_capacity_1" 
                                                            name="classrooms[0][capacity]" 
                                                            placeholder="Entrez la capacité de la salle" 
                                                            required
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button 
                                            type="button" 
                                            class="btn btn-sm btn-primary" 
                                            onclick="addClassroomEntry()"
                                        >
                                            <i class="fas fa-plus me-2"></i>Ajouter une Salle
                                        </button>
                                    </div>

                                    <div class="col-md-12 d-flex justify-content-end gap-2 mt-3">
                                        <a href="{{ route('class-list') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-2"></i>Annuler
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Créer la Classe
                                        </button>
                                    </div>
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
        let classroomIndex = 1;

        function addClassroomEntry() {
            const container = document.getElementById('classrooms-container');
            const entry = document.createElement('div');
            entry.className = 'classroom-entry mb-3';
            entry.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <label for="classroom_name_${classroomIndex}" class="form-label">
                            <i class="fas fa-door-open me-2 text-primary"></i>Nom de la Salle
                        </label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="classroom_name_${classroomIndex}" 
                            name="classrooms[${classroomIndex}][name]" 
                            placeholder="Entrez le nom de la salle" 
                            required
                        >
                    </div>
                    <div class="col-md-6">
                        <label for="classroom_capacity_${classroomIndex}" class="form-label">
                            <i class="fas fa-users me-2 text-primary"></i>Capacité
                        </label>
                        <input 
                            type="number" 
                            class="form-control" 
                            id="classroom_capacity_${classroomIndex}" 
                            name="classrooms[${classroomIndex}][capacity]" 
                            placeholder="Entrez la capacité de la salle" 
                            required
                        >
                    </div>
                </div>
            `;
            container.appendChild(entry);
            classroomIndex++;
        }
    </script>
</x-app-layout>