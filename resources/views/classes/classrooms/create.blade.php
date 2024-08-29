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
                                    <h6 class="mb-0">Créer une Nouvelle Salle de Classe</h6>
                                    <p class="text-sm mb-0">Veuillez remplir les informations ci-dessous</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('list-classrooms') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Salles de Classe
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="{{ route('store-classroom') }}" method="POST">
                                @csrf
                                
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Nom de la Salle</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom de la salle" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="capacity" class="form-label">Capacité</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Entrez la capacité de la salle" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="class_model_id" class="form-label">Classe Associée</label>
                                        <select class="form-control" id="class_model_id" name="class_model_id" required>
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 d-flex align-items-end justify-content-end">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-light text-dark border-dark">Créer la Salle</button>
                                            <a href="{{ route('list-classrooms') }}" class="btn btn-secondary ms-2">Annuler</a>
                                        </div>
                                    </div>
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
