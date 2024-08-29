<x-app-layout>
    <div class="d-flex justify-content-center align-items-center main-content position-relative max-height-vh-100 h-100 border-radius-lg" style="min-height: 100vh; background-color: #f8f9fa;">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm border-light" style="border-radius: 8px;">
                <div class="card-header bg-primary text-white" style="border-radius: 8px 8px 0 0;">
                    <h6 class="text-center mb-0">Modifier le Professeur</h6>
                </div>
                <div class="card-body px-4 py-4">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom du Professeur</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom du professeur" required>
                        </div>
                        <div class="mb-3">
                            <label for="departement" class="form-label">Département</label>
                            <input type="text" class="form-control" id="departement" name="departement" placeholder="Entrez le département" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrez l'email" required>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Entrez le numéro de téléphone" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Mettre à Jour</button>
                            <a href="#" class="btn btn-secondary ms-2">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
