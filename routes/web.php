<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    
    // Root/Admin Panel Route
   
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('home');
        Route::get('students', [AdminStudentController::class, 'index'])->name('student.index');
        Route::get('students/create', [AdminStudentController::class, 'create'])->name('student.create');
        Route::post('students', [AdminStudentController::class, 'store'])->name('student.store');
        Route::get('students/{user}/edit', [AdminStudentController::class, 'edit'])->name('student.edit');
        Route::put('students/{user}', [AdminStudentController::class, 'update'])->name('student.update');
        Route::delete('students/{user}', [AdminStudentController::class, 'destroy'])->name('student.destroy');
        });
        // Student Panel Route
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.home');
    Route::get('/settings', [SettingsController::class, 'edit'])->name('student.settings.edit');
    Route::put('/settings', [SettingsController::class, 'update'])->name('student.settings.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Fallback entry redirect
Route::get('/', function () {
    return redirect()->route('login');
});