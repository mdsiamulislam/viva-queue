<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoomController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\TeacherController;

Route::get('/', [RoomController::class,'index']); // list rooms
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
Route::post('/room', [RoomController::class, 'store'])->name('rooms.store');

// Student join page via code
Route::get('/v/{code}', [JoinController::class,'showJoinPage']);
Route::post('/v/{code}/join', [JoinController::class,'join']);

// API endpoints (teacher actions & polling)
Route::get('/v/{code}/queue', [JoinController::class,'queueJson']); // polling: queue state
Route::post('/v/{code}/entry/{id}/start', [TeacherController::class,'startEntry']);
Route::post('/v/{code}/entry/{id}/done', [TeacherController::class,'finishEntry']);
Route::post('/v/{code}/entry/{id}/remove', [TeacherController::class,'removeEntry']);