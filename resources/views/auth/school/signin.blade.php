<x-guest-layout>
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent text-center">
                                    <h3 class="font-weight-black text-dark display-6">Connexion École</h3>
                                    <p class="mb-0">Bienvenue sur votre espace scolaire</p>
                                    <p class="mb-0">Veuillez vous connecter pour accéder à votre compte</p>
                                </div>
                                
                                <div class="text-center">
                                    @if (session('status'))
                                        <div class="mb-4 font-medium text-sm text-green-600">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @error('message')
                                        <div class="alert alert-danger text-sm" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="card-body">
                                    <form role="form" class="text-start" method="POST" action="{{ route('school.login') }}">
                                        @csrf
                                        <label>Nom d'utilisateur</label>
                                        <div class="mb-3">
                                            <input type="text" id="username" name="username" class="form-control"
                                                placeholder="Entrez votre nom d'utilisateur"
                                                aria-label="Username" required autofocus>
                                        </div>
                                        
                                        <label>Mot de passe</label>
                                        <div class="mb-3 position-relative">
                                            <input type="password" id="password" name="password"
                                                class="form-control" placeholder="Entrez votre mot de passe"
                                                aria-label="Password" required>
                                            <button type="button" 
                                                class="btn position-absolute top-50 end-0 translate-middle-y border-0 bg-transparent"
                                                onclick="togglePassword()">
                                                <i class="fa fa-eye" id="toggleIcon"></i>
                                            </button>
                                        </div>
                                        
                                        <div class="d-flex align-items-center">
                                            <div class="form-check form-check-info text-left mb-0">
                                                <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe">
                                                <label class="font-weight-normal text-dark mb-0" for="rememberMe">
                                                    Se souvenir de moi
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-dark w-100 mt-4 mb-3">Se connecter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8"
                                    style="background-image:url('../assets/img/image-sign-in.jpg')">
                                    <div class="blur mt-12 p-4 text-center border border-white border-radius-md position-absolute fixed-bottom m-4">
                                        <h2 class="mt-3 text-dark font-weight-bold">Votre Portail Scolaire</h2>
                                        <h6 class="text-dark text-sm mt-5">Copyright © 2024 - Tous droits réservés</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
    </script>
</x-guest-layout>

