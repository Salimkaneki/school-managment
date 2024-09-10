<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="pb-0 card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <h6 class="mb-0">Profil de l'Élève</h6>
                        </div>
                        <div class="card-body px-4 py-4">
                            <form action="#" method="POST">
                                <!-- Champs de base -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="Jean" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="last_name" class="form-label">Nom de famille</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="Dupont" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="jean.dupont@example.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone_number" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="+33 6 12 34 56 78">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="gender" class="form-label">Genre</label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="male" selected>Masculin</option>
                                            <option value="female">Féminin</option>
                                            <option value="other">Autre</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date_of_birth" class="form-label">Date de naissance</label>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="2005-06-15" required>
                                    </div>
                                </div>

                                <!-- Champs supplémentaires -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="address" class="form-label">Adresse</label>
                                        <input type="text" class="form-control" id="address" name="address" value="123 Rue de l'École, Paris, France">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="emergency_contact_name" class="form-label">Nom du Contact d'Urgence</label>
                                        <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" value="Marie Dupont">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="emergency_contact_phone" class="form-label">Téléphone du Contact d'Urgence</label>
                                        <input type="text" class="form-control" id="emergency_contact_phone" name="emergency_contact_phone" value="+33 6 98 76 54 32">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="previous_school" class="form-label">École Précédente</label>
                                        <input type="text" class="form-control" id="previous_school" name="previous_school" value="Lycée Montaigne, Paris">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="average_grade" class="form-label">Note Moyenne</label>
                                        <input type="number" step="0.01" class="form-control" id="average_grade" name="average_grade" value="15.75">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="subjects" class="form-label">Matières Suivies</label>
                                        <textarea class="form-control" id="subjects" name="subjects">Mathématiques, Physique, Chimie</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="notes" class="form-label">Remarques</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="4">Élève assidu et sérieux.</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12 d-flex align-items-end justify-content-end">
                                        <button type="submit" class="btn btn-light text-dark border-dark">Enregistrer les Modifications</button>
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
