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
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des Élèves</h6>
                                    <p class="text-sm">Voici la liste de tous les élèves</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <!-- Bouton de retour vers le tableau de bord -->
                                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" class="me-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Retour</span>
                                    </a>
                                    <a href="{{ route('create-student') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Ajouter un Élève</span>
                                    </a>

                                    <a href="{{ route('show-students-by-class') }}" class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--text">Élèves par Classe</span>
                                    </a>

                                    <a href="{{ route('attendances.create') }}" class="btn btn-sm btn-warning btn-icon d-flex align-items-center">
                                        <span class="btn-inner--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-x-fill me-2" viewBox="0 0 16 16">
                                                <path d="M4 .5a.5.5 0 0 1 .5.5V1h6V1a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V1a.5.5 0 0 1 .5-.5zM1 4v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1zm4.146 3.854a.5.5 0 0 1 0-.708L7 5.293 5.854 4.146a.5.5 0 1 1 .708-.708L7.707 4.586l1.147-1.148a.5.5 0 0 1 .708.708L8.414 5.293l1.147 1.147a.5.5 0 0 1-.708.708L7.707 6l-1.147 1.147a.5.5 0 0 1-.708 0z"/>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Enregistrer une Absence</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 py-0">
                            @if($students->isEmpty())
                               <div class="text-center py-2">
                                   <p class="font-weight-semibold text-lg mb-0">Aucun élève enregistré</p>
                               </div>
                            @else
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0 table-bordered text-center">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Prénom et Nom</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Téléphone</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Email</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Classe Assignée</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-column justify-content-center ms-1">
                                                            <h6 class="mb-0 text-sm font-weight-semibold">{{ $student->first_name }} {{ $student->last_name }}</h6>
                                                            <p class="text-sm text-secondary mb-0">{{ $student->nationality }}</p>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <p class="text-sm text-dark font-weight-semibold mb-0">{{ $student->phone_number }}</p>
                                                        <p class="text-sm text-secondary mb-0">Téléphone</p>
                                                    </td>

                                                    <td class="align-middle text-center text-sm">
                                                        <span class="text-secondary text-sm font-weight-normal">{{$student->email}}</span>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-sm font-weight-normal">{{ $student->classModel ? $student->classModel->name : 'Aucune' }}</span>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <a href="#" class="text-primary font-weight-bold text-xs me-2" title="Modifier">
                                                            Modifier
                                                        </a>

                                                        <form action="#" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="javascript:void(0);" class="text-danger font-weight-bold text-xs" title="Supprimer" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')) { this.closest('form').submit(); }">
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
                                    @if ($students->onFirstPage())
                                        <button class="btn btn-sm btn-white d-sm-block d-none mb-0" disabled>Previous</button>
                                    @else
                                        <a href="{{ $students->previousPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0">Previous</a>
                                    @endif

                                    <!-- Pagination -->
                                    <nav aria-label="Pagination" class="ms-auto">
                                        <ul class="pagination pagination-light mb-0">
                                            @foreach ($students->links()->elements[0] as $page => $url)
                                                @if ($page == $students->currentPage())
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
                                    @if ($students->hasMorePages())
                                        <a href="{{ $students->nextPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto">Next</a>
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
