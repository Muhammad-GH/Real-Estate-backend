<?php

use App\Http\Controllers\Backend\Pro\Category\CategoryController;

// All route names are prefixed with 'category'.
Route::group([
    'prefix' => 'category',
    'as' => 'category.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // Category Management
    Route::group(['namespace' => 'Category'], function () {

        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{category_id}', [CategoryController::class, 'edit'])->name('edit');
        Route::any('update/{category_id}', [CategoryController::class, 'update'])->name('update');
        Route::any('destroy/{category_id}', [CategoryController::class, 'destroy'])->name('destroy');
    });

});
