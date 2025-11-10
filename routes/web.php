<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoomController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;

// Admin room management
Route::get('/', [RoomController::class, 'index'])->name('rooms.index');

// Route::get('/', [RoomController::class,'index']);
Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
Route::get('/room/{id}', [RoomController::class, 'delete'])->name('room.delete');
Route::post('/room', [RoomController::class, 'store'])->name('rooms.store');

// Student join page via code
Route::get('/{code}', [JoinController::class, 'showJoinPage'])
    ->name('join.page')
    ->defaults('isAdmin', false);

Route::get('/{code}/2dd8a8e6-61b9-a7f3c9e1-4b2d-8f6a-9c3e-5d7b1a8f4c2e4301-9587Xk9mP2vL8nQ4rT7w-8e14fad677bf', [JoinController::class, 'showJoinPage'])
    ->name('join.page.admin')
    ->defaults('isAdmin', true);
Route::post('/{code}/join', [JoinController::class,'join'])->name('join.submit');

// API endpoints (teacher actions & polling)
Route::get('/{code}/queue', [JoinController::class,'queueJson']); // polling: queue state
Route::post('/{code}/entry/{id}/start', [TeacherController::class,'startEntry']);
Route::post('/{code}/entry/{id}/done', [TeacherController::class,'finishEntry']);
Route::post('/{code}/entry/{id}/remove', [TeacherController::class,'removeEntry']);