<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;


 Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
 Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);

Route::any('/{any}', fn() => view('default'))->where('any', '.*');

