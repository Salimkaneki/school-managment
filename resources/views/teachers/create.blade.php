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
                                        <i class="fas fa-plus-circle me-2 text-primary"></i>Ajouter un Professeur
                                    </h6>
                                    <p class="text-sm text-muted mb-0">Veuillez remplir les informations ci-dessous</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('index-teacher') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-list me-2"></i> Liste des Professeurs
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

                            <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">
                                            <i class="fas fa-user me-2 text-primary"></i>Prénom
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('first_name') is-invalid @enderror" 
                                            id="first_name" 
                                            name="first_name" 
                                            placeholder="Entrez le prénom" 
                                            value="{{ old('first_name') }}"
                                            required
                                        >
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="last_name" class="form-label">
                                            <i class="fas fa-user me-2 text-primary"></i>Nom de famille
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('last_name') is-invalid @enderror" 
                                            id="last_name" 
                                            name="last_name" 
                                            placeholder="Entrez le nom de famille" 
                                            value="{{ old('last_name') }}"
                                            required
                                        >
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope me-2 text-primary"></i>Email
                                        </label>
                                        <input 
                                            type="email" 
                                            class="form-control @error('email') is-invalid @enderror" 
                                            id="email" 
                                            name="email" 
                                            placeholder="Entrez l'email" 
                                            value="{{ old('email') }}"
                                            required
                                        >
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label">
                                            <i class="fas fa-phone me-2 text-primary"></i>Téléphone
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('phone_number') is-invalid @enderror" 
                                            id="phone_number" 
                                            name="phone_number" 
                                            placeholder="Entrez le numéro de téléphone" 
                                            value="{{ old('phone_number') }}"
                                        >
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="gender" class="form-label">
                                            <i class="fas fa-venus-mars me-2 text-primary"></i>Genre
                                        </label>
                                        <select 
                                            class="form-select @error('gender') is-invalid @enderror" 
                                            id="gender" 
                                            name="gender" 
                                            required
                                        >
                                            <option value="" selected disabled>Choisissez un genre</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Masculin</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Féminin</option>
                                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="nationality" class="form-label">
                                            <i class="fas fa-globe me-2 text-primary"></i>Nationalité
                                        </label>
                                        <select 
                                            class="form-select @error('nationality') is-invalid @enderror" 
                                            id="nationality" 
                                            name="nationality" 
                                            required
                                        >
                                            <option value="" disabled selected>Choisissez une nationalité</option>
                                            <option value="Togo" {{ old('nationality') == 'Togo' ? 'selected' : '' }}>Togo</option>
                                            <option value="Bénin" {{ old('nationality') == 'Bénin' ? 'selected' : '' }}>Bénin</option>
                                            <option value="Cameroun" {{ old('nationality') == 'Cameroun' ? 'selected' : '' }}>Cameroun</option>
                                            <option value="Ghana" {{ old('nationality') == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                            <option value="Sénégal" {{ old('nationality') == 'Sénégal' ? 'selected' : '' }}>Sénégal</option>
                                        </select>
                                        @error('nationality')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="seniority" class="form-label">
                                            <i class="fas fa-briefcase me-2 text-primary"></i>Années d'expérience
                                        </label>
                                        <input 
                                            type="number" 
                                            class="form-control @error('seniority') is-invalid @enderror" 
                                            id="seniority" 
                                            name="seniority" 
                                            placeholder="Entrez les années d'expérience" 
                                            value="{{ old('seniority') }}"
                                        >
                                        @error('seniority')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="subject" class="form-label">
                                            <i class="fas fa-book me-2 text-primary"></i>Matière enseignée
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('subject') is-invalid @enderror" 
                                            id="subject" 
                                            name="subject" 
                                            placeholder="Entrez la matière enseignée" 
                                            value="{{ old('subject') }}"
                                            required
                                        >
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="photo" class="form-label">
                                            <i class="fas fa-image me-2 text-primary"></i>Photo
                                        </label>
                                        <input 
                                            type="file" 
                                            class="form-control @error('photo') is-invalid @enderror" 
                                            id="photo" 
                                            name="photo" 
                                            accept="image/*"
                                        >
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 d-flex justify-content-end gap-2 mt-3">
                                        <a href="{{ route('index-teacher') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-2"></i>Annuler
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Ajouter
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