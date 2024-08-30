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
                                    <h6 class="font-weight-semibold text-lg mb-0">Dashboard des Emplois du Temps</h6>
                                    <p class="text-sm mb-0">Consultez et téléchargez les emplois du temps en PDF</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="#" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-upload"></i>
                                        </span>
                                        <span class="btn-inner--text">Téléverser un PDF</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100 text-center">
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                            Nom du Fichier
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Date d'Ajout
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Exemple de lignes pour les fichiers PDF -->
                                    <tr>
                                        <td class="align-middle bg-transparent border-bottom text-xs">
                                            Emploi_du_temps_2024.pdf
                                        </td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">
                                            2024-08-30
                                        </td>
                                        <td class="text-center align-middle bg-transparent border-bottom text-xs">
                                            <a href="#" class="btn btn-info btn-sm" target="_blank">
                                                <i class="fas fa-eye"></i> Voir
                                            </a>
                                            <a href="#" class="btn btn-primary btn-sm ms-2">
                                                <i class="fas fa-download"></i> Télécharger
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Ajouter d'autres fichiers PDF ici -->
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
