@extends('backend.layouts.app')

@section('title', 'Blog Management' . ' | ' . 'Edit Blog')

@section('breadcrumb-links')
    @include('backend.blog.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->modelForm($blog,'PATCH', route('admin.blog.update',$blog->id))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Blog Management
                        <small class="text-muted">Edit Blog</small>
                    </h4>
                </div>
                <!--col-->
            </div>
            <!--row-->

            <hr>
            <div class="row mt-4 tabination">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <?php $i = 0; ?>
                        @foreach($languages as $language)
                            <a class="nav-item nav-link <?php if ($i == 0) echo 'active'; ?>"
                               id="nav-metrial-{{$language->name}}-tab" data-toggle="tab"
                               href="#nav-metrial-{{$language->lang_code}}" role="tab"
                               aria-controls="nav-metrial-{{$language->name}}"
                               aria-selected="true">{{$language->name}}</a>
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </nav>

                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <?php $i = 0; ?>
                    @foreach($languages as $language)
                        <?php
                        $ide = 'editor-' . $language->lang_code;
                        $shortdescription = $description = $blog_category_id = $name = $tags = $imagen = '';
                        $start_date = $end_date = time();
                        if (isset($data[$language->lang_code])) {
                            $name = $data[$language->lang_code]['name'];
                            $shortdescription = $data[$language->lang_code]['short_description'];
                            $description = $data[$language->lang_code]['description'];
                            $blog_category_id = $data[$language->lang_code]['blog_category_id'];
                            $imagen = $data[$language->lang_code]['image'];
                            $tags = $data[$language->lang_code]['tags'];
                            $read_time = $data[$language->lang_code]['read_time'];
                            $status = $data[$language->lang_code]['status'];
                        }
                        ?>
                        <div class="tab-pane <?php if ($i == 0) echo 'active'; ?>"
                             id="nav-metrial-{{$language->lang_code}}"
                             role="tabpanel" aria-labelledby="nav-nav-metrial-{{$language->name}}-tab">
                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <div class="form-group row">
                                        {{ html()->label('Blog Name')->class('col-md-2 form-control-label')->for('name') }}

                                        <div class="col-md-10">
                                            {{ html()->text('name['.$language->lang_code.']')
                                                ->class('form-control')
                                                ->placeholder('Blog Name')
                                                ->value($name)
                                                ->attribute('maxlength', 191)
                                                ->required()
                                                ->autofocus() }}
                                        </div>
                                        <!--col-->
                                    </div>
                                    <!--form-group-->

                                    <div class="form-group row">
                                        {{ html()->label('Short Description')->class('col-md-2 form-control-label')->for('short_description') }}

                                        <div class="col-md-10">
                                            {{ html()->textarea('short_description['.$language->lang_code.']')
                                                ->class('form-control')
                                                ->value($shortdescription)
                                                ->placeholder('Short Description')
                                                ->required() }}
                                                    <!-- ->attribute('maxlength', 191) -->
                                        </div>
                                        <!--col-->
                                    </div>
                                    <!--form-group-->

                                    <div class="form-group row">
                                        {{ html()->label('Description')->class('col-md-2 form-control-label')->for('description') }}

                                        <div class="col-md-10">
                                            {{ html()->textarea('description['.$language->lang_code.']')
                                                ->class('form-control')
                                                ->id($ide)
                                                ->value($description)
                                                ->placeholder('Description')
                                                ->required() }}
                                                    <!-- ->attribute('maxlength', 191) -->
                                        </div>
                                        <!--col-->
                                    </div>
                                    <!--form-group-->

                                    <div class="form-group row">
                                        {{ html()->label('Tags')->class('col-md-2 form-control-label')->for('tags') }}

                                        <div class="col-md-10">
                                            {{ html()->text('tags['.$language->lang_code.']')
                                                ->class('form-control')
                                                ->value($tags)
                                                ->attribute( 'data-role',"tagsinput")
                                                ->placeholder('Tags')
                                                ->required() }}
                                                    <!-- ->attribute('maxlength', 191) -->
                                        </div>
                                        <!--col-->
                                    </div>
                                    <!--form-group-->
                                    <div class="form-group row">
                                        {{ html()->label('Read time')->class('col-md-2 form-control-label')->for('read_time') }}

                                        <div class="col-md-10">
                                            {{ html()->text('read_time['.$language->lang_code.']')
                                                ->class('form-control')
                                                ->placeholder('Blog read time')
                                                ->value($read_time)
                                                ->required() }}
                                        </div>
                                        <!--col-->
                                    </div>
                                    <!--form-group-->
                                    <div class="form-group row">
                                        {{ html()->label('Blog Category')->class('col-md-2 form-control-label')->for('blog_category_id') }}

                                        <div class="col-md-10">
                                            {{ html()->select('blog_category_id['.$language->lang_code.']',$blogCategory)
                                                ->class('form-control')
                                                ->value($blog_category_id)
                                                ->placeholder('Blog Category')
                                                ->required() }}
                                                    <!-- ->attribute('maxlength', 191) -->
                                        </div>
                                        <!--col-->
                                    </div>
                                    <!--form-group-->
                                    <div class="form-group row">
                                        {{ html()->label('Cover Image')->class('col-md-2 form-control-label')->for('image') }}

                                        <div class="col-md-10">
                                            @if(isset($imagen) && $imagen != '' )
                                                @php
                                                $image = url('/images/blog/'.$blog->id.'/'.$imagen);
                                                @endphp
                                                <span>
                                        <img src="{{ $image }}" style="width:250px" alt="Propert picture">
                                    </span>
                                                @endif
                                                {{ html()->file('image['.$language->lang_code.']')
                                                    ->class('form-control')
                                                    ->required() }}
                                                        <!-- ->attribute('maxlength', 191) -->
                                        </div>
                                        <!--col-->
                                    </div>
                                    <!--form-group-->
                                    <div class="form-group row">

                                        {{html()->label('Status')->class('col-md-2 form-control-label')->for('status') }}
                                        <div class="col-md-10">
                                            {{
                                                html()->select('status['.$language->lang_code.']', 
                                                    [
                                                        'Publish' => 'Publish',
                                                        'UnPublish' => 'UnPublish'
                                                    ])->class('form-control')
                                                    ->value($status)
                                                    ->id('status')
                                                    ->required()
                                            }}
                                        </div><!--col-->
                                    </div><!--form-group-->

                                </div>
                                <!--col-->
                            </div>
                            <!--row-->
                        </div>
                        <?php $i++; ?>
                    @endforeach
                </div>
                <!--card-body-->
            </div>
            <!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.blog.index'), __('buttons.general.cancel')) }}
                    </div>
                    <!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div>
                    <!--col-->
                </div>
                <!--row-->
            </div>
            <!--card-footer-->
        </div>
        <!--card-->
        {{ html()->form()->close() }}
        @endsection

        @push('after-styles')
        {{ style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css') }}
        <style>
            .bootstrap-tagsinput .tag {
                background: darkblue;
                padding: 3px;
                border-radius: 5px;
            }

            .bootstrap-tagsinput .tag {
                background: darkblue;
                padding: 3px;
                border-radius: 5px;
            }

            form.form-horizontal {
                width: 100%;
            }

            .tabination nav, .tabination .tab-pane {
                width: 100%;
            }

            .tabination nav > .nav.nav-tabs {
                border: none;
                color: #fff;
                background: #272e38;
                border-radius: 0;

            }

            .tabination nav > div a.nav-item.nav-link {
                border: none;
                padding: 18px 25px;
                color: #fff;
                background: #272e38;
                border-radius: 0;
            }

            .tabination nav > div a.nav-item.nav-link.active {
                background: #e74c3c;
            }

            .tabination .tab-content {
                background: #fdfdfd;
                width: 100%;
                line-height: 25px;
                border: 1px solid #ddd;
                border-top: 5px solid #e74c3c;
                border-bottom: 5px solid #e74c3c;
            }

            .tabination nav > div a.nav-item.nav-link:hover,
            .tabination nav > div a.nav-item.nav-link:focus {
                border: none;
                background: #e74c3c;
                color: #fff;
                border-radius: 0;
                transition: background 0.20s linear;
            }
        </style>
        @endpush

        @push('after-scripts')
        {!! script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js') !!}
        {!! script('ckeditor_4.14.0_full/ckeditor.js') !!}

        <?php foreach($languages as $language){ ?>
        <style>
            #editor-<?= $language->lang_code ?>  {
                min-height: 200px;
            }
        </style>
        <script>
            const editerId = 'editor-<?= $language->lang_code ?>';
            CKEDITOR.filter.disabled = true;
            if (CKEDITOR.instances[editerId]) {
                CKEDITOR.remove(CKEDITOR.instances[editerId]);
            }
           //const CKEditorFuncNum = window.CKEDITOR.instances.ckeditor._.filebrowserFn;

            CKEDITOR.replace(editerId,{
                allowedContent:true,
                autoParagraph: false,
                entities:false,
                extraAllowedContent:['i'],
                filebrowserUploadMethod:'form',

                // filebrowserBrowseUrl: '/apps/ckfinder/3.4.5/ckfinder.html',
                // filebrowserUploadUrl: '/apps/ckfinder/3.4.5/core/connector/php/connector.php?command=QuickUpload&type=Files',
                //filebrowserImageBrowseUrl: '/ckfinder/browse.php?type=Images',
                //filebrowserUploadUrl: '/ckfinder/upload.php?command=QuickUpload&type=Images&CKEditorFuncNum=1'
                filebrowserUploadUrl: '/admin/request/upload_image?command=QuickUpload&type=Images&CKEditor='+editerId+'&CKEditorFuncNum=1'
            });

            // ClassicEditor.create( document.querySelector( '#editor-<?= $language->lang_code ?>' ) )
            //         .then( editor => {
            //     console.log( editor );
            // } )
            // .catch( error => {
            //     console.error( error );
            // } );

        </script>
        <?php } ?>
    @endpush