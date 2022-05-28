<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1 as API;


Route::group(['prefix' => 'posts'], function () {
    Route::get('/', API\IndexController::class)->name('post.all');
    Route::get('/{id}', API\ShowController::class)->name('post.show');
    Route::post('/', API\CreateController::class)->name('post.create');
    Route::put('/{id}', API\UpdateController::class)->name('post.update');
    Route::delete('/{id}', API\DeleteController::class)->name('post.delete');
});

