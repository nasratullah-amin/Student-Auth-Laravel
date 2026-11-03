
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/register', [
        AuthController::class,
        'showRegister',
    ])->name('register');

    Route::post('/register', [
        AuthController::class,
        'register',
    ])->name('register.store');

    Route::get('/login', [
        AuthController::class,
        'showLogin',
    ])->name('login');

    Route::post('/login', [
        AuthController::class,
        'login',
    ])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [
        CourseController::class,
        'index',
    ])->name('dashboard');

    Route::post('/logout', [
        AuthController::class,
        'logout',
    ])->name('logout');

    Route::post('/courses', [
        CourseController::class,
        'store',
    ])->name('courses.store');

    Route::get('/courses/{course}/edit', [
        CourseController::class,
        'edit',
    ])->whereNumber('course')->name('courses.edit');

    Route::get('/courses/{course}', [
        CourseController::class,
        'show',
    ])->whereNumber('course')->name('courses.show');

    Route::put('/courses/{course}', [
        CourseController::class,
        'update',
    ])->whereNumber('course')->name('courses.update');

    Route::delete('/courses/{course}', [
        CourseController::class,
        'destroy',
    ])->whereNumber('course')->name('courses.destroy');
});



