<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm" style="border-radius: 8px;">
                        <div class="card-header" style="background-color: #6c757d; color: #ffffff; border-radius: 8px 8px 0 0;">
                            <h5 class="mb-0" style="color: #ffffff;">Modifier la Classe</h5>
                        </div>
                        <div class="card-body" style="background-color: #f8f9fa;">
                            <form action="{{ route('update-class', $class->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="name" class="form-label" style="color: #495057;">Nom de la Classe</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $class->name }}" required style="border-radius: 4px;">
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="form-label" style="color: #495057;">Description</label>
                                    <textarea class="form-control" id="description" name="description" style="border-radius: 4px;">{{ $class->description }}</textarea>
                                </div>

                                <button type="submit" class="btn" style="background-color: #6c757d; color: #ffffff;">Mettre à jour</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
