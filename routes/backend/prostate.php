<?php

 
use App\Http\Controllers\Backend\Pro\Common\StateController;
use App\Http\Controllers\Backend\Pro\Common\CityController;
use App\Http\Controllers\Backend\Pro\Common\WorkareaController;
use App\Http\Controllers\Backend\Pro\Common\WorkphaseController;

// All route names are prefixed with 'State'.
Route::group([
    'prefix' => 'state',
    'as' => 'state.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // State Management
    Route::group(['namespace' => 'State'], function () {

        Route::get('/', [StateController::class, 'index'])->name('index');
        Route::get('/fetch_data', [StateController::class, 'fetch_data'])->name('fetch_data');
        
        Route::get('/create', [StateController::class, 'create'])->name('create');
        Route::get('/create_state_language', [StateController::class, 'create_state_language'])->name('create_state_language');
        Route::post('/', [StateController::class, 'store'])->name('store');
        Route::get('edit/{state_id}', [StateController::class, 'edit'])->name('edit');
        Route::get('view/{state_id}', [StateController::class, 'view'])->name('view');
        Route::any('update/{state_id}', [StateController::class, 'update'])->name('update');
        Route::any('destroy/{state_id}', [StateController::class, 'destroy'])->name('destroy');
        Route::get('/get_country_by_state', [StateController::class, 'get_country_by_state'])->name('get_country_by_state');
        
    });

});

// All route names are prefixed with 'State'.
Route::group([
    'prefix' => 'city',
    'as' => 'city.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // City Management
    Route::group(['namespace' => 'State'], function () {

        Route::get('/', [CityController::class, 'index'])->name('index');
        Route::get('/fetch_data', [CityController::class, 'fetch_data'])->name('fetch_data');
        
        Route::get('/create', [CityController::class, 'create'])->name('create');
        Route::get('/create_city_language', [CityController::class, 'create_city_language'])->name('create_city_language');
        Route::post('/', [CityController::class, 'store'])->name('store');
        Route::get('edit/{city_id}', [CityController::class, 'edit'])->name('edit');
        Route::get('view/{city_id}', [CityController::class, 'view'])->name('view');
        Route::any('update/{city_id}', [CityController::class, 'update'])->name('update');
        Route::any('destroy/{city_id}', [CityController::class, 'destroy'])->name('destroy');
        Route::get('/get_city_by_state', [CityController::class, 'get_city_by_state'])->name('get_city_by_state');
        
    });

});


// All route names are prefixed with 'Workarea'.
Route::group([
    'prefix' => 'workarea',
    'as' => 'workarea.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // workarea Management
    Route::group(['namespace' => 'Workarea'], function () {

        Route::get('/', [WorkareaController::class, 'index'])->name('index');
        Route::get('/fetch_data', [WorkareaController::class, 'fetch_data'])->name('fetch_data');
        
        Route::get('/create', [WorkareaController::class, 'create'])->name('create');
        Route::get('/create_workarea_language', [WorkareaController::class, 'create_workarea_language'])->name('create_workarea_language');
        Route::post('/', [WorkareaController::class, 'store'])->name('store');
        Route::get('edit/{area_id}', [WorkareaController::class, 'edit'])->name('edit');
        Route::get('view/{area_id}', [WorkareaController::class, 'view'])->name('view');
        Route::any('update/{area_id}', [WorkareaController::class, 'update'])->name('update');
        Route::any('destroy/{area_id}', [WorkareaController::class, 'destroy'])->name('destroy');
        Route::get('/get_city_by_state', [WorkareaController::class, 'get_city_by_state'])->name('get_city_by_state');
        
    });

});

// All route names are prefixed with 'workphase'.
Route::group([
    'prefix' => 'workphase',
    'as' => 'workphase.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // workarea Management
    Route::group(['namespace' => 'Workphase'], function () {

        Route::get('/', [WorkphaseController::class, 'index'])->name('index');
        Route::get('/fetch_data', [WorkphaseController::class, 'fetch_data'])->name('fetch_data');
        
        Route::get('/create', [WorkphaseController::class, 'create'])->name('create');
        Route::get('/create_workphase_language', [WorkphaseController::class, 'create_workphase_language'])->name('create_workphase_language');
        Route::post('/', [WorkphaseController::class, 'store'])->name('store');
        Route::get('edit/{aw_id}', [WorkphaseController::class, 'edit'])->name('edit');
        Route::get('view/{aw_id}', [WorkphaseController::class, 'view'])->name('view');
        Route::any('update/{aw_id}', [WorkphaseController::class, 'update'])->name('update');
        Route::any('destroy/{aw_id}', [WorkphaseController::class, 'destroy'])->name('destroy');
        Route::get('/get_workarea_by_workphase', [WorkphaseController::class, 'get_workarea_by_workphase'])->name('get_workarea_by_workphase');
        
    });

});
