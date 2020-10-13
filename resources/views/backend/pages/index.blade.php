<!-- @extends('backend.layouts.app') -->

@section('title', app_name() . ' | ' . 'Renovation Data')

@section('breadcrumb-links')
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Pages
                </a>
            </div><!--dropdown-->
            <!--<a class="btn" href="#">Static Link</a>-->
        </div><!--btn-group-->
    </li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        All Pages
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Add Page">
                            <i class="fas fa-plus-circle"></i> Add New Page
                        </a>
                    </div><!--btn-toolbar-->
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Banner Title</th>
                                <th>Banner</th>
                                <th>Updated On</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->name }}</td>
                                    <td><?= $page->banner_title ?></td>
                                    <td>@if(isset($page->banner) &&!empty($page->banner))
                                            @php
                                            $image = url('/images/pages/'.$page->banner);
                                            @endphp
                                            <span>
                                                <img src="{{ $image }}"  alt="Propert picture" style='width:150px;height:100px;'>
                                            </span>
                                        @endif</td>
                                    <td>{{ $page->created_at }}</td>
                                    <td><div class="btn-group" role="group" aria-label="User Actions">
                                            <a href="{{ route('admin.pages.edit',$page->id ) }}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-primary" data-original-title="View">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
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
                        {!! $pages->count() !!} {{ trans_choice( 'total| total', $pages->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $pages->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
