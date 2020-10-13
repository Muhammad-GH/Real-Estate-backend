<tr>
    <td style="padding-left:{{$padding}}px" >
        <span class="badge badge-pill badge-success"></span>{{ $taskdetail->task_name }}
    </td>
    <td class="action">
        <div class="dropdown">
            <a class="dropdown-toggle no-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-dots-three-horizontal"></i>
            </a>
            <div class="dropdown-menu">
                @if( ( isset($type) && ($type == 'view' || $type == 'edit') ) && ( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->view_project) ) )
                    <a class="dropdown-item viewTask " data-id="{{ $taskdetail->id }}" href="javascript:void(0);" >{{ __('pms.project.view') }}</a>
                @endif
                @if( ( isset($type) && $type == 'edit' ) && ( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->edit_subtask) ) )
                    <a class="dropdown-item editTask " data-id="{{ $taskdetail->id }}" href="javascript:void(0);" >{{ __('pms.project.edit') }}</a>
                    <a class="dropdown-item deleteTask " data-id="{{ $taskdetail->id }}" href="javascript:void(0);">{{ __('pms.project.delete') }}</a>
                @endif
                @if( ( isset($type) && ($type == 'edit' || $type == 'view') ) && ( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->add_time) ) )
                    <a class="dropdown-item addTimeTask " data-id="{{ $taskdetail->id }}" href="javascript:void(0);">{{ __('pms.project.add_time') }}</a>
                @endif
            </div>
        </div>
    </td>
</tr>
@if($taskdetail->allchildtask)
    @php
        $padding = $padding + 20;
    @endphp
    @foreach($taskdetail->allchildtask as $key => $task_detail)
        @include('pms.project.partials.task_list_row',['taskdetail'=>$task_detail,   ])
    @endforeach
@endif