<?php

use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

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
    Route::get('/2dd8a8e6-61b9-a7f3c9e1-4b2d--4b2d-8f6a-9c3e-58f6a-9c3e-5d7b1a8f4c2e4301-9587Xk9mP2vL8nQ4rT7w-8e14fad677bf', [FeedbackController::class, 'index'])->name('feedback.index');

    Route::get('/add', function () {
        return view('feedback.user_feedback');
    })->name('feedback.add');
    Route::get('/admin/update/{id}/b9-a7f3c9e1-4b2d--4b2d-8f6a-9c3e-58f6a-9c3e-5d7b1a8f4c2e4301-95fsgfsd87Xk9mP2vL8nQ4rT7w-8e14fad677bf', [FeedbackController::class, 'edit'])->name('feedback.adminEdit');

    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::put('/admin/update/{id}', [FeedbackController::class, 'adminUpdate'])->name('feedback.adminUpdate');

    Route::get('/feedback/{trackingId}', [FeedbackController::class, 'track'])->name('feedback.track');
});
