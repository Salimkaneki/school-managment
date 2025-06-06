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
                                        <i class="fas fa-plus-circle me-2 text-primary"></i>Créer une Nouvelle Salle de Classe
                                    </h6>
                                    <p class="text-sm text-muted mb-0">Veuillez remplir les informations ci-dessous</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('list-classrooms') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-list me-2"></i> Liste des Salles de Classe
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

                            <form action="{{ route('store-classroom') }}" method="POST">
                                @csrf

                                <div class="row g-3">

                                <div class="col-md-6">
    <label for="academic_year_id" class="form-label">
        <i class="fas fa-calendar-alt me-2 text-primary"></i>Année Académique
    </label>
    <select 
        class="form-select @error('academic_year_id') is-invalid @enderror" 
        id="academic_year_id" 
        name="academic_year_id" 
        required
    >
        <option value="" selected disabled>Choisissez une année académique</option>
        @foreach($academicYears as $year)
            <option 
                value="{{ $year->id }}"
                {{ old('academic_year_id') == $year->id ? 'selected' : '' }}
            >
                {{ $year->start_year }}-{{ $year->end_year }}
                @if($year->is_active) (Active) @endif
            </option>
        @endforeach
    </select>
    @error('academic_year_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-door-open me-2 text-primary"></i>Nom de la Salle
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('name') is-invalid @enderror" 
                                            id="name" 
                                            name="name" 
                                            placeholder="Entrez le nom de la salle" 
                                            value="{{ old('name') }}"
                                            required
                                        >
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="capacity" class="form-label">
                                            <i class="fas fa-users me-2 text-primary"></i>Capacité
                                        </label>
                                        <input 
                                            type="number" 
                                            class="form-control @error('capacity') is-invalid @enderror" 
                                            id="capacity" 
                                            name="capacity" 
                                            placeholder="Entrez la capacité de la salle" 
                                            value="{{ old('capacity') }}"
                                            required
                                        >
                                        @error('capacity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="class_model_id" class="form-label">
                                            <i class="fas fa-school me-2 text-primary"></i>Classe Associée
                                        </label>
                                        <select 
                                            class="form-select @error('class_model_id') is-invalid @enderror" 
                                            id="class_model_id" 
                                            name="class_model_id" 
                                            required
                                        >
                                            <option value="" selected disabled>Choisissez une classe</option>
                                            @foreach($classes as $class)
                                                <option 
                                                    value="{{ $class->id }}"
                                                    {{ old('class_model_id') == $class->id ? 'selected' : '' }}
                                                >
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('class_model_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 d-flex justify-content-end gap-2 mt-3">
                                        <a href="{{ route('list-classrooms') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-2"></i>Annuler
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Créer la Salle
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