<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid px-5 py-4">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <!-- Carte En-tête -->
                        <div class="card-header pb-0 text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h6 class="mb-1">Ajouter un Élève</h6>
                                    <p class="text-sm text-muted mb-0">Tous les champs marqués * sont obligatoires</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('student-list') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Élèves
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Messages de Feedback -->
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Erreur !</strong> Veuillez vérifier les informations saisies.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Section: Informations Académiques -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Informations Académiques</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="academic_year_id" class="form-label">Année académique *</label>
                                                <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                                                    <option value="" disabled selected>Sélectionnez une année académique</option>
                                                    @foreach ($academicYears as $academicYear)
                                                        <option value="{{ $academicYear->id }}" {{ old('academic_year_id') == $academicYear->id ? 'selected' : '' }}>
                                                            {{ $academicYear->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('academic_year_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="class_id" class="form-label">Classe *</label>
                                                    <select class="form-control" id="class_id" name="class_id" required>
                                                        <option value="" disabled selected>Sélectionnez une classe</option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="classroom_id" class="form-label">Salle de classe *</label>
                                                    <select class="form-control @error('classroom_id') is-invalid @enderror" 
                                                            id="classroom_id" 
                                                            name="classroom_id" 
                                                            required>
                                                        <option value="" disabled selected>Sélectionnez d'abord une classe</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section: Informations Personnelles -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Informations Personnelles</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="first_name" class="form-label">Prénom *</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" 
                                                       value="{{ old('first_name') }}" placeholder="Entrez le prénom" required>
                                                @error('first_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="last_name" class="form-label">Nom de famille *</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" 
                                                       value="{{ old('last_name') }}" placeholder="Entrez le nom de famille" required>
                                                @error('last_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="date_of_birth" class="form-label">Date de Naissance *</label>
                                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" 
                                                       value="{{ old('date_of_birth') }}" required>
                                                @error('date_of_birth')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="place_of_birth" class="form-label">Lieu de Naissance *</label>
                                                <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" 
                                                       value="{{ old('place_of_birth') }}" placeholder="Entrez le lieu de naissance" required>
                                                @error('place_of_birth')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="gender" class="form-label">Genre *</label>
                                                <select class="form-control" id="gender" name="gender" required>
                                                    <option value="" disabled selected>Choisissez un genre</option>
                                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Masculin</option>
                                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Féminin</option>
                                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Autre</option>
                                                </select>
                                                @error('gender')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="nationality" class="form-label">Nationalité *</label>
                                                <input type="text" class="form-control" id="nationality" name="nationality" 
                                                       value="{{ old('nationality') }}" placeholder="Entrez la nationalité" required>
                                                @error('nationality')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="previous_school_name" class="form-label">Nom de l'école précédente</label>
                                                <input type="text" class="form-control" id="previous_school_name" name="previous_school_name" 
                                                       value="{{ old('previous_school_name') }}" placeholder="Entrez le nom de l'école précédente">
                                                @error('previous_school_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section: Coordonnées -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Coordonnées</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Email *</label>
                                                <input type="email" class="form-control" id="email" name="email" 
                                                       value="{{ old('email') }}" placeholder="Entrez l'email" required>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="phone_number" class="form-label">Téléphone</label>
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" 
                                                       value="{{ old('phone_number') }}" placeholder="Entrez le numéro de téléphone">
                                                @error('phone_number')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="address" class="form-label">Adresse *</label>
                                                <input type="text" class="form-control" id="address" name="address" 
                                                       value="{{ old('address') }}" placeholder="Entrez l'adresse complète" required>
                                                @error('address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section: Photo et Contacts d'Urgence -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">Photo et Contacts d'Urgence</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="photo" class="form-label">Photo de l'élève</label>
                                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                                @error('photo')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="mt-3 text-center">
                                                    <img id="photo-preview" src="#" alt="Aperçu de la photo" 
                                                         style="display:none; max-width: 200px; max-height: 200px; object-fit: cover;">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h6>Contacts d'Urgence</h6>
                                                
                                                <!-- Contact Père/Tuteur -->
                                                <div class="mb-3">
                                                    <label class="form-label">Nom du Père | Tuteur</label>
                                                    <input type="text" class="form-control" name="emergency_contacts[0][name]" 
                                                           value="{{ old('emergency_contacts.0.name') }}" placeholder="Nom du Père | Tuteur">
                                                    <label class="form-label mt-2">Téléphone du Père | Tuteur</label>
                                                    <input type="text" class="form-control" name="emergency_contacts[0][phone]" 
                                                           value="{{ old('emergency_contacts.0.phone') }}" placeholder="Téléphone du Père | Tuteur">
                                                    <label class="form-label mt-2">Email du Père | Tuteur</label>
                                                    <input type="email" class="form-control" name="father_email" 
                                                           value="{{ old('father_email') }}" placeholder="Email du Père | Tuteur">
                                                </div>

                                                <!-- Contact Mère/Tutrice -->
                                                <div class="mb-3">
                                                    <label class="form-label">Nom de la Mère | Tutrice</label>
                                                    <input type="text" class="form-control" name="emergency_contacts[1][name]" 
                                                           value="{{ old('emergency_contacts.1.name') }}" placeholder="Nom de la Mère | Tutrice">
                                                    <label class="form-label mt-2">Téléphone de la Mère | Tutrice</label>
                                                    <input type="text" class="form-control" name="emergency_contacts[1][phone]" 
                                                           value="{{ old('emergency_contacts.1.phone') }}" placeholder="Téléphone de la Mère | Tutrice">
                                                    <label class="form-label mt-2">Email de la Mère | Tutrice</label>
                                                    <input type="email" class="form-control" name="mother_email" 
                                                           value="{{ old('mother_email') }}" placeholder="Email de la Mère | Tutrice">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Boutons d'action -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-dark">Enregistrer</button>
                                    <button type="reset" class="btn btn-outline-secondary ms-2">Réinitialiser</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Script pour l'aperçu de la photo -->
    <script>
        document.getElementById('photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photo-preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const classSelect = document.getElementById('class_id');
            const classroomSelect = document.getElementById('classroom_id');

            classSelect.addEventListener('change', function() {
                const classId = this.value;
                classroomSelect.disabled = true;
                classroomSelect.innerHTML = '<option value="">Chargement des salles...</option>';

                if (classId) {
                    fetch(`/getClassrooms/${classId}`)
                        .then(response => response.json())
                        .then(data => {
                            classroomSelect.innerHTML = '<option value="">Sélectionnez une salle</option>';
                            
                            data.forEach(classroom => {
                                // Ne pas afficher les salles pleines
                                if (classroom.available_seats > 0) {
                                    const option = document.createElement('option');
                                    option.value = classroom.id;
                                    option.textContent = `${classroom.name} (Places disponibles: ${classroom.available_seats}/${classroom.capacity})`;
                                    classroomSelect.appendChild(option);
                                }
                            });
                            
                            classroomSelect.disabled = false;
                        })
                        .catch(error => {
                            console.error('Erreur:', error);
                            classroomSelect.innerHTML = '<option value="">Erreur de chargement des salles</option>';
                            classroomSelect.disabled = true;
                        });
                } else {
                    classroomSelect.innerHTML = '<option value="">Sélectionnez d\'abord une classe</option>';
                    classroomSelect.disabled = true;
                }
            });
        });
    </script>
</x-app-layout>

