<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
});

require __DIR__.'/auth.php';
require __DIR__.'/log-viewer.php';


//Pro Users
Breadcrumbs::for('admin.auth.prouser.create', function ($trail) {
    $trail->push('Pro Users', route('admin.auth.prouser.create'));
});
Breadcrumbs::for('admin.users', function ($trail) {
    $trail->push('Title Here', route('admin.users'));
});

// Email content
Breadcrumbs::for('admin.emails.index', function ($trail) {
    $trail->push('Email Content', route('admin.emails.index'));
});
Breadcrumbs::for('admin.emails.create', function ($trail) {
    $trail->push('Create Content', route('admin.emails.create'));
});
Breadcrumbs::for('admin.emails.edit', function ($trail, $id) {
    $trail->push('Edit Content', route('admin.emails.edit', $id));
});
// Breadcrumbs::for('admin.emails.create_', function ($trail) {
//     $trail->push('Edit Content', route('admin.emails.create_'));
// });

// general
Breadcrumbs::for('admin.global.general', function ($trail) {
    $trail->push('Title Here', route('admin.global.general'));
});
Breadcrumbs::for('admin.emails.case', function ($trail) {
    $trail->push('Title Here', route('admin.emails.case'));
});

//Project Breadcrumb
Breadcrumbs::for('admin.property.index', function ($trail) {
    $trail->push('Project Management', route('admin.property.index'));
});

// translations
Breadcrumbs::for('admin.global.translation_index', function ($trail) {
    $trail->push('Title Here', route('admin.global.translation_index'));
});

Breadcrumbs::for('admin.property.create', function ($trail) {
    $trail->parent('admin.property.index');
    $trail->push('Create Property', route('admin.property.create'));
});

Breadcrumbs::for('admin.property.deleted', function ($trail) {
    $trail->parent('admin.property.index');
    $trail->push('Deleted Property', route('admin.property.deleted'));
});

Breadcrumbs::for('admin.property.show', function ($trail, $id) {
    $trail->parent('admin.property.index');
    $trail->push('View Property', route('admin.property.show', $id));
});

Breadcrumbs::for('admin.property.edit', function ($trail, $id) {
    $trail->parent('admin.property.index');
    $trail->push('Edit Property', route('admin.property.edit', $id));
});

Breadcrumbs::for('admin.property.contact', function ($trail) {
    $trail->parent('admin.property.index');
    $trail->push('Property Contact', route('admin.property.contact'));
});

Breadcrumbs::for('admin.property.ostamassa', function ($trail) {
    $trail->parent('admin.property.index');
    $trail->push('Ostamassa Property', route('admin.property.ostamassa'));
});

Breadcrumbs::for('admin.property.ostamassa_view', function ($trail,$id) {
    $trail->parent('admin.property.index');
    $trail->push('Ostamassa Property View', route('admin.property.ostamassa_view',$id));
});
Breadcrumbs::for('admin.property.ostamassa_edit', function ($trail,$id) {
    $trail->parent('admin.property.index');
    $trail->push('Ostamassa Property Edit', route('admin.property.ostamassa_edit',$id));
});


Breadcrumbs::for('admin.property.myymassa', function ($trail) {
    $trail->push('Myymassa Query', route('admin.property.myymassa'));
});

Breadcrumbs::for('admin.property.myymassa_view', function ($trail,$id) {
    $trail->parent('admin.property.myymassa');
    $trail->push('Myymassa Query View', route('admin.property.myymassa_view',$id));
});

Breadcrumbs::for('admin.investproperty.invest_request', function ($trail) {
    $trail->push('Investment Request', route('admin.investproperty.invest_request'));
});

Breadcrumbs::for('admin.property.invest_request_view', function ($trail,$id) {
    $trail->parent('admin.investproperty.invest_request');
    $trail->push('Investment Request View', route('admin.property.invest_request_view',$id));
});

//Invest Project Breadcrumb
Breadcrumbs::for('admin.investproperty.index', function ($trail) {
    $trail->push('Invest Property Management', route('admin.investproperty.index'));
});

Breadcrumbs::for('admin.investproperty.create', function ($trail) {
    $trail->parent('admin.investproperty.index');
    $trail->push('Create Invest Property', route('admin.investproperty.create'));
});

Breadcrumbs::for('admin.investproperty.deleted', function ($trail) {
    $trail->parent('admin.investproperty.index');
    $trail->push('Deleted Invest Property', route('admin.investproperty.deleted'));
});

Breadcrumbs::for('admin.investproperty.show', function ($trail, $id) {
    $trail->parent('admin.investproperty.index');
    $trail->push('View Invest Property', route('admin.investproperty.show', $id));
});

Breadcrumbs::for('admin.investproperty.edit', function ($trail, $id) {
    $trail->parent('admin.investproperty.index');
    $trail->push('Edit Invest Property', route('admin.investproperty.edit', $id));
});

Breadcrumbs::for('admin.investproperty.contact', function ($trail) {
    $trail->parent('admin.investproperty.index');
    $trail->push('Invest Property Contact', route('admin.investproperty.contact'));
});

Breadcrumbs::for('admin.property.contactshow', function ($trail,$id) {
    $trail->parent('admin.property.index');
    $trail->push('Property Contact', route('admin.property.contactshow',$id));
});


//Settings

Breadcrumbs::for('admin.setting.pdf.index', function ($trail) {
    $trail->push('PDF Management', route('admin.setting.pdf.index'));
});

Breadcrumbs::for('admin.setting.pdf.create', function ($trail) {
    $trail->parent('admin.setting.pdf.index');
    $trail->push('Create PDF ', route('admin.setting.pdf.create'));
});

Breadcrumbs::for('admin.setting.pdf.deleted', function ($trail) {
    $trail->parent('admin.setting.pdf.index');
    $trail->push('Deleted PDF', route('admin.setting.pdf.deleted'));
});

Breadcrumbs::for('admin.setting.pdf.edit', function ($trail,$id) {
    $trail->parent('admin.setting.pdf.index');
    $trail->push('Edit PDF', route('admin.setting.pdf.edit',$id));
});


Breadcrumbs::for('admin.request.index', function ($trail) {
    $trail->push('Contact Request', route('admin.request.index'));
});
Breadcrumbs::for('admin.request.contact', function ($trail) {
    $trail->push('Contact Request', route('admin.request.contact'));
});
Breadcrumbs::for('admin.request.contact_view', function ($trail,$id) {
    $trail->push('Contact Request View', route('admin.request.contact_view',$id));
});

Breadcrumbs::for('admin.request.classified', function ($trail) {
    $trail->push('Classified Request', route('admin.request.classified'));
});
Breadcrumbs::for('admin.request.classified_view', function ($trail,$id) {
    $trail->push('Classified Request View', route('admin.request.classified_view',$id));
});
Breadcrumbs::for('admin.property.ostamassa_request', function ($trail) {
    $trail->push('Ostamassa Property Request', route('admin.property.ostamassa_request'));
});

Breadcrumbs::for('admin.property.ostamassa_request_view', function ($trail,$id) {
    $trail->push('Ostamassa Property Request View', route('admin.property.ostamassa_request_view',$id));
});

//Calculator

Breadcrumbs::for('admin.calculator.index', function ($trail) {
    $trail->push('Calculator Management', route('admin.calculator.index'));
});
Breadcrumbs::for('admin.calculator.flip-calc', function ($trail) {
    $trail->push('Title Here', route('admin.calculator.flip-calc'));
});
Breadcrumbs::for('admin.calculator.work-rates', function ($trail) {
    $trail->push('Title Here', route('admin.calculator.work-rates'));
});
Breadcrumbs::for('admin.calculator.import-data', function ($trail) {
    $trail->push('Title Here', route('admin.calculator.import-data'));
});
Breadcrumbs::for('admin.frontendmanagement.index', function ($trail) {
    $trail->push('Languages', route('admin.frontendmanagement.index'));
});

Breadcrumbs::for('admin.frontendmanagement.addlanguage', function ($trail) {
    $trail->push('Add Language', route('admin.frontendmanagement.addlanguage'));
});
Breadcrumbs::for('admin.frontendmanagement.alltext', function ($trail) {
    $trail->push('All Texts', route('admin.frontendmanagement.alltext'));
});
Breadcrumbs::for('admin.frontendmanagement.addtext', function ($trail) {
    $trail->push('Add Texts', route('admin.frontendmanagement.addtext'));
});
Breadcrumbs::for('admin.calculator.result-percentage', function ($trail) {
    $trail->push('Result Percentage', route('admin.calculator.result-percentage'));
});
Breadcrumbs::for('admin.calculator.renovation-submissions', function ($trail) {
    $trail->push('Renovation Submissions', route('admin.calculator.renovation-submissions'));
});
Breadcrumbs::for('admin.calculator.renovation-view', function ($trail,$id) {
    $trail->push('Renovation Data', route('admin.calculator.renovation-view',$id));
});
Breadcrumbs::for('admin.calculator.flip-submissions', function ($trail) {
    $trail->push('Flip Submissions', route('admin.calculator.flip-submissions'));
});
Breadcrumbs::for('admin.calculator.flip-view', function ($trail,$id) {
    $trail->push('Flip Data', route('admin.calculator.flip-view',$id));
});
Breadcrumbs::for('admin.calculator.create-result-percentage', function ($trail) {
    $trail->push('Create Result Percentage', route('admin.calculator.create-result-percentage'));
});
Breadcrumbs::for('admin.frontendmanagement.edittext', function ($trail) {
    $trail->push('Edit Text', route('admin.frontendmanagement.alltext'));
});

Breadcrumbs::for('admin.pages.edit', function ($trail,$pagesId) {
    $trail->push('Update Page', route('admin.pages.edit',$pagesId));
});
Breadcrumbs::for('admin.pages.index', function ($trail) {
    $trail->push('Page Management', route('admin.pages.index'));
});
Breadcrumbs::for('admin.pages.create', function ($trail) {
    $trail->push('Add Page', route('admin.pages.create'));
});

Breadcrumbs::for('admin.jobs.edit', function ($trail,$id) {
    $trail->push('Update Job', route('admin.jobs.edit',$id));
});
Breadcrumbs::for('admin.jobs.index', function ($trail) {
    $trail->push('Jobs Management', route('admin.jobs.index'));
});
Breadcrumbs::for('admin.jobs.create', function ($trail) {
    $trail->push('Add Job', route('admin.jobs.create'));
});

Breadcrumbs::for('admin.departments.edit', function ($trail,$department_id) {
    $trail->push('Update Department', route('admin.departments.edit',$department_id));
});
Breadcrumbs::for('admin.departments.index', function ($trail) {
    $trail->push('Departments Management', route('admin.departments.index'));
});
Breadcrumbs::for('admin.departments.create', function ($trail) {
    $trail->push('Add Department', route('admin.departments.create'));
});

// Marketplace
Breadcrumbs::for('admin.marketplace.MaterialRequests', function ($trail) {
    $trail->push('Material Requests', route('admin.marketplace.MaterialRequests'));
});
Breadcrumbs::for('admin.marketplace.MaterialRequests.create', function ($trail) {
    $trail->parent('admin.marketplace.MaterialRequests');
    $trail->push('Create Material Request', route('admin.marketplace.MaterialRequests.create'));
});
Breadcrumbs::for('admin.marketplace.MaterialRequests.show', function ($trail, $id) {
    $trail->parent('admin.marketplace.MaterialRequests');
    $trail->push('View Material Request', route('admin.marketplace.MaterialRequests.show', $id));
});
Breadcrumbs::for('admin.marketplace.MaterialRequests.edit', function ($trail, $id) {
    $trail->parent('admin.marketplace.MaterialRequests');
    $trail->push('Edit Material Request', route('admin.marketplace.MaterialRequests.edit', $id));
});
// Material Offers
Breadcrumbs::for('admin.marketplace.MaterialOffers', function ($trail) {
    $trail->push('Material Offers', route('admin.marketplace.MaterialOffers'));
});
Breadcrumbs::for('admin.marketplace.MaterialOffer.create', function ($trail) {
    $trail->parent('admin.marketplace.MaterialOffers');
    $trail->push('Create Material Offer', route('admin.marketplace.MaterialOffer.create'));
});
Breadcrumbs::for('admin.marketplace.MaterialOffer.show', function ($trail, $id) {
    $trail->parent('admin.marketplace.MaterialOffers');
    $trail->push('View Material Offer', route('admin.marketplace.MaterialOffer.show', $id));
});
Breadcrumbs::for('admin.marketplace.MaterialOffer.edit', function ($trail, $id) {
    $trail->parent('admin.marketplace.MaterialOffers');
    $trail->push('Edit Material Offer', route('admin.marketplace.MaterialOffer.edit', $id));
});

// Work Offer

Breadcrumbs::for('admin.marketplace.index', function ($trail) {   
    $trail->push('Work Offer', route('admin.marketplace.index'));
});
Breadcrumbs::for('admin.marketplace.addworkoffer', function ($trail) {
    $trail->parent('admin.marketplace.index');
    $trail->push('Add Work Offer', route('admin.marketplace.addworkoffer'));
});

Breadcrumbs::for('admin.marketplace.editworkoffer', function ($trail,$id) {
    $trail->parent('admin.marketplace.index');
    $trail->push('Edit Work Offer', route('admin.marketplace.editworkoffer',$id));
});
Breadcrumbs::for('admin.marketplace.viewworkoffer', function ($trail,$id) {
    $trail->parent('admin.marketplace.index');
    $trail->push('View Work Offer', route('admin.marketplace.viewworkoffer',$id));
});

// Work Request
Breadcrumbs::for('admin.marketplace.WorkRequests', function ($trail) {   
    $trail->push('Work Requests', route('admin.marketplace.WorkRequests'));
});

Breadcrumbs::for('admin.marketplace.WorkRequests.create', function ($trail) {  
    $trail->parent('admin.marketplace.WorkRequests');
    $trail->push('Create Work Request', route('admin.marketplace.WorkRequests.create'));
});
Breadcrumbs::for('admin.marketplace.WorkRequests.view', function ($trail,$id) {
    $trail->parent('admin.marketplace.WorkRequests');
    $trail->push('View Work Request', route('admin.marketplace.WorkRequests.view',$id));
});
Breadcrumbs::for('admin.marketplace.WorkRequests.edit', function ($trail,$id) {
    $trail->parent('admin.marketplace.WorkRequests');
    $trail->push('Edit Work Request', route('admin.marketplace.WorkRequests.edit',$id));
});

// Work Bid
Breadcrumbs::for('admin.marketplace.workOfferBidListing', function ($trail,$id) {
    $trail->parent('admin.marketplace.index');
    $trail->push('Bids', route('admin.marketplace.workOfferBidListing',$id));
});
Breadcrumbs::for('admin.marketplace.workOfferBidDetail', function ($trail,$id,$bidId) {
    $trail->parent('admin.marketplace.index');
    $trail->push('Bid Detail', route('admin.marketplace.workOfferBidDetail',['id'=>$id,'bidId'=>$bidId]));
});
Breadcrumbs::for('admin.marketplace.workRequestBidListing', function ($trail,$id) {
    $trail->parent('admin.marketplace.WorkRequests');
    $trail->push('Bids', route('admin.marketplace.workRequestBidListing',$id));
});
Breadcrumbs::for('admin.marketplace.workRequestBidDetail', function ($trail,$id,$bidId) {
    $trail->parent('admin.marketplace.WorkRequests');
    $trail->push('Bid Detail', route('admin.marketplace.workRequestBidDetail',['id'=>$id,'bidId'=>$bidId]));
});


// Material Bid

Breadcrumbs::for('admin.marketplace.materialOfferBidListing', function ($trail,$id) {
    $trail->parent('admin.marketplace.MaterialOffers');
    $trail->push('Material Offer Bids', route('admin.marketplace.materialOfferBidListing',$id));
});
Breadcrumbs::for('admin.marketplace.materialOfferBidDetail', function ($trail,$id,$bidId) {
    $trail->parent('admin.marketplace.MaterialOffers');
    $trail->push('Material Offer Bid Detail', route('admin.marketplace.materialOfferBidDetail',['id'=>$id,'bidId'=>$bidId]));
});
Breadcrumbs::for('admin.marketplace.materialRequestBidListing', function ($trail,$id) {
    $trail->parent('admin.marketplace.MaterialRequests');
    $trail->push('Material Request Bids', route('admin.marketplace.materialRequestBidListing',$id));
});
Breadcrumbs::for('admin.marketplace.materialRequestBidDetail', function ($trail,$id,$bidId) {
    $trail->parent('admin.marketplace.MaterialRequests');
    $trail->push('Material Request Bid Detail', route('admin.marketplace.materialRequestBidDetail',['id'=>$id,'bidId'=>$bidId]));
});

// Calc - Roomsdata
Breadcrumbs::for('admin.roomsdata.edit', function ($trail,$department_id) {
    $trail->push('Update Rooms Popup info', route('admin.roomsdata.edit',$department_id));
});
Breadcrumbs::for('admin.roomsdata.index', function ($trail) {
    $trail->push('Rooms Popup Info', route('admin.roomsdata.index'));
});
Breadcrumbs::for('admin.roomsdata.create', function ($trail) {
    $trail->push('Add Rooms Popup info', route('admin.roomsdata.create'));
});

Breadcrumbs::for('admin.professional-enquiries.service-providers', function ($trail) {
    $trail->push('Service Providers', route('admin.professional-enquiries.service-providers'));
});
Breadcrumbs::for('admin.professional-enquiries.show', function ($trail,$id) {
    $trail->push('show', route('admin.professional-enquiries.show',$id));
});
Breadcrumbs::for('admin.professional-enquiries.investors', function ($trail) {
    $trail->push('Investors', route('admin.professional-enquiries.investors'));
});
Breadcrumbs::for('admin.professional-enquiries.real-estate', function ($trail) {
    $trail->push('For Real Estate', route('admin.professional-enquiries.real-estate'));
});
Breadcrumbs::for('admin.professional-properties.all', function ($trail) {
    $trail->push('Professionals properties', route('admin.professional-properties.all'));
});
Breadcrumbs::for('admin.professional-properties.show', function ($trail,$id) {
    $trail->push('show', route('admin.professional-properties.show', $id));
});

Breadcrumbs::for('admin.SellUs-Service-request.all', function ($trail) {
    $trail->push('Sellus service requests', route('admin.SellUs-Service-request.all'));
});
Breadcrumbs::for('admin.SellUs-Service-request.view', function ($trail,$id) {
    $trail->push('Sellus service request', route('admin.SellUs-Service-request.view',$id));
});

// Pro Category
Breadcrumbs::for('admin.category.edit', function ($trail,$category_id) {
    $trail->push('Update Category', route('admin.category.edit',$category_id));
});
Breadcrumbs::for('admin.category.index', function ($trail) {
    $trail->push('Category Management', route('admin.category.index'));
});
Breadcrumbs::for('admin.category.create', function ($trail) {
    $trail->push('Add Category', route('admin.category.create'));
});   
Breadcrumbs::for('admin.professional-enquiries.marketplace', function ($trail) {
    $trail->push('Marketplace', route('admin.professional-enquiries.marketplace'));
});

// Material Category
Breadcrumbs::for('admin.materialcategory.edit', function ($trail,$category_id) {
    $trail->push('Update Material Category', route('admin.materialcategory.edit',$category_id));
});
Breadcrumbs::for('admin.materialcategory.index', function ($trail) {
    $trail->push('Material Category Management', route('admin.materialcategory.index'));
});
Breadcrumbs::for('admin.materialcategory.create', function ($trail) {
    $trail->push('Add Material Category', route('admin.materialcategory.create'));
}); 

// Work Category
Breadcrumbs::for('admin.workcategory.edit', function ($trail,$category_id) {
    $trail->push('Update Work Category', route('admin.workcategory.edit',$category_id));
});
Breadcrumbs::for('admin.workcategory.index', function ($trail) {
    $trail->push('Work Category Management', route('admin.workcategory.index'));
});
Breadcrumbs::for('admin.workcategory.create', function ($trail) {
    $trail->push('Add Work Category', route('admin.workcategory.create'));
});   

// Tender
Breadcrumbs::for('admin.tender.edit', function ($trail,$tender_id) {
    $trail->push('Update Tender', route('admin.tender.edit',$tender_id));
});
Breadcrumbs::for('admin.tender.index', function ($trail) {
    $trail->push('Tender Management', route('admin.tender.index'));
});
Breadcrumbs::for('admin.tender.create', function ($trail) {
    $trail->push('Add Tender', route('admin.tender.create'));
}); 
Breadcrumbs::for('admin.tender.work_offer', function ($trail) {
    $trail->push('Add Tender Work Offer', route('admin.tender.work_offer'));
}); 
Breadcrumbs::for('admin.tender.work_request', function ($trail) {
    $trail->push('Add Tender Work Request', route('admin.tender.work_request'));
});  
Breadcrumbs::for('admin.tender.material_offer', function ($trail) {
    $trail->push('Add Tender Material Offer', route('admin.tender.material_offer'));
}); 
Breadcrumbs::for('admin.tender.material_request', function ($trail) {
    $trail->push('Add Tender Material Request', route('admin.tender.material_request'));
});   

//Configurations
Breadcrumbs::for('admin.configuration.index', function ($trail) {
    $trail->push('Configurations', route('admin.configuration.index'));
});

//country
Breadcrumbs::for('admin.country.index', function ($trail) {
    $trail->push(__('labels.backend.country.title'), route('admin.country.index'));
});
Breadcrumbs::for('admin.country.edit', function ($trail,$country_id) {
    $trail->push(__('labels.backend.country.edit'), route('admin.country.edit',$country_id));
});
Breadcrumbs::for('admin.country.create', function ($trail) {
    $trail->push(__('labels.backend.country.create'), route('admin.country.create'));
});
Breadcrumbs::for('admin.country.create_country_language', function ($trail) {
    $trail->push(__('labels.backend.country.create'), route('admin.country.create_country_language'));
});

//States
Breadcrumbs::for('admin.state.index', function ($trail) {
    $trail->push(__('labels.backend.state.title'), route('admin.state.index'));
});
Breadcrumbs::for('admin.state.edit', function ($trail,$state_id) {
    $trail->push(__('labels.backend.state.edit'), route('admin.state.edit',$state_id));
});
Breadcrumbs::for('admin.state.create', function ($trail) {
    $trail->push(__('labels.backend.state.create'), route('admin.state.create'));
});
Breadcrumbs::for('admin.state.create_state_language', function ($trail) {
    $trail->push(__('labels.backend.state.create'), route('admin.state.create_state_language'));
});

//Cities
Breadcrumbs::for('admin.city.index', function ($trail) {
    $trail->push(__('labels.backend.city.title'), route('admin.city.index'));
});
Breadcrumbs::for('admin.city.edit', function ($trail,$city_id) {
    $trail->push(__('labels.backend.city.edit'), route('admin.city.edit',$city_id));
});
Breadcrumbs::for('admin.city.create', function ($trail) {
    $trail->push(__('labels.backend.city.create'), route('admin.city.create'));
});
Breadcrumbs::for('admin.city.create_city_language', function ($trail) {
    $trail->push(__('labels.backend.city.create'), route('admin.city.create_city_language'));
});

//workarea
Breadcrumbs::for('admin.workarea.index', function ($trail) {
    $trail->push(__('labels.backend.workarea.title'), route('admin.workarea.index'));
});
Breadcrumbs::for('admin.workarea.edit', function ($trail,$area_id) {
    $trail->push(__('labels.backend.workarea.edit'), route('admin.workarea.edit',$area_id));
});
Breadcrumbs::for('admin.workarea.create', function ($trail) {
    $trail->push(__('labels.backend.workarea.create'), route('admin.workarea.create'));
});
Breadcrumbs::for('admin.workarea.create_workarea_language', function ($trail) {
    $trail->push(__('labels.backend.workarea.create'), route('admin.workarea.create_workarea_language'));
});

//workphase
Breadcrumbs::for('admin.workphase.index', function ($trail) {
    $trail->push(__('labels.backend.workphase.title'), route('admin.workphase.index'));
});
Breadcrumbs::for('admin.workphase.edit', function ($trail,$aw_id) {
    $trail->push(__('labels.backend.workphase.edit'), route('admin.workphase.edit',$aw_id));
});
Breadcrumbs::for('admin.workphase.create', function ($trail) {
    $trail->push(__('labels.backend.workphase.create'), route('admin.workphase.create'));
});
Breadcrumbs::for('admin.workphase.create_workphase_language', function ($trail) {
    $trail->push(__('labels.backend.workphase.create'), route('admin.workphase.create_workphase_language'));
});