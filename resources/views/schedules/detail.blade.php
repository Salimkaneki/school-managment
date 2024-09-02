<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <h6 class="mb-0">Détail de l'Emploi du Temps</h6>
                            <p class="text-sm mb-0">Détails pour un emploi du temps spécifique</p>
                        </div>
                        <div class="card-body px-4 py-4">
                            <!-- Tableau des détails -->
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Période</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Jour</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Matière</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Professeur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Détails des cours -->
                                    <tr>
                                        <td class="align-middle bg-gray-100 text-xs font-weight-semibold">08:00 - 09:00</td>
                                        <td class="align-middle bg-transparent text-xs">Lundi</td>
                                        <td class="align-middle bg-transparent text-xs">Mathematics</td>
                                        <td class="align-middle bg-transparent text-xs">Prof. Smith</td>
                                    </tr>
                                    <!-- Autres périodes -->
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
