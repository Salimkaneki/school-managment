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
                                    <h6 class="mb-0">Créer une Nouvelle Classe et ses Salles</h6>
                                    <p class="text-sm mb-0">Veuillez remplir les informations ci-dessous</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('class-list') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Classes
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="{{ route('store-class') }}" method="POST">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nom de la Classe</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom de la classe" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fees" class="form-label">Frais de Scolarité</label>
                                        <input type="number" class="form-control" id="fees" name="fees" placeholder="Entrez les frais de scolarité" step="0.01" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="Entrez une description" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <h6>Salles de Classe</h6>
                                        <div id="classrooms-container">
                                            <!-- Salles de Classe 1 -->
                                            <div class="classroom-entry mb-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="classroom_name_1" class="form-label">Nom de la Salle</label>
                                                        <input type="text" class="form-control" id="classroom_name_1" name="classrooms[0][name]" placeholder="Entrez le nom de la salle" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="classroom_capacity_1" class="form-label">Capacité</label>
                                                        <input type="number" class="form-control" id="classroom_capacity_1" name="classrooms[0][capacity]" placeholder="Entrez la capacité de la salle" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-dark" onclick="addClassroomEntry()">Ajouter une Salle</button>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 d-flex align-items-end justify-content-end">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-light text-dark border-dark">Créer la Classe et ses Salles</button>
                                            <a href="{{ route('class-list') }}" class="btn btn-secondary ms-2">Annuler</a>
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

    <script>
        let classroomIndex = 1;

        function addClassroomEntry() {
            const container = document.getElementById('classrooms-container');
            const entry = document.createElement('div');
            entry.className = 'classroom-entry mb-3';
            entry.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <label for="classroom_name_${classroomIndex}" class="form-label">Nom de la Salle</label>
                        <input type="text" class="form-control" id="classroom_name_${classroomIndex}" name="classrooms[${classroomIndex}][name]" placeholder="Entrez le nom de la salle" required>
                    </div>
                    <div class="col-md-6">
                        <label for="classroom_capacity_${classroomIndex}" class="form-label">Capacité</label>
                        <input type="number" class="form-control" id="classroom_capacity_${classroomIndex}" name="classrooms[${classroomIndex}][capacity]" placeholder="Entrez la capacité de la salle" required>
                    </div>
                </div>
            `;
            container.appendChild(entry);
            classroomIndex++;
        }
    </script>
</x-app-layout>
