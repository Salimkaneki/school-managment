<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
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
                                        <label class="form-label">Classe</label>
                                        <select class="form-select">
                                            <option value="">Toutes les classes</option>
                                            <option value="1">Classe A</option>
                                            <option value="2">Classe B</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Parents d'élèves</label>
                                    <select class="form-select form-select-sm" multiple>
                                        <option value="+22893522532">Diop Anta (+22893522532)</option>
                                        <option value="+22870454663">Hyara Jeanne (+22870454663)</option>
                                    </select>
                                </div>

                                {{-- <div class="mb-3">
                                    <label class="form-label">Numéro spécifique</label>
                                    <div class="input-group">
                                        <select class="form-select w-auto" id="countryCode">
                                            <option value="+228">🇹🇬 +228</option>
                                            <option value="+229">🇧🇯 +229</option>
                                            <option value="+225">🇨🇮 +225</option>
                                        </select>
                                        <input type="tel" class="form-control" placeholder="Numéro de téléphone" id="phoneNumber" style="max-width: 200px;">
                                        <button type="button" class="btn btn-success" id="addNumber">Ajouter</button>
                                    </div>
                                    <ul class="list-group mt-2" id="numberList"></ul>
                                </div> --}}

                                <div class="mb-3">
                                    <label class="form-label">Numéro spécifique</label>
                                    <input type="tel" class="form-control" placeholder="Numéro de téléphone (optionnel)">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="4" id="messageInput" maxlength="1000"></textarea>
                                    <small class="text-muted">Caractères restants: <span id="charCount">1000</span></small>
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

    <script>
        document.getElementById("messageInput").addEventListener("input", function () {
            let maxLength = 1000;
            let currentLength = this.value.length;
            document.getElementById("charCount").textContent = maxLength - currentLength;
        });
    </script>
</x-app-layout>
