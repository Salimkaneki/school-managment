<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm" style="border-radius: 8px; border: 1px solid #e0e0e0;">
                        <div class="card-header" style="background-color: #6c757d; color: #ffffff; border-radius: 8px 8px 0 0;">
                            <h5 class="mb-0" style="color: #ffffff;">Créer une Nouvelle Salle de Classe</h5>
                        </div>
                        <div class="card-body" style="background-color: #f8f9fa;">
                            <form action="#" method="POST">
                                <div class="mb-4">
                                    <label for="name" class="form-label" style="color: #495057;">Nom de la Salle</label>
                                    <input type="text" class="form-control" id="name" name="name" required style="border-radius: 4px; border: 1px solid #ced4da;">
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="capacity" class="form-label" style="color: #495057;">Capacité</label>
                                        <input type="number" class="form-control" id="capacity" name="capacity" required style="border-radius: 4px; border: 1px solid #ced4da;">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="class_model_id" class="form-label" style="color: #495057;">Classe Associée</label>
                                        <select class="form-control" id="class_model_id" name="class_model_id" required style="border-radius: 4px; border: 1px solid #ced4da;">
                                            <option value="1">Classe A</option>
                                            <option value="2">Classe B</option>
                                            <option value="3">Classe C</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn" style="background-color: #6c757d; color: #ffffff;">Créer la Salle</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
