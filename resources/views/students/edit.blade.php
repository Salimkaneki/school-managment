<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <!-- En-tête de la carte -->
                        <div class="pb-0 card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="mb-0">Modifier un Élève</h6>
                                    <p class="text-sm mb-0">Modifiez les informations de l'élève ci-dessous</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('student-list') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Élèves
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Messages de feedback -->
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->has('duplicate'))
                            <div class="alert alert-danger">{{ $errors->first('duplicate') }}</div>
                        @endif

                        <div class="card-body px-4 py-4">
                            <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Année académique -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="academic_year_id" class="form-label">Année académique</label>
                                        <select class="form-control" id="academic_year_id" name="academic_year_id" required>
                                            <option value="" disabled>Choisissez une année académique</option>
                                            @foreach ($academicYears as $academicYear)
                                                <option value="{{ $academicYear->id }}" {{ $student->academic_year_id == $academicYear->id ? 'selected' : '' }}>
                                                    {{ $academicYear->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('academic_year_id')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                
                                <!-- Informations générales -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $student->first_name }}" placeholder="Entrez le prénom" required>
                                        @error('first_name')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="last_name" class="form-label">Nom de famille</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $student->last_name }}" placeholder="Entrez le nom de famille" required>
                                        @error('last_name')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- Genre -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="gender" class="form-label">Genre</label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="" disabled>Choisissez un genre</option>
                                            <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Masculin</option>
                                            <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Féminin</option>
                                            <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        @error('gender')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- Contact -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" placeholder="Entrez l'email" required>
                                        @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $student->phone_number }}" placeholder="Entrez le numéro de téléphone">
                                        @error('phone_number')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- Informations supplémentaires -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="date_of_birth" class="form-label">Date de Naissance</label>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $student->date_of_birth }}" required>
                                        @error('date_of_birth')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="previous_school_name" class="form-label">Nom de l'école précédente</label>
                                        <input type="text" class="form-control" id="previous_school_name" name="previous_school_name" value="{{ $student->previous_school_name }}" placeholder="Entrez le nom de l'école précédente">
                                        @error('previous_school_name')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- Classe et Photo -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="class_id" class="form-label">Classe</label>
                                        <select class="form-control" id="class_id" name="class_id" required>
                                            <option value="" disabled>Choisissez une classe</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('class_id')<div class="text-danger">{{ $message }}</div>@enderror

                                        <label for="photo" class="mt-4 form-label">Photo de l'élève</label>
                                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                        <small class="text-muted">Laissez vide pour conserver la photo actuelle</small>
                                        @error('photo')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <!-- Aperçu photo -->
                                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        @if($student->photo)
                                            <img id="photo-preview" src="{{ asset('storage/' . $student->photo) }}" alt="Photo actuelle" style="width: 150px; height: 150px; object-fit: cover;">
                                        @else
                                            <img id="photo-preview" src="#" alt="Aperçu de la photo" style="display:none; width: 150px; height: 150px; object-fit: cover;">
                                        @endif
                                    </div>
                                </div>

                                <!-- Contacts d'urgence -->
                                @php
                                    $emergencyContacts = json_decode($student->emergency_contacts, true) ?? [[], []];
                                @endphp
                                
                                <div class="row mb-3">
                                    <h5>Contacts d'Urgence</h5>
                                    <div class="col-md-6">
                                        <label for="emergency_contact_name_1" class="form-label">Nom du Père | Tuteur </label>
                                        <input type="text" class="form-control" name="emergency_contacts[0][name]" 
                                            value="{{ $emergencyContacts[0]['name'] ?? '' }}" placeholder="Entrez le nom du Père | Tuteur">
                                        @error('emergency_contacts.0.name')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emergency_contact_phone_1" class="form-label">Téléphone du Père | Tuteur</label>
                                        <input type="text" class="form-control" name="emergency_contacts[0][phone]" 
                                            value="{{ $emergencyContacts[0]['phone'] ?? '' }}" placeholder="Entrez le téléphone du Père | Tuteur">
                                        @error('emergency_contacts.0.phone')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="emergency_contact_name_2" class="form-label">Nom de la Mère | Tutrice </label>
                                        <input type="text" class="form-control" name="emergency_contacts[1][name]" 
                                            value="{{ $emergencyContacts[1]['name'] ?? '' }}" placeholder="Entrez le nom de la Mère | Tutrice">
                                        @error('emergency_contacts.1.name')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emergency_contact_phone_2" class="form-label">Téléphone de la Mère | Tutrice</label>
                                        <input type="text" class="form-control" name="emergency_contacts[1][phone]" 
                                            value="{{ $emergencyContacts[1]['phone'] ?? '' }}" placeholder="Entrez le téléphone de la Mère | Tutrice">
                                        @error('emergency_contacts.1.phone')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- Boutons d'action -->
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-dark">Mettre à jour</button>
                                        <a href="{{ route('student-list') }}" class="btn btn-outline-secondary">Annuler</a>
                                    </div>
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
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>