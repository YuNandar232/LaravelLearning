<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;

Route::name('major.')->controller(MajorController::class)->group(
    function () {
        Route::get('/', 'index')->name('index');
        Route::get('/major/create', 'create')->name('create');
        Route::post('/major', 'store')->name('store');
        Route::get('/major/{id}/edit', 'edit')->name('edit');
        Route::put('/update_major/{id}', 'update')->name('update');
        Route::delete('/delete_major/{id}', 'destroy')->name('destroy');
    }
);

Route::name('student.')->controller(StudentController::class)->group(
    function () {
        Route::get('/student', 'index')->name('index');
        Route::get('/student/create', 'create')->name('create');
        Route::post('/student', 'store')->name('store');
        Route::get('/student/{id}/edit', 'edit')->name('edit');
        Route::put('/update_student/{id}', 'update')->name('update');
        Route::delete('/delete_student/{id}', 'destroy')->name('destroy');
    }
);
