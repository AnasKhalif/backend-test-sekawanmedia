<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ApproverReservationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::name('admin.')->prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{slug}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{slug}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{slug}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

Route::name('approver.')->prefix('approver')->middleware(['auth', 'role:supervisor|manager'])->group(function () {
    Route::get('/reservations', [ApproverReservationController::class, 'index'])->name('reservations.index');
    Route::patch('/reservations/{reservation}/status', [ApproverReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
});

Route::get('/reports', [ReportController::class, 'index'])->middleware('auth')->name('reports');
Route::get('/reports/export', [ReportController::class, 'export'])->middleware('auth')->name('reports.export');

Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData']);

require __DIR__ . '/auth.php';
