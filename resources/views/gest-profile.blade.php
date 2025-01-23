<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

        <x-app.navbar />
        
        <div class="px-5 py-4 container-fluid">
            <div class="mt-5 mb-5 mt-lg-9 row justify-content-center">
                <div class="col-lg-9 col-12">
                    <div class="card card-body" id="profile">
                        <img src="../assets/img/header-orange-purple.jpg" alt="pattern-lines"
                            class="top-0 rounded-2 position-absolute start-0 w-100 h-100">
                        <div class="row z-index-2 justify-content-center align-items-center">
                            <div class="col-sm-auto col-4">
                                <div class="avatar avatar-xl position-relative">
                                    <img src="../assets/img/team-2.jpg" alt="profile"
                                        class="w-100 h-100 object-fit-cover border-radius-lg shadow-sm">
                                </div>
                            </div>
                            <div class="col-sm-auto col-8 my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1 font-weight-bolder">John Doe</h5>
                                    <p class="mb-0 font-weight-bold text-sm">Développeur Web</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5 row justify-content-center">
                <div class="col-lg-9 col-12">
                    <div class="card" id="basic-info">
                        <div class="card-header">
                            <h5>Informations de base</h5>
                        </div>
                        <div class="pt-0 card-body">
                            <form action="#" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <label for="name">Nom</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label for="location">Localisation</label>
                                        <input type="text" name="location" id="location" class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label for="phone">Téléphone</label>
                                        <input type="text" name="phone" id="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <label for="about">À propos</label>
                                        <textarea name="about" id="about" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="mt-4 btn btn-primary btn-sm float-end">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>