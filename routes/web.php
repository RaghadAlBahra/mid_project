<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\DashboardBookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpaceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'dashboard_access'])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('centers', CenterController::class);
    Route::resource('spaces', SpaceController::class);

    Route::get('bookings', [DashboardBookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('bookings/{booking}', [DashboardBookingController::class, 'show'])->name('admin.bookings.show');
    Route::patch('bookings/{booking}/confirm', [DashboardBookingController::class, 'confirm'])->name('admin.bookings.confirm');
    Route::patch('bookings/{booking}/reject', [DashboardBookingController::class, 'reject'])->name('admin.bookings.reject');
    // Route::resource('bookings', BookingController::class)->except(['edit', 'update']);

});

    Route::middleware('super_admin')->group(function () {
        Route::get('employee', [EmployeeController::class, 'index'])->name('admin.employees.index');
        Route::get('employee/create', [EmployeeController::class, 'create'])->name('admin.employees.create');
        Route::get('employee/{employee}', [EmployeeController::class, 'show'])->name('admin.employees.show');
        Route::post('employee', [EmployeeController::class, 'store'])->name('admin.employees.store');
        Route::get('employee/{employee}/edit', [EmployeeController::class, 'edit'])->name('admin.employees.edit');
        Route::put('employee/{employee}', [EmployeeController::class, 'update'])->name('admin.employees.update');
        Route::delete('employee/{employee}', [EmployeeController::class, 'destroy'])->name('admin.employees.destroy');
    });







require __DIR__ . '/auth.php';
