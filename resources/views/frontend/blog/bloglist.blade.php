<div class="blog-grid">
    @if(count($blog) > 0)
     @foreach($blog as $blogdata)
    <div class="item">
       
            @php
                $image = url('/img/frontend/slider_1img.png');
                if(isset($blogdata->image) && !empty($blogdata->image) && file_exists(public_path().'/images/blog/'.$blogdata->id.'/'.$blogdata->image)){
                
                    $image = url('/images/blog/'.$blogdata->id.'/'.$blogdata->image);
                }
            @endphp
        <div class="img-box">
            <a href="{{ route('frontend.blog.view',$blogdata->slug) }}"><img src="{{$image}}"></a>
        </div>
        <div class="info">
            <a href="{{ route('frontend.blog.view',$blogdata->slug) }}"><h3>{{ $blogdata->name}}</h3></a>
            <p>{{  (strlen($blogdata->short_description) > 90 ? substr($blogdata->short_description,0,90)."..." : $blogdata->short_description) }}</p>
            <span class="date">{{ date('d.m.Y', strtotime($blogdata->updated_at))}} </span>
        </div>
        
    </div>
    @endforeach
    {{ $blog->links()}}
    @else
    <div class="item">
        <h3>No Blogs found!</h3>
    </div>
    @endif
</div>