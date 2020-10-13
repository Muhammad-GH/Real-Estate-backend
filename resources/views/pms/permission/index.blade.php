@extends('pms.layout.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
    <div class="container">
        <h3 class="head3">@lang('pms.permission.title')</h3>
        
        <div class="card">
        
            <div class="card-body">

                <button type="button" class="btn btn-blue addNewButton" style="margin-bottom: 20px; float: right;">@lang('pms.permission.labels.add_new')</button>
                <br>
                
                @if(count($permissions))
                    {{ html()->form('POST', route('frontend.pms.permission.submit'))->id('fk-pro-create_project')->open() }} 		
                        <table border="1" style="width:100%; text-align:center;" >
                            <thead >
                                <tr>
                                    <th ></th>
                                    <th colspan="5" >@lang('pms.permission.labels.project')</th>
                                </tr>
                                <tr>
                                    <th>@lang('pms.permission.labels.role_name')</th>
                                    <th>@lang('pms.permission.labels.view_project')</th>
                                    <th>@lang('pms.permission.labels.edit_project')</th>
                                    <th>@lang('pms.permission.labels.add_edit_subtask')</th>
                                    <th>@lang('pms.permission.labels.planning_project')</th>
                                    <th>@lang('pms.permission.labels.add_time')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                {{ html()->hidden("permission[".$permission->id."][id]")->value($permission->id)  }}
                                <tr class="datapermission_{{ $permission->id }}" >
                                    <td style="text-align:left;">
                                    {{ html()->text('key_name')
                                                ->class('form-control')
                                                ->attribute('name', "permission[".$permission->id."][role_name]")
                                                ->attribute('maxlength', 191)
                                                ->attribute('style', 'display:none;')
                                                ->value($permission->role_name) }}

                                    {{ $permission->role_name }}</td>
                                    <td>{{ html()->checkbox("permission[".$permission->id."][view_project]", ($permission)?$permission->view_project:false, 1)->class('view_project')  }}</td>
                                    <td>{{ html()->checkbox("permission[".$permission->id."][edit_project]", ($permission)?$permission->edit_project:false, 1)->class('edit_project')  }}</td>
                                    <td>{{ html()->checkbox("permission[".$permission->id."][edit_subtask]", ($permission)?$permission->edit_subtask:false, 1)->class('edit_subtask')  }}</td>
                                    <td>{{ html()->checkbox("permission[".$permission->id."][planning_project]", ($permission)?$permission->planning_project:false, 1)->class('planning_project')  }}</td>
                                    <td>{{ html()->checkbox("permission[".$permission->id."][add_time]", ($permission)?$permission->add_time:false, 1)->class('add_time')  }}</td>
                                </tr>
                                
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <button type="submit" class="btn btn-blue">@lang('pms.permission.labels.save')</button>
                    {{ html()->form()->close() }}
                @else
                <div>@lang('pms.permission.no_resource')</div>
                @endif
            </div>
        </div>
    </div>

        <div class="modal templateModal" id="templateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                {{ html()->form('POST', route('frontend.pms.permission.name'))->class('fk-pro-permission_name')->open() }}
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('pms.permission.text.role_name')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {{ html()->text('role_name')->class('form_control template_name')->attribute('style', 'width:100%')->attribute('autocomplete', 'off') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('pms.permission.labels.cancel')</button>
                    <button type="submit" class="btn btn-primary saveNewTemp">@lang('pms.permission.labels.save')</button>
                </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div> 
@endsection

@push('after-scripts')
<script>
    $(document).ready(function(){
        
        $(document).on('click','.addNewButton', function(){
            $(document).find('.templateModal').modal('show');
        });

        $('.fk-pro-permission_name').validate({
            rules: {
                role_name: { required: true, minlength: 2}
            },
            messages: {
                role_name: { required: "@lang('pms.validaion.required.name')",  minlength : "@lang('pms.validaion.invalid.min_length',['min_len'=>2])" }
            }
        });


        $(document).on('change','.view_project', function(){
            if(!$(this).is(':checked')){
                $(this).closest('tr').find('input[type=checkbox]').prop('checked', false);
            }
            // if($(this).is(':checked')){
            //     $(this).closest('tr').find('input.view_subtask').prop('checked', true);
            // }
        });
        
        $(document).on('change','.edit_project', function(){
            if($(this).is(':checked')){
                $(this).closest('tr').find('input.view_project').prop('checked', true);
            }
        });
        
        // $(document).on('change','.view_subtask', function(){
        //     if($(this).is(':checked')){
        //         $(this).closest('tr').find('input.view_project').prop('checked', true);
        //     }
        //     if(!$(this).is(':checked')){
        //         $(this).closest('tr').find('input.edit_subtask').prop('checked', false);
        //         $(this).closest('tr').find('input.add_timeF').prop('checked', false);
        //     }
        // });
        
        $(document).on('change','.edit_subtask', function(){
            if($(this).is(':checked')){
                $(this).closest('tr').find('input.view_project').prop('checked', true);
                // $(this).closest('tr').find('input.view_subtask').prop('checked', true);
            }
        });
        
        $(document).on('change','.add_time', function(){
            if($(this).is(':checked')){
                $(this).closest('tr').find('input.view_project').prop('checked', true);
                // $(this).closest('tr').find('input.view_subtask').prop('checked', true);
            }
        });

        $(document).on('change','.planning_project', function(){
            if($(this).is(':checked')){
                $(this).closest('tr').find('input.view_project').prop('checked', true);
                $(this).closest('tr').find('input.edit_project').prop('checked', true);
                $(this).closest('tr').find('input.edit_subtask').prop('checked', true);
                // $(this).closest('tr').find('input.view_subtask').prop('checked', true);
            }
        });

        
    });
</script>
@endpush