<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrediktorController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('prediktors', PrediktorController::class);
