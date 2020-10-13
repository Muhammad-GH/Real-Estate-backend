 
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.category.user_actions')">
        

        <a href="{{ route('admin.materialcategory.edit', $category) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
            <i class="fas fa-edit"></i>
        </a>

        <a onclick="return confirm('Are you sure?')" href="{{ route('admin.materialcategory.destroy', $category) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" class="btn btn-danger">
        <i class="fas fa-trash"></i>
        </a>
    </div>
 