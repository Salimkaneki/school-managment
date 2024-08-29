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
                                    <h6 class="font-weight-semibold text-lg mb-0">Années Académiques</h6>
                                    <p class="text-sm">Gérez les années académiques ici</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="#" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="btn-inner--text">Ajouter une Année</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th>ID</th>
                                        <th>Début</th>
                                        <th>Fin</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Exemple de données -->
                                    <tr>
                                        <td>1</td>
                                        <td>2023</td>
                                        <td>2024</td>
                                        <td>
                                            <span class="badge bg-success">Oui</span>
                                        </td>
                                        <td>
                                            <a href="#" class="text-primary">Modifier</a>
                                            <a href="#" class="text-danger ms-3">Supprimer</a>
                                        </td>
                                    </tr>
                                    <!-- Répétez ce bloc pour chaque année académique -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
