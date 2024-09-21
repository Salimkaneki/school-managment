<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-3">
                        <div class="card-header border-bottom pb-2">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-1">Liste des Classes</h6>
                                    <p class="text-xs">Voici la liste des classes enregistrées</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <!-- Bouton pour ajouter une classe -->
                                    <a href="{{ route('create-class') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="btn-inner--text">Ajouter une Classe</span>
                                    </a>
                                    <!-- Nouveau bouton pour rediriger vers la liste des salles de classes -->
                                    <a href="{{ route('list-classrooms') }}" class="btn btn-sm btn-info btn-icon d-flex align-items-center">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-door-open"></i>
                                        </span>
                                        <span class="btn-inner--text">Voir les Salles de Classe</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive px-3 py-2">
                            @if($classes->isEmpty())
                                <div class="text-center p-4">
                                    <i class="fas fa-exclamation-circle fa-2x text-info mb-2"></i>
                                    <h6 class="text-info">Aucune classe enregistrée</h6>
                                </div>
                            @else
                                <table class="table align-items-center mb-0 table-bordered text-center">
                                    <thead class="bg-gradient-info text-white">
                                        <tr>
                                            <th class="text-white text-xs font-weight-bold">ID</th>
                                            <th class="text-white text-xs font-weight-bold ps-2">Nom</th>
                                            <th class="text-white text-xs font-weight-bold">Frais de Scolarité</th>
                                            <th class="text-white text-xs font-weight-bold">Nombre de Salles</th>
                                            <th class="text-white text-xs font-weight-bold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($classes as $class)
                                        <tr>
                                            <td class="align-middle bg-light border-bottom text-xs">{{ $class->id }}</td>
                                            <td class="align-middle bg-light border-bottom text-xs">{{ $class->name }}</td>
                                            <td class="align-middle bg-light border-bottom text-xs">{{ $class->fees }}</td>
                                            <td class="align-middle bg-light border-bottom text-xs text-center">{{ $class->classrooms_count }}</td>
                                            <td class="text-center align-middle bg-light border-bottom text-xs">
                                                <a href="{{ route('edit-class', $class->id) }}" class="btn btn-sm btn-outline-info">Modifier</a>
                                                <form action="{{ route('delete-class', $class->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger ms-1">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
