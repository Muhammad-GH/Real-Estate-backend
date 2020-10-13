@extends('pms.layout.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="page-content">
    <div class="container">
        <h3 class="head3">Mybusiness Dashboard</h3>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="card db-card">
                    <div class="card-header">
                        <h4><i class="icon-edit-file"></i>Proposals <span class="badge badge-light">10</span></h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Open <span class="badge badge-light">60</span></li>
                            <li>Old <span class="badge badge-light">40</span></li>
                            <li>Expired <span class="badge badge-light">20</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="card db-card">
                    <div class="card-header">
                        <h4><i class="icon-materials"></i>Agreements <span class="badge badge-light">15</span></h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Open <span class="badge badge-light">60</span></li>
                            <li>Old <span class="badge badge-light">40</span></li>
                            <li>Expired <span class="badge badge-light">20</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="card db-card">
                    <div class="card-header">
                        <h4><i class="icon-work"></i>Projects <span class="badge badge-light">10</span></h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Open <span class="badge badge-light">60</span></li>
                            <li>Old <span class="badge badge-light">40</span></li>
                            <li>Expired <span class="badge badge-light">20</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="card db-card">
                    <div class="card-header">
                        <h4><i class="icon-jobs"></i>Billing <span class="badge badge-light">15</span></h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Open <span class="badge badge-light">60</span></li>
                            <li>Old <span class="badge badge-light">40</span></li>
                            <li>Expired <span class="badge badge-light">20</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="card db-card">
                    <div class="card-header">
                        <h4><i class="icon-work"></i>Resources <span class="badge badge-light">15</span></h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Open <span class="badge badge-light">60</span></li>
                            <li>Old <span class="badge badge-light">40</span></li>
                            <li>Expired <span class="badge badge-light">20</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="card db-card">
                    <div class="card-header">
                        <h4><i class="icon-offce-details"></i>Requests <span class="badge badge-light">15</span></h4>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Open <span class="badge badge-light">60</span></li>
                            <li>Old <span class="badge badge-light">40</span></li>
                            <li>Expired <span class="badge badge-light">20</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection