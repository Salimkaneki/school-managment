<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('components.app.admin_sidebar')
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Tableau de Bord Admin</h3>
                            <p class="mb-0">Gestion globale des Établissements</p>
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

            <div class="row my-4">
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
                                        <p class="text-sm text-secondary mb-1">Total Utilisateurs</p>
                                        <h4 class="mb-2 font-weight-bold">1,250</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-user-check text-xs me-1"></i>+15%
                                            </span>
                                            <span class="text-sm ms-1">ce mois</span>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25z"/>
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Nouvelles Inscriptions</p>
                                        <h4 class="mb-2 font-weight-bold">350</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chart-line text-xs me-1"></i>+22%
                                            </span>
                                            <span class="text-sm ms-1">par rapport au mois dernier</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
                    <div class="card shadow-xs border h-100">
                        <div class="card-header pb-0">
                            <h6 class="font-weight-semibold text-lg mb-0">Utilisateurs par Rôle</h6>
                            <p class="text-sm">Distribution des rôles dans le système</p>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center py-3">
                            <div class="chart mb-2" style="position: relative; height: 240px; width: 100%; max-width: 300px;">
                                <canvas id="role-distribution-chart" class="chart-canvas"></canvas>
                            </div>
                            <button class="btn btn-white mb-0 mt-3">Détails Complets</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>Derniers Utilisateurs Enregistrés</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Rôle</th>
                                            <th>Date d'inscription</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Jean Dupont</td>
                                            <td>jean.dupont@example.com</td>
                                            <td>Administrateur</td>
                                            <td>15/01/2024</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-primary">
                                                    Gérer
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Marie Martin</td>
                                            <td>marie.martin@example.com</td>
                                            <td>Gestionnaire</td>
                                            <td>10/01/2024</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-outline-primary">
                                                    Gérer
                                                </a>
                                            </td>
                                        </tr>
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
        </div>
        <x-app.footer />
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Graphique de répartition des rôles
            const roleCtx = document.getElementById('role-distribution-chart').getContext('2d');
            new Chart(roleCtx, {
                type: 'pie',
                data: {
                    labels: ['Admin', 'Gestionnaire', 'Utilisateur'],
                    datasets: [{
                        data: [30, 40, 30],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(75, 192, 192, 0.6)'
                        ]
                    }]
                }
            });

            // Graphique des tendances d'inscription
            const trendCtx = document.getElementById('registration-trend-chart').getContext('2d');
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin'],
                    datasets: [{
                        label: 'Inscriptions',
                        data: [100, 200, 150, 250, 300, 350],
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                }
            });
        });
    </script>
</x-app-layout>
```