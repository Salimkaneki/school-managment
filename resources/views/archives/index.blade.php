<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">📁 Gestion des Archives Scolaires</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @foreach($academicYears as $year)
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    📅 {{ $year->name }} 
                                    @if($year->is_archived ?? false)
                                        <span class="badge bg-secondary">Archivée</span>
                                    @else
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                </h5>
                                <div>
                                    <a href="{{ route('archives.show', $year->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i> Voir les archives
                                    </a>
                                    @if(!($year->is_archived ?? false))
                                        <button type="button" class="btn btn-danger btn-sm" 
                                                onclick="confirmArchiveYear({{ $year->id }}, '{{ $year->name }}')">
                                            <i class="fas fa-archive"></i> Archiver toute l'année
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($yearStats[$year->id] as $table => $stats)
                                        <div class="col-md-4 col-lg-3 mb-3">
                                            <div class="card border-left-primary">
                                                <div class="card-body py-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h6 class="mb-1">{{ $stats['label'] }}</h6>
                                                            <small class="text-muted">
                                                                <i class="fas fa-database text-success"></i> {{ $stats['active'] }} actifs
                                                                <br>
                                                                <i class="fas fa-archive text-secondary"></i> {{ $stats['archived'] }} archivés
                                                            </small>
                                                        </div>
                                                        @if($stats['active'] > 0 && !($year->is_archived ?? false))
                                                            <button type="button" class="btn btn-outline-warning btn-sm" 
                                                                    onclick="confirmArchiveTable('{{ $table }}', '{{ $stats['label'] }}', {{ $year->id }}, '{{ $year->name }}')">
                                                                <i class="fas fa-archive"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation pour archiver une table -->
<div class="modal fade" id="archiveTableModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">⚠️ Confirmer l'archivage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir archiver <strong id="tableLabel"></strong> de l'année <strong id="yearLabel"></strong> ?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    Cette action déplacera toutes les données vers les archives et les supprimera des tables actives.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="archiveTableForm" method="POST" action="{{ route('archives.table') }}" style="display: inline;">
                    @csrf
                    <input type="hidden" name="academic_year_id" id="archiveYearId">
                    <input type="hidden" name="table_name" id="archiveTableName">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-archive"></i> Archiver
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation pour archiver toute l'année -->
<div class="modal fade" id="archiveYearModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">🚨 Confirmer l'archivage complet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir archiver <strong>TOUTES LES DONNÉES</strong> de l'année <strong id="fullYearLabel"></strong> ?</p>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>ATTENTION :</strong> Cette action archivera toutes les tables de cette année académique. 
                    Cette opération est irréversible pour l'ensemble des données !
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="archiveYearForm" method="POST" action="{{ route('archives.year') }}" style="display: inline;">
                    @csrf
                    <input type="hidden" name="academic_year_id" id="archiveFullYearId">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-archive"></i> Archiver toute l'année
                    </button>
                </form>
            </div>
        </div>
        </div>
    </main>
</x-app-layout>

@push('scripts')
<script>
function confirmArchiveTable(tableName, tableLabel, yearId, yearName) {
    document.getElementById('tableLabel').textContent = tableLabel;
    document.getElementById('yearLabel').textContent = yearName;
    document.getElementById('archiveYearId').value = yearId;
    document.getElementById('archiveTableName').value = tableName;
    
    var modal = new bootstrap.Modal(document.getElementById('archiveTableModal'));
    modal.show();
}

function confirmArchiveYear(yearId, yearName) {
    document.getElementById('fullYearLabel').textContent = yearName;
    document.getElementById('archiveFullYearId').value = yearId;
    
    var modal = new bootstrap.Modal(document.getElementById('archiveYearModal'));
    modal.show();
}
</script>
@endpush