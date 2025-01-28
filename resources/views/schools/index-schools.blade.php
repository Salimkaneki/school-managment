<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('components.app.admin_sidebar')
        <x-app.navbar />

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Liste des établissements</h4>
                            <a href="{{ route('schools.create') }}" class="btn btn-primary">
                                Ajouter un établissement
                            </a>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Type</th>
                                            <th>Ville</th>
                                            <th>Email</th>
                                            <th>Téléphone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($schools as $school)
                                            <tr>
                                                <td>{{ $school->name }}</td>
                                                <td>{{ $school->type }}</td>
                                                <td>{{ $school->city }}</td>
                                                <td>{{ $school->email }}</td>
                                                <td>{{ $school->phone }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('schools.show', $school) }}" 
                                                           class="btn btn-sm btn-info">
                                                            Voir
                                                        </a>
                                                        <a href="{{ route('schools.edit', $school) }}" 
                                                           class="btn btn-sm btn-warning">
                                                            Éditer
                                                        </a>
                                                        <form action="{{ route('schools.destroy', $school) }}" 
                                                              method="POST" 
                                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet établissement ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                Supprimer
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    Aucun établissement enregistré
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mt-4">
                                {{ $schools->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-app.footer />
    </main>
</x-app-layout>