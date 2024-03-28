<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

// Маршруты для аутентификации и регистрации
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin'])->name('auth.login');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('register', [AuthController::class, 'postRegistration'])->name('auth.register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('auth.dashboard');
    })->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/create', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{id}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::get('/applications/{id}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('/applications/{id}', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/applications/{id}', [ApplicationController::class, 'destroy'])->name('applications.destroy');

    Route::get('/applications/export', [ApplicationController::class, 'export'])->name('applications.export');
    Route::get('/applications/file-import-export', [ApplicationController::class, 'fileImportExport'])->name('applications.file-import-export');
    Route::post('/applications/import', [ApplicationController::class, 'import'])->name('applications.import');



    Route::get('/dashboard', function () {
        return view('auth.dashboard');
    })->name('dashboard');
});


// Route::middleware('auth')->group(function () {
//     Route::get('/applications/export', 'ApplicationController@export');
//     Route::resource('/applications', 'ApplicationController');
// });

// Route::middleware('auth')->prefix('user')->group(function () {
//     Route::resource('/applications', 'UserApplicationController');
// });

// Route::get('auth/home', [App\Http\Controllers\Auth\HomeController::class, 'index'])->name('auth.home')->middleware('isAdmin');
// Route::get('user/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('user.home');


// require __DIR__ . '/auth.php';