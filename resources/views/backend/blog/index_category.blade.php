<!-- @extends('backend.layouts.app') -->

@section('title', app_name() . ' | ' . 'Blog Management')

@section('breadcrumb-links')
    @include('backend.blog.includes.categorybreadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Blog Category Management <small class="text-muted">Active Blog Category</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.blog.includes.categoryheader-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Category Details</th>
                            <th>Created</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blogCategory as $blog_category)
                            <tr>
                                <td>{{ $blog_category->name }}</td>
                                <td>{{ $blog_category->details }}</td>
                                <td>{{ $blog_category->created_at->diffForHumans() }}</td>
                                <td>@include('backend.blog.includes.categoryactions', ['blog_category' => $blog_category])</td>
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
                    {!! $blogCategory->total() !!} {{ trans_choice('Blog Category total|Blog Category Properties total', $blogCategory->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $blogCategory->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
