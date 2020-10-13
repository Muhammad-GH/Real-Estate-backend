@extends('pms.layout.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
    @if( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->view_project) )
        <div class="container-fluid">
            <div class="search-box">
                {{ html()->form('GET', route('frontend.pms.project'))->id('fk-pro-search_project')->open() }} 	
                    <div class="search">
                        <div class="form-group">
                            {{ html()->text('search')
                                    ->placeholder(__('pms.project.search'))
                                    ->class('form-control')
                                    ->attribute('type', 'text')
                                    ->value($searchValue)
                            }}
                            <button type="submit" ><i class="icon-search"></i></button>
                        </div>
                    </div>
                {{ html()->form()->close() }}
                <!-- <div class="search-filter">
                    <div class="form-group">
                        <select class="form-control">
                            <option>Filter</option>
                            <option>Filter</option>
                            <option>Filter</option>
                        </select>
                    </div>
                </div> -->
            </div>
            <div class="card">
                <div class="card-body">
                    @if(count($recentProject) > 99999999)
                    <h3 class="head3">@lang('pms.project.recent')</h3>
                    @endif
                    <div style="max-width: 1000px">
                        @if(count($recentProject) > 99999999)
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="card project-card">
                                    <div class="card-header">
                                        <h4>Project name</h4>
                                    </div>
                                    <div class="card-body">
                                        <p>Bathroom construction</p>
                                        <p class="date">Started at 24/12/202</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="card project-card">
                                    <div class="card-header">
                                        <h4>Project name</h4>
                                    </div>
                                    <div class="card-body">
                                        <p>Bathroom construction</p>
                                        <p class="date">Started at 24/12/202</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12">
                                <div class="card project-card">
                                    <div class="card-header">
                                        <h4>Project name</h4>
                                    </div>
                                    <div class="card-body">
                                        <p>Bathroom construction</p>
                                        <p class="date">Started at 24/12/202</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>@lang('pms.project.project_name')</th>
                                        <th>@lang('pms.project.keyname')</th>
                                        <th>@lang('pms.project.lead')</th>
                                        <th>@lang('pms.project.status')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($projects) > 0)
                                        @foreach($projects as $project)
                                            <tr>
                                                <td data-label="Project Name: {{ $project->name }}">
                                                    <a class="dropdown-item" href="{{ route('frontend.pms.project.view', $project->id ) }}" >
                                                        {{ $project->name }}
                                                    </a>
                                                </td>
                                                <td data-label="Keyname: {{ $project->key_name }}">{{ $project->key_name }}</td>
                                                <td data-label="Lead: ">
                                                    <a class="profile" href="javascript:void(0);" >
                                                    @php
                                                        $image = url('/images/dummy-user.png');
                                                        
                                                        if($project->resource && $project->resource->photo){
                                                            $image = url('/images/resources/'.$project->resource->id.'/'.$project->resource->photo);
                                                        }
                                                    @endphp
                                                        <img src="{{ $image }}">
                                                        <span>{{ ($project->resource && $project->resource->first_name)?$project->resource->first_name:$project->user->first_name }} {{ ($project->resource && $project->resource->last_name)?$project->resource->last_name:$project->user->last_name }}</span>
                                                    </a>
                                                </td>
                                                <td data-label="Keyname: {{ $project->status }}">@lang("pms.project.labels.status.{$project->status}")</td>
                                                <td class="action">
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle no-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-dots-three-horizontal"></i>
                                                        </a>
                                                        <div class="dropdown-menu" x-placement="top-Leadstart" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(15px, 1px, 0px);">
                                                            <a class="dropdown-item" href="{{ route('frontend.pms.project.view', $project->id ) }}" >@lang('pms.project.labels.view')</a>
                                                            @if( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->edit_project) )
                                                                <a class="dropdown-item" href="{{ route('frontend.pms.project.edit', $project->id ) }}" >@lang('pms.project.labels.edit')</a>
                                                                <a class="dropdown-item deleteProject" href="{{ route('frontend.pms.project.delete', $project->id ) }}" >@lang('pms.project.labels.delete')</a>
                                                            @endif
                                                            @if( $project->released_date == null && ( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->planning_project) ) )
                                                                <a class="dropdown-item" href="{{ route('frontend.pms.project.planning', $project->id ) }}" >@lang('pms.project.labels.project_planning')</a>
                                                            @endif
                                                            
                                                                <a class="dropdown-item" href="{{ route('frontend.pms.project.gantt',['project_id'=> $project->id] ) }}" >@lang('pms.project.labels.gantt_chart_view')</a>
                                                            
                                                            @if( $project->released_date == null && auth()->guard('pro')->check() )
                                                                <a class="dropdown-item summary_project" data-id="{{ $project->id }}" href="{{ route('frontend.pms.project.summary',['project_id'=> $project->id] ) }}" >@lang('pms.project.labels.summary_project')</a>
                                                                <a class="dropdown-item chat_project" data-id="{{ $project->id }}" href="{{ route('frontend.pms.chat.index',['project_id'=> $project->id] ) }}" >@lang('pms.project.labels.chat_project')</a>
                                                                <a class="dropdown-item close_project" data-id="{{ $project->id }}" href="{{ route('frontend.pms.project.gantt',['project_id'=> $project->id] ) }}" >@lang('pms.project.labels.close_project')</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan=4 style="text-align:center" >@lang('pms.messages.no_record')</td>
                                        </tr>
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br><br><br><br>
                    <br><br><br><br>
                    <br><br><br><br>
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade closeProjectModal" id="closeagreement" tabindex="-1" role="dialog" aria-labelledby="closeAgreementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="closeAgreementModalLabel">Edit Business Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ html()->form('POST', route('frontend.pms.project.clouser'))->class('fk-pro-clouser')->open() }}
                        {{ html()->hidden('project_id') }}
                                
                        <div class="form-group">
                            {{ html()->label(__('pms.project.labels.closing_reason'))->for('reason') }}
                            {{ html()->text('reason')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.labels.closing_reason'))->required() }}
                            <!--<small class="form-text text-muted">
                                eg sub contractors, material supplier, team etc
                            </small>-->
                        </div>
                        <div class="form-group">
                            <label>@lang('pms.project.labels.rate_text')</label>
                            <div class='rating-stars'>
                                <ul class="starsList">
                                    <li class='star' title='Poor' data-value='1'>
                                        <i class='icon-star-full'></i>
                                    </li>
                                    <li class='star' title='Fair' data-value='2'>
                                        <i class='icon-star-full'></i>
                                    </li>
                                    <li class='star' title='Good' data-value='3'>
                                        <i class='icon-star-full'></i>
                                    </li>
                                    <li class='star' title='Excellent' data-value='4'>
                                        <i class='icon-star-full'></i>
                                    </li>
                                    <li class='star' title='WOW!!!' data-value='5'>
                                        <i class='icon-star-full'></i>
                                    </li>
                                </ul>
                                <span class="count"><span>0</span>/5</span>
                                {{ html()->hidden('rating') }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ html()->label(__('pms.project.labels.message_contractor'))->for('message') }}
                            {{ html()->text('message')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.labels.message_contractor'))->required() }}
                        </div>
                        <div class="form-group">
                            {{ html()->label(__('pms.project.labels.feedback'))->for('feedback') }}
                            {{ html()->text('feedback')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.project.labels.feedback'))->required() }}
                        </div>
                        <button type="submit" class="btn btn-outline-secondary mt-3">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
            

@endsection

@push('after-scripts')

    <script>
        $(document).ready(function(){
            $(document).on('click','.deleteProject', function(e){
                var url = $(this).attr('href');
                e.preventDefault();
                Swal.fire({
                    title: "@lang('pms.project.swal.delete_title')",
                    text: "@lang('pms.project.swal.delete_text')",
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: "@lang('pms.project.swal.cancel_button_text')",
                    confirmButtonText: "@lang('pms.project.swal.confirm_button_text')"
                }).then((result) => {
                    if (result.value) {
                        showLoader();
                        window.location.href = url;
                    }
                })
            });

            $(document).on('click','a.close_project',function(e){
                e.preventDefault();
                var dataId = $(this).attr('data-id');
                $(document).find('.closeProjectModal').modal('show');
                $(document).find('.closeProjectModal').find('[name=project_id]').val(dataId);
            });

            $(document).find('.fk-pro-clouser').validate({
                rules: {
                    reason: { required: true} ,
                    message: { required: true} ,
                    feedback: { required: true}
                },
                messages: {
                    reason: { required: "@lang('pms.validaion.required.name')" },
                    message: { required: "@lang('pms.validaion.required.name')"},
                    feedback: { required: "@lang('pms.validaion.required.name')"}
                }
                // ,
                // submitHandler: function (form) {
                //     var data = $(document).find('.fk-pro-clouser').serialize();
                //     var urlUpdate =  $(document).find('.fk-pro-clouser').attr('action');
                    
                //     $.ajax({
                //         type:'POST',
                //         url: urlUpdate,
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         },
                //         data: data,
                //         contentType: false,
                //         processData: false,
                //         success:function(result){
                //             if(result.status){
                //                 getTask();
                //                 getBacklogTask();
                //                 $(document).find('.project-rightbar').show().html('');
                //                 Swal.fire({
                //                     "title":"@lang('pms.project.messages.success')",
                //                     "html":"@lang('pms.project.messages.success_task_update')",
                //                     "type":"success",
                //                     "showConfirmButton":true,
                //                     "showCloseButton":true,
                //                     "allowEscapeKey":true,
                //                     "allowOutsideClick":true
                //                 });

                //             }  
                //         }
                //     });
                // }
            });


            if ($(".starsList").length) {
                $(".starsList li")
                .on("mouseover", function () {
                    var onStar = parseInt($(this).data("value"), 10); // The star currently mouse on
                    // Now highlight all the stars that's not after the current hovered star
                    $(this)
                    .parent()
                    .children("li.star")
                    .each(function (e) {
                        if (e < onStar) {
                        $(this).addClass("hover");
                        } else {
                        $(this).removeClass("hover");
                        }
                    });
                })
                .on("mouseout", function () {
                    $(this)
                    .parent()
                    .children("li.star")
                    .each(function (e) {
                        $(this).removeClass("hover");
                    });
                });

                /* 2. Action to perform on click */
                $(".starsList li").on("click", function () {
                var onStar = parseInt($(this).data("value"), 10); // The star currently selected
                var stars = $(this).parent().children("li.star");
                var count = 0;
                for (let i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass("selected");
                }

                for (let i = 0; i < onStar; i++) {
                    $(stars[i]).addClass("selected");
                    count += $(stars[i]).length;
                    $(".starsList").next(".count").find("span").text(count);
                    $(".starsList").next(".count").find("._rating").val(count || 0);
                    $(".starsList").closest("div").find("[name=rating]").val(count || 0);
                }

                // JUST RESPONSE (Not needed)
                var ratingValue = parseInt(
                    $(".starsList li.selected").last().data("value"),
                    10
                );
                });
            }

            
        });
    </script>
@endpush