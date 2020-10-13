<tr>   
    @if(!isset($row) )
        @php $row = 1; @endphp
    @endif
    
    {{ html()->hidden('template_id')->class('template_id')->attribute('name','data['.($key.$row).'][template_id]')->value(($project_task && $project_task->id)?$project_task->id:null) }}

    {{ html()->hidden('parent_id')->class('parent_id')->attribute('name','data['.($key.$row).'][parent_id]')->value(($project_task && $project_task->parent_id)?$project_task->parent_id:null) }}

    {{ html()->hidden('area_id')->class('area_id')->attribute('name','data['.($key.$row).'][area_id]')->value(($project_task && $project_task->area_id)?$project_task->area_id:null) }}
    
    {{ html()->hidden('area_work_id')->class('area_work_id')->attribute('name','data['.($key.$row).'][area_work_id]')->value(($project_task && $project_task->area_work_id)?$project_task->area_work_id:null) }}

    {{ html()->hidden('task_name')->class('form_control task_name')->attribute('name','data['.($key.$row).'][task_name]')->value(($project_task && $project_task->task_name)?$project_task->task_name:null) }}

    <td data-label="Project tasks: "> 
        <!-- <span class="deleteSpacer">
        <a href="" class="deleteTaskPlan" > x </a> &nbsp;
        </span> -->
        <span class="nameDiv">
            @for ($i = 0; $i < $padding; $i++)
                -&nbsp;
            @endfor
            @if($padding == 0) <strong> @endif
            {{ ($project_task && $project_task->task_name)?$project_task->task_name:'' }}
            @if($padding == 0) </strong> @endif
        </span>
    </td>
    <td data-label="Start">{{ html()->text('start_date')->class('form_control start_date')->attribute('name','data['.($key.$row).'][start_date]')->attribute('autocomplete', 'off') }}</td>
    <td data-label="Start">{{ html()->text('end_date')->class('form_control end_date')->attribute('name','data['.($key.$row).'][end_date]')->attribute('autocomplete', 'off') }}</td>
    <td data-label="Duration(hrs): ">{{ html()->text('duration')->class('form_control duration ')->attribute('name','data['.($key.$row).'][duration]')->attribute('type','number') }}</td>
    <td data-label="Deadline">{{ html()->text('deadline')->class('form_control deadline')->attribute('name','data['.($key.$row).'][deadline]') }}</td>
    
    <td data-label="Check points: ">
        @php
        $valChkpoint = [];
        if($project_task->checkpoint)
            $valChkpoint =  explode(',', $project_task->checkpoint);

        @endphp
        <select class="checkpoint-multiselect" multiple="multiple" placeholder="Checkpoint" >
            <option value="signature">@lang('pms.project.labels.signature')</option>
            <option value="image" >@lang('pms.project.labels.image')</option>
            <option value="report">@lang('pms.project.labels.report')</option>
            <option value="audits">@lang('pms.project.labels.audits')</option>
        </select>
        {{ html()->hidden('checkpoint')->class('checkpoint')->attribute('name','data['.($key.$row).'][checkpoint]') }}
    </td>
    <td data-label="Add resource: ">
        @php
        $valAssign = [];
        if($project_task->assignee_to)
            $valAssign =  explode(',', $project_task->assignee_to);

        @endphp
        <select name="assignee_to_selection" multiple="multiple"  class="form-control assignee_to_selection">
            @if(count($resources))
                @foreach($resources as $resource)
                    <option value="{{ $resource->id }}" @if(isset($valAssign) && in_array($resource->id, $valAssign)) selected="selected"  @endif >{{ $resource->first_name }} {{ $resource->last_name }}</option>
                @endforeach
            @endif
        </select>
        {{ html()->hidden('assignee_to')->class('assignee_to')->attribute('name','data['.($key.$row).'][assignee_to]') }}
    </td>
</tr>
@php $row = $row +1; @endphp
@if($project_task->allchildtask)
    @php
        $padding = $padding + 1;
        
    @endphp
    @foreach($project_task->allchildtask as $k => $projTask)
        @include('pms.project.templates.template_row',['project_task'=>$projTask, 'padding' =>$padding , 'key' => $key.($k+1) ])
        @php $row = $row +1; @endphp
    @endforeach
@endif