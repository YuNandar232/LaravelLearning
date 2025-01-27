<?php

use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::name('major.')->controller(MajorController::class)->group(
    function () {
        Route::get('/', 'index')->name('index');
        Route::get('fetch_majors', 'fetchMajors')->name('fetchMajors');
        Route::post('/major', 'store')->name('store');
        Route::get('/major/{id}/edit', 'edit')->name('edit');
        Route::put('/update_major/{id}', 'update')->name('update');
        Route::delete('/delete_major/{id}', 'destroy')->name('destroy');
        Route::post('/major/import', 'import')->name('import');
        Route::get('/major/export', 'export')->name('export');
    }
);

Route::name('student.')->controller(StudentController::class)->group(
    function () {
        Route::get('/student', 'index')->name('index');
        Route::get('fetch_students', 'fetchStudents')
            ->name('fetchStudents');
        Route::get('/student/create', 'create');
        Route::post('/student', 'store')->name('store');
        Route::get('/student/{id}/edit', 'edit')->name('edit');
        Route::put('/update_student/{id}', 'update')->name('update');
        Route::delete('/delete_student/{id}', 'destroy')->name('destroy');
        Route::post('/student/import', 'import')->name('import');
        Route::get('/student/export', 'export')->name('export');
    }
);
