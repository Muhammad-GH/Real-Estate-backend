<!-- @extends('backend.layouts.app') -->

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
                    Blog Management <small class="text-muted">Active Blogs</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.blog.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Blog Name</th>
                            <th>Short Description</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blog as $blogData)
                            <tr>
                                <td>{{ $blogData->name }}</td>
                                <td>{{ $blogData->short_description }}</td>
                                <td>{{ $blogData->category ? $blogData->category->name  : '' }}</td>
                                <td>
                                    @if($blogData->status == 'Publish' )
                                        <a href="{{ route('admin.blog.changestatus', [$blogData->id,'UnPublish']) }}"  class="btn btn-primary">
                                            {{ $blogData->status }}
                                        </a>
                                    @else
                                        <a href="{{ route('admin.blog.changestatus', [$blogData->id,'Publish']) }}" class="btn btn-danger">
                                            {{ $blogData->status }}
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $blogData->created_at->diffForHumans() }}</td>
                                <td>@include('backend.blog.includes.actions', ['blog' => $blogData])</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $blog->total() !!} {{ trans_choice('Blogs total|Blog total', $blog->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $blog->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
