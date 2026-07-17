<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Guest routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {


    // Login харах

    Route::get(
        'login',
        [AuthenticatedSessionController::class, 'create']
    )
    ->name('login');



    // Login хийх

    Route::post(
        'login',
        [AuthenticatedSessionController::class, 'store']
    );



});





/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    // Logout

    Route::post(
        'logout',
        [AuthenticatedSessionController::class, 'destroy']
    )
    ->name('logout');


});