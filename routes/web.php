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

        Route::prefix('/teacher')->group(function () {

            // Route::get('/create', function () {return view('teachers.create');})->name('create-teacher');

            Route::get('/list', [TeacherController::class, 'index'])->name('index-teacher');


            // Route::get('/edit', function () {
            //     return view('teachers.edit');
            // })->name('edit-teacher');

            Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
            Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');

            Route::get('/list', [TeacherController::class, 'index'])->name('index-teacher');
            Route::get('/create', [TeacherController::class, 'create'])->name('create-teacher');
            Route::post('/store', [TeacherController::class, 'store'])->name('store-teacher');
            Route::get('/{teacher}', [TeacherController::class, 'show'])->name('show-teacher');
            Route::put('/{teacher}', [TeacherController::class, 'update'])->name('update-teacher');
            Route::delete('/{teacher}', [TeacherController::class, 'destroy'])->name('delete-teacher');
            
            // Routes pour les fonctionnalités supplémentaires
            Route::get('/search', [TeacherController::class, 'search'])->name('search-teacher');
            Route::get('/export', [TeacherController::class, 'export'])->name('export-teacher');
            Route::get('/filter/{subject}', [TeacherController::class, 'filterBySubject'])->name('filter-teacher');
            Route::patch('/{teacher}/toggle-status', [TeacherController::class, 'toggleStatus'])->name('toggle-status-teacher');

        });

        Route::get('/teachers-edit/{id}', [TeacherController::class, 'edit'])->name('edit-teacher');
        Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');

        

        Route::prefix('/class')->group(function () {

            Route::get('/create-class', function () {
                return view('classes.add-Classes');
            })->name('create-class');

            Route::get('/class-list', [ClassController::class, 'index'])->name('class-list');
            
            Route::post('/store-class', [ClassController::class, 'store'])->name('store-class');

            Route::put('/update-class/{id}', [ClassController::class, 'update'])->name('update-class');
        
            Route::delete('/delete-class/{id}', [ClassController::class, 'destroy'])->name('delete-class');

        });
        Route::get('/edit-class/{id}', [ClassController::class, 'edit'])->name('edit-class');


        Route::prefix('/classroom')->group(function () {

            Route::get('/create-classroom', function () {
                return view('classes.classrooms.create');
            })->name('create-classroom');
 
            Route::get('/create-classroom', [ClassroomController::class, 'create'])->name('create-classroom');

            Route::post('/create-classroom', [ClassroomController::class, 'store'])->name('store-classroom');
            
            Route::get('/classrooms-list', [ClassroomController::class, 'listClassrooms'])->name('list-classrooms');
        });

        Route::prefix('student')->group(function (){

            Route::get('/create-student', [StudentController::class, 'create'])->name('create-student');

            Route::get('/student-list', [StudentController::class, 'index'])->name('student-list');

            Route::post('/by-class', [StudentController::class, 'getStudentsByClass'])->name('students-by-class');

            Route::get('/students-by-class', [StudentController::class, 'showStudentsByClass'])->name('show-students-by-class');

            Route::post('/download-by-class/{classId}', [StudentController::class, 'downloadByClass'])->name('download-by-class');

            Route::delete('/delete/{id}', [StudentController::class, 'destroy'])->name('student.delete');

            Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
            Route::put('/update/{id}', [StudentController::class, 'update'])->name('student.update');
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
        

        Route::get('/detail/{id}', [PaymentController::class, 'show'])->name('detail-payment');

        // Route pour récupérer un paiement existant pour l'édition
        Route::get('/{id}/edit', [PaymentController::class, 'edit'])->name('payment.edit');



        Route::prefix('academic-years')->group(function (){

            Route::get('create', function() {
                return view ('academic-years.create');
            });

            Route::get('list', function() {
                return view ('academic-years.index');
            });

            Route::get('list++', function() {
                return view ('academic-years.year-trimester');
            });
        });


        Route::prefix('academic-years')->name('academic-years.')->group(function () {
            // Routes de base CRUD
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
        });

        Route::get('list/trimesters', function() {
            return view('academic-years.year-trimester');
        })->name('year-trimester');

        Route::prefix('course')->group(function (){

            Route::get('create', [\App\Http\Controllers\CourseController::class, 'create'])->name('create-course');
            Route::post('store', [\App\Http\Controllers\CourseController::class, 'store'])->name('store-course');
            Route::get('list', [\App\Http\Controllers\CourseController::class, 'index'])->name('course-list');
            Route::delete('delete/{id}', [\App\Http\Controllers\CourseController::class, 'destroy'])->name('delete-course');
        Route::put('update/{id}', [\App\Http\Controllers\CourseController::class, 'update'])->name('update-course');
        });
        Route::get('edit/{id}', [\App\Http\Controllers\CourseController::class, 'edit'])->name('edit-course');



        Route::prefix('timetables')->group(function () {
            Route::get('/', [TimetableController::class, 'index'])->name('timetables.index');
            Route::get('/create', [TimetableController::class, 'create'])->name('timetables.create');
            Route::post('/store', [TimetableController::class, 'store'])->name('timetables.store');
            Route::get('/{id}', [TimetableController::class, 'weeklyView'])->name('timetables.weekly-view');
            Route::delete('/{id}', [TimetableController::class, 'destroy'])->name('timetables.destroy');
        });

        Route::get('/api/classes/{class}/classrooms', [TimetableController::class, 'getClassroomsByClass']);



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
        
               
    // Define the route prefix for events
    Route::prefix('event')->group(function () {

        // Route to show the form for creating a new event
        Route::get('/create', function () {
            return view('events.create');
        })->name('create-event');

        // Route to handle form submission and store the event
        Route::post('/store', [SchoolEventController::class, 'store'])->name('store-event');

        // Route to show the list of events
        Route::get('/list', [SchoolEventController::class, 'index'])->name('event-list');

        Route::get('/events', [SchoolEventController::class, 'index'])->name('event-list');
        Route::get('/events/create', [SchoolEventController::class, 'create'])->name('events.create');
        Route::post('/events', [SchoolEventController::class, 'store'])->name('events.store');
        Route::delete('/delete-event/{id}', [SchoolEventController::class, 'destroy'])->name('delete-event');
    });
    
    Route::get('/events/{event}', [SchoolEventController::class, 'show'])->name('events.show');


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

        // Route::get('/sign-up', [RegisterController::class, 'create'])->name('sign-up');
        // Route::post('/sign-up', [RegisterController::class, 'store']);

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

    // Route::get('/prof', function () {
    //     return view('tlistdraft');
    // });
    // Route::get('/class', function () {
    //     return view('cdraft');
    // });

    Route::get('/student', function () {
        return view('sdraft');
    });
    
    // Route::get('/teacher', function () {
    //     return view('tlistdraft');
    // });

    Route::get('/gest-users', [App\Http\Controllers\UserController::class, 'gest_users']);
    Route::get('/gest-profile', [App\Http\Controllers\UserController::class, 'gest_profile']);



Route::post('/students', [StudentController::class, 'store'])->name('students.store');


Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');