<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <h6 class="mb-0">Emploi du Temps Hebdomadaire</h6>
                            <p class="text-sm mb-0">Vue de l'emploi du temps pour la semaine</p>
                        </div>
                        <div class="card-body px-4 py-4">
                            <!-- Tableau de l'emploi du temps -->
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7"></th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Lundi</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Mardi</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Mercredi</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Jeudi</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Vendredi</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Samedi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Périodes de la journée -->
                                    <tr>
                                        <td class="align-middle bg-gray-100 text-xs font-weight-semibold">08:00 - 09:00</td>
                                        <!-- Cours programmés -->
                                    </tr>
                                    <tr>
                                        <td class="align-middle bg-gray-100 text-xs font-weight-semibold">09:00 - 10:00</td>
                                        <!-- Cours programmés -->
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
