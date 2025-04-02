<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});

Route::get('/', [LoginController::class, 'login']);
Route::post('login-by-password', [LoginController::class, 'authenticate']);

Route::prefix('auth')->group(function(){
    Route::get('dashboard', [LoginController::class, 'dashboard']);
    Route::get('logout', [LoginController::class, 'logout']);
});
