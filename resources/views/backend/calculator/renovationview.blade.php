<?php
$title = 'Renovation Submissions';
$name = $renovationData->name;
if ($renovationData->type == 2) {
    $title = 'Flip Submissions';
    $name = $renovationData->email;
}
?>
@extends('backend.layouts.app')
@section('title', app_name() . ' | ' . $title)

@section('breadcrumb-links')
    @include('backend.setting.includes.breadcrumb-calculator-link')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="card-title mb-0">
                        <?= $title ?> Deatils : <?= $name ?>
                    </h4>
                </div>
                <!--col-->
            </div>
            <!--row-->
            <div class="row p-class">
                <div class="col-sm-12" style="margin-top:20px;">
                    <?= $renovationData->content ?>
                    <p style="padding-left: 20px;color: #5f5f5f; line-height: 1.6;">Submission on <b><?=  $renovationData->created_at  ?> </b></p>
                </div>
                <!--col-->
            </div>
            <!--row-->
        </div>
        <!--card-body-->
    </div><!--card-->
@endsection

<style>
    .row.p-class p {
        padding-left: 20px;
        color: #5f5f5f;
        line-height: 1.6;
    }
</style>
