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
                                    <h6 class="mb-0">Liste des Emplois du Temps</h6>
                                    <p class="text-sm mb-0">Vue de tous les emplois du temps créés</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i> Créer un Emploi du Temps
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <!-- Tableau des emplois du temps -->
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Classe</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Date de Création</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Exemple de ligne pour un emploi du temps -->
                                    <tr>
                                        <td class="align-middle text-xs">Classe de 1ère A</td>
                                        <td class="align-middle text-xs">01/09/2024</td>
                                        <td class="align-middle text-xs">
                                            <a href="#" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                            <a href="#" class="btn btn-warning btn-sm ms-2">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm ms-2">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Répétez les lignes pour chaque emploi du temps -->
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
