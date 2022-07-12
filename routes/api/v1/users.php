<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
//    'auth'
])
//    ->prefix('skd')
    ->name('users.')  //as()
//    ->namespace("\App\Http\Controllers")
    ->group(function(){
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])
        ->name('index')
        ->withoutMiddleware('auth');
    Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])
        ->name('show')
//        ->where('user', '[0-9]+');
        ->whereNumber('user');
    Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('store');
    Route::patch('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('update');
    Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('destroy');
});
//Route::apiResource('users', \App\Http\Controllers\UserController::class);

