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
                                    <h6 class="font-weight-semibold text-lg mb-0">Créer une Année Académique</h6>
                                    <p class="text-sm">Définissez une nouvelle année académique et ses trimestres</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="#" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-list"></i>
                                        </span>
                                        <span class="btn-inner--text">Liste des Années</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST">
                                @csrf

                                <!-- Section pour l'Année Académique -->
                                <div class="mb-4">
                                    <h6 class="text-dark">Année Académique</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="start_year" class="form-label">Année de Début</label>
                                            <input type="number" class="form-control" id="start_year" name="start_year" placeholder="2023" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_year" class="form-label">Année de Fin</label>
                                            <input type="number" class="form-control" id="end_year" name="end_year" placeholder="2024" required>
                                        </div>
                                    </div>
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active">
                                        <label class="form-check-label" for="is_active">
                                            Activer cette année académique
                                        </label>
                                    </div>
                                </div>

                                <!-- Section pour les Trimestres -->
                                <div class="mb-4">
                                    <h6 class="text-dark">Trimestres</h6>
                                    <div id="trimesters">
                                        <div class="row trimester-item mb-3">
                                            <div class="col-md-4">
                                                <label for="trimester_name" class="form-label">Nom du Trimestre</label>
                                                <input type="text" class="form-control" name="trimesters[0][name]" placeholder="Trimestre 1" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="start_date" class="form-label">Date de Début</label>
                                                <input type="date" class="form-control" name="trimesters[0][start_date]" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="end_date" class="form-label">Date de Fin</label>
                                                <input type="date" class="form-control" name="trimesters[0][end_date]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary mt-2" id="add-trimester">Ajouter un Trimestre</button>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-dark">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>

    <script>
        document.getElementById('add-trimester').addEventListener('click', function () {
            var trimesterCount = document.querySelectorAll('.trimester-item').length;
            var trimesterItem = `
                <div class="row trimester-item mb-3">
                    <div class="col-md-4">
                        <label for="trimester_name" class="form-label">Nom du Trimestre</label>
                        <input type="text" class="form-control" name="trimesters[` + trimesterCount + `][name]" placeholder="Trimestre ` + (trimesterCount + 1) + `" required>
                    </div>
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Date de Début</label>
                        <input type="date" class="form-control" name="trimesters[` + trimesterCount + `][start_date]" required>
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Date de Fin</label>
                        <input type="date" class="form-control" name="trimesters[` + trimesterCount + `][end_date]" required>
                    </div>
                </div>
            `;
            document.getElementById('trimesters').insertAdjacentHTML('beforeend', trimesterItem);
        });
    </script>
</x-app-layout>
