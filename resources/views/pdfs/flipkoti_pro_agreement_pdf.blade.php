<style rel="stylesheet">
    table {
        border: 0px;
    }

    tr,
    td,
    p {
        margin: 0px;
        padding: 0px;
    }

    h4 {
        margin: 2px;
    }

    h2 {
        margin-top: 0px;
    }

    .set-font {
        font-size: 14px;
        padding-bottom: 20px;
    }

    .heading {
        color: #000;
        margin-top: 20px;
        font-size: 14px;
        margin-bottom: 0px;
    }

    .time {
        margin-bottom: 5px;
        font-size: 13px;
    }

    .time span {
        font-size: 11px;
        color: #000;
        font-weight: 700;
    }

    .foot {
        color: #9d9d9d;
        font-size: 10px;
    }

    .tb-head {
        margin-bottom: 10px;
        margin-top: 10px;
        font-size: 11px;
    }

    h3 {
        margin: 10px;
    }

    .tableeds {
        border: 1px solid #bfbfbf;
        height: 60px;
        padding: 10px;
    }

    .tableeds p {
        font-size: 10px;
        margin-bottom: 5px;
    }

    .tableed {
        border-collapse: collapse;
    }

    .tableed td {
        height: 8px;
        padding: 4px 10px 4px 10px;
        border: 1px solid #ccc;
        font-size: 10px;
    }

    .tb-bg {
        background-color: #f2f2f2;
    }

    table {
        width: 100%;
    }

    .bold {
        font-weight: bold;
    }

    .boxx {
        margin-bottom: 10px;
    }

    .boxx img {
        margin-right: 8px;
    }
</style>



<page>

    <table style="padding:0px 10px 10px; width: 100%;">
        <tr>
            <td style="width:100%; padding-bottom:10px;">
                <table>
                    <tr>
                        <td style="width:80%;">
                            <img style="width: 200px" src="<?= public_path() . '/images/marketplace/company_logo/' . $variables["logo"]; ?>" alt="Logo">
                        </td>
                        <td style="font-size: 15px;color: #ccc; font-weight: bold; padding-top:30px;">Agreement</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width:100%; padding-bottom:20px">
                <table>
                    <tr>
                        <td style="width:80%;">
                            <p class="bold" style="line-height:1.4; font-size:12px;">
                                {{$variables["company_id"]}}<br>
                                {{$variables["names"]}}<br>
                                {{$variables["email"]}}<br>
                            </p>
                        </td>
                        <td>
                            <p style="line-height:1.4; font-size:11px;">
                                Request ID #FK{{$variables["agreement_request_id"]}}<br>
                                Agreement Date: {{$variables["date"]}}<br>
                                Due date: {{$variables["agreement_due_date"]}}<br>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width:100%;">
                <table>
                    <tr style="vertical-align: top;">
                        <td style="width:200px;">
                            <p class="" style="line-height:1.4; font-size:11px;">
                                {{$variables["address"]}}<br>
                                Phone no: {{$variables["phone"]}}<br>
                                Business ID: {{$variables["bussiness_id"]}}<br>
                                Other info <br>
                            </p>
                        </td>
                        <td>
                            <p style="line-height:1.4;font-size:11px; ">
                                <h5 style="margin-bottom:5px; font-weight:400; margin-top:0; font-size:11px;">Agreement To</h5>
                                {{$variables["agreement_client_id"]}}<br>
                                <br>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width:100%; padding-top:15px; padding-bottom:0px;">
                <hr style="color:#bfbfbf">
            </td>
        </tr>
        <tr>
            <th>
                <h2 class="heading">Project Plan</h2>
            </th>
        </tr>
        <tr>
            <td>
                <table>
                    <tr style="vertical-align:top;">
                        <td style="width:33.33%; padding-right:10px">
                            <h4 class="tb-head">Work</h4>
                            <table class="tableed" style="width:100%">
                                <tbody style="width:100%;vertical-align: middle;">
                                    <?php
                                    if ($variables["work_template"] !== "null") {
                                        foreach (json_decode($variables["work_template"], true) as $key => $value) {
                                            if ($key == 'items') { ?>
                                                @foreach (json_decode($value, true) as $key => $value)
                                                <tr class=<?= $retVal = ($loop->odd) ? 'tb-bg' : ''; ?> style="width:100%">
                                                    <td style="width:100%;">{{$value["items"]}}</td>
                                                </tr>
                                                @endforeach
                                        <?php }
                                        }
                                    } else { ?>
                                        <tr class="tb-bg" style="width:100%">
                                            <td style="width:100%;">None</td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </td>
                        <td style="width:33.33%; padding-left:5px;">
                            <h4 class="tb-head">Material</h4>
                            <table class="tableed">
                                <tbody style="width:100%;vertical-align: middle;">
                                    <?php
                                    if ($variables["mat_template"] !== "null") {
                                        foreach (json_decode($variables["mat_template"], true) as $key => $value) {
                                            if ($key == 'items') { ?>
                                                @foreach (json_decode($value, true) as $key => $value)
                                                <tr class=<?= $retVal = ($loop->odd) ? 'tb-bg' : ''; ?> style="width:100%">
                                                    <td style="width:100%;">{{$value["items"]}}</td>
                                                </tr>
                                                @endforeach
                                        <?php }
                                        }
                                    } else { ?>
                                        <tr class="tb-bg" style="width:100%">
                                            <td style="width:100%;">None</td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th>
                <h2 class="heading">Payment Terms</h2>
            </th>
        </tr>
        <tr>
            <td>
                <table>
                    <tr style="vertical-align: top;">
                        <td style="width:33.33%; padding-right:10px;">
                            <h4 class="tb-head">Total Cost</h4>
                            <table class="tableed" style="width:100%">
                                <tbody style="width:100%" style="width:100%;vertical-align: middle;">
                                    <tr class="tb-bg">
                                        <td style="width:50%; border-right:none;">Work Cost</td>
                                        <td style="width:50%; text-align:right;">{{$variables["left"]}}
                                            <?php
                                            if ($variables["work_template"] !== "null") {
                                                foreach (json_decode($variables["work_template"], true) as $key => $value) {
                                                    if ($key == 'total') {
                                                        echo $value;
                                                    }
                                                }
                                            } else {
                                                echo 0;
                                            }
                                            ?>
                                            {{$variables["right"]}}
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:50%; border-right:none;">Material Cost</td>
                                        <td style="width:50%; text-align:right;">{{$variables["left"]}}
                                            <?php
                                            if ($variables["mat_template"] !== "null") {
                                                foreach (json_decode($variables["mat_template"], true) as $key => $value) {
                                                    if ($key == 'total') {
                                                        echo $value;
                                                    }
                                                }
                                            } else {
                                                echo 0;
                                            }
                                            ?>
                                            {{$variables["right"]}}
                                        </td>
                                    </tr>
                                    <tr class="tb-bg">
                                        <td style="width:50%; border-right:none;">Total Cost</td>
                                        <td style="width:50%; text-align:right;">{{$variables["left"]}}
                                            <?php
                                            $mat = 0;
                                            $work = 0;
                                            if ($variables["mat_template"] !== "null") {
                                                foreach (json_decode($variables["mat_template"], true) as $key => $value) {
                                                    if ($key == 'total') {
                                                        $mat = $value;
                                                    }
                                                }
                                            }
                                            if ($variables["work_template"] !== "null") {
                                                foreach (json_decode($variables["work_template"], true) as $key => $value) {
                                                    if ($key == 'total') {
                                                        $work = $value;
                                                    }
                                                }
                                            }
                                            echo (int)$mat + (int)$work;
                                            ?>
                                            {{$variables["right"]}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td style="width:33.33%; padding-right:5px; padding-left:5px;">
                            <h4 class="tb-head">Materials payment terms</h4>
                            <div class="tableeds">
                                <p style="font-size:10px;">{{$variables["agreement_material_payment"]}}.</p>
                            </div>
                        </td>
                        <td style="width:33.33%; padding-left:10px;">
                            <h4 class="tb-head">Work payment terms</h4>
                            <div class="tableeds">
                                <p>Payment terms: {{$variables["agreement_terms"]}} </p>
                                <p>Hourly Price: {{$variables["left"]}} {{$variables["agreement_rate"]}} {{$variables["right"]}}</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table>
                    <tr>
                        <td style="width:33.33%; padding-right:10px;">
                            <h4 class="tb-head">Transportation payment terms</h4>
                            <div class="tableeds" style="height:15px;">
                                <p>{{$variables["agreement_transport_payment"]}}</p>
                            </div>
                        </td>
                        <td style="width:33.33%; padding-left:10px;">
                            <h4 class="tb-head">Panelty Terms</h4>
                            <div class="tableedsd">
                                <p style="font-size:12px;">{{$variables["agreement_panelty"]}}</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th>
                <h2 class="heading">Guarantee and insurance</h2>
            </th>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td style="width:33.33%; padding-right:10px;">
                            <h4 class="tb-head">Guarantee for work</h4>
                            <div class="tableeds">
                                <p style="font-size:10px;">{{$variables["agreement_work_guarantee"]}}</p>
                            </div>
                        </td>
                        <td style="width:33.33%; padding-left:5px;padding-right:10px;">
                            <h4 class="tb-head">Guarantee for materials</h4>
                            <div class="tableeds">
                                <p style="font-size:10px;">{{$variables["agreement_material_guarantee"]}}</p>
                            </div>
                        </td>
                        <td style="width:33.33%; padding-left:5px;">
                            <h4 class="tb-head">Agreement Insurance</h4>
                            <div class="tableeds">
                                <p style="font-size:10px;">{{$variables["agreement_insurance"]}}</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <page_footer>
        <table style="padding:0 10px 0 10px;">
            <tr>
                <td style="width:100%; padding-top:30px; padding-bottom:0px;">
                    <hr style="color:#bfbfbf">
                </td>
            </tr>
            <tr>
                <td>
                    <p class="foot" style="margin-top:5px;">Powered by FlipkotiPro </p>
                </td>
            </tr>
        </table>
    </page_footer>
</page>



<page>

    <table style="padding:0px 10px 10px; width: 100%;">
        <tr>
            <td style="width:100%; padding-bottom:10px;">
                <table>
                    <tr>
                        <td style="width:80%;">
                            <img style="width: 200px" src="<?= public_path() . '/images/marketplace/company_logo/' . $variables["logo"]; ?>" alt="Logo">
                        </td>
                        <td style="font-size: 15px;color: #ccc; font-weight: bold; padding-top:30px;">Agreement</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th>
                <h2 class="heading">Legal</h2>
            </th>
        </tr>
        <tr>
            <td>
                <table>
                    <tr style="vertical-align:top;">
                        <td style="width:33.33%; padding-right:10px;">
                            <h4 class="tb-head">Client's Responsibility</h4>
                            <div class="tableeds">
                                <p style="font-size:10px;">{{$variables["agreement_client_res"]}}</p>
                                <p style="font-size:10px;">{{$variables["agreement_client_res_other"]}}</p>
                            </div>
                        </td>
                        <td style="width:33.33%; padding-left:5px;padding-right:10px;">
                            <h4 class="tb-head">Contractor Responsibility</h4>
                            <div class="tableeds">
                                <p style="font-size:10px;">{{$variables["agreement_contractor_res"]}}</p>
                                <p style="font-size:10px;">{{$variables["agreement_contractor_res_other"]}}</p>
                            </div>
                        </td>
                        <td style="width:33.33%; padding-left:5px;">
                            <h4 class="tb-head">Legal terms agreed by both party</h4>

                            @foreach (explode (",", $variables["agreement_legal_category"]) as $value)
                            <div class="boxx">
                                <img src="<?= resource_path('views/pdfs') . '/checked.png'; ?>" alt="Logo Html2Pdf">
                                {{$value}} agreement
                            </div>
                            @endforeach

                            <!-- <div class="boxx">
                                <img src="<?= resource_path('pdfs') . '/checked.png'; ?>" alt="Logo Html2Pdf">
                                Timber agreement
                            </div>
                            <div class="boxx">
                                <img src="<?= resource_path('pdfs') . '/checked.png'; ?>" alt="Logo Html2Pdf">
                                Plumber agreement
                            </div>
                            <div class="boxx">
                                <img src="<?= resource_path('pdfs') . '/checked.png'; ?>" alt="Logo Html2Pdf">
                                Electricity agreement
                            </div> -->
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    <page_footer>
        <table style="padding:0 10px 0 10px;">
            <tr>
                <td style="width:100%; padding-top:30px; padding-bottom:0px;">
                    <hr style="color:#bfbfbf">
                </td>
            </tr>
            <tr>
                <td>
                    <p class="foot" style="margin-top:5px;">Powered by FlipkotiPro </p>
                </td>
            </tr>
        </table>
    </page_footer>


</page>