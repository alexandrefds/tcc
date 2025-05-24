<?php

use App\Http\Controllers\Ad\CreateAdController;
use App\Http\Controllers\Ad\GetAdController;
use App\Http\Controllers\Ad\GetAllAdsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('ad')->group(function () {
    Route::post('/', CreateAdController::class)->name('create.ad');
    Route::get('/', GetAllAdsController::class)->name('get.all.ads');
    Route::get('/{property_id}', GetAdController::class)->name('get.ad');
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
