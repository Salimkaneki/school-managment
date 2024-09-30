<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Liste des Présences</h6>
                                <p class="text-sm">Voici la liste des présences des élèves</p>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100 text-center">
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">ID Élève</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Nom de l'Élève</th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Classe</th> <!-- Nouvelle colonne -->
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Date de Présence</th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Statut</th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="attendanceTableBody">
                                    @foreach($attendances as $attendance)
                                        <tr>
                                            <td class="align-middle bg-transparent border-bottom text-xs">{{ $attendance->student_id }}</td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">{{ $attendance->student->last_name }} {{ $attendance->student->first_name }}</td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">{{ $attendance->class->name }}</td> <!-- Afficher la classe de l'élève -->
                                            <td class="align-middle bg-transparent border-bottom text-xs">{{ $attendance->date }}</td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">{{ $attendance->present }}</td>
                                            <td class="text-center align-middle bg-transparent border-bottom text-xs">
                                                <a href="#" class="text-secondary font-weight-bold text-xs">Modifier</a>
                                                <form action="#" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0 ms-2">Supprimer</button>
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
