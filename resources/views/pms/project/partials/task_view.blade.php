<h1 class="head1">@lang('pms.project.text.task_details')</h1>
<h1 class="head1">
    <span class="showTaskName" >{{ $projectTask->task_name }}</span>
</h1>
<div class="mt-4"></div>
<br>
<div class="form-group">
    <label><strong>@lang('pms.project.labels.status')</strong></label>
    {{ $projectTask->status }}
</div>
<div class="form-group">
    <label><strong>@lang('pms.project.labels.description')</strong></label>
    {{ $projectTask->description }}
</div>

<div class="form-group">
    <label><strong>@lang('pms.project.labels.reporter')</strong></label>
    <div class="profile">
        @if($projectTask->reporter)
            @php
                $image = url('/images/dummy-user.png');
                if($projectTask->reporter && $projectTask->reporter->photo){
                    $image = url('/images/resources/'.$projectTask->reporter->id.'/'.$projectTask->reporter->photo);
                }
            @endphp
            <img class="rounded-circle" src="{{ $image }}" alt="">
            {{ $projectTask->reporter->first_name }} {{ $projectTask->reporter->last_name }}
        @else
        -
        @endif
    </div>
</div>
<div class="form-group">
    <label><strong>@lang('pms.project.labels.assignee')</strong></label>
    @if(count($projectTask->assignee_to_data ))
        @foreach($projectTask->assignee_to_data as $resource)
        <div class="profile">
            @php
                $image = url('/images/dummy-user.png');
                if($resource && $resource->photo){
                    $image = url('/images/resources/'.$resource->id.'/'.$resource->photo);
                }
            @endphp
            <img class="rounded-circle" src="{{ $image }}" alt="">
            {{ $resource->first_name }} {{ $resource->last_name }}
        </div>
        @endforeach
    @else
    -
    @endif 
</div>
<div class="form-group">
    <label><strong>@lang('pms.project.labels.labels')</strong></label>
    <div class="clear"></div>
    {{ $projectTask->labels? $projectTask->labels : '-' }}
</div>
<!-- <div class="form-group">
    <label><strong>@lang('pms.project.labels.priority')</strong></label>
    {{ $projectTask->priority }}
</div> -->
<div class="form-group">
    <label><strong>@lang('pms.project.labels.start_date')</strong></label>
    <div class="clear"></div>
    {{ $projectTask->start_date? $projectTask->start_date : '-' }}
</div>
<div class="form-group">
    <label><strong>@lang('pms.project.labels.end_date')</strong></label>
    <div class="clear"></div>
    {{ $projectTask->end_date? $projectTask->end_date : '-' }}
</div>
<div class="form-group">
    <label><strong>@lang('pms.project.labels.deadline')</strong></label>
    <div class="clear"></div>
    {{ $projectTask->deadline? $projectTask->deadline : '-' }}
</div>
<div class="form-group">
    <label><strong>@lang('pms.project.labels.duration')</strong></label>
    <div class="clear"></div>
    {{ $projectTask->duration? $projectTask->duration : '-' }}
</div>

<div class="form-group signatureDiv" style="@if(!$projectTask->attachment) display:none @endif" >
    <label><strong>@lang('pms.project.labels.attachment')</strong></label>
    <div class="clear"></div>
    @if($projectTask->attachment && !empty($projectTask->attachment))
        <a class="btn btn-gray btn-icon" target="_blank" href="{{ url('/project_task/attachment/'.$projectTask->attachment) }}" >
            <i class="icon-down"></i>
        </a>
    @endif
</div>

<div class="form-group timeData" style="@if(!$projectTask->time) display:none @endif">
    <label><strong>@lang('pms.project.text.time_added')</strong></label>
    <div class="clear"></div>
    <div class="timeDataContent">
        @if($projectTask->time && !empty($projectTask->time))
            <table border="1" >
                <thead>
                    <tr>
                        <th>{{ __('pms.project.labels.user') }}</th>
                        <th>{{ __('pms.project.labels.resource') }}</th>
                        <th>{{ __('pms.project.labels.description') }}</th>
                        <th>{{ __('pms.project.labels.hours') }}</th>
                        <th>{{ __('pms.project.labels.signature') }}</th>
                        <th>{{ __('pms.project.labels.image') }}</th>
                        <th>{{ __('pms.project.labels.report') }}</th>
                        <th>{{ __('pms.project.labels.audits') }}</th>
                        <th>{{ __('pms.project.labels.date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projectTask->time as $time)
                    <tr>
                        <td>{{ ($time->user_time)?($time->user_time->first_name.' '.$time->user_time->last_name):'-' }}</td>
                        <td>{{ ($time->resource_time)?($time->resource_time->first_name.' '.$time->resource_time->last_name):'-' }}</td>
                        <td>{{ $time->description }}</td>
                        <td>{{ $time->hours }}</td>
                        <td>
                        @if( $time->signature )
                            <a class="btn btn-gray btn-icon" target="_blank" href="{{ url('/project_task/signature/'.$time->signature) }}" >
                                <i class="icon-down"></i>
                            </a>
                        @else
                            -
                        @endif
                        </td>
                        <td>
                        @if( $time->image )
                            <a class="btn btn-gray btn-icon" target="_blank" href="{{ url('/project_task/image/'.$time->image) }}" >
                                <i class="icon-down"></i>
                            </a>
                        @else
                            -
                        @endif
                        </td>
                        <td>
                        @if( $time->report )
                            <a class="btn btn-gray btn-icon" target="_blank" href="{{ url('/project_task/report/'.$time->report) }}" >
                                <i class="icon-down"></i>
                            </a>
                        @else
                            -
                        @endif
                        </td>
                        <td>
                        @if( $time->audits )
                            <a class="btn btn-gray btn-icon" target="_blank" href="{{ url('/project_task/audits/'.$time->audits) }}" >
                                <i class="icon-down"></i>
                            </a>
                        @else
                            -
                        @endif
                        </td>
                        <td>{{ date('m/d/Y',$time->date) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            @lang('pms.project.text.no_time_added')
        @endif 
    </div>
</div>
