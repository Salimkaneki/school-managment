<x-app-layout>
    <main class="main-content">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header">
                    <h6>Enregistrement des Heures d'Absences</h6>
                </div>
                <div class="card-body">
                    <!-- Formulaire pour sélectionner une classe et un élève -->
                    <form method="POST" action="{{ route('attendances.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="class_id" class="form-label">Choisir une classe</label>
                                <select class="form-control" id="class_id" name="class_id" required>
                                    <option value="" disabled selected>-- Sélectionnez une classe --</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="student_id" class="form-label">Choisir un élève</label>
                                <select class="form-control" id="student_id" name="student_id" required>
                                    <option value="" disabled selected>-- Sélectionnez un élève --</option>
                                    <!-- Les élèves seront remplis dynamiquement -->
                                </select>
                            </div>
                        </div>

                        <div id="absence-times">
                            <div class="row mb-3 absence-time">
                                <div class="col-md-6">
                                    <label for="start_time[]" class="form-label">Heure de Début</label>
                                    <input type="time" name="start_time[]" class="form-control" required onchange="updateEndTime()">
                                </div>
                                <div class="col-md-6">
                                    <label for="end_time[]" class="form-label">Heure de Fin</label>
                                    <input type="time" name="end_time[]" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary mt-3" id="add-time">Ajouter une Heure</button>
                        <button type="submit" class="btn btn-primary mt-3">Enregistrer l'absence</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>

<script>
    document.getElementById('class_id').addEventListener('change', function() {
        let classId = this.value;
        let studentSelect = document.getElementById('student_id');
        studentSelect.innerHTML = '<option value="" disabled selected>-- Sélectionnez un élève --</option>'; // Reset student dropdown

        if (!classId) {
            return; // If no class selected, do nothing
        }

        fetch('{{ route("students-by-class") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ class_id: classId })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau.');
            }
            return response.json();
        })
        .then(data => {
            data.forEach(student => {
                let option = document.createElement('option');
                option.value = student.id;
                option.textContent = `${student.first_name} ${student.last_name}`;
                studentSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue lors de la récupération des élèves.');
        });
    });

    document.getElementById('add-time').addEventListener('click', function() {
        const absenceTimes = document.getElementById('absence-times');
        const newTimeRow = document.createElement('div');
        newTimeRow.className = 'row mb-3 absence-time';
        newTimeRow.innerHTML = `
            <div class="col-md-6">
                <label for="start_time[]" class="form-label">Heure de Début</label>
                <input type="time" name="start_time[]" class="form-control" required onchange="updateEndTime()">
            </div>
            <div class="col-md-6">
                <label for="end_time[]" class="form-label">Heure de Fin</label>
                <input type="time" name="end_time[]" class="form-control" required>
            </div>
        `;
        absenceTimes.appendChild(newTimeRow);
    });

    function updateEndTime() {
        // Vous pouvez ajouter une logique ici si nécessaire pour mettre à jour les heures de fin
    }
</script>
