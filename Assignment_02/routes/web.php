<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;

Route::get('/', [MajorController::class, 'index'])->name('majors.index');
Route::get('/majors/create', [MajorController::class, 'create'])
->name('majors.create');
Route::post('/major', [MajorController::class, 'store'])->name('majors.store');
Route::get('/majors/{id}/edit', [MajorController::class, 'edit'])->name('majors.edit'); 
Route::put('/majors/{id}', [MajorController::class, 'update'])->name('majors.update'); 
Route::delete('/major/{id}', [MajorController::class, 'destroy'])
    ->name('majors.destroy');
Route::post('/majors/import', [MajorController::class, 'import'])
    ->name('majors.import');
Route::get('/majors/export', [MajorController::class, 'export'])
    ->name('majors.export');
    
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])
->name('students.create');
Route::post('/student', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit'); // Edit student form
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update'); // Update student
Route::delete('/student/{id}', [StudentController::class, 'destroy'])
      ->name('students.destroy');
Route::post('/students/import', [StudentController::class, 'import'])
    ->name('students.import');
Route::get('/students/export', [StudentController::class, 'export'])
    ->name('students.export');

