<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-dark fixed-start" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#">
            <div class="d-flex align-items-center">
                <div class="icon icon-shape icon-sm bg-gradient-primary shadow text-center me-2 d-flex align-items-center justify-content-center rounded-circle">
                    <i class="fas fa-user-shield text-white"></i>
                </div>
                <span class="font-weight-bold text-lg text-white">Gest-School Admin</span>
            </div>
        </a>
    </div>

    <hr class="horizontal light mt-0 mb-2">

    <div class="collapse navbar-collapse px-0 w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-tachometer-alt text-white"></i>
                    </div>
                    <span class="nav-link-text ms-1">Tableau de Bord</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white opacity-6">GESTION DES UTILISATEURS</h6>
            </li>

            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#usersMenu" class="nav-link collapsed" aria-controls="usersMenu" role="button" aria-expanded="false">
                    <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <span class="nav-link-text ms-1">Utilisateurs</span>
                    <i class="fas fa-chevron-down ms-auto text-xs"></i>
                </a>
                <div class="collapse" id="usersMenu">
                    <ul class="nav nav-sm flex-column ms-4">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">
                                <span class="sidenav-mini-icon"> + </span>
                                <span class="sidenav-normal">Ajouter un utilisateur</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">
                                <span class="sidenav-mini-icon"> L </span>
                                <span class="sidenav-normal">Liste des utilisateurs</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white opacity-6">ÉTABLISSEMENTS</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-school text-white"></i>
                    </div>
                    <span class="nav-link-text ms-1">Écoles</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white opacity-6">CONFIGURATION</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-cogs text-white"></i>
                    </div>
                    <span class="nav-link-text ms-1">Paramètres système</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white opacity-6">MONITORING</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <div class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                    <span class="nav-link-text ms-1">Journaux d'activité</span>
                </a>
            </li>
        </ul>
    </div>

    <style>
        .sidenav .navbar-nav .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
        }

        .sidenav .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 0.5rem;
        }

        .sidenav .nav-link-text {
            transition: all 0.2s ease;
        }

        .sidenav .nav-link:hover .nav-link-text {
            transform: translateX(5px);
        }

        .sidenav .collapse .nav-link {
            padding-left: 1rem;
            font-size: 0.875rem;
        }

        .rotate-180 {
            transition: transform 0.3s ease;
        }

        [aria-expanded="true"] .rotate-180 {
            transform: rotate(180deg);
        }

        .sidenav .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.675rem 1rem;
            font-weight: 500;
        }

        .sidenav .collapse .nav-link {
            padding-left: 1.5rem;
            margin: 0.5rem 0;
        }

        .sidenav .collapse {
            display: none;
        }

        .sidenav .collapse.show {
            display: block;
        }

        .sidenav .nav-link[aria-expanded="true"] .fa-chevron-down {
            transform: rotate(180deg);
        }

        .sidenav .fa-chevron-down {
            transition: transform 0.2s ease;
        }

        .sidenav .nav-sm {
            padding-left: 1rem;
        }

        .sidenav .nav-sm .nav-link {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }

        .sidenav-normal {
            display: inline-block;
            padding: 0.3rem 0;
        }

        .sidenav .collapse .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const collapseElements = document.querySelectorAll('[data-bs-toggle="collapse"]');
            
            collapseElements.forEach(element => {
                element.addEventListener('click', function() {
                    const icon = this.querySelector('.rotate-180');
                    if (icon) {
                        icon.style.transform = this.getAttribute('aria-expanded') === 'true' 
                            ? 'rotate(0deg)' 
                            : 'rotate(180deg)';
                    }
                });
            });
        });
    </script>
</aside>