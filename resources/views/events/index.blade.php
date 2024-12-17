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
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des Événements</h6>
                                    <p class="text-sm">Voici tous les événements créés</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <!-- Bouton pour ajouter un événement -->
                                    <a href="{{ route('create-event') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="btn-inner--text">Ajouter un Événement</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                            Titre
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                            Description
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Date
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($events as $event)
                                    <tr>
                                        <td class="align-middle bg-transparent border-bottom text-xs">
                                            {{ $event->title }}
                                        </td>
                                        <td class="align-middle bg-transparent border-bottom text-xs">
                                            <!-- Tronquer la description si elle est trop longue -->
                                            {{ $event->description }}
                                        </td>
                                        <td class="align-middle bg-transparent border-bottom text-xs text-center">
                                            {{ $event->event_date ? $event->event_date->format('d/m/Y') : 'N/A' }}
                                        </td>
                                        <td class="text-center align-middle bg-transparent border-bottom text-xs">
                                            <a href="#" class="text-secondary font-weight-bold text-xs">
                                                Modifier
                                            </a>
                                            <form action="{{route ('delete-event', $event->id)}}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent p-0 ms-2">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
