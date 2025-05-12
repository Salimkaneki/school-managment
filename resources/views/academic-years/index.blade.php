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
                                    <h6 class="font-weight-semibold text-lg mb-0">Années Académiques</h6>
                                    <p class="text-sm">Gérez les années académiques ici</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ route('academic-years.create') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="btn-inner--text">Ajouter une Année</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th>ID</th>
                                        <th>Début</th>
                                        <th>Fin</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($academicYears as $year)
                                        <tr>
                                            <td>{{ $year->id }}</td>
                                            <td>{{ $year->start_year }}</td>
                                            <td>{{ $year->end_year }}</td>
                                            <td>
                                                @if($year->is_active)
                                                    <span style="background-color: #198754; color: white; padding: 2px 8px; border-radius: 3px; font-weight: 500; font-size: 12px;">
                                                        Actif
                                                    </span>
                                                @else
                                                    <span style="background-color: #dc3545; color: white; padding: 2px 8px; border-radius: 3px; font-weight: 500; font-size: 12px;">
                                                        Inactif
                                                    </span>
                                                    <form action="{{ route('academic-years.activate', $year->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="text-primary ms-2" style="border: none; background: none; cursor: pointer;">
                                                            Activer
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('year.edit', $year->id) }}" class="text-primary">Modifier</a>
                                                <form action="{{ route('academic-years.destroy', $year->id) }}" method="POST" style="display:inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger ms-3 delete-btn" style="border: none; background: none; cursor: pointer;">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Aucune année académique trouvée.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>

    <!-- Script pour la confirmation de suppression -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Récupérer tous les formulaires de suppression
            const deleteForms = document.querySelectorAll('.delete-form');
            
            // Ajouter un écouteur d'événement à chaque formulaire
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    // Empêcher la soumission par défaut du formulaire
                    event.preventDefault();
                    
                    // Demander confirmation
                    if (confirm('Êtes-vous sûr de vouloir supprimer cette année académique ? Cette action est irréversible.')) {
                        // Si l'utilisateur confirme, soumettre le formulaire
                        this.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>