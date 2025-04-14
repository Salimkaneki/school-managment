{{-- <x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Nouveau Message</h5>
                                <div class="d-flex align-items-center">
                                    <div class="form-check form-switch me-2">
                                        <input class="form-check-input" type="checkbox" id="emergencyContactToggle" name="only_emergency_contacts">
                                        <label class="form-check-label" for="emergencyContactToggle">Contacts urgence</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="priorityToggle" name="priority">
                                        <label class="form-check-label" for="priorityToggle">Message urgent</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="communicationForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Type de message</label>
                                        <select class="form-select" id="messageType" name="message_type">
                                            <option value="sms">SMS</option>
                                            <option value="whatsapp">WhatsApp</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Classe</label>
                                        <select class="form-select" name="class_id">
                                            <option value="">Toutes les classes</option>
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Contacts d'urgence</label>
                                    <select class="form-select form-select-sm" multiple name="emergency_contact_ids[]" id="emergencyContactsSelect">
                                        @foreach($emergencyContacts as $contact)
                                            <option value="{{ $contact->id }}" 
                                                    data-student-name="{{ $contact->student->name }}"
                                                    data-contact-type="{{ $contact->type }}">
                                                {{ $contact->name }} 
                                                ({{ $contact->country_code . $contact->phone_number }}) - 
                                                {{ $contact->student->name }} 
                                                ({{ ucfirst($contact->type) }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Numéro spécifique</label>
                                    <input type="tel" class="form-control" placeholder="Numéro de téléphone (optionnel)" name="specific_number">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="4" id="messageInput" name="message" maxlength="1000" required></textarea>
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

    @push('scripts')
    <script>
        document.getElementById("messageInput").addEventListener("input", function () {
            let maxLength = 1000;
            let currentLength = this.value.length;
            document.getElementById("charCount").textContent = maxLength - currentLength;
        });

        document.getElementById('communicationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = 'Envoi en cours...';

            const formData = new FormData(this);
            
            // Ajouter la valeur de la priorité
            formData.append('priority', document.getElementById('priorityToggle').checked);

            fetch('{{ route("communications.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                submitButton.disabled = false;
                submitButton.innerHTML = 'Envoyer';

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Succès',
                        text: 'Messages envoyés avec succès',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    this.reset();
                    document.getElementById('charCount').textContent = '1000';
                    document.getElementById('priorityToggle').checked = false;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: data.message || 'Échec de l\'envoi des messages'
                    });
                }
            })
            .catch(error => {
                submitButton.disabled = false;
                submitButton.innerHTML = 'Envoyer';

                console.error('Erreur:', error);
                Swal.fire({ 
                    icon: 'error',
                    title: 'Erreur système',
                    text: 'Une erreur est survenue'
                });
            });
        });
    </script>
    @endpush
</x-app-layout> --}}
