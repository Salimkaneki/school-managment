<!-- resources/views/communications/liste-messages.blade.php -->
<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('components.app.admin_sidebar')
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Liste des Messages</h5>
                                <div class="d-flex align-items-center">
                                    <select class="form-select me-2" style="width: 150px;">
                                        <option>Tous les statuts</option>
                                        <option>Brouillon</option>
                                        <option>Envoyé</option>
                                        <option>Prioritaire</option>
                                    </select>
                                    <a href="#" class="btn btn-primary">
                                        Nouveau Message
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold">Date</th>
                                            <th class="text-secondary text-xs font-weight-semibold">Sujet</th>
                                            <th class="text-secondary text-xs font-weight-semibold">Destinataires</th>
                                            <th class="text-secondary text-xs font-weight-semibold">Statut</th>
                                            <th class="text-secondary text-xs font-weight-semibold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle text-sm">15/01/2024 14:30</td>
                                            <td class="align-middle text-sm">Réunion parents-professeurs</td>
                                            <td class="align-middle text-sm">Parents, Enseignants</td>
                                            <td class="align-middle">
                                                <span class="badge badge-success">Envoyé</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-link text-info px-2">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle text-sm">10/01/2024 09:15</td>
                                            <td class="align-middle text-sm">Bulletin trimestriel</td>
                                            <td class="align-middle text-sm">Parents</td>
                                            <td class="align-middle">
                                                <span class="badge badge-secondary">Brouillon</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-link text-info px-2">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-link text-warning px-2">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle text-sm">05/01/2024 16:45</td>
                                            <td class="align-middle text-sm">Communication importante</td>
                                            <td class="align-middle text-sm">Tous les administrateurs</td>
                                            <td class="align-middle">
                                                <span class="badge badge-danger">Prioritaire</span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex">
                                                    <a href="#" class="btn btn-link text-info px-2">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer pb-0">
                            <nav>
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Précédent</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Suivant</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-app.footer />
    </main>
</x-app-layout>