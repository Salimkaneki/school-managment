<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des Élèves par Classe</h6>
                                    <p class="text-sm">Sélectionnez une classe pour voir les élèves</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <select id="classSelect" class="form-select">
                                        <option value="" selected disabled>Choisissez une classe</option>
                                        <!-- Options des classes -->
                                        <option value="1">Classe 1</option>
                                        <option value="2">Classe 2</option>
                                        <option value="3">Classe 3</option>
                                        <!-- Ajoutez d'autres classes ici -->
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 table-bordered text-center">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7">Prénom et Nom</th>
                                            <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Téléphone</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Email</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="studentTableBody">
                                        <!-- Les élèves seront chargés ici dynamiquement -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('classSelect').addEventListener('change', function() {
            const classId = this.value;

            // Simuler la récupération des données (remplacer par un appel AJAX)
            const students = getStudentsByClass(classId);

            // Mise à jour du tableau
            const tableBody = document.getElementById('studentTableBody');
            tableBody.innerHTML = ''; // Réinitialiser le contenu

            students.forEach(student => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>
                        <div class="d-flex flex-column justify-content-center ms-1">
                            <h6 class="mb-0 text-sm font-weight-semibold">${student.name}</h6>
                            <p class="text-sm text-secondary mb-0">${student.nationality}</p>
                        </div>
                    </td>
                    <td>
                        <p class="text-sm text-dark font-weight-semibold mb-0">${student.phone}</p>
                        <p class="text-sm text-secondary mb-0">Téléphone</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-sm font-weight-normal">${student.email}</span>
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="text-secondary font-weight-bold text-xs me-2">
                            Modifier
                        </a>
                        <form action="#" method="POST" style="display:inline;">
                            <button type="submit" class="text-secondary font-weight-bold text-xs">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        });

        // Simuler la fonction de récupération des élèves (à remplacer par un appel AJAX réel)
        function getStudentsByClass(classId) {
            // Exemple de données (remplacer par les vraies données du serveur)
            const students = [
                { id: 1, name: 'Jean Dupont', nationality: 'Français', phone: '123456789', email: 'jean.dupont@example.com' },
                { id: 2, name: 'Marie Curie', nationality: 'Française', phone: '987654321', email: 'marie.curie@example.com' },
                // Ajouter d'autres étudiants ici
            ];

            // Filtrer en fonction de l'ID de la classe (exemple simplifié)
            return students.filter(student => student.id == classId);
        }
    </script>
</x-app-layout>
