<div class="modal-dialog" role="document">
    {{ html()->form( 'POST', route('frontend.pms.project.new_planning_task'))->id('fk-pro-new_planning_task')->class('fk-pro-new_planning_task')->open() }}
    {{ html()->hidden('project_id')->value($projectId)->class('form-control')->placeholder(__('pms.project.labels.description')) }}
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                @lang('pms.project.text.add_task')
            </h5>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>@lang('pms.project.labels.task_name')</label>
                {{ html()->text('task_name')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.labels.task_name'))->required() }} 
                
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="dropdown dropdown-parent">
                        <label>@lang('pms.project.labels.parent')</label>
                        <select class="form-control" name="parent_id" >
                            <option value="0" >@lang('pms.project.text.please_select')</option>
                            @include('pms.project.partials.parent_option',['projectList'=>$projectList , 'padding' => 0 ])
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="dropdown dropdown-status">
                        <label>@lang('pms.project.status')</label>
                        {{
                            html()->select('status', 
                                    [
                                        'Todo' => 'To do',
                                        'Inprogress' => 'In-progress',
                                        'Done' => 'Done',
                                    ]
                            )
                            ->class('form-control')
                            ->id('task-status')
                        }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>@lang('pms.project.labels.description')</label>
                {{ html()->textarea('description')->class('form-control')->placeholder(__('pms.project.labels.description')) }}
            </div>
            
        </div>
        <div class="modal-footer">
            <div class="form-group">
                {{ form_cancel(route('frontend.pms.dashboard'), __('pms.project.labels.cancel') )->class('cancel_button cancel_buttonONDas') }}
                {{ form_submit(__('pms.project.labels.submit'))->id('submit_btn')->class('float-right btn btn-primary mb-sm-0 mb-3') }}
            </div>
        </div>
    </div>
    {{ html()->form()->close() }}
</div>