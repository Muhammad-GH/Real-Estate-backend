<?php
use App\Http\Controllers\Backend\professionalEnquiries\ProfessionalEnquiriesController;
// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'professional-enquiries',
    'as' => 'professional-enquiries.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // Property Management
    Route::group(['namespace' => 'professional-enquiries'], function () {
        
        Route::any('/service-providers', [ProfessionalEnquiriesController::class, 'serviceProvidersRequests'])->name('service-providers');
		Route::any('investors', [ProfessionalEnquiriesController::class, 'investorsRequests'])->name('investors');
		Route::any('/real-estate', [ProfessionalEnquiriesController::class, 'realEstateRequests'])->name('real-estate');
        Route::any('/markkinapaikka', [ProfessionalEnquiriesController::class, 'marketplaceRequests'])->name('marketplace');
        Route::any('/show/{id}', [ProfessionalEnquiriesController::class, 'show'])->name('show');

		
    });

});
