<div class="card">
    <div class="card-body">
        <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
            <div class="col-sm-5">
                <h5>Add new Ppostal code price</h5>
            </div>
            <!--col-->
            <div class="col-sm-7">
            </div>
            <!--col-->
        </div>
        <!--row-->
        <div class="row">
            <div class="col-12">
                {{ html()->form('POST', route('admin.calculator.createareaselling'))->class('form-horizontal')->id('create-area-form')->attribute('novalidate', true)->open() }}
                <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;margin-top: 20px;">
                    <div class="col-lg-3">
                        <label><b>City</b></label>

                        <div class="form-group">
                            <select name="city" id="city" class="form-control input-sm area-input" required>
                                <option value="">Select City</option>
                                <?php
                                if($city->count() > 0){
                                foreach($city  as $data){ ?>
                                <option value="<?= $data->id ?>"><?= $data->name ?></option>
                                <?php
                                }
                                } ?>
                            </select>
                        </div>
                        <span class="error-city"></span>
                    </div>
                    <div class="col-lg-3">
                        <label><b>Postal Code</b> </label>

                        <div class="form-group">
                            <input type="text" class="form-control input-sm area-input" name="postal_code"
                                   id="postal_code"
                                   placeholder="Postal Code">
                        </div>
                        <span class="error-code"></span>
                    </div>
                    <div class="col-lg-3">
                        <label><b>Price/m2</b> </label>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm area-input" name="price" id="price"
                                   placeholder="Price/m2">
                        </div>
                        <span class="error-price"></span>
                    </div>
                    <div class="col-lg-3">
                        <button style="margin-top: 30px;" type="submit" id="create-area-btn"
                                class="btn btn-success btn-sm" name="submit">Submit
                        </button>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
            <div class="col-sm-5">
                <h5>Import Postal Code Prices</h5>
            </div>
            <!--col-->
            <div class="col-sm-7">
                <a href="<?= url('/');?>/images/sample-data.csv" target='_blank'
                   class="btn btn-warning btn-sm float-right"><i
                            class="fa fa-download"></i> Sample File
                </a>
            </div>
            <!--col-->
        </div>
        <!--row-->
        <div class="row">
            <div class="col-12">
                {{ html()->form('POST', route('admin.calculator.importareaselling'))->class('form-horizontal')->id('upload-area-form')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
                <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;margin-top: 20px;">
                    <div class="col-lg-4">
                        <label><b>Select Csv File (upload only .csv file)</b> </label>

                        <div class="form-group">
                            <input type="file" name="upload-price" id="upload-price" accept=".csv">
                        </div>
                        <span class="error-upload"></span>
                    </div>
                    <div class="col-lg-4">
                        <button style="margin-top: 30px;" type="submit" id="upload-btn" class="btn btn-success btn-sm"
                                name="upload">Import
                        </button>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</div>


