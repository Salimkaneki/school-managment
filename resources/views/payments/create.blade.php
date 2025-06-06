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
        <div class="col-md-4">
        <label for="academic_year_id" class="form-label">Année Académique</label>
        <select class="form-select" id="academic_year_id" name="academic_year_id" required>
            <option value="" disabled selected>Choisir une année</option>
            @foreach($academicYears as $year)
                <option value="{{ $year->id }}">{{ $year->name }}</option>
            @endforeach
        </select>
    </div>

</div>

                            <!-- Section récapitulative similaire à celle de la page d'édition -->
                            <div id="payment-info-section" class="row mb-4" style="display: none;">
                                <div class="col-md-12">
                                    <div class="p-3 border rounded">
                                        <h6 class="mb-3 font-weight-bold">Récapitulatif du paiement</h6>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <span class="text-muted">Montant total dû:</span>
                                                    <strong id="display-total-fees">0 XOF</strong>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <span class="text-muted">Paiements précédents:</span>
                                                    <strong id="display-previous-paid">0 XOF</strong>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1">
                                                    <span class="text-muted">Solde actuel:</span>
                                                    <strong id="display-current-balance">0 XOF</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('payment.store') }}" method="POST">
    @csrf
    
    <!-- Champs cachés manquants -->
    <input type="hidden" id="class_id" name="class_id">
    <input type="hidden" id="student_id" name="student_id">
    
    <!-- Champs cachés existants pour stocker les valeurs -->
    <input type="hidden" id="total_fees" name="total_fees">
    <input type="hidden" id="total_previous_paid" name="total_previous_paid">
    <input type="hidden" id="remaining_balance" name="remaining_balance">

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="amount_paid" class="form-label">Montant payé</label>
            <input type="number" step="0.01" class="form-control" id="amount_paid" name="amount_paid" placeholder="Montant payé" required>
        </div>
        <div class="col-md-6">
            <label for="display_remaining" class="form-label">Solde après paiement</label>
            <input type="text" class="form-control" id="display_remaining" placeholder="Solde après paiement" readonly>
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
    </main>


    <script>
        // Stockage global des données des étudiants
// Stockage global des données des étudiants
let studentsData = {};

function filterStudents(classSelect) {
    const classId = classSelect.value;
    const studentSelect = document.getElementById('student_id');
    const paymentInfoSection = document.getElementById('payment-info-section');
    
    // Mettre à jour le champ caché class_id
    document.querySelector('input[name="class_id"]').value = classId;
    
    // Cacher la section de récapitulatif
    paymentInfoSection.style.display = 'none';

    // Récupérer les frais de la classe sélectionnée
    const selectedClass = classSelect.options[classSelect.selectedIndex];
    const fees = selectedClass.getAttribute('data-fees');
    document.getElementById('total_fees').value = fees;

    // Réinitialiser le select des étudiants
    studentSelect.innerHTML = '<option value="" disabled selected>Chargement des élèves...</option>';
    studentSelect.disabled = true;

    // Réinitialiser le stockage des données des étudiants
    studentsData = {};

    // Appeler l'API pour récupérer les élèves de la classe
    fetch(`/getStudentsByClass/${classId}`)
        .then(response => response.json())
        .then(students => {
            console.log("Données reçues:", students); // Pour le debug
            studentSelect.innerHTML = '<option value="" disabled selected>Choisir un élève</option>';
            
            students.forEach(student => {
                const option = document.createElement('option');
                option.value = student.id;
                option.textContent = `${student.first_name} ${student.last_name}`;
                studentSelect.appendChild(option);
                
                // Stocker les données dans l'objet global
                studentsData[student.id] = {
                    totalFees: student.total_fees,
                    totalPreviousPaid: student.total_previous_paid,
                    remainingBalance: student.remaining_balance
                };
            });
            
            studentSelect.disabled = false;
        })
        .catch(error => {
            console.error('Erreur:', error);
            studentSelect.innerHTML = '<option value="" disabled selected>Erreur de chargement</option>';
            studentSelect.disabled = false;
        });

    // Réinitialiser les champs
    resetPaymentFields();
}

function resetPaymentFields() {
    document.getElementById('total_previous_paid').value = '';
    document.getElementById('remaining_balance').value = '';
    document.getElementById('amount_paid').value = '';
    document.getElementById('display_remaining').value = '';
    document.getElementById('display-total-fees').textContent = '0 XOF';
    document.getElementById('display-previous-paid').textContent = '0 XOF';
    document.getElementById('display-current-balance').textContent = '0 XOF';
}

function updatePaymentInfo(studentSelect) {
    const studentId = studentSelect.value;
    const paymentInfoSection = document.getElementById('payment-info-section');
    
    // Mettre à jour le champ caché student_id
    document.querySelector('input[name="student_id"]').value = studentId;
    
    // S'assurer qu'un étudiant est sélectionné et que ses données sont disponibles
    if (!studentId || !studentsData[studentId]) {
        paymentInfoSection.style.display = 'none';
        return;
    }
    
    const studentData = studentsData[studentId];
    console.log("Données de l'étudiant:", studentData); // Pour le debug
    
    // Définir les valeurs avec un fallback à 0 si undefined
    const totalFees = parseFloat(studentData.totalFees) || 0;
    const totalPreviousPaid = parseFloat(studentData.totalPreviousPaid) || 0;
    const remainingBalance = parseFloat(studentData.remainingBalance) || 0;
    
    // Mettre à jour les champs cachés
    document.getElementById('total_fees').value = totalFees;
    document.getElementById('total_previous_paid').value = totalPreviousPaid;
    document.getElementById('remaining_balance').value = remainingBalance;
    
    // Mettre à jour les affichages formatés
    document.getElementById('display-total-fees').textContent = formatCurrency(totalFees) + ' XOF';
    document.getElementById('display-previous-paid').textContent = formatCurrency(totalPreviousPaid) + ' XOF';
    document.getElementById('display-current-balance').textContent = formatCurrency(remainingBalance) + ' XOF';
    
    // Afficher la section de récapitulatif
    paymentInfoSection.style.display = 'flex';
    
    // Réinitialiser le montant payé
    document.getElementById('amount_paid').value = '';
    document.getElementById('display_remaining').value = '';
}

// Fonction pour formater les montants en devise
function formatCurrency(value) {
    return new Intl.NumberFormat('fr-FR').format(value);
}

// Calcul du solde restant après paiement
document.getElementById('amount_paid').addEventListener('input', function() {
    const totalFees = parseFloat(document.getElementById('total_fees').value) || 0;
    const totalPreviousPaid = parseFloat(document.getElementById('total_previous_paid').value) || 0;
    const amountPaid = parseFloat(this.value) || 0;
    
    // Vérifier si tout a déjà été payé
    if (totalPreviousPaid >= totalFees) {
        document.getElementById('display_remaining').value = formatCurrency(0) + ' XOF';
        // Vous pourriez également ajouter un avertissement ici
    } else {
        const remainingBalance = Math.max(0, totalFees - totalPreviousPaid - amountPaid);
        document.getElementById('remaining_balance').value = remainingBalance;
        document.getElementById('display_remaining').value = formatCurrency(remainingBalance) + ' XOF';
    }
});

// Ajouter un gestionnaire d'événements au formulaire pour s'assurer que les champs cachés sont bien remplis
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const classId = document.getElementById('class_id').value;
            const studentId = document.getElementById('student_id').value;
            
            // Vérifier si les sélections sont faites
            if (!classId || classId === '') {
                e.preventDefault();
                alert('Veuillez sélectionner une classe.');
                return false;
            }
            
            if (!studentId || studentId === '') {
                e.preventDefault();
                alert('Veuillez sélectionner un élève.');
                return false;
            }
            
            // Tout est OK, assurez-vous que les champs cachés sont bien remplis
            const classIdInput = document.querySelector('input[name="class_id"]');
            const studentIdInput = document.querySelector('input[name="student_id"]');
            
            if (classIdInput) classIdInput.value = classId;
            if (studentIdInput) studentIdInput.value = studentId;
            
            // Le formulaire peut être soumis
            return true;
        });
    }
});

// Ajoutez cette fonction pour mettre à jour le champ caché
document.getElementById('academic_year_id').addEventListener('change', function() {
    document.getElementById('hidden_academic_year_id').value = this.value;
});

// Modifiez la fonction filterStudents pour inclure l'année académique
function filterStudents(classSelect) {
    const academicYearId = document.getElementById('academic_year_id').value;
    if (!academicYearId) {
        alert('Veuillez d\'abord sélectionner une année académique');
        return;
    }
    
    // ... reste du code existant ...
    
    // Modifiez l'URL de l'API pour inclure l'année académique
    fetch(`/getStudentsByClass/${classId}?academic_year_id=${academicYearId}`)
        .then(response => response.json())
        .then(students => {
            // ... traitement des données ...
        });
}
    </script>
</x-app-layout>