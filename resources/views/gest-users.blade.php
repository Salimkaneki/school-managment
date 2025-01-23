<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="px-5 py-4 container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Gestion des utilisateurs</h5>
                                <a href="#" class="btn btn-primary btn-sm mb-0">Ajouter</a>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Téléphone</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Localisation</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                                <div class="avatar avatar-sm">
                                                    <img src="../assets/img/team-2.jpg" class="border-radius-lg shadow">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">John Doe</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">john@example.com</p>
                                            </td>
                                            <td class="text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">0123456789</p>
                                            </td>
                                            <td class="text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">Paris, France</p>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-link text-dark px-3 mb-0">
                                                    <i class="fas fa-pencil-alt text-dark me-2"></i>Éditer
                                                </a>
                                                <form action="#" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0">
                                                        <i class="far fa-trash-alt me-2"></i>Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
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