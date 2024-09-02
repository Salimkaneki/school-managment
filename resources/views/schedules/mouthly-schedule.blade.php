<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <h6 class="mb-0">Emploi du Temps Mensuel</h6>
                            <p class="text-sm mb-0">Vue de l'emploi du temps pour le mois</p>
                        </div>
                        <div class="card-body px-4 py-4">
                            <!-- Calendrier mensuel -->
                            <div class="calendar">
                                <!-- Vous pouvez utiliser une bibliothèque comme FullCalendar pour un calendrier interactif -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
