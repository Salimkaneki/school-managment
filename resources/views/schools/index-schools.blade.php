<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('components.app.admin_sidebar')
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Liste des Établissements</h3>
                            <p class="mb-0">Gestion des écoles</p>
                        </div>
                        <div class="ms-md-auto">
                            <a href="#" class="btn btn-sm btn-dark">
                                <i class="fas fa-plus me-2"></i>Ajouter un établissement
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-0">

            <div class="row my-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                            <th>Date de création</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>École Primaire Exemple</td>
                                            <td>ecole.exemple@education.fr</td>
                                            <td>01 23 45 67 89</td>
                                            <td>15/01/2024</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-sm btn-info me-2">Voir</a>
                                                    <a href="#" class="btn btn-sm btn-warning me-2">Modifier</a>
                                                    <a href="#" class="btn btn-sm btn-danger">Supprimer</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Collège Modèle</td>
                                            <td>college.modele@education.fr</td>
                                            <td>02 34 56 78 90</td>
                                            <td>20/01/2024</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-sm btn-info me-2">Voir</a>
                                                    <a href="#" class="btn btn-sm btn-warning me-2">Modifier</a>
                                                    <a href="#" class="btn btn-sm btn-danger">Supprimer</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-app.footer />
    </main>
</x-app-layout>