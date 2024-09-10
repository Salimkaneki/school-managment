<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <h6 class="mb-0">Créer un Emploi du Temps</h6>
                            <p class="text-sm mb-0">Choisissez la classe pour créer un emploi du temps.</p>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="#" method="GET">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="class" class="form-label">Classe</label>
                                        <select class="form-select" id="class" name="class_id" required>
                                            <option value="" selected disabled>Choisissez une classe</option>
                                            <!-- Options de classe -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12 d-flex align-items-end justify-content-end">
                                        <button type="submit" class="btn btn-light text-dark border-dark">Créer l'Emploi du Temps</button>
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
