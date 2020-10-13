@extends('pms.layout.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
    @if( auth()->guard('pro')->check()  || ( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->edit_project) )
    <div class="container">
        <h3 class="head3">@lang('pms.project.create_project')</h3>
        <div class="card">
            <div class="card-body">
                @include('pms.project.partials.create_header')
                <div class="tab-content" id="type-tabContent">
                    <div class="tab-pane fade show active" id="proposal" role="tabpanel" aria-labelledby="proposal">
                        <div class="modal-dialog modal-lg modal-visible">
                            <div class="modal-content">
                                <div class="modal-body">
                                    {{ html()->form('POST', route('frontend.pms.project.create.aggrement_submit'))->id('fk-pro-create_project')->open() }} 		
                                    <div class="form-group">
                                        {{ html()->label(__('pms.project.labels.select_aggrement'))->for('select-aggrement') }}
                                        <select id="select-aggrement" name="aggrement_id" class="form-control">
                                            <option value="" >@lang('pms.project.labels.select_aggrement')</option>
                                            @foreach($aggrements as $aggrement)
                                                <option value="{{ $aggrement->agreement_id }}" >
                                                    ID: {{ $aggrement->agreement_id }},  
                                                    Email: {{ $aggrement->emails }}, 
                                                    Dated: {{ $aggrement->date }}
                                                </option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    <div class="form-group">
                                        {{ html()->label(__('pms.project.name'))->for('name') }}
                                        {{ html()->text('name')
                                            ->placeholder(__('pms.project.name'))
                                            ->class('form-control')
                                            ->attribute('maxlength', 191)
                                            ->required() }}
                                    </div>
                                    <div class="form-group">
                                        {{ html()->label(__('pms.project.key_name'))->for('key_name') }}
                                        {{ html()->text('key_name')
                                            ->placeholder(__('pms.project.key_name'))
                                            ->class('form-control')
                                            ->attribute('maxlength', 191)
                                            ->required() }}
                                        
                                    </div>
                                    <button type="submit" class="btn btn-blue">@lang('pms.project.create')</button>
                                    {{ html()->form()->close() }}
                                    <br><br><br>
                                </div>
                            </div>
                        </div>
                        <br><br><br><br><br>
                        <br><br><br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
@push('after-scripts')
<script>
$(document).ready(function(){
    $('#fk-pro-create_project').validate({
        rules: {
            aggrement_id: { required: true },
            name: { required: true, minlength: 5},
            key_name: { required: true, minlength: 5}
        },
        messages: {
            aggrement_id: { required: "@lang('pms.validaion.required.aggrement')" },
            name: { required: "@lang('pms.validaion.required.name')",  minlength : "@lang('pms.validaion.invalid.min_length',['min_len'=>5])" },
            key_name: { required: "@lang('pms.validaion.required.name')",  minlength : "@lang('pms.validaion.invalid.min_length',['min_len'=>5])" }
        }
    });
});
</script>
@endpush