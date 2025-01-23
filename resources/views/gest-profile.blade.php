<x-app-layout>
   <main class="main-content position-relative h-100 border-radius-lg overflow-hidden">
       <x-app.navbar />
       
       <div class="container-fluid py-4">
           <div class="row">
               <div class="col-12">
                   <div class="card w-100">
                       <div class="card-header pb-0">
                           <div class="d-flex align-items-center">
                               <h6 class="mb-0">Mon Profil</h6>
                               <div class="ms-auto">
                                   <button class="btn btn-primary btn-sm">Éditer</button>
                               </div>
                           </div>
                       </div>
                       <div class="card-body">
                           <div class="row">
                               <div class="col-md-3 text-center">
                                   <img src="avatar.jpg" class="rounded-circle avatar w-100 max-width-200 mb-3" alt="Photo de profil">
                               </div>
                               <div class="col-md-9">
                                   <div class="row">
                                       <div class="col-12">
                                           <h4 class="mb-2">Nom Utilisateur</h4>
                                           <p class="text-muted">email@exemple.com</p>
                                       </div>
                                   </div>
                                   
                                   <hr class="horizontal gray-light my-4">
                                   
                                   <div class="row">
                                       <div class="col-md-6">
                                           <h6 class="text-xs text-uppercase text-muted">Informations personnelles</h6>
                                           <div class="mb-3">
                                               <small class="text-muted d-block">Nom</small>
                                               <span>Nom Utilisateur</span>
                                           </div>
                                           <div>
                                               <small class="text-muted d-block">Email</small>
                                               <span>email@exemple.com</span>
                                           </div>
                                       </div>
                                       <div class="col-md-6">
                                           <h6 class="text-xs text-uppercase text-muted">Autres détails</h6>
                                           <div>
                                               <small class="text-muted d-block">Inscrit le</small>
                                               <span>01/01/2024</span>
                                           </div>
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
</x-app-layout>

<style>
.max-width-200 {
    max-width: 200px;
}
</style>