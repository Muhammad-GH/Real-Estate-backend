@if ($property->trashed())
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
        <a href="{{ route('admin.investproperty.restore', $investproperty->id) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('Restore Invest Property')">
            <i class="fas fa-sync"></i>
        </a>

        <a href="{{ route('admin.investproperty.delete-permanently', $investproperty->id) }}" name="confirm_item" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('Delete Invest Property')">
            <i class="fas fa-trash"></i>
        </a>
    </div>
@else
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
        <a href="{{ route('admin.investproperty.show', $investproperty->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
            <i class="fas fa-eye"></i>
        </a>
        <a href="{{ route('admin.investproperty.edit', $investproperty->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
            <i class="fas fa-edit"></i>
        </a>
        <a href="{{ route('admin.investproperty.destroy', $investproperty->id) }}" data-method="get" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="btn btn-danger">
            <i class="fas fa-trash"></i>
        </a>
      
    </div>
@endif
