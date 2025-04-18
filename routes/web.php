<?php

use App\Http\Controllers\Ad\CreateAdController;
use App\Http\Controllers\Ad\GetAllPropertiesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('ad')->group(function () {
    Route::post('/', CreateAdController::class)->name('create.ad');
    Route::get('/', GetAllPropertiesController::class)->name('get.all.ads');
});
