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
                            <form action="">
                                <!-- Informations générales -->
                                <h5 class="mb-4">Informations générales</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nom de l'établissement</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Type d'établissement</label>
                                        <select class="form-select" required>
                                            <option value="">Sélectionner...</option>
                                            <option>École primaire</option>
                                            <option>Collège</option>
                                            <option>Lycée</option>
                                            <option>École professionnelle</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Informations pédagogiques -->
                                <h5 class="mb-4 mt-5">Informations pédagogiques</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Langues enseignées</label>
                                        <select class="form-select" multiple required>
                                            <option>Anglais</option>
                                            <option>Espagnol</option>
                                            <option>Allemand</option>
                                            <option>Italien</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Effectif du personnel enseignant</label>
                                        <input type="number" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Contact -->
                                <h5 class="mb-4 mt-5">Coordonnées</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Téléphone principal</label>
                                        <input type="tel" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Localisation -->
                                <h5 class="mb-4 mt-5">Localisation</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Adresse</label>
                                        <textarea class="form-control" rows="3" required></textarea>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Ville</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Code postal</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Équipements essentiels -->
                                <h5 class="mb-4 mt-5">Équipements</h5>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="sportif">
                                            <label class="form-check-label" for="sportif">Équipements sportifs</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bibliotheque">
                                            <label class="form-check-label" for="bibliotheque">Bibliothèque/CDI</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="informatique">
                                            <label class="form-check-label" for="informatique">Salle informatique</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="pmr">
                                            <label class="form-check-label" for="pmr">Accessibilité PMR</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Documents administratifs -->
                                <h5 class="mb-4 mt-5">Documents administratifs</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Règlement intérieur</label>
                                        <input type="file" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Projet d'établissement</label>
                                        <input type="file" class="form-control" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Logo de l'établissement</label>
                                        <input type="file" class="form-control" accept="image/*">
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

        <x-app.footer />
    </main>
</x-app-layout>