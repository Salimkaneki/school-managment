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
                                    <a href="{{ route('payment-list') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-list me-2"></i> Liste des Paiements
                                    </a>
                                </div>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-body px-4 py-4">
                            <form action="{{ route('payment.store') }}" method="POST">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="class_id" class="form-label">Classe</label>
                                        <select class="form-select" id="class_id" name="class_id" required onchange="filterStudents(this)">
                                            <option value="" disabled selected>Choisir une classe</option>
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}" data-fees="{{ $class->fees }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="student_id" class="form-label">Élève</label>
                                        <select class="form-select" id="student_id" name="student_id" required onchange="updatePaymentInfo(this)">
                                            <option value="" disabled selected>Choisir un élève</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="amount_due" class="form-label">Montant dû</label>
                                        <input type="number" step="0.01" class="form-control" id="amount_due" name="amount_due" placeholder="Montant dû" required readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="previous_payment" class="form-label">Versement précédent</label>
                                        <input type="number" step="0.01" class="form-control" id="previous_payment" name="previous_payment" placeholder="Versement précédent" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="amount_paid" class="form-label">Montant payé</label>
                                        <input type="number" step="0.01" class="form-control" id="amount_paid" name="amount_paid" placeholder="Montant payé" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="remaining_balance" class="form-label">Solde restant</label>
                                        <input type="text" class="form-control" id="remaining_balance" name="remaining_balance" placeholder="Solde" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 d-flex align-items-end justify-content-end">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-dark text-white">Enregistrer</button>
                                            <a href="{{ route('payment-list') }}" class="btn btn-secondary ms-2">Annuler</a>
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
        const students = @json($students);

        function filterStudents(classSelect) {
            const classId = classSelect.value;
            const studentSelect = document.getElementById('student_id');
            const amountDueInput = document.getElementById('amount_due');
            const previousPaymentInput = document.getElementById('previous_payment');
            const remainingBalanceInput = document.getElementById('remaining_balance');

            // Récupérer les frais de la classe sélectionnée
            const selectedClass = classSelect.options[classSelect.selectedIndex];
            const fees = selectedClass.getAttribute('data-fees');
            amountDueInput.value = fees;

            // Filtrer les étudiants appartenant à la classe sélectionnée
            studentSelect.innerHTML = '<option value="" disabled selected>Choisir un élève</option>';
            students.forEach(student => {
                if (student.class_id == classId) {
                    const option = document.createElement('option');
                    option.value = student.id;
                    option.textContent = `${student.first_name} ${student.last_name}`;
                    studentSelect.appendChild(option);
                }
            });

            // Réinitialiser les champs des paiements
            previousPaymentInput.value = '';
            remainingBalanceInput.value = '';
        }

        function updatePaymentInfo(studentSelect) {
            const studentId = studentSelect.value;
            const selectedStudent = students.find(student => student.id == studentId);

            // Mettre à jour le "Versement précédent" et le solde restant de l'élève
            document.getElementById('previous_payment').value = selectedStudent ? selectedStudent.previous_payment : 0;
            document.getElementById('remaining_balance').value = selectedStudent ? selectedStudent.remaining_balance : 0;
        }

        // Calcul du solde restant après paiement
        document.getElementById('amount_paid').addEventListener('input', function() {
            const amountDue = parseFloat(document.getElementById('amount_due').value) || 0;
            const previousPayment = parseFloat(document.getElementById('previous_payment').value) || 0;
            const amountPaid = parseFloat(this.value) || 0;
            const remainingBalance = Math.max(0, amountDue - previousPayment - amountPaid);
            document.getElementById('remaining_balance').value = remainingBalance.toFixed(2);
        });
    </script>
</x-app-layout>
