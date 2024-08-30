<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <h6 class="mb-0">Vue d'Ensemble de l'Emploi du Temps</h6>
                            <p class="text-sm mb-0">Sélectionnez un jour ou une semaine pour voir l'emploi du temps</p>
                        </div>
                        <div class="card-body px-4 py-4">
                            <!-- Liens vers les vues spécifiques -->
                            <a href="#" class="btn btn-light text-dark border-dark">Voir l'Emploi du Temps Hebdomadaire</a>
                            <a href="{#" class="btn btn-light text-dark border-dark ms-2">Voir l'Emploi du Temps Mensuel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
