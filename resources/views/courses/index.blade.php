<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-light" style="border-radius: 8px;">
                        <div class="pb-0 card-header text-dark" style="border-radius: 8px 8px 0 0;">
                            <div class="row">
                                <div class="col-6">
                                    <h6 class="mb-0">Liste des Cours</h6>
                                    <p class="text-sm mb-0">Voici la liste des cours enregistrés</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('create-course') }}" class="btn btn-light text-dark border-dark">
                                        <i class="fas fa-plus me-2"></i> Ajouter un Cours
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-bordered text-center">
                                <thead class="bg-gray-100 text-center">
                                    <tr class="text-secondary text-xs font-weight-semibold opacity-7">
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                            ID
                                        </th>
                                        <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                            Nom du Cours
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Professeur
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Description
                                        </th>
                                        <th class="text-center text-secondary text-xs font-weight-semibold opacity-7">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                        <tr>
                                            <td class="align-middle bg-transparent border-bottom text-xs">
                                                {{ $course->id }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">
                                                {{ $course->name }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">
                                                {{ $course->teacher->first_name }} {{ $course->teacher->last_name }}
                                            </td>
                                            <td class="align-middle bg-transparent border-bottom text-xs">
                                                {{ $course->description }}
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('edit-course', $course->id) }}" class="btn btn-link text-warning px-3 mb-0">
                                                        <svg width="14" height="14" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H0C0 15.5523 0.447715 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 0 11.9624 0 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.99951 15V12.2279H0V15H1.99951ZM1.70617 12.9357L12.3867 2.2762L10.9739 0.86059L0.293346 11.5201L1.70617 12.9357Z" fill="#FF8600"/>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('delete-course', $course->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-link text-danger px-3 mb-0"
                                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?')">
                                                            <svg width="14" height="14" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M1.98314 3.33333H14.0165" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M12.3499 3.33333V14C12.3499 14.442 12.1744 14.8659 11.8619 15.1785C11.5493 15.4911 11.1254 15.6667 10.6833 15.6667H5.31661C4.87458 15.6667 4.45067 15.4911 4.13811 15.1785C3.82555 14.8659 3.64994 14.442 3.64994 14V3.33333M5.31661 3.33333V1.66667C5.31661 1.22464 5.49221 0.800716 5.80477 0.488155C6.11734 0.175595 6.54125 0 6.98327 0H8.99994C9.44196 0 9.86588 0.175595 10.1784 0.488155C10.491 0.800716 10.6666 1.22464 10.6666 1.66667V3.33333" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M6.98327 7.33333V11.6667" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M9.01661 7.33333V11.6667" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination personnalisée -->
                        <div class="border-top py-3 px-3 d-flex align-items-center">
                            <!-- Bouton Previous -->
                            @if ($courses->onFirstPage())
                                <button class="btn btn-sm btn-white d-sm-block d-none mb-0" disabled>Previous</button>
                            @else
                                <a href="{{ $courses->previousPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0">Previous</a>
                            @endif

                            <!-- Pagination -->
                            <nav aria-label="Pagination" class="ms-auto">
                                <ul class="pagination pagination-light mb-0">
                                    @foreach ($courses->links()->elements[0] as $page => $url)
                                        @if ($page == $courses->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link font-weight-bold">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link border-0 font-weight-bold" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </nav>

                            <!-- Bouton Next -->
                            @if ($courses->hasMorePages())
                                <a href="{{ $courses->nextPageUrl() }}" class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto">Next</a>
                            @else
                                <button class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto" disabled>Next</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
