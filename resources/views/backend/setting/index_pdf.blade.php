<!-- @extends('backend.layouts.app') -->

@section('title', app_name() . ' | ' . 'Setting Management')

@section('breadcrumb-links')
    @include('backend.setting.includes.pdfbreadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    PDF Management <small class="text-muted">Active Form PDF</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.setting.includes.pdfheader-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Page</th>
                            <th>PDF</th>
                            <th>Created</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pdf  as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->page }}</td>
                                <td>
                                @if( $data->document )
                                    @php
                                        $image = url('/images/pdf/'.$data->id.'/'.$data->document);
                                    @endphp
                                    <a href="{{ $image }}" target="_blank" class="btn">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                @endif
                                </td>
                                <td>{{ $data->created_at->diffForHumans() }}</td>
                                <td>@include('backend.setting.includes.pdfactions', ['pdf' => $data])</td>
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
                    {!! $pdf->total() !!} {{ trans_choice('PDF total|PDF total', $pdf->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $pdf->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
