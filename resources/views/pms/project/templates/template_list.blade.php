@if($templates)
<select name="template_selection" class="form-control" >
    <option value="">@lang('pms.project.text.please_select')</option>
    <option value="select_template" >@lang('pms.project.text.select_template')</option>
    <!-- <option></option> -->
</select>
<div class="modal selecttemplateModal" id="selecttemplateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {{ html()->form('POST', route('frontend.pms.project.save_template'))->class('fk-pro-selecttemplate')->open() }}
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">@lang('pms.project.text.select_template')</h5>
            <button type="button" class="close closeSnTemp" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
            <select name="selection_template" class="form-control" >
                <option value="" >@lang('pms.project.text.please_select')</option>
                @foreach($templates as $template)
                    <option value="{{ $template->id }}" >{{ $template->template_name }}</option>
                @endforeach
                <!-- <option></option> -->
            </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary closeSnTemp" data-dismiss="modal">@lang('pms.project.labels.cancel')</button>
            <button type="submit" class="btn btn-primary selectNewTemp">@lang('pms.project.labels.select')</button>
        </div>
        </div>
        {{ html()->form()->close() }}
    </div>
</div> 
@endif