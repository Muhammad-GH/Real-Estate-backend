<!-- @extends('backend.layouts.app') -->

@section('title', app_name() . ' | ' . 'Rooms Popup Data')

@section('breadcrumb-links')
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Rooms Popup Data
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
                        All Rooms Popup Data
                    </h4>
                </div><!--col-->
                <div class="col-sm-7">
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Room</th>
                                <th>Work Type</th>
                                <th>Type</th>
                                <th>Message</th>
                                <th>Created On</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roomsData as $roomData)
                                <tr>
                                    <td><?= $roomData->room->name ?></td>
                                    <td><?php if($roomData->work_type == 1){ echo 'Work'; }elseif($roomData->work_type == 2){echo'Material';}  ?></td>
                                    <td><?php if($roomData->msgtype == 1){ echo 'Basic'; }elseif($roomData->msgtype == 2){echo'Exclusive';}  ?></td>
                                    <td>
                                        @if($roomData->content != '' && $roomData->type == 2)
                                            @php
                                            $image = url('/images/rooms-data/'.$roomData->content);
                                            @endphp
                                            <span>
                                                <img src="{{$image }}"  alt="Propert picture" style='width:150px;height:100px;'>
                                            </span>
                                        @endif
                                        @if($roomData->type == 1)
                                            {{ $roomData->content }}
                                        @endif
                                    </td>
                                    <td>{{ $roomData->created_at }}</td>
                                    <td><div class="btn-group" role="group" aria-label="User Actions">
                                            <a href="{{ route('admin.roomsdata.edit',$roomData->id ) }}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-primary" data-original-title="Update">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{--<a href="{{ route('admin.roomsdata.destroy', $roomData->id) }}" data-method="get" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>--}}
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
                        {!! $roomsData->count() !!} {{ trans_choice( 'total| total', $roomsData->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $roomsData->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
