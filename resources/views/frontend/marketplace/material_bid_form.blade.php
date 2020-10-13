{{ html()->form('POST', route('frontend.marketplace.storeMaterialBid', $material->id))->attribute('novalidate', true)->id('material-bid-form')->open() }}

    <div class="form-group">
        <div class="row align-items-center">
            <div class="col-5">
                <label class="d-flex ">Sinun tarjous</label>
            </div>
            <div class="col-7">
                <label class="d-flex align-items-center">
                    €/{{ __($material->unit) }}
                    <input class="form-control" type="text" name="quote" />
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row align-items-center">
            <div class="col-5">
                <label class="d-flex">Määrä</label>
            </div>
            <div class="col-7">
                <label class="d-flex align-items-center">{{ __($material->unit) }} <input class="form-control" type="text" name="quantity"></label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>{{__('Contact Name')}}</label>
        <input class="form-control" type="text" name="contact_name">
    </div>
    <div class="form-group">
        <label>Yrityksen Nimi</label>
        <input class="form-control" type="text" name="company_name">
    </div>
    <div class="form-group">
        <label>Sähköpostiosoite</label>
        <input class="form-control" type="text" name="email_address">
    </div>
    <div class="form-group">
        <label>Puhelinnumero</label>
        <input class="form-control" type="text" name="contact_number">
    </div>
    <div class="form-group">
        <label>{{ ('Offer' == $material->post_type)? __('Shipping to'): __('Shipping from') }} </label>
        <input class="form-control" type="text" name="shipping_location">
    </div>
    <div class="form-group">
        <label>Rahtityyppi</label>
        {{
            html()->select('delivery_type', 
                [
                    '' => __('Select'),
                    'Flight' => __('Flight'),
                    'Road' => __('Road'),
                    'Ship' => __('Ship')
                ]
                )
                ->class('form-control')
                ->required()
        }}
    </div>
    @if('Request' == $material->post_type)
    <div class="form-group">
        <label>Toimituskulut</label>
        <input class="form-control" type="text" name="delivery_charges" placeholder="800">
    </div>
    <div class="form-group">
        <label>Takuu</label>
        <div class="d-flex input-group">
            <input class="form-control" type="text" name="warranty" placeholder="20">
            {{
                html()->select('warranty_type', 
                    [
                        'Days' => __('Days'),
                        'Week' => __('Week'),
                        'Month' => __('Month'),
                        'Year' => __('Year')
                    ]
                    )
                    ->class('form-control')
                    ->required()
            }}
        </div>
    </div>
    @endif
    <div class="form-group">
        <label>Viesti:</label>
        <textarea class="form-control" name="message"></textarea>
    </div>
    <div class="form-group">
        <div class="checkbox">
        <label class="light" for="terms"><input type="checkbox" class="custom-check" id="terms" name="terms" required=""><span class="checkmark"></span>Olen lukenut Flipkodin <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link">tietosuojaselosteen</a> ja <a href="{{ route('frontend.terms') }}" class="custom-link">käyttöehdot</a></label>
        </div>
       <!--  <label for="trems"><input type="checkbox" name="terms"> <span class="check-text">Olen lukenut Flipkodin <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> tietosuojaselosteen</a> ja <a href="{{ route('frontend.terms') }}" class="custom-link"> käyttöehdot</a></span></label> -->
    </div>
    <button type="submit">{{ __('Submit your bid') }}</button>

{{ html()->form()->close() }}

@push('after-styles')
<style>
    /*input.custom-check {position: absolute;}*/
    form label.error {color: red;}
</style>
@endpush