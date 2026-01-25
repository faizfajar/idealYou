<?php

use App\Http\Controllers\BmiController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

// Guest routes - redirect to login
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});

// Protected routes - require authentication
Route::middleware('auth')->group(function () {

    // Redirect dashboard to home
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');

    // BMI Calculator Routes
    Route::controller(BmiController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
        Route::post('/calculate', 'calculate')->name('bmi.calculate'); 
    });
        
    // History Routes
    Route::get('/history', [HistoryController::class, 'index'])->name('bmi.history');
    Route::get('/history/{id}', [HistoryController::class, 'detail'])->name('history.detail');
    Route::delete('/history/{id}', [HistoryController::class, 'destroy'])->name('bmi.history.delete');
});

require __DIR__ . '/settings.php';
