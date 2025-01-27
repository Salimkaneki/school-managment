<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        {{-- @include('components.app.admin_sidebar') --}}
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Nouvelle Communication</h5>
                                <div class="form-check form-switch ms-2">
                                    <input class="form-check-input" type="checkbox" id="priorityToggle">
                                    <label class="form-check-label" for="priorityToggle">Message prioritaire</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Destinataire</label>
                                        <select class="form-select" multiple>
                                            <option>Tous les administrateurs</option>
                                            <option>Enseignants</option>
                                            <option>Parents</option>
                                            <option>Élèves</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email spécifique</label>
                                        <input type="email" class="form-control" placeholder="Email individuel (optionnel)">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Sujet</label>
                                    <input type="text" class="form-control" placeholder="Objet du message">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="5" placeholder="Rédigez votre message ici..."></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pièces jointes</label>
                                        <input type="file" class="form-control" multiple>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Modèle de message</label>
                                        <select class="form-select">
                                            <option>Sélectionner un modèle</option>
                                            <option>Rappel réunion</option>
                                            <option>Information générale</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" class="btn btn-secondary me-2">Brouillon</button>
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
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