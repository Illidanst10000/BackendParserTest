<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'post'], function () {
    Route::get('/', \App\Http\Controllers\Api\V1\IndexController::class)->name('post.all');
    Route::get('/show/{id}', \App\Http\Controllers\Api\V1\ShowController::class)->name('post.show');
    Route::post('/create', \App\Http\Controllers\Api\V1\CreateController::class)->name('post.create');
    Route::put('/update/{id}', \App\Http\Controllers\Api\V1\UpdateController::class)->name('post.update');
    Route::delete('/delete/{id}', \App\Http\Controllers\Api\V1\DeleteController::class)->name('post.delete');
});

