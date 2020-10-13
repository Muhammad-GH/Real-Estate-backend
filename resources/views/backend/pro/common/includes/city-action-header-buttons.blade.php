<div class="language_button">
<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.city.index') }}?language=2&state_id={{$state}}" class="btn btn-success ml-1 " data-toggle="tooltip" title="@lang('labels.backend.city.city_english')">@lang('labels.backend.city.city_english')</a>
</div>
<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.city.index') }}?language=1&state_id={{$state}}" class="btn btn-success ml-1 " data-toggle="tooltip" title="@lang('labels.backend.city.city_finnish')">@lang('labels.backend.city.city_finnish')</a>
</div>
</div> 
<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.city.create') }}?state_id={{$state}}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')">@lang('labels.backend.city.create_city')</a>
</div>
<div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
    <a href="{{ route('admin.city.create_city_language') }}?state_id={{$state}}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')">@lang('labels.backend.city.create_city_language')</a>
</div>
 <!--btn-toolbar-->  

