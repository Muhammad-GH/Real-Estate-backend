@if($projectList)
    @foreach($projectList as $projectContent)
        @if( !isset($projectTask) || ( isset($projectTask) &&  $projectContent->id != $projectTask->id ))
            <option value="{{ $projectContent->id }}" @if(isset($projectTask) && $projectContent->id == $projectTask->parent_id)selected="selected"@endif  >
            @for ($i = 0; $i < $padding; $i++)
                -
            @endfor
            {{ $projectContent->task_name }}</option>
            @if(isset($projectContent->allchildtask))
                @if(!isset($projectTask) || ( isset($projectTask) && $projectContent->id != $projectTask->parent_id))
                    @php
                        $paddingnew = $padding + 1;
                    @endphp
                    @include('pms.project.partials.parent_option',['projectList'=>$projectContent->allchildtask ,  'padding' => $paddingnew ])
                @endif
            @endif
        @endif
    @endforeach
@endif