<tr>
    <td> @php echo str_repeat('-->', $level);  @endphp {{ $child_category->name }}</td>
     
</tr>
 

@if (count($child_category->categories))
    @php
    $level++;
    @endphp      
    
    @foreach ($child_category->categories as $childCategory)
        @include('backend.pro.category.includes.child_category_html', ['child_category' => $childCategory,'level' => $level ])
    @endforeach 
    
    @php
    $level--; 
    @endphp 
@endif
