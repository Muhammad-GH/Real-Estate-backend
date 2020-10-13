@extends('pms.layout.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
    @if( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && ($user_permissions->edit_project || $user_permissions->view_project) ) )
    <div class="container-fluid">
        <h3 class="head3">{{ __('pms.project.project_details') }}</h3>
        <div class="card">
            <div class="card-body">
                <div class="projectpage">
                    <div class="project-details">
                        @if(isset($type) && ($type == 'view' ) )
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('pms.project.name') }} :</label>
                                        <strong>{{ $project->name }}</strong>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>{{ __('pms.project.key_name') }} :</label>
                                        <strong>{{ $project->key_name }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        @if( ( isset($type) && $type == 'edit') && ( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->edit_project)   ) )
                            <h6 class="head6">@lang('pms.project.text.edit_project')</h6>
                            {{ html()->modelForm( $project ,'POST', route('frontend.pms.project.update'))->id('fk-pro-update_project')->attribute('enctype', 'multipart/form-data')->open() }}
                                {{ html()->hidden('id') }}
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            {{ html()->label(__('pms.project.name'))->for('name') }}
                                            {{ html()->text('name')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.name'))->required() }}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-10">
                                        <div class="form-group">
                                            {{ html()->label(__('pms.project.key_name'))->for('key_name') }}
                                            {{ html()->text('key_name')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.key_name'))->required() }}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-10">
                                        {{ html()->label(__('pms.project.status'))->for('status') }}
                                        <select class="status form-control" placeholder="status" name="status" >
                                            <option value="default" >@lang('pms.project.text.please_select')</option>
                                            <option value="active" @if($project->status && $project->status == 'active')selected="selected"@endif >@lang('pms.project.labels.status.active')</option>
                                            <option value="done" @if($project->status && $project->status == 'done')selected="selected"@endif >@lang('pms.project.labels.status.done')</option>
                                        </select>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                    
                                    {{ form_submit(__('pms.project.labels.save'))->id('submit_btn')->class('btn btn-primary mb-sm-0 mb-3') }}
                                    </div>
                                </div>
                            {{ html()->form()->close() }}
                        @endif

                        @if( ( isset($type) && $type == 'edit') && ( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->edit_subtask)   ) )
                            <h6 class="head6">@lang('pms.project.text.add_tasks')</h6>
                            {{ html()->form('POST', route('frontend.pms.project.add_edit_task'))->id('fk-pro-add_task')->open() }} 
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('pms.project.select_area') }}</label>
                                            <select class="form-control" name='area' >
                                                <option value="" >@lang('pms.project.text.please_select')</option>
                                                @foreach($area as $ara)
                                                    <option value="{{ $ara->area_id }}" >{{ $ara->area_identifier }}</option>
                                                @endforeach
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-10">
                                        <div class="form-group">
                                            <label>@lang('pms.project.text.add_work_phase')</label>
                                            <div class="flex-group">
                                                <select class="form-control" name='area_work'  >
                                                    <option value="" >@lang('pms.project.text.please_select')</option>
                                                    @foreach($area as $ara)
                                                        @if(count($ara->areawork))
                                                            @foreach($ara->areawork as $work)
                                                                <option data-parent="{{ $ara->area_id }}"  value="{{ $work->aw_id }}" style="display:none;" >{{ $work->aw_identifier }}</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <button class="btn btn-primary">@lang('pms.project.text.add')</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-2 col-md-1 col-sm-2">
                                        <div class="form-group text-right">
                                            <label class="d-xl-none">&nbsp;</label>
                                            <div class="dropdown mt-2">
                                                <a class="btn btn-gray btn-icon dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            {{ html()->form()->close() }}
                        @endif
                        <div class="mt-4"></div>
                        
                        <h6 class="head6">@lang('pms.project.text.new_tasks')</h6>
                        <div class="openTask" ></div>

                        <div class="mt-4"></div>

                        <h6 class="head6">@lang('pms.project.text.backlog')</h6>
                        <div class="backlogTask" ></div>
                        
                    </div>
                    <div class="project-rightbar" style=" display:none; max-width: 360px;" >
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@push('after-styles')
    {{ style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css') }}
    {{ style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css') }}
    {{ style('https://netdna.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css') }}
    {{ style('https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css') }}
    {{ style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css') }}

    
    <style>
        .bootstrap-tagsinput .tag {
            background-color: #0790c9;
        }
        .bootstrap-tagsinput{
            width: 100%;
        }
        .timeDataContent{
            overflow-y:auto;
        }
        .timeDataContent th, .timeDataContent td{
            padding:5px;
        }
        .timeDataContent td:nth-child(0),
        .timeDataContent td:nth-child(1),
        .timeDataContent td:nth-child(2) {
            min-width: 100px;
        }
        .padding50{
            padding-left:50px !important;
        }

    </style>

    
@endpush

@push('after-scripts')

{!! script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js') !!}
{!! script('https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js') !!}
{!! script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js') !!}


<script>

function getTask(){
    showLoader();
    $.ajax({
        type:'GET',
        url: "{{ route('frontend.pms.project.get_task',['project_id'=> $project->id, 'project_type'=> 'open', 'type' => $type ]) }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(result){
            hideLoader();
            $(document).find('.openTask').html(result);
        }
    });
}

function getBacklogTask(){
    showLoader();
    $.ajax({
        type:'GET',
        url: "{{ route('frontend.pms.project.get_task',['project_id'=> $project->id, 'project_type'=> 'backlog', 'type' => $type]) }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(result){
            hideLoader();
            $(document).find('.backlogTask').html(result);
        }
    });
}

function viewTask(task_id){
    showLoader();
    $.ajax({
        type:'GET',
        url: "{{ route('frontend.pms.project.view_task') }}"+"/?project_id="+{{ $project->id }}+'&task_id='+task_id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(result){
            hideLoader();
            $(document).find('.project-rightbar').show().html(result);
        }
    });
}

function editTask(task_id){
    showLoader();
    $.ajax({
        type:'GET',
        url: "{{ route('frontend.pms.project.edit_task') }}"+"/?project_id="+{{ $project->id }}+'&task_id='+task_id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(result){
            hideLoader();
            $(document).find('.project-rightbar').show().html(result);
            $("[name=labels]").tagsinput();
            $(document).find( "[name=start_date], [name=end_date] , [name=deadline]" ).datepicker({
                dateFormat: "dd-mm-yy",
                minDate: -1
            });
            
            $(document).find('[name=assignee_to_selection]').multiselect({
                nonSelectedText:"@lang('pms.project.text.please_select')",
                onChange: function(option, checked, select) {
                    // console.log('--', $(document).find('[name=assignee_to_selection]').val());
                    var selectedOptions = $(document).find('[name=assignee_to_selection]').val().join(",");
                    $(document).find('[name=assignee_to]').val(selectedOptions);
                }
            });
            $(document).find('.checkpoint-multiselect').multiselect({
                nonSelectedText:"@lang('pms.project.text.please_select')",
                onChange: function(option, checked, select) {
                    var selectedOption = $(document).find('.checkpoint-multiselect').val().join(",");
                    $(document).find('[name=checkpoint]').val(selectedOption);
                }
            });
            $(document).find('.fk-pro-update_task').validate({
                rules: {
                    task_name: { required: true} ,
                    description: { required: true} ,
                    assignee_to: { required: true} ,
                    report_to: { required: true} ,
                    start_date: { required: function(element){
                        return $("[name=end_date]").val()!="";
                    } },
                    end_date: {  greaterThan: "[name=start_date]" }
                },
                messages: {
                    task_name: { required: "@lang('pms.validaion.required.name')" },
                    description: { required: "@lang('pms.validaion.required.name')"},
                    assignee_to: { required: "@lang('pms.validaion.required.name')"},
                    report_to: { required: "@lang('pms.validaion.required.name')"},
                    start_date: { required: "@lang('pms.validaion.required.name')"},
                    end_date: { required: true , greaterThan : "@lang('pms.validaion.invalid.end_date')" }
                },
                submitHandler: function (form) {
                    var data = $(document).find('.fk-pro-update_task').serialize();
                    var urlUpdate =  $(document).find('.fk-pro-update_task').attr('action');
                    
                    var updateTask = $(document).find('.fk-pro-update_task');
                    var formData = new FormData();
                    var attachment = updateTask.find('[name=attachment]')[0].files[0];
                    // var signature = updateTask.find('[name=signature]')[0].files[0];
                    // var image = updateTask.find('[name=image]')[0].files[0];
                    // var report = updateTask.find('[name=report]')[0].files[0];
                    // var audits = updateTask.find('[name=audits]')[0].files[0];
                    formData.append('attachment',attachment);
                    // formData.append('signature',signature);
                    // formData.append('image',image);
                    // formData.append('report',report);
                    // formData.append('audits',audits);
                    formData.append('data',data);
                    
                    $.ajax({
                        type:'POST',
                        url: urlUpdate,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        contentType: false,
                        processData: false,
                        success:function(result){
                            if(result.status){
                                getTask();
                                getBacklogTask();
                                $(document).find('.project-rightbar').show().html('');
                                Swal.fire({
                                    "title":"@lang('pms.project.messages.success')",
                                    "html":"@lang('pms.project.messages.success_task_update')",
                                    "type":"success",
                                    "showConfirmButton":true,
                                    "showCloseButton":true,
                                    "allowEscapeKey":true,
                                    "allowOutsideClick":true
                                });

                            }  
                        }
                    });
                }
            });
        }
    });    
}

function addTimeTask(task_id){
    showLoader();
    $.ajax({
        type:'GET',
        url: "{{ route('frontend.pms.project.add_task_time') }}"+"/?project_id="+{{ $project->id }}+'&task_id='+task_id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(result){
            hideLoader();
            $(document).find('.project-rightbar').show().html(result);
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            $(document).find( "[name=date]" ).datepicker({
                dateFormat: "dd-mm-yy",
                defaultDate: date.getDate()+'-'+date.getMonth()+'-'+date.getFullYear(),
                minDate: -1
            });
            
            $(document).find('.fk-pro-add_task_time').validate({
                rules: {
                    description: { required: true} ,
                    signature: { required: true} ,
                    image: { required: true} ,
                    report: { required: true} ,
                    audits: { required: true} ,
                    hours: { required: true} ,
                    date: { required: true }
                },
                messages: {
                    description: { required: "@lang('pms.validaion.required.name')"},
                    signature: { required: "@lang('pms.validaion.required.name')"},
                    image: { required: "@lang('pms.validaion.required.name')"},
                    report: { required: "@lang('pms.validaion.required.name')"},
                    audits: { required: "@lang('pms.validaion.required.name')"},
                    hours: { required: "@lang('pms.validaion.required.name')"},
                    date: { required: "@lang('pms.validaion.required.name')"}
                },
                submitHandler: function (form) {
                    var taskTime = $(document).find('.fk-pro-add_task_time');
                    var urlUpdate =  $(document).find('.fk-pro-add_task_time').attr('action');
                    
                    var formData = new FormData();
                    if($(document).find('.fk-pro-add_task_time').find('[name=signature]').length){
                        var signatureD = $(document).find('.fk-pro-add_task_time').find('[name=signature]')[0].files[0];
                        formData.append('signature',signatureD);
                    }
                    if($(document).find('.fk-pro-add_task_time').find('[name=image]').length){
                        var imageD = $(document).find('.fk-pro-add_task_time').find('[name=image]')[0].files[0];
                        formData.append('image',imageD);
                    }
                    if($(document).find('.fk-pro-add_task_time').find('[name=report]').length){
                        var reportD = $(document).find('.fk-pro-add_task_time').find('[name=report]')[0].files[0];
                        formData.append('report',reportD);
                    }
                    if($(document).find('.fk-pro-add_task_time').find('[name=audits]').length){
                        var auditsD = $(document).find('.fk-pro-add_task_time').find('[name=audits]')[0].files[0];
                        formData.append('audits',auditsD);
                    }
                    formData.append('project_id',taskTime.find('[name=project_id]').val());
                    formData.append('project_task_id',taskTime.find('[name=project_task_id]').val());
                    formData.append('description',taskTime.find('[name=description]').val());
                    formData.append('hours',taskTime.find('[name=hours]').val());
                    formData.append('date',taskTime.find('[name=date]').val());
                    showLoader();
                    $.ajax({
                        type:'POST',
                        url: urlUpdate,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        contentType: false,
                        processData: false,
                        success:function(result){
                            hideLoader();
                            if(result.status){
                                $(document).find('.project-rightbar').show().html('');
                                Swal.fire({
                                    "title":"@lang('pms.project.messages.success')",
                                    "html":"@lang('pms.project.messages.success_time_task_added')",
                                    "type":"success",
                                    "showConfirmButton":true,
                                    "showCloseButton":true,
                                    "allowEscapeKey":true,
                                    "allowOutsideClick":true
                                });

                            }  
                        }
                    });
                }
            });
        }
    });    
}

$(document).ready(function(){

    $.validator.addMethod("greaterThan", 
        function(value, element, params) {
            if(value == '')
                return true;
            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) > new Date($(params).val());
            }

            return isNaN(valuejoin) && isNaN($(params).val()) 
                || (Number(value) > Number($(params).val())); 
        },'Must be greater than {0}.');
    
        

    $(document).on('click', '.createTask', function(){
        showLoader();
        $.ajax({
            type:'GET',
            url: "{{ route('frontend.pms.project.create_task',['project_id'=>$project->id]) }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(result){
                hideLoader();
                $(document).find('.project-rightbar').show().html(result);
                $("[name=labels]").tagsinput();
                $(document).find( "[name=start_date], [name=end_date] , [name=deadline]" ).datepicker({
                    dateFormat: "dd-mm-yy",
                    minDate: -1
                });
                $(document).find('[name=assignee_to_selection]').multiselect({
                    nonSelectedText:"@lang('pms.project.text.please_select')",
                    onChange: function(option, checked, select) {
                        console.log('--', $(document).find('[name=assignee_to_selection]').val());
                        var selectedOptions = $(document).find('[name=assignee_to_selection]').val().join(",");
                        $(document).find('[name=assignee_to]').val(selectedOptions);
                    }
                });
                $(document).find('.checkpoint-multiselect').multiselect({
                    nonSelectedText:"@lang('pms.project.text.please_select')",
                    onChange: function(option, checked, select) {
                        // console.log('--', option, option[0].value, checked, select);
                        var selectedOption = $(document).find('.checkpoint-multiselect').val().join(",");
                        $(document).find('[name=checkpoint]').val(selectedOption);
                    }
                });
                
                $(document).find('.fk-pro-update_task').validate({
                    rules: {
                        task_name: { required: true} ,
                        description: { required: true} ,
                        assignee_to: { required: true} ,
                        report_to: { required: true} ,
                        start_date: { required: function(element){
                            return $("[name=end_date]").val()!="";
                        } },
                        end_date: {  greaterThan: "[name=start_date]" }
                    },
                    messages: {
                        task_name: { required: "@lang('pms.validaion.required.name')" },
                        description: { required: "@lang('pms.validaion.required.name')"},
                        assignee_to: { required: "@lang('pms.validaion.required.name')"},
                        report_to: { required: "@lang('pms.validaion.required.name')"},
                        start_date: { required: "@lang('pms.validaion.required.name')"},
                        end_date: { required: true , greaterThan : "@lang('pms.validaion.invalid.end_date')" }
                    },
                    submitHandler: function (form) {
                        var data = $(document).find('.fk-pro-update_task').serialize();
                        var urlUpdate =  $(document).find('.fk-pro-update_task').attr('action');
                        
                        var updateTask = $(document).find('.fk-pro-update_task');
                        var formData = new FormData();
                        var attachment = updateTask.find('[name=attachment]')[0].files[0];
                        // var signature = updateTask.find('[name=signature]')[0].files[0];
                        // var image = updateTask.find('[name=image]')[0].files[0];
                        // var report = updateTask.find('[name=report]')[0].files[0];
                        // var audits = updateTask.find('[name=audits]')[0].files[0];
                        formData.append('attachment',attachment);
                        // formData.append('signature',signature);
                        // formData.append('image',image);
                        // formData.append('report',report);
                        // formData.append('audits',audits);
                        formData.append('data',data);
                        showLoader();
                        $.ajax({
                            type:'POST',
                            url: urlUpdate,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: formData,
                            contentType: false,
                            processData: false,
                            success:function(result){
                                hideLoader();
                                if(result.status){
                                    getTask();
                                    getBacklogTask();
                                    $(document).find('.project-rightbar').show().html('');
                                    Swal.fire({
                                        "title":"@lang('pms.project.messages.success')",
                                        "html":"@lang('pms.project.messages.success_task_update')",
                                        "type":"success",
                                        "showConfirmButton":true,
                                        "showCloseButton":true,
                                        "allowEscapeKey":true,
                                        "allowOutsideClick":true
                                    });

                                }  
                            }
                        });

                    }
                });
            }
        });
    });

    $(document).on('click', '.cancel_button', function(e){
        e.preventDefault();
        $(document).find('.project-rightbar').show().html('');
    });
    

    $(document).on('change', '[name=area]', function(){
        var selectedVal = $(this).val();
        $(document).find('[name=area_work] option').hide()
        if($(this).val() == ''){
            $(document).find('[name=area_work] option[value=""]').show()
        }else{
            $(document).find('[name=area_work] option[data-parent='+selectedVal+']').show()
            $(document).find('[name=area_work] option[value=""]').show()
        }
        $(document).find('[name=area_work]').val('');
    });

    $('#fk-pro-add_task').validate({
        rules: {
            area: { required: true} ,
            area_work: { required: true }
        },
        messages: {
            area: { required: "@lang('pms.validaion.required.name')" },
            area_work: { required: "@lang('pms.validaion.required.name')"}
        },
        submitHandler: function (form) {

            var area = $('#fk-pro-add_task').find("[name=area]").val();
            var area_work = $('#fk-pro-add_task').find("[name=area_work]").val();
            var area_work_name =  $('#fk-pro-add_task').find("[name=area_work]").find("option:selected").text();
            var area_name =  $('#fk-pro-add_task').find("[name=area]").find("option:selected").text();
            var url = $('#fk-pro-add_task').attr('action');
            showLoader();
            $.ajax({
               type:'POST',
               url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
               data: { project_id : {{ $project->id }}, area:area, area_work: area_work, area_work_name: area_work_name , area_name: area_name },
               success:function(result){
                    hideLoader();
                    if(result.status){
                        $('#fk-pro-add_task').find("[name=area]").val('');
                        $('#fk-pro-add_task').find("[name=area_work]").val('');
                        getTask(); 
                        editTask(result.data.id);  
                        getBacklogTask();
                    }  
                    
               }
            });
            // return false; // required to block normal submit since you used ajax
        }
    });

    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg !== value;
    }, "@lang('pms.project.text.please_select')" );

    $('#fk-pro-update_project').validate({
        rules: {
            name: { required: true, minlength: 5},
            key_name: { required: true, minlength: 5},
            status: { valueNotEquals: "default"  }
        },
        messages: {
            name: { required: "@lang('pms.validaion.required.name')",  minlength : "@lang('pms.validaion.invalid.min_length',['min_len'=>5])" },
            key_name: { required: "@lang('pms.validaion.required.name')",  minlength : "@lang('pms.validaion.invalid.min_length',['min_len'=>5])" },
            status : { valueNotEquals: "@lang('pms.project.text.please_select')" }
        }
    });

    $(document).on('click', '.editTask', function(){
        var id = $(this).attr('data-id');
        editTask(id);
    });

    $(document).on('click', '.addTimeTask', function(){
        var id = $(this).attr('data-id');
        addTimeTask(id);
    });

    $(document).on('click', '.viewTask', function(){
        var id = $(this).attr('data-id');
        viewTask(id);
    });

    $(document).on('click', '.deleteTask', function(){
        var id = $(this).attr('data-id');
        showLoader();
        $.ajax({
            type:'POST',
            url: "{{ route('frontend.pms.project.delete_task') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { task_id : id },
            success:function(result){
                hideLoader();
                if(result.status){
                    getTask(); 
                    getBacklogTask();
                }  
                
            }
        });
    });

    $(document).on('click', '.edittaskname', function(){
        $(document).find('.editTaskName').show();
        $(document).find('.showTaskName').hide();
    })


    getTask();
    getBacklogTask();
    
});
</script>
@endpush