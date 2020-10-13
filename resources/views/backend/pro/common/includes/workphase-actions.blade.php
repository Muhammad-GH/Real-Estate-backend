<div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">				
 
 
        <a href="{{ route('admin.workphase.edit', $workphase->aw_id) }}?language={{  $workphase->aw_lang_lang_id }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
            <i class="fas fa-edit"></i>
        </a>
        <a href="{{ route('admin.workphase.destroy', $workphase->aw_id) }}" data-method="get" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="btn btn-danger">
            <i class="fas fa-trash"></i>
        </a>
      
    </div>