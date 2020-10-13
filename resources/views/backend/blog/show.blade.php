@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Blog Management')

@section('breadcrumb-links')
    @include('backend.blog.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Blog Management
                    <small class="text-muted">View Blog</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th style="width:350px;">Name</th>
                            <td>{{ $blog->name }}</td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td>{{ $blog->short_description }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! $blog->description !!}</td>
                        </tr>
                        <tr>
                            <th>Tags</th>
                            <td>{{ $blog->tags }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $blog->category->name }}</td>
                        </tr>
                        @if( $blog->image )
                                @php
                                    $image = url('/images/blog/'.$blog->id.'/'.$blog->image);
                                @endphp
                            <tr>
                                <th>Image</th>
                                <td>
                                    <img src="{{ $image }}" style="width:200px" >
                                </td>
                            </tr>
                        @endif
                       
                    </table>
                </div>
            </div><!--table-responsive-->
        </div>
    </div><!--card-body-->

</div><!--card-->
@endsection
