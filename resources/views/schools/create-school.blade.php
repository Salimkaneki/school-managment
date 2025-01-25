<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('components.app.admin_sidebar')
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Créer un établissement</h3>
                            <p class="mb-0">Formulaire de création d'une nouvelle école</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-0">

            <div class="row my-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nom de l'établissement</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Téléphone</label>
                                        <input type="tel" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Logo</label>
                                        <input type="file" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Adresse</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
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