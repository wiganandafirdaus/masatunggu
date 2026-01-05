<?php

use App\Http\Controllers\PrediktorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PrediktorController::class, 'index']);

Route::resource('prediktors', PrediktorController::class);

Route::post('/save-prediction', [PrediktorController::class, 'savePrediction'])->name('save.prediction');
