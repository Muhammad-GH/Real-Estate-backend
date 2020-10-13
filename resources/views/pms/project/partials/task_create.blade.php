{{ html()->form( 'POST', route('frontend.pms.project.update_task'))->id('fk-pro-update_task')->class('fk-pro-update_task')->open() }}
{{ html()->hidden('project_id')->value($projectId)->class('form-control')->placeholder(__('pms.project.labels.description')) }}
<h1 class="head1">@lang('pms.project.text.add_task')</h1>
<h1 class="head1">
    <span class="showTaskName" >{{ html()->text('task_name')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.labels.task_name'))->required() }} </span>
</h1>
<div class="row">
    <div class="col">
        <a class="btn btn-gray btn-icon">
            <i class="icon-attachment"></i>
            {{ html()->text('attachment')->attribute('type','file') }}
        </a>
        <!-- <a class="btn btn-gray btn-icon"><i class="icon-list-view"></i></a> -->
        <!-- <a class="btn btn-gray btn-icon"><i class="icon-link"></i></a> -->
        <div class="float-right">
            <div class="dropdown">
                <select class="checkpoint-multiselect" multiple="multiple" placeholder="Checkpoint">
                    <option value="signature">@lang('pms.project.labels.signature')</option>
                    <option value="image">@lang('pms.project.labels.image')</option>
                    <option value="report">@lang('pms.project.labels.report')</option>
                    <option value="audits">@lang('pms.project.labels.audits')</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="mt-4"></div>
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
<div class="mt-4"></div>
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
<div class="mt-5"></div>
<div class="form-group">
    <label>@lang('pms.project.labels.description')</label>
    {{ html()->textarea('description')->class('form-control')->placeholder(__('pms.project.labels.description')) }}
</div>
<div class="form-group">
    <label>@lang('pms.project.labels.assignee')</label>
    <select name="assignee_to_selection" multiple="multiple"  class="form-control">
        @if(count($resources))
            @foreach($resources as $resource)
                <option value="{{ $resource->id }}"   >{{ $resource->first_name }} {{ $resource->last_name }}</option>
            @endforeach
        @endif
    </select>
    {{ html()->hidden('assignee_to') }}
</div>
<div class="form-group">
    <label>@lang('pms.project.labels.reporter')</label>
    <select name="report_to" class="form-control">
        <option value="">Please Select</option>
        @if(count($resources))
            @foreach($resources as $resource)
                <option value="{{ $resource->id }}"   >{{ $resource->first_name }} {{ $resource->last_name }}</option>
            @endforeach
        @endif
    </select>
</div>
<div class="form-group">
    <label>@lang('pms.project.labels.labels')</label>
    <div class="clear"></div>
    {{ html()->text('labels')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.labels.labels')) }} 
<!-- </div>
<div class="form-group">
    <label>@lang('pms.project.labels.priority')</label>
    {{
        html()->select('priority', 
                [
                    'Low' => 'Low',
                    'Medium' => 'Medium',
                    'High' => 'High',
                ]
        )
        ->class('form-control')
        ->id('task-status')
    }}
</div> -->
<div class="form-group">
    <label>@lang('pms.project.labels.start_date')</label>
    <div class="clear"></div>
    {{ html()->text('start_date')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.labels.start_date')) }} 
</div>
<div class="form-group">
    <label>@lang('pms.project.labels.end_date')</label>
    <div class="clear"></div>
    {{ html()->text('end_date')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.labels.end_date')) }} 
</div>
<div class="form-group">
    <label>@lang('pms.project.labels.deadline')</label>
    <div class="clear"></div>
    {{ html()->text('deadline')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.labels.deadline')) }} 
</div>
<div class="form-group">
    <label>@lang('pms.project.labels.duration')</label>
    <div class="clear"></div>
    {{ html()->text('duration')->class('form-control')->attribute('type', 'number')->placeholder(__('pms.project.labels.duration')) }} 
</div>

<div class="form-group">
    {{ form_cancel(route('frontend.pms.dashboard'), __('pms.project.labels.cancel') )->class('cancel_button') }}
    {{ form_submit(__('pms.project.labels.submit'))->id('submit_btn')->class('float-right btn btn-primary mb-sm-0 mb-3') }}
</div>
{{ html()->form()->close() }}