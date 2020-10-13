<ul class="nav tablist" id="listing-type" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link @if($type == 'aggrement') active @endif"  href="{{ route('frontend.pms.project.create.aggrement') }}" >@lang('pms.project.create_from_aggrement')</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link @if($type == 'scratch') active @endif" href="{{ route('frontend.pms.project.create.scratch') }}" >@lang('pms.project.create_from_scratch')</a>
    </li>
</ul>