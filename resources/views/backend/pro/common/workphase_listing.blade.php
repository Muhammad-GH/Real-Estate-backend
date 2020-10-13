@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.workphase.management'))

@section('breadcrumb-links')
    @include('backend.pro.common.includes.workarea-breadcrumb-links')
@endsection

@section('content')

<div class="card">
    <div class="card-body">
     

       <form class="form-inline  " name="search_form" method="POST">
       <div class="form-group ">
       
       <div class="col-md-10">
        <input class="form-control form-control-navbar" type="input" id="serach"  placeholder=" {{ __('labels.backend.workphase.search') }}" aria-label="Search">
        
      </div>
      </div>
      <div class="form-group ">
      
      <div class="col-md-10">
      {{  html()->select('area_id', [null=> __('labels.backend.workarea.search') ] + $workareadropdown)
                                        ->class('form-control')
                                        ->id('area_id')
                                        ->value( $workarea ?? ''   )
                                         
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
                {{ __('labels.backend.workphase.management') }} 
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.pro.common.includes.workphase-action-header-buttons') 
            </div><!--col-->
        </div><!--row-->
         
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.workphase.table.name')</th>
                            
                            <th>@lang('labels.backend.workphase.table.code')</th>
                            
                            <th>@lang('labels.backend.workphase.table.language')</th>
                            
                             
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('backend.pro.common.workphase_listing_data')
                        </tbody>
                    </table>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="aw_identifier" />
                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                    <input type="hidden" name="hidden_language" id="hidden_language" value="{{ $language}}" />
                    <input type="hidden" name="area_id" id="area_id" value="{{ $workarea}}" />
                </div>
            </div><!--col-->
        </div><!--row-->
        {{-- <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $workphase->total() !!} {{ trans_choice('total|total', $workphase->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                {!! $workphase->links() !!}
                </div>
            </div><!--col-->
        </div><!--row--> --}}
    </div><!--card-body-->
</div><!--card--> 


@endsection
@push('scripts')
<script>
$(document).ready(function(){

    $(document).on('change', '#area_id', function(){
    var area_id = $('#area_id').val();
    window.location = "{{ route('admin.workphase.index') }}?area_id="+$(this).val();
   
 
 });


 function clear_icon()
 {
  $('#id_icon').html('');
  $('#post_title_icon').html('');
 }

 function fetch_data(page, sort_type, sort_by,language,area_id, query)
 {
    $('tbody').html('<div class="loader">Loading...</div>');   
  $.ajax({
   url:"{{ route('admin.workphase.fetch_data') }}?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&language="+language+"&area_id="+area_id+"&query="+query,
   success:function(data)
   {
    $('tbody').html('');
    $('tbody').html(data);
   }
  })
 }

 $(document).on('keyup', '#serach', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = $('#hidden_page').val();
  var language = $('#hidden_language').val();
  var area_id = $('#area_id').val();
  fetch_data(page, sort_type, column_name,language,area_id, query);
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
  var language = $('#hidden_language').val();
  
  var area_id = $('#area_id').val();
  fetch_data(page, reverse_order, column_name,language, area_id,query);
 });

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  $('#hidden_page').val(page);
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();

  var query = $('#serach').val();

  var language = $('#hidden_language').val();
  
  var area_id = $('#area_id').val();
  $('li').removeClass('active');
        $(this).parent().addClass('active');
  fetch_data(page, sort_type, column_name,language,area_id, query);
 });

// language base
 $(document).on('click', '.language_button a', function(event){
  event.preventDefault();
  
  var language = $(this).attr('href').split('language=')[1];
  var area_id = $(this).attr('href').split('area_id=')[1];
  $('#hidden_language').val(language);
  $('#area_id').val(area_id);
  var page = 1;
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var query = $('#serach').val('');
  var query = $('#serach').val();
  var language = $('#hidden_language').val();
  //var area_id = $('#area_id').val();
   
  $('li').removeClass('active');
        $(this).parent().addClass('active');
  fetch_data(page, sort_type, column_name,language,area_id, query);
 });

});
</script>
@endpush