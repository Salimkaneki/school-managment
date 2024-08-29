<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <!-- Carte de Profil -->
                <div class="col-12 col-xl-4 mb-4">
                    <div class="card border shadow-sm h-100" style="border-radius: 10px;">
                        <div class="card-header pb-0 p-3" style="background-color: #f8f9fa; border-radius: 10px 10px 0 0;">
                            <div class="row">
                                <div class="col-md-8 col-9">
                                    <h6 class="mb-0 text-dark font-weight-semibold text-lg">Informations du Profil</h6>
                                    <p class="text-muted mb-1">Modifiez les informations vous concernant.</p>
                                </div>
                                <div class="col-md-4 col-3 text-end">
                                    <button type="button" class="btn btn-light btn-icon px-2 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <p class="text-muted mb-4">
                                Hi, I’m Alec Thompson. Decisions: If you can’t decide, the answer is no. If two equally
                                difficult paths, choose the one more painful in the short term (pain avoidance is
                                creating an illusion of equality).
                            </p>
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pt-0 pb-1 text-sm">
                                    <span class="text-secondary">Prénom:</span> &nbsp; Noah
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Nom de famille:</span> &nbsp; Mclaren
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Mobile:</span> &nbsp; +(44) 123 1234 123
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Fonction:</span> &nbsp; Manager - Organisation
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Localisation:</span> &nbsp; USA
                                </li>
                                <li class="list-group-item border-0 ps-0 text-dark font-weight-semibold pb-1 text-sm">
                                    <span class="text-secondary">Social:</span> &nbsp;
                                    <a class="btn btn-link text-dark mb-0 ps-1 pe-1 py-0" href="javascript:;">
                                        <i class="fab fa-linkedin fa-lg"></i>
                                    </a>
                                    <a class="btn btn-link text-dark mb-0 ps-1 pe-1 py-0" href="javascript:;">
                                        <i class="fab fa-github fa-lg"></i>
                                    </a>
                                    <a class="btn btn-link text-dark mb-0 ps-1 pe-1 py-0" href="javascript:;">
                                        <i class="fab fa-slack fa-lg"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tableau de l'Historique des Paiements -->
                <div class="col-12 col-xl-8 mb-4">
                    <div class="card shadow-lg border-light" style="border-radius: 10px;">
                        <div class="card-header text-dark" style="background-color: #007bff; color: #ffffff; border-radius: 10px 10px 0 0;">
                            <h6 class="mb-0">Historique des Paiements</h6>
                        </div>
                        <div class="card-body px-4 py-4">
                            <div class="table-responsive">
                                <table class="table text-dark table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Montant dû</th>
                                            <th>Montant payé</th>
                                            <th>Solde</th>
                                            <th>État</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>500.00</td>
                                            <td>250.00</td>
                                            <td>250.00</td>
                                            <td>Partiellement payé</td>
                                            <td>01/01/2024</td>
                                        </tr>
                                        <!-- Répétez ce bloc pour chaque paiement -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 text-end">
                                    <a href="#" class="btn btn-primary">Retour</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
