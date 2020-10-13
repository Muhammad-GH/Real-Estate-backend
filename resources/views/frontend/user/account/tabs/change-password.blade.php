{{ html()->form('PATCH', route('frontend.auth.password.update'))->class('form-horizontal')->open() }}
    <div class="fk-profile_form-row ">
        <div class="fk-profile_form-group">
            
                {{ html()->label(__('validation.attributes.frontend.old_password'))->for('old_password') }}
            <div class="fk-profile_form-input">
                {{ html()->password('old_password')
                    ->class('form-control')
                    ->autofocus()
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="fk-profile_form-row ">
        <div class="fk-profile_form-group">
            
            
                {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}
        <div class="fk-profile_form-input">
                {{ html()->password('password')
                    ->class('form-control')
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

    <div class="fk-profile_form-row ">
        <div class="fk-profile_form-group">
            
                {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}
            <div class="fk-profile_form-input"> 
                {{ html()->password('password_confirmation')
                    ->class('form-control')
                    ->required() }}
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->

     <div class="fk-profile_form-row ">
        <div class="fk-profile_form-group">
            <button class="btn btn-success btn-sm " type="submit" id="fk-profile_submit">Päivitä</button>
                <!-- {{ form_submit(__('labels.general.buttons.update') . '' . __(''))->id('fk-profile_submit')  }} -->
        </div>
        <!--form-group-->
        
    </div><!--row-->
{{ html()->form()->close() }}
