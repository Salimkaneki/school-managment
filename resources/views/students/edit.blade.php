<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid px-5 py-4">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header pb-0 text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h6 class="mb-1">Modifier un Élève</h6>
                                    <p class="text-sm text-muted mb-0">Tous les champs marqués * sont obligatoires</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('student-list') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Élèves
                                    </a>
                                </div>
                            </div>
                        </div>

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

                            <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

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
                                                    <option value="" disabled>Sélectionnez une année académique</option>
                                                    @foreach ($academicYears as $academicYear)
                                                        <option value="{{ $academicYear->id }}" {{ $student->academic_year_id == $academicYear->id ? 'selected' : '' }}>
                                                            {{ $academicYear->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('academic_year_id')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="class_id" class="form-label">Classe *</label>
                                                <select class="form-control" id="class_id" name="class_id" required>
                                                    <option value="" disabled>Sélectionnez une classe</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>
                                                            {{ $class->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('class_id')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="classroom_id" class="form-label">Salle de classe *</label>
                                                <select class="form-control @error('classroom_id') is-invalid @enderror" id="classroom_id" name="classroom_id" required>
                                                    <option value="" disabled>Sélectionnez une salle de classe</option>
                                                    @foreach ($classrooms as $classroom)
                                                        <option value="{{ $classroom->id }}" {{ $student->classroom_id == $classroom->id ? 'selected' : '' }}>
                                                            {{ $classroom->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('classroom_id')<div class="text-danger">{{ $message }}</div>@enderror
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
                                                    value="{{ $student->first_name }}" required>
                                                @error('first_name')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="last_name" class="form-label">Nom de famille *</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" 
                                                    value="{{ $student->last_name }}" required>
                                                @error('last_name')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="date_of_birth" class="form-label">Date de Naissance *</label>
                                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" 
                                                    value="{{ $student->date_of_birth }}" required>
                                                @error('date_of_birth')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="place_of_birth" class="form-label">Lieu de Naissance *</label>
                                                <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" 
                                                    value="{{ $student->place_of_birth }}" required>
                                                @error('place_of_birth')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="gender" class="form-label">Genre *</label>
                                                <select class="form-control" id="gender" name="gender" required>
                                                    <option value="" disabled>Choisissez un genre</option>
                                                    <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Masculin</option>
                                                    <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Féminin</option>
                                                    <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>Autre</option>
                                                </select>
                                                @error('gender')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="nationality" class="form-label">Nationalité *</label>
                                                <input type="text" class="form-control" id="nationality" name="nationality" 
                                                    value="{{ $student->nationality }}" required>
                                                @error('nationality')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="previous_school_name" class="form-label">Nom de l'école précédente</label>
                                                <input type="text" class="form-control" id="previous_school_name" name="previous_school_name" 
                                                    value="{{ $student->previous_school_name }}">
                                                @error('previous_school_name')<div class="text-danger">{{ $message }}</div>@enderror
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
                                                    value="{{ $student->email }}" required>
                                                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="phone_number" class="form-label">Téléphone</label>
                                                <input type="text" class="form-control" id="phone_number" name="phone_number" 
                                                    value="{{ $student->phone_number }}">
                                                @error('phone_number')<div class="text-danger">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="address" class="form-label">Adresse *</label>
                                                <input type="text" class="form-control" id="address" name="address" 
                                                    value="{{ $student->address }}" required>
                                                @error('address')<div class="text-danger">{{ $message }}</div>@enderror
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
                                                <small class="text-muted">Laissez vide pour conserver la photo actuelle</small>
                                                @error('photo')<div class="text-danger">{{ $message }}</div>@enderror
                                                <div class="mt-3 text-center">
                                                    @if($student->photo)
                                                        <img id="photo-preview" src="{{ asset('storage/' . $student->photo) }}" 
                                                            alt="Photo actuelle" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                                    @else
                                                        <img id="photo-preview" src="#" alt="Aperçu de la photo" 
                                                            style="display:none; max-width: 200px; max-height: 200px; object-fit: cover;">
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <h6>Contacts d'Urgence</h6>
                                                
                                                <!-- Contact Père/Tuteur -->
                                                <div class="mb-3">
                                                    <label class="form-label">Nom du Père | Tuteur *</label>
                                                    <input type="text" class="form-control" name="emergency_contacts[0][name]" 
                                                        value="{{ $student->emergencyContacts->where('type', 'father')->first()->name ?? '' }}" required>

                                                    <label class="form-label mt-2">Téléphone du Père | Tuteur *</label>
                                                    <div class="input-group">
                                                        <select class="form-select" name="emergency_contacts[0][country_code]" required>
                                                            <option value="+225" {{ isset($student->emergencyContacts) && $student->emergencyContacts->where('type', 'father')->first()->country_code == '+225' ? 'selected' : '' }}>🇨🇮 Côte d'Ivoire (+225)</option>
                                                            <!-- Ajoutez les autres pays comme dans votre formulaire de création -->
                                                        </select>
                                                        <input type="text" class="form-control" name="emergency_contacts[0][phone]" 
                                                            value="{{ $student->emergencyContacts->where('type', 'father')->first()->phone_number ?? '' }}" required>
                                                    </div>
                                                </div>

                                                <!-- Contact Mère/Tutrice -->
                                                <div class="mb-3">
                                                    <label class="form-label">Nom de la Mère | Tutrice *</label>
                                                    <input type="text" class="form-control" name="emergency_contacts[1][name]" 
                                                        value="{{ $student->emergencyContacts->where('type', 'mother')->first()->name ?? '' }}" required>

                                                    <label class="form-label mt-2">Téléphone de la Mère | Tutrice *</label>
                                                    <div class="input-group">
                                                        <select class="form-select" name="emergency_contacts[1][country_code]" required>
                                                            <option value="+225" {{ isset($student->emergencyContacts) && $student->emergencyContacts->where('type', 'mother')->first()->country_code == '+225' ? 'selected' : '' }}>🇨🇮 Côte d'Ivoire (+225)</option>
                                                            <!-- Ajoutez les autres pays comme dans votre formulaire de création -->
                                                        </select>
                                                        <input type="text" class="form-control" name="emergency_contacts[1][phone]" 
                                                            value="{{ $student->emergencyContacts->where('type', 'mother')->first()->phone_number ?? '' }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Boutons d'action -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-dark">Mettre à jour</button>
                                    <a href="{{ route('student-list') }}" class="btn btn-outline-secondary ms-2">Annuler</a>
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

        document.querySelector('form').addEventListener('submit', function(e) {
        
            // Vérifier que les champs nom et téléphone sont remplis
            const fatherName = document.querySelector('input[name="emergency_contacts[0][name]"]').value;
            const fatherPhone = document.querySelector('input[name="emergency_contacts[0][phone]"]').value;
            const motherName = document.querySelector('input[name="emergency_contacts[1][name]"]').value;
            const motherPhone = document.querySelector('input[name="emergency_contacts[1][phone]"]').value;
            
            if (!fatherName || !fatherPhone || !motherName || !motherPhone) {
                e.preventDefault();
                alert('Veuillez remplir tous les champs des contacts d\'urgence');
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
                                const option = document.createElement('option');
                                option.value = classroom.id;
                                option.textContent = `${classroom.name} (Places disponibles: ${classroom.available_seats}/${classroom.capacity})`;
                                classroomSelect.appendChild(option);
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