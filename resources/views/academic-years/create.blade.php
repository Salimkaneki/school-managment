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
                  <h6 class="font-weight-semibold text-lg mb-0">{{ isset($academicYear) ? 'Modifier' : 'Créer' }} une Année Académique</h6>
                  <p class="text-sm mb-0">Définissez les détails de l'année académique et ses trimestres</p>
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

              @if(session('success'))
                <div class="alert alert-success text-white alert-dismissible fade show" role="alert">
                  <span class="alert-icon"><i class="fas fa-check"></i></span>
                  <span class="alert-text">{{ session('success') }}</span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              <form action="{{ isset($academicYear) ? route('academic-years.update', $academicYear) : route('academic-years.store') }}" 
                    method="POST" 
                    id="academicYearForm"
                    class="needs-validation"
                    novalidate>
                @csrf
                @if(isset($academicYear))
                  @method('PUT')
                @endif

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
                               value="{{ old('start_year', $academicYear->start_year ?? '') }}" 
                               min="2000"
                               max="{{ date('Y') + 10 }}"
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
                               value="{{ old('end_year', $academicYear->end_year ?? '') }}" 
                               min="2000"
                               max="{{ date('Y') + 10 }}"
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
                           value="1"
                           {{ old('is_active', $academicYear->is_active ?? false) ? 'checked' : '' }}>
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
                    @if(isset($academicYear) && $academicYear->trimesters->count() > 0)
                      @foreach($academicYear->trimesters as $index => $trimester)
                        <div class="row trimester-item mb-3 pb-3 border-bottom" data-index="{{ $index }}">
                          <div class="col-md-4">
                            <label class="form-label required">Nom du Trimestre</label>
                            <input type="text" 
                                   class="form-control @error("trimesters.$index.name") is-invalid @enderror" 
                                   name="trimesters[{{ $index }}][name]" 
                                   value="{{ old("trimesters.$index.name", $trimester->name) }}" 
                                   placeholder="Ex: Premier Trimestre"
                                   required>
                            @error("trimesters.$index.name")
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="col-md-3">
                            <label class="form-label required">Date de Début</label>
                            <input type="date" 
                                   class="form-control trimester-start-date @error("trimesters.$index.start_date") is-invalid @enderror" 
                                   name="trimesters[{{ $index }}][start_date]" 
                                   value="{{ old("trimesters.$index.start_date", $trimester->start_date->format('Y-m-d')) }}" 
                                   required>
                            @error("trimesters.$index.start_date")
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="col-md-3">
                            <label class="form-label required">Date de Fin</label>
                            <input type="date" 
                                   class="form-control trimester-end-date @error("trimesters.$index.end_date") is-invalid @enderror" 
                                   name="trimesters[{{ $index }}][end_date]" 
                                   value="{{ old("trimesters.$index.end_date", $trimester->end_date->format('Y-m-d')) }}" 
                                   required>
                            @error("trimesters.$index.end_date")
                              <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-sm remove-trimester w-100">
                              <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                          </div>
                        </div>
                      @endforeach
                    @else
                      <div class="row trimester-item mb-3 pb-3 border-bottom" data-index="0">
                        <div class="col-md-4">
                          <label class="form-label required">Nom du Trimestre</label>
                          <input type="text" 
                                 class="form-control @error('trimesters.0.name') is-invalid @enderror" 
                                 name="trimesters[0][name]" 
                                 value="{{ old('trimesters.0.name') }}"
                                 placeholder="Ex: Premier Trimestre"
                                 required>
                          @error('trimesters.0.name')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="col-md-3">
                          <label class="form-label required">Date de Début</label>
                          <input type="date" 
                                 class="form-control trimester-start-date @error('trimesters.0.start_date') is-invalid @enderror" 
                                 name="trimesters[0][start_date]" 
                                 value="{{ old('trimesters.0.start_date') }}"
                                 required>
                          @error('trimesters.0.start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="col-md-3">
                          <label class="form-label required">Date de Fin</label>
                          <input type="date" 
                                 class="form-control trimester-end-date @error('trimesters.0.end_date') is-invalid @enderror" 
                                 name="trimesters[0][end_date]" 
                                 value="{{ old('trimesters.0.end_date') }}"
                                 required>
                          @error('trimesters.0.end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
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
                  <button type="submit" class="btn btn-dark" id="submit-btn">
                    <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                    <i class="fas fa-save me-2"></i>{{ isset($academicYear) ? 'Mettre à jour' : 'Enregistrer' }}
                  </button>
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
  document.addEventListener('DOMContentLoaded', function() {
    const addTrimesterButton = document.getElementById('add-trimester');
    const trimestersContainer = document.getElementById('trimesters');
    const form = document.getElementById('academicYearForm');
    const startYearInput = document.getElementById('start_year');
    const endYearInput = document.getElementById('end_year');
    const submitBtn = document.getElementById('submit-btn');

    // Validation en temps réel des années
    function validateYears() {
      const startYear = parseInt(startYearInput.value);
      const endYear = parseInt(endYearInput.value);
      
      if (startYear && endYear && startYear >= endYear) {
        endYearInput.setCustomValidity('L\'année de fin doit être supérieure à l\'année de début');
        endYearInput.classList.add('is-invalid');
        return false;
      } else {
        endYearInput.setCustomValidity('');
        endYearInput.classList.remove('is-invalid');
        return true;
      }
    }

    // Validation des dates de trimestre
    function validateTrimesterDates(trimesterItem) {
      const startDateInput = trimesterItem.querySelector('.trimester-start-date');
      const endDateInput = trimesterItem.querySelector('.trimester-end-date');
      
      if (startDateInput.value && endDateInput.value) {
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);
        
        if (startDate >= endDate) {
          endDateInput.setCustomValidity('La date de fin doit être postérieure à la date de début');
          endDateInput.classList.add('is-invalid');
          return false;
        } else {
          endDateInput.setCustomValidity('');
          endDateInput.classList.remove('is-invalid');
          return true;
        }
      }
      return true;
    }

    // Réindexer les trimestres après ajout/suppression
    function reindexTrimesters() {
      const trimesterItems = trimestersContainer.querySelectorAll('.trimester-item');
      trimesterItems.forEach((item, index) => {
        item.setAttribute('data-index', index);
        const inputs = item.querySelectorAll('input');
        inputs.forEach(input => {
          const name = input.getAttribute('name');
          if (name) {
            const newName = name.replace(/\[\d+\]/, `[${index}]`);
            input.setAttribute('name', newName);
          }
        });
      });
    }

    // Event listeners
    startYearInput.addEventListener('input', validateYears);
    endYearInput.addEventListener('input', validateYears);

    // Validation des dates des trimestres
    trimestersContainer.addEventListener('change', function(event) {
      if (event.target.classList.contains('trimester-start-date') || 
          event.target.classList.contains('trimester-end-date')) {
        const trimesterItem = event.target.closest('.trimester-item');
        validateTrimesterDates(trimesterItem);
      }
    });

    // Ajouter un trimestre
    addTrimesterButton.addEventListener('click', function() {
      const trimesterCount = trimestersContainer.querySelectorAll('.trimester-item').length;
      
      if (trimesterCount >= 6) {
        alert('Vous ne pouvez pas ajouter plus de 6 trimestres.');
        return;
      }

      const trimesterTemplate = `
        <div class="row trimester-item mb-3 pb-3 border-bottom" data-index="${trimesterCount}">
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

    // Supprimer un trimestre
    trimestersContainer.addEventListener('click', function(event) {
      if (event.target.classList.contains('remove-trimester') || 
          event.target.closest('.remove-trimester')) {
        const trimesterItems = trimestersContainer.querySelectorAll('.trimester-item');
        
        if (trimesterItems.length <= 1) {
          alert('Vous devez avoir au moins un trimestre.');
          return;
        }
        
        event.target.closest('.trimester-item').remove();
        reindexTrimesters();
      }
    });

    // Validation et soumission du formulaire
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      
      let isValid = true;
      const spinner = submitBtn.querySelector('.spinner-border');
      const icon = submitBtn.querySelector('.fas');
      
      // Validation des années
      if (!validateYears()) {
        isValid = false;
      }
      
      // Validation des trimestres
      const trimesterItems = trimestersContainer.querySelectorAll('.trimester-item');
      trimesterItems.forEach(item => {
        if (!validateTrimesterDates(item)) {
          isValid = false;
        }
      });
      
      // Vérifier qu'il y a au moins un trimestre
      if (trimesterItems.length === 0) {
        alert('Vous devez avoir au moins un trimestre.');
        isValid = false;
      }
      
      // Validation HTML5
      if (!form.checkValidity()) {
        isValid = false;
        form.classList.add('was-validated');
      }
      
      if (isValid) {
        // Afficher le spinner
        spinner.classList.remove('d-none');
        icon.classList.add('d-none');
        submitBtn.disabled = true;
        
        // Soumettre le formulaire
        form.submit();
      } else {
        // Scroll vers la première erreur
        const firstError = form.querySelector('.is-invalid');
        if (firstError) {
          firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
          firstError.focus();
        }
      }
    });

    // Auto-complétion intelligente du nom des trimestres
    trimestersContainer.addEventListener('focus', function(event) {
      if (event.target.getAttribute('name') && event.target.getAttribute('name').includes('[name]')) {
        const trimesterIndex = parseInt(event.target.closest('.trimester-item').getAttribute('data-index'));
        if (!event.target.value) {
          const trimesterNames = [
            'Premier Trimestre',
            'Deuxième Trimestre', 
            'Troisième Trimestre',
            'Quatrième Trimestre',
            'Cinquième Trimestre',
            'Sixième Trimestre'
          ];
          if (trimesterNames[trimesterIndex]) {
            event.target.placeholder = `Ex: ${trimesterNames[trimesterIndex]}`;
          }
        }
      }
    }, true);
  });
</script>

<style>
  .required::after {
    content: " *";
    color: red;
  }
  
  .form-control.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
  }
  
  .invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
  }
  
  .spinner-border-sm {
    width: 1rem;
    height: 1rem;
  }
  
  .trimester-item:last-child {
    border-bottom: none !important;
  }
</style>