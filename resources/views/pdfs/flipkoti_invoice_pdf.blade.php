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

    .formed {
        border: 2px solid #ccc;
        margin: 0px;
        padding: 0px;

    }

    .formed td,
    .formed th {
        padding: 0 10px;
        height: 50px;

    }

    .table {
        border-collapse: collapse;
    }

    .table tr {
        height: 20px;
    }

    .table td,
    .table th {
        height: 20px;
        padding: 5px 10px;
    }

    .border,
    .table-bordered tr td {
        border: 1px solid #ccc;
    }

    .formed tr th,
    .formed tr td {
        border-bottom: 1px solid #ccc;
        font-weight: 400;
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
                        <td style="font-size: 15px;color: #ccc; font-weight: bold; padding-top:30px;">Invoice</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width:100%;">
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
                                Invoice no: {{$variables["invoice_number"]}}<br>
                                Invoice date: {{$variables["date"]}}<br>
                                Reference: {{$variables["reference"]}}<br>
                                Account number: {{$variables["acc_no"]}}<br>
                                Payment duration: {{$variables["pay_term"]}} Days<br>
                                Due date: {{$variables["due_date"]}}<br>
                                Delay Interest: {{$variables["interest"]}}%<br>
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
                        <td style="width:30%;">
                            <p class="" style="line-height:1.4; font-size:11px;">
                                {{$variables["address"]}}<br>
                                Phone no: {{$variables["phone"]}}<br>
                                Business ID: {{$variables["bussiness_id"]}}<br>
                                Other info <br>
                            </p>
                        </td>
                        <td style="width:50%;">
                            <p style="line-height:1.4;font-size:11px; ">
                                <h5 style="margin-bottom:5px; margin-top:0; font-size:11px;">Bill to</h5>
                                {{$variables["client_id"]}}<br>
                                <br>
                            </p>
                        </td>
                        <td style="width:20%;">
                            <div style="border:1px solid #dfdfdf; padding:8px 12px; margin-top:15px;">
                                <h5 style="margin:0 0 5px; font-size: 11px;">Amount due</h5>
                                <h3 style="margin:0; font-size: 15px">{{$variables["left"]}} {{$variables["total"]}} {{$variables["right"]}}</h3>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width:100%; padding-top:15px; padding-bottom:15px;">
                <hr style="color:#bfbfbf">
            </td>
        </tr>
        <tr>
            <td style="width:100%;" class="border">
                <table class="formed table">
                    <tr style="background-color: #f9f9f9;">
                        <th style="width:29%;">
                            <h4 class="m-0">Description</h4>
                        </th>
                        <th style="width:15%;">Quantity</th>
                        <th style="width:12%;">Unit</th>
                        <th style="width:12%;">Price</th>
                        <th style="width:12%;"></th>
                        <th style="width:20%;">
                            <h4 class="m-0">Amount</h4>
                        </th>
                    </tr>

                    @foreach (json_decode($variables["items"], true) as $key => $item)
                    <tr>
                        <td>{{$item["items"]}}</td>
                        <td>{{$item["qty"]}}</td>
                        <td>{{$item["unit"]}}</td>
                        <td>{{$item["price"]}}</td>
                        <td></td>
                        <td>{{$variables["left"]}} {{$item["amount"]}} {{$variables["right"]}}</td>
                    </tr>
                    @endforeach

                    <tr>
                        <td colspan="6" style="padding:0; width:100%; border:none;">
                            <table align="right" class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td>Subtotal</td>
                                        <td style="width:110px;">{{$variables["left"]}} {{$variables["sub_total"]}} {{$variables["right"]}}</td>
                                    </tr>
                                    <tr>
                                        <td>Vat</td>
                                        <td>{{$variables["tax"]}}%</td>
                                        <td>{{$variables["left"]}} {{$variables["tax_calc"]}} {{$variables["right"]}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Total</td>
                                        <td><b>{{$variables["left"]}} {{$variables["total"]}} {{$variables["right"]}}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-top:30px;">
                <table>
                    <tr>
                        <td style="width:60%;">
                            <h5 style="margin:0 0 5px">Notes</h5>
                            <p>{{$variables["note"]}}</p>
                        </td>
                        <td style="width:40%;">
                            <h5 style="margin:0 0 5px">Terms & Condition</h5>
                            <p>{{$variables["terms"]}}</p>
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