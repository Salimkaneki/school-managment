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
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des Paiements</h6>
                                    <p class="text-sm">Voici la liste des paiements effectués</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="#" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="btn-inner--text">Ajouter un Paiement</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">ID</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Élève</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Montant dû</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Montant payé</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Solde</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">État</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Date</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="align-middle bg-transparent border-bottom text-xs">1</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">John Doe</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">500.00</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">250.00</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">250.00</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">
                                            <span class="badge bg-warning">Partiellement payé</span>
                                        </td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">01/01/2024</td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">
                                            <a href="#" class="text-secondary font-weight-bold text-xs">Modifier</a>
                                            <form action="#" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0 ms-2">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Répétez ce bloc pour chaque paiement -->
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
