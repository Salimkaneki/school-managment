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
                                <h5 class="mb-0">Nouveau Message</h5>
                                <div class="form-check form-switch ms-2">
                                    <input class="form-check-input" type="checkbox" id="priorityToggle">
                                    <label class="form-check-label" for="priorityToggle">Message urgent</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Type de message</label>
                                        <select class="form-select" id="messageType">
                                            <option value="sms">SMS</option>
                                            <option value="whatsapp">WhatsApp</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Groupe de destinataires</label>
                                        <select class="form-select" multiple>
                                            <option>Tous les administrateurs</option>
                                            <option>Enseignants</option>
                                            <option>Parents</option>
                                            <option>Élèves</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Numéro spécifique</label>
                                    <input type="tel" class="form-control" placeholder="Numéro de téléphone (optionnel)">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="4" placeholder="Rédigez votre message ici..." maxlength="1000"></textarea>
                                    <small class="text-muted">Caractères restants: <span id="charCount">1000</span></small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 whatsapp-only" style="display: none;">
                                        <label class="form-label">Pièces jointes (WhatsApp uniquement)</label>
                                        <input type="file" class="form-control" accept="image/*,video/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Modèle de message</label>
                                        <select class="form-select">
                                            <option>Sélectionner un modèle</option>
                                            <option>Rappel réunion</option>
                                            <option>Information générale</option>
                                            <option>Alerte urgente</option>
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