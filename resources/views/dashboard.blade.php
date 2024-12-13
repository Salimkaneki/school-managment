<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Bonjour, Administrateurs</h3>
                            <p class="mb-0">Bon travail!</p>
                        </div>
                        <button type="button"
                            class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 ms-md-auto mb-sm-0 mb-2 me-2">
                            <span class="btn-inner--icon">
                                <span class="p-1 bg-success rounded-circle d-flex ms-auto me-2">
                                    <span class="visually-hidden">New</span>
                                </span>
                            </span>
                            <span class="btn-inner--text">Messages</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0">
                            <span class="btn-inner--icon">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-block me-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                            </span>
                            <span class="btn-inner--text">Sync</span>
                        </button>
                    </div>
                </div>
            </div>

            <hr class="my-0">

            <div class="row">
            </div>
            <div class="row my-4">



            {{--Cartes d'effectifs--}}

            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 640 512" fill="currentColor">
                                    <path d="M160 64c0-35.3 28.7-64 64-64L576 0c35.3 0 64 28.7 64 64l0 288c0 35.3-28.7 64-64 64l-239.2 0c-11.8-25.5-29.9-47.5-52.4-64l99.6 0 0-32c0-17.7 14.3-32 32-32l64 0c17.7 0 32 14.3 32 32l0 32 64 0 0-288L224 64l0 49.1C205.2 102.2 183.3 96 160 96l0-32zm0 64a96 96 0 1 1 0 192 96 96 0 1 1 0-192zM133.3 352l53.3 0C260.3 352 320 411.7 320 485.3c0 14.7-11.9 26.7-26.7 26.7L26.7 512C11.9 512 0 500.1 0 485.3C0 411.7 59.7 352 133.3 352z"/>
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Professeurs</p>
                                        <h4 class="mb-2 font-weight-bold">{{$teacherCount}}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-user-check text-xs me-1"></i>95%
                                            </span>
                                            <span class="text-sm ms-1">Actifs</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25zm7.5 0v.09a49.488 49.488 0 00-6 0v-.09a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5zm-3 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                                    <path d="M3 18.4v-2.796a4.3 4.3 0 00.713.31A26.226 26.226 0 0012 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 01-6.477-.427C4.047 21.128 3 19.852 3 18.4z" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Classes</p>
                                        <h4 class="mb-2 font-weight-bold">{{$classCount}}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-users text-xs me-1"></i>Classes
                                            </span>
                                            <span class="text-sm ms-1">Disponibles</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm4.5 7.5a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0v-2.25a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0v4.5a.75.75 0 001.5 0V12zm2.25-3a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0V9.75A.75.75 0 0113.5 9zm3.75-1.5a.75.75 0 00-1.5 0v9a.75.75 0 001.5 0v-9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Salles de classes</p>
                                        <h4 class="mb-2 font-weight-bold">{{$classroomCount}}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-percentage text-xs me-1"></i>25%
                                            </span>
                                            <span class="text-sm ms-1">Occupées</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512" fill="currentColor">
                                    <path d="M219.3 .5c3.1-.6 6.3-.6 9.4 0l200 40C439.9 42.7 448 52.6 448 64s-8.1 21.3-19.3 23.5L352 102.9l0 57.1c0 70.7-57.3 128-128 128s-128-57.3-128-128l0-57.1L48 93.3l0 65.1 15.7 78.4c.9 4.7-.3 9.6-3.3 13.3s-7.6 5.9-12.4 5.9l-32 0c-4.8 0-9.3-2.1-12.4-5.9s-4.3-8.6-3.3-13.3L16 158.4l0-71.8C6.5 83.3 0 74.3 0 64C0 52.6 8.1 42.7 19.3 40.5l200-40zM111.9 327.7c10.5-3.4 21.8 .4 29.4 8.5l71 75.5c6.3 6.7 17 6.7 23.3 0l71-75.5c7.6-8.1 18.9-11.9 29.4-8.5C401 348.6 448 409.4 448 481.3c0 17-13.8 30.7-30.7 30.7L30.7 512C13.8 512 0 498.2 0 481.3c0-71.9 47-132.7 111.9-153.6z"/>
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Elèves</p>
                                        <h4 class="mb-2 font-weight-bold">{{$studentCount}}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-graduation-cap text-xs me-1"></i>35%
                                            </span>
                                            <span class="text-sm ms-1">D'absences</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
                <div class="card shadow-xs border h-100">
                    <div class="card-header pb-0">
                        <h6 class="font-weight-semibold text-lg mb-0">Répartition par Sexe</h6>
                        <p class="text-sm">Pourcentage d'étudiants par genre.</p>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center py-3">
                        <div class="chart mb-2" style="position: relative; height: 240px; width: 100%; max-width: 300px;">
                            <canvas id="chart-pie" class="chart-canvas"></canvas>
                        </div>
                        <button class="btn btn-white mb-0 mt-3">Voir le rapport détaillé</button>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var ctx = document.getElementById('chart-pie').getContext('2d');
                    
                    var dataFemale = {{ $femalePercentage }};
                    var dataMale = {{ $malePercentage }};
                    
                    if (dataFemale < 0 || dataMale < 0) {
                        console.warn('Invalid percentage values.');
                        dataFemale = 50; // Valeur par défaut
                        dataMale = 50;    // Valeur par défaut
                    }

                    var myPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Filles', 'Garçons'],
                            datasets: [{
                                label: 'Répartition des élèves',
                                data: [dataFemale, dataMale],
                                backgroundColor: [
                                    'rgba(41, 128, 185, 0.6)',  // Bleu pour Filles
                                    'rgba(142, 68, 173, 0.6)'   // Violet pour Garçons
                                ],
                                borderColor: [
                                    'rgba(41, 128, 185, 1)',    // Bordures correspondantes
                                    'rgba(142, 68, 173, 1)'
                                ],
                                borderWidth: 2,
                                hoverOffset: 8
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                    labels: {
                                        font: {
                                            size: 14
                                        }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            var label = tooltipItem.label || '';
                                            var value = tooltipItem.raw || 0;
                                            var total = tooltipItem.dataset.data.reduce((a, b) => a + b, 0);
                                            var percentage = ((value / total) * 100).toFixed(2) + '%';
                                            return label + ': ' + percentage;
                                        }
                                    }
                                }
                            },
                            animation: {
                                animateScale: true,
                                animateRotate: true
                            }
                        }
                    });
                });
            </script>

            
             
<!--------------------------------------------->
                {{--Liste des Professeurs--}}
                <!-- <div class="col-lg-8 col-md-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Liste des Professeurs</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0 table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Professeur</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Département</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Téléphone</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $teacher)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="my-auto">
                                                            <h6 class="mb-0 text-sm">{{$teacher->last_name }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-normal mb-0">-</p>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-sm font-weight-normal">{{ $teacher->email }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-sm font-weight-normal">{{ $teacher->phone_number }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" data-bs-title="Modifier le professeur">
                                                        <svg width="14" height="14" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.70617 15.7078L0.293346 14.2922L-0.000244141 14.5561V15H1.99976V12.2279H-0.000244141V15H0.999756V15.2928L2.41258 13.8772L1.70617 15.7078ZM1.70617 15.7078C1.89469 15.8951 2.14868 16 2.41258 16L3.72198 15L1.70617 15.7078Z" fill="#9393A4" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div> -->
                
                <div class="col-lg-8 col-md-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Liste des Professeurs</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0 table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Professeur</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Département</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Téléphone</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-2"> <!-- Augmenté le padding ici -->
                                                    <div class="my-auto">
                                                        <h6 class="mb-0 text-sm">{{$teacher->last_name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-normal mb-0">-</p>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-sm font-weight-normal">{{ $teacher->email }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="text-sm font-weight-normal">{{ $teacher->phone_number }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-bs-toggle="tooltip" data-bs-title="Modifier le professeur">
                                                    <svg width="14" height="14" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.2201 2.02495C10.8292 1.63482 10.196 1.63545 9.80585 2.02636C9.41572 2.41727 9.41635 3.05044 9.80726 3.44057L11.2201 2.02495ZM12.5572 6.18502C12.9481 6.57516 13.5813 6.57453 13.9714 6.18362C14.3615 5.79271 14.3609 5.15954 13.97 4.7694L12.5572 6.18502ZM11.6803 1.56839L12.3867 2.2762L12.3867 2.27619L11.6803 1.56839ZM14.4302 4.31284L15.1367 5.02065L15.1367 5.02064L14.4302 4.31284ZM3.72198 15V16C3.98686 16 4.24091 15.8949 4.42839 15.7078L3.72198 15ZM0.999756 15H-0.000244141C-0.000244141 15.5523 0.447471 16 0.999756 16L0.999756 15ZM0.999756 12.2279L0.293346 11.5201C0.105383 11.7077 -0.000244141 11.9624 -0.000244141 12.2279H0.999756ZM9.80726 3.44057L12.5572 6.18502L13.97 4.7694L11.2201 2.02495L9.80726 3.44057ZM12.3867 2.27619C12.7557 1.90794 13.3549 1.90794 13.7238 2.27619L15.1367 0.860593C13.9869 -0.286864 12.1236 -0.286864 10.9739 0.860593L12.3867 2.27619ZM13.7238 2.27619C14.0917 2.64337 14.0917 3.23787 13.7238 3.60504L15.1367 5.02064C16.2875 3.8721 16.2875 2.00913 15.1367 0.860593L13.7238 2.27619ZM13.7238 3.60504L3.01557 14.2922L4.42839 15.7078L15.1367 5.02065L13.7238 3.60504ZM3.72198 14H0.999756V16H3.72198V14ZM1.70617 15.7078L0.293346 14.2922L-0.000244141 14.5561V15H1.99976V12.2279H-0.000244141V15H0.999756V15.2928L2.41258 13.8772L1.70617 15.7078ZM1.70617 15.7078C1.89469 15.8951 2.14868 16 2.41258 16L3.72198 15L1.70617 15.7078Z" fill="#9393A4" />
                                                    </svg>
                                                </a>
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


            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Courbes d'absences</h6>
                                    <p class="text-sm text-muted mb-0">Suivi des absences cumulées mensuelles.</p>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-sm btn-outline-primary">
                                        Télécharger le rapport
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('chart-line').getContext('2d');

        // Dégradé de couleurs pour le fond de la courbe
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(0, 123, 255, 0.4)'); // Couleur principale Bootstrap (bleu)
        gradient.addColorStop(1, 'rgba(0, 123, 255, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Heures d\'absence',
                    data: [200, 300, 400, 350, 600, 700, 800],
                    backgroundColor: gradient, // Dégradé appliqué
                    borderColor: '#007bff', // Couleur principale Bootstrap
                    pointBackgroundColor: '#007bff', // Points en bleu
                    pointHoverBackgroundColor: '#0056b3', // Points en bleu foncé au survol
                    borderWidth: 2,
                    tension: 0.4, // Adoucit les courbes
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#6c757d', // Texte en gris Bootstrap
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#343a40', // Fond sombre pour le tooltip
                        titleColor: '#ffffff', // Couleur du titre du tooltip
                        bodyColor: '#ffffff', // Couleur du corps du tooltip
                        borderColor: '#6c757d', // Bordure gris clair
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return ` ${context.dataset.label}: ${context.raw} heures`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false // Supprime les lignes verticales
                        },
                        ticks: {
                            color: '#6c757d', // Texte en gris Bootstrap
                            font: {
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(200, 200, 200, 0.2)' // Couleur légère pour les lignes horizontales
                        },
                        ticks: {
                            color: '#6c757d', // Texte en gris Bootstrap
                            font: {
                                size: 12
                            },
                            callback: function(value) {
                                return `${value} h`; // Ajoute l'unité
                            }
                        }
                    }
                }
            }
        });
    });
</script>



            <!-- <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Courbes d'Absence</h6>
                                    <p class="text-sm mb-sm-0 mb-2">Voici les détails sur les absences au fil du temps.</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <button type="button" class="btn btn-sm btn-white mb-0 me-2">
                                        Voir le rapport
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart mt-n6">
                                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <x-app.footer />
        </div>
    </main>

</x-app-layout>
