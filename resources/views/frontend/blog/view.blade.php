@extends('frontend.layouts.others')

@section('title',   $blog->name  )
@section('meta_description', $blog->short_description )
@php
        $image = url('/img/frontend/slider_1img.png');
        if(isset($blog->image) &&!empty($blog->image) && file_exists(public_path().'/images/blog/'.$blog->id.'/'.$blog->image)){
            $image = url('/images/blog/'.$blog->id.'/'.$blog->image);
        }
    @endphp
    
@section('meta_image',   $image  )
@section('content')

    

  <section class="blog-details">
        <div class="container">
            <div class="head">
                <h2>{{ $blog->name }}</h2>
                <div class="meta">
                    <a href="{{ route('frontend.blog',['category'=>$blog->category->slug]) }}">{{ $blog->category->name }}</a>
                    <a>{{ $blog->read_time }}</a>
                    <a>{{ date('d.m.Y', strtotime($blog->updated_at))}}</a>
                </div>
            </div>
            <div class="content">
                <img src="{{$image}}">
                <p>{{ $blog->short_description }}</p>
                {!! $blog->description !!}
                
                <div class="social-share">
                    <h4>Jaettu ilo on kaksinkertainen ilo!</h4>
                    <div class="icons">
                        <a href="http://www.facebook.com/sharer.php?u={{ route('frontend.blog.view',$blog->id) }}"><i class="icon-facebook"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ route('frontend.blog.view',$blog->id) }}&text={{ $blog->name }}&via={{ route('frontend.blog.view',$blog->id) }}&hashtags={{ $blog->short_description }}"><i class="icon-twitter"></i></a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('frontend.blog.view',$blog->id) }}&title={{ $blog->name }}&summary={{ $blog->short_description }}&source={{ route('frontend.blog.view',$blog->id) }}"><i class="fa fa-linkedin"></i></a>
                        <a href="mailto:?subject={{ $blog->name }}'&body={{ route('frontend.blog.view',$blog->id) }}"><i class="icon-envelope"></i></a>
                        <a href="https://plus.google.com/share?url={{ route('frontend.blog.view',$blog->id) }}"><i class="icon-google-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('after-scripts')
<!-- <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5dca8acd19440c0012abd51d&product=inline-share-buttons" async="async"></script> -->
@endpush