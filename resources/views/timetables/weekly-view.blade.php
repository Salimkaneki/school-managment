<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <h6 class="mb-0">Emploi du Temps pour la Salle : {{ $classroomName }}</h6>
                            <p class="text-sm mb-0">Classe : {{ $className }}</p>
                        </div>
                        <div class="card-body px-4 py-4">
                            <!-- Tableau de l'emploi du temps -->
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
                                                        <small>Salle: {{ $courses[$day]['classroom_name'] }}</small>
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
        <x-app.footer />
    </main>
</x-app-layout>
