<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolEventController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\TimeSlotController;
// use App\Http\Controllers\NotificationController;
use App\Models\SchoolEvent;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\SchoolLoginController;
use App\Http\Controllers\ArchiveController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });



    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/tables', function () {
        return view('tables');
    })->name('tables');

    Route::get('/wallet', function () {
        return view('wallet');
    })->name('wallet');

    Route::get('/RTL', function () {
        return view('RTL');
    })->name('RTL');

    Route::get('/profile', function () {
        return view('account-pages.profile');
    })->name('profile');

        //Route des professeurs 
        Route::prefix('/teacher')->name('teacher.')->group(function () {
            Route::get('/list', [TeacherController::class, 'index'])->name('index');
            Route::get('/create', [TeacherController::class, 'create'])->name('create');
            Route::post('/store', [TeacherController::class, 'store'])->name('store');
            Route::get('/{teacher}', [TeacherController::class, 'show'])->name('show');
            Route::get('/{teacher}/edit', [TeacherController::class, 'edit'])->name('edit');
            Route::put('/{teacher}', [TeacherController::class, 'update'])->name('update');
            Route::delete('/{teacher}', [TeacherController::class, 'destroy'])->name('delete');
            
            // Fonctionnalités supplémentaires
            Route::get('/search', [TeacherController::class, 'search'])->name('search');
            Route::get('/export', [TeacherController::class, 'export'])->name('export');
            Route::get('/filter/{subject}', [TeacherController::class, 'filterBySubject'])->name('filter');
            Route::patch('/{teacher}/toggle-status', [TeacherController::class, 'toggleStatus'])->name('toggle-status');
        });
                




        Route::prefix('/class')->group(function () {
            // Fix: Use the controller method instead of direct view return
            Route::get('/create-class', [ClassController::class, 'create'])->name('create-class');

            Route::get('/class-list', [ClassController::class, 'index'])->name('class-list');
            
            Route::post('/store-class', [ClassController::class, 'store'])->name('store-class');

            Route::put('/update-class/{id}', [ClassController::class, 'update'])->name('update-class');

            Route::delete('/delete-class/{id}', [ClassController::class, 'destroy'])->name('delete-class');
        });

            // Route edit-class (en dehors du préfixe /class pour maintenir la structure exacte)
            Route::get('/edit-class/{id}', [ClassController::class, 'edit'])->name('edit-class');

        Route::prefix('/classroom')->group(function () {

            Route::get('/create-classroom', function () {
                return view('classes.classrooms.create');
            })->name('create-classroom');
 
            Route::get('/create-classroom', [ClassroomController::class, 'create'])->name('create-classroom');

            Route::post('/create-classroom', [ClassroomController::class, 'store'])->name('store-classroom');
            
            Route::get('/classrooms-list', [ClassroomController::class, 'listClassrooms'])->name('list-classrooms');
        });

        // Route::prefix('student')->group(function (){

        //     Route::get('/create-student', [StudentController::class, 'create'])->name('create-student');

        //     Route::get('/student-list', [StudentController::class, 'index'])->name('student-list');

        //     Route::post('/by-class', [StudentController::class, 'getStudentsByClass'])->name('students-by-class');

        //     Route::post('/students-by-class', [StudentController::class, 'getStudentsByClass'])->name('student.students-by-class');

        //     Route::delete('/delete/{id}', [StudentController::class, 'destroy'])->name('student.delete');

        //     Route::put('/update/{id}', [StudentController::class, 'update'])->name('student.update');
        // });

        Route::prefix('student')->name('student.')->group(function () {
            Route::get('/list', [StudentController::class, 'index'])->name('list');
            Route::get('/create', [StudentController::class, 'create'])->name('create');
            Route::post('/', [StudentController::class, 'store'])->name('store');
            Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('edit');
            Route::put('/update/{student}', [StudentController::class, 'update'])->name('update');
            Route::delete('/delete/{student}', [StudentController::class, 'destroy'])->name('delete');
            
            // Routes spécifiques
            Route::post('/by-class', [StudentController::class, 'getStudentsByClass'])->name('by-class');
        });

        Route::get('/api/classes/{classId}/classrooms', [StudentController::class, 'getClassrooms']);


        Route::get('/students-edit/{id}', [StudentController::class, 'edit'])->name('edit-students');


        Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');


        Route::prefix('payment')->group(function () {
            // Route pour créer un paiement
            Route::get('/create', [PaymentController::class, 'create'])->name('make-payment');
            
            // Route pour lister les paiements
            Route::get('/list', [PaymentController::class, 'index'])->name('payment-list');
            
            // Route pour stocker un paiement
            Route::post('/', [PaymentController::class, 'store'])->name('payment.store');
            
            
            // Route pour mettre à jour un paiement
            Route::put('/{id}', [PaymentController::class, 'update'])->name('payment.update');

            Route::delete('/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');

        });
        

        // Route::get('/detail/{id}', [PaymentController::class, 'show'])->name('detail-payment');

        // // Route pour récupérer un paiement existant pour l'édition
        Route::get('/{id}/edit', [PaymentController::class, 'edit'])->name('payment.edit');


        Route::prefix('academic-years')->name('academic-years.')->group(function () {
            Route::get('/', [AcademicYearController::class, 'index'])->name('index');
            Route::get('/create', [AcademicYearController::class, 'create'])->name('create');
            Route::post('/', [AcademicYearController::class, 'store'])->name('store');
            Route::get('/{academicYear}', [AcademicYearController::class, 'show'])->name('show');
            Route::get('/{academicYear}/edit', [AcademicYearController::class, 'edit'])->name('edit');
            Route::put('/{academicYear}', [AcademicYearController::class, 'update'])->name('update');
            Route::delete('/{academicYear}', [AcademicYearController::class, 'destroy'])->name('destroy');
            
            // Routes additionnelles
            Route::get('/current', [AcademicYearController::class, 'currentAcademicYear'])->name('current');
            Route::post('/{academicYear}/activate', [AcademicYearController::class, 'activate'])->name('activate');
            
            // Route pour les trimestres
            Route::get('/list/trimesters', function() {
                return view('academic-years.year-trimester');
            })->name('year-trimester');
        });

        
        Route::prefix('course')->name('course.')->group(function () {
            Route::get('/list', [\App\Http\Controllers\CourseController::class, 'index'])->name('list');
            Route::get('/create', [\App\Http\Controllers\CourseController::class, 'create'])->name('create');
            Route::post('/store', [\App\Http\Controllers\CourseController::class, 'store'])->name('store');
            Route::get('/{course}/edit', [\App\Http\Controllers\CourseController::class, 'edit'])->name('edit');
            Route::put('/update/{course}', [\App\Http\Controllers\CourseController::class, 'update'])->name('update');
            Route::delete('/delete/{course}', [\App\Http\Controllers\CourseController::class, 'destroy'])->name('delete');
        });



        Route::prefix('timetables')->group(function () {
            Route::get('/', [TimetableController::class, 'index'])->name('timetables.index');
            Route::get('/create', [TimetableController::class, 'create'])->name('timetables.create');
            Route::post('/store', [TimetableController::class, 'store'])->name('timetables.store');
            Route::get('/{id}', [TimetableController::class, 'weeklyView'])->name('timetables.weekly-view');
            Route::delete('/{id}', [TimetableController::class, 'destroy'])->name('timetables.destroy');
        });

        Route::get('/api/classes/{class}/classrooms', [TimetableController::class, 'getClassroomsByClass']);

        Route::prefix('')->group(function (){

        });



        // Routes pour les créneaux horaires (TimeSlots)
        Route::prefix('time-slots')->group(function () {
            Route::get('/', [TimeSlotController::class, 'index'])->name('time-slots.index');
            Route::get('/create', [TimeSlotController::class, 'create'])->name('time-slots.create');
            Route::post('/', [TimeSlotController::class, 'store'])->name('time-slots.store');
            Route::get('/{timeSlot}/edit', [TimeSlotController::class, 'edit'])->name('time-slots.edit');
            Route::put('/{timeSlot}', [TimeSlotController::class, 'update'])->name('time-slots.update');
            Route::delete('/{timeSlot}', [TimeSlotController::class, 'destroy'])->name('time-slots.destroy');
        });
        

        Route::get('/add-course/{id}', [TimetableController::class, 'showAddCourseForm'])->name('timetables.showAddCourseForm');
        Route::post('/add-course/{id}', [TimetableController::class, 'addCourse'])->name('timetables.addCourse');
    
        // Routes pour la gestion des présences

        Route::prefix('attendances')->group(function () {
            // Afficher la liste des présences pour une classe spécifique et un emploi du temps
            Route::get('/', [AttendanceController::class, 'index'])->name('attendances.index');
            
            // Afficher le formulaire pour marquer les présences
            Route::get('/create', [AttendanceController::class, 'create'])->name('attendances.create');
            
            // Enregistrer les présences
            Route::post('/', [AttendanceController::class, 'store'])->name('attendances.store');

            Route::get('/{attendance}/data', [AttendanceController::class, 'getAbsenceData'])->name('attendances.data');
            Route::put('/{attendance}', [AttendanceController::class, 'update'])->name('attendances.update');
            Route::delete('/{attendance}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');
        });
        
               

    Route::prefix('event')->name('event.')->group(function () {
        Route::get('/list', [SchoolEventController::class, 'index'])->name('list');
        Route::get('/create', [SchoolEventController::class, 'create'])->name('create');
        Route::post('/store', [SchoolEventController::class, 'store'])->name('store');
        Route::get('/{event}', [SchoolEventController::class, 'show'])->name('show');
        Route::get('/{event}/edit', [SchoolEventController::class, 'edit'])->name('edit');
        Route::put('/{event}/update', [SchoolEventController::class, 'update'])->name('update');
        Route::delete('/{event}', [SchoolEventController::class, 'destroy'])->name('delete');
    });

    // Page principale des archives
    Route::get('/archives', [ArchiveController::class, 'index'])->name('archives.index');
    
    // Voir les archives d'une année académique
    Route::get('/archives/year/{academicYear}', [ArchiveController::class, 'show'])->name('archives.show');
    
    // Archiver une table spécifique
    Route::post('/archives/table', [ArchiveController::class, 'archiveTable'])->name('archives.table');
    
    // Archiver toute une année académique
    Route::post('/archives/year', [ArchiveController::class, 'archiveYear'])->name('archives.year');
    
    // Restaurer un enregistrement depuis les archives
    Route::post('/archives/{archive}/restore', [ArchiveController::class, 'restore'])->name('archives.restore');
    
    // Supprimer définitivement une archive
    Route::delete('/archives/{archive}', [ArchiveController::class, 'delete'])->name('archives.delete');

    
    
    


    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile');
    Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update');
    Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management');
});

    // Group for guest routes
    Route::middleware(['guest'])->group(function () {
        Route::get('/signup', function () {
            return view('account-pages.signup');
        })->name('signup');

        
        Route::get('/sign-in', [LoginController::class, 'create'])->name('sign-in');
        Route::post('/sign-in', [LoginController::class, 'store']);

        Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');

        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'store']);
    });


    Route::get('/signin', function () {
        return view('account-pages.signin');
    })->name('signin');

    Route::get('/student', function () {
        return view('sdraft');
    });
    

    Route::get('/gest-users', [App\Http\Controllers\UserController::class, 'gest_users']);
    Route::get('/gest-profile', [App\Http\Controllers\UserController::class, 'gest_profile']);

 

Route::post('/students', [StudentController::class, 'store'])->name('students.store');




Route::get('/getClassrooms/{classId}', [StudentController::class, 'getClassrooms'])->name('getClassrooms');

Route::get('/getStudentsByClass/{classId}', [PaymentController::class, 'getStudentsByClass'])
    ->name('getStudentsByClass')
    ->middleware('auth');


Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');



    //A taffer 
    Route::prefix('schools')->name('schools.')->group(function () {
        // Liste des écoles
        Route::get('/', [SchoolController::class, 'index'])
            ->name('index-schools');

        // Formulaire de création
        Route::get('/create', [SchoolController::class, 'create'])
            ->name('create-school');

        // Enregistrement d'une nouvelle école
        Route::post('/', [SchoolController::class, 'store'])
            ->name('store');

        // Affichage d'une école
        Route::get('/{school}', [SchoolController::class, 'show'])
            ->name('show');

        // Formulaire d'édition
        Route::get('/{school}/edit', [SchoolController::class, 'edit'])
            ->name('edit');

        // Mise à jour d'une école
        Route::put('/{school}', [SchoolController::class, 'update'])
            ->name('update');

        // Suppression d'une école
        Route::delete('/{school}', [SchoolController::class, 'destroy'])
            ->name('destroy');
    });




    // use App\Http\Controllers\CommunicationController;

    // Route::get('/communications/create', [CommunicationController::class, 'create'])->name('communications.create');
    // Route::post('/communications', [CommunicationController::class, 'store'])->name('communications.store');
    // Route::get('/test-twilio', [CommunicationController::class, 'testTwilioConnection']);

    // // Route::get('/test-twilio', function() {
    // //     try {
    // //         $communicationService = new \App\Services\CommunicationService();
    // //         $result = $communicationService->testConnection();
    // //         return response()->json([
    // //             'success' => $result,
    // //             'message' => $result ? 'Connexion réussie' : 'Échec de connexion'
    // //         ]);
    // //     } catch (\Exception $e) {
    // //         return response()->json([
    // //             'success' => false,
    // //             'message' => $e->getMessage()
    // //         ]);
    // //     }
    // // });