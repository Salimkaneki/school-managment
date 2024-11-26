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
                                    <h6 class="mb-1 text-dark"><i class="fas fa-plus-circle me-2 text-primary"></i>Créer un Nouveau Cours</h6>
                                    <p class="text-sm text-muted mb-0">Veuillez remplir les informations ci-dessous</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('course-list') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-list me-2"></i> Liste des Cours
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            @if ($errors->any())
                                <div class="alert alert-light alert-dismissible fade show" role="alert">
                                    <strong class="text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation</strong>
                                    <ul class="text-dark">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('store-course') }}" method="POST">
                                @csrf

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-tag me-2 text-primary"></i>Nom du Cours
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('name') is-invalid @enderror" 
                                            id="name" 
                                            name="name" 
                                            placeholder="Entrez le nom du cours" 
                                            value="{{ old('name') }}"
                                            required
                                        >
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="teacher_id" class="form-label">
                                            <i class="fas fa-chalkboard-teacher me-2 text-primary"></i>Professeur
                                        </label>
                                        <select 
                                            class="form-select @error('teacher_id') is-invalid @enderror" 
                                            id="teacher_id" 
                                            name="teacher_id" 
                                            required
                                        >
                                            <option value="" selected disabled>Choisissez un professeur</option>
                                            @foreach($teachers as $teacher)
                                                <option 
                                                    value="{{ $teacher->id }}"
                                                    {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}
                                                >
                                                    {{ $teacher->first_name }} {{ $teacher->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('teacher_id')
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
                                            placeholder="Décrivez brièvement le cours"
                                        >{{ old('description') }}</textarea>
                                    </div>

                                    <div class="col-md-12 d-flex justify-content-end gap-2 mt-3">
                                        <a href="{{ route('course-list') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-2"></i>Annuler
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Créer le Cours
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
</x-app-layout>