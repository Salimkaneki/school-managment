<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="pb-0 card-header text-dark" style="background-color: #6c757d; color: #ffffff; border-radius: 8px 8px 0 0;">
                            <h6 class="mb-0">Détails du Paiement</h6>
                        </div>
                        <div class="card-body px-4 py-4">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p><strong>Élève:</strong> John Doe</p>
                                    <p><strong>Montant dû:</strong> 500.00</p>
                                    <p><strong>Montant payé:</strong> 250.00</p>
                                    <p><strong>Solde:</strong> 250.00</p>
                                    <p><strong>État:</strong> Partiellement payé</p>
                                    <p><strong>Date:</strong> 01/01/2024</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Mode de paiement:</strong> Virement bancaire</p>
                                    <p><strong>Commentaires:</strong> Paiement pour les frais de scolarité du trimestre</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 d-flex align-items-end justify-content-end">
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-secondary ms-2">Retour</a>
                                    </div>
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
