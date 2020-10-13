@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.configuration.management'))



@section('content')

{{ html()->form('POST', route('admin.configuration.store'))->class('form-horizontal')->open() }}
<!-- <form method="post" action="{{ route('admin.configuration.store') }}" class="form-horizontal" role="form"> -->
   
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.configuration.management')
                            
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                    <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        
                
                
                       {{-- @if(count(config('global_configurations', [])) )  

                                @foreach(config('global_configurations.admin') as $section => $fields)  
                             
                            
                                 
                                    <div class="form-group row">
                                    
                                        {{ html()->label(__($section))->class('col-md-2 form-control-label')->for($section) }} 
                                        <div class="col-md-10">
                                            {{ html()->text($section)
                                                ->class('form-control')
                                                ->placeholder(__('labels.backend.configuration.table.name'))
                                                ->attribute('maxlength', 191)
                                                ->value(  $fields  )
                                                ->required() }}
                                        
                                        </div><!--col-->
                                    </div><!--form-group-->  
                                
                                
                               @endforeach  
                         @endif --}}


                         <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.configuration.table.admin_email'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.admin_email') }} 
                                    <div class="col-md-10">
                                        {{ html()->text('admin_email')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.configuration.table.admin_email'))
                                            ->attribute('maxlength', 191)
                                            ->value(  $configuration['admin_email'] ?? ''   )
                                            ->required() }}
                                    
                                    </div><!--col-->
                                </div><!--form-group--> 
                                <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.configuration.table.pagination'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.pagination') }} 
                                    <div class="col-md-10">
                                        {{ html()->text('pagination')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.configuration.table.pagination'))
                                            ->attribute('maxlength', 191)
                                            ->value(  $configuration['pagination'] ?? ''   )
                                            ->required() }}
                                    
                                    </div><!--col-->
                                </div><!--form-group--> 
                                <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.configuration.table.language'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('language', array('fi'=>'Finnish','en'=>'English'))
                                        ->class('form-control')
                                        ->id('language')
                                        ->value(  $configuration['language'] ?? ''   )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group-->
                                <div class="form-group row">
                                    {{ html()->label(__('labels.backend.configuration.table.language_pro'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.language_pro') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('language_pro', array('fi'=>'Finnish','en'=>'English'))
                                        ->class('form-control')
                                        ->id('language_pro')
                                        ->value( $configuration['language_pro'] ?? ''   )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group--> 
                                <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.configuration.table.language_consumer'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.language_consumer') }} 
                                    {{-- Note* Consumers languages manage from the language table with status 1 --}}
                                    <div class="col-md-10">
                                        {{  html()->select('language_consumer', array('fi'=>'Finnish','en'=>'English'))
                                        ->class('form-control')
                                        ->id('language_consumer')
                                        ->value( $configuration['language_consumer'] ?? ''    )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group--> 
                                <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.configuration.table.date_format'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.date_format') }} 
                                    <div class="col-md-10">
                                    {{  html()->select('date_format', array('D-M-Y'=>'D-M-Y','d-m-Y'=>'d-m-Y','M d, Y'=>'M d, Y'))
                                        ->class('form-control')
                                        ->id('date_format')
                                        ->value(  $configuration['date_format'] ?? ''   )
                                        ->required()
                                         }}

                                    
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group-->  
                                <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.configuration.table.time_format'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.time_format') }} 
                                    <div class="col-md-10">
                                    {{  html()->select('time_format', array('H:m:s'=>'H:m:s','H:i:s'=>'H:i:s','H:i'=>'H:i'))
                                        ->class('form-control')
                                        ->id('time_format')
                                        ->value(  $configuration['time_format'] ?? ''   )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group-->
                                 
                                <div class="form-group row"> 
                                    
                                    {{ html()->label(__('labels.backend.configuration.table.datepicker_date_format'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.datepicker_date_format') }} 
                                    <div class="col-md-10">
                                    {{  html()->select('datepicker_date_format', array('D-M-Y'=>'D-M-Y','d-m-Y'=>'d-m-Y','M d, Y'=>'M d, Y'))
                                        ->class('form-control')
                                        ->id('datepicker_date_format')
                                        ->value(  $configuration['datepicker_date_format'] ?? ''   )
                                        ->required()
                                         }}

                                    
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group-->  
                                <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.configuration.table.datepicker_time_format'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.datepicker_time_format') }} 
                                    <div class="col-md-10">
                                    {{  html()->select('datepicker_time_format', array('H:m:s'=>'H:m:s','H:i:s'=>'H:i:s','H:i'=>'H:i'))
                                        ->class('form-control')
                                        ->id('datepicker_time_format')
                                        ->value(  $configuration['datepicker_time_format'] ?? ''   )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group-->  
                                <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.configuration.table.default_country'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.default_country') }} 
                                    <div class="col-md-10">
                                    {{  html()->select('default_country', $country)
                                        ->class('form-control')
                                        ->id('default_country')
                                        ->value(  $configuration['default_country'] ?? ''   )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group--> 
                                 
                                
                                 <div class="form-group row">
                                     
                                     {{ html()->label(__('labels.backend.configuration.table.site_mode'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.site_mode') }} 
                                     <div class="col-md-10">
                                     {{  html()->select('site_mode', array('Live','Development'))
                                         ->class('form-control')
                                         ->id('site_mode')
                                         ->value( $configuration['site_mode'] ?? '' )
                                         ->required()
                                          }}
                                 
                                  
                                     
                                     </div><!--col-->
                                 </div><!--form-group--> 
                                 
                                 
                                
                                 <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.configuration.table.site_mode_consumer'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.site_mode_consumer') }} 
                                    <div class="col-md-10">
                                    {{  html()->select('site_mode_consumer', array('Live','Development'))
                                        ->class('form-control')
                                        ->id('site_mode_consumer')
                                        ->value( $configuration['site_mode_consumer'] ?? '' )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group-->  
                                
                                <div class="form-group row">
                                   
                                   {{ html()->label(__('labels.backend.configuration.table.site_save_mailerlight'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.site_save_mailerlight') }} 
                                   <div class="col-md-10">
                                   {{  html()->select('site_save_mailerlight', array('Yes'=>'Yes','No'=>'No'))
                                       ->class('form-control')
                                       ->id('site_save_mailerlight')
                                       ->value( $configuration['site_save_mailerlight'] ?? '' )
                                       ->required()
                                        }}
                               
                                
                                   
                                   </div><!--col-->
                               </div><!--form-group-->  
                                
                               <div class="form-group row">
                                   
                                   {{ html()->label(__('labels.backend.configuration.table.site_service_fee'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.site_service_fee') }} 
                                   <div class="col-md-10">
                                   {{ html()->text('site_service_fee')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.configuration.table.site_service_fee'))
                                            ->attribute('maxlength', 2)
                                            ->value(  $configuration['site_service_fee'] ?? ''   )
                                            ->required() }}
                               
                                
                                   
                                   </div><!--col-->
                               </div><!--form-group-->  
                                <div class="form-group row">
                                   
                                   {{ html()->label(__('labels.backend.configuration.table.left_currency_symbol'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.left_currecy_symbol') }} 
                                   <div class="col-md-10">
                                   {{ html()->text('left_currency_symbol')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.configuration.table.left_currency_symbol'))
                                            ->attribute('maxlength', 1)
                                            ->value(  $configuration['left_currency_symbol'] ?? ''   )
                                              }}
                               
                                
                                   
                                   </div><!--col-->
                               </div><!--form-group-->  
                                <div class="form-group row">
                                   
                                   {{ html()->label(__('labels.backend.configuration.table.right_currency_symbol'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.right_currency_symbol') }} 
                                   <div class="col-md-10">
                                   {{ html()->text('right_currency_symbol')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.configuration.table.right_currency_symbol'))
                                            ->attribute('maxlength', 1)
                                            ->value(  $configuration['right_currency_symbol'] ?? ''   )
                                             }}
                               
                                
                                   
                                   </div><!--col-->
                               </div><!--form-group--> 
                                
                                <div class="form-group row">
                                   
                                   {{ html()->label(__('labels.backend.configuration.table.pro_site_url'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.pro_site_url') }} 
                                   <div class="col-md-10">
                                   {{ html()->text('pro_site_url')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.configuration.table.pro_site_url'))
                                             
                                            ->value(  $configuration['pro_site_url'] ?? ''   )
                                             }}
                               
                                
                                   
                                   </div><!--col-->
                               </div><!--form-group--> 

                                
                                <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.configuration.table.header_tag'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.header_tag') }} 
                                    <div class="col-md-10">
                                    {{ html()->textarea('header_tag')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.configuration.table.header_tag'))
                                            ->attribute('maxlength', 5000)
                                            ->value(  $configuration['header_tag'] ?? ''   )
                                              }}
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.configuration.table.body_tag'))->class('col-md-2 form-control-label')->for('labels.backend.configuration.table.body_tag') }} 
                                    <div class="col-md-10">
                                    {{ html()->textarea('body_tag')
                                            ->class('form-control')
                                            ->placeholder(__('labels.backend.configuration.table.body_tag'))
                                            ->attribute('maxlength', 5000)
                                            ->value(  $configuration['body_tag'] ?? ''   )
                                              }}
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group--> 
                

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->                               
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.configuration.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--row-->
                </div><!--row-->
            </div><!--card-footer-->
        </div>
        {{ html()->form()->close() }}

 
@endsection


 