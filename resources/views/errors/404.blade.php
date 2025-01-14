<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        
        <div class="container-fluid py-4 px-5">
            <div class="row min-vh-80 h-100">
                <div class="col-12">
                    <div class="card shadow-xs border h-100">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                            <!-- Illustration -->
                            <div class="icon icon-shape icon-xxl bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                            </div>
                            
                            <!-- Error Code -->
                            <h1 class="display-1 font-weight-bold mb-3">404</h1>
                            
                            <!-- Error Title -->
                            <h4 class="font-weight-bold mb-2">Page Non Trouvée</h4>
                            
                            <!-- Error Message -->
                            <p class="text-secondary px-4 mb-4">
                                Oups ! La page que vous recherchez semble avoir disparu. 
                                Elle a peut-être été déplacée ou n'existe plus.
                            </p>
                            
                            <!-- Action Buttons -->
                            <div class="d-flex gap-3">
                                <a href="{{ route('dashboard') }}" class="btn btn-dark mb-0">
                                    <span class="btn-inner--icon me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </span>
                                    <span class="btn-inner--text">Retour à l'accueil</span>
                                </a>
                                
                                <button onclick="window.history.back()" class="btn btn-outline-dark mb-0">
                                    <span class="btn-inner--icon me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="19" y1="12" x2="5" y2="12"></line>
                                            <polyline points="12 19 5 12 12 5"></polyline>
                                        </svg>
                                    </span>
                                    <span class="btn-inner--text">Page précédente</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <x-app.footer />
        </div>
    </main>
</x-app-layout>