<?php

use App\Http\Controllers\Backend\Pro\Category\MaterialCategoryController;

// All route names are prefixed with 'materialcategory'.
Route::group([
    'prefix' => 'materialcategory', 
    'as' => 'materialcategory.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // MaterialCategory Management
    Route::group(['namespace' => 'materialcategory'], function () {

        Route::get('/', [MaterialCategoryController::class, 'index'])->name('index');
        Route::get('/create', [MaterialCategoryController::class, 'create'])->name('create');
        Route::post('/store', [MaterialCategoryController::class, 'store'])->name('store');
        Route::get('edit/{category_id}', [MaterialCategoryController::class, 'edit'])->name('edit');
        Route::any('update/{category_id}', [MaterialCategoryController::class, 'update'])->name('update');
        Route::any('destroy/{category_id}', [MaterialCategoryController::class, 'destroy'])->name('destroy');
    });

});
