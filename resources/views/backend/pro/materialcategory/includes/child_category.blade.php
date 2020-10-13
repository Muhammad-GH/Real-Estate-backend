<tr>
    <td> @php echo str_repeat('-->', $level);  @endphp {{ $child_category->name }}</td>
     
    <td>@include('backend.pro.materialcategory.includes.actions', ['category' => $childCategory])</td>
</tr>
 

@if (count($child_category->categories))
    @php
    $level++;
    @endphp      
    
    @foreach ($child_category->categories as $childCategory)
        @include('backend.pro.materialcategory.includes.child_category', ['child_category' => $childCategory,'level' => $level ])
    @endforeach 
    
    @php
    $level--; 
    @endphp 
@endif
