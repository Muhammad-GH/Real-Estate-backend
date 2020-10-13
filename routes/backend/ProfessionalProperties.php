<?php
use App\Http\Controllers\Backend\ProfessionalProperties\ProfessionalPropertiiesController;
// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'professional-properties',
    'as' => 'professional-properties.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // Property Management
    Route::group(['namespace' => 'professional-properties'], function () {
        
        Route::any('/', [ProfessionalPropertiiesController::class, 'index'])->name('all');
        Route::any('/show/{id}', [ProfessionalPropertiiesController::class, 'show'])->name('show');
		
    });

});
