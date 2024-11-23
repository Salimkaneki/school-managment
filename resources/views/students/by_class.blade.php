<x-app-layout>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <x-app.navbar />
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0">
              <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                  <h6 class="font-weight-semibold text-lg mb-0">Liste des Élèves par Classe</h6>
                  <p class="text-sm text-muted">Veuillez sélectionner une classe pour voir les élèves correspondants.</p>
                </div>
                <div class="ms-auto d-flex align-items-center">
                  <a href="{{ route('student-list') }}" class="btn btn-sm btn-secondary d-flex align-items-center me-2">
                    <span class="btn-inner--icon">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16" class="me-1">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                      </svg>
                    </span>
                    <span class="btn-inner--text">Retour</span>
                  </a>
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
                <button id="download-btn" class="btn btn-primary mt-2" style="display:none;">
                  <span class="btn-inner--icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                      <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg>
                  </span>
                  <span class="btn-inner--text">Télécharger PDF</span>
                </button>
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
    document.getElementById('download-btn').style.display = 'none';
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
                              <th class="text-secondary text-xs font-weight-semibold opacity-7">Photo</th>
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
        let photoUrl = student.photo 
          ? `{{ asset('storage') }}/${student.photo}` // Génère l'URL de l'image
          : '/path/to/default/photo.jpg'; // Image par défaut si pas de photo
        tableContent += `<tr>
                          <td>
                            <img src="${photoUrl}" alt="Photo de ${student.first_name}" class="avatar avatar-sm rounded-circle me-2">
                          </td>
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
                            <span class="text-secondary text-sm font-weight-normal">${student.classModel || 'Aucune'}</span>
                          </td>
                          <td class="align-middle text-center">
                            <div class="d-flex justify-content-center gap-2">
                              <a href="#" class="btn btn-link text-warning px-3 mb-0">
                                <svg width="14" height="14" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H0C0 15.5523 0.447715 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 0 11.9624 0 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99951 15V12.2279H0V15H1.99951ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z" fill="#FF8600"/>
                                </svg>
                              </a>
                              <form action="#" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger px-3 mb-0" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')">
                                  <svg width="14" height="14" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.98314 3.33333H14.0165" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.3499 3.33333V14C12.3499 14.442 12.1744 14.8659 11.8619 15.1785C11.5493 15.4911 11.1254 15.6667 10.6833 15.6667H5.31661C4.87458 15.6667 4.45067 15.4911 4.13811 15.1785C3.82555 14.8659 3.64994 14.442 3.64994 14V3.33333M5.31661 3.33333V1.66667C5.31661 1.22464 5.49221 0.800716 5.80477 0.488155C6.11734 0.175595 6.54125 0 6.98327 0H8.99994C9.44196 0 9.86588 0.175595 10.1784 0.488155C10.491 0.800716 10.6666 1.22464 10.6666 1.66667V3.33333" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M6.98327 7.33333V11.6667" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.01661 7.33333V11.6667" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  </svg>
                                </button>
                              </form>
                            </div>
                          </td>
                        </tr>`;
      });
      document.getElementById('download-btn').style.display = 'inline-block';
    } else {
      tableContent += `<tr><td colspan="6" class="text-center text-secondary">Aucun élève trouvé pour cette classe.</td></tr>`;
      document.getElementById('download-btn').style.display = 'none';
    }

    tableContent += `</tbody></table>`;
    studentsTable.innerHTML = tableContent;
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des données des élèves:', error);
  });
});

// Ajouter le lien de téléchargement PDF
document.getElementById('download-btn').addEventListener('click', () => {
  let classId = document.getElementById('class-select').value;
  window.location.href = `#`.replace(':class_id', classId);
});
</script>