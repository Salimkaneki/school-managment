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
                        <div class="card-body px-4 py-4">
                            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Informations générales -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Entrez le prénom" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="last_name" class="form-label">Nom de famille</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Entrez le nom de famille" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Entrez l'email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Entrez le numéro de téléphone">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="date_of_birth" class="form-label">Date de Naissance</label>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="previous_school_name" class="form-label">Nom de l'école précédente</label>
                                        <input type="text" class="form-control" id="previous_school_name" name="previous_school_name" placeholder="Entrez le nom de l'école précédente">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="class_id" class="form-label">Classe</label>
                                        <select class="form-control" id="class_id" name="class_id" required>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Champ pour la photo -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="photo" class="form-label">Photo de l'élève</label>
                                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                    </div>
                                </div>

                                <!-- Contacts d'urgence -->
                                <div class="row mb-3">
                                    <h5>Contacts d'Urgence</h5>
                                    <div class="col-md-6">
                                        <label for="emergency_contact_name_1" class="form-label">Nom du contact d'urgence 1</label>
                                        <input type="text" class="form-control" name="emergency_contacts[0][name]" placeholder="Entrez le nom du contact d'urgence">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emergency_contact_phone_1" class="form-label">Téléphone du contact d'urgence 1</label>
                                        <input type="text" class="form-control" name="emergency_contacts[0][phone]" placeholder="Entrez le téléphone du contact d'urgence">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="emergency_contact_name_2" class="form-label">Nom du contact d'urgence 2</label>
                                        <input type="text" class="form-control" name="emergency_contacts[1][name]" placeholder="Entrez le nom du contact d'urgence">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emergency_contact_phone_2" class="form-label">Téléphone du contact d'urgence 2</label>
                                        <input type="text" class="form-control" name="emergency_contacts[1][phone]" placeholder="Entrez le téléphone du contact d'urgence">
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
</x-app-layout>
