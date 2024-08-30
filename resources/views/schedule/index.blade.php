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
                                    <p class="text-sm mb-0">Voici la liste des emplois du temps enregistrés</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-plus me-2"></i> Ajouter un Emploi du Temps
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100 text-center">
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">ID</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Cours</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Professeur</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Jour</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Heure</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Salle</th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Remplacer par une boucle pour les emplois du temps -->
                                    <tr>
                                        <td class="align-middle bg-transparent border-bottom text-xs">1</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">Mathematics</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">Dr. Smith</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">Lundi</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">09:00</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">Salle A</td>
                                        <td class="text-center align-middle bg-transparent border-bottom text-xs">
                                            <a href="#" class="text-secondary font-weight-bold text-xs">Modifier</a>
                                            <form action="#" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0 ms-2">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Fin de la boucle -->
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
