<x-app-layout>
    <style>
        .modal {
            z-index: 1060 !important;
        }
        .modal-backdrop {
            z-index: 1050 !important;
        }
    </style>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div>
                                <h6 class="font-weight-semibold text-lg mb-0">Liste des Absences</h6>
                                <p class="text-sm">Voici la liste des absences des élèves</p>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100 text-center">
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Nom de l'Élève</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Classe</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Date</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Heures d'Absence</th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="attendanceTableBody">
                                    @foreach($attendances as $attendance)
                                        <tr>
                                            <td class="align-middle bg-transparent border-bottom text-xs">
                                                {{ $attendance->student->last_name }} {{ $attendance->student->first_name }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">
                                                {{ $attendance->class->name }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">
                                                {{ $attendance->date->format('d/m/Y') }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">
                                                @if($attendance->absence_times)
                                                    @foreach($attendance->absence_times as $time)
                                                        <div>{{ $time['start'] }} - {{ $time['end'] }}</div>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">Aucune heure spécifiée</span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle bg-transparent border-bottom text-xs">
                                                <button type="button" 
                                                        class="text-secondary font-weight-bold text-xs border-0 bg-transparent"
                                                        onclick="editAbsence({{ $attendance->id }})">
                                                    Modifier
                                                </button>
                                                <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0 ms-2" 
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette absence ?')">
                                                        Supprimer
                                                    </button>
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

        <!-- Modal avec z-index corrigé -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Modifier l'Absence</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="edit_class_id" class="form-label">Classe</label>
                                    <select class="form-control" id="edit_class_id" name="class_id" required>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_student_id" class="form-label">Élève</label>
                                    <select class="form-control" id="edit_student_id" name="student_id" required>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->last_name }} {{ $student->first_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="edit_absence_times">
                                <!-- Les heures seront ajoutées dynamiquement ici -->
                            </div>
                            <button type="button" class="btn btn-secondary mt-2" id="edit_add_time">Ajouter une Heure</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <x-app.footer />
    </main>

    <script>
    function editAbsence(id) {
        // Réinitialiser le formulaire
        document.getElementById('edit_absence_times').innerHTML = '';
        
        // Chercher les données de l'absence
        fetch(`/attendances/${id}/data`)
            .then(response => response.json())
            .then(data => {
                const attendance = data.attendance;
                
                // Mettre à jour l'action du formulaire
                document.getElementById('editForm').action = `/attendances/${id}`;
                
                // Mettre à jour les sélections
                document.getElementById('edit_class_id').value = attendance.class_id;
                document.getElementById('edit_student_id').value = attendance.student_id;
                
                // Ajouter les heures d'absence
                if (attendance.absence_times) {
                    attendance.absence_times.forEach(time => {
                        addEditTimeRow(time.start, time.end);
                    });
                }
                
                // Ouvrir le modal
                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
    }

    function addEditTimeRow(startValue = '', endValue = '') {
        const container = document.getElementById('edit_absence_times');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-3 absence-time';
        newRow.innerHTML = `
            <div class="col-md-5">
                <label class="form-label">Heure de Début</label>
                <input type="time" name="start_time[]" class="form-control" required value="${startValue}">
            </div>
            <div class="col-md-5">
                <label class="form-label">Heure de Fin</label>
                <input type="time" name="end_time[]" class="form-control" required value="${endValue}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm remove-time">Supprimer</button>
            </div>
        `;
        container.appendChild(newRow);
        
        newRow.querySelector('.remove-time').addEventListener('click', function() {
            this.closest('.absence-time').remove();
        });
    }

    document.getElementById('edit_add_time').addEventListener('click', function() {
        addEditTimeRow();
    });
    </script>
</x-app-layout>