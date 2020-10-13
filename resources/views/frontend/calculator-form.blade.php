<?php
    $langtextarr = Session::get('langtext');
?>

        {{ html()->form('POST', route('frontend.calculator_final'))->id('calculator-form')->attribute('novalidate', true)->open() }}

    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="est_apartmentprice">Estimated<br> Apartment price</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="number" name="est_apartmentprice" value="100000" class="form-control" id="est_apartmentprice">
                        <div class="input-group-append">
                            <div class="input-group-text">&euro;</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div id="apartment"></div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="avg_discount">Average Discount</label>
                        <div id="discount"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="number" id="avg_discount" name="avg_discount" class="sliderValue form-control" value="5" />
                        <div class="input-group-append">
                            <div class="input-group-text">&#37;</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="brokerage">Broker</label>
                        <div id="broker"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="number" name="brokerage" class="form-control" id="brokerage" value="3"/>
                        <div class="input-group-append">
                            <div class="input-group-text">&#37;</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="sales_duration">Sales Duration</label>
                    <div class="input-group">
                        <input type="number" class="input-row form-control" name="sales_duration" id="sales_duration" value="3"/>
                        <div class="input-group-append">
                            <div class="input-group-text">Monthly</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="monthly_cost">Monthly Cost</label>
                    <div class="input-group">
                        <input type="number" class="input-row form-control" name="monthly_cost" id="monthly_cost" value="300"/>
                        <div class="input-group-append">
                            <div class="input-group-text">&euro;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="item">
                        <p>You will get after costs</p>
                        <h3 id="est_total">&euro; 91100</h3>
                    </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="small">Average discount</p>
                                <h3 class="small" id="total_avg_discount">&euro; 5000</h3>
                            </div>
                            <div class="col-sm-4">
                                <p class="small">Broker fee</p>
                                <h3 class="small" id="total_brokerage">&euro; 3000</h3>
                            </div>
                            <div class="col-sm-4">
                                <p class="small">Monthly cost</p>
                                <h3 class="small" id="total_monthly_cost">&euro; 900</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center">We recommend to use ensure the real potential of your apartment by continuing calculator</p>
            <a href="javascript:void(0)" class="btn btn-primary conbtn">Continue&nbsp;></a>
        </div>
    </div>

 {{ html()->form()->close() }}


    <!-- <p class="text-center know">Know more about flipping Appartments <span>?</span></p> -->