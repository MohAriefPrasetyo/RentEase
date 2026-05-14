<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\PenaltyController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('equipment', EquipmentController::class)->except(['show']);
Route::resource('rentals', RentalController::class)->except(['edit', 'update']);
Route::resource('penalties', PenaltyController::class)->only(['index', 'create', 'store', 'destroy']);
