<div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">				
 
        
        <a href="{{ route('admin.workphase.index') }}?area_id={{  $workarea->area_lang_area_id }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
        <i class="fa fa-flag" aria-hidden="true"></i>

        </a>
        <a href="{{ route('admin.workarea.edit', $workarea->area_id) }}?language={{  $workarea->area_lang_lang_id }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
            <i class="fas fa-edit"></i>
        </a>
        <a href="{{ route('admin.workarea.destroy', $workarea->area_id) }}" data-method="get" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="btn btn-danger">
            <i class="fas fa-trash"></i>
        </a>
      
    </div>