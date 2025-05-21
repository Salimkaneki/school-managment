<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('components.app.admin_sidebar')
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Créer un établissement</h3>
                            <p class="mb-0">Formulaire de création d'une nouvelle école</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-0">

            <div class="row my-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('schools.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Informations générales -->
                                <h5 class="mb-4">Informations générales</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nom de l'établissement</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Type d'établissement</label>
                                        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                            <option value="">Sélectionner...</option>
                                            <option value="École primaire" {{ old('type') == 'École primaire' ? 'selected' : '' }}>École primaire</option>
                                            <option value="Collège" {{ old('type') == 'Collège' ? 'selected' : '' }}>Collège</option>
                                            <option value="Lycée" {{ old('type') == 'Lycée' ? 'selected' : '' }}>Lycée</option>
                                            <option value="École professionnelle" {{ old('type') == 'École professionnelle' ? 'selected' : '' }}>École professionnelle</option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Informations pédagogiques -->
                                <h5 class="mb-4 mt-5">Informations pédagogiques</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Langues enseignées</label>
                                        <select name="languages[]" class="form-select @error('languages') is-invalid @enderror" multiple required>
                                            <option value="Anglais" {{ in_array('Anglais', old('languages', [])) ? 'selected' : '' }}>Anglais</option>
                                            <option value="Espagnol" {{ in_array('Espagnol', old('languages', [])) ? 'selected' : '' }}>Espagnol</option>
                                            <option value="Allemand" {{ in_array('Allemand', old('languages', [])) ? 'selected' : '' }}>Allemand</option>
                                            <option value="Italien" {{ in_array('Italien', old('languages', [])) ? 'selected' : '' }}>Italien</option>
                                        </select>
                                        @error('languages')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Effectif du personnel enseignant</label>
                                        <input type="number" name="teaching_staff_count" class="form-control @error('staff_count') is-invalid @enderror" value="{{ old('staff_count') }}" required>
                                        @error('staff_count')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Identifiants de connexion -->
                                <h5 class="mb-4 mt-5">Identifiants de connexion</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nom d'utilisateur</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Mot de passe</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Contact -->
                                <h5 class="mb-4 mt-5">Coordonnées</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Téléphone principal</label>
                                        <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Localisation -->
                                <h5 class="mb-4 mt-5">Localisation</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Adresse</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Ville</label>
                                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Code postal</label>
                                        <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" value="{{ old('postal_code') }}" required>
                                        @error('postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Équipements essentiels -->
                                <h5 class="mb-4 mt-5">Équipements</h5>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="has_sports_equipment" id="sportif" {{ old('has_sports_equipment') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sportif">Équipements sportifs</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="has_library" id="bibliotheque" {{ old('has_library') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="bibliotheque">Bibliothèque/CDI</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="has_computer_room" id="informatique" {{ old('has_computer_room') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="informatique">Salle informatique</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="has_handicap_access" id="pmr" {{ old('has_handicap_access') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="pmr">Accessibilité PMR</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Documents administratifs -->
                                <h5 class="mb-4 mt-5">Documents administratifs</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Règlement intérieur</label>
                                        <input type="file" name="rules_document" class="form-control @error('rules_document') is-invalid @enderror" required>
                                        @error('rules_document')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Projet d'établissement</label>
                                        <input type="file" name="project_document" class="form-control @error('project_document') is-invalid @enderror" required>
                                        @error('project_document')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Logo de l'établissement</label>
                                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Boutons -->
                                <div class="d-flex justify-content-end mt-5">
                                    <button type="button" class="btn btn-secondary me-2">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>