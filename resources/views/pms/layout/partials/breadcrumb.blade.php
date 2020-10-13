@if(isset($breadcrumb) && !empty($breadcrumb))
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($breadcrumb as $key => $crumb)
        <li class="breadcrumb-item @if($key+1 == count($breadcrumb)) active @endif " 
            @if($key+1 == count($breadcrumb))  aria-current="page" @endif>
            @if($crumb['route'])
                <a href="{{ route($crumb['route']) }}" >{{ $crumb['name'] }}</a>
            @else
                {{ $crumb['name'] }}
            @endif
        </li>
        @endforeach
    </ol>
</nav>
@endif