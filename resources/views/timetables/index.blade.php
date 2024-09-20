<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <h6 class="mb-0">Liste des Emplois du Temps</h6>
                            <p class="text-sm mb-0">Voici la liste des emplois du temps créés.</p>
                        </div>
                        <div class="card-body px-4 py-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Classe</th>
                                        <th>Salle de Classe</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($timetables as $timetable)
                                    <tr>
                                        <td>{{ $timetable->id }}</td>
                                        <td>{{ $timetable->class->name }}</td>
                                        <td>{{ $timetable->classroom->name }}</td>
                                        <td>
                                            <a href="{{ route('timetables.weekly-view', $timetable->id) }}" class="btn btn-info btn-sm">Voir</a>
                                            <a href="{{ route('timetables.addCourse', $timetable->id) }}" class="btn btn-primary btn-sm">Ajouter Cours</a>
                                            <form action="{{ route('timetables.destroy', $timetable->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet emploi du temps ?')">Supprimer</button>
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
