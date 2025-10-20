<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Routes - Tasks
Route::get('/', [TaskController::class, 'dashboard']);
Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/addtask', [TaskController::class, 'addTaskForm']);
Route::post('/addtask', [TaskController::class, 'store']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/edittask/{tid}', [TaskController::class, 'editTask']);
Route::post('/tasks/edittask/{tid}', [TaskController::class, 'editTask']);
Route::put('/tasks/{task}', [TaskController::class, 'update']);
Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');
Route::get('/tasks/pagination', [TaskController::class, 'paginateTasks'])->name('tasks.pagination');

// Routes - Projects
Route::get('/projects', [TaskController::class, 'projects']);
Route::post('tasks/addproject', [TaskController::class, 'addProject']);
Route::post('tasks/updateproject', [TaskController::class, 'editProject']);
Route::post('tasks/deleteproject', [TaskController::class, 'deleteProject']);