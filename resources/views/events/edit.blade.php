<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="pb-0 card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="mb-0">Modifier l'Événement</h6>
                                    <p class="text-sm mb-0">Vous pouvez modifier les informations de l'événement ci-dessous</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('event.list') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Événements
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="{{ route('event.update', $event->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="title" class="form-label">Titre de l'Événement</label>
                                        <input type="text" class="form-control" id="title" name="title" 
                                               value="{{ old('title', $event->title) }}" 
                                               placeholder="Entrez le titre de l'événement" required>
                                        @error('title')
                                            <span class="text-danger text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="event_date" class="form-label">Date de l'Événement</label>
                                        <input type="date" class="form-control" id="event_date" name="event_date" 
                                               value="{{ old('event_date', $event->event_date ? $event->event_date->format('Y-m-d') : '') }}" required>
                                        @error('event_date')
                                            <span class="text-danger text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" 
                                                  placeholder="Entrez une description" rows="3">{{ old('description', $event->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 d-flex align-items-end justify-content-end">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-light text-dark border-dark">
                                                <i class="fas fa-save me-1"></i> Enregistrer les modifications
                                            </button>
                                            <a href="{{ route('event.list') }}" class="btn btn-secondary ms-2">
                                                <i class="fas fa-times me-1"></i> Annuler
                                            </a>
                                        </div>
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