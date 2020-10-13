{{ html()->form('POST', route('admin.calculator.createappartment'))->class('form-horizontal')->attribute('novalidate', true)->open() }}
    <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
        <div class="col-lg-3">
            <label>Name</label>
            <input type="text" class="form-control input-sm" name="appartment" placeholder="Name">
        </div>
        <div class="col-lg-2">
            <label>Poor Value</label>
            <input type="number" class="form-control input-sm" name="poor_value" placeholder="Poor Value" value="0">
        </div>
        <div class="col-lg-2">
            <label>Average Value</label>
            <input type="number" class="form-control input-sm" name="avg_value" placeholder="Average Value" value="0">
        </div>
        <div class="col-lg-2">
            <label>Excellent Value</label>
            <input type="number" class="form-control input-sm" name="excellent_value" placeholder="Excellent Value" value="0">
        </div>
        <div class="col-lg-2">
            <button type="submit" class="btn btn-success btn-sm" name="submit" style="margin-top: 30px;">Submit</button>
        </div>
    </div>
{{ html()->form()->close() }}