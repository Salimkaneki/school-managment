<x-app-layout>
    <main class="main-content">
        <x-app.navbar />
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header">
                    <h6>Créer un Emploi du Temps</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('timetables.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="class_id" class="form-label">Sélectionner une classe</label>
                            <select class="form-select" name="class_id" id="class_id" required>
                                <option value="" disabled selected>Choisissez une classe</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="classroom_id" class="form-label">Sélectionner une salle de classe</label>
                            <select class="form-select" name="classroom_id" id="classroom_id" required>
                                <option value="" disabled selected>Choisissez une salle</option>
                                @foreach($classrooms as $classroom)
                                    <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Créer l'Emploi du Temps</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
