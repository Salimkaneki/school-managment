<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header" style="background-color: #6c757d; color: #ffffff; border-radius: 8px 8px 0 0;">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="mb-0">Liste des Inscriptions</h6>
                                    <p class="text-sm mb-0">Voici la liste des élèves inscrits dans les classes</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('create-enrollment') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-plus me-2"></i> Ajouter une Inscription
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-4">
                                <table class="table align-items-center mb-0 table-bordered text-center">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Nom de l'Élève</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Classe</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Date d'Inscription</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Boucle pour afficher les inscriptions -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
