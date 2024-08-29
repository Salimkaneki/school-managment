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
                                    <h6 class="font-weight-semibold text-lg mb-0">Année Académique et Trimestre en Cours</h6>
                                    <p class="text-sm">Voici les détails de l'année académique et du trimestre en cours</p>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100 text-center">
                                    <tr class="table  text-center">
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Année Académique</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Trimestre</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Début</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Fin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle bg-transparent border-bottom text-xs">2023-2024</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">Premier Trimestre</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">01/09/2023</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">30/11/2023</td>
                                    </tr>
                                    <!-- Ajoutez plus de lignes si nécessaire -->
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
