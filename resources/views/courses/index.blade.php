<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="pb-0 card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="mb-0">Liste des Cours</h6>
                                    <p class="text-sm mb-0">Voici la liste des cours enregistrés</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('create-course') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-plus me-2"></i> Ajouter un Cours
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100 text-center">
                                    <tr class="text-secondary text-xs font-weight-semibold opacity-7">
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                            ID
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                            Nom du Cours
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Professeur
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Description
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                        <tr>
                                            <td class="align-middle bg-transparent border-bottom text-xs">
                                                {{ $course->id }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">
                                                {{ $course->name }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">
                                                {{ $course->teacher->first_name }} {{ $course->teacher->last_name }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">
                                                {{ $course->description }}
                                            </td>
                                            <td class="text-center align-middle bg-transparent border-bottom text-xs">
                                                <a href="#" class="text-secondary font-weight-bold text-xs">
                                                    Modifier
                                                </a>
                                                <form action="#" method="POST" style="display:inline;">
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

                        <!-- Pagination personnalisée -->
                        <div class="border-top py-3 px-3 d-flex align-items-center">
                            <!-- Bouton Previous -->
                            @if ($courses->onFirstPage())
                                <button class="btn btn-sm btn-white d-sm-block d-none mb-0" disabled>Previous</button>
                            @else
                                <a href="{{ $courses->previousPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0">Previous</a>
                            @endif

                            <!-- Pagination -->
                            <nav aria-label="Pagination" class="ms-auto">
                                <ul class="pagination pagination-light mb-0">
                                    @foreach ($courses->links()->elements[0] as $page => $url)
                                        @if ($page == $courses->currentPage())
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
                            @if ($courses->hasMorePages())
                                <a href="{{ $courses->nextPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto">Next</a>
                            @else
                                <button class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto" disabled>Next</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
