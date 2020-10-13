 
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.workcategory.user_actions')">
        

        <a href="{{ route('admin.workcategory.edit', $category) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
            <i class="fas fa-edit"></i>
        </a>

        <a onclick="return confirm('Are you sure?')" href="{{ route('admin.workcategory.destroy', $category) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" class="btn btn-danger">
        <i class="fas fa-trash"></i>
        </a>
    </div>
 