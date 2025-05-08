<x-app-layout>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <x-app.navbar />
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0">
              <div class="d-sm-flex align-items-center mb-3">
                <div>
                  <h6 class="font-weight-semibold text-lg mb-0">Modifier une Année Académique</h6>
                  <p class="text-sm mb-0">Modifiez les détails de l'année académique et ses trimestres</p>
                </div>
                <div class="ms-auto d-flex">
                  <a href="{{ route('academic-years.index') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                    <span class="btn-inner--icon me-1">
                      <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="btn-inner--text">Retour à la liste</span>
                  </a>
                </div>
              </div>
            </div>

            <div class="card-body">
              @if(session('error'))
                <div class="alert alert-danger text-white alert-dismissible fade show" role="alert">
                  <span class="alert-icon"><i class="fas fa-exclamation-triangle"></i></span>
                  <span class="alert-text">{{ session('error') }}</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              <form action="{{ route('academic-years.update', $academicYear) }}" 
                    method="POST" 
                    id="academicYearForm"
                    class="needs-validation"
                    novalidate>
                @csrf
                @method('PUT')

                <!-- Section Année Académique -->
                <div class="bg-gray-100 p-4 rounded mb-4">
                  <h6 class="text-dark mb-3 font-weight-bold">Informations Générales</h6>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label for="start_year" class="form-label required">Année de Début</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        <input type="number" 
                               class="form-control @error('start_year') is-invalid @enderror" 
                               id="start_year" 
                               name="start_year" 
                               value="{{ old('start_year', $academicYear->start_year) }}" 
                               min="2000"
                               placeholder="Ex: 2024"
                               required>
                      </div>
                      @error('start_year')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                      @enderror
                    </div>
                    
                    <div class="col-md-6">
                      <label for="end_year" class="form-label required">Année de Fin</label>
                      <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        <input type="number" 
                               class="form-control @error('end_year') is-invalid @enderror" 
                               id="end_year" 
                               name="end_year" 
                               value="{{ old('end_year', $academicYear->end_year) }}" 
                               min="2000"
                               placeholder="Ex: 2025"
                               required>
                      </div>
                      @error('end_year')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="form-check mt-3">
                    <input class="form-check-input" 
                           type="checkbox" 
                           id="is_active" 
                           name="is_active" 
                           {{ old('is_active', $academicYear->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                      Définir comme année académique active
                    </label>
                    <small class="form-text text-muted d-block">
                      Une seule année académique peut être active à la fois
                    </small>
                  </div>
                </div>

                <!-- Section Trimestres -->
                <div class="bg-gray-100 p-4 rounded mb-4">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="text-dark mb-0 font-weight-bold">Trimestres</h6>
                    <button type="button" class="btn btn-sm btn-secondary" id="add-trimester">
                      <i class="fas fa-plus me-2"></i>Ajouter un Trimestre
                    </button>
                  </div>
                  
                  <div id="trimesters" class="border rounded p-3 bg-white">
                    @if($academicYear->trimesters->count() > 0)
                      @foreach($academicYear->trimesters as $index => $trimester)
                        <div class="row trimester-item mb-3 pb-3 border-bottom">
                          <div class="col-md-4">
                            <label class="form-label required">Nom du Trimestre</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="trimesters[{{ $index }}][name]" 
                                   value="{{ old("trimesters.$index.name", $trimester->name) }}" 
                                   placeholder="Ex: Premier Trimestre"
                                   required>
                          </div>
                          <div class="col-md-3">
                            <label class="form-label required">Date de Début</label>
                            <input type="date" 
                                   class="form-control trimester-start-date" 
                                   name="trimesters[{{ $index }}][start_date]" 
                                   value="{{ old("trimesters.$index.start_date", $trimester->start_date->format('Y-m-d')) }}" 
                                   required>
                          </div>
                          <div class="col-md-3">
                            <label class="form-label required">Date de Fin</label>
                            <input type="date" 
                                   class="form-control trimester-end-date" 
                                   name="trimesters[{{ $index }}][end_date]" 
                                   value="{{ old("trimesters.$index.end_date", $trimester->end_date->format('Y-m-d')) }}" 
                                   required>
                          </div>
                          <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm remove-trimester w-100">
                              <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                          </div>
                        </div>
                      @endforeach
                    @else
                      <div class="row trimester-item mb-3 pb-3 border-bottom">
                        <div class="col-md-4">
                          <label class="form-label required">Nom du Trimestre</label>
                          <input type="text" 
                                 class="form-control" 
                                 name="trimesters[0][name]" 
                                 placeholder="Ex: Premier Trimestre"
                                 required>
                        </div>
                        <div class="col-md-3">
                          <label class="form-label required">Date de Début</label>
                          <input type="date" 
                                 class="form-control trimester-start-date" 
                                 name="trimesters[0][start_date]" 
                                 required>
                        </div>
                        <div class="col-md-3">
                          <label class="form-label required">Date de Fin</label>
                          <input type="date" 
                                 class="form-control trimester-end-date" 
                                 name="trimesters[0][end_date]" 
                                 required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                          <button type="button" class="btn btn-danger btn-sm remove-trimester w-100">
                            <i class="fas fa-trash me-2"></i>Supprimer
                          </button>
                        </div>
                      </div>
                    @endif
                  </div>
                  @error('trimesters')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                  <a href="{{ route('academic-years.index') }}" class="btn btn-light">
                    Annuler
                  </a>
                  <button type="submit" class="btn btn-dark">
                    <i class="fas fa-save me-2"></i>Mettre à jour
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <x-app.footer />
  </main>
</x-app-layout>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const addTrimesterButton = document.getElementById('add-trimester');
    const trimestersContainer = document.getElementById('trimesters');

    addTrimesterButton.addEventListener('click', function() {
      const trimesterCount = trimestersContainer.querySelectorAll('.trimester-item').length;
      const trimesterTemplate = `
        <div class="row trimester-item mb-3 pb-3 border-bottom">
          <div class="col-md-4">
            <label class="form-label required">Nom du Trimestre</label>
            <input type="text" 
                   class="form-control" 
                   name="trimesters[${trimesterCount}][name]" 
                   placeholder="Ex: Trimestre ${trimesterCount + 1}"
                   required>
          </div>
          <div class="col-md-3">
            <label class="form-label required">Date de Début</label>
            <input type="date" 
                   class="form-control trimester-start-date" 
                   name="trimesters[${trimesterCount}][start_date]" 
                   required>
          </div>
          <div class="col-md-3">
            <label class="form-label required">Date de Fin</label>
            <input type="date" 
                   class="form-control trimester-end-date" 
                   name="trimesters[${trimesterCount}][end_date]" 
                   required>
          </div>
          <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-danger btn-sm remove-trimester w-100">
              <i class="fas fa-trash me-2"></i>Supprimer
            </button>
          </div>
        </div>
      `;
      trimestersContainer.insertAdjacentHTML('beforeend', trimesterTemplate);
    });

    trimestersContainer.addEventListener('click', function(event) {
      if (event.target.classList.contains('remove-trimester') || event.target.closest('.remove-trimester')) {
        event.target.closest('.trimester-item').remove();
      }
    });
  });
</script>