<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header" style="background-color: #6c757d; color: #ffffff; border-radius: 8px 8px 0 0;">
                            <h6 class="mb-0">Ajouter une Inscription</h6>
                            <p class="text-sm mb-0">Veuillez remplir les informations ci-dessous</p>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="#" method="POST">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label for="student_id" class="form-label" style="color: #495057;">Nom de l'Élève</label>
                                        <select class="form-control" id="student_id" name="student_id" required style="border-radius: 4px; border: 1px solid #ced4da;">
                                            <!-- Boucle pour afficher les élèves -->
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="class_id" class="form-label" style="color: #495057;">Classe</label>
                                        <select class="form-control" id="class_id" name="class_id" required style="border-radius: 4px; border: 1px solid #ced4da;">
                                            <!-- Boucle pour afficher les classes -->
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="enrollment_date" class="form-label" style="color: #495057;">Date d'Inscription</label>
                                    <input type="date" class="form-control" id="enrollment_date" name="enrollment_date" required style="border-radius: 4px; border: 1px solid #ced4da;">
                                </div>
                                <button type="submit" class="btn" style="background-color: #6c757d; color: #ffffff;">Ajouter l'Inscription</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
