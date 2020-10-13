@extends('frontend.layouts.others')
@section('title',__('meta_title_blog'))
@section('meta_description', __('meta_description_blog') )
@section('meta_image',   url('images/meta/blog-bg.jpg')  )


@section('content')
 

<style>
    ul.blog-list li.active a {
        text-decoration: underline;
        color: #000;
    }
</style>
 <div class="banner">
        <img class="d-none d-sm-block" src="{{ url('images/blog-bg.jpg') }}">
        <img class="d-block d-sm-none" src="{{ url('images/blogi-mobi.jpg') }}">
        <div class="content">
            <h1>
                <span>Tuoreita Ajatuksia Asuntomarkkinoilta</span>
            </h1>
        </div>
    </div>
    <section class="blog-page">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="blog-list">
                        <li <?php if(empty($category)) echo'class="active"'; ?>><a href="javascript:void(0)" onclick="filterblog(this,'{{ route('frontend.blog') }}')"><b>Kaikki</b></a></li>
                        @foreach($blogCategory as $b_category)
                            <li <?php if(!empty($category) && $category->id == $b_category->id) echo'class="active"'; ?>><a href="javascript:void(0)" onclick="filterblog(this,'{{ route('frontend.blog.category',$b_category->slug) }}' );">{{$b_category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col" id="bloglist">
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
                        {{ $blog->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog main html end here -->
    <script>
       function filterblog(obj,url){
             $(obj).parents('ul').find('li.active').removeClass('active');
            $.ajax({
                url: url,
                success:function(response){
                    $('#bloglist').html(response);
                    $(obj).parent('li').addClass('active');
                },
                error:function(){
                    showToastNotification('error', "{{__('Something went wrong.')}}");
                }
            });
        }
    </script>
@endsection
@push('after-scripts');
<script>
    if(window.location.search.substring(1) !=''){
        $('html, body').animate({
            'scrollTop' : $(".blog-page").position().top
        });   
    }
</script>
@endpush
