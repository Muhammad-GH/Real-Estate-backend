<div class="table-responsive">
    <table class="table table-striped">
        <tbody>
            @if(count($projectTask) > 0)
                @foreach($projectTask as $key => $taskdetail)
                    @include('pms.project.partials.task_list_row',['taskdetail'=>$taskdetail , 'padding' => 0 ])
                @endforeach
            @else
                <tr>
                    <td><span class="badge badge-pill"></span>{{ __('pms.project.no_record') }} </td>
                </tr>
            @endif
        </tbody>
        @if($projectType != 'backlog' && (isset($type) && ($type != 'view') ) )
            @if( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->edit_subtask) )
                <tfoot>
                    <tr>
                        <td>
                            <a href="javascript:void(0);" class="createTask" >{{ __('pms.project.create_newtask') }}</a>
                        </td>
                    </tr>
                </tfoot>
            @endif
        @endif
    </table>
</div>
