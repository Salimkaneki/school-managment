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
                                    <h6 class="mb-0">Modifier un Professeur</h6>
                                    <p class="text-sm mb-0">Modification des informations de {{ $teacher->first_name }} {{ $teacher->last_name }}</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('teacher.index', $teacher) }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-arrow-left me-2"></i> Liste des professeurs
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('teacher.update', $teacher) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="row mb-4">
                                    <!-- Photo actuelle -->
                                    <div class="col-md-12 text-center mb-3">
                                        @if($teacher->photo)
                                            <img src="{{ Storage::url($teacher->photo) }}" 
                                                 alt="Photo actuelle"
                                                 class="img-fluid rounded-circle mb-2"
                                                 style="width: 150px; height: 150px; object-fit: cover;">
                                            <p class="text-sm text-muted">Photo actuelle</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">Prénom</label>
                                        <input type="text" 
                                               class="form-control @error('first_name') is-invalid @enderror" 
                                               id="first_name" 
                                               name="first_name" 
                                               value="{{ old('first_name', $teacher->first_name) }}" 
                                               required>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="last_name" class="form-label">Nom de famille</label>
                                        <input type="text" 
                                               class="form-control @error('last_name') is-invalid @enderror" 
                                               id="last_name" 
                                               name="last_name" 
                                               value="{{ old('last_name', $teacher->last_name) }}" 
                                               required>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $teacher->email) }}" 
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label">Téléphone</label>
                                        <input type="text" 
                                               class="form-control @error('phone_number') is-invalid @enderror" 
                                               id="phone_number" 
                                               name="phone_number" 
                                               value="{{ old('phone_number', $teacher->phone_number) }}">
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="gender" class="form-label">Genre</label>
                                        <select class="form-control @error('gender') is-invalid @enderror" 
                                                id="gender" 
                                                name="gender" 
                                                required>
                                            <option value="male" {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>Masculin</option>
                                            <option value="female" {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>Féminin</option>
                                            <option value="other" {{ old('gender', $teacher->gender) == 'other' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nationality" class="form-label">Nationalité</label>
                                        <select class="form-control @error('nationality') is-invalid @enderror" 
                                                id="nationality" 
                                                name="nationality">
                                            <option value="" disabled {{ old('nationality', $teacher->nationality) ? '' : 'selected' }}>Choisissez une nationalité</option>
                                            <option value="Togo" {{ old('nationality', $teacher->nationality) == 'Togo' ? 'selected' : '' }}>Togo</option>
                                            <option value="Bénin" {{ old('nationality', $teacher->nationality) == 'Bénin' ? 'selected' : '' }}>Bénin</option>
                                            <option value="Cameroun" {{ old('nationality', $teacher->nationality) == 'Cameroun' ? 'selected' : '' }}>Cameroun</option>
                                            <option value="Ghana" {{ old('nationality', $teacher->nationality) == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                            <option value="Sénégal" {{ old('nationality', $teacher->nationality) == 'Sénégal' ? 'selected' : '' }}>Sénégal</option>
                                        </select>
                                        @error('nationality')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="seniority" class="form-label">Années d'expérience</label>
                                        <input type="number" 
                                               class="form-control @error('seniority') is-invalid @enderror" 
                                               id="seniority" 
                                               name="seniority" 
                                               value="{{ old('seniority', $teacher->seniority) }}">
                                        @error('seniority')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="marital_status" class="form-label">Statut matrimonial</label>
                                        <select class="form-control @error('marital_status') is-invalid @enderror" 
                                                id="marital_status" 
                                                name="marital_status">
                                            <option value="" disabled {{ old('marital_status', $teacher->marital_status) ? '' : 'selected' }}>Choisissez un statut</option>
                                            <option value="single" {{ old('marital_status', $teacher->marital_status) == 'single' ? 'selected' : '' }}>Célibataire</option>
                                            <option value="married" {{ old('marital_status', $teacher->marital_status) == 'married' ? 'selected' : '' }}>Marié(e)</option>
                                            <option value="divorced" {{ old('marital_status', $teacher->marital_status) == 'divorced' ? 'selected' : '' }}>Divorcé(e)</option>
                                            <option value="widowed" {{ old('marital_status', $teacher->marital_status) == 'widowed' ? 'selected' : '' }}>Veuf(ve)</option>
                                        </select>
                                        @error('marital_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="birthday" class="form-label">Date de naissance</label>
                                        <input type="date" 
                                               class="form-control @error('birthday') is-invalid @enderror" 
                                               id="birthday" 
                                               name="birthday" 
                                               value="{{ old('birthday', $teacher->birthday) }}">
                                        @error('birthday')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Adresse</label>
                                        <input type="text" 
                                               class="form-control @error('address') is-invalid @enderror" 
                                               id="address" 
                                               name="address" 
                                               value="{{ old('address', $teacher->address) }}">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="subject" class="form-label">Matière enseignée</label>
                                        <input type="text" 
                                               class="form-control @error('subject') is-invalid @enderror" 
                                               id="subject" 
                                               name="subject" 
                                               value="{{ old('subject', $teacher->subject) }}" 
                                               required>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
    <div class="col-md-12">
        <label for="academic_year_id" class="form-label">Année académique</label>
        <select class="form-control @error('academic_year_id') is-invalid @enderror" 
                id="academic_year_id" 
                name="academic_year_id" 
                required>
            <option value="" disabled>Choisissez une année académique</option>
            @foreach($academicYears as $year)
                <option value="{{ $year->id }}" 
                    {{ old('academic_year_id', $teacher->academic_year_id) == $year->id ? 'selected' : '' }}>
                    {{ $year->name }}
                </option>
            @endforeach
        </select>
        @error('academic_year_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="photo" class="form-label">
                                            Nouvelle photo
                                            <small class="text-muted">(Laissez vide pour conserver l'image actuelle)</small>
                                        </label>
                                        <input type="file" 
                                               class="form-control @error('photo') is-invalid @enderror" 
                                               id="photo" 
                                               name="photo" 
                                               accept="image/*">
                                        @error('photo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end gap-2">
                                        <a href="{{ route('teacher.show', $teacher) }}" class="btn btn-secondary">Annuler</a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i> Enregistrer les modifications
                                        </button>
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
