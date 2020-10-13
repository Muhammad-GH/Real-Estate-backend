<!-- @extends('backend.layouts.app') -->

@section('title', app_name() . ' | ' . 'Jobs')

@section('breadcrumb-links')
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Jobs
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
                        All Jobs
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                        <a href="{{ route('admin.jobs.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="Add Page">
                            <i class="fas fa-plus-circle"></i> Add New Job
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
                                <th>Job Title</th>
                                <th>No. of Vacancies</th>
                                <th>Department</th>
                                <th>Location</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $job->title }}</td>
                                    <td><?= $job->vacancy ?></td>
                                    <td><?= ($job->department)?$job->department->department_name:''?></td>
                                    <td><?= $job->location ?></td>
                                    <td><?= date("d-m-Y",$job->start_date) ?></td>
                                    <td><?= date("d-m-Y",$job->end_date) ?></td>
                                    <td><?php if($job->status == 1){ echo'Active';}else{ echo'Inactive';} ?></td>
                                    <td>{{ $job->created_at }}</td>
                                    <td><div class="btn-group" role="group" aria-label="User Actions">
                                            <a href="{{ route('admin.jobs.edit',$job->id ) }}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-primary" data-original-title="Update">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.jobs.destroy', $job->id) }}" data-method="get" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
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
                        {!! $jobs->count() !!} {{ trans_choice( 'total| total', $jobs->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $jobs->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
