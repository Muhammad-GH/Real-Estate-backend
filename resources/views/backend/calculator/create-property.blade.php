{{ html()->form('POST', route('admin.calculator.createproperty'))->class('form-horizontal')->attribute('novalidate', true)->open() }}
<form action="" method="post">
    <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
        <div class="col-lg-3">
            <label>Name</label>
            <input type="text" class="form-control input-sm" name="property" placeholder="Name">
        </div>
        <div class="col-lg-2">
            <label>Already Renovated</label>
            <input type="number" class="form-control input-sm" name="renovated_value" placeholder="Already Renovated" value="0">
        </div>
        <div class="col-lg-2">
            <label>No Renovated</label>
            <input type="number" class="form-control input-sm" name="norenovated_value" placeholder="No Renovated" value="0">
        </div>
        <div class="col-lg-2">
            <label>Dont Know</label>
            <input type="number" class="form-control input-sm" name="dontknow_value" placeholder="Dont Know" value="0">
        </div>
        <div class="col-lg-2">
            <button type="submit" class="btn btn-success btn-sm" name="submit" style="margin-top: 30px;">Submit</button>
        </div>
    </div>
</form>
{{ html()->form()->close() }}