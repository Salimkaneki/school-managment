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
                                    <h6 class="font-weight-semibold text-lg mb-0">Liste des Élèves</h6>
                                    <p class="text-sm">Voici la liste de tous les élèves</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ route('create-student') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--icon">
                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                                <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Ajouter un Élève</span>
                                    </a>

                                    <a href="{{ route('show-students-by-class') }}" class="btn btn-sm btn-primary btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--text">Élèves par Classe</span>
                                    </a>

                                    <a href="{{ route('attendances.create') }}" class="btn btn-sm btn-warning btn-icon d-flex align-items-center">
                                        <span class="btn-inner--icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-x-fill me-2" viewBox="0 0 16 16">
                                                <path d="M4 .5a.5.5 0 0 1 .5.5V1h6V1a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V1a.5.5 0 0 1 .5-.5zM1 4v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1zm4.146 3.854a.5.5 0 0 1 0-.708L7 5.293 5.854 4.146a.5.5 0 1 1 .708-.708L7.707 4.586l1.147-1.148a.5.5 0 0 1 .708.708L8.414 5.293l1.147 1.147a.5.5 0 0 1-.708.708L7.707 6l-1.147 1.147a.5.5 0 0 1-.708 0z"/>
                                            </svg>
                                        </span>
                                        <span class="btn-inner--text">Enregistrer une Absence</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 py-0">
                            @if($students->isEmpty())
                               <div class="text-center py-2">
                                   <p class="font-weight-semibold text-lg mb-0">Aucun élève enregistré</p>
                               </div>
                            @else
                                @if(session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0 table-bordered text-center">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7">Prénom et Nom</th>
                                                <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">Téléphone</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Email</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Classe Assignée</th>
                                                <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-column justify-content-center ms-1">
                                                            <h6 class="mb-0 text-sm font-weight-semibold">{{ $student->first_name }} {{ $student->last_name }}</h6>
                                                            <p class="text-sm text-secondary mb-0">{{ $student->nationality }}</p>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <p class="text-sm text-dark font-weight-semibold mb-0">{{ $student->phone_number }}</p>
                                                        <p class="text-sm text-secondary mb-0">Téléphone</p>
                                                    </td>

                                                    <td class="align-middle text-center text-sm">
                                                        <span class="text-secondary text-sm font-weight-normal">{{$student->email}}</span>
                                                    </td>

                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-sm font-weight-normal">{{ $student->classModel ? $student->classModel->name : 'Aucune' }}</span>
                                                    </td>

                                                    <!-- <td class="align-middle text-center">
                                                        <a href="#" class="text-secondary font-weight-bold text-xs me-2" data-bs-toggle="tooltip" data-bs-title="Modifier">
                                                            <svg width="14" height="14" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99976 15V12.2279H-0.000244141V15H1.99976ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z" fill="#64748B"/>
                                                            </svg>
                                                        </a>
                                                        <form action="#" method="POST" style="display:inline;">
                                                            <button type="submit" class="text-secondary font-weight-bold text-xs">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td> -->

                                                    <td class="align-middle text-center">
                                                        <a href="#" class="text-primary font-weight-bold text-xs me-2" title="Ajouter Cours">
                                                            Modifier
                                                        </a>

                                                        <form action="#" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="javascript:void(0);" class="text-danger font-weight-bold text-xs" title="Supprimer" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet élèves ?')) { this.closest('form').submit(); }">
                                                                Supprimer
                                                            </a>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
  