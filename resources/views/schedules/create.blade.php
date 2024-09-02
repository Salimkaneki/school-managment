<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="mb-0">Créer un Emploi du Temps</h6>
                                    <p class="text-sm mb-0">Veuillez remplir les informations ci-dessous</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Emplois du Temps
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="#" method="POST">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="course" class="form-label">Cours</label>
                                        <select class="form-select" id="course" name="course" required>
                                            <option value="" selected disabled>Choisissez un cours</option>
                                            <!-- Options de cours -->
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="professor" class="form-label">Professeur</label>
                                        <select class="form-select" id="professor" name="professor" required>
                                            <option value="" selected disabled>Choisissez un professeur</option>
                                            <!-- Options de professeur -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="day" class="form-label">Jour</label>
                                        <select class="form-select" id="day" name="day" required>
                                            <option value="" selected disabled>Choisissez un jour</option>
                                            <option value="monday">Lundi</option>
                                            <option value="tuesday">Mardi</option>
                                            <option value="wednesday">Mercredi</option>
                                            <option value="thursday">Jeudi</option>
                                            <option value="friday">Vendredi</option>
                                            <option value="saturday">Samedi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="time" class="form-label">Heure</label>
                                        <input type="time" class="form-control" id="time" name="time" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="location" class="form-label">Salle</label>
                                        <select class="form-select" id="location" name="location" required>
                                            <option value="" selected disabled>Choisissez une salle</option>
                                            <!-- Options de salle -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 d-flex align-items-end justify-content-end">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-light text-dark border-dark">Créer l'Emploi du Temps</button>
                                            <a href="#" class="btn btn-secondary ms-2">Annuler</a>
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
