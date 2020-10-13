@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.backend.materialcategory.management'))

@section('breadcrumb-links')
    @include('backend.pro.materialcategory.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('labels.backend.materialcategory.management') }} 
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.pro.materialcategory.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.materialcategory.table.name')</th>
                             
                         
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>  
                        @foreach($category as $categories)
                            <tr>
                                <td>{{ $categories->name }}</td>
                                
                                <td>@include('backend.pro.materialcategory.includes.actions', ['category' => $categories])</td>
                            </tr>
                           
                            
                            @foreach ($categories->categories as $childCategory)
                                
                                @include('backend.pro.materialcategory.includes.child_category', ['child_category' => $childCategory,'level'=>1,'pre_level'=>1])
                            @endforeach
                         
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    <!-- {!! $category->total() !!} {{ trans_choice('labels.backend.category.table.total', $category->total()) }} -->
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $category->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
