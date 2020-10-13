@extends('pms.layout.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
    @if( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->planning_project ) )
    <div class="container-fluid">
                <h3 class="head3">@lang('pms.project.text.project_planning')</h3>
                <div class="card" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12">
                            {{ html()->form('POST', route('frontend.pms.project.add_edit_task'))->id('fk-pro-add_task')->open() }} 
                            {{ html()->hidden('project_id')->value($project->id) }}
                            {{ html()->hidden('area_work_name') }}
    
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
                            </div>
                            
                            {{ html()->form()->close() }}
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-10">
                                <a href="javascript:void(0);" class="createTask" >{{ __('pms.project.create_newtask') }}</a>
                                <button class="btn btn-danger deleteTemplate" style="display:none;" >@lang('pms.project.text.delete_template')</button>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-10 templatesDiv">
                            </div>
                        </div>
                    <div class="mt-4"></div>
                    <h6 class="head6">@lang('pms.project.text.task_list')</h6>
                    {{ html()->form( 'POST', route('frontend.pms.project.add_planning_task'))->id('fk-pro-update_task')->class('fk-pro-update_task')->open() }}
                        {{ html()->hidden('project_id')->value($project->id) }}
                        
                        <div class="table-responsive scroller projectTaskDiv">
                        </div>
                        <button class="btn btn-primary float-right mt-3 releaseProjectPlanning ">@lang('pms.project.text.release_project')</button>
                        <button class="btn btn-primary float-right mt-3 saveProjectPlanning " style="margin-right:10px;">@lang('pms.project.text.add_update_proposal')</button>
                        <button class="btn btn-primary float-right mt-3 saveTemp" style="margin-right:10px;" >@lang('pms.project.text.save_template')</button>
                    {{ html()->form()->close() }}
                    
                </div>
            </div>
        </div>
        
        <div class="modal templateModal" id="templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ html()->form('POST', route('frontend.pms.project.save_template'))->class('fk-pro-savetemplate')->open() }}
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('pms.project.text.template_name')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {{ html()->text('template_name')->class('form_control template_name')->attribute('style', 'width:100%')->attribute('autocomplete', 'off') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('pms.project.labels.cancel')</button>
                    <button type="submit" class="btn btn-primary saveNewTemp">@lang('pms.project.labels.save')</button>
                </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div> 

        <div class="modal createProjectModal" id="createProjectModal" tabindex="-1" role="dialog" aria-labelledby="createProjectModal" aria-hidden="true">

        </div>

        <div class="modal releaseProjectModal" id="releaseProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ html()->form('POST', route('frontend.pms.project.save_template'))->class('fk-pro-select_release_options')->open() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                        @lang('pms.project.text.notify_parties')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group checkbox">
                            {{ html()->checkbox("permission[]")->value('customer')->class('checkbox')  }}
                            {{ html()->label(__('pms.project.text.customer')) }}
                        </div>
                        <div class="form-group checkbox">
                            {{ html()->checkbox("permission[]")->value('my_resources')->class('checkbox')  }}
                            {{ html()->label(__('pms.project.text.my_resources')) }}
                        </div>
                        <div class="form-group checkbox">
                            {{ html()->checkbox("permission[]")->value('sub_contractors')->class('checkbox')  }}
                            {{ html()->label(__('pms.project.text.sub_contractors')) }}
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <p>
                                @lang('pms.project.text.release_text')
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        
                        <div class="row">
                            <button type="submit" class="btn btn-primary releaseButton">@lang('pms.project.text.release_project')</button>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div> 
        

    @endif
@endsection

@push('after-styles')
    {{ style('https://netdna.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css') }}
    {{ style('https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css') }}
    {{ style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css') }}
    
    <style>
    .taskListTable input{
        border:0px;
    }
    .deleteSpacer{
        min-width:20px;
        display:block;
        float:left;
    }
    .taskListTable tr  a.deleteTaskPlan{
        display: none; 
    }
    .taskListTable tr:hover a.deleteTaskPlan{
        display: block; 
    }
    </style>
@endpush

@push('after-scripts')

{!! script('https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js') !!}
{!! script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js') !!}
{!! script('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js') !!}

<script>

function totalDuration(){
    var totalDur = 0;
    $(document).find('table.taskListTable tbody tr .duration').each(function(index, value) {
        if($(this).val()){
            totalDur = parseInt(totalDur) + parseInt($(this).val());
        }
    });
    $(document).find('table.taskListTable tfoot td.duration').html(totalDur)
}


function checkTemplate(){
    if($(document).find('[name=temp_id]').length){
        $(document).find('.deleteTemplate').show();
        $(document).find('.saveTemp').hide();
    }else{
        $(document).find('.deleteTemplate').hide();
        $(document).find('.saveTemp').show();
    }
}

function getTask(){
    showLoader();
    $.ajax({
        type:'GET',
        url: "{{ route('frontend.pms.project.get_planning',['project_id'=> $project->id ]) }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(result){
            hideLoader();
            $(document).find('.projectTaskDiv').html(result);
            $(document).find( ".end_date , .start_date, .deadline" ).datepicker({
                dateFormat: "dd-mm-yy",
                minDate: -1
            });
            $(document).find('table.taskListTable .assignee_to_selection').multiselect({
                nonSelectedText:"@lang('pms.project.text.please_select')",
                onChange: function(option, checked, select) {
                    var selectedOption = $(option).closest('tr').find('.assignee_to_selection').val();
                    $(option).closest('tr').find('.assignee_to').val(selectedOption);
                }
            });
            $(document).find('table.taskListTable .checkpoint-multiselect').multiselect({
                nonSelectedText:"@lang('pms.project.text.please_select')",
                onChange: function(option, checked, select) {
                    var selectedOption = $(option).closest('tr').find('.checkpoint-multiselect').val();
                    $(option).closest('tr').find('.checkpoint').val(selectedOption);
                }
            });
            totalDuration();
            checkTemplate();
    
        }
    });
}

function getTemplate(){
    showLoader();
    $.ajax({
        type:'GET',
        url: "{{ route('frontend.pms.project.template_list') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function(result){
            hideLoader();
            $(document).find('.templatesDiv').html(result);
            $(document).find('.fk-pro-selecttemplate').validate({
                rules: {
                    selection_template: { required: true}
                },
                messages: {
                    selection_template: { required: "@lang('pms.validaion.required.name')" }
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
        },'Must be greater than {0}.'
    );

    $(document).on('click', '.cancel_buttonONDas', function(e){
        e.preventDefault();
        $(document).find('.createProjectModal').modal('hide');
    });

    $(document).on('click', '.createTask', function(){
        showLoader();
        $.ajax({
            type:'GET',
            url: "{{ route('frontend.pms.project.create_task_planning',['project_id'=>$project->id]) }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(result){
                hideLoader();
                $(document).find('.createProjectModal').html(result);
                $(document).find('.createProjectModal').modal('show');
                // fk-pro-update_task
                $(document).find('.fk-pro-new_planning_task').validate({
                    rules: {
                        task_name: { required: true} ,
                        description: { required: true}
                    },
                    messages: {
                        task_name: { required: "@lang('pms.validaion.required.name')" },
                        description: { required: "@lang('pms.validaion.required.name')"}
                    },
                    submitHandler: function (form) {
                        var data = $(document).find('.fk-pro-new_planning_task').serialize();
                        console.log(data);
                        var urlUpdate =  $(document).find('.fk-pro-new_planning_task').attr('action');
                        console.log(urlUpdate);
                        showLoader();
                        $.ajax({
                            type:'POST',
                            url: urlUpdate,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: { data: data },
                            success:function(result){
                                window.location.reload();
                            }
                        });

                    }
                });
                
            }
        });
    });

    
    $(document).on('click','.releaseProjectPlanning',function(e){
        e.preventDefault();
        $(document).find('.releaseProjectModal').modal('show');
    });

    $(document).on('click','.saveProjectPlanning',function(e){
        e.preventDefault();
        var data = $(document).find('#fk-pro-update_task').serialize();
        var urlUpdate = $(document).find('#fk-pro-update_task').attr('action');
        showLoader();
        $.ajax({
            type: 'POST',
            url: urlUpdate,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data ,
            success:function(result){
                hideLoader();
                if(result.status){
                    Swal.fire({
                        "title":"@lang('pms.project.messages.success')",
                        "html":"@lang('pms.messages.project_plan_success')",
                        "type":"success",
                        "showConfirmButton":true,
                        "showCloseButton":true,
                        "allowEscapeKey":true,
                        "allowOutsideClick":true
                    });
                    getTask();
                }
            }
        });
    });

    $(document).on('click','.deleteTemplate',function(e){
        e.preventDefault();
        Swal.fire({
            "title":"@lang('pms.project.swal.delete_title')",
            "html":"@lang('pms.project.swal.delete_text')",
            "type":"warning",
            "showConfirmButton":true,
            "showCloseButton":true,
            "showCancelButton":true,
            "allowEscapeKey":true,
            "allowOutsideClick":true
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.value) {
                var tempId = $(document).find('[name=temp_id]').val();
                showLoader();
                $.ajax({
                    type:'POST',
                    url: "{{ route('frontend.pms.project.template_delete') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { template_id: tempId },
                    success:function(result){
                        hideLoader();
                        getTask();
                        getTemplate();
                    }
                });
            }
        })
        
    });


    $(document).on('click','.deleteTaskPlan',function(e){
        e.preventDefault();
        Swal.fire({
            "title":"@lang('pms.project.swal.delete_title')",
            "html":"@lang('pms.project.swal.delete_text')",
            "type":"warning",
            "showConfirmButton":true,
            "showCloseButton":true,
            "showCancelButton":true,
            "allowEscapeKey":true,
            "allowOutsideClick":true
        }).then((result) => {
            if(result.value){
                var urlDelete = "";
                var data;

                if($(document).find('[name=temp_id]').length){
                    urlDelete = "{{ route('frontend.pms.project.template_delete_task') }}";
                    var tempId = $(document).find('.template_id').val();
                    data = {
                        task_id : tempId
                    }
                }else{
                    urlDelete = "{{ route('frontend.pms.project.delete_task') }}";
                    var taskId = $(this).closest('tr').find('.id').val();
                    var projectId = $(this).closest('form').find('[name=project_id]').val();
                    data = {
                        task_id : taskId,
                        project_id : projectId,
                    }
                }
                showLoader();
                $.ajax({
                    type:'POST',
                    url: urlDelete,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success:function(result){
                        hideLoader();
                        if(data.project_id){
                            getTask();
                            getTemplate();
                        }else{
                            // $(document).find('.saveNewTemp').trigger('click');
                        }
                        
                    }
                });
            }
        });
    });
    
    
    
    $(document).on('click','.selectNewTemp',function(e){
        e.preventDefault();
        var validatedForm = $(document).find(".fk-pro-selecttemplate").valid();
        var selecttemplate = $(document).find(".fk-pro-selecttemplate").find('[name=selection_template]').val();
        if(validatedForm && selecttemplate != ''){
            $(document).find(".fk-pro-selecttemplate")[0].reset();
            showLoader();
            $.ajax({
                type:'GET',
                url: "{{ route('frontend.pms.project.template_load') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { template_id: selecttemplate },
                success:function(result){
                    hideLoader();
                        $(document).find('.selecttemplateModal').modal('hide');
                        $(document).find('.projectTaskDiv').html(result);
                        $(document).find( ".end_date , .start_date, .deadline" ).datepicker({
                            dateFormat: "dd-mm-yy",
                            minDate: -1
                        });
                        $(document).find('table.taskListTable .assignee_to_selection').multiselect({
                            nonSelectedText:"@lang('pms.project.text.please_select')",
                            onChange: function(option, checked, select) {
                                var selectedOption = $(option).closest('tr').find('.assignee_to_selection').val();
                                $(option).closest('tr').find('.assignee_to').val(selectedOption);
                            }
                        });
                        $(document).find('table.taskListTable .checkpoint-multiselect').multiselect({
                            nonSelectedText:"@lang('pms.project.text.please_select')",
                            onChange: function(option, checked, select) {
                                var selectedOption = $(option).closest('tr').find('.checkpoint-multiselect').val();
                                $(option).closest('tr').find('.checkpoint').val(selectedOption);
                            }
                        });
                        totalDuration();
                        checkTemplate();
                        // $('#fk-pro-add_task').find("[name=area]").val('');
                        // $('#fk-pro-add_task').find("[name=area_work]").val('');
                        // getTask(); 
                    // }  
               }
            });
        }
        // console.log(selecttemplate);
        // alert(selecttemplate);
    });

    $(document).find('.fk-pro-selecttemplate').validate({
        rules: {
            selection_template: { required: true}
        },
        messages: {
            selection_template: { required: "@lang('pms.validaion.required.name')" }
        }
    });

    $(document).find('.fk-pro-select_release_options').validate({
        rules: {
            'permission[]': {
                required: true
            }
        },
        messages: {
            'permission[]': {
                required: "@lang('pms.validaion.required.permission')"
            }
        },
        submitHandler: function (form) {
            var data = $(document).find('#fk-pro-update_task').serialize();
            var urlUpdate = $(document).find('#fk-pro-update_task').attr('action');
            showLoader();
            $.ajax({
                type: 'POST',
                url: urlUpdate,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data ,
                success:function(result){
                    hideLoader();
                    if(result.status){
                        var releaseOption = $(document).find('.fk-pro-select_release_options').serialize();
                        console.log('releaseOption', releaseOption)
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('frontend.pms.project.update_project_release',['project_id'=> $project->id ]) }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: releaseOption ,
                            success:function(result){
                                if(result.status){
                                    Swal.fire({
                                        "title":"@lang('pms.project.messages.success')",
                                        "html":"@lang('pms.messages.project_plan_release_success')",
                                        "type":"success",
                                        "showConfirmButton":true,
                                        "showCloseButton":true,
                                        "allowEscapeKey":true,
                                        "allowOutsideClick":true
                                    });
                                    setTimeout(() => {
                                        window.location.href = "{{ route('frontend.pms.project') }}"    
                                    }, 1000);
                                }
                            }
                        });
                    }
                }
            });
            
        }
    });

    $(document).find('.fk-pro-savetemplate').validate({
        rules: {
            template_name: { required: true}
        },
        messages: {
            template_name: { required: "@lang('pms.validaion.required.name')" }
        },
        submitHandler: function (form) {
            var tempName = $(document).find('.fk-pro-savetemplate').find('[name=template_name]').val();
            var data = $(document).find('#fk-pro-update_task').serialize();
            var urlUpdate =  $(document).find('.fk-pro-savetemplate').attr('action');
            
            var formData = new FormData();
            formData.append('template_name',tempName);
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
                        getTemplate();
                        $(document).find('.templateModal').modal('hide')
                        Swal.fire({
                            "title":"@lang('pms.project.messages.success')",
                            "html":"@lang('pms.messages.project_task_template_success')",
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

    $(document).on('change', '[name=area_work]', function(){
        var selectedVal = $(this).val();
        var name = $(document).find('[name=area_work] option[value='+selectedVal+']').text();
        $(document).find('[name=area_work_name]').val(name);
    });

    $(document).on('change', '[name=template_selection]', function(){
        var selectedVal = $(this).val();
        if(selectedVal == 'select_template'){
            $(document).find('.selecttemplateModal').modal('show')
        }
        $(this).prop('selectedIndex',0);
    });
    
    $(document).on('click','.closeSnTemp', function (e) {
        $(document).find('[name=template_selection]').val("").prop('selectedIndex',0);
    })

    $(document).on('change', '.duration', function(){
        totalDuration();
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

            if($(document).find('[name=temp_id]').length){
                Swal.fire({
                    "title":"@lang('pms.project.swal.save_template')",
                    "html":"@lang('pms.project.swal.template_save_first')",
                    "type":"warning",
                    "showConfirmButton":true,
                    "showCloseButton":true,
                    "showCancelButton":true,
                    "allowEscapeKey":true,
                    "allowOutsideClick":true
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.value) {
                        var data = $(document).find('#fk-pro-update_task').serialize();
                        var urlUpdate = $(document).find('#fk-pro-update_task').attr('action');
                        showLoader();
                        $.ajax({
                            type: 'POST',
                            url: urlUpdate,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: data ,
                            success:function(result){
                                hideLoader();
                                var area = $('#fk-pro-add_task').find("[name=area]").val();
                                var area_work = $('#fk-pro-add_task').find("[name=area_work]").val();
                                var area_work_name =  $('#fk-pro-add_task').find("[name=area_work]").find("option:selected").text();
                                var area_name =  $('#fk-pro-add_task').find("[name=area]").find("option:selected").text();
                                var url = $('#fk-pro-add_task').attr('action');

                                $.ajax({
                                    type:'POST',
                                    url: url,
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                    data: { project_id : {{ $project->id }}, area:area, area_work: area_work, area_work_name: area_work_name , area_name: area_name },
                                    success:function(result){
                                        if(result.status){
                                            $('#fk-pro-add_task').find("[name=area]").val('');
                                            $('#fk-pro-add_task').find("[name=area_work]").val('');
                                            getTask(); 
                                            getTemplate();
                                        }  
                                    }
                                });
                            }
                        });
                    }
                })
            }else{

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
                        }  
                    }
                });
            }
        }
    });

    
    $(document).on('click', '.saveTemp', function(e){
        e.preventDefault();
        $(document).find('.templateModal').modal('show')
    });
    
    $(document).find('table.taskListTable .assignee_to_selection').multiselect({
        nonSelectedText:"@lang('pms.project.text.please_select')",
        onChange: function(option, checked, select) {
            var selectedOption = $(option).closest('tr').find('.assignee_to_selection').val();
            $(option).closest('tr').find('.assignee_to').val(selectedOption);
        }
    });
    $(document).find('table.taskListTable .checkpoint-multiselect').multiselect({
        nonSelectedText:"@lang('pms.project.text.please_select')",
        onChange: function(option, checked, select) {
            var selectedOption = $(option).closest('tr').find('.checkpoint-multiselect').val();
            $(option).closest('tr').find('.checkpoint').val(selectedOption);
        }
    });

    $(document).find( ".end_date , .start_date, .deadline" ).datepicker({
        dateFormat: "dd-mm-yy",
        minDate: -1
    });
    
    totalDuration();
    getTask();
    getTemplate();
    
});
</script>
@endpush