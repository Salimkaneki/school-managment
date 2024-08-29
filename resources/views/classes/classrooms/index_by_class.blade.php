<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Salles de Classe pour [Nom de la Classe]</h5>
                            <a href="#" class="btn btn-dark">Ajouter une Salle de Classe</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered text-center">
                                <thead class="bg-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Capacité</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Remplacer ces lignes par des données dynamiques plus tard -->
                                    <tr>
                                        <td>1</td>
                                        <td>Salle 101</td>
                                        <td>30</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Modifier</a>
                                            <button type="button" class="btn btn-danger btn-sm">Supprimer</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Salle 102</td>
                                        <td>25</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">Modifier</a>
                                            <button type="button" class="btn btn-danger btn-sm">Supprimer</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
