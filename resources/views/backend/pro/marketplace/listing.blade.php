@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.tender.management'))

@section('breadcrumb-links')
    @include('backend.marketplace.material.offer-breadcrumb-links')
@endsection

@section('content') 

<div class="card">
    <div class="card-body">
     

       <form class="form-inline  " name="search_form" method="POST">
       <div class="form-group ">
       
       <div class="col-md-10">
        <input class="form-control form-control-navbar" type="input" id="serach"  placeholder=" {{ __('labels.backend.tender.search') }}" aria-label="Search">
        
      </div>
      </div>
      <div class="form-group ">
      
      <div class="col-md-10">
       
 
      {{  html()->select('tender_category_type', [
                                            '' => 'Select',
                                            'Work' => 'Work',
                                            'Material' => 'Material' 
                                        ] )
                                        ->class('form-control')
                                        ->id('tender_category_type')
                                        ->value(   )
                                         
                                         }}
    
             
      </div>
      </div>
      
      <div class="form-group ">
      
      <div class="col-md-10">
       
 
      
    
      {{  html()->select('tender_type', [
                                            '' => 'Select',
                                            'Offer' => 'Offer',
                                            'Request' => 'Request' 
                                        ] )
                                        ->class('form-control')
                                        ->id('tender_type')
                                        ->value(   )
                                         
                                         }}
      </div>
      </div>

      <div class="form-group ">
      <!-- <button class="btn btn-success btn-sm  " type="submit">Search</button> -->
        
      </div>
    </form>
    </div><!--card-body-->
</div>


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                {{ __('labels.backend.tender.management') }} 
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.pro.marketplace.includes.action-header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.tender.table.title')</th>
                            
                            <th>@lang('labels.backend.tender.table.type')</th>
                            
                            <th>@lang('labels.backend.tender.table.category')</th>
                             
                      
                            <th>@lang('labels.backend.tender.table.tender_expire')</th>
                            <th>@lang('labels.backend.tender.table.created')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('backend.pro.marketplace.listing_data')
                        
                        </tbody>
                    </table>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="tender_id" />
                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                
                </div>
            </div><!--col-->
        </div><!--row-->
        {{--<div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $tender->total() !!} {{ trans_choice('total|total', $tender->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $tender->render() !!}
                </div>
            </div><!--col-->
        </div><!--row--> --}}
    </div><!--card-body-->
</div><!--card--> 
@endsection
@push('scripts')
<script>
$(document).ready(function(){

    $(document).on('change', '#state_id', function(){
    var state_id = $('#state_id').val();
    window.location = "{{ route('admin.city.index') }}?state_id="+$(this).val();
   
 
 });


 function clear_icon()
 {
  $('#id_icon').html('');
  $('#post_title_icon').html('');
 }

 function fetch_data(page, sort_type, sort_by,tender_type,tender_category_type, query)
 {
    $('tbody').html('<div class="loader">Loading...</div>');   
  $.ajax({
   url:"{{ route('admin.tender.fetch_data') }}?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&tender_type="+tender_type+"&tender_category_type="+tender_category_type+"&query="+query,
   success:function(data)
   {
    $('tbody').html('');
    $('tbody').html(data);
   }
  })
 }
 var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = $('#hidden_page').val();
  var tender_type = $('#tender_type').val();
  var tender_category_type = $('#tender_category_type').val();
   
  fetch_data(page, sort_type, column_name,tender_type,tender_category_type, query);
  $(document).on('keyup', '#serach', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = $('#hidden_page').val();
  var tender_type = $('#tender_type').val();
  var tender_category_type = $('#tender_category_type').val();
   
  fetch_data(page, sort_type, column_name,tender_type,tender_category_type, query);
 });

 $(document).on('change', '#tender_category_type', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = $('#hidden_page').val();
  var tender_type = $('#tender_type').val();
  var tender_category_type = $('#tender_category_type').val();
   
  fetch_data(page, sort_type, column_name,tender_type,tender_category_type, query);
 });

 $(document).on('change', '#tender_type', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = $('#hidden_page').val();
  var tender_type = $('#tender_type').val();
  var tender_category_type = $('#tender_category_type').val();
   
  fetch_data(page, sort_type, column_name,tender_type,tender_category_type, query);
 });

 $(document).on('click', '.sorting', function(){
  var column_name = $(this).data('column_name');
  var order_type = $(this).data('sorting_type');
  var reverse_order = '';
  if(order_type == 'asc')
  {
   $(this).data('sorting_type', 'desc');
   reverse_order = 'desc';
   clear_icon();
   $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-bottom"></span>');
  }
  if(order_type == 'desc')
  {
   $(this).data('sorting_type', 'asc');
   reverse_order = 'asc';
   clear_icon
   $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-top"></span>');
  }
  $('#hidden_column_name').val(column_name);
  $('#hidden_sort_type').val(reverse_order);
  var page = $('#hidden_page').val();
  var query = $('#serach').val();

  var tender_type = $('#tender_type').val();
  var tender_category_type = $('#tender_category_type').val();
  fetch_data(page, reverse_order, column_name,tender_type,tender_category_type,query);
 });

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  $('#hidden_page').val(page);
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();

  var query = $('#serach').val();

 
  var tender_type = $('#tender_type').val();
  var tender_category_type = $('#tender_category_type').val();
  $('li').removeClass('active');
        $(this).parent().addClass('active');
  fetch_data(page, sort_type, column_name,tender_type,tender_category_type, query);
 });
 

});
 

</script>
@endpush
