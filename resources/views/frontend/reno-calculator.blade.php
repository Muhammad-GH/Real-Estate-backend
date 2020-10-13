
<section class="btndevice calc">
    <div class="container">
        {{ html()->form('POST', route('frontend.reno-calculator-final'))->id('reno-calculator-form')->attribute('novalidate', true)->open() }}

        <div class="calculatorbox" id="step-1">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <h3>Welcome to Renovation cost calculator
                        <span>Calculate the potential of your apartment with our estimator</span></h3>
                </div>
            </div>
            <div  id="step-2">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                        <h4>Please give the basic info of your Portion </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="appcondtion">Portion Type</p>
                        <div class="row">
                            <?php
                            if($appartments->count() > 0){ ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <ul class="radbutton">
                                    <?php
                                    $i =0;
                                    $total = round($appartments->count()/2);

                                    foreach($appartments  as $key => $appartment){
                                    if($total == $i){
                                        break;
                                    } $i++;
                                    ?>
                                    <li>
                                        <p>{{$appartment->name}}</p>
                                        <label class="radiofor">
                                            <input type="radio"  name="portion-type" value="{{$appartment->name}}" $key == 0 ? checked : >
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <?php
                                    } ?>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <ul class="radbutton">
                                    <?php
                                    $i =0;
                                    $total = round($appartments->count()/2);
                                    foreach($appartments  as $appartment){
                                    if($total > $i){
                                        $i++;
                                        continue;
                                    } $i++;
                                    ?>
                                    <li>
                                        <p>{{$appartment->name}}</p>
                                        <label class="radiofor">
                                            <input type="radio"  name="appartment[{{$appartment->id}}]"
                                                   value="poor_value">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <?php
                                    } ?>
                                </ul>
                            </div>
                            <?php } ?>
                                <p class="text-center"><a href="javascript:void(0)" class="reno-conbtn">Continue1>></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ html()->form()->close() }}
    </div>
    <p class="text-center know">Know more about flipping Appartments <span>?</span></p>
</section>