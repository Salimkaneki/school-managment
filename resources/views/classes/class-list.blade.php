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
                                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" class="me-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Retour</span>
                                    </a>
                                    <a href="{{ route('create-class') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="btn-inner--text">Ajouter une Classe</span>
                                    </a>
                                    <a href="{{ route('list-classrooms') }}" class="btn btn-sm btn-info btn-icon d-flex align-items-center">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-door-open"></i>
                                        </span>
                                        <span class="btn-inner--text">Voir les Salles de Classe</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            @if($classes->isEmpty())
                               <div class="text-center py-2">
                                   <p class="font-weight-semibold text-lg mb-0">Aucune classe enregistrée</p>
                               </div>
                            @else
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0 table-bordered text-center">
                                        <thead class="bg-gray-100 text-center">
                                            <tr>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">ID</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Nom de la Classe</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Nombre de Salles de Classe</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($classes as $class)
                                                <tr>
                                                    <td class="text-sm font-weight-semibold">{{ $class->id }}</td>
                                                    <td class="text-sm font-weight-semibold">{{ $class->name }}</td>
                                                    <td class="align-middle bg-transparent border-bottom text-xs text-center">
                                                        {{ $class->classrooms_count }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a href="#" class="text-primary font-weight-bold text-xs me-2" title="Modifier">
                                                            Modifier
                                                        </a>
                                                        <form action="#" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="javascript:void(0);" class="text-danger font-weight-bold text-xs" title="Supprimer" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette classe ?')) { this.closest('form').submit(); }">
                                                                Supprimer
                                                            </a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination personnalisée -->
                                <div class="border-top py-3 px-3 d-flex align-items-center">
                                    <!-- Bouton Previous -->
                                    @if ($classes->onFirstPage())
                                        <button class="btn btn-sm btn-white d-sm-block d-none mb-0" disabled>Previous</button>
                                    @else
                                        <a href="{{ $classes->previousPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0">Previous</a>
                                    @endif

                                    <!-- Pagination -->
                                    <nav aria-label="Pagination" class="ms-auto">
                                        <ul class="pagination pagination-light mb-0">
                                            @foreach ($classes->links()->elements[0] as $page => $url)
                                                @if ($page == $classes->currentPage())
                                                    <li class="page-item active" aria-current="page">
                                                        <span class="page-link font-weight-bold">{{ $page }}</span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link border-0 font-weight-bold" href="{{ $url }}">{{ $page }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </nav>

                                    <!-- Bouton Next -->
                                    @if ($classes->hasMorePages())
                                        <a href="{{ $classes->nextPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto">Next</a>
                                    @else
                                        <button class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto" disabled>Next</button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
