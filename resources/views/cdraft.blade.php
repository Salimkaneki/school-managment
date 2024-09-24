<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid px-4 py-4">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="pb-0 card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="mb-0">Enregistrer un Paiement</h6>
                                    <p class="text-sm mb-0">Veuillez entrer les détails du paiement ci-dessous</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Paiements
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="#" method="POST">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="class_id" class="form-label">Classe</label>
                                        <select class="form-select" id="class_id" name="class_id" required onchange="updateStudents(this.value)">
                                            <option value="" disabled selected>Choisir une classe</option>
                                            <!-- Dynamically populate class options -->
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="student_id" class="form-label">Élève</label>
                                        <select class="form-select" id="student_id" name="student_id" required>
                                            <option value="" disabled selected>Choisir un élève</option>
                                            <!-- Options will be added dynamically -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="amount_due" class="form-label">Montant dû</label>
                                        <input type="number" step="0.01" class="form-control" id="amount_due" name="amount_due" placeholder="Montant dû" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="amount_paid" class="form-label">Montant payé</label>
                                        <input type="number" step="0.01" class="form-control" id="amount_paid" name="amount_paid" placeholder="Montant payé" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="balance" class="form-label">Solde</label>
                                        <input type="number" step="0.01" class="form-control" id="balance" name="balance" placeholder="Solde" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="payment_date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="payment_date" name="payment_date" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 d-flex align-items-end justify-content-end">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-dark text-white">Enregistrer</button>
                                            <a href="#" class="btn btn-secondary ms-2">Annuler</a>
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
        function updateStudents(classId) {
            const studentSelect = document.getElementById('student_id');
            studentSelect.innerHTML = '<option value="" disabled selected>Choisir un élève</option>';

            if (classId) {
                fetch(`/api/students?class_id=${classId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(student => {
                            const option = document.createElement('option');
                            option.value = student.id;
                            option.textContent = student.name;
                            studentSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching students:', error);
                    });
            }
        }
    </script>
</x-app-layout>
