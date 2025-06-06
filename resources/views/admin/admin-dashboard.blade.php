<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        @include('components.app.admin_sidebar')
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <!-- En-tête avec fonctionnalités de filtrage -->
            <div class="row">
                <div class="col-md-8">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Tableau de Bord Admin</h3>
                            <p class="mb-0">Gestion globale des Établissements</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex justify-content-end align-items-center">
                    <div class="dropdown me-2">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="periodDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-calendar-alt me-1"></i> Période: Ce mois
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="periodDropdown">
                            <li><a class="dropdown-item" href="#">Aujourd'hui</a></li>
                            <li><a class="dropdown-item" href="#">Cette semaine</a></li>
                            <li><a class="dropdown-item" href="#">Ce mois</a></li>
                            <li><a class="dropdown-item" href="#">Ce trimestre</a></li>
                            <li><a class="dropdown-item" href="#">Cette année</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Personnalisé</a></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0">
                        <span class="btn-inner--icon">
                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-block me-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </span>
                        <span class="btn-inner--text">Synchroniser</span>
                    </button>
                </div>
            </div>

            <hr class="my-3">

            <!-- Cartes de statistiques principales -->
            <div class="row mb-4">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card border shadow-xs h-100">
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

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card border shadow-xs h-100">
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

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card border shadow-xs h-100">
                        <div class="card-body text-start p-3 w-100">
                            <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Activité Mensuelle</p>
                                        <h4 class="mb-2 font-weight-bold">78%</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-danger font-weight-bolder">
                                                <i class="fa fa-arrow-down text-xs me-1"></i>-3%
                                            </span>
                                            <span class="text-sm ms-1">par rapport au mois dernier</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card border shadow-xs h-100">
                        <div class="card-body text-start p-3 w-100">
                            <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Taux d'Absences</p>
                                        <h4 class="mb-2 font-weight-bold">4.2%</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-arrow-down text-xs me-1"></i>-1.5%
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

            <!-- Graphiques principaux -->
            <!-- <div class="row mb-4">
                <div class="col-lg-8">
                    <div class="card shadow-xs border h-100">
                        <div class="card-header pb-0">
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Tendances des absences</h6>
                                    <p class="text-sm text-muted mb-0">Suivi mensuel des absences par catégorie</p>
                                </div>
                                <div class="btn-group" role="group" aria-label="Période">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Mois</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary active">Trimestre</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Année</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart" style="height: 300px;">
                                <canvas id="chart-absence-trends" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-xs border h-100">
                        <div class="card-header pb-0">
                            <h6 class="font-weight-semibold text-lg mb-0">Utilisateurs par Rôle</h6>
                            <p class="text-sm">Distribution des utilisateurs dans le système</p>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center py-3">
                            <div class="chart" style="position: relative; height: 240px; width: 100%;">
                                <canvas id="role-distribution-chart" class="chart-canvas"></canvas>
                            </div>
                            <div class="mt-3 d-flex justify-content-between w-100">
                                <div class="text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="me-1" style="width:12px; height:12px; border-radius:50%; background:rgba(54, 162, 235, 0.6)"></div>
                                        <span class="text-sm">Admin</span>
                                    </div>
                                    <h6 class="mb-0 mt-1">30%</h6>
                                </div>
                                <div class="text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="me-1" style="width:12px; height:12px; border-radius:50%; background:rgba(255, 99, 132, 0.6)"></div>
                                        <span class="text-sm">Gestionnaire</span>
                                    </div>
                                    <h6 class="mb-0 mt-1">40%</h6>
                                </div>
                                <div class="text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="me-1" style="width:12px; height:12px; border-radius:50%; background:rgba(75, 192, 192, 0.6)"></div>
                                        <span class="text-sm">Utilisateur</span>
                                    </div>
                                    <h6 class="mb-0 mt-1">30%</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Tableau et activité récente -->
            <div class="row mb-4">
                <div class="col-lg-8">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-semibold text-lg mb-0">Derniers Utilisateurs Enregistrés</h6>
                                <div class="input-group" style="width: 200px;">
                                    <span class="input-group-text" id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Rechercher..." aria-label="Rechercher" aria-describedby="search-addon">
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-0">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-bold">Nom</th>
                                            <th class="text-secondary text-xs font-weight-bold">Email</th>
                                            <th class="text-secondary text-xs font-weight-bold">Rôle</th>
                                            <th class="text-secondary text-xs font-weight-bold">Date d'inscription</th>
                                            <th class="text-secondary text-xs font-weight-bold">Statut</th>
                                            <th class="text-secondary text-xs font-weight-bold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm bg-gradient-primary rounded-circle me-2">JD</div>
                                                    <span>Jean Dupont</span>
                                                </div>
                                            </td>
                                            <td>jean.dupont@example.com</td>
                                            <td>
                                                <span class="badge bg-primary text-xs">Administrateur</span>
                                            </td>
                                            <td>15/01/2024</td>
                                            <td>
                                                <span class="badge bg-success text-xs">Actif</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-icon-only" type="button" id="actionMenu1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="actionMenu1">
                                                        <li><a class="dropdown-item" href="#">Détails</a></li>
                                                        <li><a class="dropdown-item" href="#">Modifier</a></li>
                                                        <li><a class="dropdown-item text-danger" href="#">Désactiver</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm bg-gradient-info rounded-circle me-2">MM</div>
                                                    <span>Marie Martin</span>
                                                </div>
                                            </td>
                                            <td>marie.martin@example.com</td>
                                            <td>
                                                <span class="badge bg-secondary text-xs">Gestionnaire</span>
                                            </td>
                                            <td>10/01/2024</td>
                                            <td>
                                                <span class="badge bg-success text-xs">Actif</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-icon-only" type="button" id="actionMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="actionMenu2">
                                                        <li><a class="dropdown-item" href="#">Détails</a></li>
                                                        <li><a class="dropdown-item" href="#">Modifier</a></li>
                                                        <li><a class="dropdown-item text-danger" href="#">Désactiver</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm bg-gradient-success rounded-circle me-2">PR</div>
                                                    <span>Pierre Rousseau</span>
                                                </div>
                                            </td>
                                            <td>pierre.r@example.com</td>
                                            <td>
                                                <span class="badge bg-info text-xs">Utilisateur</span>
                                            </td>
                                            <td>08/01/2024</td>
                                            <td>
                                                <span class="badge bg-success text-xs">Actif</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-icon-only" type="button" id="actionMenu3" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="actionMenu3">
                                                        <li><a class="dropdown-item" href="#">Détails</a></li>
                                                        <li><a class="dropdown-item" href="#">Modifier</a></li>
                                                        <li><a class="dropdown-item text-danger" href="#">Désactiver</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm bg-gradient-warning rounded-circle me-2">SL</div>
                                                    <span>Sophie Leclerc</span>
                                                </div>
                                            </td>
                                            <td>s.leclerc@example.com</td>
                                            <td>
                                                <span class="badge bg-info text-xs">Utilisateur</span>
                                            </td>
                                            <td>05/01/2024</td>
                                            <td>
                                                <span class="badge bg-warning text-xs">En attente</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-icon-only" type="button" id="actionMenu4" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="actionMenu4">
                                                        <li><a class="dropdown-item" href="#">Détails</a></li>
                                                        <li><a class="dropdown-item" href="#">Modifier</a></li>
                                                        <li><a class="dropdown-item text-success" href="#">Activer</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer py-2 d-flex justify-content-between align-items-center">
                                <p class="text-sm mb-0">Affichage de 1 à 4 sur 120 entrées</p>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-end mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Suivant</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-xs border h-100">
                        <div class="card-header pb-0">
                            <h6 class="font-weight-semibold text-lg mb-0">Activités Récentes</h6>
                            <p class="text-sm">Dernières actions système</p>
                        </div>
                        <div class="card-body pt-0 pb-2">
                            <ul class="list-group">
                                <li class="list-group-item border-0 px-0">
                                    <div class="d-flex">
                                        <div class="icon icon-shape icon-sm bg-success text-white text-center border-radius-sm d-flex align-items-center justify-content-center me-3">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-sm">Nouveau utilisateur ajouté</h6>
                                            <span class="text-xs">Thomas Bernard a été inscrit par Jean Dupont</span>
                                            <span class="text-xs text-secondary">il y a 15 minutes</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <div class="d-flex">
                                        <div class="icon icon-shape icon-sm bg-info text-white text-center border-radius-sm d-flex align-items-center justify-content-center me-3">
                                            <i class="fas fa-sync"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-sm">Mise à jour du système</h6>
                                            <span class="text-xs">Le module de gestion a été mis à jour</span>
                                            <span class="text-xs text-secondary">il y a 1 heure</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <div class="d-flex">
                                        <div class="icon icon-shape icon-sm bg-warning text-white text-center border-radius-sm d-flex align-items-center justify-content-center me-3">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-sm">Rapport généré</h6>
                                            <span class="text-xs">Rapport d'absences mensuel généré</span>
                                            <span class="text-xs text-secondary">il y a 3 heures</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0">
                                    <div class="d-flex">
                                        <div class="icon icon-shape icon-sm bg-danger text-white text-center border-radius-sm d-flex align-items-center justify-content-center me-3">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-sm">Alerte système</h6>
                                            <span class="text-xs">Tentative de connexion échouée (5 essais)</span>
                                            <span class="text-xs text-secondary">il y a 5 heures</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-outline-primary btn-sm w-100">Voir toutes les activités</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dernière rangée - Statistiques complémentaires -->
            <!-- <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-semibold text-lg mb-0">Tendances d'Inscription</h6>
                                <button type="button" class="btn btn-sm btn-outline-primary">
                                    Exporter
                                </button>
                            </div>
                            <p class="text-sm mb-0">Évolution des inscriptions sur 6 mois</p>
                        </div>
                        <div class="card-body">
                            <div class="chart" style="height: 260px;">
                                <canvas id="registration-trend-chart" class="chart-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <h6 class="font-weight-semibold text-lg mb-0">Répartition par Établissement</h6>
                            <p class="text-sm mb-0">Distribution des utilisateurs par établissement</p>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead>
                                        <tr>
                                            <th class="text-secondary text-xs font-weight-bold">Établissement</th>
                                            <th class="text-secondary text-xs font-weight-bold">Utilisateurs</th>
                                            <th class="text-secondary text-xs font-weight-bold">Taux d'absences</th>
                                            <th class="text-secondary text-xs font-weight-bold">Progression</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm rounded-circle bg-gradient-dark me-2 d-flex align-items-center justify-content-center">
                                                        <span class="text-white text-xs">E1</span>
                                                    </div>
                                                    <span class="font-weight-bold text-sm">École Victor Hugo</span>
                                                </div>
                                            </td>
                                            <td>245</td>
                                            <td>3.5%</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2 text-xs font-weight-bold">75%</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm rounded-circle bg-gradient-primary me-2 d-flex align-items-center justify-content-center">
                                                        <span class="text-white text-xs">E2</span>
                                                    </div>
                                                    <span class="font-weight-bold text-sm">Collège Pasteur</span>
                                                </div>
                                            </td>
                                            <td>320</td>
                                            <td>4.8%</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2 text-xs font-weight-bold">60%</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm rounded-circle bg-gradient-info me-2 d-flex align-items-center justify-content-center">
                                                        <span class="text-white text-xs">E3</span>
                                                    </div>
                                                    <span class="font-weight-bold text-sm">Lycée Condorcet</span>
                                                </div>
                                            </td>
                                            <td>185</td>
                                            <td>5.2%</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2 text-xs font-weight-bold">90%</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm rounded-circle bg-gradient-warning me-2 d-flex align-items-center justify-content-center">
                                                        <span class="text-white text-xs">E4</span>
                                                    </div>
                                                    <span class="font-weight-bold text-sm">École Jean Moulin</span>
                                                </div>
                                            </td>
                                            <td>140</td>
                                            <td>2.8%</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2 text-xs font-weight-bold">45%</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Footer avec rappels et tâches à venir -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card shadow-xs border">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-semibold text-lg mb-0">Rappels et Tâches</h6>
                                <button class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus me-2"></i>Ajouter
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="alert alert-info d-flex align-items-center mb-0">
                                        <div class="text-white me-3">
                                            <i class="fas fa-clock fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-0">Validation rapports mensuels</h6>
                                            <span class="text-sm text-white opacity-8">Échéance: 25/05/2025</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="alert alert-warning d-flex align-items-center mb-0">
                                        <div class="text-white me-3">
                                            <i class="fas fa-exclamation-circle fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-0">Mise à jour sécurité</h6>
                                            <span class="text-sm text-white opacity-8">Prévue: 23/05/2025</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-3">
                                    <div class="alert alert-success d-flex align-items-center mb-0">
                                        <div class="text-white me-3">
                                            <i class="fas fa-check-circle fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="text-white mb-0">Formation utilisateurs</h6>
                                            <span class="text-sm text-white opacity-8">Complétée à 80%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Graphique de répartition des rôles (pie chart)
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
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Graphique des tendances d'inscription (line chart)
            const trendCtx = document.getElementById('registration-trend-chart').getContext('2d');
            const gradientTrend = trendCtx.createLinearGradient(0, 0, 0, 300);
            gradientTrend.addColorStop(0, 'rgba(75, 192, 192, 0.5)');
            gradientTrend.addColorStop(1, 'rgba(75, 192, 192, 0.1)');

            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin'],
                    datasets: [{
                        label: 'Nouvelles inscriptions',
                        data: [100, 200, 150, 250, 300, 350],
                        backgroundColor: gradientTrend,
                        borderColor: 'rgb(75, 192, 192)',
                        pointBackgroundColor: 'rgb(75, 192, 192)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(75, 192, 192)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5],
                                color: 'rgba(200, 200, 200, 0.2)'
                            },
                            ticks: {
                                padding: 10
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                padding: 10
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Graphique des absences par catégorie (bar chart avec plusieurs datasets)
            const absenceCtx = document.getElementById('chart-absence-trends').getContext('2d');
            new Chart(absenceCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil'],
                    datasets: [
                        {
                            label: 'Maladie',
                            data: [120, 180, 150, 110, 90, 100, 120],
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Formation',
                            data: [50, 60, 70, 90, 120, 130, 150],
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Congés',
                            data: [80, 100, 90, 120, 150, 180, 200],
                            backgroundColor: 'rgba(255, 159, 64, 0.6)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Autres',
                            data: [30, 40, 35, 45, 50, 55, 60],
                            backgroundColor: 'rgba(153, 102, 255, 0.6)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: true,
                            grid: {
                                display: false,
                                drawBorder: false
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(200, 200, 200, 0.2)',
                                drawBorder: false
                            },
                            ticks: {
                                callback: function(value) {
                                    return value + ' h';
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                boxWidth: 12,
                                padding: 15
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.raw} heures`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
