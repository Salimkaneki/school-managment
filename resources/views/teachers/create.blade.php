<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="pb-0 card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="mb-0">Ajouter un Professeur</h6>
                                    <p class="text-sm mb-0">Veuillez remplir les informations ci-dessous</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('index-teacher') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Professeurs
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="{{ route('teachers.store') }}" method="POST">
                                @csrf
                                
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
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Entrez le mot de passe" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Entrez le numéro de téléphone">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="gender" class="form-label">Genre</label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="male">Masculin</option>
                                            <option value="female">Féminin</option>
                                            <option value="other">Autre</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nationality" class="form-label">Nationalité</label>
                                        <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Entrez la nationalité">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="seniority" class="form-label">Années d'expérience</label>
                                        <input type="number" class="form-control" id="seniority" name="seniority" placeholder="Entrez les années d'expérience">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="subject" class="form-label">Matière enseignée</label>
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Entrez la matière enseignée" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 d-flex align-items-end justify-content-end">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-light text-dark border-dark">Ajouter</button>
                                            <a href="{{ route('index-teacher') }}" class="btn btn-secondary ms-2">Annuler</a>
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

<script src="/assets/js/plugins/datatables.js"></script>
<script>
    // Placeholder for future DataTable integration if needed
</script>
