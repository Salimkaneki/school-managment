<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <h6 class="mb-0">Programmer des Cours</h6>
                            <p class="text-sm mb-0">Ajoutez des cours à l'emploi du temps pour la classe sélectionnée.</p>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="{{ route('timetables.addCourse', $timetable->id) }}" method="POST">
                                @csrf

                                <!-- Sélection de la Salle et du Jour sur la même ligne -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="classroom_id" class="form-label">Salle</label>
                                        <select class="form-select" id="classroom_id" name="classroom_id" required>
                                            <option value="" selected disabled>Choisissez une salle</option>
                                            @foreach($classrooms as $classroom)
                                                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="day" class="form-label">Jour</label>
                                        <select class="form-select" id="day" name="day" required>
                                            <option value="" selected disabled>Choisissez un jour</option>
                                            <option value="Lundi">Lundi</option>
                                            <option value="Mardi">Mardi</option>
                                            <option value="Mercredi">Mercredi</option>
                                            <option value="Jeudi">Jeudi</option>
                                            <option value="Vendredi">Vendredi</option>
                                            <option value="Samedi">Samedi</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Sélection du Cours et du Professeur -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="course" class="form-label">Cours</label>
                                        <select class="form-select" id="course" name="course_id" required>
                                            <option value="" selected disabled>Choisissez un cours</option>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="professor" class="form-label">Professeur</label>
                                        <select class="form-select" id="professor" name="teacher_id" required>
                                            <option value="" selected disabled>Choisissez un professeur</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->last_name }} {{ $teacher->first_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Sélection des Heures de Début et de Fin -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="start_time" class="form-label">Heure de Début</label>
                                        <input type="time" id="start_time" name="start_time" onchange="updateEndTime()" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="end_time" class="form-label">Heure de Fin</label>
                                        <input type="time" id="end_time" name="end_time" required>
                                        </div>
                                </div>

                                <!-- Gestion des erreurs (affichage des messages d'erreur si conflit de créneau) -->
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Bouton de soumission -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Ajouter le Cours</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>


<script>
function updateEndTime() {
    var startTime = document.getElementById("start_time").value;
    document.getElementById("end_time").min = startTime;
}
</script>