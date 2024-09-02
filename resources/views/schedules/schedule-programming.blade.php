<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Programmation des Cours</h6>
                                    <p class="text-sm mb-0">Définissez les horaires pour chaque matière et professeur</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="#" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Cours
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="#" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="course" class="form-label">Matière</label>
                                        <select class="form-select" id="course" name="course" required>
                                            <option value="" selected disabled>Choisissez une matière</option>
                                            <!-- Options de matières -->
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="professor" class="form-label">Professeur</label>
                                        <select class="form-select" id="professor" name="professor" required>
                                            <option value="" selected disabled>Choisissez un professeur</option>
                                            <!-- Options de professeurs -->
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
                                            <option value="sunday">Dimanche</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="time" class="form-label">Heure</label>
                                        <input type="text" class="form-control" id="time" name="time" placeholder="HH:MM - HH:MM" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12 d-flex align-items-end justify-content-end">
                                        <button type="submit" class="btn btn-light text-dark border-dark">Planifier le Cours</button>
                                        <a href="#" class="btn btn-secondary ms-2">Annuler</a>
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
