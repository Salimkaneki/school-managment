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
use App\Http\Controllers\NotificationController;

use PHPUnit\Framework\Attributes\Group;

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
            Route::get('/create', function () {
                return view('teachers.create');
            })->name('create-teacher');

            Route::get('/list', [TeacherController::class, 'index'])->name('index-teacher');


            Route::get('/edit', function () {
                return view('teachers.edit');
            })->name('edit-teacher');

            Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
            Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');

        });

        Route::prefix('/class')->group(function () {

            Route::get('/create-class', function () {
                return view('classes.add-Classes');
            })->name('create-class');

            Route::get('/class-list', [ClassController::class, 'index'])->name('class-list');
            
            Route::post('/store-class', [ClassController::class, 'store'])->name('store-class');

            Route::get('/edit-class/{id}', [ClassController::class, 'edit'])->name('edit-class');

            Route::put('/update-class/{id}', [ClassController::class, 'update'])->name('update-class');
        
            Route::delete('/delete-class/{id}', [ClassController::class, 'destroy'])->name('delete-class');

        });

        Route::prefix('/classroom')->group(function () {

            Route::get('/create-classroom', function () {
                return view('classes.classrooms.create');
            })->name('create-classroom');
 
            Route::get('/create-classroom', [ClassroomController::class, 'create'])->name('create-classroom');

            Route::post('/create-classroom', [ClassroomController::class, 'store'])->name('store-classroom');
            
            Route::get('/classrooms-list', [ClassroomController::class, 'listClassrooms'])->name('list-classrooms');
        });

        Route::prefix('student')->group(function (){

            Route::get('/detail', function() {
                return view ('students.show');
            })->name('detail-student');

            Route::get('/create-student', [StudentController::class, 'create'])->name('create-student');

            Route::get('/student-list', [StudentController::class, 'index'])->name('student-list');

            Route::post('/by-class', [StudentController::class, 'getStudentsByClass'])->name('students-by-class');

            Route::get('/students-by-class', [StudentController::class, 'showStudentsByClass'])->name('show-students-by-class');

            Route::post('/download-by-class/{classId}', [StudentController::class, 'downloadByClass'])->name('download-by-class');

            Route::get('/download-by-class/{classId}', [StudentController::class, 'downloadByClass'])->name('download-by-class');

        });


        Route::prefix('payment')->group(function () {
            // Route pour créer un paiement
            Route::get('/create', [PaymentController::class, 'create'])->name('make-payment');
            
            // Route pour lister les paiements
            Route::get('/list', [PaymentController::class, 'index'])->name('payment-list');
            
            // Route pour stocker un paiement
            Route::post('/', [PaymentController::class, 'store'])->name('payment.store');
        });

        Route::get('/detail/{id}', [PaymentController::class, 'show'])->name('detail-payment');
        


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

        Route::prefix('course')->group(function (){

            Route::get('create', [\App\Http\Controllers\CourseController::class, 'create'])->name('create-course');

            Route::post('store', [\App\Http\Controllers\CourseController::class, 'store'])->name('store-course');

            Route::get('list', [\App\Http\Controllers\CourseController::class, 'index'])->name('course-list');

        });


        Route::prefix('timetables')->group(function () {
            Route::get('/', [TimetableController::class, 'index'])->name('timetables.index');
            Route::get('/create', [TimetableController::class, 'create'])->name('timetables.create');
            Route::post('/store', [TimetableController::class, 'store'])->name('timetables.store');
            Route::get('/{id}', [TimetableController::class, 'weeklyView'])->name('timetables.weekly-view');
            Route::delete('/{id}', [TimetableController::class, 'destroy'])->name('timetables.destroy');
        });
        

        Route::get('/add-course/{id}', [TimetableController::class, 'showAddCourseForm'])->name('timetables.showAddCourseForm');
        Route::post('/add-course/{id}', [TimetableController::class, 'addCourse'])->name('timetables.addCourse');

        

        
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

    });
    Route::prefix('attendance')->group(function () {

        // Route to show the form for creating a new event
        Route::get('/create', function () {
            return view('attendances.create');
        })->name('create-attendance');

        // Route to handle form submission and store the event
        // Route::post('/store', [SchoolEventController::class, 'store'])->name('store-event');

        // // Route to show the list of events
        // Route::get('/list', [SchoolEventController::class, 'index'])->name('event-list');

    });




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

    Route::get('/sign-up', [RegisterController::class, 'create'])->name('sign-up');
    Route::post('/sign-up', [RegisterController::class, 'store']);

    Route::get('/sign-in', [LoginController::class, 'create'])->name('sign-in');
    Route::post('/sign-in', [LoginController::class, 'store']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store']);
});


// Route accessible without middleware
Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

// Example of a route that does not require any specific middleware
Route::get('/prof', function () {
    return view('tlistdraft');
});
Route::get('/class', function () {
    return view('cdraft');
});
// Route::get('/student', function () {
//     return view('sdraft');
Route::get('/student', function () {
    return view('sdraft');
});
Route::get('/teacher', function () {
    return view('tlistdraft');
});



Route::post('/students', [StudentController::class, 'store'])->name('students.store');
