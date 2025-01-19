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
    let tableContent = `
      <table class="table align-items-center mb-0 table-bordered">
        <thead class="bg-gray-100">
          <tr>
            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-3">Prénom et Nom</th>
            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Contacts</th>
            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Classe</th>
            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
          </tr>
        </thead>
        <tbody>`;

    if (data.length > 0) {
      data.forEach(student => {
        let photoUrl = student.photo 
          ? `{{ Storage::url('${student.photo}') }}`
          : '{{ asset("images/default-avatar.png") }}';

        // Ligne principale du tableau
        tableContent += `
          <tr>
            <td>
              <div class="d-flex px-2 py-1">
                <div>
                  <img src="${photoUrl}" class="avatar avatar-sm rounded-circle me-2" alt="Photo de ${student.first_name}">
                </div>
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="mb-0 text-sm font-weight-semibold">${student.last_name} ${student.first_name}</h6>
                </div>
              </div>
            </td>
            <td class="align-middle text-center text-sm">
              <p class="text-sm text-dark font-weight-semibold mb-0">${student.phone_number || 'Non renseigné'}</p>
              <span class="text-secondary text-sm font-weight-normal">${student.email || 'Non renseigné'}</span>
            </td>
            <td class="align-middle text-center">
              <span class="text-secondary text-sm font-weight-normal">
                ${student.classModel ? student.classModel.name : 'Non assigné'}
              </span>
              <br>
              <span class="text-secondary text-sm font-weight-normal">
                ${student.academicYear ? student.academicYear.name : 'Aucune année'}
              </span>
            </td>
            <td class="align-middle text-center">
              <div class="d-flex justify-content-center gap-2">
                <button type="button" class="btn btn-link text-primary px-3 mb-0"
                        data-bs-toggle="modal" data-bs-target="#studentModal${student.id}">
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.58 12C15.58 13.98 13.98 15.58 12 15.58C10.02 15.58 8.42001 13.98 8.42001 12C8.42001 10.02 10.02 8.42001 12 8.42001C13.98 8.42001 15.58 10.02 15.58 12Z" stroke="#007bff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 20.27C15.53 20.27 18.82 18.19 21.11 14.59C22.01 13.18 22.01 10.81 21.11 9.39997C18.82 5.79997 15.53 3.71997 12 3.71997C8.47003 3.71997 5.18003 5.79997 2.89003 9.39997C1.99003 10.81 1.99003 13.18 2.89003 14.59C5.18003 18.19 8.47003 20.27 12 20.27Z" stroke="#007bff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </button>
                <a href="{{ route('edit-students', '') }}/${student.id}" class="btn btn-link text-warning px-3 mb-0">
                  <svg width="14" height="14" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H0C0 15.5523 0.447715 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 0 11.9624 0 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99951 15V12.2279H0V15H1.99951ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z" fill="#FF8600"/>
                  </svg>
                </a>
                <form action="{{ route('student.delete', '') }}/${student.id}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-link text-danger px-3 mb-0"
                          onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')">
                    <svg width="14" height="14" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M1.98314 3.33333H14.0165" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M12.3499 3.33333V14C12.3499 14.442 12.1744 14.8659 11.8619 15.1785C11.5493 15.4911 11.1254 15.6667 10.6833 15.6667H5.31661C4.87458 15.6667 4.45067 15.4911 4.13811 15.1785C3.82555 14.8659 3.64994 14.442 3.64994 14V3.33333M5.31661 3.33333V1.66667C5.31661 1.22464 5.49221 0.800716 5.80477 0.488155C6.11734 0.175595 6.54125 0 6.98327 0H8.99994C9.44196 0 9.86588 0.175595 10.1784 0.488155C10.491 0.800716 10.6666 1.22464 10.6666 1.66667V3.33333" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M6.98327 7.33333V11.6667" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M9.01661 7.33333V11.6667" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </button>
                </form>
              </div>

              <!-- Modal Détails Élève -->
              <div class="modal fade" id="studentModal${student.id}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header bg-light">
                      <h5 class="modal-title" style="color: #000;">Détails de l'Élève</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                      <div class="row g-4">
                        <!-- Photo de l'élève et informations principales -->
                        <div class="col-lg-4 text-center">
                          <img src="${photoUrl}" 
                               alt="Photo de ${student.first_name}" 
                               class="img-fluid rounded-circle border shadow-sm mb-3" 
                               style="width: 180px; height: 180px; object-fit: cover;">
                          <h4 class="mb-2" style="color: #000;">${student.first_name} ${student.last_name}</h4>
                          <div class="d-flex justify-content-center gap-2 flex-wrap mb-3">
                            <span class="badge" style="background-color: #E3F2FD; color: #1976D2; font-weight: 500; padding: 8px 12px;">
                              <i class="fas fa-graduation-cap me-1"></i> ${student.classModel ? student.classModel.name : 'Non assigné'}
                            </span>
                            <span class="badge" style="background-color: #E8F5E9; color: #2E7D32; font-weight: 500; padding: 8px 12px;">
                              <i class="fas fa-calendar-alt me-1"></i> ${student.academicYear ? student.academicYear.name : 'Non assigné'}
                            </span>
                          </div>
                          ${student.email ? 
                            `<button class="btn btn-outline-primary btn-sm w-100 mb-2">
                              <i class="fas fa-envelope me-2"></i>${student.email}
                            </button>` : ''}
                        </div>

                        <!-- Informations détaillées -->
                        <div class="col-lg-8">
                          <div class="row g-4">
                            <!-- Informations personnelles -->
                            <div class="col-12">
                              <h6 class="border-bottom pb-2 mb-3" style="color: #000;">Informations personnelles</h6>
                              <div class="row g-3">
                                <div class="col-sm-6">
                                  <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                      <span class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                        <i class="fas fa-calendar text-primary"></i>
                                      </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                      <small style="color: #000;">Date de naissance</small>
                                      <div style="color: #000; font-weight: 500;">
                                        ${student.date_of_birth ? new Date(student.date_of_birth).toLocaleDateString() : 'Non renseigné'}
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                      <span class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                        <i class="fas fa-venus-mars text-primary"></i>
                                      </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                      <small style="color: #000;">Genre</small>
                                      <div style="color: #000; font-weight: 500;">
                                        ${student.gender == 'male' ? 'Masculin' : (student.gender == 'female' ? 'Féminin' : 'Autre')}
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                      <span class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                        <i class="fas fa-globe text-primary"></i>
                                      </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                      <small style="color: #000;">Nationalité</small>
                                      <div style="color: #000; font-weight: 500;">
                                        ${student.nationality || 'Non renseignée'}
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- Coordonnées -->
                            <div class="col-12">
                              <h6 class="border-bottom pb-2 mb-3" style="color: #000;">Coordonnées</h6>
                              ${student.address ? 
                                `<div class="d-flex align-items-start mb-3">
                                  <span class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 35px; height: 35px;">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                  </span>
                                  <div class="ms-3">
                                    <small style="color: #000;">Adresse</small>
                                    <div style="color: #000; font-weight: 500;">${student.address}</div>
                                  </div>
                                </div>` : ''}
                              ${student.phone_number ? 
                                `<div class="d-flex align-items-center">
                                  <span class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 35px; height: 35px;">
                                    <i class="fas fa-phone text-primary"></i>
                                  </span>
                                  <div class="ms-3">
                                    <small style="color: #000;">Téléphone</small>
                                    <div style="color: #000; font-weight: 500;">${student.phone_number}</div>
                                  </div>
                                </div>` : ''}
                            </div>

                            <!-- Informations académiques -->
                            <div class="col-12">
                              <h6 class="border-bottom pb-2 mb-3" style="color: #000;">Informations académiques</h6>
                              <div class="mb-3">
                                <div class="row g-3">
                                  <div class="col-sm-6">
                                    <small style="color: #000;">Classe</small>
                                    <div style="color: #000; font-weight: 500;">
                                      ${student.classModel ? student.classModel.name : 'Non assigné'}
                                    </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <small style="color: #000;">Salle de classe</small>
                                    <div style="color: #000; font-weight: 500;">
                                      ${student.classroom ? student.classroom.name : 'Non assigné'}
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <small style="color: #000;">Année Académique</small>
                                    <div style="color: #000; font-weight: 500;">
                                      ${student.academicYear ? student.academicYear.name : 'Non assigné'}
                                    </div>
                                  </div>
                                </div>
                              </div>
                              
                              <h6 class="border-bottom pb-2 mb-3" style="color: #000;">École précédente</h6>
                              <p style="color: #000;">${student.previous_school_name || 'Non renseigné'}</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>`;
      });
    } else {
      tableContent += `
        <tr>
          <td colspan="4" class="text-center py-4">
            <p class="text-secondary mb-0">Aucun élève trouvé dans cette classe.</p>
          </td>
        </tr>`;
    }

    tableContent += `
        </tbody>
      </table>`;
    
    studentsTable.innerHTML = tableContent;
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des données:', error);
    document.getElementById('students-table').innerHTML = `
      <div class="alert alert-danger" role="alert">
        Une erreur est survenue lors du chargement des données. Veuillez réessayer.
      </div>`;
  });
});
</script>