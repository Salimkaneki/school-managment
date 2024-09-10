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
                            <form action="{{ route('students.store') }}" method="POST">
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
                                        <label for="gender" class="form-label">Genre</label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="male">Masculin</option>
                                            <option value="female">Féminin</option>
                                            <option value="other">Autre</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date_of_birth" class="form-label">Date de naissance</label>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                                    </div>
                                </div>

                                <!-- Adresse -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="address" class="form-label">Adresse</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Entrez l'adresse">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nationality" class="form-label">Nationalité</label>
                                        <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Entrez la nationalité">
                                    </div>
                                </div>

                                <!-- Informations de contact d'urgence -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="emergency_contact_name" class="form-label">Nom du contact d'urgence</label>
                                        <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" placeholder="Entrez le nom du contact d'urgence">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emergency_contact_phone" class="form-label">Téléphone du contact d'urgence</label>
                                        <input type="text" class="form-control" id="emergency_contact_phone" name="emergency_contact_phone" placeholder="Entrez le téléphone du contact d'urgence">
                                    </div>
                                </div>

                                <!-- Informations sur l'école précédente -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="previous_school_name" class="form-label">Nom de l'école précédente</label>
                                        <input type="text" class="form-control" id="previous_school_name" name="previous_school_name" placeholder="Entrez le nom de l'école précédente">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="previous_school_address" class="form-label">Adresse de l'école précédente</label>
                                        <input type="text" class="form-control" id="previous_school_address" name="previous_school_address" placeholder="Entrez l'adresse de l'école précédente">
                                    </div>
                                </div>

                                <!-- Classe -->
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
