{{ html()->modelForm( $projectTask ,'POST', route('frontend.pms.project.update_task'))->id('fk-pro-update_task')->class('fk-pro-update_task')->open() }}
{{ html()->hidden('id')->class('form-control')->placeholder(__('pms.project.labels.description')) }}
<h1 class="head1">@lang('pms.project.text.task_details')</h1>
<h1 class="head1">
    <span class="showTaskName" >{{ $projectTask->task_name }} <a class="edittaskname btn btn-gray btn-icon" href="javascript:void(0);" ><i class="icon-edit"></i></a></span>
    <span class="editTaskName" style="display:none;" >{{ html()->text('task_name')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.labels.task_name'))->required() }} </span>
</h1>
<div class="row">
    <div class="col">
        <a class="btn btn-gray btn-icon">
            <i class="icon-attachment"></i>
            {{ html()->text('attachment')->attribute('type','file') }}
        </a>
        @if($projectTask->attachment && !empty($projectTask->attachment))
            <a class="btn btn-gray btn-icon" target="_blank" href="{{ url('/project_task/attachment/'.$projectTask->attachment) }}" >
                <i class="icon-down"></i>
            </a>
        @endif
        <!-- <a class="btn btn-gray btn-icon"><i class="icon-list-view"></i></a> -->
        <!-- <a class="btn btn-gray btn-icon"><i class="icon-link"></i></a> -->
        <div class="float-right">
            <div class="dropdown">
                <select class="checkpoint-multiselect" multiple="multiple" placeholder="Checkpoint" >
                    <option value="signature" @if($projectTask->checkpoint_values && in_array('signature',$projectTask->checkpoint_values))selected="selected"@endif >@lang('pms.project.labels.signature')</option>
                    <option value="image" @if($projectTask->checkpoint_values && in_array('image',$projectTask->checkpoint_values))selected="selected"@endif >@lang('pms.project.labels.image')</option>
                    <option value="report" @if($projectTask->checkpoint_values && in_array('report',$projectTask->checkpoint_values))selected="selected"@endif >@lang('pms.project.labels.report')</option>
                    <option value="audits" @if($projectTask->checkpoint_values && in_array('audits',$projectTask->checkpoint_values))selected="selected"@endif >@lang('pms.project.labels.audits')</option>
                </select>
                {{ html()->hidden('checkpoint') }}
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
                @include('pms.project.partials.parent_option',['projectList'=>$projectList , 'projectTask' => $projectTask , 'padding' => 0 ])
            </select>
        </div>
    </div>
</div>
<div class="mt-4"></div>
<div class="row">
    <div class="col-12">
        <label>@lang('pms.project.status')</label>
        <div class="dropdown dropdown-status">
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
    <select name="assignee_to_selection" multiple="multiple" class="form-control">
        @if(count($resources))
            @foreach($resources as $resource)
                <option value="{{ $resource->id }}" @if($projectTask->assignee_to_selection && in_array($resource->id, $projectTask->assignee_to_selection) )selected="selected"@endif  >{{ $resource->first_name }} {{ $resource->last_name }}</option>
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
                <option value="{{ $resource->id }}"  selected="@if($resource->id == $projectTask->report_to ) true @else false @endif" >{{ $resource->first_name }} {{ $resource->last_name }}</option>
            @endforeach
        @endif
    </select>
</div>
<div class="form-group">
    <label>@lang('pms.project.labels.labels')</label>
    <div class="clear"></div>
    {{ html()->text('labels')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.labels.labels')) }} 
</div>
<!-- <div class="form-group">
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

<!-- {{ $projectTask }} -->
<div class="form-group">
    <!-- {{ form_cancel(route('frontend.pms.dashboard'), __('pms.project.labels.cancel')) }} -->
    {{ form_submit(__('pms.project.labels.submit'))->id('submit_btn')->class('float-right btn btn-primary mb-sm-0 mb-3') }}
</div>
{{ html()->form()->close() }}