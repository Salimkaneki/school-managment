<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Emploi du Temps pour la Salle : {{ $classroomName }}</h6>
                                    <p class="text-sm mb-0">Classe : {{ $className }}</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ route('timetables.index') }}" class="btn btn-sm btn-secondary d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" class="me-1">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Retour</span>
                                    </a>
                                    <!-- <div class="dropdown">
                                        <button class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2 dropdown-toggle" type="button" id="actionMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="btn-inner--icon">
                                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                    <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                                </svg>
                                            </span>
                                            <span class="btn-inner--text">Actions</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="actionMenu">
                                            <a href="{{ route('create-student') }}" class="dropdown-item">Ajouter un Élève</a>
                                            <a href="#" class="dropdown-item">Élèves par Classe</a>
                                            <a href="{{ route('attendances.create') }}" class="dropdown-item">Enregistrer une Absence</a>
                                            <a href="{{ route('attendances.index') }}" class="dropdown-item">Liste des Absences</a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7"></th>
                                        @foreach ($daysOfWeek as $day)
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">{{ $day }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($formattedTimetables as $timeSlot => $courses)
                                        <tr>
                                            <td class="align-middle bg-gray-100 text-xs font-weight-semibold">{{ $timeSlot }}</td>
                                            @foreach ($daysOfWeek as $day)
                                                <td class="align-middle text-xs">
                                                    @if (isset($courses[$day]))
                                                        <strong>{{ $courses[$day]['course_name'] }}</strong><br>
                                                        <small>Prof. {{ $courses[$day]['teacher_name'] }}</small><br>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>