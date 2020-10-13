<div class="language_button">
<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.workphase.index') }}?language=2&area_id={{$workarea}}" class="btn btn-success ml-1 " data-toggle="tooltip" title="@lang('labels.backend.workphase.workphase_english')">@lang('labels.backend.workphase.workphase_english')</a>
</div>
<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.workphase.index') }}?language=1&area_id={{$workarea}}" class="btn btn-success ml-1 " data-toggle="tooltip" title="@lang('labels.backend.workphase.workphase_finnish')">@lang('labels.backend.workphase.workphase_finnish')</a>
</div>
</div> 
<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.workphase.create') }}?area_id={{$workarea}}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')">@lang('labels.backend.workphase.create_workphase')</a>
</div>
<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.workphase.create_workphase_language') }}?area_id={{$workarea}}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')">@lang('labels.backend.workphase.create_workphase_language')</a>
</div>
 <!--btn-toolbar-->  

