<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        📁 Archives de {{ $academicYear->name }} 
                        <small class="text-muted">({{ $archives->total() }} enregistrements)</small>
                    </h3>
                    <a href="{{ route('archives.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
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

                    @if($archives->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID Archive</th>
                                        <th>Table d'origine</th>
                                        <th>ID Enregistrement</th>
                                        <th>Archivé par</th>
                                        <th>Raison</th>
                                        <th>Date d'archivage</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($archives as $archive)
                                        <tr>
                                            <td>
                                                <span class="badge bg-secondary">#{{ $archive->id }}</span>
                                            </td>
                                            <td>
                                                <i class="fas fa-table text-primary"></i>
                                                {{ $archive->formatted_table_name }}
                                            </td>
                                            <td>
                                                <code>{{ $archive->record_id }}</code>
                                            </td>
                                            <td>
                                                @if($archive->archivedBy)
                                                    <i class="fas fa-user"></i> {{ $archive->archivedBy->name }}
                                                @else
                                                    <span class="text-muted">Système</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $archive->archive_reason ?? 'Non spécifiée' }}</small>
                                            </td>
                                            <td>
                                                <small>
                                                    <i class="fas fa-calendar"></i>
                                                    {{ $archive->archived_at ? $archive->archived_at->format('d/m/Y H:i') : 'N/A' }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-outline-info btn-sm" 
                                                            onclick="viewArchiveData({{ $archive->id }})"
                                                            data-bs-toggle="tooltip" title="Voir les données">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-success btn-sm" 
                                                            onclick="confirmRestore({{ $archive->id }}, '{{ $archive->formatted_table_name }}', {{ $archive->record_id }})"
                                                            data-bs-toggle="tooltip" title="Restaurer">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm" 
                                                            onclick="confirmDelete({{ $archive->id }}, '{{ $archive->formatted_table_name }}', {{ $archive->record_id }})"
                                                            data-bs-toggle="tooltip" title="Supprimer définitivement">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $archives->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-archive fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucune archive trouvée</h5>
                            <p class="text-muted">Cette année académique ne contient pas encore d'archives.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour voir les données archivées -->
<div class="modal fade" id="viewDataModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">📄 Données archivées</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <pre id="archiveDataContent" class="bg-light p-3" style="max-height: 400px; overflow-y: auto;"></pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation pour restaurer -->
<div class="modal fade" id="restoreModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">🔄 Confirmer la restauration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir restaurer cet enregistrement ?</p>
                <div class="alert alert-info">
                    <strong>Table :</strong> <span id="restoreTableName"></span><br>
                    <strong>ID :</strong> <span id="restoreRecordId"></span>
                </div>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    L'enregistrement sera remis dans la table active et supprimé des archives.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="restoreForm" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-undo"></i> Restaurer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation pour supprimer -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">🗑️ Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer définitivement cette archive ?</p>
                <div class="alert alert-info">
                    <strong>Table :</strong> <span id="deleteTableName"></span><br>
                    <strong>ID :</strong> <span id="deleteRecordId"></span>
                </div>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>ATTENTION :</strong> Cette action est irréversible ! Les données seront perdues définitivement.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Supprimer définitivement
                    </button>
                </form>
            </div>
        </div>
        </div>
    </main>
</x-app-layout>

@push('scripts')
<script>
// Données des archives pour JavaScript
const archivesData = @json($archives->items());

function viewArchiveData(archiveId) {
    const archive = archivesData.find(a => a.id === archiveId);
    if (archive) {
        document.getElementById('archiveDataContent').textContent = JSON.stringify(archive.archived_data, null, 2);
        var modal = new bootstrap.Modal(document.getElementById('viewDataModal'));
        modal.show();
    }
}

function confirmRestore(archiveId, tableName, recordId) {
    document.getElementById('restoreTableName').textContent = tableName;
    document.getElementById('restoreRecordId').textContent = recordId;
    document.getElementById('restoreForm').action = `/archives/${archiveId}/restore`;
    
    var modal = new bootstrap.Modal(document.getElementById('restoreModal'));
    modal.show();
}

function confirmDelete(archiveId, tableName, recordId) {
    document.getElementById('deleteTableName').textContent = tableName;
    document.getElementById('deleteRecordId').textContent = recordId;
    document.getElementById('deleteForm').action = `/archives/${archiveId}`;
    
    var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Initialiser les tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});