<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\AcademicYear;
use App\Models\Archive;
use Carbon\Carbon;

class ArchiveController extends Controller
{
    /**
     * Liste des tables à archiver avec leurs relations et si elles ont academic_year_id
     */
    private $archivableTables = [
        'payments' => ['label' => 'Paiements', 'has_academic_year' => false],
        'courses' => ['label' => 'Cours', 'has_academic_year' => false],
        'class_models' => ['label' => 'Modèles de classe', 'has_academic_year' => true],
        'classrooms' => ['label' => 'Salles de classe', 'has_academic_year' => true],
        'timetables' => ['label' => 'Emplois du temps', 'has_academic_year' => true],
        'timetable_courses' => ['label' => 'Cours d\'emploi du temps', 'has_academic_year' => true],
        'attendances' => ['label' => 'Présences', 'has_academic_year' => true],
        'teacher_classes' => ['label' => 'Classes des enseignants', 'has_academic_year' => true],
        'teacher_courses' => ['label' => 'Cours des enseignants', 'has_academic_year' => true],
        'class_courses' => ['label' => 'Cours des classes', 'has_academic_year' => true],
        'class_classroom' => ['label' => 'Classes-Salles', 'has_academic_year' => true],
        'teachers' => ['label' => 'Enseignants', 'has_academic_year' => true],
        'student_emergency_contacts' => ['label' => 'Contacts d\'urgence', 'has_academic_year' => true],
        'school_events' => ['label' => 'Événements scolaires', 'has_academic_year' => true],
        'exams' => ['label' => 'Examens', 'has_academic_year' => true],
        'time_slots' => ['label' => 'Créneaux horaires', 'has_academic_year' => true]
    ];

    /**
     * Affiche la page principale d'archivage
     */
    public function index()
    {
        $academicYears = AcademicYear::orderBy('start_year', 'desc')->get();
        
        // Statistiques par année
        $yearStats = [];
        foreach ($academicYears as $year) {
            $stats = [];
            foreach ($this->archivableTables as $table => $config) {
                // Vérifier si la table existe
                if (!Schema::hasTable($table)) {
                    continue;
                }

                // Compter les enregistrements selon si la table a academic_year_id ou non
                if ($config['has_academic_year'] && Schema::hasColumn($table, 'academic_year_id')) {
                    $count = DB::table($table)->where('academic_year_id', $year->id)->count();
                } else {
                    // Pour les tables sans academic_year_id, on compte tous les enregistrements
                    $count = DB::table($table)->count();
                }

                $archivedCount = Archive::where('academic_year_id', $year->id)
                                      ->where('table_name', $table)
                                      ->count();

                $stats[$table] = [
                    'label' => $config['label'],
                    'active' => $count,
                    'archived' => $archivedCount,
                    'has_academic_year' => $config['has_academic_year']
                ];
            }
            $yearStats[$year->id] = $stats;
        }

        // Dans index(), avant le return
        dd([
            'academicYears' => $academicYears->count(),
            'yearStats' => $yearStats,
            'payments_count' => DB::table('payments')->count(),
            'archives_count' => Archive::count()
        ]);

        return view('archives.index', compact('academicYears', 'yearStats'));
    }

    /**
     * Archive une table spécifique pour une année académique
     */
    public function archiveTable(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'table_name' => 'required|in:' . implode(',', array_keys($this->archivableTables))
        ]);

        $academicYearId = $request->academic_year_id;
        $tableName = $request->table_name;
        $tableConfig = $this->archivableTables[$tableName];

        try {
            DB::beginTransaction();

            // Récupérer les données à archiver selon la configuration
            if ($tableConfig['has_academic_year'] && Schema::hasColumn($tableName, 'academic_year_id')) {
                $records = DB::table($tableName)
                            ->where('academic_year_id', $academicYearId)
                            ->get();
            } else {
                // Pour les tables sans academic_year_id, archiver tous les enregistrements
                $records = DB::table($tableName)->get();
            }

            $archivedCount = 0;

            foreach ($records as $record) {
                // Créer l'archive
                Archive::create([
                    'table_name' => $tableName,
                    'record_id' => $record->id,
                    'archived_data' => json_encode($record),
                    'academic_year_id' => $academicYearId,
                    'archived_by' => auth()->id(),
                    'archive_reason' => 'Archivage automatique de fin d\'année',
                    'archived_at' => now()
                ]);

                // Supprimer l'enregistrement original
                DB::table($tableName)->where('id', $record->id)->delete();
                $archivedCount++;
            }

            DB::commit();

            return redirect()->back()->with('success', 
                "Table '{$tableConfig['label']}' archivée avec succès. {$archivedCount} enregistrements archivés."
            );

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 
                "Erreur lors de l'archivage : " . $e->getMessage()
            );
        }
    }

    /**
     * Archive toutes les tables d'une année académique
     */
    public function archiveYear(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id'
        ]);

        $academicYearId = $request->academic_year_id;
        $totalArchived = 0;

        try {
            DB::beginTransaction();

            foreach ($this->archivableTables as $tableName => $config) {
                // Vérifier si la table existe
                if (!Schema::hasTable($tableName)) {
                    continue;
                }

                // Récupérer les données selon la configuration
                if ($config['has_academic_year'] && Schema::hasColumn($tableName, 'academic_year_id')) {
                    $records = DB::table($tableName)
                                ->where('academic_year_id', $academicYearId)
                                ->get();
                } else {
                    // Pour les tables sans academic_year_id, archiver tous les enregistrements
                    $records = DB::table($tableName)->get();
                }

                foreach ($records as $record) {
                    Archive::create([
                        'table_name' => $tableName,
                        'record_id' => $record->id,
                        'archived_data' => json_encode($record),
                        'academic_year_id' => $academicYearId,
                        'archived_by' => auth()->id(),
                        'archive_reason' => 'Archivage complet de fin d\'année',
                        'archived_at' => now()
                    ]);

                    DB::table($tableName)->where('id', $record->id)->delete();
                    $totalArchived++;
                }
            }

            // Marquer l'année comme archivée seulement si la colonne existe
            if (Schema::hasColumn('academic_years', 'is_archived')) {
                AcademicYear::where('id', $academicYearId)->update(['is_archived' => true]);
            }

            DB::commit();

            return redirect()->back()->with('success', 
                "Année académique archivée avec succès. {$totalArchived} enregistrements archivés au total."
            );

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 
                "Erreur lors de l'archivage complet : " . $e->getMessage()
            );
        }
    }

    /**
     * Affiche les archives d'une année académique
     */
    public function show($academicYearId)
    {
        $academicYear = AcademicYear::findOrFail($academicYearId);
        $archives = Archive::where('academic_year_id', $academicYearId)
                          ->orderBy('archived_at', 'desc')
                          ->paginate(50);

        return view('archives.show', compact('academicYear', 'archives'));
    }

    /**
     * Restaure un enregistrement depuis les archives
     */
    public function restore($archiveId)
    {
        try {
            DB::beginTransaction();

            $archive = Archive::findOrFail($archiveId);
            $data = json_decode($archive->archived_data, true);

            // Restaurer dans la table d'origine
            DB::table($archive->table_name)->insert($data);

            // Supprimer l'archive
            $archive->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Enregistrement restauré avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 
                "Erreur lors de la restauration : " . $e->getMessage()
            );
        }
    }

    /**
     * Supprime définitivement une archive
     */
    public function delete($archiveId)
    {
        try {
            $archive = Archive::findOrFail($archiveId);
            $archive->delete();

            return redirect()->back()->with('success', 'Archive supprimée définitivement.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 
                "Erreur lors de la suppression : " . $e->getMessage()
            );
        }
    }
}