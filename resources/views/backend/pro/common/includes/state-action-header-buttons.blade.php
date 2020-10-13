<div class="language_button">
<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.state.index') }}?language=2&country_id={{$country}}" class="btn btn-success ml-1 " data-toggle="tooltip" title="@lang('labels.backend.state.state_english')">@lang('labels.backend.state.state_english')</a>
</div>
<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.state.index') }}?language=1&country_id={{$country}}" class="btn btn-success ml-1 " data-toggle="tooltip" title="@lang('labels.backend.state.state_finnish')">@lang('labels.backend.state.state_finnish')</a>
</div>
</div> 
<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.state.create') }}?country_id={{$country}}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')">@lang('labels.backend.state.create_state')</a>
</div>
<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.state.create_state_language') }}?country_id={{$country}}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')">@lang('labels.backend.state.create_state_language')</a>
</div>
 <!--btn-toolbar-->  

