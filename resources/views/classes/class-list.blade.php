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
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des Classes</h6>
                                    <p class="text-sm">Voici la liste des classes enregistrées</p>
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
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100 text-center">
                                    <tr class="table  text-center">
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                            ID
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                            Nom
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Frais de Scolarité
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Nombre de Salles
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classes as $class)
                                    <tr>
                                        <td class="align-middle bg-transparent border-bottom text-xs">
                                            {{ $class->id }}
                                        </td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">
                                            {{ $class->name }}
                                        </td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">
                                            {{ $class->fees }}
                                        </td>
                                        <td class="align-middle bg-transparent border-bottom text-xs text-center">
                                            {{ $class->classrooms_count }}
                                        </td>
                                        <td class="text-center align-middle bg-transparent border-bottom text-xs">
                                            <a href="{{ route('edit-class', $class->id) }}" class="text-secondary font-weight-bold text-xs">
                                                Modifier
                                            </a>
                                            <form action="{{ route('delete-class', $class->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0 ms-2">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
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
