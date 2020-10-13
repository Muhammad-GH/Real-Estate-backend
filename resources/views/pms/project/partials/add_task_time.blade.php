{{ html()->form( 'POST', route('frontend.pms.project.add_task_time'))->id('fk-pro-add_task_time')->attribute('enctype', 'multipart/form-data')->class('fk-pro-add_task_time')->open() }}
    
    {{ html()->hidden('project_id')->value($projectTask->project_id)->class('form-control')->placeholder(__('pms.project.labels.description')) }}
    
    {{ html()->hidden('project_task_id')->value($projectTask->id)->class('form-control')->placeholder(__('pms.project.labels.description')) }}
    <h1 class="head1">{{ __('pms.project.labels.task') }} : {{ $projectTask->task_name }}</h1>
    <h1 class="head1">{{ __('pms.project.add_time') }}</h1>
    <br>
    <div class="form-group">
        <label>{{ __('pms.project.labels.description') }}</label>
        {{ html()->textarea('description')->class('form-control')->placeholder(__('pms.project.labels.description')) }}
    </div>
    <div class="form-group">
        <label>{{ __('pms.project.labels.hours') }}</label>
        {{ html()->text('hours')->class('form-control')->attribute('type', 'number')->placeholder(__('pms.project.labels.hours')) }}
    </div>
    @if($projectTask->checkpoint_values && in_array('signature',$projectTask->checkpoint_values)) 
        <div class="form-group signatureDiv" >
            <label>@lang('pms.project.labels.signature')</label>
            <div class="clear"></div>
            {{ html()->text('signature')->class('form-control')->attribute('type', 'file') }} 
        </div>
    @endif
    @if($projectTask->checkpoint_values && in_array('image',$projectTask->checkpoint_values))
        <div class="form-group imageDiv" >
            <label>@lang('pms.project.labels.image')</label>
            <div class="clear"></div>
            {{ html()->text('image')->class('form-control')->attribute('type', 'file') }} 
        </div>
    @endif
    @if($projectTask->checkpoint_values && in_array('report',$projectTask->checkpoint_values))
        <div class="form-group reportDiv">
            <label>@lang('pms.project.labels.report')</label>
            <div class="clear"></div>
            {{ html()->text('report')->class('form-control')->attribute('type', 'file') }} 
        </div>
    @endif
    @if($projectTask->checkpoint_values && in_array('audits',$projectTask->checkpoint_values))
        <div class="form-group auditsDiv" >
            <label>@lang('pms.project.labels.audits')</label>
            <div class="clear"></div>
            {{ html()->text('audits')->class('form-control')->attribute('type', 'file') }}
        </div>
    @endif 
    <div class="form-group">
        <label>{{ __('pms.project.labels.date') }}</label>
        <div class="clear"></div>
        {{ html()->text('date')->class('form-control')->attribute('autocomplete', 'off')->placeholder(__('pms.project.labels.date')) }} 
    </div>
    <div class="form-group">
        {{ form_cancel(route('frontend.pms.dashboard'), __('pms.project.labels.cancel') )->class('cancel_button') }}
        {{ form_submit(__('pms.project.labels.submit'))->id('submit_btn')->class('float-right btn btn-primary mb-sm-0 mb-3') }}
    </div>
{{ html()->form()->close() }}