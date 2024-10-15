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
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des Professeurs</h6>
                                    <p class="text-sm">Voici la liste de tous les professeurs</p>
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

                                    <!-- Bouton d'ajout de professeur -->
                                    <a href="{{ route('create-teacher') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Ajouter un Professeur</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 py-0">
                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="card-body px-0 py-0">
                                @if($teachers->isEmpty())
                                    <div class="text-center py-2">
                                        <p class="font-weight-semibold text-lg mb-0">Aucun professeur enregistré</p>
                                    </div>
                                @else
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0 table-bordered text-center">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Prénom et Nom</th>
                                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">Nationalité</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Contacts</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Matière</th>
                                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($teachers as $teacher)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex flex-column justify-content-center ms-1">
                                                                <h6 class="mb-0 text-sm font-weight-semibold">{{ $teacher->last_name }} {{ $teacher->first_name }}</h6>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-sm font-weight-normal">{{ $teacher->nationality }}</span>
                                                        </td>
                                                        <td class="align-middle text-center text-sm">
                                                            <p class="text-sm text-dark font-weight-semibold mb-0">{{ $teacher->phone_number }}</p>
                                                            <span class="text-secondary text-sm font-weight-normal">{{ $teacher->email }}</span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <span class="text-secondary text-sm font-weight-normal">{{ $teacher->subject }}</span>
                                                        </td>
                                                        <td class="align-middle text-center">
                                                            <a href="{{ route('edit-teacher', $teacher->id) }}" class="text-secondary font-weight-bold text-xs me-2">
                                                                <!-- Edit icon -->
                                                            </a>
                                                            <form action="#" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-secondary font-weight-bold text-xs">
                                                                    <!-- Delete icon -->
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>

                            <!-- Pagination Section -->
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                @if ($teachers->previousPageUrl())
                                    <a href="{{ $teachers->previousPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0">Previous</a>
                                @endif
                                
                                <nav aria-label="..." class="ms-auto">
                                    <ul class="pagination pagination-light mb-0">
                                        @for ($i = 1; $i <= $teachers->lastPage(); $i++)
                                            <li class="page-item {{ $i == $teachers->currentPage() ? 'active' : '' }}" aria-current="page">
                                                <a class="page-link font-weight-bold {{ $i == $teachers->currentPage() ? '' : 'border-0' }}"
                                                   href="{{ $teachers->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                    </ul>
                                </nav>

                                @if ($teachers->nextPageUrl())
                                    <a href="{{ $teachers->nextPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto">Next</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
