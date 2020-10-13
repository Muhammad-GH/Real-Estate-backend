{{ html()->hidden('temp_id')->value($templateId) }}
<table class="table table-bordered table-sm taskListTable ">
    <thead>
        <tr class="text-right">
            <th class="text-left"> @lang('pms.project.text.project_task') </th>
            <th > @lang('pms.project.labels.start_date') </th>
            <th> @lang('pms.project.labels.end_date') </th>
            <th> @lang('pms.project.labels.duration') </th>
            <th> @lang('pms.project.labels.deadline') </th>
            <th> @lang('pms.project.labels.checkpoint') </th>
            <th> @lang('pms.project.labels.assignee') </th>
        </tr>
    </thead>
    @if( $templateTask && count($templateTask) )
        <tbody>
            @if( $templateTask && count($templateTask) )
                @foreach($templateTask as $key => $projectData)
                    @include('pms.project.templates.template_row',['project_task'=>$projectData, 'padding' =>0, 'key' => $key+1 ])
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td data-label=""></td>
                <td data-label="Project tasks: " class="text-right">Hours in total (calculate)</td>
                <td data-label="Start" class="text-right">hrs</td>
                <td class="duration" data-label="Duration(hrs): "></td>
                <td data-label="Timelines: "></td>
                <td data-label="Check points: "></td>
                <td data-label="Add resource: "></td>
            </tr>
        </tfoot>
    @endif
</table>