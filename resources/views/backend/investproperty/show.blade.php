@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Property Management')

@section('breadcrumb-links')
    @include('backend.property.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Invest Property Management
                    <small class="text-muted">View Invest Property</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th style="width:350px;">Title</th>
                            <td>{{ $investProperty->title }}</td>
                        </tr>
                        <tr>
                            <th>Details</th>
                            <td>{{ $investProperty->details }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{ $investProperty->price }}</td>
                        </tr>
                        <tr>
                            <th>Selling Price</th>
                            <td>{{ $investProperty->selling_price }}</td>
                        </tr>
                        <tr>
                            <th>Profit</th>
                            <td>{{ $investProperty->profit }}</td>
                        </tr>
                        <tr>
                            <th>Net Return</th>
                            <td>{{ $investProperty->net_return }}</td>
                        </tr>
                        <tr>
                            <th>Capital Growth</th>
                            <td>{{ $investProperty->capital_growth }}</td>
                        </tr>
                        <tr>
                            <th>liquidation</th>
                            <td>{{ $investProperty->liquidation }}</td>
                        </tr>
                        <tr>
                            <th>bathroom</th>
                            <td>{{ $investProperty->bathroom }}</td>
                        </tr>
                        <tr>
                            <th>kitchen</th>
                            <td>{{ $investProperty->kitchen }}</td>
                        </tr>
                        <tr>
                            <th>painting</th>
                            <td>{{ $investProperty->painting }}</td>
                        </tr>
                        <tr>
                            <th>flooring</th>
                            <td>{{ $investProperty->flooring }}</td>
                        </tr>
                        <tr>
                            <th>interior design</th>
                            <td>{{ $investProperty->interior_design }}</td>
                        </tr>
                        <tr>
                            <th>broker_fee</th>
                            <td>{{ $investProperty->broker_fee }}</td>
                        </tr>
                        <tr>
                            <th>taxes</th>
                            <td>{{ $investProperty->taxes }}</td>
                        </tr>
                        <tr>
                            <th>monthly_cost</th>
                            <td>{{ $investProperty->monthly_cost }}</td>
                        </tr>
                        @if( $investProperty->document )
                                @php
                                    $image = url('/images/investProperty/'.$investProperty->id.'/'.$investProperty->document);
                                @endphp
                            <tr>
                                <th>download</th>
                                <td>
                                    <a href="{{ $image }}" target="_blank" class="btn">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <th>Project Images</th>
                            <td>
                                @if( count($investProperty->investmentImage) > 0 )
                                    @foreach($investProperty->investmentImage as $propImage)
                                        @php
                                            $image = url('/images/investProperty/'.$investProperty->id.'/'.$propImage->name);
                                        @endphp
                                        <img src="{{ $image }}" style="width:250px" alt="Propert picture">
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!--table-responsive-->
        </div>
    </div><!--card-body-->

</div><!--card-->
@endsection
