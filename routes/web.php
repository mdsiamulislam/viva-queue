<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Laravel\Socialite\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/onboarding', function () {
    return view('welcome');
})->name('onboarding');

Route::prefix('auth')->group(function () {

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    // STEP 1 : redirect to Google
    Route::get('/google', function () {
        return Socialite::driver('google')->redirect();
    })->name('google.redirect');

    // STEP 2 : Google callback hits here
    Route::get('/google/callback', [AuthController::class, 'googleCallback'])
        ->name('google.callback');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');




// -------------------- Admin routes -------------------- //
Route::prefix('admin')->group(function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');


    // -------------------- Feedback management for admin --------------------
    Route::get('/feedback', [FeedbackController::class, 'index'])->middleware('auth')->name('feedback.index');
    Route::get('/update/{id}', [FeedbackController::class, 'edit'])->middleware('auth')->name('feedback.adminEdit');
    Route::get('/updatefeedback/{id}', [FeedbackController::class, 'adminUpdate'])->middleware('auth')->name('feedback.adminUpdate');
    Route::get('/delete/{id}', [FeedbackController::class, 'delete'])->middleware('auth')->name('feedback.delete');
    Route::get('/deleteallsiam', [FeedbackController::class, 'deleteAll'])->middleware('auth')->name('feedback.deleteAll');
});


// --------------------
// ✅ Student routes (place these first)
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');
Route::get('/students/export', [StudentController::class, 'export'])->name('students.export');
Route::get('/students/delete-all', [StudentController::class, 'deleteAll'])->name('students.deleteAll');

// --------------------
// ✅ Admin room management
Route::get('/', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
Route::get('/room/{id}', [RoomController::class, 'delete'])->name('room.delete');
Route::post('/room', [RoomController::class, 'store'])->name('rooms.store');

// --------------------
// ✅ Join routes
Route::get('/{code}/2dd8a8e6-61b9-a7f3c9e1-4b2d-8f6a-9c3e-5d7b1a8f4c2e4301-9587Xk9mP2vL8nQ4rT7w-8e14fad677bf', [JoinController::class, 'showJoinPage'])
    ->name('join.page.admin')
    ->defaults('isAdmin', true);

Route::get('/{code}', [JoinController::class, 'showJoinPage'])
    ->name('join.page')
    ->defaults('isAdmin', false);

Route::post('/{code}/join', [JoinController::class, 'join'])->name('join.submit');

// --------------------
// ✅ API endpoints
Route::get('/{code}/queue', [JoinController::class, 'queueJson']);
Route::post('/{code}/entry/{id}/start', [TeacherController::class, 'startEntry']);
Route::post('/{code}/entry/{id}/done', [TeacherController::class, 'finishEntry']);
Route::post('/{code}/entry/{id}/remove', [TeacherController::class, 'removeEntry']);



// Route group for feedback management
Route::prefix('feedback')->group(function () {
    Route::get('/add', function () {
        return view('feedback.user_feedback');
    })->name('feedback.add');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/{trackingId}', [FeedbackController::class, 'track'])->name('feedback.track');
});



// -------------------- Get Together routes -------------------- //
Route::prefix('gettogether')->group(function () {
    Route::get('/manage', function () {
        return view('gettogether.index');
    })->middleware('auth')->name('gettogether.index');
});



// -------------------- Universal Page -------------------- //
Route::get('/error', function () {
    return view('universal.error');
})->name('universal.error');
