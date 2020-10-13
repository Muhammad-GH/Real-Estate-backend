<?php

use App\Http\Controllers\Backend\Pro\Category\WorkCategoryController;

// All route names are prefixed with 'workcategory'.
Route::group([
    'prefix' => 'workcategory', 
    'as' => 'workcategory.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // WorkCategory Management
    Route::group(['namespace' => 'workcategory'], function () {

        Route::get('/', [WorkCategoryController::class, 'index'])->name('index');
        Route::get('/create', [WorkCategoryController::class, 'create'])->name('create');
        Route::post('/store', [WorkCategoryController::class, 'store'])->name('store');
        Route::get('edit/{category_id}', [WorkCategoryController::class, 'edit'])->name('edit');
        Route::any('update/{category_id}', [WorkCategoryController::class, 'update'])->name('update');
        Route::any('destroy/{category_id}', [WorkCategoryController::class, 'destroy'])->name('destroy');
    });

});
