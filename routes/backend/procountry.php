<?php

use App\Http\Controllers\Backend\Pro\Common\CountryController;
 

// All route names are prefixed with 'Country'.
Route::group([
    'prefix' => 'country',
    'as' => 'country.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // Country Management
    Route::group(['namespace' => 'Country'], function () {

        Route::get('/', [CountryController::class, 'index'])->name('index');
        Route::get('/fetch_data', [CountryController::class, 'fetch_data'])->name('fetch_data');
        Route::get('/create', [CountryController::class, 'create'])->name('create');
        Route::get('/create_country_language', [CountryController::class, 'create_country_language'])->name('create_country_language');
        Route::post('/', [CountryController::class, 'store'])->name('store');
        Route::get('edit/{country_id}', [CountryController::class, 'edit'])->name('edit');
        Route::get('view/{country_id}', [CountryController::class, 'view'])->name('view');
        Route::any('update/{country_id}', [CountryController::class, 'update'])->name('update');
        Route::any('destroy/{country_id}', [CountryController::class, 'destroy'])->name('destroy');
        
        

        //Route::get('/country/fetch_data', 'PaginationController@fetch_data');
        
    });

});
 