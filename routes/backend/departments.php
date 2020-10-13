<?php

use App\Http\Controllers\Backend\Departments\DepartmentsController;

// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'departments',
    'as' => 'departments.',
    'middleware' => 'right:'.config('access.users.jobs'),
], function () {
    // Property Management
    Route::group(['namespace' => 'Departments'], function () {

        Route::get('/', [DepartmentsController::class, 'index'])->name('index');
        Route::get('/create', [DepartmentsController::class, 'create'])->name('create');
        Route::post('/', [DepartmentsController::class, 'store'])->name('store');
        Route::get('edit/{department_id}', [DepartmentsController::class, 'edit'])->name('edit');
        Route::any('update/{department_id}', [DepartmentsController::class, 'update'])->name('update');
        Route::any('destroy/{department_id}', [DepartmentsController::class, 'destroy'])->name('destroy');
    });

});
