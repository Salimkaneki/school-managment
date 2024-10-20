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
                                    <h6 class="mb-0">Ajouter un Élève</h6>
                                    <p class="text-sm mb-0">Veuillez remplir les informations ci-dessous</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('student-list') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Élèves
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Feedback messages -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->has('duplicate'))
                            <div class="alert alert-danger">{{ $errors->first('duplicate') }}</div>
                        @endif

                        <div class="card-body px-4 py-4">
                            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- Informations générales -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" 
                                               value="{{ old('first_name') }}" placeholder="Entrez le prénom" required>
                                        @error('first_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="last_name" class="form-label">Nom de famille</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" 
                                               value="{{ old('last_name') }}" placeholder="Entrez le nom de famille" required>
                                        @error('last_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="{{ old('email') }}" placeholder="Entrez l'email" required>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" 
                                               value="{{ old('phone_number') }}" placeholder="Entrez le numéro de téléphone">
                                        @error('phone_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="date_of_birth" class="form-label">Date de Naissance</label>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" 
                                               value="{{ old('date_of_birth') }}" required>
                                        @error('date_of_birth')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="previous_school_name" class="form-label">Nom de l'école précédente</label>
                                        <input type="text" class="form-control" id="previous_school_name" name="previous_school_name" 
                                               value="{{ old('previous_school_name') }}" placeholder="Entrez le nom de l'école précédente">
                                        @error('previous_school_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Photo + Aperçu côte à côte -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="class_id" class="form-label">Classe</label>
                                        <select class="form-control" id="class_id" name="class_id" required>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                        <label for="photo" class="mt-4 form-label">Photo de l'élève</label>
                                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                        @error('photo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Aperçu de la photo à droite -->
                                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                                        <img id="photo-preview" src="#" alt="Aperçu de la photo" style="display:none; width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                </div>

                                <!-- Contacts d'urgence -->
                                <div class="row mb-3">
                                    <h5>Contacts d'Urgence</h5>
                                    <div class="col-md-6">
                                        <label for="emergency_contact_name_1" class="form-label">Nom du contact d'urgence 1</label>
                                        <input type="text" class="form-control" name="emergency_contacts[0][name]" 
                                               value="{{ old('emergency_contacts.0.name') }}" placeholder="Entrez le nom du contact d'urgence">
                                        @error('emergency_contacts.0.name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emergency_contact_phone_1" class="form-label">Téléphone du contact d'urgence 1</label>
                                        <input type="text" class="form-control" name="emergency_contacts[0][phone]" 
                                               value="{{ old('emergency_contacts.0.phone') }}" placeholder="Entrez le téléphone du contact d'urgence">
                                        @error('emergency_contacts.0.phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="emergency_contact_name_2" class="form-label">Nom du contact d'urgence 2</label>
                                        <input type="text" class="form-control" name="emergency_contacts[1][name]" 
                                               value="{{ old('emergency_contacts.1.name') }}" placeholder="Entrez le nom du contact d'urgence">
                                        @error('emergency_contacts.1.name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emergency_contact_phone_2" class="form-label">Téléphone du contact d'urgence 2</label>
                                        <input type="text" class="form-control" name="emergency_contacts[1][phone]" 
                                               value="{{ old('emergency_contacts.1.phone') }}" placeholder="Entrez le téléphone du contact d'urgence">
                                        @error('emergency_contacts.1.phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Boutons d'action -->
                                <div class="row mb-3">
                                    <div class="col-md-12 d-flex align-items-end justify-content-end">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-light text-dark border-dark">Ajouter</button>
                                            <a href="{{ route('student-list') }}" class="btn btn-secondary ms-2">Annuler</a>
                                        </div>
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

    <!-- JavaScript pour la prévisualisation de la photo -->
    <script>
        document.getElementById('photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const photoPreview = document.getElementById('photo-preview');
                    photoPreview.src = e.target.result;
                    photoPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
