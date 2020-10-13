<?php

use App\Http\Controllers\Backend\Jobs\JobsController;

// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'jobs',
    'as' => 'jobs.',
    'middleware' => 'right:'.config('access.users.jobs'),
], function () {
    // Property Management
    Route::group(['namespace' => 'Jobs'], function () {
        Route::get('/', [JobsController::class, 'index'])->name('index');
        Route::get('/create', [JobsController::class, 'create'])->name('create');
        Route::post('/', [JobsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [JobsController::class, 'edit'])->name('edit');
        Route::any('update/{id}', [JobsController::class, 'update'])->name('update');
        Route::any('destroy/{id}', [JobsController::class, 'destroy'])->name('destroy');
    });

});
