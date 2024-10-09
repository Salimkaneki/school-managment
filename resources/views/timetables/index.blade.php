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
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des Emplois du Temps</h6>
                                    <p class="text-sm">Voici la liste des emplois du temps créés.</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ route('timetables.create') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Ajouter un Emploi du Temps</span>
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
                            @if($timetables->isEmpty())
                                <div class="text-center py-2">
                                    <p class="font-weight-semibold text-lg mb-0">Aucun emploi du temps enregistré</p>
                                </div>
                            @else
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0 table-bordered text-center">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">ID</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Classe</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Salle de Classe</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($timetables as $timetable)
                                                <tr>
                                                    <td class="text-sm font-weight-semibold">{{ $timetable->id }}</td>
                                                    <td class="text-sm">{{ $timetable->class->name }}</td>
                                                    <td class="text-sm">{{ $timetable->classroom->name }}</td>
                                                    <td class="align-middle text-center">
                                                        <!-- Voir text -->
                                                        <a href="{{ route('timetables.weekly-view', $timetable->id) }}" class="text-secondary font-weight-bold text-xs me-2" title="Voir">
                                                            Voir
                                                        </a>

                                                        <!-- Ajouter Cours text -->
                                                        <a href="{{ route('timetables.addCourse', $timetable->id) }}" class="text-primary font-weight-bold text-xs me-2" title="Ajouter Cours">
                                                            Ajouter Cours
                                                        </a>

                                                        <!-- Supprimer text sans cadre -->
                                                        <form action="{{ route('timetables.destroy', $timetable->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="javascript:void(0);" class="text-danger font-weight-bold text-xs" title="Supprimer" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet emploi du temps ?')) { this.closest('form').submit(); }">
                                                                Supprimer
                                                            </a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
