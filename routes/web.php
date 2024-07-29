<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ReexaminationController;


Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/reexaminations/create', [ReexaminationController::class, 'create'])->name('reexaminations.create');
    Route::post('/reexaminations', [ReexaminationController::class, 'store'])->name('reexaminations.store');
});

Route::middleware(['auth', 'role:staff'])->group(function () {
    
    Route::resource('/classes', ClassController::class)->names([
        'index' => 'classes.index',
        'create' => 'classes.create',
        'store' => 'classes.store',
        'show' => 'classes.show',
        'edit' => 'classes.edit',
        'update' => 'classes.update',
        'destroy' => 'classes.destroy',
    ]);
    Route::resource('/departments', DepartmentController::class)->names([
        'index' => 'departments.index',
        'create' => 'departments.create',
        'store' => 'departments.store',
        'show' => 'departments.show',
        'edit' => 'departments.edit',
        'update' => 'departments.update',
        'destroy' => 'departments.destroy',
    ]);
    Route::resource('/courses', CourseController::class)->names([
        'index' => 'courses.index',
        'create' => 'courses.create',
        'store' => 'courses.store',
        'show' => 'courses.show',
        'edit' => 'courses.edit',
        'update' => 'courses.update',
        'destroy' => 'courses.destroy',
    ]);
    Route::resource('/exams', ExamController::class)->names([
        'index' => 'exams.index',
        'create' => 'exams.create',
        'store' => 'exams.store',
        'show' => 'exams.show',
        'edit' => 'exams.edit',
        'update' => 'exams.update',
        'destroy' => 'exams.destroy',
    ]);

    Route::put('/reexaminations/{id}', [ReexaminationController::class, 'update'])->name('reexaminations.update');
    Route::post('reexaminations/export', [ReexaminationController::class, 'export'])->name('reexaminations.export');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/reexaminations', [ReexaminationController::class, 'index'])->name('reexaminations.index');
    Route::get('/reexaminations/{id}', [ReexaminationController::class, 'show'])->name('reexaminations.show');
    
});