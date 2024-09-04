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
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des Élèves par Classe</h6>
                                    <p class="text-sm text-muted">Veuillez sélectionner une classe pour voir les élèves correspondants.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="p-4">
                                <label for="class-select" class="form-label">Choisir une Classe :</label>
                                <select id="class-select" class="form-select">
                                    <option value="" selected disabled>Choisissez une classe</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <a id="download-link" href="#" class="btn btn-primary mt-2" style="display:none;">Télécharger PDF</a>
                            </div>
                            <div id="students-table" class="table-responsive p-4">
                                <!-- Les élèves seront affichés ici -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>

<script>
    document.getElementById('class-select').addEventListener('change', function() {
        let classId = this.value;

        if (!classId) {
            document.getElementById('students-table').innerHTML = '';
            return;
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
            let studentsTable = document.getElementById('students-table');
            let tableContent = `<table class="table align-items-center mb-0 table-bordered text-center">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Prénom et Nom</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Téléphone</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Email</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Classe Assignée</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;

            if (data.length > 0) {
                data.forEach(student => {
                    tableContent += `<tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center ms-1">
                                                <h6 class="mb-0 text-sm font-weight-semibold">${student.first_name} ${student.last_name}</h6>
                                                <p class="text-sm text-secondary mb-0">${student.nationality || 'Non précisé'}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm text-dark font-weight-semibold mb-0">${student.phone_number || 'Non précisé'}</p>
                                            <p class="text-sm text-secondary mb-0">Téléphone</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-sm font-weight-normal">${student.email || 'Non précisé'}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-sm font-weight-normal">${student.class_name || 'Aucune'}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="#" class="text-secondary font-weight-bold text-xs me-2" data-bs-toggle="tooltip" data-bs-title="Modifier">
                                                <svg width="14" height="14" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99976 15V12.2279H-0.000244141V15H1.99976ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z" fill="#64748B"/>
                                                </svg>
                                            </a>
                                            <form action="#" method="POST" style="display:inline;">
                                                <button type="submit" class="text-secondary font-weight-bold text-xs" title="Supprimer">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                     </tr>`;
                });
            } else {
                tableContent += `<tr><td colspan="5" class="text-center text-secondary">Aucun élève trouvé pour cette classe.</td></tr>`;
            }

            tableContent += `</tbody></table>`;
            studentsTable.innerHTML = tableContent;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('students-table').innerHTML = '<p class="text-danger">Une erreur est survenue lors de la récupération des élèves.</p>';
        });
    });
</script>
